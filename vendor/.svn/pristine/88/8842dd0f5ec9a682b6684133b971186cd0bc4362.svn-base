<?php

namespace InepZend\Module\Oauth\Adapter;

use InepZend\Module\Oauth\Adapter\Oauth1\AbstractAdapter as AbstractAdapter1;
use InepZend\Module\Oauth\Adapter\Oauth2\AbstractAdapter as AbstractAdapter2;
use InepZend\Module\Oauth\Service\AbstractService;
use InepZend\Module\Oauth\Adapter\Oauth1\Ssi;
use InepZend\Util\DebugExec;
use Zend\Http\Response;
use Zend\Json\Json;

abstract class AbstractAdapter implements AdapterInterface
{

    use DebugExec;

    protected $strCallback;
    protected $strConsumerKey;
    protected $strConsumerSecret;
    protected $consumer;
    protected $arrOptions = array();
    protected $strWebsiteName;
    protected $strWebsiteProfileUrl;
    protected $accessToken;
    protected $arrDefaultOptions = array();
    protected $arrHttpClientOptions = array();

    const DEBUG = AbstractService::DEBUG;

    public function __construct($arrOptions = array())
    {
        if ($arrOptions)
            $this->setOptions($arrOptions);
    }

    public function getCallback()
    {
        return $this->strCallback;
    }

    public function setCallback($strCallback)
    {
        $this->strCallback = $strCallback;
        return $this;
    }

    public function getConsumerKey()
    {
        if ((empty($this->strConsumerKey)) && ($this instanceof Ssi))
            $this->strConsumerKey = @$GLOBALS['authServiceAdapter']['paramHeaderRequest']['client-id'];
        return $this->strConsumerKey;
    }

    public function setConsumerKey($strConsumerKey)
    {
        $this->strConsumerKey = $strConsumerKey;
        return $this;
    }

    public function getConsumerSecret()
    {
        if ((empty($this->strConsumerSecret)) && ($this instanceof Ssi))
            $this->strConsumerSecret = @$GLOBALS['authServiceAdapter']['paramHeaderRequest']['secret-id'];
        return $this->strConsumerSecret;
    }

    public function setConsumerSecret($strConsumerSecret)
    {
        $this->strConsumerSecret = $strConsumerSecret;
        return $this;
    }

    public function getConsumer()
    {
        if ($this->consumer)
            return $this->consumer;
        $strClass = 'InepZend\Module\Oauth\Vendor\ZendOAuth' . (($this->isOAuth1()) ? '' : '2') . '\Consumer';
        $consumer = new $strClass($this->getOptions());
        $consumer->getHttpClient()->setOptions(array(
            'sslverifypeer' => false
        ));
        return $this->consumer = $consumer;
    }

    public function getConsumerHttpClient()
    {
        return $this->getConsumer()->getHttpClient();
    }

    public function getOptions()
    {
        return $this->arrOptions;
    }

    public function setOptions(array $arrOptions = array())
    {
        $this->arrOptions = $arrOptions;
        return $this;
    }

    public function getWebsiteName()
    {
        return $this->strWebsiteName;
    }

    public function setWebsiteName($strWebsiteName)
    {
        $this->strWebsiteName = $strWebsiteName;
        return $this;
    }

    public function getWebsiteProfileUrl()
    {
        $accessToken = $this->getAccessToken();
        if ($strRemoteUserId = $accessToken->getParam('remoteUserId'))
            return sprintf($this->strWebsiteProfileUrl, $strRemoteUserId);
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getAccessToken($arrQueryData = null, $token = null, $strHttpMethod = null, $request = null)
    {
        if ($this->accessToken)
            return $this->accessToken;
        if ((is_array($arrQueryData)) && (array_key_exists('denied', $arrQueryData)))
            return;
        return $this->accessToken = $this->getConsumer()->getAccessToken($arrQueryData, $token, $strHttpMethod, $request);
    }

    public function getHttpClient(array $arrOauthOptions = array(), $strUri = null, $arrConfig = null, $booExcludeCustomParamsFromHeader = true)
    {
        $arrOauthOptions = array_merge($this->arrHttpClientOptions, $arrOauthOptions);
        $httpClientInvoker = (is_object($accessToken = $this->getAccessToken())) ? $accessToken : $this->getConsumer();
        return $httpClientInvoker->getHttpClient($arrOauthOptions, $strUri, $arrConfig, $booExcludeCustomParamsFromHeader);
    }

    public function getAdapterKey()
    {
        $className = get_class($this);
        $className = explode('\\', $className);
        return strtolower(array_pop($className));
    }

    public function getRequest()
    {
        return $this->getConsumer()->getHttpClient()->getRequest();
    }

    public function getResponse()
    {
        return $this->getConsumer()->getHttpClient()->getResponse();
    }

    public function getRequestToken($arrCustomServiceParameter = null, $strHttpMethod = null)
    {
        return $this->getConsumer()->getRequestToken($arrCustomServiceParameter, $strHttpMethod);
    }

    public function getRequestTokenUrl()
    {
        return $this->getConsumer()->getRedirectUrl();
    }

    protected function parseJsonResponse(Response $response)
    {
        $strResponse = $response->getBody();
        if (!$strResponse)
            return;
        return Json::decode($strResponse, Json::TYPE_ARRAY);
    }

    protected function parseJsonpResponse(Response $response)
    {
        $strResponse = $response->getBody();
        if (!$strResponse)
            return;
        $mixLpos = strpos($strResponse, '(');
        $mixRpos = strrpos($strResponse, ')');
        $strResponse = substr($strResponse, $mixLpos + 1, $mixRpos - $mixLpos - 1);
        return Json::decode($strResponse, Json::TYPE_ARRAY);
    }

    protected function parseXmlResponse(Response $response)
    {
        $strResponse = $response->getBody();
        if (!$strResponse)
            return;
        return Json::fromXml($strResponse, Json::TYPE_ARRAY);
    }

    protected function isOAuth1()
    {
        return ($this instanceof AbstractAdapter1);
    }

    protected function isOAuth2()
    {
        return ($this instanceof AbstractAdapter2);
    }

}
