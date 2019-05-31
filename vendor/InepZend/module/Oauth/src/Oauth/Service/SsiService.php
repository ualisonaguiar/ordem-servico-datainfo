<?php

namespace InepZend\Module\Oauth\Service;

use InepZend\Module\Oauth\Service\AbstractService;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\Utility;
use InepZend\Module\Oauth\Service\Ssi\AppService;
use InepZend\Module\Oauth\Service\Ssi\AutenticadorService;
use InepZend\Module\Oauth\Service\Ssi\ContatoService;
use InepZend\Module\Oauth\Service\Ssi\PerfilService;
use InepZend\Module\Oauth\Service\Ssi\SenhaService;
use InepZend\Module\Oauth\Service\Ssi\SubtipoContatoService;
use InepZend\Module\Oauth\Service\Ssi\UsuarioService;
use InepZend\Module\Oauth\Service\Ssi\UsuarioSistemaService;
use InepZend\Util\Curl;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;
use InepZend\Util\Format;
use InepZend\Util\Environment;
use InepZend\Util\stdClass;
use InepZend\Exception\ErrorException;
use \Exception as ExceptionNative;

class SsiService extends AbstractService
{

    use AppService,
        AutenticadorService,
        ContatoService,
        PerfilService,
        SenhaService,
        SubtipoContatoService,
        UsuarioService,
        UsuarioSistemaService;

    const FORCE_OAUTH = false;

    public function __construct($serviceManager = null)
    {
        parent::__construct('1', str_replace(array(__NAMESPACE__, 'Service', '\\'), '', __CLASS__), $serviceManager);
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
        $arrResult = $this->getOAuth()->getAdapter()->callAccessToken($this->getOAuth(), $this->getConfig());
        $this->setVerifierIntoSession($arrResult[1]);
        return $arrResult[0];
    }

