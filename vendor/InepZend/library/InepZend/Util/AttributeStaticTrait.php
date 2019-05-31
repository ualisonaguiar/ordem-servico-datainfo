<?php

namespace InepZend\Util;

/**
 * Trait responsavel em trabalhar com instancias implementanto o design partner Singleton.
 *
 * @package InepZend
 * @subpackage Util
 */
trait AttributeStaticTrait
{

    /**
     * @var array
     */
    private static $arrAttributeStatic = array();

    /**
     * Metodo responsavel em retornar somente uma instancia da classe, implementando singleton.
     *
     * @param string $strConstructClass
     * @param string $strAttribute
     * @param string $strKey
     * @return object
     */
    public static function getAttributeStaticInstance($strConstructClass = null, $strAttribute = null, $strKey = null)
    {
        if (empty($strConstructClass))
            return false;
        if (empty($strAttribute))
            $strAttribute = 'singleInstance';
        if (is_object($mixAttributeStaticValue = self::getAttributeStatic($strAttribute, $strKey)))
            return $mixAttributeStaticValue;
        if (strpos($strConstructClass, '(') === false)
            $strConstructClass .= '()';
        eval('$singleInstance = new ' . $strConstructClass . ';');
        self::setAttributeStatic($strAttribute, $singleInstance, $strKey);
        return $singleInstance;
    }

    /**
     * Metodo responsavel em setar valor no atributo estatico.
     *
     * @param string $strAttribute
     * @param mix $mixValue
     * @param string $strKey
     * @return mix
     */
    public static function setAttributeStatic($strAttribute = null, $mixValue = null, $strKey = null)
    {
        if (empty($strAttribute))
            return false;
        if (property_exists(__CLASS__, $strAttribute))
            eval('self::$' . $strAttribute . ((!empty($strKey)) ? '["' . $strKey . '"]' : '') . ' = $mixValue;');
        else
            eval('self::$arrAttributeStatic["' . $strAttribute . '"]' . ((!empty($strKey)) ? '["' . $strKey . '"]' : '') . ' = $mixValue;');
        return true;
    }

    /**
     * Metodo responsavel em retornar o valor no atributo estatico.
     *
     * @param string $strAttribute
     * @param string $strKey
     * @return mix
     */
    protected static function getAttributeStatic($strAttribute = null, $strKey = null)
    {
        if (empty($strAttribute))
            return self::$arrAttributeStatic;
        $mixAttributeStaticValue = null;
        if (property_exists(__CLASS__, $strAttribute))
            eval('$mixAttributeStaticValue = self::$' . $strAttribute . ';');
        if (is_null($mixAttributeStaticValue)) {
            if (!array_key_exists($strAttribute, self::$arrAttributeStatic))
                return null;
            $mixAttributeStaticValue = self::$arrAttributeStatic[$strAttribute];
        }
        if ((!empty($strKey)) && (is_array($mixAttributeStaticValue)))
            $mixAttributeStaticValue = (array_key_exists($strKey, $mixAttributeStaticValue)) ? $mixAttributeStaticValue[$strKey] : null;
        return $mixAttributeStaticValue;
    }

}
