<?php

namespace InepZend\WebService\Client;

use InepZend\Util\Format;
use Zend\Http\Client as HttpClient;
use Zend\Http\Headers;
use Zend\Uri\Http as UriHttp;
use InepZend\Util\Curl;

class Rest extends AbstractWebService
{

    protected function getClient($strClass = null, $strMethod = null, $strUrl = null, $strDataMethod = 'POST', $booDebug = null, $arrOption = null)
    {
        if (empty($strClass)) {
            $strError = 'Classe não definida.';
            $this->debugExecFile($strError, $booDebug);
            return $strError;
        }
        if ((empty(self::$arrClient[$strClass])) || (!empty($strUrl))) {
            $strError = null;
            try {
                $strUrl = self::getUrl($strClass, $strUrl);
                if (!empty($strMethod))
                    $strUrl .= $strMethod;
                $this->debugExecFile($strClass, $booDebug);
                $this->debugExecFile($strUrl, $booDebug);
                if (empty($strUrl))
                    $strError = 'URL não definida.';
                else {
                    if (empty($strDataMethod))
                        $strDataMethod = 'POST';
                    $restClient = new HttpClient(null, $arrOption);
                    $restClient->setMethod($strDataMethod);
                    $restClient->setUri(new UriHttp($strUrl));
                    $this->setRequestLastUrl($strUrl);
                    $this->debugExecFile($restClient, $booDebug);
                }
            } catch (\Exception $exception) {
                $strError = $exception->getMessage();
            }
            if (!empty($strError)) {
                $strError = 'Falha ao conectar ao servidor do WS! ' . $strError;
                $this->debugExecFile($strError, $booDebug);
                return $strError;
            }
            self::$arrClient[$strClass] = $restClient;
        }
        return self::$arrClient[$strClass];
    }

