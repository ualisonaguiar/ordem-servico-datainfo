<?php

namespace InepZend\Module\Oauth\Service;

use InepZend\Util\Curl;

class TwitterService extends AbstractService
{

    public function __construct($serviceManager = null)
    {
        parent::__construct('1', str_replace(array(__NAMESPACE__, 'Service', '\\'), '', __CLASS__), $serviceManager);
    }

    public function searchTweets($strTag = null, $strResultType = 'mixed', $intCount = 50, $intSinceId = 0, $arrParam = null)
    {
        return $this->makeCall('search/tweets', array_merge(array('q' => $strTag, 'result_type' => $strResultType, 'count' => $intCount, 'since_id' => $intSinceId), (array) $arrParam));
    }

    public function callRequestToken()
    {
        if ($this->getAccessTokenFromSession()) {
            $oAuth = $this->getOAuth();
            $oAuth->getStorage()->clearRequestToken();
            $oAuth->getStorage()->clearAccessToken();
            $this->clearAccessTokenFromSession();
        }
//        exit('limpo');
        return $this->getOAuth()->getAdapter()->callRequestToken($this->getOAuth(), $this->getConfig());
    }

    public function callAccessToken()
    {
        return $this->getOAuth()->getAdapter()->callAccessToken($this->getOAuth(), $this->getConfig());
    }

    private function makeCall($strFunction = null, $arrParam = null, $strMethod = 'GET')
    {
        $arrConfig = $this->getConfig();
        unset($arrConfig['enable']);
        $arrConfig['siteUrl'] = 'https://api.twitter.com/oauth';
        $strUrl = 'https://api.twitter.com/1.1/' . $strFunction . '.json';
        $accessToken = $this->getAccessTokenFromSession();
        if (!is_object($accessToken)) {
            $this->setLastRouteIntoSession();
            return $this->callRequestToken();
        }
        $client = $accessToken->getHttpClient($arrConfig, null, Curl::getOptionToHttpClient($arrConfig));
        $client->setUri($strUrl);
        $client->setMethod($strMethod);
        if ($strMethod === 'POST')
            $client->setParameterPost($arrParam);
        elseif ($strMethod === 'GET')
            $client->setParameterGet($arrParam);
        $intCount = 0;
        do {
            ++$intCount;
            $response = $client->send();
        } while ((!in_array($response->getStatusCode(), array(200, 401))) && ($intCount <= 5));
        return json_decode($client->getResponse()->getBody());
    }

}
