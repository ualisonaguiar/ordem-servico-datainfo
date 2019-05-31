<?php

namespace InepZend\Module\Executor\Form;

use InepZend\Filter\Filter;

class UsuarioFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementSearch':
                $this->addFilter('dsLogin');
                $this->addFilter('dsCpf');
                $this->addFilter('inAtivo');
                break;
            case 'prepareElementManter':
                $this->addFilter('dsLogin', true);
                $this->addFilter('nuCpf', true);
                $this->addFilter('inAtivo', true);
                break;
        }
    }

}
