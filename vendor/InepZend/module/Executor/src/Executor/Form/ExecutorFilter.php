<?php

namespace InepZend\Module\Executor\Form;

use InepZend\Filter\Filter;

class ExecutorFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsSearch':
                $this->addFilter('dsTitulo');
                $this->addFilter('inAtivo');
                break;
            case 'prepareElementsQuery':
                $this->addFilter('idQuery');
                $this->addFilter('dsTitulo', true);
                $this->addFilterEditor('dsDescricao');
                $this->addFilter('inAtivo', true);
                $this->addFilterEditor('dsQuery', false);
                break;
            case 'prepareElementExecute':
                $this->addFilter('dsTitulo');
                $this->addFilterEditor('dsDescricao');
                break;
        }
    }

}
