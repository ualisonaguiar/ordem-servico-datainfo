<?php

namespace InepZend\Module\Oauth\Service;

use InepZend\Module\Oauth\Service\OauthService;
use InepZend\Session\Session;
use InepZend\Exception\InvalidArgumentException;
use InepZend\Exception\RuntimeException;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\Utility;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\Reflection;
use InepZend\Util\DebugExec;
use \Exception as ExceptionNative;

abstract class AbstractService
{

    use AttributeStaticTrait,
        DebugExec;

    private $strAdapter;
    private $strVersion;
    private $serviceLocator;
    private $arrConfig;
    private $oAuth;

    const DEBUG = false;

    public function __construct($strVersion = '2', $strAdapter = null, $serviceManager = null)
    {
        $this->setAdapter($strAdapter);
        $this->setVersion($strVersion);
        $this->setServiceLocator($serviceManager);
        $this->getConfig();
        $this->getOAuth();
    }

    public function getOAuthInstance()
    {
        $strAdapter = $this->getAdapter();
        $strVersion = $this->getVersion();
        if ((empty($strAdapter)) || (empty($strVersion)) || (!is_object($this->getServiceLocator())))
            throw new InvalidArgumentException(sprintf('Parâmetro(s) obrigatório(s) não informado(s) em %s. ', get_class($this)));
        $arrConfig = $this->getConfig();
        $arrOption = array(
            'adapter' => $strAdapter,
            'storage' => $strAdapter . 'Session',
            'version' => 'Oauth' . $strVersion,
            'callback' => $arrConfig['callbackUrl'],
        );
        return OauthService::factory($arrOption, $this->getServiceLocator());
    }

    public function setAccessTokenIntoOAuth($accessToken, $oAuth = null, $booRedirect = false)
    {
        if (!is_object($oAuth))
            $oAuth = $this->getOAuth();
        $arrAccessToken = $oAuth->getAdapter()->accessTokenToArray($accessToken);
        $oAuth->getStorage()->saveAccessToken($arrAccessToken);
        $oAuth->getStorage()->clearRequestToken();
        if ($booRedirect) {
            $oAuth->getAdapter()->getConsumer()->redirect();
            exit();
        }
    }

    public function getAccessToken()
    {
        $oAuth = $this->getOAuth();
        return ($arrAccessToken = $oAuth->getStorage()->getAccessToken()) ? $arrAccessToken : array();
    }

    public function getToken()
    {
        $strAdapter = $this->getAdapter();
        if (empty($strAdapter))
            throw new InvalidArgumentException(sprintf('Parâmetro(s) obrigatório(s) não informado(s) em %s. ', get_class($this)));
        $arrAccessToken = $this->getAccessToken();
        if (!array_key_exists('token', $arrAccessToken))
            return;
        if (!array_key_exists('adapterKey', $arrAccessToken))
            return $arrAccessToken['token'];
        return (strtolower($arrAccessToken['adapterKey']) == strtolower($strAdapter)) ? $arrAccessToken['token'] : null;
    }

    protected function getSession()
    {
        $strAdapter = $this->getAdapter();
        if (empty($strAdapter))
            throw new InvalidArgumentException(sprintf('Parâmetro(s) obrigatório(s) não informado(s) em %s. ', get_class($this)));
        return new Session($strAdapter . 'Service');
    }

    public function getLastRouteFromSession($booClear = false)
    {
        $session = $this->getSession();
        $mixReturn = ($session->offsetExists('last_route')) ? $session->offsetGet('last_route') : null;
        if (($booClear) && (!empty($mixReturn)))
            $this->clearLastRouteFromSession();
        return $mixReturn;
    }

    protected function setLastRouteIntoSession($controller = null)
    {
//        $mixLastRoute = (is_object($controller)) ? $controller->getEvent()->getRouteMatch()->getMatchedRouteName() : $this->getLastRoute();
        $mixLastRoute = (is_object($controller)) ? str_replace($controller->getEvent()->getRequest()->getBaseUrl(), '', $controller->getEvent()->getRequest()->getRequestUri()) : $this->getLastRoute();
        if ($mixLastRoute === false)
            return false;
        $session = $this->getSession();
        $session->offsetSet('last_route', ((strlen($mixLastRoute) > 1) && ($mixLastRoute{0} == '/')) ? substr($mixLastRoute, 1) : $mixLastRoute);
        $session->offsetSet('last_post', $_POST);
        return true;
    }

    public function clearLastRouteFromSession()
    {
        $session = $this->getSession();
        return $session->offsetUnset('last_route');
    }

    public function getLastPostFromSession($booClear = true)
    {
        $session = $this->getSession();
        $mixReturn = ($session->offsetExists('last_post')) ? $session->offsetGet('last_post') : null;
        if (($booClear) && (!empty($mixReturn)))
            $this->clearLastPostFromSession();
        return $mixReturn;
    }

    public function clearLastPostFromSession()
    {
        $session = $this->getSession();
        return $session->offsetUnset('last_post');
    }

    public function getLastRoute()
    {
        $controller = null;
        $arrBacktrace = debug_backtrace();
        foreach ($arrBacktrace as $arrTrace) {
            if ((array_key_exists('object', $arrTrace)) && (strpos(get_class($arrTrace['object']), 'Controller') !== false) && (strpos(get_class($arrTrace['object']), 'UnitTest') === false) && (!in_array($arrTrace['object']->getEvent()->getRouteMatch()->getMatchedRouteName(), array('instagramcode', 'instagramcallback')))) {
                $controller = $arrTrace['object'];
                break;
            }
        }
//        return (is_object($controller)) ? $controller->getEvent()->getRouteMatch()->getMatchedRouteName() : false;
        $mixLastRoute = (is_object($controller)) ? str_replace($controller->getEvent()->getRequest()->getBaseUrl(), '', $controller->getEvent()->getRequest()->getRequestUri()) : false;
        return ((!is_bool($mixLastRoute)) && (strlen($mixLastRoute) > 1) && ($mixLastRoute{0} == '/')) ? substr($mixLastRoute, 1) : $mixLastRoute;
    }

