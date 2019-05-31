<?php

namespace InepZend\Module\Oauth\Adapter\Oauth1;

use InepZend\Module\Oauth\Adapter\Oauth1\AbstractAdapter;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\Utility;
use InepZend\Util\Curl;
use InepZend\Util\Environment;
use InepZend\Util\Reflection;
use ZendOAuth\OAuth as ZendOAuth;

class Ssi extends AbstractAdapter
{

    protected $strWebsiteName = 'SSI';
    protected $strSiteUrl = 'oauth';
    protected $strRequestTokenUrl = 'oauth/request_token';
    protected $strAuthorizeUrl = 'oauth/authorization';
    protected $strAccessTokenUrl = 'oauth/access_token';
    protected $arrDefaultOptions = array(
        'requestScheme' => ZendOAuth::REQUEST_SCHEME_QUERYSTRING,
    );

//    const URL_DESENV = 'http://172.30.7.18:8080/SSIServices/seam/resource/v1/'; #baroni
//    const URL_DESENV = 'http://172.30.7.115:8080/SSIServices/seam/resource/v1/'; #wellington
//    const URL_LOCAL = 'http://172.30.7.99:8080/SSIServices/seam/resource/v1/'; #molina
    const URL_LOCAL = 'http://desenvolvimento.inep.gov.br/SSIServices/seam/resource/v1/'; #sem oauth
    const URL_DESENV = 'http://desenvolvimento.inep.gov.br/SSIServices/seam/resource/v1/'; #com oauth
    const URL_ENTREGA = 'http://entrega.inep.gov.br/SSIServices/seam/resource/v1/';
    const URL_TQS = 'http://tqs.inep.gov.br/SSIServices/seam/resource/v1/';
    const URL_HOMOLOGA = 'http://homologacao.inep.gov.br/SSIServices/seam/resource/v1/';
    const URL_TREINAMENTO = 'http://172.31.0.15/SSIServices/seam/resource/v1/';
    const URL_CLONE_D1 = 'http://clone.inep.gov.br/SSIServices/seam/resource/v1/';
    const URL = 'http://ssioauth.dmzinep.gov.br/SSIServices/seam/resource/v1/';

    public function __construct($arrOptions = array())
    {
        $strUrl = Reflection::listConstantsFromClass($this, 'URL' . Environment::getSufix(true));
        $arrAttribute = array('strSiteUrl', 'strRequestTokenUrl', 'strAuthorizeUrl', 'strAccessTokenUrl');
        foreach ($arrAttribute as $strAttribute)
            $this->$strAttribute = $strUrl . $this->$strAttribute;
        parent::__construct($arrOptions);
    }

    public function callRequestToken($oAuth, $arrConfig = array())
    {
        $this->debugExecFile('=> Chamada do Request Token', null, true);
        $this->setOptionsIntoHttpClient($oAuth, $arrConfig);
        $requestToken = $oAuth->getAdapter()->getRequestToken(array(), 'GET');
        if (is_null($requestToken))
            return false;
        $oAuth->getStorage()->saveRequestToken($requestToken);
        $arrOptions = $this->getOptions();
        $config = $oAuth->getAdapter()->getConsumer()->getConfig();
        $config->setToken($requestToken);
        $arrParam = (new Utility())->assembleParams(null, $config);
        $arrCustomServiceParameter = array(
            'oauth_callback' => $arrOptions['callbackUrl'],
            'oauth_consumer_key' => $arrParam['oauth_consumer_key'],
            'oauth_signature_method' => $arrOptions['signatureMethod'],
            'oauth_timestamp' => $arrParam['oauth_timestamp'],
            'oauth_nonce' => $arrParam['oauth_nonce'],
            'oauth_version' => $arrOptions['version'],
            'oauth_signature' => $arrParam['oauth_signature'],
        );
        $oAuth->getAdapter()->getConsumer()->redirect($arrCustomServiceParameter, null, false);
        exit();
    }

    public function callAccessToken($oAuth, $arrConfig = array())
    {
        $this->debugExecFile('=> Chamada do Access Token');
        $this->setOptionsIntoHttpClient($oAuth, $arrConfig);
        $requestToken = $oAuth->getStorage()->getRequestToken();
        $this->debugExecFile($requestToken);
        if (is_null($requestToken))
            return false;
        $this->debugExecFile($_SERVER['REQUEST_URI']);
        $arrData = unserialize(gzinflate(base64_decode(strtr(end($arrExplode = explode('/ssicallback/', $_SERVER['REQUEST_URI'])), '-_', '+/'))));
        $this->debugExecFile($arrData);
        $requestToken->setTokenSecret($arrData['oauth_token_secret']);
        $oAuth->getStorage()->saveRequestToken($requestToken);
        $accessKey = $oAuth->getAdapter()->getAccessToken($arrData, $requestToken, 'GET');
        $arrReturn = array($accessKey, $arrData['oauth_verifier']);
        $this->debugExecFile($arrReturn);
        return $arrReturn;
    }

    private function setOptionsIntoHttpClient($oAuth, $arrConfig = array())
    {
        $oAuth->getAdapter()->getConsumer()->getHttpClient()->setOptions(Curl::getOptionToHttpClient($arrConfig));
    }

    public function setSiteUrl($strSiteUrl)
    {
        $this->strSiteUrl = $strSiteUrl;
        return $this;
    }

    public function getSiteUrl()
    {
        return $this->strSiteUrl;
    }

}
