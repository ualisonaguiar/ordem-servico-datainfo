<?php

namespace InepZend\Module\Oauth\Adapter\Oauth1;

use InepZend\Module\Oauth\Adapter\Oauth1\AbstractAdapter;
use ZendOAuth\Token\Access as AccessToken;
use InepZend\Util\Curl;

class Twitter extends AbstractAdapter
{

    protected $strWebsiteName = 'Twitter';
    protected $strRequestTokenUrl = 'https://api.twitter.com/oauth/request_token';
    protected $strAuthorizeUrl = 'https://api.twitter.com/oauth/authorize';
    protected $strAccessTokenUrl = 'https://api.twitter.com/oauth/access_token';

    public function callRequestToken($oAuth, $arrConfig = array())
    {
        $this->setOptionsIntoHttpClient($oAuth, $arrConfig);
        $requestToken = $oAuth->getAdapter()->getRequestToken();
        $oAuth->getStorage()->saveRequestToken($requestToken);
        $oAuth->getAdapter()->getConsumer()->redirect();
        exit();
    }

    public function callAccessToken($oAuth, $arrConfig = array())
    {
        $this->setOptionsIntoHttpClient($oAuth, $arrConfig);
        $requestToken = $oAuth->getStorage()->getRequestToken();
        return $oAuth->getAdapter()->getAccessToken($_GET, $requestToken);
    }

    public function accessTokenToArray(AccessToken $accessToken)
    {
        $arrAccessToken = parent::accessTokenToArray($accessToken);
        $arrAccessToken['remoteUserId'] = $accessToken->getParam('user_id');
        $arrAccessToken['remoteUserName'] = $accessToken->getParam('screen_name');
        return $arrAccessToken;
    }

    private function setOptionsIntoHttpClient($oAuth, $arrConfig = array())
    {
        $oAuth->getAdapter()->getConsumer()->getHttpClient()->setOptions(Curl::getOptionToHttpClient($arrConfig));
    }

}
