<?php

namespace InepZend\Module\Oauth\Adapter\Oauth2;

use InepZend\Module\Oauth\Adapter\AbstractAdapter as OauthAbstractAdapter;
use InepZend\Exception\InvalidArgumentException;
use ZendOAuth\OAuth as ZendOAuth;
use InepZend\Module\Oauth\Vendor\ZendOAuth2\Token\Access as AccessToken;

abstract class AbstractAdapter extends OauthAbstractAdapter implements AdapterInterface
{

    const ACCESS_TOKEN_FORMAT_JSON = 'json';
    const ACCESS_TOKEN_FORMAT_JSONP = 'jsonp';
    const ACCESS_TOKEN_FORMAT_XML = 'xml';
    const ACCESS_TOKEN_FORMAT_PAIR = 'pair';

    protected $strAccessTokenFormat = 'json';
    protected $strAccessTokenRequestMethod = ZendOAuth::POST;

    public function getAccessTokenFormat()
    {
        return $this->strAccessTokenFormat;
    }

    public function setAccessTokenFormat($strAccessTokenFormat)
    {
        if (!in_array($strAccessTokenFormat, array(self::ACCESS_TOKEN_FORMAT_JSON, self::ACCESS_TOKEN_FORMAT_JSONP, self::ACCESS_TOKEN_FORMAT_XML, self::ACCESS_TOKEN_FORMAT_PAIR)))
            throw new InvalidArgumentException(sprintf('Fomato do accessToken indefinido: %s. Os formatos corretos são json|jsonp|xml', $strAccessTokenFormat));
        $this->strAccessTokenFormat = $strAccessTokenFormat;
        return $this;
    }

    public function setOptions(array $arrOptions = array())
    {
        $arrDefaultOptions = array(
            'requestScheme' => ZendOAuth::REQUEST_SCHEME_HEADER,
            'version' => '2.0',
            'callbackUrl' => $this->getCallback(),
            'consumerKey' => $this->getConsumerKey(),
            'consumerSecret' => $this->getConsumerSecret(),
            'authorizeUrl' => $this->strAuthorizeUrl,
            'accessTokenUrl' => $this->strAccessTokenUrl,
            'accessTokenFormat' => $this->strAccessTokenFormat,
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
        if (!$arrOptions['callbackUrl'])
            throw new InvalidArgumentException(sprintf('callbackUrl não encontrado em %s', get_class($this)));
        $this->setConsumerKey($arrOptions['consumerKey']);
        $this->setConsumerSecret($arrOptions['consumerSecret']);
        $this->setCallback($arrOptions['callbackUrl']);
        $this->setAccessTokenFormat($arrOptions['accessTokenFormat']);
        $this->arrOptions = $arrOptions;
        return $this;
    }

    public function refreshAccessToken()
    {
        
    }

    public function getHttpClient(array $arrOauthOptions = array(), $strUri = null, $arrConfig = null, $booExcludeCustomParamsFromHeader = true)
    {
        $arrDefaultOptions = array(
            'requestScheme' => ZendOAuth::REQUEST_SCHEME_QUERYSTRING,
        );
        $arrOauthOptions = array_merge($arrDefaultOptions, $this->arrHttpClientOptions, $arrOauthOptions);
        $httpClientInvoker = (is_object($accessToken = $this->getAccessToken())) ? $accessToken : $this->getConsumer();
        $client = $httpClientInvoker->getHttpClient($arrOauthOptions, $strUri, $arrConfig, $booExcludeCustomParamsFromHeader);
        if ((isset($arrOauthOptions['callback'])) && ($arrOauthOptions['callback'])) {
            $strFunc = $arrOauthOptions['callback'];
            $client = $this->$strFunc($client);
        }
        return $client;
    }

    public function accessTokenToArray(AccessToken $accessToken)
    {
        return array(
            'adapterKey' => $this->getAdapterKey(),
            'token' => $accessToken->getToken(),
            'expireTime' => $accessToken->getExpiredTime(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'version' => 'Oauth2',
        );
    }

    public function arrayToAccessToken(array $arrAccessToken)
    {
        $accessToken = new AccessToken();
        $accessToken->setToken($arrAccessToken['token']);
        $accessToken->setTokenSecret($arrAccessToken['tokenSecret']);
        foreach ($arrAccessToken as $mixKey => $mixValue)
            $accessToken->setParam($mixKey, $mixValue);
        return $accessToken;
    }

}
