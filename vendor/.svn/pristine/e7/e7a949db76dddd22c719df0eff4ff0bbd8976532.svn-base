<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Form;

use InepZend\Filter\Filter;

class LayoutFileFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsSearch':
                $this->addFilter('co_projeto');
                $this->addFilter('co_evento');
                $this->addFilter('id_layout');
                break;
            case 'prepareElementsAdd':
                $this->addFilter('id_layout', true);
//                $this->addFilter('nu_tipo_massa_real');
                $this->addFilter('nu_tipo_massa_aleatoriamente', true);
                $this->addFilter('nu_quantidade_linha', true);
                break;
        }
    }

}
