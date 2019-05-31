<?php

namespace InepZend\Module\TrocaArquivo\ConfigEnvio\Form;

use InepZend\Filter\Filter;

class ConfigEnvioFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsConfigEnvio': {
                $this->addFilterSelect(array('name' => 'id_layout_combo'));
                $this->addFilterSelect(array('name' => 'co_projeto', 'required' => true));
                $this->addFilterSelect(array('name' => 'co_evento', 'required' => true));
                $this->addFilterSelect(array('name' => 'sg_uf'));
                break;
            }
        }
    }

}
