<?php

namespace InepZend\Util;

use InepZend\Util\AttributeStaticInstance;
use InepZend\Util\Debug;

/**
 * Trait responsavel no debug.
 *
 * @package InepZend
 * @subpackage Util
 */
trait DebugExec
{
    
    private static $booAllDebugExecFile = false;
    private static $booAllDebugExecScreen = false;
    private static $booConstDebug;

    /**
     * Metodo responsavel em retornar a instancia da library.
     *
     * @return object
     */
    protected static function getLibraryInstance()
    {
        return AttributeStaticInstance::getAttributeStaticInstance('InepZend\Util\Library');
    }

    protected function debugExecEcho($mixValue = null, $booDebug = null)
    {
        return self::debugExec($mixValue, $booDebug, null, 'echo', null, false, true, true, 3);
    }

    protected function debugExecSimple($mixValue = null, $booDebug = null)
    {
        return self::debugExec($mixValue, $booDebug, true, null, null, false, true, true, 3);
    }

    protected function debugExecWs($mixValue = null, $booClear = false, $booVarExport = false, $booHtmlEntities = false, $booDebug = null)
    {
        return self::debugExec($mixValue, $booDebug, null, null, true, $booClear, $booVarExport, $booHtmlEntities, 3);
    }

    protected function debugExecFile($mixValue = null, $booDebug = null, $booClear = false, $booVarExport = false, $booHtmlEntities = false)
    {
        return self::debugExec($mixValue, $booDebug, null, null, true, $booClear, $booVarExport, $booHtmlEntities, 3);
    }

    /**
     * Metodo responsavel em executar debug personalizado para o InepZend.
     *
     * @param type $mixValue
     * @param boolean $booDebug
     * @param boolean $booSimpleDebug
     * @param string $strFunction
     * @param boolean $booDebugWs
     * @param boolean $booClear
     * @param boolean $booVarExport
     * @param boolean $booHtmlEntities
     * @param integer $intBacktrace
     * @return mix
     */
    protected function debugExec($mixValue = null, $booDebug = null, $booSimpleDebug = null, $strFunction = null, $booDebugWs = null, $booClear = false, $booVarExport = true, $booHtmlEntities = true, $intBacktrace = 2)
    {
        $booConstDebug = self::$booConstDebug;
        if (!is_bool($booConstDebug)) {
            $booConstDebug = (($booDebugWs === true) && (array_key_exists('debugExecFile', $_GET))) ? true : null;
            if (!is_bool($booConstDebug)) {
                $booConstDebug = ((($booDebugWs === true) && (self::$booAllDebugExecFile === true)) || (($booDebugWs !== true) && (self::$booAllDebugExecScreen === true))) ? true : null;
                if (!is_bool($booConstDebug)) {
                    if ($booDebugWs === true) {
                        $memcache = new \Memcache();
                        $memcache->connect('localhost', 11211);
                        if ($memcache->get('debugexec.file') !== false)
                            $booConstDebug = ($memcache->get('debugexec.file') == 'enable');
                    }
                    if (!is_bool($booConstDebug)) {
                        $booConstDebug = ((isset($this)) && (is_object($this))) ? $this::DEBUG : self::DEBUG;
                        if (is_bool($booConstDebug))
                            self::$booConstDebug = $booConstDebug;
                    }
                }
            }
        }
        if (($booConstDebug === true) || ($booDebug === true)) {
            if (is_null($intBacktrace))
                $intBacktrace = 2;
            if ($booSimpleDebug === true)
                return Debug::simpleDebug($mixValue, false, $intBacktrace);
            if ($booDebugWs === true)
                return Debug::debugWS($mixValue, false, $booClear, null, null, $intBacktrace - 1, $booVarExport, $booHtmlEntities);
            if (empty($strFunction))
                $strFunction = '\InepZend\Util\Debug::debug';
            if (strtolower($strFunction) == 'echo') {
                $strDebug = $mixValue;
                echo $strDebug;
            } else
                eval('$strDebug = ' . $strFunction . '($mixValue, false, null, false, ' . $intBacktrace . ');');
            return $strDebug;
        }
    }

    protected function startCount($booKeep = false)
    {
        return Debug::startCount($booKeep);
    }

    protected function finishCount()
    {
        return Debug::finishCount(false, false);
    }

}