    public function getAccessTokenFromSession()
    {
        $session = $this->getSession();
        $accessToken = ($session->offsetExists('accessToken')) ? unserialize($session->offsetGet('accessToken')) : null;
        if (is_object($accessToken))
            $accessToken->setHttpUtility(new Utility());
        return $accessToken;
    }

    public function setAccessTokenIntoSession($accessToken)
    {
        $session = $this->getSession();
        return $session->offsetSet('accessToken', serialize($accessToken));
    }

    public function clearAccessTokenFromSession()
    {
        $session = $this->getSession();
        return $session->offsetUnset('accessToken');
    }

    public function checkCallRequestToken()
    {
        $mixToken = $this->getToken();
        if (empty($mixToken)) {
            $session = new Session($this->getAdapter() . 'Controller');
            $session->offsetSet('route_if_has_access_token', $this->getLastRoute());
            $strRouteStartOAuth = $this->getRouteStartOAuth();
            if (empty($strRouteStartOAuth))
                throw new InvalidArgumentException(sprintf('Rota de início do oAuth não encontrada em %s. ', get_class($this)));
            return $strRouteStartOAuth;
        }
        return true;
    }

    private function getRouteStartOAuth()
    {
        $strRouteStartOAuth = null;
        $strService = get_class($this);
        $strController = str_replace('Service', ((stripos($strService, 'Controller') === false) ? 'Controller' : ''), $strService);
        $arrMethod = Reflection::listMethodsFromClass($strController, true);
        foreach ($arrMethod as $strMethod) {
            if (stripos($strMethod, 'action') === false)
                continue;
            $booStartOAuth = false;
            $arrAnnotation = Reflection::listAnnotationsFromMethod($strController, $strMethod);
            if ((is_array($arrAnnotation)) && (array_key_exists('STARTOAUTH', $arrAnnotation)))
                $booStartOAuth = (in_array(strtolower($arrAnnotation['STARTOAUTH']), array('1', 'true', 'yes', 'sim')));
            if ($booStartOAuth) {
                $strRouteStartOAuth = str_replace('Action', '', $strMethod);
                break;
            }
        }
        return $strRouteStartOAuth;
    }

    public function getAdapter()
    {
        return $this->strAdapter;
    }

    private function setAdapter($strAdapter)
    {
        $this->strAdapter = $strAdapter;
        return $this;
    }

    public function getVersion()
    {
        return $this->strVersion;
    }

    private function setVersion($strVersion)
    {
        $this->strVersion = $strVersion;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    private function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getConfig()
    {
        $strAdapter = $this->getAdapter();
        $strVersion = $this->getVersion();
        if ((empty($strAdapter)) || (empty($strVersion)))
            throw new InvalidArgumentException(sprintf('Parâmetro(s) obrigatório(s) não informado(s) em %s. ', get_class($this)));
        if (empty($this->arrConfig)) {
            $strAdapter = strtolower($strAdapter);
            $strOAuthVersion = 'oauth' . $strVersion;
            $strError = null;
            try {
                $arrConfig = (is_object($this->getServiceLocator())) ? $this->getServiceLocator()->get('Config') : array();
            } catch (ExceptionNative $exception) {
                throw RuntimeException::cloneException($exception);
            }
            if (!array_key_exists('oAuth', $arrConfig))
                $strError = 'Chave oAuth não encontrada nas configurações.';
            else {
                if (!array_key_exists($strOAuthVersion, $arrConfig['oAuth']))
                    $strError = 'Chave ' . $strOAuthVersion . ' não encontrada nas configurações oAuth.';
                else {
                    if (!array_key_exists($strAdapter, $arrConfig['oAuth'][$strOAuthVersion]))
                        $strError = 'Chave ' . $strAdapter . ' não encontrada nas configurações oAuth/' . $strOAuthVersion . '.';
                    else {
                        if (!array_key_exists('enable', $arrConfig['oAuth'][$strOAuthVersion][$strAdapter]))
                            $strError = 'Chave enable não encontrada nas configurações oAuth/' . $strOAuthVersion . '/' . $strAdapter . '.';
                        else {
                            if (($strAdapter != 'ssi') && (!$arrConfig['oAuth'][$strOAuthVersion][$strAdapter]['enable']))
                                $strError = 'oAuth/' . $strOAuthVersion . '/' . $strAdapter . ' não habilitado.';
                            else {
                                $arrConfig = $arrConfig['oAuth'][$strOAuthVersion][$strAdapter];
                                $this->setConfig($arrConfig);
                                return $arrConfig;
                            }
                        }
                    }
                }
            }
            if (!is_null($strError))
                throw new InvalidArgumentException(sprintf('Erro em %s: ' . $strError, get_class($this)));
        }
        return $this->arrConfig;
    }

    private function setConfig($arrConfig)
    {
        $this->arrConfig = $arrConfig;
        return $this;
    }

    public function getOAuth()
    {
        if (empty($this->oAuth)) {
            $oAuth = $this->getOAuthInstance();
            $this->setOAuth($oAuth);
            return $oAuth;
        }
        return $this->oAuth;
    }

    private function setOAuth($oAuth)
    {
        $this->oAuth = $oAuth;
        return $this;
    }

}
