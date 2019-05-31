<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use InepZend\Exception\Exception;
use OrdemServico\Entity\Demanda as DemandaEntity;
use OrdemServico\Message\Message;
use InepZend\Util\Date;

class OrdemServicoDemandaFile extends AbstractService
{
    use ServiceAngularTrait,
        Message;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_ordem_servico_demanda');
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_LISTA_DEMANDA_VINCULADA
     */
    public function listaDemandaVinculadaAction($arrDataPost)
    {
        $arrDemandaVinculada = $this->findBy($arrDataPost, array('id_demanda' => 'asc'));
        $arrDemanda = array();
        if ($arrDemandaVinculada) {
            $arrAtividades = $this->getService('OrdemServico\Service\AtividadeFile')
                ->fetchPairs(array(), 'getIdAtividade', 'getCodigoAtividadeDescricao');
            $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
            foreach ($arrDemandaVinculada as $demandaVinculada) {
                $demanda = $demandaService->find($demandaVinculada->getIdDemanda());
                if ($demanda->getIdAtividade()) {
                    $arrInfoAtividade = explode(' - ', $arrAtividades[$demanda->getIdAtividade()]);
                    $arrInfoDemanda = array(
                        'id_atividade' => $demanda->getIdAtividade(),
                        'co_atividade' => $arrInfoAtividade[0],
                        'no_atividade' => $arrInfoAtividade[1],
                        'vl_complexidade' => $demanda->getVlComplexidade(),
                        'vl_impacto' => $demanda->getVlImpacto(),
                        'vl_criticidade' => $demanda->getVlCriticidade(),
                        'vl_fator_ponderacao' => $demanda->getVlFatorPonderacao(),
                        'vl_facim' => $demanda->getVlFacim(),
                        'vl_qma' => $demanda->getVlQma(),
                        'id_demanda' => $demandaVinculada->getIdDemanda(),
                        'id_demanda_superior' => $demanda->getIdDemandaSuperior(),
                    );
                    $arrDemanda[$demandaVinculada->getIdDemanda()]['atividade'] = $arrInfoDemanda;
                } else {
                    $arrDemanda[$demandaVinculada->getIdDemanda()]['servico'] = $this->getInfoDemandaVinculadaServico($demandaVinculada->getIdDemanda(), $arrAtividades);
                }

            }
        }
        ksort($arrDemanda);
        return $arrDemanda;
    }

    protected function getInfoDemandaVinculadaServico($intIdDemanda, $arrAtividades)
    {
        $arrDemandaServico = $this->getService('OrdemServico\Service\DemandaServicoFile')->findBy(['id_demanda' => $intIdDemanda]);
        $catalogoAtividadeService = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile');
        $arrDemandaServicoVinculo = array();
        foreach ($arrDemandaServico as $intIndice => $demandaServico) {
            $arrDemandaServicoVinculo[$intIndice] = $demandaServico->toArray();
            $arrCatalogoAtividade = $catalogoAtividadeService->findBy(['id_catalogo_servico_atividade' => $demandaServico->getIdCatalogoServicoAtividade()]);
            if (!$arrCatalogoAtividade) {
                continue;
            }
            $catalogoAtividade = reset($arrCatalogoAtividade);
            $arrInfoAtividade = explode(' - ', $arrAtividades[$catalogoAtividade->getIdAtividade()]);
            $arrDemandaServicoVinculo[$intIndice]['co_atividade'] = $arrInfoAtividade[0];
            $arrDemandaServicoVinculo[$intIndice]['no_atividade'] = $arrInfoAtividade[1];
            $arrDemandaServicoVinculo[$intIndice]['id_servico'] = $catalogoAtividade->getIdCatalogoServico();
            $arrDemandaServicoVinculo[$intIndice]['id_atividade'] = $catalogoAtividade->getIdAtividade();
        }
        return $arrDemandaServicoVinculo;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_ORDEM_DEMANDA_REMOVE_VINCULO
     */
    protected function removeVinculoDemandaAction($arrData)
    {
        try {
            $this->begin();
            $ordemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')->find($arrData['id_ordem_servico']);
            if ($ordemServico->getTpSituacao() != OrdemServicoEntity::CO_SITUACAO_ABERTA) {
                throw new Exception(
                    'Esta Ordem de Serviço não pode ser editar, encontra-se no status: ' . OrdemServicoEntity::$arrSituacaoDemanda[$ordemServico->getTpSituacao()]
                );
            }
            $arrDemandaVinculo = $this->findBy($arrData);
            if (!$arrDemandaVinculo) {
                throw new Exception('Vínculo não encontrado na ordem de serviço.');
            }
            $this->delete(reset($arrDemandaVinculo)->toArray());
            $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
            $demanda = $demandaService->find($arrData['id_demanda']);
            $demanda->setTpSituacao(DemandaEntity::SITUACAO_ATIVO)
                ->setIdUsuarioAlteracao($demandaService->getIdUsuarioLogado());
            $arrDemanda = $demanda->toArray();
            $arrDemanda['dt_alteracao'] = date('Y-m-d H:i:s');
            $arrDemanda['dt_abertura'] = Date::convertDateTemplate($arrDemanda['dt_abertura']);
            $demandaService->save($arrDemanda);
            $this->commit();
        } catch (\Exception $exception) {
            $this->rollback();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Metodo respnsavel por vincular a demanda na ordem de servio
     *
     * @param $intIdOrdemServico
     * @param $intIdDemanda
     * @throws \Exception
     */
    protected function vincularDemandaOrdemServico($intIdOrdemServico, $intIdDemanda)
    {
        try {
            $this->begin();
            if (!isset($intIdOrdemServico)) {
                throw new \Exception($this->strMsgE4);
            }
            $demandaService = $this->getService('OrdemServico\Service\DemandaFile');
            $this->deleteBy(array('id_demanda' => $intIdDemanda));
            $demanda = $demandaService->save([
                'id_demanda' => $intIdDemanda,
                'tp_situacao' => DemandaEntity::SITUACAO_VINCULADA
            ]);
            $ordemServicoDemanda = $this->save([
                'id_ordem_servico' => $intIdOrdemServico,
                'id_demanda' => $intIdDemanda,
                'id_usuario_alteracao' => $demanda->getIdusuarioAlteracao(),
                'dt_alteracao' => date('Y-m-d H:i:s')
            ]);
            $this->commit();
            return $ordemServicoDemanda;
        } catch (\Exception $exception) {
            $this->rollback();
            throw new \Exception($exception->getMessage());
        }
    }
}
