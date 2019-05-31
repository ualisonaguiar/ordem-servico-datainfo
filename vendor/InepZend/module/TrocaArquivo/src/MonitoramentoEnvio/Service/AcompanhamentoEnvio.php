<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service;

use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Service\MonitoramentoEnvio;

class AcompanhamentoEnvio extends MonitoramentoEnvio
{

    protected function getDataToShow($intCoArquivo = null)
    {
        return parent::getDataToShow($intCoArquivo, true);
    }

}
