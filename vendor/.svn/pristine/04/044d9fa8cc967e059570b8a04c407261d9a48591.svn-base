<?php

namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;

class LayoutFile extends FormGenerator
{
    use CommonTrait;

    protected $arrLayoutItems;

    public function prepareElementsFindLayout()
    {
        $this->addFormCrud('Busca de Layout', $this->inputsFindLayout(), $this->buttonsFindLayout());
        $flexigrid = new FlexigridHelper();
        $flexigrid->setRoute('layoutfile');
        $flexigrid->setCol('getNoLayout', 'Layout', 100, 'center');
        $flexigrid->setCol('getDsCaminho', 'Evento', 800);
        $flexigrid->setCol('getInStatus', 'Status', 100, 'center');
        $flexigrid->setShowInsert(false);
        $flexigrid->setShowUpdate(false);
        $flexigrid->setShowDelete(false);
        $flexigrid->setButton('Cadastrar Configurações', 'fa fa-gear', 'redirecionarConfiguracao', null, true);
        $flexigrid->setButton('Cadastrar Estrutura', 'fa fa-sort-amount-asc', 'redirecionarEstrutural', null, true);
        $flexigrid->setButton('Cadastrar Regra de Validação', 'fa fa-sitemap', 'redirecionarRegraValidacao', null, true);
        $flexigrid->setButton('Desativar', 'fa fa-check-square-o', 'changeStatus', null, true, 'condicao');
        $flexigrid->setButton('Ativar', 'fa fa-square-o', 'changeStatus', null, true, 'condicao2');
        $this->addHtml($flexigrid->showGrid());
        return $this;
    }

    public function prepareElementsLayoutAdd()
    {
        $this->inputsLayoutAdd();
        $this->buttons();
        $this->setInputFilter(new LayoutFileFilter(__FUNCTION__));
        return $this;
    }

    public function inputsLayoutAdd()
    {
        $this->addText(
            [
                'name'        => 'no_layout',
                'label'       => 'Nome do Layout',
                'required'    => true,
                'maxlength'   => '100',
                'group_style' => 'width: 41%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_caminho',
                'label'       => 'Caminho',
                'required'    => false,
                'maxlength'   => '400',
                'group_style' => 'width: 30%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_url',
                'label'       => 'URL',
                'required'    => false,
                'maxlength'   => '200',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_encode',
                'label'       => 'Encode',
                'required'    => false,
                'maxlength'   => '20',
                'group_style' => 'width: 15%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_separador_coluna',
                'label'       => 'Separador de coluna',
                'required'    => false,
                'maxlength'   => '3',
                'group_style' => 'width: 13%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_separador_linha',
                'label'       => 'Separador de linha',
                'required'    => false,
                'maxlength'   => '3',
                'group_style' => 'width: 13%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_procedure',
                'label'       => 'Procedure',
                'required'    => false,
                'maxlength'   => '200',
                'group_style' => 'width: 30%; padding-right: 10px; float: left;',
            ]
        );
        $this->addText(
            [
                'name'        => 'ds_table',
                'label'       => 'Table',
                'required'    => false,
                'maxlength'   => '200',
            ]
        );
        $this->addTransfer(
            [
                'name'          => 'id_layout_dependente',
                'label'         => 'Depende do Layout',
                'value_options' => $this->getListLayout(),
            ]
        );
    }

    public function buttons()
    {
        $this->addButton(
            [
                'name'  => 'btnSalvarFile',
                'id'    => 'btnSalvarFile',
                'class' => 'btn-inep btn-comum',
                'title' => 'Salvar',
                'type'  => 'submit'
            ]
        );
        $this->addButton(
            [
                'name'  => 'btnCancelar',
                'id' => 'btnCancelar',
                'class' => 'btnDefault btn btn-info',
                'title' => 'Cancelar',
                'onclick' => 'window.location.href=strGlobalBasePath + \'/layoutfile\';'
            ]
        );
    }

    public function inputsFindLayout()
    {
        return array(
            'id_layout' => array(
                'type' => 'select',
                'label' => 'Layout:',
                'value_options' => $this->getListLayout(),
                'empty_option' => 'Selecione o Layout',
            ),
            'co_evento' => array(
                    'type' => 'select',
                    'label' => 'Evento:',
                    'value_options' => $this->getListEvento(),
                    'empty_option' => 'Selecione o Evento',
            ),
        );
    }

    public function buttonsFindLayout()
    {
        return array(
            'btnPesquisar' =>
                [
                    'type'    => 'Button',
                    'id'      => 'btnPesquisar',
                    'class'   => 'btn-inep btn-comum',
                    'title'   => 'Pesquisar',
                    'onclick' => 'filterPaginator(\'/layoutfile/ajaxFilter\', \'frm\');'
                    
                ],
            'btnInserir'   => [
                'type'    => 'Button',
                'id'      => 'btnInserir',
                'class'   => 'btn-inep btn-comum',
                'title'   => 'Inserir',
                'onclick' => 'window.location.href=strGlobalBasePath + \'/layoutfile/add\';'
            ]
        );
    }

    /**
     * Popular o atributo com o array contendo os layouts cadastrados
     * @param array $arrAnoPremioInovacao
     */
    public function setArrLayoutItems(array $arrLayoutItems = array())
    {
        $this->arrLayoutItems = $arrLayoutItems;
    }

}