<?php

namespace InepZend\Module\TrocaArquivo\ConfigEnvio\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait;

class ConfigEnvio extends FormGenerator
{

    use CommonTrait;

    public function prepareElementsConfigEnvio($intIdLayout = null)
    {
        $this->addFormCrud('Adicionar configuração', $this->inputs($intIdLayout), $this->buttons($intIdLayout), array('disabled' => array('id_layout_combo' => true), 'required' => array('id_layout_combo' => true, 'co_projeto' => true, 'co_evento' => true, 'sg_uf' => true,)));
        $this->setInputFilter(new ConfigEnvioFilter(__FUNCTION__));
        return $this;
    }

    public function inputs($intIdLayout)
    {
        $arrConfigs = [];
        $mixConfigs = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy(array('id_layout' => (int) $intIdLayout));
        if (is_array($mixConfigs)) {
            foreach ($mixConfigs as $value) {
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
        }
        return array(
            'id_layout' =>
            [
                'type' => 'Hidden',
                'value' => $intIdLayout,
            ],
            'id_layout_combo' =>
            [
                'type' => 'Select',
                'label' => 'Layout:',
                'value_options' => $this->getListLayout(),
                'value' => $intIdLayout,
                'empty_option' => 'Selecione',
                'group_style' => 'width: 20%; padding-right: 10px; float: left;',
            ],
            'co_projeto' =>
            [
                'type' => 'Select',
                'label' => 'Projeto:',
                'value_options' => $this->getListProjeto(),
                'empty_option' => 'Selecione',
                'group_style' => 'width: 40%; padding-right: 10px; float: left;',
                'onchange' => 'feedSelect(\'co_projeto\', \'co_evento\', \'/corp_projetoevento/ajaxGetListEventData\');',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'co_evento' =>
            [
                'type' => 'Select',
                'label' => 'Evento:',
                'value_options' => array(),
                'empty_option' => 'Selecione',
                'group_style' => 'width: 40%;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'sg_uf' =>
            [
                'type' => 'Uf',
                'label' => 'UF:',
                'empty_option' => 'Selecione',
                'group_style' => 'width: 10%; padding-right: 10px; float: left;',
                'method_value' => 'getSgUf',
                'method_text' => 'getSgUf',
                'attr_data' => array('domain' => 'ds_configuracao'),
                'br' => true,
            ],
            'ds_prioridade' =>
            [
                'type' => 'Text',
                'label' => 'Prioridade:',
                'maxlength' => '4',
                'group_style' => 'width: 10%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_destino' =>
            [
                'type' => 'Text',
                'label' => 'Destino:',
                'maxlength' => '255',
                'group_style' => 'width: 40%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'in_validacao_impeditiva' =>
            [
                'type' => 'Select',
                'label' => 'Validação Impeditiva:',
                'value_options' => array(1 => 'Sim', 0 => 'Não'),
                'empty_option' => 'Selecione',
                'group_style' => 'width: 40%;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_configuracao' =>
            [
                'type' => 'Table',
                'value' => $arrConfigs,
                'title' => array(
                    'Projeto' => array('Projeto', 'width: 15%;'),
                    'Evento' => array('Evento', 'width: 25%;'),
                    'UF' => array('UF', 'width: 5%;'),
                    'Prioridade' => array('Prioridade', 'width: 11%;'),
                    'Destino' => 'Destino',
                    'Validação Impeditiva' => array('ds_validacao_impeditiva', 'width: 11%;'),
                ),
                'icon' => array(
                    array(
                        'class' => 'fa fa-trash',
                        'title' => 'Excluir Configuração',
                        'onclick' => 'removeFromCrud(this, \'/configenvio/ajax-delete\');',
                    )
                )
            ]
        );
    }

    public function buttons($intIdLayout)
    {
        return array('btnSalvarConfiguracao' =>
            [
                'type' => 'Button',
                'id' => 'btnSalvarConfiguracao',
                'class' => 'btnDefault btn btn-info',
                'title' => 'Incluir',
                'onclick' => 'insertIntoCrud(\'ds_configuracao\', undefined, \'/configenvio/ajax-add/' . $intIdLayout . '\', true);'
            ],
            'btnCancelar' =>
            [
                'type' => 'ButtonRoute',
                'id' => 'btnCancelar',
                'class' => 'btnDefault btn btn-info',
                'title' => 'Voltar',
                'route' => 'layoutfile'
            ]
        );
    }

}
