<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\Add\DadoBancario as DadoBancarioForm;

trait DadoBancario
{
    
    public function addFilterDadoBancario(
            $arrRequired = null,
            $arrMessageRequired = null)
    {
        return $this->addFilterGroup($this->getParamEdited(func_get_args(), func_num_args(), array(), false), DadoBancarioForm::getElementToDadoBancario());
    }

}
