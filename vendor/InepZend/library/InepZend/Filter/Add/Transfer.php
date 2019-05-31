<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Exception\RuntimeException;

trait Transfer
{

    public function addFilterTransfer(
            $strName, 
            $booRequired = false, 
            $arrFilters = array(), 
            $arrValidators = array(), 
            $strMessageRequired = null)
    {
        $strMessageException = 'Não foi possível filtrar os selects múltiplos do transfer no formulário.';
        $arrFilter = $this->addFilterSelect($strName, $booRequired, $arrFilters, $arrValidators, $strMessageRequired);
        if (!is_array($arrFilter))
            throw new RuntimeException($strMessageException);
        $arrFilter = $this->addFilterSelect(array('name' => $arrFilter['name'] . FormGenerator::getSufixTransferNotSelectable(), 'required' => false));
        if (!is_array($arrFilter))
            throw new RuntimeException($strMessageException);
        return true;
    }

}
