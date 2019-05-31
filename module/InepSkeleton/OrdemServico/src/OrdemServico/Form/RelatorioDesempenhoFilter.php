<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class RelatorioDesempenhoFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        $this->addFilterDateRange('dt_abertura', true);
        $this->addFilter('no_executor');
    }

}
