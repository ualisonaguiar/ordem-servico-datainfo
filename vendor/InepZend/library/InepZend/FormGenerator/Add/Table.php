<?php

namespace InepZend\FormGenerator\Add;

use InepZend\FormGenerator\Element\Table as ElementTable;

/**
 * Trait responsavel em manipular o Element do tipo Table.
 */
trait Table
{
    
    /**
     * Metodo responsavel em inserir o Element Table.
     * 
     * @example $this->addTable($arrData, $arrTitle, $arrIcon, $arrOption, $strName);
     * 
     * @param array $arrData
     * @param array $arrTitle
     * @param array $arrIcon
     * @param array $arrOption
     * @param string $strName
     * @param string $strLabel
     * @param boolean $booShowNoRegister
     * @param string $strCallback
     * @param string $strSort
     * @return mix
     */
    public function addTable($arrData = null, $arrTitle = null, $arrIcon = null, $arrOption = null, $strName = null, $strLabel = null, $booShowNoRegister = false, $strCallback = null, $strSort = null)
    {
        $arrParam = func_get_args();
        if ((func_num_args() == 1) && (is_array($arrParam[0]))) {
            $this->getArgumentArray($arrParam, $arrData, 'value');
            $this->getArgumentArray($arrParam, $arrTitle, 'title');
            $this->getArgumentArray($arrParam, $arrIcon, 'icon');
            $this->getArgumentArray($arrParam, $arrOption, 'option');
            $this->getArgumentArray($arrParam, $strName, 'name');
            $this->getArgumentArray($arrParam, $strLabel, 'label');
            $this->getArgumentArray($arrParam, $booShowNoRegister, 'show_no_register');
            $this->getArgumentArray($arrParam, $strCallback, 'callback');
            $this->getArgumentArray($arrParam, $strSort, 'sort');
        }
        if (empty($strName))
            $strName = __FUNCTION__;
        return $this->add(new ElementTable($arrData, $arrTitle, $arrIcon, $arrOption, $strName, $strLabel, $booShowNoRegister, $strCallback, $strSort));
    }

}
