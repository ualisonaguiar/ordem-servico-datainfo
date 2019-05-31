<?php

namespace InepZend\Module\Executor\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Executor\Entity\Email as EmailEntity;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class EnvioEmail extends FormGenerator
{

    public function prepareElemenTelaEnvio($intIdEmail)
    {
        $arrInput = array(
            'idEmail' => array(
                'type' => 'hidden',
            ),
            'dsSituacao' => array(
                'type' => 'select',
                'label' => 'Situação de Envio',
                'value_options' => EmailEntity::$arrSituacao,
                'empty_option' => 'Selecione'
            ),
            'dsDestinatario' => array(
                'type' => 'text',
                'label' => 'Destinatário',
            ),
            'dsDestinatarioCopia' => array(
                'type' => 'text',
                'label' => 'Destinatário com Cópia',
            ),
            'dsAssunto' => array(
                'type' => 'text',
                'label' => 'Assunto',
            ),
            'dsTexto' => array(
                'type' => 'textarea',
                'label' => 'Mensagem',
            ),
        );
        $arrButton = array();
        $booDisabled = ($intIdEmail) ? true : false;
        if (!$booDisabled) {
            $arrButton['btnPesquisar'] = array('type' => 'ButtonSave');
        } else {
            $arrButton['btnReenvio'] = array(
                'type' => 'Button',
                'class' => 'btn-inep btn-comum btnReenvio',
                'title' => ' Reenvio',
            );
        }
        $arrButton['btnVoltar'] = array(
            'type' => 'Button',
            'class' => 'btn-inep btn-comum',
            'title' => 'Voltar',
            'onclick' => 'window.location.href=strGlobalBasePath + \'/query\';'
        );
        $arrParam = array(
            'required' => array(
                'dsDestinatario' => true,
                'dsAssunto' => true,
                'dsTexto' => true,
            ),
            'disabled' => array(
                'dsSituacao' => true,
                'dsDestinatario' => $booDisabled,
                'dsDestinatarioCopia' => $booDisabled,
                'dsAssunto' => $booDisabled,
                'dsTexto' => $booDisabled,
            )
        );
        $flexigrid = new FlexigridHelper();
        $strUrl = '/envio-operacao/ajax-listagem-historico';
        $flexigrid->setUrlPaging($strUrl . (($intIdEmail) ? '/' . $intIdEmail : ''));
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('DS_USUARIO', 'Usuário', 400, 'left', false);
        $flexigrid->setCol('DT_EXECUCAO', 'Data', 150, 'left', false);
        $flexigrid->setCol('TP_SITUACAO', 'Situação', 200, 'left', false);
        $flexigrid->setButton('Histórico de Execução', 'fa fa-info-circle', null, null, true);
        if (!$intIdEmail) {
            $flexigrid->setButton('Remover Parâmetros', 'fa fa-remove remove-operacao-mail', null, null, true);
        }
        $this->addFormCrud('Envio de Operações', $arrInput, $arrButton, $arrParam);
        $this->addHtml('<div class="well"><h3>Quadros de Execuções</h3>');
        $this->addHtml($flexigrid->showGrid());
        $this->addHtml('</div>');
        $this->setInputFilter(new EnvioEmailFilter());
    }

    public function prepareElemenTelaHistoricoEnvio()
    {
        $flexigrid = new FlexigridHelper();
        $flexigrid->setUrlPaging('/historico-envio-operacao/ajax-listagem');
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('DS_DESTINATARIO', 'Destinatário', 400, 'left', false);
        $flexigrid->setCol('DS_ASSUNTO', 'Assunto', 300, 'left', false);
        $flexigrid->setCol('DT_ENVIO', 'Data de Envio', 150, 'left', false);
        $flexigrid->setCol('TP_SITUACAO', 'Situação', 80, 'left', false);
        $flexigrid->setCol('ID_EMAIL', 'ID', 80, 'left', false);
        $flexigrid->setJsFunctionAccordion('teste');
        $flexigrid->setButton('Detalhes do Envio', 'fa fa-info-circle info-envio', null, null, true);
        $flexigrid->setButton('Download do Anexo', 'fa fa-arrow-circle-o-down', null, null, true);
        $flexigrid->setButton('Reenvio', 'fa fa-reply', null, null, true);
        $this->addHtml($flexigrid->showGrid());
    }
}
