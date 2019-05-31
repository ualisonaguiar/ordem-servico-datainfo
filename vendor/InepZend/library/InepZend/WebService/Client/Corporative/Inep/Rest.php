<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Rest as RestClient;
use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Util\stdClass;

class Rest extends RestClient
{

    public function runService($strMethod = null, $mixParam = array(), $strUrl = null, array $arrHeader = array(), $strDataMethod = 'POST', $booDebug = null, $arrConfig = null, $booRequestBody = null)
    {
        if (empty($mixParam))
            $mixParam = array();
        if ((count($arrHeader) == 0) && (array_key_exists('authServiceAdapter', $GLOBALS))) {
            $strModule = ModuleConfig::getModuleFromTrace();
            if ((is_string($strModule)) && (!empty($strModule)) && (array_key_exists($strModule, $GLOBALS['authServiceAdapter'])) && (array_key_exists('paramHeaderRequest', $GLOBALS['authServiceAdapter'][$strModule])))
                $arrHeader = $GLOBALS['authServiceAdapter'][$strModule]['paramHeaderRequest'];
            elseif (array_key_exists('paramHeaderRequest', $GLOBALS['authServiceAdapter']))
                $arrHeader = $GLOBALS['authServiceAdapter']['paramHeaderRequest'];
        }
        if ((count($arrHeader) == 0) && (is_array($arrConfig)) && (array_key_exists('paramHeaderRequest', $arrConfig))) {
            $arrHeader = $arrConfig['paramHeaderRequest'];
            unset($arrConfig['paramHeaderRequest']);
        }
        $strClass = get_class($this);
        if ((is_array(self::$arrClient)) && (array_key_exists($strClass, self::$arrClient)))
            unset(self::$arrClient[$strClass]);
        if ((is_object($mixParam)) && ($mixParam instanceof stdClass)) {
            $mixParam = json_encode($mixParam);
            $arrHeader['Content-Type'] = 'application/json';
        }
        return parent::runService($strClass, $strMethod, $mixParam, $strUrl, $arrHeader, $strDataMethod, $booDebug, $arrConfig, null, null, null, $booRequestBody);
    }

}
