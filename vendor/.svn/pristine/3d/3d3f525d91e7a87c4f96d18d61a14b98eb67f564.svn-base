<?php

namespace InepZend\Util;

use InepZend\Util\AttributeStaticTrait;

/**
 * Classe responsavel em trabalhar com instancias a partir da Trait.
 *
 * @package InepZend
 * @subpackage Util
 */
class AttributeStaticInstance
{

    /**
     * Chamada da Trait
     */
    use AttributeStaticTrait;

    /**
     * Metodo responsavel em retorna uma unica instancia utilizando singleton da 
     * getAttributeStaticInstance da Trait.
     *
     * @return object
     */
    public static function getInstance()
    {
        return self::getAttributeStaticInstance(__CLASS__);
    }

}
