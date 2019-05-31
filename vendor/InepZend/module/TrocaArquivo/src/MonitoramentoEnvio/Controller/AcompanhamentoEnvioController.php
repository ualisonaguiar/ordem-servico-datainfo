<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller;

use InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\MonitoramentoEnvioController;

class AcompanhamentoEnvioController extends MonitoramentoEnvioController
{

    public function ajaxPaginatorAction()
    {
        $arrCriteriaMerge = array();
        $arrConfiguracaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findByPersonal();
        foreach ($arrConfiguracaoFile as $configuracaoFile) {
            if (!is_array(@$arrCriteriaMerge['id_configuracao']))
                $arrCriteriaMerge['id_configuracao'] = array();
            $arrCriteriaMerge['id_configuracao'][] = $configuracaoFile->getIdConfiguracao();
        }
        return parent::ajaxPaginatorAction($arrCriteriaMerge);
    }

}
