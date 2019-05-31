<?php

namespace InepZend\Util;

use InepZend\Util\Server;
use InepZend\Util\String;

/**
 *
 * @package InepZend
 * @subpackage Util
 */
class ApplicationProperties
{

    const FILE_PATH = '/application.properties';
    
    private static $arrAutoloadConfig;

    public static function get($strProperty = null, $strPath = null)
    {
        $mixResult = array();
        if (empty($strPath))
            $strPath = self::getFilePath();
        if (is_file($strPath)) {
            $arrContent = file($strPath);
            foreach ($arrContent as $strLine) {
                $strLine = trim(str_replace(' ', '', $strLine));
                if (($intPos = strpos($strLine, '=')) === false)
                    continue;
                if ((!empty($strLine)) && (in_array($strLine{0}, array('#', ';', '/', '-'))))
                    continue;
                $arrLine = array(substr($strLine, 0, $intPos), substr($strLine, $intPos + 1));
                if ((empty($strProperty)) || ((isset($arrProperty)) && (!is_null(@$arrProperty[$strProperty])))) {
                    $arrProperty = array();
                    $arrPropertyLine = explode('.', $arrLine[0]);
                    krsort($arrPropertyLine);
                    foreach ($arrPropertyLine as $strProperty) {
                        if (empty($arrProperty))
                            $arrProperty[$strProperty] = (is_numeric($arrLine[1])) ? (integer) $arrLine[1] : $arrLine[1];
                        else {
                            $arrProperty[$strProperty] = $arrProperty;
                            foreach ($arrProperty as $strPropertyIntern => $mixValue) {
                                if ($strProperty == $strPropertyIntern)
                                    continue;
                                unset($arrProperty[$strPropertyIntern]);
                            }
                        }
                    }
                    $mixResult = array_merge_recursive($mixResult, $arrProperty);
                } elseif ($arrLine[0] == $strProperty) {
                    $mixResult = (is_numeric($arrLine[1])) ? (integer) $arrLine[1] : $arrLine[1];
                    break;
                }
            }
        }
        return $mixResult;
    }

    public static function getAutoloadConfigHost($strPath = null)
    {
        $strHost = self::get('application.host', $strPath);
        if (!empty($strHost)) {
            $intPort = self::get('application.port', $strPath);
            if (empty($intPort))
                $intPort = 80;
            $strHost .= ':' . $intPort . '/';
            $strHost = substr(str_replace(':80/', '/', $strHost), 0, -1);
        }
        return $strHost;
    }

