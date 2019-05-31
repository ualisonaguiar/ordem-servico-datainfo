<?php

namespace InepZend\Util;

use InepZend\Util\Request;
use InepZend\Util\Environment;
use InepZend\Util\AttributeStaticTrait;

/**
 * Classe responsavel em realizar operacoes no servidor de aplicao.
 *
 * @package InepZend
 * @subpackage Util
 */
class Server
{

    use AttributeStaticTrait;

    /**
     * Metodo responsavel em retornar o nome do browser e a sua versao a partir 
     * da variavel $_SERVER['HTTP_USER_AGENT'] do servidor web.
     *
     * @example \InepZend\Util\Server::getBrowser()
     *
     * @return array
     */
    public static function getBrowser()
    {
        if (!is_null($mixAttributeStaticValue = self::getAttributeStatic('arrInfoBrowser')))
            return $mixAttributeStaticValue;
        $strUserAgent = @$_SERVER['HTTP_USER_AGENT'];
        $arrBrowser = array(
            'OPR' => array('Opera', 'OPR/([0-9\.]*)'),
            'Chrome' => array('Chrome', 'Chrome/(.*)\s'),
            'MSIE' => array('MSIE', 'MSIE\s([0-9\.]*)'),
            'Firefox' => array('Firefox', 'Firefox/([0-9\.]*)'),
            'Safari' => array('Safari', 'Version/([0-9\.]*)'),
        );
        $arrInfo = array('browser' => 'OTHER');
        foreach ($arrBrowser as $strNameBrowser => $arrInfoBrowser) {
            if (preg_match('@' . $strNameBrowser . '@i', $strUserAgent)) {
                $arrInfo['browser'] = ucfirst(strtolower($arrInfoBrowser[0]));
                preg_match('@' . $arrInfoBrowser[1] . '@i', $strUserAgent, $arrVersion);
                $arrInfo['version'] = $arrVersion[1];
                break;
            }
        }
        self::setAttributeStatic('arrInfoBrowser', $arrInfo);
        return $arrInfo;
    }

    /**
     * Metodo responsavel em retornar o IP do usuario.
     *
     * @example \InepZend\Util\Server::getIp()
     *
     * @param boolean $booReplace
     * @return string
     *
     * @TODO nao ha situacao que entre na terceira condicao
     */
    public static function getIp($booReplace = false)
    {
        if (!is_null($mixAttributeStaticValue = self::getAttributeStatic('strIpUser')))
            return ($booReplace === true) ? self::clearIp($mixAttributeStaticValue) : $mixAttributeStaticValue;
        $strIpUser = (array_key_exists('HTTP_NS_CLIENT_IP', $_SERVER)) ? $_SERVER['HTTP_NS_CLIENT_IP'] : null;
        if (empty($strIpUser)) {
            if (function_exists('apache_request_headers')) {
                $arrInfoHeader = apache_request_headers();
                $strIpUser = (array_key_exists('X-Forwarded-For', $arrInfoHeader)) ? $arrInfoHeader['X-Forwarded-For'] : null;
                if (empty($strIpUser))
                    $strIpUser = (array_key_exists('NS-Client-IP', $arrInfoHeader)) ? $arrInfoHeader['NS-Client-IP'] : null;
            }
        }
        if (empty($strIpUser))
            $strIpUser = (array_key_exists('REMOTE_ADDR', $_SERVER)) ? $_SERVER['REMOTE_ADDR'] : null;
        $strIpUser = str_replace(' ', '', $strIpUser);
        if (strpos($strIpUser, ',') !== false)
            $strIpUser = reset($arrExplode = explode(',', $strIpUser));
        if ((empty($strIpUser)) && (self::isPhpUnit()))
            $strIpUser = Environment::IP_LOCAL;
        self::setAttributeStatic('strIpUser', $strIpUser);
        return ($booReplace === true) ? self::clearIp($strIpUser) : $strIpUser;
    }

    /**
     * Metodo responsavel em retornar o IP do servidor.
     *
     * @example \InepZend\Util\Server::getIpServer()
     *
     * @param boolean $booReplace
     * @return string
     *
     * @TODO nao ha como testar este metodo.
     */
    public static function getIpServer($booReplace = false)
    {
        if (!is_null($mixAttributeStaticValue = self::getAttributeStatic('strIpServer')))
            return ($booReplace === true) ? self::clearIp($mixAttributeStaticValue) : $mixAttributeStaticValue;
        $strIpServer = (array_key_exists('SERVER_ADDR', $_SERVER)) ? $_SERVER['SERVER_ADDR'] : null;
        if ((empty($strIpServer)) && (self::isPhpUnit()))
            $strIpServer = Environment::IP_LOCAL;
        if ((empty($strIpServer)) && (gethostname() !== false))
            $strIpServer = gethostbyname(gethostname());
        self::setAttributeStatic('strIpServer', $strIpServer);
        return ($booReplace === true) ? self::clearIp($strIpServer) : $strIpServer;
    }

