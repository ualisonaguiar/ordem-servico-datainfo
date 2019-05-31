<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;

class DemandaController extends AbstractController
{

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
        $this->arrPk = array('id_demanda');
        $this->arrMethodPk = array('getIdDemanda');
        $this->arrMethodPaging = array('getNoDemanda', 'getDtAbertura', 'getIdAtividade', 'getDsExecutor', 'getInSituacao');
    }

    public function atividadeVinculadaServicoAction()
    {
        $strContentAtividade = '';
        $arrDataPost = $this->getPost();
        if (array_key_exists('id_catalogo_servico', $arrDataPost) || array_key_exists('id_demanda', $arrDataPost)) {
            $strContentAtividade = $this->getService('OrdemServico\Service\CatalogoServicoAtividadeFile')
                ->getAtividadeVinculadaServico($arrDataPost);
        }
        return $this->getViewClearContent($strContentAtividade);
    }

    /**
     * @auth no
     * @return mixed
     */
    public function correcaoDemandaDataAction()
    {
        $this->getService('OrdemServico\Service\CorrecaoDados')->correcaoDemandaDataAction();
        return $this->getViewClearContent('Fim da Correção/Migração');
    }

}
