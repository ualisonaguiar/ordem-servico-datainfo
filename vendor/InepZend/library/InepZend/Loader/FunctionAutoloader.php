<?php

namespace InepZend\Loader;

use InepZend\Util\Reflection;
use InepZend\Util\Environment;

class FunctionAutoloader
{

    private static $arrFunction = array();
    private static $booCalled = false;
    private static $arrEnvironmentAble = array(
        Environment::LOCAL,
        Environment::DESENVOLVIMENTO,
    );

    public static function convertMethod($strClass = null, $strMethod = null, $strFunction = null, $strType = null)
    {
        if ((empty($strClass)) || (empty($strMethod)))
            return false;
        if (empty($strFunction))
            $strFunction = $strMethod;
        if (!is_null(self::getFunction($strFunction)))
            return false;
        if (!class_exists($strClass))
            return false;
        $object = new $strClass();
        if (!method_exists($object, $strMethod))
            return false;
        $method = Reflection::listMethods($object, $strMethod);
        if (!is_object($method))
            return false;
        $strAccess = 'public';
        if ($method->isPrivate())
            $strAccess = 'private';
        elseif ($method->isProtected())
            $strAccess = 'protected';
        if (empty($strType))
            $strType = ($strAccess == 'public') ? 'call' : 'copy';
        if (!$method->isStatic())
            $strType = 'call';
        $strContent = '';
        $arrContent = file($method->getFileName());
        $intCount = $method->getStartLine();
        if ($intCount > 0)
            --$intCount;
        if (strtolower($strType) == 'call') {
            $strContent .= $arrContent[$intCount];
            if (strpos($strContent, '{') === false)
                $strContent .= '{ ';
            $strParameter = '';
            foreach ($method->getParameters() as $intKey => $parameter) {
                if ($intKey != 0)
                    $strParameter .= ', ';
                $strParameter .= '$' . $parameter->getName();
            }
            if ($method->isStatic())
                $strContent .= "\nreturn \\" . $strClass . '::' . $strMethod . '(' . $strParameter . ");\n}";
            else {
                $strContent .= "\n" . '$object = new \\' . $strClass . '();';
                $strContent .= "\n" . 'return $object->' . $strMethod . '(' . $strParameter . ");\n}";
            }
        } else {
            while ($intCount < $method->getEndLine()) {
                $strContent .= $arrContent[$intCount];
                ++$intCount;
            }
            $strContent = str_replace(array('self::', 'parent::'), '\\' . $strClass . '::', $strContent);
        }
        $strContent = str_replace(array($strAccess . ' ', 'static '), '', trim($strContent));
        if ($strFunction != $strMethod)
            $strContent = substr_replace($strContent, $strFunction . '(', strpos($strContent, $strMethod . '('), strlen($strMethod . '('));
        eval($strContent);
        return self::setFunction($strClass, $strMethod, $strFunction);
    }

    public static function convertClass($strClass = null, $booRemoveMethodsFromParent = false)
    {
        if (empty($strClass))
            return false;
        if (!class_exists($strClass))
            return false;
        $arrMethod = Reflection::listMethodsFromClass($strClass, $booRemoveMethodsFromParent);
        if (!is_array($arrMethod))
            return false;
        $arrResult = array();
        foreach ($arrMethod as $strMethod)
            $arrResult[$strMethod] = self::convertMethod($strClass, $strMethod);
        return $arrResult;
    }

    public static function getFunction($strFunction = null)
    {
        if (empty($strFunction))
            return self::$arrFunction;
        foreach (self::$arrFunction as $strClass => $arrMethod) {
            foreach ($arrMethod as $strMethod => $arrFunction) {
                foreach ($arrFunction as $intKey => $strFunctionIntern) {
                    if ($strFunction == $strFunctionIntern)
                        return $intKey;
                }
            }
        }
        return;
    }

    public static function onBootstrap()
    {
        if (self::$booCalled !== true) {
            self::$booCalled = true;
            self::onBootstrapFunctionFile();
            if (in_array(Environment::getEnvironmentName(), self::$arrEnvironmentAble))
                self::onBootstrapConvert();
        }
        return true;
    }

    private static function onBootstrapConvert()
    {
        $arrConvert = array(
            'convertMethod' => array(
                array('InepZend\Util\Debug', 'debug', 'd', 'copy'),
                array('InepZend\Util\Debug', 'debugWS', 'dws', 'copy'),
                array('InepZend\Util\Library', 'simpleDebug', 'sd', 'copy'),
                array('InepZend\Util\Debug', 'startCount', 'sc'),
                array('InepZend\Util\Debug', 'finishCount', 'fc'),
                array('InepZend\Log\Log', 'info', 'i'),
                array('InepZend\Log\Log', 'error', 'e'),
                array('InepZend\Loader\FunctionAutoloader', 'getFunction', 'gf'),
                array('InepZend\Loader\FunctionAutoloader', 'convertMethod', 'cm'),
            ),
        );
        if (!is_array($arrConvert))
            return false;
        foreach ($arrConvert as $strMethod => $arrConvertIntern) {
            foreach ((array) $arrConvertIntern as $arrParam) {
                if ((!is_array($arrParam)) || (count($arrParam) < 2))
                    continue;
                self::$strMethod($arrParam[0], $arrParam[1], ((array_key_exists(2, $arrParam)) ? $arrParam[2] : null), ((array_key_exists(3, $arrParam)) ? $arrParam[3] : null));
            }
        }
        return true;
    }

    private static function onBootstrapFunctionFile()
    {
        $arrFunctionFile = array(
            __DIR__ . '/../Util/Functions/FileSystem.php',
        );
        if (!is_array($arrFunctionFile))
            return false;
        foreach ($arrFunctionFile as $strFunctionFile)
            require_once($strFunctionFile);
        return true;
    }

    private static function setFunction($strClass = null, $strMethod = null, $strFunction = null)
    {
        if ((empty($strClass)) || (empty($strMethod)))
            return false;
        if (empty($strFunction))
            $strFunction = $strMethod;
        if (!array_key_exists($strClass, self::$arrFunction))
            self::$arrFunction[$strClass] = array();
        if (!array_key_exists($strMethod, self::$arrFunction[$strClass]))
            self::$arrFunction[$strClass][$strMethod] = array();
        if (!array_key_exists($strFunction, self::$arrFunction[$strClass][$strMethod]))
            $intKey = count(self::$arrFunction[$strClass][$strMethod]);
        else
            $intKey = array_search($strFunction, self::$arrFunction[$strClass][$strMethod]);
        self::$arrFunction[$strClass][$strMethod][$intKey] = $strFunction;
        return true;
    }

}
