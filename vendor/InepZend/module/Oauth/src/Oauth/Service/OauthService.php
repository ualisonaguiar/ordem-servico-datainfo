<?php

namespace InepZend\Module\Oauth\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use InepZend\Exception;
use InepZend\Module\Oauth\Adapter;
use InepZend\Module\Oauth\Storage;

class OauthService
{

    const VERSION_OAUTH1 = 'Oauth1';
    const VERSION_OAUTH2 = 'Oauth2';

    protected $storage = null;
    protected $adapter = null;
    protected $strOauthVersion = 'Oauth2';
    protected $arrOptions;
    protected $serviceLocator;

    public static function factory(array $arrOptions, ServiceLocatorInterface $serviceManager)
    {
        $arrDefaultOptions = array(
            'adapter' => '',
            'storage' => 'GenericSession',
            'version' => self::VERSION_OAUTH2,
            'callback' => '',
        );
        $arrOptions = array_merge($arrDefaultOptions, $arrOptions);
        $strAdapter = $arrOptions['adapter'];
        $strStorage = $arrOptions['storage'];
        $strOauthVersion = $arrOptions['version'];
        $strCallbackUrl = $arrOptions['callback'];
        if (!$strCallbackUrl)
            throw new Exception\InvalidArgumentException(sprintf('callbackUrl não encontrado'));
        $oauth = new static();
        $oauth->setOauthVersion($strOauthVersion);
        $oauth->setServiceLocator($serviceManager);
        $strAdapter = strtolower($arrOptions['adapter']);
        $strOauthVersion = strtolower($strOauthVersion);
        $arrConfig = $serviceManager->get('Config');
        $arrOptions = array(
            'enable' => true,
            'consumer_key' => '',
            'consumer_secret' => '',
        );
        if (isset($arrConfig['oAuth'][$strOauthVersion][$strAdapter])) {
            $arrConfigAdapter = $arrConfig['oAuth'][$strOauthVersion][$strAdapter];
            $arrOptions = array_merge($arrOptions, array('enable' => $arrConfigAdapter['enable'], 'consumer_key' => $arrConfigAdapter['consumerKey'], 'consumer_secret' => $arrConfigAdapter['consumerSecret']));
        }
        if (($strAdapter != 'ssi') && (!$arrOptions['enable']))
            throw new Exception\RuntimeException(sprintf('oAuth %s não habilitado', get_class($oauth)));
        $arrOptions['consumerKey'] = $arrOptions['consumer_key'];
        $arrOptions['consumerSecret'] = $arrOptions['consumer_secret'];
        $arrOptions['callbackUrl'] = $strCallbackUrl;
        unset($arrOptions['consumer_key']);
        unset($arrOptions['consumer_secret']);
        $oauth->setOptions($arrOptions);
        $adapter = $oauth->initAdapter($strAdapter, $strOauthVersion);
        $storage = $oauth->initStorage($strStorage);
        return $oauth;
    }

    public function initByAccessToken(array $arrAccessToken = array(), array $arrOptions = array())
    {
        if (!$arrAccessToken)
            $arrAccessToken = $this->getStorage()->getAccessToken();
        if (!$arrAccessToken)
            throw new Exception\InvalidArgumentException(sprintf('Sem accessToken no serviço de inicialização'));
        $arrDefaultAccessToken = array(
            'adapterKey' => '',
            'version' => '',
            'token' => '',
            'tokenSecret' => '',
            'remoteUserId' => '',
            'remoteUserName' => '',
            'user_id' => '',
        );
        $arrAccessToken = array_merge($arrDefaultAccessToken, $arrAccessToken);
        $strOauthVersion = strtolower($arrAccessToken['version']);
        $strAdapter = $arrAccessToken['adapterKey'];
        if ($serviceManager = $this->getServiceLocator()) {
            $arrConfig = $serviceManager->get('Config');
            $arrDefaultOptions = array(
                'enable' => true,
                'consumer_key' => '',
                'consumer_secret' => '',
            );
            if (isset($arrConfig['oAuth'][$strOauthVersion][$strAdapter])) {
                $arrConfigAdapter = $arrConfig['oAuth'][$strOauthVersion][$strAdapter];
                $arrOptions = array_merge($arrDefaultOptions, array('enable' => $arrConfigAdapter['enable'], 'consumer_key' => $arrConfigAdapter['consumerKey'], 'consumer_secret' => $arrConfigAdapter['consumerSecret']), $arrOptions);
            }
            if (!$arrOptions['enable'])
                throw new Exception\RuntimeException(sprintf('Oauth service %s não habilitado', get_class($this)));
            $arrOptions['consumerKey'] = $arrOptions['consumer_key'];
            $arrOptions['consumerSecret'] = $arrOptions['consumer_secret'];
            if ((!isset($arrOptions['callbackUrl'])) || (!$arrOptions['callbackUrl']))
                $arrOptions['callbackUrl'] = 'http://localhost/';
            unset($arrOptions['consumer_key']);
            unset($arrOptions['consumer_secret']);
            $this->setOptions($arrOptions);
        }
        $this->setOauthVersion($strOauthVersion);
        $adapter = $this->initAdapter($strAdapter, $strOauthVersion);
        $accessToken = $adapter->arrayToAccessToken($arrAccessToken);
        $adapter->setAccessToken($accessToken);
        return $this;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceManager)
    {
        $this->serviceLocator = $serviceManager;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getOptions()
    {
        return $this->arrOptions;
    }

    public function setOptions($arrOptions)
    {
        $this->arrOptions = $arrOptions;
        return $this;
    }

    public function getOauthVersion()
    {
        return $this->strOauthVersion;
    }

    public function setOauthVersion($strOauthVersion)
    {
        if ((!$strOauthVersion == self::VERSION_OAUTH2) && (!$strOauthVersion == self::VERSION_OAUTH1))
            throw new Exception\InvalidArgumentException(sprintf('Indefinido oauth version. As permitidas são: %s or %s', self::VERSION_OAUTH2, self::VERSION_OAUTH1));
        $this->strOauthVersion = $strOauthVersion;
        return $this;
    }

    public function initAdapter($strAdapter, $strOauthVersion)
    {
        $arrOptions = $this->getOptions();
        $strAdapterClass = 'InepZend\Module\Oauth\Adapter\\' . ucfirst(strtolower($strOauthVersion)) . '\\' . ucfirst(strtolower($strAdapter));
        if (class_exists($strAdapterClass) === false)
            throw new Exception\InvalidArgumentException(sprintf('Indefinido oauth adapter %s para a oauth version %s', $strAdapter, $strOauthVersion));
        return $this->adapter = new $strAdapterClass($arrOptions);
    }

    public function initStorage($strStorage)
    {
        $strStorageClass = 'InepZend\Module\Oauth\Storage\\' . trim($strStorage);
        if (class_exists($strStorageClass) === false)
            throw new Exception\InvalidArgumentException(sprintf('Indefinido oauth storage %s', $strStorage));
        return $this->storage = new $strStorageClass();
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter(Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getStorage()
    {
        if ($this->storage === null)
            $this->setStorage(new Storage\GenericSession());
        return $this->storage;
    }

    public function setStorage(Storage\StorageInterface $storage)
    {
        $this->storage = $storage;
        return $this;
    }

}