    /**
     * Metodo responsavel pelo retorno do protocolo do servidor.
     *
     * @example \InepZend\Util\Server::getServerProtocol()
     *
     * @return string
     *
     * @TODO nao ha como testar este metodo.
     */
    public static function getServerProtocol()
    {
        if (!is_null($mixAttributeStaticValue = self::getAttributeStatic('strServerProtocol')))
            return $mixAttributeStaticValue;
        $strServerProtocol = strtolower($_SERVER['SERVER_PROTOCOL']);
        if (($intPos = strpos($_SERVER['SERVER_PROTOCOL'], '/')) !== false)
            $strServerProtocol = substr($strServerProtocol, 0, $intPos);
        if (($strServerProtocol == 'https') && ($_SERVER['SERVER_PORT'] == 80))
            $strServerProtocol = 'http';
        $strServerProtocol .= '://';
        self::setAttributeStatic('strServerProtocol', $strServerProtocol);
        return $strServerProtocol;
    }

    /**
     * Metodo responsavel pelo retorno da porta do servidor.
     *
     * @example \InepZend\Util\Server::getPort()
     *
     * @param boolean $booServerPort
     * @return type
     */
    public static function getPort($booServerPort = false)
    {
        if (!is_bool($booServerPort))
            $booServerPort = false;
        if ($booServerPort) {
            $intPort = @$_SERVER['SERVER_PORT'];
            if (!empty($intPort))
                return $intPort;
        }
        if (!is_null($mixAttributeStaticValue = self::getAttributeStatic('intPort')))
            return $mixAttributeStaticValue;
        $intPort = null;
        if (preg_match("/:[0-9]{2,4}/", @$_SERVER['HTTP_HOST'])) {
            $arrHost = explode(':', $_SERVER['HTTP_HOST']);
            $intPort = substr($arrHost[1], 0, 4);
            unset($arrHost);
        }
        if (empty($intPort))
            $intPort = @$_SERVER['SERVER_PORT'];
        self::setAttributeStatic('intPort', $intPort);
        return $intPort;
    }

    /**
     * Metodo responsavel pelo retorno do host da aplicacao.
     *
     * @example \InepZend\Util\Server::getHost()
     *
     * @param boolean $booContext
     * @param boolean $booServerPort
     * @param boolean $booRequestUri
     * @return string
     */
    public static function getHost($booContext = null, $booServerPort = false, $booRequestUri = false)
    {
        $booAttributeStatic = (($booServerPort !== true) && ($booRequestUri !== true));
        if (($booAttributeStatic) && (!is_null($mixAttributeStaticValue = self::getAttributeStatic('strHost'))))
            return $mixAttributeStaticValue;
        if (!is_bool($booContext))
            $booContext = true;
        $intPort = self::getPort($booServerPort);
        $strHost = self::getServerProtocol() . $_SERVER['SERVER_NAME'] . ((!is_null($intPort)) ? ':' . $intPort : '');
        $strBaseUrl = self::getBaseUrl();
        if (($booContext) && (!empty($strBaseUrl)))
            $strHost .= $strBaseUrl;
        $strHost .= '/';
        $strHost = str_replace(':80/', '/', $strHost);
        $strRequestUri = (array_key_exists('REQUEST_URI', $_SERVER)) ? substr($_SERVER['REQUEST_URI'], ($booContext) ? strlen($strBaseUrl) : 0) : '';
        if (($booRequestUri === true) && (!empty($strRequestUri)))
            $strHost .= substr($strRequestUri, 1);
        $strHost = trim($strHost);
        if ($booAttributeStatic)
            self::setAttributeStatic('strHost', $strHost);
        return $strHost;
    }
    
    /**
     * Metodo responsavel em retornar o basePath da requisicao. 
     * 
     * @return string
     */
    public static function getBaseUrl()
    {
        return (new Request())->getBaseUrl();
    }

    /**
     * Metodo responsavel pela verificacao se eh uma execucao realizada via PhpUnit.
     *
     * @example \InepZend\Util\Server::isPhpUnit()
     *
     * @return boolean
     * 
     * @TODO implementar asserts
     */
    public static function isPhpUnit()
    {
        return ((array_key_exists('PHP_SELF', $_SERVER)) && (stripos($_SERVER['PHP_SELF'], 'phpunit') !== false));
    }

    public static function getBasePathApplication()
    {
        require_once __DIR__ . '/Functions/Server.php';
        return getBasePathApplication();
    }

    public static function getBasePathVendor()
    {
        require_once __DIR__ . '/Functions/Server.php';
        return getBasePathVendor();
    }

    public static function getReplacedBasePathApplication($strPath = null)
    {
        require_once __DIR__ . '/Functions/Server.php';
        return getReplacedBasePathApplication($strPath);
    }

    /**
     * Metodo responsavel em remover caracteres nao numericos de um IP.
     * @param string $strIp
     * @return string
     */
    public static function clearIp($strIp = null)
    {
        return str_replace(array('.', '-', ' '), '', $strIp);
    }

}