    public static function getAutoloadConfig($strPath = null)
    {
        if (empty(self::$arrAutoloadConfig)) {
            $arrAutoloadConfig = array();
            $arrProperties = self::get(null, $strPath);
            self::getAutoloadConfigCache($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigDb($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigLog($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigOAuth($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigProxy($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigPhpIni($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigSsi($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigTrocaArquivo($arrAutoloadConfig, $arrProperties);
            self::getAutoloadConfigExecutor($arrAutoloadConfig, $arrProperties);
            self::$arrAutoloadConfig = $arrAutoloadConfig;
        }
        return self::$arrAutoloadConfig;
    }

    private static function getAutoloadConfigCache(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('cache', (array) $arrProperties)) && (is_array($arrProperties['cache']))) {
            $strDriver = @$arrProperties['cache']['driver'];
            if ((empty($strDriver)) || (stripos($strDriver, 'memcache') !== false)) {
                $arrServer = array();
                foreach ($arrProperties['cache'] as $strKey => $mixValue) {
                    if (stripos($strKey, 'instance') === false)
                        continue;
                    $arrServer[] = $mixValue;
                }
                if (!empty($arrServer))
                    $arrAutoloadConfig['cache']['memcache']['options']['servers'] = $arrServer;
            }
        }
    }

    private static function getAutoloadConfigDb(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('db', (array) $arrProperties)) && (is_array($arrProperties['db']))) {
            if (array_key_exists('driver', $arrProperties['db'])) {
                $strDriver = $arrProperties['db']['driver'];
                if (!empty($strDriver))
                    $arrAutoloadConfig['doctrine']['connection']['orm_default']['driverClass'] = $strDriver;
            }
            if (array_key_exists('charset', $arrProperties['db'])) {
                $strCharset = $arrProperties['db']['charset'];
                if (!empty($strCharset)) {
                    $arrAutoloadConfig['doctrine']['connection']['orm_default']['params']['driverOptions'][1002] = "SET NAMES '" . $strCharset . "'";
                    $arrAutoloadConfig['doctrine']['connection']['orm_default']['params']['charset'] = strtolower(str_replace('-', '', $strCharset));
                }
            }
            if (array_key_exists('proxy', $arrProperties['db'])) {
                $mixAutoGenerate = @$arrProperties['db']['proxy']['auto_generate'];
                if (!is_null($mixAutoGenerate))
                    $arrAutoloadConfig['doctrine']['proxy']['auto_generate'] = $mixAutoGenerate;
            }
            foreach ($arrProperties['db'] as $strKey => $mixValue) {
                if ((stripos($strKey, 'driver') !== false) || (stripos($strKey, 'charset') !== false) || (stripos($strKey, 'proxy') !== false))
                    continue;
                if (strtolower($strKey) == 'pooled')
                    $mixValue = (boolean) $mixValue;
                $arrAutoloadConfig['doctrine']['connection']['orm_default']['params'][$strKey] = $mixValue;
            }
        }
    }

    private static function getAutoloadConfigLog(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('log', (array) $arrProperties)) && (is_array($arrProperties['log']))) {
            foreach ($arrProperties['log'] as $strKey => $mixValue) {
                if (strtolower($strKey) == 'reserved_variables')
                    $arrAutoloadConfig['logEvent']['reservedVariables'] = ((boolean) $mixValue === true) ? array('_GET', '_POST', '_SERVER["REQUEST_URI"]') : array();
                else
                    $arrAutoloadConfig['logEvent']['options'][lcfirst(String::camelize($strKey))] = (boolean) $mixValue;
            }
        }
	$memcache = new \Memcache();
        $host = 'localhost';
        if ((array_key_exists('cache', (array) $arrProperties)) &&
            (is_array($arrProperties['cache'])) &&
            (array_key_exists('instance0', (array) $arrProperties['cache']))) {
            $host = $arrProperties['cache']['instance0']['host'];
        }
        $memcache->connect($host, 11211);
        $arrLevel = [
            'error' => ['errorHandler'], 
            'persistence' => ['persistence'],
            'trace' => ['trace'],
            'full' => ['errorHandler', 'persistence', 'trace'],
        ];
        foreach ($arrLevel as $strLevel => $arrKey) {
            foreach ($arrKey as $strKey)
                if ($memcache->get('log.' . $strLevel) !== false)
                    $arrAutoloadConfig['logEvent']['options'][$strKey] = ($memcache->get('log.' . $strLevel) == 'enable');            
        }
    }

    private static function getAutoloadConfigOAuth(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if (is_array(@$arrProperties['oauth'])) {
            $arrOAuth = (array) @$arrProperties['oauth'];
            $arrKey = array(
                'enable' => 0,
                'consumer_key' => 1,
                'consumer_secret' => 2,
                'callback' => 3,
                'proxy_host' => 4,
                'proxy_port' => 5,
            );
            foreach ($arrOAuth as $strOAuthVersion => $arrApi) {
                foreach ($arrApi as $strApi => $arrParam) {
                    $arrParamNew = array();
                    foreach ($arrParam as $strParam => $mixValue)
                        $arrParamNew[$arrKey[$strParam]] = $mixValue;
                    ksort($arrParamNew);
                    $arrOAuth[$strOAuthVersion][$strApi] = $arrParamNew;
                }
            }
            $arrAutoloadConfig = array_merge($arrAutoloadConfig, constructConfigOAuth($arrOAuth));
        }
    }

    private static function getAutoloadConfigProxy(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('proxy', (array) $arrProperties)) && (is_array($arrProperties['proxy'])))
            foreach ($arrProperties['proxy'] as $strKey => $mixValue)
                $arrAutoloadConfig['proxy']['params']['proxy' . ucfirst($strKey)] = $mixValue;
    }

    private static function getAutoloadConfigPhpIni(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('phpini', (array) $arrProperties)) && (is_array($arrProperties['phpini'])))
            $arrAutoloadConfig['phpini'] = array_merge_recursive((array) @$arrAutoloadConfig['phpini'], $arrProperties['phpini']);
    }

    private static function getAutoloadConfigSsi(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('ssi', (array) $arrProperties)) && (is_array($arrProperties['ssi'])))
            foreach ($arrProperties['ssi'] as $strKey => $mixValue)
                $arrAutoloadConfig['authServiceAdapter']['paramHeaderRequest'][str_replace('_', '-', $strKey)] = $mixValue;
    }

    private static function getAutoloadConfigTrocaArquivo(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('troca_arquivo', (array) $arrProperties)) && (is_array($arrProperties['troca_arquivo'])))
            $arrAutoloadConfig['troca_arquivo'] = array_merge_recursive((array) @$arrAutoloadConfig['troca_arquivo'], $arrProperties['troca_arquivo']);
    }

    private static function getAutoloadConfigExecutor(&$arrAutoloadConfig = null, $arrProperties = null)
    {
        if ((array_key_exists('executor', (array) $arrProperties)) && (is_array($arrProperties['executor']))) {
            if ((array_key_exists('email', (array) $arrProperties['executor'])) && (is_array($arrProperties['executor']['email']))) {
                $strDestinatario = @$arrProperties['executor']['email']['destinatario'];
                $strDestinatarioCopia = @$arrProperties['executor']['email']['destinatario_copia'];
                $strAssunto = @$arrProperties['executor']['email']['assunto'];
                $strTexto = @$arrProperties['executor']['email']['texto'];
                if (!empty($strDestinatario))
                    $arrAutoloadConfig['executor']['configuracao-envio-email']['dsDestinatario'] = $strDestinatario;
                if (!empty($strDestinatarioCopia))
                    $arrAutoloadConfig['executor']['configuracao-envio-email']['dsDestinatarioCopia'] = $strDestinatarioCopia;
                if (!empty($strAssunto))
                    $arrAutoloadConfig['executor']['configuracao-envio-email']['dsAssunto'] = $strAssunto;
                if (!empty($strTexto))
                    $arrAutoloadConfig['executor']['configuracao-envio-email']['dsTexto'] = $strTexto;
            }
        }
    }

    private static function getFilePath()
    {
        return Server::getReplacedBasePathApplication(self::FILE_PATH);
    }

}
