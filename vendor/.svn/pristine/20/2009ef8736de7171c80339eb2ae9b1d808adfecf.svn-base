<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\Add\DadoPessoal as DadoPessoalForm;

trait DadoPessoal
{
    
    public function addFilterDadoPessoal(
            $arrRequired = null,
            $arrMessageRequired = null)
    {
        return $this->addFilterGroup($this->getParamEdited(func_get_args(), func_num_args(), array(), false), DadoPessoalForm::getElementToDadoPessoal());
    }

}