    private function makeCall($strFunction, $mixParam = null, $strMethod = 'GET')
    {
//        $this->callRequestToken();
        $arrConfig = $this->getConfig();
        $arrConfig['siteUrl'] = $this->getOAuth()->getAdapter()->getSiteUrl();
        if (empty($arrConfig['consumerKey']))
            $arrConfig['consumerKey'] = @$GLOBALS['authServiceAdapter']['paramHeaderRequest']['client-id'];
        if (empty($arrConfig['consumerSecret']))
            $arrConfig['consumerSecret'] = @$GLOBALS['authServiceAdapter']['paramHeaderRequest']['secret-id'];
        $strUrl = str_replace('/oauth', '', $arrConfig['siteUrl']) . '/' . $strFunction;
        $arrHeader = array();
        $booOAuth = ((!Environment::isLocal()) && (!Environment::isClone()));
        if (self::FORCE_OAUTH)
            $booOAuth = true;
        elseif (!(bool) $arrConfig['enable']) {
            $arrHeader['OauthDisabledClientToService'] = 'true';
            $booOAuth = false;
        }
        unset($arrConfig['enable']);
        $accessToken = null;
        if ($booOAuth) {
            $accessToken = $this->getAccessTokenFromSession();
            if (!is_object($accessToken)) {
                $this->setLastRouteIntoSession();
                return $this->callRequestToken();
            }
        }
        $booClear = true;
        $strContentDebug = FileSystem::getContentFromFile(Server::getReplacedBasePathApplication('/../../../../../../../public/debug.htm'));
        if (strpos($strContentDebug, 'Chamada do Request Token') !== false)
            $booClear = false;
        $this->debugExecFile('=> Chamada REST do servico', null, $booClear);
        $httpClientInvoker = (is_object($accessToken)) ? $accessToken : $this->getOAuth()->getAdapter()->getConsumer();
        $client = $httpClientInvoker->getHttpClient($arrConfig, null, Curl::getOptionToHttpClient($arrConfig));
        $strUrl = str_replace('desenvjava.inep.gov.br', 'desenvjava', $strUrl);
        $client->setUri($strUrl);
        $client->setMethod($strMethod);
        $arrCustomServiceParameter = array('oauth_token' => (is_object($accessToken)) ? $accessToken->getToken() : null);
        if (!$booOAuth)
            $arrCustomServiceParameter['oauth_consumer_key'] = $arrConfig['consumerKey'];
        if ((is_array($mixParam)) && (array_key_exists('tokenId', $mixParam)))
            $arrCustomServiceParameter = array_merge($arrCustomServiceParameter, array('tokenId' => $mixParam['tokenId']));
        $arrHeaderValue = array();
        foreach ($arrCustomServiceParameter as $strKey => $mixValue)
            $arrHeaderValue[] = Utility::urlEncode($strKey) . '="' . Utility::urlEncode($mixValue) . '"';
        if (count($arrHeaderValue) > 0)
            $arrHeader['Authorization'] = 'OAuth ' . implode(',', $arrHeaderValue);
        if ((!empty($mixParam)) && (!is_array($mixParam)) && (Format::isJson($mixParam)))
            $arrHeader['Content-Type'] = 'application/json';
        if (!empty($arrHeader))
            $client->setHeaders($arrHeader);
        if (!empty($mixParam)) {
            if ($strMethod === 'POST') {
                if (is_array($mixParam))
                    $client->setParameterPost($mixParam);
                else
                    $client->getRequest()->setContent($mixParam);
            } elseif ($strMethod === 'GET')
                $client->setParameterGet($mixParam);
            elseif ($strMethod === 'PUT')
                $client->getRequest()->setContent(http_build_query($mixParam));
        }
        try {
            $intCount = 0;
            do {
                ++$intCount;
                $this->debugExecFile($client->getRequest(), null, false, true);
                $response = $client->send();
                $this->debugExecFile($response, null, false, true);
            } while ((!in_array($response->getStatusCode(), array(200, 401))) && ($intCount <= 1));
            $result = json_decode($client->getResponse()->getBody());
            $strStatus = (is_object($result)) ? @$result->response->status : null;
            if (($this->getCheckResultThrow()) && (!empty($strStatus)) && ($strStatus != 'OK')) {
                $arrMessages = (array) @$result->response->messages;
                throw new ErrorException(empty($arrMessages) ? 'A resposta teve o status ' . $strStatus . '.' : reset($arrMessages));
            }
            return $result;
        } catch (ExceptionNative $exception) {
            $this->debugExecFile($exception);
            if ($this->getCheckResultThrow())
                throw $exception;
            return false;
        }
    }

    public function setCheckResultThrow($booCheckResultThrow = null)
    {
        self::setAttributeStatic('booCheckResultThrow', $booCheckResultThrow);
        return $this;
    }

    public function getCheckResultThrow()
    {
        return (bool) self::getAttributeStatic('booCheckResultThrow');
    }

    public function getVerifierFromSession()
    {
        $session = $this->getSession();
        return ($session->offsetExists('verifier')) ? $session->offsetGet('verifier') : null;
    }

    public function setVerifierIntoSession($strVerifier)
    {
        $session = $this->getSession();
        return $session->offsetSet('verifier', $strVerifier);
    }

    private function generateSsiTokenId($mixParam1 = null, $mixParam2 = null)
    {
        $this->debugExecFile(__FUNCTION__ . ' (getSsiTokenId)');
        return $this->getSsiTokenId($mixParam1, $mixParam2);
    }

    private function getJsonParam($arrParam = null)
    {
        return json_encode(new stdClass($arrParam));
    }

    private function getSsiTokenId($strUsername, $strPassword)
    {
        if (PHP_VERSION <= 5.4)
            return ssi_tokenid($strUsername, $strPassword);
        $intRandUsername = abs(rand());
        $strUsernameEncode = base64_encode($strUsername);
        $intRandPassword = abs(rand());
        $strPasswordEncode = base64_encode($strPassword);
        return base64_encode(sprintf(
            "%02d%d%02d%s%02d%d%02d%s",
            strlen(sprintf("%d", $intRandUsername)),
            $intRandUsername,
            strlen($strUsernameEncode),
            $strUsernameEncode,
            strlen(sprintf("%d", $intRandPassword)),
            $intRandPassword,
            strlen($strPasswordEncode),
            $strPasswordEncode
        ));
    }

}
