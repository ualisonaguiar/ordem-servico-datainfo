<?php

namespace InepZend\Filter\Add;

trait Email
{

    public function addFilterEmailCrud()
    {
        $this->addFilter(array('name' => 'coTipoEmail'));
        $this->addFilter(array('name' => 'txEmail'));
        $this->addFilter(array('name' => 'txEmailConfirmacao'));
    }

}
