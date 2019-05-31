<?php

namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Form;

use InepZend\Filter\Filter;

class LayoutFileFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsLayoutAdd': {
                $this->addFilter(array('name' => 'no_layout', 'required' => true));
                $this->addFilter(array('name' => 'ds_caminho'));
                $this->addFilter(array('name' => 'ds_url'));
                $this->addFilter(array('name' => 'ds_encode'));
                $this->addFilter(array('name' => 'ds_procedure'));
                $this->addFilter(array('name' => 'ds_table'));
                $this->addFilterTransfer(array('name' => 'id_layout_dependente'));
                break;
            }
        }
    }

}
