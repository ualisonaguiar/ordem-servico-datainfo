<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form;

use InepZend\Filter\Filter;

class MonitoramentoEnvioFilter extends Filter
{

    public function __construct($strMethod = null)
    {
        parent::__construct($strMethod);
        switch ($strMethod) {
            case 'prepareElementsFilter': {
                    $this->addFilterSelect(array('name' => 'id_configuracao'));
                    $this->addFilter(array('name' => 'no_arquivo'));
                    break;
                }
            case 'prepareElementsShow': {
                    break;
                }
        }
    }

}