    public function runService($strClass = null, $strMethod = null, $mixParam = array(), $strUrl = null, array $arrHeader = array(), $strDataMethod = 'POST', $booDebug = null, $booConvertResult = null, $arrOption = null, $arrCookie = null, $booCurl = null, $booRequestBody = null)
    {
        set_time_limit(-1);
        if (empty($strClass))
            $strClass = get_class($this);
        if (empty($strDataMethod))
            $strDataMethod = 'POST';
        $restClient = $this->getClient($strClass, $strMethod, $strUrl, $strDataMethod, $booDebug);
        if (!is_object($restClient))
            return $restClient;
        if ((stripos($restClient->getUri()->getScheme(), 'https') !== false) || ($booCurl === true)) {
            $arrConfigMerge = array();
            if ((is_array($arrOption)) && (array_key_exists('timeout', $arrOption)))
                $arrConfigMerge['timeout'] = $arrOption['timeout'];
            if ((is_array($arrOption)) && (array_key_exists('curloptions', $arrOption)))
                $arrConfigMerge['curloptions'] = $arrOption['curloptions'];
            Curl::setAdapter($restClient, $arrConfigMerge);
            $this->debugExecFile($restClient, $booDebug);
            $booCurl = true;
        }
        $headers = new Headers();
        if ((is_array($arrHeader)) && (count($arrHeader) > 0)) {
            foreach ((array) $arrHeader as $mixKey => $mixValue) {
                if (is_numeric($mixKey))
                    $headers->addHeaderLine($mixValue);
                else
                    $headers->addHeaderLine($mixKey, $mixValue);
            }
        }
        if (strpos($strClass, 'SsiRest') !== false) {
            if ((!is_array($arrHeader)) || (!array_key_exists('tipo-ambiente', (array) $arrHeader)))
                $headers->addHeaderLine('tipo-ambiente', 'local');
            if ((!is_array($arrHeader)) || (!array_key_exists('url-ambiente', (array) $arrHeader)))
                $headers->addHeaderLine('url-ambiente', 'http://' . ((@$_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost'));
            if ($this->hasIdentity()) {
                $restClient->setAuth($this->getUser()->cpf, 'secret');
                $this->debugExecFile($this->getUser()->cpf, $booDebug);
            }
        }
        $restClient->setHeaders($headers);
        if (!empty($mixParam)) {
            if ((is_array($mixParam)) && (in_array(strtoupper($strDataMethod), array('POST', 'GET')))) {
                $strMethodSetParameter = 'setParameter' . ucfirst($strDataMethod);
                $restClient->$strMethodSetParameter($mixParam);
            } elseif (!is_array($mixParam))
                $restClient->setRawBody($mixParam);
        }
        if (!empty($arrOption)) {
            if ($booCurl !== true) {
                unset($arrOption['curloptions']);
                if ((array_key_exists('adapter', $arrOption)) && (strpos($arrOption['adapter'], 'Curl') !== false))
                    unset($arrOption['adapter']);
            }
            $restClient->setOptions($arrOption);
            $this->debugExecFile($arrOption, $booDebug);
        }
        if (!empty($arrCookie)) {
            $restClient->setCookies($arrCookie);
            $this->debugExecFile($arrCookie, $booDebug);
        }
        $this->debugExecFile($strMethod, $booDebug);
        $this->debugExecFile($mixParam, $booDebug);
        $this->debugExecFile($restClient->getRequest()->getHeaders(), $booDebug);
        $this->debugExecFile($restClient, $booDebug);
        try {
            $response = $restClient->send();
            $this->debugExecFile($response, $booDebug);
            $this->debugExecFile($response->getContent(), $booDebug);
            $this->debugExecFile($response->getHeaders(), $booDebug);
            if ($booRequestBody) {
                $mixResult = $response->getBody();
                if (Format::isJson($mixResult)) {
                    $mixResult = json_decode($mixResult, true);
                }
                return $mixResult;
            }
            $mixContent = $response->getContent();
            $headerContentEncoding = $response->getHeaders()->get('Content-Encoding');
            if ((is_object($headerContentEncoding)) && ($headerContentEncoding->getFieldValue() == 'gzip')) {
                if (function_exists('gzdecode')) {
                    try {
                        $mixContent = @gzdecode($this->editContent($mixContent, false));
                    } catch (\Exception $exception) {
                        
                    }
                }
            }
            $this->debugExecFile($mixContent, $booDebug);
            $mixResult = (!empty($mixContent)) ? $this->editContent($mixContent, $booConvertResult) : null;
            if (empty($mixResult))
                $mixResult = $response->getBody();
            $this->debugExecFile($mixResult, $booDebug);
            if ($response->isOk()) {
                $mixResult = (is_string($mixResult)) ? trim($mixResult) : $mixResult;
                $this->setAllInfo($restClient->getRequest(), $restClient->getResponse(), self::RESPONSE_LAST_STATUS_OK, $mixResult);
                return $mixResult;
            }
            $strError = (empty($mixResult)) ? 'Não foi possível realizar a operação: ERRO ' . $response->getStatusCode() : $mixResult;
            $this->debugExecFile($strError, $booDebug);
            $this->setAllInfo($restClient->getRequest(), $restClient->getResponse(), self::RESPONSE_LAST_STATUS_ERROR, null, $strError);
            return $strError;
        } catch (\Exception $exception) {
            return $this->setExceptionInfo($exception, $booDebug, $restClient);
        }
    }

    private function setExceptionInfo($exception, $booDebug, $restClient)
    {
        if ((!is_object($exception)) || (!is_object($restClient)))
            return false;
        $strError = 'Falha ao acionar o serviço do WS! ' . $exception->getMessage();
        $this->debugExecFile($strError, $booDebug);
        $this->setAllInfo($restClient->getRequest(), $restClient->getResponse(), self::RESPONSE_LAST_STATUS_ERROR, null, $strError);
        return $strError;
    }

}
