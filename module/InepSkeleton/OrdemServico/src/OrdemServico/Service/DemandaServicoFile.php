<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;

class DemandaServicoFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_demanda', 'id_catalogo_servico_atividade');
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_VALOR_ASSESSORIA_SERVICO
     */
    protected function getValorAssesoriaServicoAction($arrDataPost)
    {
        $arrDemandaAtividade = $this->findBy($arrDataPost, array(), 1);
        $arrInfoAssessoriaServico = array();
        if ($arrDemandaAtividade) {
            $demanda = $this->getService('OrdemServico\Service\DemandaFile')->find($arrDataPost['id_demanda']);
            $arrInfoAssessoriaServico['tipo_servico'] = ($demanda->getIdAtividade()) ? 'Atividade' : 'Servico';
            $arrCatalogoServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')
                ->findBy(
                    array('id_catalogo_servico_atividade' => $arrDemandaAtividade[0]->getIdCatalogoServicoAtividade()),
                    array(),
                    1
                );
            if (!empty($arrDemandaAtividade)) {
                $catalogoService = $this->getService('OrdemServico\Service\CatalogoServicoFile')->find($arrCatalogoServico[0]->getIdCatalogoServico());
                $arrInfoAssessoriaServico['id_catalogo_servico'] = $arrCatalogoServico[0]->getIdCatalogoServico();
                $arrInfoAssessoriaServico['no_catalogo_servico'] = $arrCatalogoServico[0]->getNoCatalogoServico();
                $arrInfoAssessoriaServico['assessinatura'] = $catalogoService->getAreaAssessoria();
            }
        }
        return $arrInfoAssessoriaServico;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DEMANDA_INFORMACAO_ALTERACAO
     */
    protected function getInformacaoAlteracaoDemandaAction($arrDataPost)
    {
        $demanda = $this->getService('OrdemServico\Service\DemandaFile')->find($arrDataPost['id_demanda']);
        if (!$demanda->getIdUsuarioAlteracao()) {
            return [];
        }
        $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($demanda->getIdUsuarioAlteracao());
        return [
            'dt_alteracao' => $demanda->getDtAlteracao(),
            'no_usuario' => $usuario->getNoUsuario()
        ];
    }

    protected function hasDemandaVinculoServico($intIdCatalogoServico)
    {
        $arrDemandaServico = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')
            ->findBy(array('id_catalogo_servico' => $intIdCatalogoServico));
        $booStatus = false;
        if ($arrDemandaServico) {
            foreach ($arrDemandaServico as $demandaServico) {
                $arrVinculo = $this->findBy(array('id_catalogo_servico_atividade' => $demandaServico->getIdCatalogoServicoAtividade()));
                if ($arrVinculo) {
                    $booStatus = true;
                    break;
                }
            }
        }
        return $booStatus;
    }
}
