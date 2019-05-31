<?php

namespace InepZend\Module\WebService\Server\Rest\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\WebService\Client\Rest;
use InepZend\Util\Server;
use InepZend\Util\Format;
use InepZend\Util\ArrayCollection;

class RestClient extends AbstractServiceManager
{

    const DEBUG = Rest::DEBUG;

    private static $rest;

    public function runService($strClass = null, $strService = null, array $arrParam = array(), $strResource = null, $strUserSsi = null, $strPassSsi = null, $strUserPhpAuth = null, $strPassPhpAuth = null, $strHost = null, $arrOption = null, $booCurl = null, array $arrHeader = array(), $booDebug = null, $strDataMethod = 'POST', $booAddRest = true)
    {
        if ((empty($strClass)) || (empty($strService)))
            return false;
        $rest = self::getRest();
        if (empty($strUserPhpAuth))
            $strUserPhpAuth = 'InepAuthUser';
        if (empty($strPassPhpAuth))
            $strPassPhpAuth = 'InepAuthPass';
        $strUser = $strUserPhpAuth . ((empty($strUserSsi)) ? '' : '-' . $strUserSsi);
        $strPass = $strPassPhpAuth . ((empty($strPassSsi)) ? '' : '-' . $strPassSsi);
        if (empty($strHost))
            $strHost = Server::getHost();
        $strUrl = ($booAddRest) ? $strHost . 'rest' : $strHost;
        $arrParamNew = array(
            'url' => $strUrl,
            'class' => $strClass,
            'service' => $strService,
            'params' => $arrParam,
            'secret_key' => $this->getService('InepZend\Module\WebService\Server\Rest\Service\RestServer')->obfuscateSecretKey(microtime()),
            'resource' => $strResource,
        );
        if (@empty($arrHeader['Authorization']))
            $arrHeader['Authorization'] = 'Basic ' . base64_encode($strUser . ':' . $strPass);
        $mixResult = $rest->runService($strClass, null, $arrParamNew, $strUrl, $arrHeader, $strDataMethod, $booDebug, false, (array) $arrOption, null, $booCurl);
        return (Format::isJson(trim($mixResult))) ? json_decode(trim($mixResult)) : $mixResult;
    }

    /**
     * Metodo responsavel em realizar as chamadas assincronas de servicos.
     *
     * @param string $strClass
     * @param string $strService
     * @param array $arrParam
     * @param string $strResource
     * @param string $strUserSsi
     * @param string $strPassSsi
     * @param string $strUserPhpAuth
     * @param string $strPassPhpAuth
     * @param array $arrOption
     * @param boolean $booCurl
     * @return mix
     */
    protected function runServiceAsync($strClass = null, $strService = null, array $arrParam = array(), $strResource = null, $strUserSsi = null, $strPassSsi = null, $strUserPhpAuth = null, $strPassPhpAuth = null, $arrOption = null, $booCurl = null, $strHost = null)
    {
        if (empty($strService))
            return false;
        if (empty($strClass))
            $strClass = get_class($this);
        if (empty($strResource))
            $strResource = md5($strClass . '::' . $strService);
        $this->debugExecFile($strClass);
        $this->debugExecFile($strService);
        $this->debugExecFile($arrParam);
        $this->debugExecFile($strResource);
        $arrHeader = array();
        $arrOption = ArrayCollection::merge(array('timeout' => 1, 'httpversion' => '1.1'), (array) $arrOption, true);
        $this->debugExecFile($arrOption);
        $mixResult = $this->runService($strClass, $strService, $arrParam, $strResource, $strUserSsi, $strPassSsi, $strUserPhpAuth, $strPassPhpAuth, $strHost, $arrOption, $booCurl, $arrHeader);
        if ((is_string($mixResult)) && (stripos($mixResult, 'timed out after 1 second') !== false))
            $mixResult = true;
        $this->debugExecFile($mixResult);
        return $mixResult;
    }

    private static function setRest($rest)
    {
        return (self::$rest = $rest);
    }

    private static function getRest()
    {
        if (empty(self::$rest))
            self::$rest = new Rest();
        return self::$rest;
    }

}