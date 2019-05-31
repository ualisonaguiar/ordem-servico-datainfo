<?php

namespace OrdemServico\Service;

use InepZend\Paginator\Paginator;
use InepZend\Service\AbstractServiceManager;
use InepZend\View\RenderTemplate;
use InepZend\Service\ServiceAngularTrait;
use OrdemServico\Entity\OrdemServico;

class RelatorioGestorProjeto extends AbstractServiceManager
{
    use RenderTemplate,
        ServiceAngularTrait;

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_FIND
     */
    public function findByPagedAction($arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $arrRegister = null)
    {
        $arrCriteriaOs = [];
        if (array_key_exists('nu_ordem_servico', $arrCriteria)) {
            $arrCriteriaOs['nu_ordem_servico'] = (strpos($arrCriteria['nu_ordem_servico'], ',') !== true) ? explode(',', $arrCriteria['nu_ordem_servico']) : [$arrCriteria['nu_ordem_servico']];
        }
        $arrOrdemServico = $this->getService('OrdemServico\Service\VwDemandaVinculadaOrdemServicoFile')->findBy($arrCriteriaOs, ['nu_ordem_servico' => 'desc']);
        $arrResultPaginator = [];
        $arrSomaOrdem = [];
        if ($arrOrdemServico) {
            foreach ($arrOrdemServico as $ordemServico) {
                $arrSomaOrdem[$ordemServico->getIdOrdemServico()] += $ordemServico->getVlQma();
                $arrResultPaginator[$ordemServico->getIdOrdemServico()] = [
                    'id_ordem_servico' => $ordemServico->getIdOrdemServico(),
                    'numero_os' => str_pad($ordemServico->getNuOrdemServico(), 4, '0', STR_PAD_LEFT),
                    'descricao_os' => $ordemServico->getDescricaoOs(),
                    'dt_fim' => $ordemServico->getDtPrazo(),
                    'tp_situacao' => OrdemServico::$arrSituacaoDemanda[$ordemServico->getTpSituacao()],
                    'vlr_mat' => $arrSomaOrdem[$ordemServico->getIdOrdemServico()]
                ];
            }
        }
        return new Paginator($arrResultPaginator, $intPage, $intItemPerPage);
    }
}
