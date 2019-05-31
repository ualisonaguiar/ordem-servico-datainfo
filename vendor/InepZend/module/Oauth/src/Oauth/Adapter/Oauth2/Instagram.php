<?php

namespace InepZend\Module\Oauth\Adapter\Oauth2;

use InepZend\Module\Oauth\Adapter\Oauth2\AbstractAdapter;
use InepZend\Module\Oauth\Vendor\ZendOAuth2\Token\Access;
use ZendOAuth\OAuth as ZendOAuth;
use InepZend\Exception\InvalidArgumentException;
use InepZend\Util\Curl;

class Instagram extends AbstractAdapter
{

    protected $strAccessTokenFormat = 'json';
    protected $strAuthorizeUrl = 'https://api.instagram.com/oauth/authorize';
    protected $strAccessTokenUrl = 'https://api.instagram.com/oauth/access_token';
    protected $arrDefaultOptions = array(
        'requestScheme' => ZendOAuth::REQUEST_SCHEME_HEADER,
        'scope' => 'basic public_content',
    );
    private $arrScope = array('basic', 'likes', 'comments', 'relationships', 'public_content', 'basic public_content', 'basic public_content follower_list comments relationships likes');

    public function callCode()
    {
        $arrOption = array(
            'consumerKey' => $this->getConsumerKey(),
            'callbackUrl' => $this->getCallback(),
            'scope' => $this->getScope(),
        );
        if (empty($arrOption['consumerKey']))
            throw new InvalidArgumentException(sprintf('consumerKey não encontrado em %s', get_class($this)));
        if (empty($arrOption['callbackUrl']))
            throw new InvalidArgumentException(sprintf('callbackUrl não encontrado em %s', get_class($this)));
        if (empty($arrOption['scope']))
            throw new InvalidArgumentException(sprintf('scope não encontrado em %s', get_class($this)));
        elseif (!in_array($arrOption['scope'], $this->arrScope))
            throw new InvalidArgumentException(sprintf('Fomato do scope indefinido: %s. Os formatos corretos são ' . implode('|', $this->arrScope), $arrOption['scope']));
        header(sprintf(
            'Location:%s/?client_id=%s&redirect_uri=%s&response_type=code&scope=%s', $this->strAuthorizeUrl, $arrOption['consumerKey'], $arrOption['callbackUrl'], $arrOption['scope']
        ));
        exit();
    }

    public function callAccessToken($mixCode, $arrConfig = array())
    {
        if (empty($mixCode))
            return;
        $arrData = array(
            'client_id' => $this->getConsumerKey(),
            'client_secret' => $this->getConsumerSecret(),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->getCallback(),
            'code' => $mixCode,
        );
        $strError = null;
        $mixCurlResult = Curl::getCurl($this->strAccessTokenUrl, $arrData, 'POST', null, null, null, $arrConfig);
        if (!is_array($mixCurlResult))
            $strError = 'Não foi possível realizar a conexão via Curl.';
        else {
            $mixJsonData = $mixCurlResult[0];
            $mixCurlError = $mixCurlResult[1];
            if ($mixJsonData === false)
                $strError = $mixCurlError;
            else {
                $mixContent = json_decode($mixJsonData);
                if (is_object($mixContent)) {
                    if (!empty($mixContent->access_token)) {
                        $accessToken = new Access();
                        $accessToken->setToken($mixContent->access_token);
                        $accessToken->setParam('user', $mixContent->user);
                        return $accessToken;
                    }
                    $strError = (!empty($mixContent->error_message)) ? $mixContent->code . ' - ' . $mixContent->error_type . ': ' . $mixContent->error_message : 'accessToken não encontrado';
                } else
                    $strError = 'Falha no formato do retorno';
            }
        }
        if (!is_null($strError))
            throw new InvalidArgumentException(sprintf('Erro em %s: ' . $strError, get_class($this)));
        return false;
    }

    public function getScope()
    {
        return ((array_key_exists('scope', $this->arrDefaultOptions)) && (!empty($this->arrDefaultOptions['scope']))) ? $this->arrDefaultOptions['scope'] : 'basic';
    }

}
