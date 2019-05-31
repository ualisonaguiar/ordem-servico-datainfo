<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class UsuarioFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter':
                $this->addFilter(array('name' => 'no_usuario'));
                break;
            case 'prepareElements':
                $this->addFilter(array('name' => 'id_usuario', 'requiered' => true));
                $this->addFilter(array('name' => 'no_usuario', 'requiered' => true));
                $this->addFilter(array('name' => 'nu_pis', 'requiered' => true));
                $this->addFilter(array('name' => 'ds_email', 'requiered' => true));
                $this->addFilter(array('name' => 'ds_login', 'requiered' => true));
                $this->addFilter(array('name' => 'ds_senha', 'requiered' => false));
                break;
            case 'prepareElementsVinculo':
                $this->addFilter(array('name' => 'id_usuario_vinculo'));
                $this->addFilter(array('name' => 'id_usuario'));
                $this->addFilter(array('name' => 'no_usuario'));
                $this->addFilter(array('name' => 'nu_pis'));
                $this->addFilter(array('name' => 'ds_email'));
                $this->addFilter(array('name' => 'ds_login'));
                $this->addFilter(array('name' => 'ds_senha', 'requiered' => false));
                break;
        }
    }

}
