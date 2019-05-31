<?php

namespace InepZend\Module\WebService\Server\Rest\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Exception\RuntimeException;
use InepZend\Util\Server;

class RestServer extends AbstractServiceManager
{

    const REQUEST_KEY_CLASS = 'class';
    const REQUEST_KEY_SERVICE = 'service';
    const REQUEST_KEY_PARAMS = 'params';
    const REQUEST_KEY_SECRET_KEY = 'secret_key';
    const REQUEST_KEY_RESOURCE = 'resource';
    const RESPONSE_TYPE_JSON = 'json';
    const RESPONSE_TYPE_XML = 'xml';
    const RESPONSE_STATUS_OK = 'ok';
    const RESPONSE_STATUS_ERROR = 'error';
    const RESPONSE_MSG_ERROR_DEFAULT = 'Um erro ocorreu durante a execução. Por favor, tente novamente mais tarde.';
    const LIFETIME_SECOND_SECRET_KEY = 43200;
    const CSE = 'InepRest'; // Sal do ofuscador
    const HASH_ALGO = 'sha256';

    private static $strCse;
    private static $arrIp;

    public static function getResult($strStatus = null, $mixMessage = null, $mixResult = null)
    {
        return parent::getResult($strStatus, (($strStatus == self::RESPONSE_STATUS_ERROR) && (empty($mixMessage))) ? self::RESPONSE_MSG_ERROR_DEFAULT : $mixMessage, $mixResult);
    }

    protected function callService($service = null, $strService = null, $mixParam = null)
    {
        if ((!is_object($service)) || (empty($strService)))
            return self::getResult(self::RESPONSE_STATUS_ERROR, null, array('error' => 'Serviço inexistente.', 'exception' => null));
        $arrParam = array();
        if (!empty($mixParam)) {
            if (!is_array($mixParam)) {
                $mixUnserialize = unserialize($mixParam);
                if ($mixUnserialize === false)
                    $arrParam = array($mixParam);
                else
                    $arrParam = $mixUnserialize;
            } else
                $arrParam = $mixParam;
        }
        $arrArgument = array();
        foreach ((array) $arrParam as $mixKey => $strParam)
            $arrArgument[] = '$arrParam[' . $mixKey . ']';
        eval('$mixResult = @$service->' . $strService . '(' . implode(', ', $arrArgument) . ');');
        return ((is_array($mixResult)) && (array_key_exists('status', $mixResult)) && ((array_key_exists('result', $mixResult)) || (array_key_exists('message', $mixResult)))) ? $mixResult : self::getResult(self::RESPONSE_STATUS_OK, null, $mixResult);
    }

    protected function getResultType($arrAnnotation = null)
    {
        if ((empty($arrAnnotation)) || (!is_array($arrAnnotation)) || (!array_key_exists('REST', $arrAnnotation)))
            return self::RESPONSE_TYPE_JSON;
        return (in_array(strtolower($arrAnnotation['REST']), array('1', 'true', 'yes', 'sim', self::RESPONSE_TYPE_JSON))) ? self::RESPONSE_TYPE_JSON : strtolower($arrAnnotation['REST']);
    }

    protected function checkSecretKey($strSecretKeyObfuscated)
    {
        $intSec = $this->getDiffSecretKey($strSecretKeyObfuscated);
        return (!($intSec > self::LIFETIME_SECOND_SECRET_KEY));
    }

    protected function getDiffSecretKey($strSecretKeyObfuscated)
    {
        $strSecretyKeyUnobfuscated = end(explode(' ', $this->unobfuscateSecretKey($strSecretKeyObfuscated)));
        return (end(explode(' ', microtime())) - $strSecretyKeyUnobfuscated);
    }

    protected function checkAuthentication($arrAnnotation = null, $strService = null, $strClass = null)
    {
        if ((empty($arrAnnotation)) || (empty($strService)) || (empty($strClass)))
            return;
        $arrConfig = $this->getService('Config');
        $arrUserPassValid = (array) @$arrConfig['restServer']['security']['authorization'];
        if (empty($arrUserPassValid))
            $this->headerUnauthorized('Não foram definidos usuário/senha de autorização do acesso via WebService (WS) do serviço ' . $strService . ' da classe ' . $strClass . '.');
        if (!isset($_SERVER['PHP_AUTH_USER']))
            $this->headerUnauthorized('Não foi utilizada a devida autorização do acesso via WebService (WS) do serviço ' . $strService . ' da classe ' . $strClass . '.');
        $strUserPhpAuth = @$_SERVER['PHP_AUTH_USER'];
        $strPassPhpAuth = @$_SERVER['PHP_AUTH_PW'];
        $strUserSsi = null;
        $strPassSsi = null;
        $arrUser = explode('-', $strUserPhpAuth);
        if (count($arrUser) > 1) {
            $strUserPhpAuth = $arrUser[0];
            $strUserSsi = $arrUser[1];
        }
        $arrPass = explode('-', $strPassPhpAuth);
        if (count($arrPass) > 1) {
            $strPassPhpAuth = $arrPass[0];
            $strPassSsi = $arrPass[1];
        }
        $booAuth = (!((is_array($arrAnnotation)) && (array_key_exists('REST_AUTH', $arrAnnotation)) && (in_array(strtolower($arrAnnotation['REST_AUTH']), array('0', 'false', 'no', 'nao')))));
        if ($booAuth) {
            if ((empty($strUserSsi)) || (empty($strPassSsi)))
                $this->headerUnauthorized('Não foram informados usuário/senha do SSI para o acesso via WebService (WS) do serviço ' . $strService . ' da classe ' . $strClass . '.');
            $arrResultAuth = $this->getService('InepZend\Module\Authentication\Service\Authentication')->authenticate(array('login' => $strUserSsi, 'senha' => $strPassSsi));
            if (!$arrResultAuth[0])
                $this->headerUnauthorized('Foram informados usuário/senha do SSI não autorizados ao acesso via WebService (WS) do serviço ' . $strService . ' da classe ' . $strClass . '.');
        }
        if (!in_array(array($strUserPhpAuth, $strPassPhpAuth), $arrUserPassValid))
            $this->headerUnauthorized('Foram informados usuário/senha não autorizados ao acesso via WebService (WS) do serviço ' . $strService . ' da classe ' . $strClass . '.');
    }

