<?php

namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait;
use InepZend\Module\TrocaArquivo\EnvioDado\Form\EnvioDadoFilter;
use InepZend\Module\Ssi\Form\AcaoMenuFilter;

class LayoutEstrutural extends FormGenerator
{

    use CommonTrait;

    public function prepareElementsEnvio(array $estrutura = null, $intIdLayout = null)
    {
        $this->addFormCrud('Configurar Layout', $this->inputs($estrutura, $intIdLayout), $this->buttons($intIdLayout), array('disabled' => array(), 'required' => array('id_layout' => true, 'no_campo' => true, 'id_tipo' => true, 'ds_tamanho_max' => true, 'ds_tamanho_min' => true)));
        $this->setInputFilter(new EnvioDadoFilter(__FUNCTION__));
        return $this;
    }

    public function inputs($estrutura, $intIdLayout)
    {
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js" + strGlobalSufixJsGzip);});</script>');
        $estruturaLayout = [];
        if (is_array($estrutura)) {
            foreach ($estrutura as $value) {
                $tipo = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('id_tipo' => (int) $value->getIdTipo())));
                $estruturaLayout[] = array(
                    'id_estrutura' => $value->getIdEstrutura(),
                    'layout' => reset(
                                    $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')
                                    ->findBy(array('id_layout' => (int) $value->getIdLayout())))
                            ->getNoLayout(),
                    'id_layout' => $value->getIdLayout(),
                    'no_campo' => $value->getNoCampo(),
                    'tipo' => $tipo ? $tipo->getNoTipo() : '',
                    'id_tipo' => $value->getIdTipo(),
                    'in_obrigatoriedade' => ($value->getInObrigatoriedade() == 0) ? 'Não' : 'Sim',
                    'in_ocorrencia' => ($value->getInOcorrencia() == 0) ? 'Não' : 'Sim',
                    'ds_tamanho_min' => $value->getDsTamanhoMin(),
                    'ds_tamanho_max' => $value->getDsTamanhoMax(),
                    'ds_validacao' => $value->getDsValidacao(),
                    'nu_ordem' => $value->getNuOrdem(),
                );
            }
        }

        return array(
            'id_layout' => [
                'type' => 'select',
                'label' => 'Layout:',
                'value_options' => $this->getListLayout($intIdLayout),
                'empty_option' => 'Selecione o Tipo',
                'value' => (int) $intIdLayout,
                'disabled' => true,
                'required' => true,
                'group_style' => 'width: 40%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'no_campo' => [
                'type' => 'text',
                'label' => 'Nome do Campo',
                'maxlength' => '100',
                'group_style' => 'width: 40%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'nu_ordem' => [
                'type' => 'number',
                'label' => 'Ordem',
                'maxlength' => '3',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'id_tipo' => [
                'type' => 'select',
                'label' => 'Tipo:',
                'value_options' => $this->getListTipo(),
                'empty_option' => 'Selecione o Tipo',
                'group_style' => 'width: 25%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_tamanho_min' => [
                'type' => 'number',
                'label' => 'Tamanho Mínimo',
                'maxlength' => '10',
                'group_style' => 'width: 15%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_tamanho_max' => [
                'type' => 'number',
                'label' => 'Tamanho Máximio',
                'maxlength' => '10',
                'group_style' => 'width: 15%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'in_obrigatoriedade' => [
                'type' => 'select',
                'label' => 'Preenchimento Obrigatório?',
                'value_options' => array(1 => 'Sim', 0 => 'Não'),
//                'empty_option' => '',
                'group_style' => 'width: 25%; padding-right: 10px; float: left;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'in_ocorrencia' => [
                'type' => 'select',
                'label' => 'Ocorrência Obrigatório?',
//                'empty_option' => '',
                'value_options' => array(1 => 'Sim', 0 => 'Não'),
                'group_style' => 'width: 20%;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_validacao' => [
                'type' => 'textarea',
                'label' => 'Complemento da Validação',
                'group_style' => 'width: 100%;',
                'attr_data' => array('domain' => 'ds_configuracao')
            ],
            'ds_configuracao' => [
                'type' => 'table',
                'value' => $estruturaLayout,
                'title' => array(
                    'Layout' => array('layout', 'width: 6%;'),
                    'Campo' => array('no_campo', 'width: 25%;'),
                    'Ordem' => array('nu_ordem', 'width: 5%;'),
                    'Tipo' => array('tipo', 'width: 8%;'),
                    'Tamanho Min' => array('ds_tamanho_min', 'width: 5%;'),
                    'Tamanho Max' => array('ds_tamanho_max', 'width: 5%;'),
                    'Obrigatoriedade' => array('in_obrigatoriedade', 'width: 10%;'),
                    'Ocorrência' => array('in_ocorrencia', 'width: 7%;'),
                    'Validação' => 'ds_validacao'),
                'icon' => array(
                    array(
                        'class' => 'fa fa-trash',
                        'title' => 'Excluir Form',
                        'onclick' => 'removeFromCrud(this, \'/layoutestrutural/ajax-configuracao-delete\');')
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
                'onclick' => 'insertIntoCrud(\'ds_configuracao\', undefined, \'/layoutestrutural/ajax-configuracao\', true);'
            ],
            'btnOrdenarEstrutura' => [
                'type' => 'ButtonRoute',
                'id' => 'btnOrdenarEstrutura',
                'class' => 'btnDefault btn btn-info',
                'title' => 'Gerar XSD',
                'route' => 'layoutestrutural/gerar-xsd/' . $intIdLayout,
            ],
            'btnCancelar' => [
                'type' => 'ButtonRoute',
                'id' => 'btnCancelar',
                'class' => 'btnDefault btn btn-info',
                'title' => 'Voltar',
                'route' => 'layoutfile'
            ]
        );
    }

    public function gerarXsd($arrEstrutura, $intIdLayout)
    {
        $this->addHtml('
        <div class="caixaVazada">
            <h2>Árvore(s) de Ordenação do XSD</h2>
            <div class="caixaVazada">
                <h3 class="h-form">Árvore</h3>');
        $this->addHtml($this->renderTree($arrEstrutura));
        $this->addButton([
            'name' => 'btnSalvarArvore',
            'title' => 'Salvar/atualizar as informações e gerar a estrutura formatada do XSD a partir da árvore de itens',
            'onclick' => 'return saveData(\'Arvore\');',
            'value' => 'Gerar/Atualizar XSD'
        ]);
        $this->addButtonRoute([
            'name' => 'btnCancelar',
            'id' => 'btnCancelar',
            'class' => 'btnDefault btn btn-info',
            'title' => 'Voltar',
            'route' => 'layoutestrutural/index/' . $intIdLayout,
        ]);
        $this->addHtml('
            </div>
        </div>');

        $this->setInputFilter(new AcaoMenuFilter('index'));
        return $this;
    }

    protected function renderTree($arrEstrutura = null)
    {
        $strTree = '<div class="divTree ui-sortable">';
        foreach ($arrEstrutura as $estrutura) {
            $strTree .= '<div class="divTreeItem divTreeItem1' . '' . ' ui-sortable-handle'
                    . '" data-id="' . $estrutura->getIdLayout()
                    . '"data-level="0"'
                    . '" title="'
                    . $estrutura->getNoCampo() . '">' . $estrutura->getNoCampo();
            $strTree .= '<input type="hidden" name="idEstrutura[]" value=\'' . $estrutura->getIdEstrutura() . '\' />';
            $strTree .= '</div>';
        }
        $strTree .= '</div>';
        return $strTree;
    }

}
