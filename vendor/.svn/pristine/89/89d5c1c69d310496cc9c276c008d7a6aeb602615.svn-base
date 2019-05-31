<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form;

use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\MonitoramentoEnvio;
use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Form\AcompanhamentoEnvioFilter;

class AcompanhamentoEnvio extends MonitoramentoEnvio
{

    public function prepareElementsFilter()
    {
        parent::prepareElementsFilter('acompanhamentoenvio', array('route' => 'enviodado', 'value' => 'Envio dos Dados'), true);
        $this->setInputFilter(new AcompanhamentoEnvioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsShow($intIdArquivo = null, $arrData = null)
    {
        parent::prepareElementsShow($intIdArquivo, $arrData, 'acompanhamentoenvio', array('route' => 'enviodado', 'value' => 'Envio dos Dados'));
        $this->setInputFilter(new AcompanhamentoEnvioFilter(__FUNCTION__));
        return $this;
    }

}
