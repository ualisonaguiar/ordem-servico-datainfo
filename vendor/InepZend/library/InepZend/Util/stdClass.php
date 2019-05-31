<?php

namespace InepZend\Util;

use \stdClass as stdClassNative;
use InepZend\Util\String;

/**
 * Classe que extende a stdClass nativa, sendo responsavel pela criacao de um
 * objeto vazio com possibilidade de ir adicionando as propriedades conforme
 * necessario.
 *
 * Sua principal diferenca para a stdClass nativa eh poder adicionar as
 * propriedades no metodo magico construtor da instancia.
 *
 * @package InepZend
 * @subpackage Util
 */
class stdClass extends stdClassNative
{

    /**
     * Metodo construtor responsavel em adicionar as propriedades no objeto vazio.
     *
     * @example new \InepZend\Util\stdClass(array('attribute_name' => 'attribute_value'))
     *
     * @param array $arrAttributeValue
     * @param boolean $booUtf8Decode
     * @return void
     */
    public function __construct($arrAttributeValue = null, $booUtf8Decode = null)
    {
        $this->setAllAttribute($arrAttributeValue, $booUtf8Decode);
    }

    /**
     * Metodo responsavel em adicionar as propriedades parametrizadas no objeto
     * vazio.
     *
     * @example (new \InepZend\Util\stdClass)->setAllAttribute(array('attribute_name' => 'attribute_value'))
     *
     * @param array $arrAttributeValue
     * @param boolean $booUtf8Decode
     * @return boolean
     */
    private function setAllAttribute($arrAttributeValue = null, $booUtf8Decode = null)
    {
        if (is_array($arrAttributeValue)) {
            foreach ($arrAttributeValue as $strAttributeName => $mixAttributeValue)
                $this->$strAttributeName = ($booUtf8Decode === true) ? String::utf8Decode($mixAttributeValue) : $mixAttributeValue;
            return true;
        }
        return false;
    }

}
