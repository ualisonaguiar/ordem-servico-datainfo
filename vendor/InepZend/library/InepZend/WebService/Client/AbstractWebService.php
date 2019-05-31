<?php

namespace InepZend\WebService\Client;

use InepZend\Session\SessionTrait;
use InepZend\Service\ServiceManagerTrait;
use InepZend\Cache\Service\ControlCacheTrait;
use InepZend\Authentication\AuthTrait;
use InepZend\Util\Environment;
use InepZend\Util\Reflection;
use InepZend\Util\MethodArgumentTrait;
use InepZend\Util\DebugExec;
use InepZend\Util\stdClass;
use Zend\Json\Json;
use \Exception as ExceptionNative;

abstract class AbstractWebService
{

    use AuthTrait,
        SessionTrait,
        DebugExec,
        ServiceManagerTrait,
        MethodArgumentTrait,
        ControlCacheTrait;

    const DEBUG = false;
    const CLEAR_MEMCACHE = false;
    const MSG_PARAM_NOT_FOUND = 'Parâmetro(s) não informado(s)!';
    const RESPONSE_LAST_STATUS_NOT_DISPATCH = 'NOT_DISPATCH';
    const RESPONSE_LAST_STATUS_ERROR = 'ERROR';
    const RESPONSE_LAST_STATUS_OK = 'OK';

    protected static $arrClient;
    protected $requestLastInstance;
    protected $responseLastInstance;
    protected $strRequestLastUrl;
    protected $strResponseLastStatus = self::RESPONSE_LAST_STATUS_NOT_DISPATCH;
    protected $mixResponseLastContent;
    protected $strResponseLastError;

    public function getRequestLastInstance()
    {
        return $this->requestLastInstance;
    }

    public function getResponseLastInstance()
    {
        return $this->responseLastInstance;
    }

    public function getRequestLastUrl()
    {
        return $this->strRequestLastUrl;
    }

    public function getResponseLastStatus()
    {
        return $this->strResponseLastStatus;
    }

    public function getResponseLastContent()
    {
        return $this->mixResponseLastContent;
    }

    public function getResponseLastError()
    {
        return $this->strResponseLastError;
    }

    public function getRequestLastHost()
    {
        $strDelimiter = '://';
        $arrRequestLastUrl = explode($strDelimiter, $this->getRequestLastUrl());
        if (count($arrRequestLastUrl) == 1)
            return reset($arrExplode = explode('/', $arrRequestLastUrl[0]));
        return $arrRequestLastUrl[0] . $strDelimiter . reset($arrExplode = explode('/', $arrRequestLastUrl[1]));
    }

    public static function getUrl($strClass = null, $strUrl = null, $strPrefixConstant = null)
    {
        if ((empty($strUrl)) && (!empty($strClass))) {
            if (empty($strPrefixConstant))
                $strPrefixConstant = 'URL';
            $arrExplode = explode('::', $strClass);
            $strClass = reset($arrExplode);
            $strUrl = Reflection::listConstantsFromClass(new $strClass(), $strPrefixConstant . Environment::getSufix());
            if ((empty($strUrl)) || (is_bool($strUrl)))
                $strUrl = Reflection::listConstantsFromClass(new $strClass(), $strPrefixConstant);
        }
        return $strUrl;
    }

    abstract public function runService();

    abstract protected function getClient();

    protected function setRequestLastInstance($requestLastInstance = null)
    {
        $this->requestLastInstance = $requestLastInstance;
        return $this;
    }

    protected function setResponseLastInstance($responseLastInstance = null)
    {
        $this->responseLastInstance = $responseLastInstance;
        return $this;
    }

    protected function setRequestLastUrl($strRequestLastUrl = null)
    {
        $this->strRequestLastUrl = $strRequestLastUrl;
        return $this;
    }

    protected function setResponseLastStatus($strResponseLastStatus = null)
    {
        $this->strResponseLastStatus = $strResponseLastStatus;
        return $this;
    }

    protected function setResponseLastContent($mixResponseLastContent = null)
    {
        $this->mixResponseLastContent = $mixResponseLastContent;
        return $this;
    }

    protected function setResponseLastError($strResponseLastError = null)
    {
        $this->strResponseLastError = $strResponseLastError;
        return $this;
    }

    protected function setAllInfo($requestLastInstance = null, $responseLastInstance = null, $strStatus = null, $mixContent = null, $strError = null)
    {
        if ((!is_object($requestLastInstance)) || (!is_object($responseLastInstance)))
            return false;
        $this->setRequestLastInstance($requestLastInstance);
        $this->setResponseLastInstance($responseLastInstance);
        if (!empty($strStatus))
            $this->setResponseLastStatus($strStatus);
        if (!empty($mixContent))
            $this->setResponseLastContent($mixContent);
        if (!empty($strError))
            $this->setResponseLastError($strError);
        return true;
    }

    protected function editContent($mixContent, $booConvertResult = null)
    {
        $this->debugExecFile($mixContent);
        if (!is_bool($booConvertResult))
            $booConvertResult = true;
        $mixResult = null;
        if (is_string($mixContent)) {
            $arrResult = explode("\n", trim($mixContent));
            if (stripos($mixContent, '<?xml') !== false) {
                if (stripos($arrResult[0], '<?xml') === false) {
                    $intLastKey = count($arrResult) - 1;
                    if (stripos($arrResult[$intLastKey], '>') === false)
                        unset($arrResult[$intLastKey]);
                    unset($arrResult[0]);
                    $mixContent = implode("\n", $arrResult);
                }
            } else {
                if (count($arrResult) == 3) {
                    try {
                        Json::decode($arrResult[1]);
                        $mixContent = $arrResult[1];
                    } catch (\Exception $exception) {
                        if (function_exists('gzdecode')) {
                            try {
                                @gzdecode($arrResult[1]);
                                $mixContent = $arrResult[1];
                            } catch (\Exception $exception) {
                                
                            }
                        }
                    }
                }
            }
        }
        if ($booConvertResult) {
            try {
                if (stripos($mixContent, '<?xml') !== false)
                    $mixContent = Json::fromXml($mixContent);
                try {
                    $mixResult = new stdClass((array) Json::decode($mixContent), false);
                } catch (ExceptionNative $exception) {
                    
                }
            } catch (ExceptionNative $exception) {
                
            }
        }
        if (empty($mixResult))
            $mixResult = $mixContent;
        $this->debugExecFile($mixResult);
        return $mixResult;
    }

    protected function replaceToShowXml($strValue = '')
    {
        return str_replace(array('<', '>', '&gt;&lt;'), array('&lt;', '&gt;', "&gt;\n&lt;"), $strValue);
    }

}
