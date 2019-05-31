<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\Add\Endereco as EnderecoForm;

trait Endereco
{
    
    public function addFilterEndereco(
            $arrRequired = null,
            $arrMessageRequired = null)
    {
        return $this->addFilterGroup($this->getParamEdited(func_get_args(), func_num_args(), array(), false), EnderecoForm::getElementToEndereco());
    }

}
