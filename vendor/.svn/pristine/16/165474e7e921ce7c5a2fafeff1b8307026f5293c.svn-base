<?php

namespace InepZend\Session;

use InepZend\Session\Session;
use InepZend\Util\AttributeStaticInstance;

trait SessionTrait
{

    private static $arrSessionInstance = array();

    /**
     *
     * @param string $strName
     * @return object
     */
    public static function getSessionInstance($strName = null)
    {
        $strName = Session::getSessionName($strName, false);
        return AttributeStaticInstance::getAttributeStaticInstance('InepZend\Session\Session("' . $strName . '")', 'arrSessionInstance', $strName);
    }

    /**
     * Metodo responsavel em setar valor na sessao.
     *
     * @param string $strAttribute
     * @param mix $mixValue
     * @param string $strKey
     * @return mix
     */
    public function setAttributeSession($strAttribute = null, $mixValue = null, $strKey = null)
    {
        if (empty($strAttribute))
            return false;
        $strAttributeName = self::getAttributeNameToSession($strAttribute, $strKey);
        $this->getSessionInstance(get_class($this))->offsetSet($strAttributeName, $mixValue);
        return true;
    }

    /**
     * Metodo responsavel em retornar o valor na sessao.
     *
     * @param string $strAttribute
     * @param string $strKey
     * @param string $strClass
     * @return mix
     */
    protected function getAttributeSession($strAttribute = null, $strKey = null, $strClass = null)
    {
        if (empty($strAttribute))
            return false;
        $strAttributeName = self::getAttributeNameToSession($strAttribute, $strKey);
        $session = self::getSessionInstance((empty($strClass)) ? get_class($this) : $strClass);
        return ($session->offsetExists($strAttributeName)) ? $session->offsetGet($strAttributeName) : null;
    }

    private static function getAttributeNameToSession($strAttribute = null, $strKey = null)
    {
        eval('$strAttributeName = \'' . $strAttribute . ((!empty($strKey)) ? '["' . $strKey . '"]' : '') . '\';');
        return $strAttributeName;
    }
    
}
