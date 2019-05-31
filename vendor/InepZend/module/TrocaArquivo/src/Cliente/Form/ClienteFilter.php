<?php
namespace InepZend\Module\TrocaArquivo\Cliente\Form;

use InepZend\Filter\Filter;

class ClienteFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsPreprocessamento':
                {
                    $this->addFilterSelect(array(
                        'name' => 'idLayout',
                        'required' => true
                    ));
                    $this->addFilter(array(
                        'name' => 'noArquivo',
                        'required' => true
                    ));
                    break;
                }
        }
    }
}
