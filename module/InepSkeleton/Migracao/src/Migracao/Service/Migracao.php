<?php

namespace Migracao\Service;

use InepZend\Service\AbstractService;
use InepZend\Util\Date;

class Migracao extends AbstractService
{

    protected function iniciarMigracao()
    {
        $atividadeService = $this->getService('Migracao\Service\AtividadeFile');
        try {
            $atividadeService->begin();
            # migrando atividade
            $this->migrarAtividade();
            # migrando demanda
            $this->migrarDemanda();
            # migrando ordem servico
            $this->migrarOrdemServico();
            # migrando ordem servico demanda
            $this->migrarOrdemServicoDemanda();
            $atividadeService->commit();
        } catch (\Exception $exception) {
            $atividadeService->rollback();
            \InepZend\Util\Library::simpleDebug($exception->getMessage(), 1);
        }
    }

    protected function migrarAtividade()
    {
        $arrAtividadeArquivo = $this->getService('OrdemServico\Service\AtividadeFile')->findBy();
        $atividadeService = $this->getService('Migracao\Service\AtividadeFile');
        foreach ($arrAtividadeArquivo as $atividade) {
            $atividadeService->insert($atividade->toArray());
        }
    }

    protected function migrarDemanda()
    {
        $arrDemandaArquivo = $this->getService('OrdemServico\Service\DemandaFile')->findBy();
        $arrDemandaMigracao = array();
        foreach ($arrDemandaArquivo as $demanda) {
            $arrDemandaMigracao[$demanda->getIdDemanda()] = $demanda->toArray();
        }
        $demandaService = $this->getService('Migracao\Service\DemandaFile');
        foreach ($arrDemandaMigracao as $arrDemandaInfo) {
            $arrDemandaInfo['dt_abertura'] = Date::convertDate($arrDemandaInfo['dt_abertura']);
            $demandaService->insert($arrDemandaInfo);
        }
    }

    protected function migrarOrdemServico()
    {
        $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile');
        $arrOrdemServicoAtividade = $ordemServico->findBy();
        $ordemService = $this->getService('Migracao\Service\OrdemServicoFile');
        foreach ($arrOrdemServicoAtividade as $ordemServico) {
            $arrOrdemServico = $ordemServico->toArray();
            if ($arrOrdemServico['id_ordem_servico']) {
                $arrOrdemServico['dt_prazo'] = Date::convertDate($arrOrdemServico['dt_prazo'], 'Y-m-d H:i:s');
                $arrOrdemServico['dt_emissao'] = Date::convertDate($arrOrdemServico['dt_emissao'], 'Y-m-d H:i:s');
                $arrOrdemServico['dt_recepcao'] = Date::convertDate($arrOrdemServico['dt_recepcao'], 'Y-m-d H:i:s');
                $ordemService->insert($arrOrdemServico);
            }
        }
    }

    protected function migrarOrdemServicoDemanda()
    {
        $arrOrdemServicoDemanda = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->findBy();
        $ordemServiceDemanda = $this->getService('Migracao\Service\OrdemServicoDemandaFile');
        foreach ($arrOrdemServicoDemanda as $ordemServicoDemanda) {
            $ordemServiceDemanda->insert($ordemServicoDemanda->toArray());
        }
    }
}
