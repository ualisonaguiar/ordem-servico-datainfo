<?php

namespace InepZend\Util;

/**
 * Classe responsavel ao acesso a host e url.
 *
 * @package InepZend
 * @subpackage Util
 */
class Uri
{

    /**
     * Metodo responsavel em executar determinada URL, apresentando seu retorno.
     *
     * @example \InepZend\Util\Uri::execUrl('demandas.inep.gov.br') <br /> \InepZend\Util\Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php') <br /> \InepZend\Util\Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php', null, null, null, 'POST', 'usucpf=123.456.789-10&usuemail=teste@inep.gov.br')
     *
     * @param string $strHost
     * @param string $strSubHost
     * @param string $strQuerystring
     * @param integer $intPort
     * @param integer $intTimeout
     * @param string $strMethod
     * @param string $strQuerystringWithMethodPost
     * @param boolean $booAsync
     * @return mix
     */
    public static function execUrl($strHost, $strSubHost = '', $strQuerystring = '', $intPort = 80, $intTimeout = 60, $strMethod = 'GET', $strQuerystringWithMethodPost = '', $booAsync = false)
    {
        if (empty($strHost))
            return 'Informe o HOST';
        if (empty($strSubHost))
            $strSubHost = '/';
        if (empty($strQuerystring))
            $strQuerystring = '';
        if (empty($intPort))
            $intPort = 80;
        if (empty($intTimeout))
            $intTimeout = 60;
        if (empty($strMethod))
            $strMethod = 'GET';
        $strHost = str_replace(array('http://', 'https://'), '', $strHost);
        if ($strHost{(strlen($strHost) - 1)} == '/')
            $strHost = substr($strHost, 0, (strlen($strHost) - 1));
        if ($strSubHost{0} != '/')
            $strSubHost = '/' . $strSubHost;
        if ((strtoupper($strMethod) == 'GET') && (!empty($strQuerystring)) && ($strQuerystring{0} != '?') && (strpos($strQuerystring, '=') !== false))
            $strQuerystring = '?' . $strQuerystring;
        if (!$hanSock = fsockopen($strHost, $intPort, $strError, $intError, $intTimeout))
            return 'Erro: ' . $strError . ' (' . $intError . ')';
        $strPostParam = '';
        $strSubHostQuerystring = $strSubHost . $strQuerystring;
        if (strtoupper($strMethod) == 'POST') {
            $strPostParam = "Content-type: application/x-www-form-urlencoded\r\n" .
                    'Content-length: ' . strlen(str_replace($strQuerystringWithMethodPost, '', $strQuerystring)) . "\r\n";
            $strSubHostQuerystring = $strSubHost;
            if (!empty($strQuerystringWithMethodPost)) {
                if ($strQuerystringWithMethodPost{ 0 } != '?')
                    $strQuerystringWithMethodPost = '?' . $strQuerystringWithMethodPost;
                $strSubHostQuerystring .= $strQuerystringWithMethodPost;
                if ($strSubHostQuerystring{ strlen($strSubHostQuerystring) - 1 } == '&')
                    $strSubHostQuerystring = substr($strSubHostQuerystring, 0, (strlen($strSubHostQuerystring) - 1));
            }
        }
        if (stripos($strHost, 'ssl://') === false) {
            $strParam = strtoupper($strMethod) . ' ' . $strSubHostQuerystring . " HTTP/1.1\r\n" .
                    'Host: ' . $strHost . "\r\n";
        } else {
//            $strParam =
//              strtoupper($strMethod) . ' ' . $strSubHostQuerystring . " HTTP/1.0 301 Moved Permanently\r\n" .
//              "Cache-Control: private, max-age=86400\r\n
//              X-Content-Type-Options: nosniff\r\n
//              X-XSS-Protection: 1; mode=block\r\n
//              X-Forwarded-Proto: https\r\n";
            $strParam = strtoupper($strMethod) . ' ' . $strSubHostQuerystring . " HTTP/1.0 301 Moved Permanently\r\n" .
                    "Cache-Control: private, max-age=86400\r\n";
        }
        $strParam .= $strPostParam .
                "Connection: Close\r\n\r\n";
        if (strtoupper($strMethod) == 'POST')
            $strParam .= str_replace('?', '', str_replace($strQuerystringWithMethodPost, '', ((!empty($strQuerystringWithMethodPost)) ? '?' . $strQuerystring : $strQuerystring))) . "\r\n\r\n";
        fwrite($hanSock, $strParam);
        $strReturn = '';
        if (!$booAsync)
            while (!feof($hanSock))
                $strReturn .= fgets($hanSock);
        fclose($hanSock);
        return $strReturn;
    }

    /**
     * Metodo responsavel em acessar determinada url e retorna seu conteudo.
     *
     * @example \InepZend\Util\Uri::getBinaryContent('portal.inep.gov.br') <br /> \InepZend\Util\Uri::getBinaryContent('portal.inep.gov.br', 'data/testeUnit/portal.html')
     *
     * @param string $strUrl
     * @param string $strSaveTo
     * @param string $strProxyHost
     * @param string $strProxyPort
     * @return mix
     */
    public static function getBinaryContent($strUrl = null, $strSaveTo = null, $strProxyHost = null, $strProxyPort = null)
    {
        if (empty($strProxyHost)) {
            $arrConfig = self::getProxyConfig();
            if (array_key_exists('proxyHost', $arrConfig))
                $strProxyHost = $arrConfig['proxyHost'];
            if (array_key_exists('proxyPort', $arrConfig))
                $strProxyPort = $arrConfig['proxyPort'];
        }
        $mixCurlResult = Curl::getCurl($strUrl, null, null, array(CURLOPT_HEADER => 0, CURLOPT_BINARYTRANSFER => 1), null, '', array('proxyHost' => $strProxyHost, 'proxyPort' => $strProxyPort));
        if (!is_array($mixCurlResult))
            return false;
        $mixOutput = $mixCurlResult[0];
        $mixCurlError = $mixCurlResult[1];
        if (!empty($mixCurlError))
            return false;
        if (!empty($strSaveTo)) {
            if (file_exists($strSaveTo))
                unlink($strSaveTo);
            else {
                $strPathTo = substr($strSaveTo, 0, strrpos(str_replace('\\', '/', $strSaveTo), '/'));
                if (!is_dir($strPathTo))
                    mkdir($strPathTo, 0777, true);
            }
            $hanFile = fopen($strSaveTo, 'x');
            fwrite($hanFile, $mixOutput);
            fclose($hanFile);
            return true;
        }
        return $mixOutput;
    }

    /**
     * Metodo responsavel pelo retorno das configuracoes do proxy.
     *
     * @example \InepZend\Util\Uri::getProxyConfig()
     *
     * @return array
     */
    public static function getProxyConfig()
    {
        return ((array_key_exists('proxyConfig', $GLOBALS)) && (is_array($GLOBALS['proxyConfig'])) && (count($GLOBALS['proxyConfig']) > 0)) ? $GLOBALS['proxyConfig'] : array();
    }

}
