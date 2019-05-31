<?php

namespace OrdemServico\Form;

use InepZend\Filter\Filter;

class RelatorioPessoalFilter extends Filter
{

    public function __construct($strMethod = null, $booPreposto = false)
    {
        parent::__construct($strMethod);
        $this->addFilterDateRange('dt_abertura', true);
        if ($booPreposto)
            $this->addFilterDateRange('no_executor', true);
    }

}
