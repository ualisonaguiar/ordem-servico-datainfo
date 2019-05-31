<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\Add\Contato as ContatoForm;

trait Contato
{
    
    public function addFilterContato(
            $arrRequired = null,
            $arrMessageRequired = null)
    {
        return $this->addFilterGroup($this->getParamEdited(func_get_args(), func_num_args(), array(), false), ContatoForm::getElementToContato());
    }

}