    protected function checkAnnotationRest($arrAnnotation = null, $strService = null, $strClass = null)
    {
        if ((empty($arrAnnotation)) || (empty($strService)) || (empty($strClass)))
            return;
        if ((is_array($arrAnnotation)) && (array_key_exists('REST', $arrAnnotation)) && (in_array(strtolower($arrAnnotation['REST']), array('1', 'true', 'yes', 'sim', self::RESPONSE_TYPE_JSON, self::RESPONSE_TYPE_XML))))
            return;
        throw new RuntimeException('O serviço ' . $strService . ' da classe ' . $strClass . ' não possui acesso via WebService (WS).');
    }

    protected function checkAnnotationResource($arrAnnotation = null, $strService = null, $strClass = null, $strResource = null)
    {
        if ((empty($arrAnnotation)) || (empty($strService)) || (empty($strClass)) || (empty($strResource)))
            return;
        if ((is_array($arrAnnotation)) && (array_key_exists('REST_RESOURCE', $arrAnnotation)) && ($arrAnnotation['REST_RESOURCE'] != $strResource))
            throw new RuntimeException('O serviço ' . $strService . ' da classe ' . $strClass . ' exige a parametrização do resource de permissão de acesso.');
    }

    protected function checkSecurityIp($strService = null, $strClass = null)
    {
        if ((empty($strService)) || (empty($strClass)))
            return;
        $arrIp = $this->getConfigIp();
        if ((is_array($arrIp)) && (count($arrIp) > 0)) {
            $strIpClient = Server::getIp(true);
            $booException = true;
            foreach ($arrIp as $strIp) {
                $strIp = Server::clearIp($strIp);
                if (strpos($strIpClient, $strIp) === 0) {
                    $booException = false;
                    break;
                }
            }
            if ($booException)
                throw new RuntimeException('O acesso ao serviço ' . $strService . ' da classe ' . $strClass . ' está restrito por IP.');
        }
    }

    protected function checkMethodOptions()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'OPTIONS') {
            header('Allow: POST');
            return self::getResult();
        }
        return false;
    }

    protected function getConfigIp()
    {
        $arrIp = self::getAttribute('arrIp');
        if (empty($arrIp)) {
            $arrConfig = $this->getService('Config');
            $mixIp = @$arrConfig['restServer']['security']['ip'];
            if (empty($mixIp))
                $arrIp = array();
            else
                $arrIp = (is_array($mixIp)) ? $mixIp : array($mixIp);
            self::$arrIp = $arrIp;
        }
        return $arrIp;
    }

    protected function obfuscateSecretKey($strSecretKey)
    {
        return (empty($strSecretKey)) ? false : base64_encode($this->getHashCse() . base64_encode($strSecretKey));
    }

    private function unobfuscateSecretKey($strSecretKeyObfuscated)
    {
        return (empty($strSecretKeyObfuscated)) ? false : base64_decode(substr(base64_decode($strSecretKeyObfuscated), strlen($this->getHashCse())));
    }

    private function getHashCse()
    {
        return strtoupper(hash(self::HASH_ALGO, self::getCse()));
    }

    private static function getCse()
    {
        return self::getAttribute('strCse', self::CSE);
    }

    private static function getAttribute($strAttributeName = null, $strAttributeDefaultValue = null)
    {
        if (empty($strAttributeName))
            return;
        if ((empty(self::$$strAttributeName)) && (!empty($strAttributeDefaultValue)))
            self::$$strAttributeName = $strAttributeDefaultValue;
        return self::$$strAttributeName;
    }

    private function headerUnauthorized($strMessage = null)
    {
        header('WWW-Authenticate: Basic realm="Inep Authenticate"');
        header('HTTP/1.0 401 Unauthorized');
        exit(json_encode(self::getResult('unauthorized', (empty($strMessage)) ? 'Não autorizado' : $strMessage)));
    }

}
