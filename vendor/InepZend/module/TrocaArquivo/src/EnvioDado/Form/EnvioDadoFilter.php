<?php

namespace InepZend\Module\TrocaArquivo\EnvioDado\Form;

use InepZend\Filter\Filter;

class EnvioDadoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsEnvio': {
                    $this->addFilterSelect(array('name' => 'idConfiguracao', 'required' => true));
                    $this->addFilter(array('name' => 'noArquivo', 'required' => true));
                    break;
                }
        }
    }

}
