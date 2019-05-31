<?php

namespace InepZend\FormGenerator\Add;

use InepZend\FormGenerator\Element\Html as ElementHtml;

/**
 * Trait responsavel em manipular o Element do tipo Html.
 */
trait Html
{
    
    private static $intCountHtml = 0;

    /**
     * Metodo responsavel em inserir o Element Html.
     * 
     * @example $this->addHtml($strValue, $strName);
     * 
     * @param string $strValue
     * @param string $strName
     * @param boolean $booReturnThis
     * @return mix
     */
    public function addHtml($strValue = null, $strName = null, $booReturnThis = null)
    {
        $arrParam = func_get_args();
        if ((func_num_args() == 1) && (is_array($arrParam[0]))) {
            $this->getArgumentArray($arrParam, $strValue, 'value');
            $this->getArgumentArray($arrParam, $strName, 'name');
            $this->getArgumentArray($arrParam, $booReturnThis, 'return_this');
        }
        if (empty($strName))
            $strName = __FUNCTION__;
        $strName .= self::$intCountHtml;
        ++self::$intCountHtml;
        $element = new ElementHtml($strName, $strValue);
        $this->add($element);
        return ($booReturnThis === false) ? $element : $this;
    }

}
