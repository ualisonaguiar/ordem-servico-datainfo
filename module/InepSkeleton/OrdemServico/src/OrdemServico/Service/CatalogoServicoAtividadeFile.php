<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceCache;
use InepZend\Service\ServiceAngularTrait;
use InepZend\View\RenderTemplate;
use InepZend\Exception\Exception;

class CatalogoServicoAtividadeFile extends AbstractServiceCache
{
    use RenderTemplate,
        ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_catalogo_servico_atividade');
    }

    protected function getAtividadeVinculadaServico($arrData)
    {
        if ($arrData['tipo'] == 'servico') {
            if (!array_key_exists('id_catalogo_servico', $arrData)) {
                $arrDemandaServico = $this->getService('OrdemServico\Service\DemandaServicoFile')
                    ->getValorAssesoriaServicoAction($arrData);
                $arrData['id_catalogo_servico'] = $arrDemandaServico['id_catalogo_servico'];
            } else
                $strContent = $this->atividadeServicoVinculadoDemandaContent($arrData);
        } else {
            if (!array_key_exists('acao', $arrData)) {
                $arrData = $this->getService('OrdemServico\Service\DemandaFile')->find($arrData['id_demanda'])->toArray();
            }
            $strContent = $this->getService('OrdemServico\Service\DemandaFile')->atividadeVinculadoDemandaContent($arrData);
        }
        return $strContent;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_CATALOGO_SERVICO_ATIVIDADE_ASSESSORIA
     */
    protected function getAtividadesVinculadaAssessoriaAction($arrData)
    {
        $arrCatalogoService = $this->getService('OrdemServico\Service\CatalogoServicoFile')
            ->findBy(array('area_assessoria' => $arrData['co_area_assessoria']));
        $arrCatologoService = array();
        if ($arrCatalogoService) {
            foreach ($arrCatalogoService as $catalogoService) {
                $arrCatologoService[] = array(
                    'value' => $catalogoService->getIdCatalogoServico(),
                    'name' => $catalogoService->getNoCatalogoServico(),
                );
            }
        }
        return $arrCatologoService;
    }

    /**
     * retornar o formulario contendo as atividades vinculadas.
     *
     * @param type $arrData
     * @return type
     */
    protected function atividadeServicoVinculadoDemandaContent($arrData)
    {
        $arrAtividade = array();
        $arrAtividadeVinculda = $this->findBy(array('id_catalogo_servico' => $arrData['id_catalogo_servico']));
        $atividadeService = $this->getService('OrdemServico\Service\AtividadeFile');
        $arrDemandaVinculadaServicoAtividade = $this->getValoresAtividadeVinculada($arrData['id_demanda']);
        foreach ($arrAtividadeVinculda as $atividadeVinculada) {
            $atividade = $atividadeService->find($atividadeVinculada->getIdAtividade());
            $arrAtividade[$atividadeVinculada->getIdCatalogoServicoAtividade()] = array(
                'id_atividade' => $atividade->getIdAtividade(),
                'id_catalogo_servico' => $atividadeVinculada->getIdCatalogoServicoAtividade(),
                'descricao' => $atividade->getCodigoAtividadeDescricao()
            );
            if (
                $arrDemandaVinculadaServicoAtividade &&
                !array_key_exists('id_atividade_' . $atividadeVinculada->getIdCatalogoServicoAtividade(), $arrDemandaVinculadaServicoAtividade)
            ) {
                unset($arrAtividade[$atividadeVinculada->getIdCatalogoServicoAtividade()]);
            }
        }
        natsort($arrAtividade);
        $formAtividadeVinculada = $this->getService('OrdemServico\Form\CatologoServico');
        $formAtividadeVinculada->prepareElementsAtividadeVinculada($arrAtividade);
        $formAtividadeVinculada->setData($arrDemandaVinculadaServicoAtividade);
        return $this->renderTemplate(
            'ordem-servico/catalogo-servico/_atividade-vinculada',
            array('form' => $formAtividadeVinculada)
        );
    }

    /**
     * Metodo responsavel por retornar os valores das atividades vinculadas.
     *
     * @param integer $intIdDemanda
     * @return array
     */
    protected function getValoresAtividadeVinculada($intIdDemanda)
    {
        $arrDataDemandaAtividade = $this->getService('OrdemServico\Service\DemandaServicoFile')
            ->findBy(array('id_demanda' => $intIdDemanda));
        $arrValorAtividade = array();
        if ($arrDataDemandaAtividade) {
            foreach ($arrDataDemandaAtividade as $demandaAtividade) {
                $catalogoAtividade = $this->find($demandaAtividade->getIdCatalogoServicoAtividade());
                $arrValorAtividade['id_atividade_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $catalogoAtividade->getIdAtividade();
                $arrValorAtividade['vl_complexidade_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlComplexidade();
                $arrValorAtividade['vl_impacto_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlImpacto();
                $arrValorAtividade['vl_criticidade_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlCriticidade();
                $arrValorAtividade['vl_facim_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlFacim();
                $arrValorAtividade['vl_qma_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlQma();
                $arrValorAtividade['vl_fator_ponderacao_' . $catalogoAtividade->getIdCatalogoServicoAtividade()] = $demandaAtividade->getVlFatorPonderacao();
            }
        }
        return $arrValorAtividade;
    }

    /**
     * Metodo responsavel por vincular as ativdades com o catalogo
     *
     * @param $intIdCatalogoServico
     * @param $arrAtividadeVinculadaPost
     * @throws Exception
     */
    protected function saveAtividadeVinculada($intIdCatalogoServico, $arrAtividadeVinculadaPost)
    {
        try {
            $this->begin();
            foreach ($arrAtividadeVinculadaPost as $arrAtividade) {
                if (!array_key_exists('id_catalogo_servico_atividade', $arrAtividade)) {
                    $this->insert([
                            'id_catalogo_servico' => $intIdCatalogoServico,
                            'id_atividade' => $arrAtividade['id_atividade']
                        ]
                    );
                }
            }
            $this->commit();
        } catch (\Exception $execption) {
            $this->rollback();
            throw Exception($execption->getMessage());
        }
    }
}
