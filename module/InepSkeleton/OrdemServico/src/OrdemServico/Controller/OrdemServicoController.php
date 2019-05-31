<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;
use OrdemServico\Form\OrdemServicoAceite as OrdemServicoAceiteForm;

class OrdemServicoController extends AbstractController
{

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
        $this->arrPk = array('id_ordem_servico');
        $this->arrMethodPk = array('getIdOrdemServico');
        $this->arrMethodPaging = array('getNuOrdemServico', 'getDtEmissao', 'getTpSituacao');
    }

    public function ajaxAceiteLoteAction()
    {
        $form = new OrdemServicoAceiteForm();
        $form->prepareElementsFilter();
        $strHtml = $this->renderTemplate(
            'ordem-servico/ordem-servico/_partial/_aceite-lote',
            array('form' => $form)
        );
        return $this->getViewClearContent($strHtml);
    }
}
