<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceCache;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Paginator\Paginator;
use OrdemServico\Entity\Atividade as AtividadeEntity;
use InepZend\Exception\Exception;

class CatalogoServicoFile extends AbstractServiceCache
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_catalogo_servico');
    }

    /**
     * Metodo responsavel pela paginacao.
     *
     * @param array $arrCriteria
     * @param type $strSortName
     * @param type $strSortOrder
     * @param type $intPage
     * @param type $intItemPerPage
     * @param type $arrRegister
     * @return Paginator
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $arrRegister = null)
    {
        if ($arrCriteria === null) {
            $arrCriteria = [];
        }
        $arrCatalogo = $this->getRepositoryEntity()->listagem($arrCriteria);
        natcasesort($arrCatalogo);
        foreach ($arrCatalogo as $intPosicao => $catalogo) {
            $arrResult = $this->getAtividadeCatalogo($catalogo->getIdCatalogoServico());
            $arrCatalogo[$intPosicao]->area = $arrResult['area'];
            $arrCatalogo[$intPosicao]->codigo = $arrResult['codigo'];
        }
        return new Paginator($arrCatalogo, $intPage, $intItemPerPage);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_SAVE
     */
    protected function saveAction(array $arrData, $arrSetterFk = array(), $mixForm = null)
    {
        try {
            $this->begin();
            $catologoService = $this->save(
                array(
                    'id_catalogo_servico' => $arrData['id_catalogo_servico'],
                    'no_catalogo_servico' => $arrData['no_catalogo_servico'],
                    'co_atividade' => $arrData['co_atividade'],
                    'area_assessoria' => '',
                )
            );
            $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')
                ->saveAtividadeVinculada($catologoService->getIdCatalogoServico(), $arrData['id_atividade_vinculada']);
            $strAreaAssesoria = $this->getAssessoriaAtividadeVinculada($arrData['id_atividade_vinculada']);
            $catologoService->setAreaAssessoria($strAreaAssesoria);
            $catalogo = $this->save($catologoService->toArray());
            $this->commit();
            return $catalogo;
        } catch (Exception $exception) {
            $this->rollback();
            throw new Exceptin($exception->getMessage());
        }
    }

    /**
     * Metodo responsavel por retonar o catalogo de servico com a atividade vinculada.
     *
     * @param type $intIdCatalogoServico
     * @return type
     */
    protected function getAtividadeCatalogo($intIdCatalogoServico)
    {
        $arrAtividadeServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')->findBy(array('id_catalogo_servico' => $intIdCatalogoServico));
        $atividadeService = $this->getService('OrdemServico\Service\AtividadeFile');
        $arrAreaAtividade = array();
        $arrCodAtividade = array();
        foreach ($arrAtividadeServico as $atividadeServico) {
            $atividade = $atividadeService->find($atividadeServico->getIdAtividade());
            $arrAreaAtividade[] = $atividade->getDsAreaAssessoria();
            $arrCodAtividade[] = $atividade->getCoAtividade();
        }
        $arrAreaAtividade = array_unique($arrAreaAtividade);
        natsort($arrAreaAtividade);
        return array(
            'area' => str_replace(array('ANÁLISE DE ', 'PARA SISTEMAS', ' DE SISTEMAS'), ' ', implode(', ', $arrAreaAtividade)),
            'codigo' => implode(', ', $arrCodAtividade),
        );
    }

    protected function deleteAction(array $arrData, $entity = null)
    {
        try {
            $booHasVinculo = $this->getService('OrdemServico\Service\DemandaServicoFile')
                ->hasDemandaVinculoServico($arrData['id_catalogo_servico']);
            if ($booHasVinculo) {
                throw new \Exception('Esta Catálogo de serviço encontra-se atribuída a uma demanda.');
            }
            return $this->delete($arrData);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    protected function migrarAtividadeCatalogo()
    {
        $arrAtividade = $this->getService('OrdemServico\Service\AtividadeFile')->findBy();
        foreach ($arrAtividade as $atividade) {
            $arrDataCatalogo = array(
                'no_catalogo_servico' => $atividade->getCodigoAtividadeDescricao(),
                'id_catalogo_servico' => '',
                'co_atividade' => '',
                'id_atividade_vinculada' => array(
                    array_merge(
                        $atividade->toArray(),
                        array(
                            'no_atividade' => $atividade->getCodigoAtividadeDescricao()
                        )
                    )
                )
            );
            $this->saveAction($arrDataCatalogo);
        }
    }

    /**
     * @param $arrDataPost
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_CATALOGO_REMOVE_VINCULO
     */
    protected function removeVinculoAction($arrDataPost)
    {
        try {
            $arrDemandaServico = $this->getService('OrdemServico\Service\DemandaServicoFile')->findBy($arrDataPost);
            if ($arrDemandaServico) {
                $arrDemandaVinculo = array();
                foreach ($arrDemandaServico as $demandaServico)
                    $arrDemandaVinculo[] = $demandaServico->getIdDemanda();
                throw new \Exception('Esta atividade encontra-se ' . count($arrDemandaServico) . ' vínculo(s) nas demandas de código: ' . implode(', ' , $arrDemandaVinculo));
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    private function getAssessoriaAtividadeVinculada($arrAtividadeVinculada)
    {
        $arrAreaAssesoria = array();
        $arrTipoAssessoriaAtividade = array(
            AtividadeEntity::CO_ASSESSORIA_ARQUITETURA => array('A', 'B'),
            AtividadeEntity::CO_ASSESSORIA_NEGOCIO => array('N')
        );
        foreach ($arrAtividadeVinculada as $arrAtividade) {
            $strSiglaAtividade = substr($arrAtividade['no_atividade'], 0, 1);
            if (in_array($strSiglaAtividade, $arrTipoAssessoriaAtividade[AtividadeEntity::CO_ASSESSORIA_ARQUITETURA]) !== false) {
                $arrAreaAssesoria[] = AtividadeEntity::CO_ASSESSORIA_ARQUITETURA;
            }
            if (in_array($strSiglaAtividade, $arrTipoAssessoriaAtividade[AtividadeEntity::CO_ASSESSORIA_NEGOCIO]) !== false) {
                $arrAreaAssesoria[] = AtividadeEntity::CO_ASSESSORIA_NEGOCIO;
            }
        }
        sort($arrAreaAssesoria);
        return implode('/', array_unique($arrAreaAssesoria));
    }
}
