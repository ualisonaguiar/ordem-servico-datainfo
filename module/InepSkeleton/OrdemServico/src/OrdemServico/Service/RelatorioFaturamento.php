<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use InepZend\Util\Date;
use InepZend\View\RenderTemplate;
use InepZend\Util\String;
use InepZend\Pdf\Vendor\mpdf\Mpdf;
use InepZend\Paginator\Paginator;
use InepZend\Service\ServiceAngularTrait;

class RelatorioFaturamento extends AbstractServiceManager
{
    use RenderTemplate,
        ServiceAngularTrait;

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_GERAR_RELATORIO
     */
    protected function gerarRelatorioAction(array $arrData)
    {
        if (!$arrData['arrIdOrdemServico'])
            return null;
        $arrOrdemServicoPrazo = $arrData['arrIdOrdemServico'];
        $arrDemandaVinculo = $this->getDemandas($arrOrdemServicoPrazo);

        foreach ($arrOrdemServicoPrazo as $intPosicao => $arrOrdemServico) {
            $arrOrdemServicoPrazo[$arrOrdemServico['nu_ordem_servico']] = $arrOrdemServico;
            unset ($arrOrdemServicoPrazo[$intPosicao]);
        }

        $strContent = $this->renderTemplate(
            'ordem-servico/relatorio-faturamento/_partial/_relatorio-tecnico',
            array(
                'arrOrdemServico' => $arrOrdemServicoPrazo,
                'mesAnoReferencia' => $arrData["ds_mes_ano_relatorio"],
                'arrDemandas' => $arrDemandaVinculo,
                'numeroRelatorio' => $arrData["ds_nr_relatorio"],
                'dataRelatorio' => $arrData["dt_relatorio"]
  
            )
        );
        $strBasePath = getBasePathApplication() . '/data/OrdemServico/documento/';
        $strBasePath .= 'relatorio_faturamento_' . date('YmdHis') . '.pdf';
        $mpdf = new Mpdf('c');
        $mpdf->SetFooter('Relatório de Faturamento ' . String::beautifulProperName(Date::getPortugueseMonth(date('m'))) . ' de ' . date('Y'));
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($strContent);
        $mpdf->mirrorMargins = 1;
        $mpdf->Output($strBasePath);
        return str_replace(getBasePathApplication(), '', $strBasePath);
    }

    protected function getDemandas($arrOrdemServicoPrazo)
    {
        $arrInfoDemanda = [];
        $serviceOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile');
        foreach ($arrOrdemServicoPrazo as $arrOrdemServico) {
            $arrInfoDemanda[$arrOrdemServico['nu_ordem_servico']] = $serviceOrdemServico->getDemandasVinculadaOrdemServicoImpressao($arrOrdemServico['id_ordem_servico']);
        }
        ksort($arrInfoDemanda);
        return $arrInfoDemanda;
    }

    protected function getListaOrdemServicoAction($arrCriteria)
    {
        $arrCriteria = array_merge(['tp_situacao' => OrdemServicoEntity::CO_SITUACAO_FINALIZADA], $arrCriteria);
        $arrOrdemServico = $this->getService('OrdemServico\Service\OrdemServicoFile')
            ->getListagemOrdemServicoRelatorio($arrCriteria);
        if ($arrOrdemServico) {
            foreach ($arrOrdemServico as $intPosicao => $ordemServico) {
                $arrOrdemServico[$intPosicao]->setDtPrazo(Date::convertDate($ordemServico->getDtPrazo(), 'd/m/Y H:i:s'));
            }
        }
        return $arrOrdemServico;
    }
}
