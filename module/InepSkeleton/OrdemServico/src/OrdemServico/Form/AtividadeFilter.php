<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class AtividadeFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter':
                $this->addFilter(array('name' => 'co_atividade'));
                break;
            case 'prepareElements':
                $this->addFilter(array('name' => 'id_atividade'));
                $this->addFilter(array('name' => 'co_atividade', 'required' => true));
                $this->addFilterFloat(array('name' => 'vl_baixo_definido', 'required' => true));
                $this->addFilter(array('name' => 'no_atividade', 'required' => true));
                $this->addFilter(array('name' => 'ds_descricao'));
                $this->addFilter(array('name' => 'ds_area_assessoria', 'required' => true));
                break;
        }
    }

}
