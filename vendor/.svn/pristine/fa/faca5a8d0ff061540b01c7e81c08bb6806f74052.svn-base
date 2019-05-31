<?php

namespace InepZend\Module\TrocaArquivo\ResponsavelEnvio\Form;

use InepZend\Filter\Filter;

class ResponsavelEnvioFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter': {
                    $this->addFilterSelect(array('name' => 'co_projeto'));
                    $this->addFilterSelect(array('name' => 'sg_uf'));
                    break;
                }
            case 'prepareElements': {
                    $this->addFilter(array('name' => 'id_responsavel'));
                    $this->addFilterSelect(array('name' => 'id_usuario_sistema', 'required' => true));
                    $this->addFilterSelect(array('name' => 'co_projeto', 'required' => true));
                    $this->addFilterSelect(array('name' => 'sg_uf', 'required' => true));
                    break;
                }
        }
    }

}
