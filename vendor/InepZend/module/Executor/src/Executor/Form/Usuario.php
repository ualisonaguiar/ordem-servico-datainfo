<?php

namespace InepZend\Module\Executor\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Executor\Entity\Usuario as UsuarioEntity;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class Usuario extends FormGenerator
{
    public function prepareElementSearch()
    {
        $strRoute = 'usuario';
        $arrInput = array(
            'dsLogin' => array(
                'type' => 'text',
                'label' => 'Usuário',
            ),
            'dsCpf' => array(
                'type' => 'text',
                'label' => 'CPF',
            ),
            'inAtivo' => array(
                'type' => 'Select',
                'label' => 'Situação',
                'value_options' => UsuarioEntity::$arrSituacao,
                'empty_option' => 'Selecione',
            ),
        );
        $arrButons = array(
            'btnPesquisar' => array(
                'type' => 'Button',
                'onclick' => 'filterPaginator(\'/' . $strRoute . '/ajaxFilter\', \'frm\');',
                'value' => 'Pesquisar'
            ),
            'btnClearForm' => array(
                'type' => 'ButtonClear',
            )
        );
        $this->addFormCrud('Filtros da Pesquisa', $arrInput, $arrButons);
        $this->addHtml('<br /><br />');
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute($strRoute);
        $flexigrid->setShowInsert(true);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setCol('DS_LOGIN', 'Usuário', 300, 'left', false);
        $flexigrid->setCol('IN_ATIVO', 'Situação', 100, 'left', false);
        $flexigrid->setCol('IN_PRODUCT_OWNER', 'Product Owner', 130, 'left', false);
        $flexigrid->setButton('Editar', 'fa fa-edit', null, null, true);
        $flexigrid->setButton('Ativo', 'fa fa-minus-circle situacao', null, null, true, 'verificarStatusAtivo');
        $flexigrid->setButton('Inativo', 'fa fa-plus-circle situacao', null, null, true, 'verificarStatusInativo');
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new UsuarioFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementManter($strTitle, $booEdit = false)
    {
        $arrInput = array(
            'dsLogin' => array(
                'type' => 'text',
                'label' => 'Usuário',
            ),
            'nuCpf' => array(
                'type' => 'cpf',
                'label' => 'CPF',
            ),
            'inAtivo' => array(
                'type' => 'Select',
                'label' => 'Situação',
                'value_options' => UsuarioEntity::$arrSituacao,
                'empty_option' => 'Selecione',
                'value' => UsuarioEntity::SITUACAO_ATIVO
            ),
            'inProductOwner' => array(
                'type' => 'Checkbox',
                'label' => 'Product Owner',                
            ),
        );

        if ($booEdit) {
            $arrInput['idUsuario'] = array('type' => 'hidden');
        }

        $arrButons = array(
            'btnSalvar' => array(
                'type' => 'ButtonSave',
                'value' => 'Salvar'
            ),
            'btnVoltar' => array(
                'type' => 'Button',
                'class' => 'btn-inep btn-comum',
                'title' => 'Voltar',
                'onclick' => 'window.location.href=strGlobalBasePath + \'/usuario\';'
            ),
        );
        $arrParam = array(
            'required' => array(
                'dsLogin' => true,
                'dsCpf' => true,
                'inAtivo' => true,
            )
        );
        $this->addFormCrud($strTitle, $arrInput, $arrButons, $arrParam);
        $this->setInputFilter(new UsuarioFilter(__FUNCTION__));
    }
}
