<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait;
use InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper;
use InepZend\Module\TrocaArquivo\Common\Entity\MassaTeste as MassaTesteEntity;

class MassaTeste extends FormGenerator
{

    use CommonTrait;

    public function prepareElementsSearch()
    {
        $strRoute = 'massateste';
        $arrInput = array(
            'coProjeto' => array(
                'type' => 'Select',
                'label' => 'Projeto',
                'value_options' => $this->getListProjeto(),
                'empty_option' => 'Selecione',
            ),
            'coEvento' => array(
                'type' => 'Select',
                'label' => 'Evento',
                'value_options' => $this->getListEventData(),
                'empty_option' => 'Selecione',
            ),
            'id_layout' => array(
                'type' => 'Select',
                'label' => 'Layout',
                'value_options' => $this->getListLayout(),
                'empty_option' => 'Selecione',
            )
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
        $flexigrid->setCol('NO_PROJETO', 'Nome do Projeto', 250, 'left', false);
        $flexigrid->setCol('NO_EVENTO', 'Nome do Evento', 150, 'left', false);
        $flexigrid->setCol('NO_LAYOUT', 'Nome do Layout', 190, 'left', false);
        $flexigrid->setCol('NO_STATUS', 'Situação do Processamento', 190, 'left', false);
        $flexigrid->setCol('DT_CRIACAO', 'Data Criação', 150, 'left', false);
        $flexigrid->setCol('NU_QUANTIDADE_LINHA', 'Quantidade de Linhas', 150, 'left', false);
        $flexigrid->setButton('Download', 'fa fa-download', null, null, true);
        $flexigrid->setButton('Processar arquivo gerado', 'fa fa-share', null, null, true, 'checkStatus');
        $this->addHtml($flexigrid->showGrid());
        $this->setInputFilter(new LayoutFileFilter(__FUNCTION__));
    }

    public function prepareElementsAdd()
    {
        $arrInput = array(
            'nu_tipo_massa_aleatoriamente' => array(
                'type' => 'MultiCheckbox',
                'label' => 'Tipo de Massa de dados',
                'value_options' => MassaTesteEntity::$arrTipoMassa,
                'value' => 'A'
            ),
            'id_layout' => array(
                'type' => 'Select',
                'required' => true,
                'label' => 'Layout',
                'value_options' => $this->getListLayout(),
                'empty_option' => 'Selecione',
            ),
            'nu_quantidade_linha' => array(
                'type' => 'Number',
                'label' => 'Quantidade de linhas que será gerado no arquivo',
                'placeholder' => 'Quantidade de linhas que será gerado no arquivo',
            )
        );
        $arrButons = array(
            'btnSalvar' => array(
                'type' => 'ButtonSave'
            ),
            'btnVoltar' => array(
                'type' => 'Button',
                'class' => 'btn-inep btn-comum',
                'title' => 'Voltar',
                'onclick' => 'window.location.href=strGlobalBasePath + \'/massateste\';'
            ),
        );
        $arrParam = array(
            'required' => array(
                'nu_tipo_massa_aleatoriamente' => true,
                'id_layout' => true,
                'nu_quantidade_linha' => true,
            ),
        );
        $this->addFormCrud('Cadastro de Gerador de Massa', $arrInput, $arrButons, $arrParam);
        $this->setInputFilter(new LayoutFileFilter(__FUNCTION__));
    }

    public function prepareCreateDefault($layout, $configuracaoFile, $configuracaoContatoFile, $interdependenciaFile, $responsavelFile, $tipo)
    {
        $this->addHtml('<div class="well">');
        $this->addButton(array('title' => 'Gerar/Regerar', 'type' => 'submit'));
        $this->addHtml('<br /><br /></div>');
        $arrLayout = [];
        $arrConfigs = [];
        $arrConfiguracaoContatoFile = [];
        $arrInterdependenciaFile = [];
        $arrResponsavelFile = [];
        $arrTipo = [];
        foreach ($layout as $layoutValue) {
            $arrLayout[] = [
                'no_layout' => $layoutValue->getNoLayout(),
                'ds_caminho' => $layoutValue->getDsCaminho(),
                'ds_url' => $layoutValue->getDsUrl(),
                'ds_encode' => $layoutValue->getDsEncode(),
                'ds_separador_coluna' => $layoutValue->getDsSeparadorColuna(),
                'ds_separador_linha' => $layoutValue->getDsSeparadorLinha(),
            ];
        }
        foreach ($configuracaoFile as $value) {
            $arrConfigs[] = array(
                'Projeto' => reset($this->getListProjeto(array('coProjeto' => (int) $value->getCoProjeto(), 'coEvento' => (int) $value->getCoEvento()))),
                'Evento' => reset($this->getListEventData(array('coProjeto' => (int) $value->getCoProjeto(), 'coEvento' => (int) $value->getCoEvento()))),
                'UF' => $value->getSgUf(),
                'Destino' => $value->getDsDestino(),
                'Prioridade' => $value->getDsPrioridade(),
                'id_configuracao' => $value->getIdConfiguracao(),
                'ds_validacao_impeditiva' => $value->getDsValidacaoImpeditiva(),
            );
        }
        foreach ($configuracaoContatoFile as $value) {
            $arrConfiguracaoContatoFile[] = [
                'Email' => $value->getDsEmail(),
            ];
        }
        foreach ($interdependenciaFile as $value) {
            $arrInterdependenciaFile[] = [
                'id_layout' => $value->getIdLayout(),
                'id_layout_dependente' => $value->getIdLayoutDependente(),
            ];
        }
        foreach ($responsavelFile as $value) {
            $arrResponsavelFile[] = [
                'id_usuario_sistema' => $value->getIdUsuarioSistema(),
                'co_projeto' => $value->getCoProjeto(),
                'sg_uf' => $value->getSgUf(),
            ];
        }
        foreach ($tipo as $value) {
            $arrTipo[] = [
                'no_tipo' => $value->getNoTipo(),
                'no_tipo_banco' => $value->getNoTipoBanco(),
            ];
        }
        $this->addTable(
                array('name' => 'layout',
                    'label' => 'Layout',
                    'value' => $arrLayout,
                    'title' => array(
                        'Layout' => array('no_layout'),
                        'Caminho' => array('ds_caminho'),
                        'URL' => array('ds_url'),
                        'Encode' => array('ds_encode'),
                        'Separador por Coluna' => array('ds_separador_coluna'),
                        'Separador por Linha' => array('ds_separador_linha'),
                    ),
                    'show_no_register' => true)
        );
        $this->addTable(
                array('name' => 'configFile',
                    'label' => 'Configuração',
                    'value' => $arrConfigs,
                    'title' => array(
                        'Projeto' => array('Projeto', 'width: 15%;'),
                        'Evento' => array('Evento', 'width: 25%;'),
                        'UF' => array('UF', 'width: 5%;'),
                        'Destino' => 'Destino',
                        'Validação Impeditiva' => array('ds_validacao_impeditiva', 'width: 11%;'),
                        'Prioridade' => array('Prioridade', 'width: 11%;'),
                    ),
                    'show_no_register' => true)
        );
        $this->addTable(
                array('name' => 'interdependencia',
                    'label' => 'Interdependência',
                    'value' => $arrInterdependenciaFile,
                    'title' => array(
                        'Id do Layout' => array('id_layout', 'width: 11px;'),
                        'Id do Layout Dependente' => array('id_layout_dependente', 'width: 11px;'),
                    ),
                    'show_no_register' => true)
        );
        $this->addTable(
                array('name' => 'configContatoFile',
                    'label' => 'Configuração Contato',
                    'value' => $arrConfiguracaoContatoFile,
                    'title' => array(
                        'Contato' => array('Email')
                    ),
                    'show_no_register' => true)
        );
        $this->addTable(
                array('name' => 'arquivo',
                    'label' => 'Responsável',
                    'value' => $arrResponsavelFile,
                    'title' => array(
                        'IdUsuarioSistema' => array('id_usuario_sistema', 'width: 25%;'),
                        'CoProjeto' => 'co_projeto',
                        'UF' => array('sg_uf', 'width: 11%;'),
                    ),
                    'show_no_register' => true)
        );
        $this->addTable(
                array('name' => 'tipo',
                    'label' => 'Tipo',
                    'value' => $arrTipo,
                    'title' => array(
                        'Tipo' => 'no_tipo',
                        'Tipo no Banco' => array('no_tipo_banco'),
                    ),
                    'show_no_register' => true)
        );
        
    }

}
