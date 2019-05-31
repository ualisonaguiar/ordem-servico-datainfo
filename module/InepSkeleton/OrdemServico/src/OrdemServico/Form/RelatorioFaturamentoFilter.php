<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class RelatorioFaturamentoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter':
                $this->addFilter(array('name' => 'co_atividade'));
                $this->addFilter(array('name' => 'ds_nr_relatorio'));
                $this->addFilter(array('name' => 'ds_mes_ano_relatorio'));
                $this->addFilter(array('name' => 'dt_relatorio'));
                sbreak;
        }
    }

}
