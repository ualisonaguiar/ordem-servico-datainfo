<?php

namespace InepZend\WebService\Client;

use InepZend\Util\ArrayCollection;

class Soap extends AbstractWebService
{

    public static function getUrlWsdl($strClass = null, $strUrlWsdl = null)
    {
        return self::getUrl($strClass, $strUrlWsdl, 'URL_WSDL');
    }

    protected function getClient($strClass = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($strClass)) {
            $strError = 'Classe não definida.';
            $this->debugExecFile($strError, $booDebug);
            return $strError;
        }
        if ((empty(self::$arrClient[$strClass])) || (!empty($strUrlWsdl))) {
            $strError = null;
            try {
                $strUrlWsdl = self::getUrlWsdl($strClass, $strUrlWsdl);
                $this->debugExecFile($strClass, $booDebug);
                $this->debugExecFile($strUrlWsdl, $booDebug);
                if (empty($strUrlWsdl))
                    $strError = 'WSDL não definido.';
                else {
                    $arrOption = array(
                        'cache_wsdl' => WSDL_CACHE_NONE,
                        'trace' => 1,
//                        'soap_version' => SOAP_1_2, 
                    );
                    $strProxyHost = @$GLOBALS['proxyConfig']['proxyHost'];
                    $strProxyPort = @$GLOBALS['proxyConfig']['proxyPort'];
                    if (!empty($strProxyHost))
                        $arrOption['proxy_host'] = $strProxyHost;
                    if (!empty($strProxyPort))
                        $arrOption['proxy_port'] = $strProxyPort;
                    $strClass = 'InepZend\WebService\Client\Soap\Client';
                    if (stripos($strUrlWsdl, 'https://') !== false) {
                        $strClass .= 'Curl';
                        $arrContext = stream_context_create(array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => false,
                            ),
                        ));
                        $arrOption['stream_context'] = $arrContext;
                    }
                    $soapClient = new $strClass($strUrlWsdl, $arrOption);
                    $this->setRequestLastUrl($strUrlWsdl);
                    $this->debugExecFile($soapClient, $booDebug);
                    $this->debugExecFile($soapClient->__getTypes(), $booDebug);
                }
            } catch (\Exception $exception) {
                $strError = $exception->getMessage();
            }
            if ((empty($strError)) && (is_object($soapClient)) && (empty($soapClient->_soap_version)))
                $strError = 'Instância com problemas.';
            if (!empty($strError)) {
                $strError = 'Falha ao conectar ao servidor do WS! ' . $strError;
                $this->debugExecFile($strError, $booDebug);
                return $strError;
            }
            self::$arrClient[$strClass] = $soapClient;
        }
        return self::$arrClient[$strClass];
    }

    public function runService($strClass = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($strClass))
            $strClass = get_class($this);
        if (empty($strMethod))
            return self::MSG_PARAM_NOT_FOUND;
        $soapClient = $this->getClient($strClass, $strUrlWsdl, $booDebug);
        if (!is_object($soapClient))
            return $soapClient;
        $arrAllParam = func_get_args();
        if (array_key_exists(0, $arrAllParam))
            unset($arrAllParam[0]);
        if (array_key_exists(1, $arrAllParam))
            unset($arrAllParam[1]);
        if (array_key_exists(2, $arrAllParam))
            unset($arrAllParam[2]);
        if (array_key_exists(3, $arrAllParam))
            unset($arrAllParam[3]);
        $arrParam = array();
        foreach ($arrAllParam as $mixValueParam) {
            if (is_array($mixValueParam))
                $arrParam = $mixValueParam;
            else
                $arrParam[] = $mixValueParam;
        }
        $this->debugExecFile($strMethod, $booDebug);
        $this->debugExecFile($arrParam, $booDebug);
        try {
            $strParam = '';
            $intParam = 0;
            foreach ($arrParam as $mixKey => $mixParam) {
                if ($intParam != 0)
                    $strParam .= ', ';
                $strParam .= '$arrParam["' . $mixKey . '"]';
                ++$intParam;
            }
            $strEval = '$mixResult = $soapClient->' . $strMethod . '(' . $strParam . ');';
            $this->debugExecFile($strEval, $booDebug);
            @eval($strEval);
            $this->debugExecFile($soapClient->__getLastRequest(), $booDebug);
            $this->debugExecFile($soapClient->__getLastResponse(), $booDebug);
            $this->debugExecFile($mixResult, $booDebug);
            $mixResult = (empty($mixResult)) ? array() : ((is_string($mixResult)) ? ArrayCollection::convertXmlToArray('/*', $mixResult) : $mixResult);
            $this->debugExecFile($mixResult, $booDebug);
            $this->setAllInfo($soapClient->__getLastRequest(), $soapClient->__getLastResponse(), self::RESPONSE_LAST_STATUS_OK, $mixResult);
            return $mixResult;
        } catch (\Exception $exception) {
            return $this->setExceptionInfo($exception, $booDebug, $soapClient);
        }
    }

    private function setExceptionInfo($exception, $booDebug, $soapClient)
    {
        if ((!is_object($exception)) || (!is_object($soapClient)))
            return false;
        $strError = 'Falha ao acionar o serviço do WS! ' . $exception->getMessage();
        $this->debugExecFile($soapClient->__getLastRequest(), $booDebug);
        $this->debugExecFile($strError, $booDebug);
        $this->setAllInfo($soapClient->__getLastRequest(), $soapClient->__getLastResponse(), self::RESPONSE_LAST_STATUS_ERROR, null, $strError);
        return $strError;
    }

}
