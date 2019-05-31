<?php

namespace InepZend\Module\Oauth\Adapter\Oauth1;

use InepZend\Module\Oauth\Adapter\AbstractAdapter as OauthAbstractAdapter;
use InepZend\Exception\InvalidArgumentException;
use ZendOAuth\OAuth as ZendOAuth;
use ZendOAuth\Token\Access as AccessToken;

abstract class AbstractAdapter extends OauthAbstractAdapter implements AdapterInterface
{

    public function setOptions(array $arrOptions = array())
    {
        $arrDefaultOptions = array(
            'requestScheme' => ZendOAuth::REQUEST_SCHEME_HEADER,
            'version' => '1.0',
            'signatureMethod' => 'HMAC-SHA1',
            'callbackUrl' => $this->getCallback(),
            'consumerKey' => $this->getConsumerKey(),
            'consumerSecret' => $this->getConsumerSecret(),
            'requestTokenUrl' => $this->strRequestTokenUrl,
            'authorizeUrl' => $this->strAuthorizeUrl,
            'accessTokenUrl' => $this->strAccessTokenUrl,
        );
        if (empty($arrOptions['consumerKey']))
            unset($arrOptions['consumerKey']);
        if (empty($arrOptions['consumerSecret']))
            unset($arrOptions['consumerSecret']);
        $arrOptions = array_merge($arrDefaultOptions, $this->arrDefaultOptions, $arrOptions);
        if (!$arrOptions['consumerKey'])
            throw new InvalidArgumentException(sprintf('consumerKey não encontrado em %s', get_class($this)));
        if (!$arrOptions['consumerSecret'])
            throw new InvalidArgumentException(sprintf('consumerSecret não encontrado em %s', get_class($this)));
//        if (!$arrOptions['callbackUrl'])
//            throw new InvalidArgumentException(sprintf('callbackUrl não encontrado em %s', get_class($this)));
        $this->setConsumerKey($arrOptions['consumerKey']);
        $this->setConsumerSecret($arrOptions['consumerSecret']);
        $this->setCallback($arrOptions['callbackUrl']);
        $this->arrOptions = $arrOptions;
        return $this;
    }

    public function getHttpClient(array $arrOauthOptions = array(), $strUri = null, $arrConfig = null, $booExcludeCustomParamsFromHeader = true)
    {
        $consumer = $this->getConsumer();
        $arrDefaultOptions = array(
            'consumerKey' => $consumer->getConsumerKey(),
            'consumerSecret' => $consumer->getConsumerSecret(),
        );
        if ((!$arrDefaultOptions['consumerKey']) || (!$arrDefaultOptions['consumerSecret']))
            throw new InvalidArgumentException(sprintf('Oauth1.0 AccessToken necessita de consumerKey e consumerSecret definidos em %s', get_class($this)));
        $arrOauthOptions = array_merge($arrDefaultOptions, $this->arrHttpClientOptions, $arrOauthOptions);
        $httpClientInvoker = (is_object($accessToken = $this->getAccessToken())) ? $accessToken : $consumer;
        $client = $httpClientInvoker->getHttpClient($arrOauthOptions, $strUri, $arrConfig, $booExcludeCustomParamsFromHeader);
        $client->setOptions(array(
            'sslverifypeer' => false,
        ));
        return $client;
    }

    public function accessTokenToArray(AccessToken $accessToken)
    {
        return array(
            'adapterKey' => $this->getAdapterKey(),
            'token' => $accessToken->getToken(),
            'tokenSecret' => $accessToken->getTokenSecret(),
            'version' => 'Oauth1',
        );
    }

    public function arrayToAccessToken(array $arrAccessToken)
    {
        $accessToken = new AccessToken();
        $accessToken->setToken($arrAccessToken['token']);
        $accessToken->setTokenSecret($arrAccessToken['tokenSecret']);
        return $accessToken;
    }

}
