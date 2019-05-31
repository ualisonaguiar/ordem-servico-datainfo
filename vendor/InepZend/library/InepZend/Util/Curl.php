<?php

namespace InepZend\Util;

use Zend\Http\Client\Adapter\Curl as CurlAdapter;
use InepZend\Util\Uri;
use InepZend\Util\ArrayCollection;
use InepZend\Util\PhpIni;
use InepZend\Util\DebugExec;

class Curl
{

    use DebugExec;

    const DEBUG = false;

    /**
     * Metodo responsavel em enviar requisicoes utilizando a biblioteca cUrl.
     *
     * @example \InepZend\Util\Curl::getCurl($strUrl, $mixParam, $strMethod, $arrCurlOption, $booExec, $strAcceptHttpHeader, $arrConfig, $arrHeader, $arrCookie);
     *
     * @param string $strUrl
     * @param mix $mixParam
     * @param string $strMethod
     * @param array $arrCurlOption
     * @param boolean $booExec
     * @param string $strAcceptHttpHeader
     * @param array $arrConfig
     * @param array $arrHeader
     * @param array $arrCookie
     * @return mix
     */
    public static function getCurl($strUrl = null, $mixParam = null, $strMethod = null, $arrCurlOption = null, $booExec = null, $strAcceptHttpHeader = null, $arrConfig = null, $arrHeader = null, $arrCookie = null)
    {
        $curlDebug = new self;
        $curlDebug->debugExecFile($strUrl, self::DEBUG);
        if (empty($strUrl))
            return false;
        if (empty($strMethod))
            $strMethod = 'GET';
        if (!is_bool($booExec))
            $booExec = true;
        if (is_null($strAcceptHttpHeader))
            $strAcceptHttpHeader = 'application/json';
        $arrParam = array();
        $strParam = null;
        if (!empty($mixParam)) {
            if (is_array($mixParam)) {
                $arrParam = $mixParam;
                $strParam = http_build_query($mixParam);
            } else {
                $arrParam = explode('&', $mixParam);
                $strParam = $mixParam;
            }
            $strParam = trim($strParam);
        }
        if ((!empty($strParam)) && ($strMethod === 'GET')) {
            $strSymbol = '?';
            if ($strUrl{strlen($strUrl) - 1} == '/')
                $strSymbol = '';
            elseif (strpos($strUrl, '?') !== false)
                $strSymbol = '&';
            $strUrl .= $strSymbol . $strParam;
        }
        $curlDebug->debugExecFile($strUrl, self::DEBUG);
        $curlDebug->debugExecFile($arrParam, self::DEBUG);
        $curlDebug->debugExecFile($strParam, self::DEBUG);
        $curlDebug->debugExecFile($strMethod, self::DEBUG);
        $curlDebug->debugExecFile($arrCurlOption, self::DEBUG);
        $curlDebug->debugExecFile($booExec, self::DEBUG);
        $curlDebug->debugExecFile($strAcceptHttpHeader, self::DEBUG);
        $curlDebug->debugExecFile($arrConfig, self::DEBUG);
        $curlDebug->debugExecFile($arrHeader, self::DEBUG);
        $curlDebug->debugExecFile($arrCookie, self::DEBUG);
        $curl = curl_init();
        $arrOptionToHttpClient = self::getOptionToHttpClient($arrConfig, array('curloptions' => (array) $arrCurlOption));
        $curlDebug->debugExecFile($arrOptionToHttpClient, self::DEBUG);
        if (array_key_exists('curloptions', $arrOptionToHttpClient)) {
            foreach ($arrOptionToHttpClient['curloptions'] as $mixOptionName => $mixOptionValue)
                curl_setopt($curl, $mixOptionName, $mixOptionValue);
        }
        curl_setopt($curl, CURLOPT_URL, $strUrl);
        if ((is_array($arrHeader)) && (!empty($arrHeader)))
            curl_setopt($curl, CURLOPT_HTTPHEADER, $arrHeader);
        elseif (!empty($strAcceptHttpHeader))
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: ' . $strAcceptHttpHeader));
        if ((is_array($arrCookie)) && (!empty($arrCookie))) {
            $strCookie = '';
            foreach ($arrCookie as $strCookieName => $mixCookieValue)
                $strCookie .= $strCookieName . '=' . $mixCookieValue . '; ';
            curl_setopt($curl, CURLOPT_COOKIE, $strCookie);
        }
        if ($strMethod === 'POST') {
            curl_setopt($curl, CURLOPT_POST, count($arrParam));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $strParam);
        } elseif (in_array($strMethod, array('DELETE', 'PUT'))) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $strParam);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $strMethod);
        } elseif ($strMethod !== 'GET')
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $strMethod);
        if (is_array($arrCurlOption)) {
            foreach ($arrCurlOption as $mixOptionName => $mixOptionValue)
                curl_setopt($curl, $mixOptionName, $mixOptionValue);
        }
        if (!$booExec)
            return $curl;
        $mixCurlError = '';
        PhpIni::setTimeLimit(60);
        $mixCurlContent = curl_exec($curl);
        $curlDebug->debugExecFile($mixCurlContent, self::DEBUG);
        if (!$mixCurlContent)
            $mixCurlError = curl_error($curl);
        curl_close($curl);
        $arrResult = array($mixCurlContent, $mixCurlError);
        $curlDebug->debugExecFile($arrResult, self::DEBUG);
        return $arrResult;
    }

    /**
     * Metodo responsavel em setar o objeto HttpClient referente ao \Zend\Http\Client.
     *
     * @example \InepZend\Util\Curl::setAdapter(new HttpClient(), array('timeout'));
     *
     * @param object $httpClient
     * @param array $arrConfigMerge
     * @return boolean
     */
    public static function setAdapter($httpClient = null, $arrConfigMerge = null)
    {
        if (!is_object($httpClient))
            return false;
        $adapter = new CurlAdapter();
        $adapter->setOptions(self::getOptionToHttpClient(null, $arrConfigMerge));
        $httpClient->setAdapter($adapter);
        return true;
    }

    /**
     * Metodo responsavel em retornar as opcoes do HttpCliente.
     *
     * @example \InepZend\Util\Curl::getOptionToHttpClient($arrConfig, $arrConfigMerge);
     *
     * @param array $arrConfig
     * @param array $arrConfigMerge
     * @return array
     */
    public static function getOptionToHttpClient($arrConfig = null, $arrConfigMerge = null)
    {
        $curlDebug = new self;
        $arrCurlOption = array();
        $arrOptionToHttpClient = array('adapter' => 'Zend\Http\Client\Adapter\Curl');
        if ((!is_array($arrConfig)) || (!array_key_exists('proxyHost', $arrConfig)) || (empty($arrConfig['proxyHost'])))
            $arrConfig = Uri::getProxyConfig();
        if ((is_array($arrConfig)) && (array_key_exists('proxyHost', $arrConfig)) && (!empty($arrConfig['proxyHost']))) {
            $arrCurlOption = array(
                CURLOPT_PROXY => $arrConfig['proxyHost'],
                CURLOPT_PROXYPORT => ((array_key_exists('proxyPort', $arrConfig)) && (!empty($arrConfig['proxyPort']))) ? $arrConfig['proxyPort'] : 8080,
                CURLOPT_HTTPPROXYTUNNEL => true,
                CURLOPT_PROXYAUTH => ((array_key_exists('proxyAuth', $arrConfig)) && (!empty($arrConfig['proxyAuth']))) ? $arrConfig['proxyAuth'] : CURLAUTH_BASIC,
            );
        }
        $arrCurlOption[CURLOPT_FOLLOWLOCATION] = true;
        $arrCurlOption[CURLOPT_RETURNTRANSFER] = true;
        $arrCurlOption[CURLOPT_SSL_VERIFYPEER] = false;
        $arrCurlOption[CURLOPT_TIMEOUT] = ((is_array($arrConfigMerge)) && (array_key_exists('timeout', $arrConfigMerge))) ? $arrConfigMerge['timeout'] : 10;
        $arrOptionToHttpClient['curloptions'] = $arrCurlOption;
        $arrOptionToHttpClient['sslverifypeer'] = false;
        if (is_array($arrConfigMerge)) {
            $curlDebug->debugExecFile($arrOptionToHttpClient, self::DEBUG);
            $arrOptionToHttpClient = ArrayCollection::merge($arrOptionToHttpClient, $arrConfigMerge, true);
            $curlDebug->debugExecFile($arrOptionToHttpClient, self::DEBUG);
        }
        $booTimeoutFloat = (is_float($arrCurlOption[CURLOPT_TIMEOUT]));
        if (($arrCurlOption[CURLOPT_TIMEOUT] <= 1) || ($booTimeoutFloat)) {
            $arrOptionToHttpClient['curloptions'][CURLOPT_FRESH_CONNECT] = true;
            if (($arrCurlOption[CURLOPT_TIMEOUT] < 1) || ($booTimeoutFloat)) {
                $arrOptionToHttpClient['curloptions'][CURLOPT_TIMEOUT_MS] = $arrCurlOption[CURLOPT_TIMEOUT] * 1000;
                $arrOptionToHttpClient['timeout'] = ($booTimeoutFloat) ? ceil($arrCurlOption[CURLOPT_TIMEOUT]) : 1;
                unset($arrOptionToHttpClient['curloptions'][CURLOPT_TIMEOUT]);
            }
        }
        $curlDebug->debugExecFile($arrOptionToHttpClient, self::DEBUG);
        return $arrOptionToHttpClient;
    }

}
