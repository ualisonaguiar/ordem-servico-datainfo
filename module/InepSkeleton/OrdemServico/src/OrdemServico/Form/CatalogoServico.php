<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Form\AtividadeFilter;
use OrdemServico\Entity\Demanda as DemandaEntity;
use OrdemServico\Form\UtilDemandaForm;

class CatalogoServico extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'findByPaged();');
        $this->addText(array('name' => 'no_catalogo_servico', 'style' => 'float: left;', 'label' => 'Nome Catálogo', 'placeholder' => 'Nome Catálogo', 'maxlength' => 255, 'attr_data' => array('ng-model' => 'data.no_catalogo_servico')));
        $this->addButton(array('name' => 'btnIncluir', 'style' => 'margin-top: 20px;', 'value' => 'Incluir', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/catologoservico/add\');')));
        $this->addButton(array('name' => 'btnPesquisar', 'style' => 'margin-top: 20px;', 'value' => 'Pesquisar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnLimpar', 'style' => 'margin-top: 20px;', 'value' => 'Limpar', 'type' => 'button', 'attr_data' => array('ng-click' => 'clearData();')));
        $this->addHtml('</div><div id="gridAtividade" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize></div>');
        $this->setInputFilter(new AtividadeFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de um Catálogo de Serviço</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'save();');
        $this->addHidden(array('name' => 'id_catalogo_servico', 'attr_data' => array('ng-model' => 'data.id_catalogo_servico')));
        $this->addHidden(array('name' => 'id_atividade_vinculada', 'attr_data' => array('ng-model' => 'data.id_atividade_vinculada')));
        $this->addText(array('name' => 'no_catalogo_servico', 'label' => 'Nome do Catálogo de Serviço', 'placeholder' => 'Nome do Catálogo de Serviço', 'maxlength' => 255, 'required' => true, 'attr_data' => array('ng-model' => 'data.no_catalogo_servico')));
        $arrAtividades = $this->getService('OrdemServico\Service\AtividadeFile')->fetchPairs(array(), 'getIdAtividade', 'getCodigoAtividadeDescricao');
        natsort($arrAtividades);
        $this->addSelect(array('name' => 'co_atividade', 'label' => 'Vincular Atividade', 'empty_option' => 'Selecione', 'value_options' => $arrAtividades, 'attr_data' => array('ng-model' => 'data.co_atividade', 'ng-click' => 'vincularAtividade()')));
        $this->addHtml('<div id="gridAtividadeVinculada" style="height: 380px; margin-bottom: 15px;" ui-grid="gripOptions" ui-grid-auto-resize></div>');
        $this->addHtml('<div class="pull-right">Total atividade vinculada: {{ (gripOptions.data).length   }}</div><br />');
        $this->addButton(array('name' => 'btnSalvar', 'value' => 'Salvar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnVoltar', 'value' => 'Voltar', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/catologoservico\');')));
        $this->addHtml('</div>');
        $this->setInputFilter(new AtividadeFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsAtividadeVinculada($arrAtividade)
    {
        $this->setViewValidate(false);
        $this->addHtml('<div>');
        $arrTitle = $this->getTextHelp();
        $this->addHtml(
            '<table class="table table-border">
                <thead>
                    <tr>
                        <th style="width: 583px;">Atividade</th>
                        <th>C&nbsp;<i class="fa fa fa-info-circle" title="' . $arrTitle['complexidade'] .'"></i></th>
                        <th>I&nbsp;<i class="fa fa fa-info-circle" title="' . $arrTitle['impacto'] .'"></i></th>
                        <th>C&nbsp;<i class="fa fa fa-info-circle" title="' . $arrTitle['criticidade'] .'"></i></th>
                        <th style="width: 80px;">FP</th>
                        <th style="width: 100px;">FACIM&nbsp;<i class="fa fa fa-info-circle" title="' . $arrTitle['facim'] .'"></i></th>
                        <th style="width: 100px;">QMA</th>
                        <th style="width: 100px;">Ações</th>
                    </tr>
                </thead>
                <tbody>'
            );
        $this->addHtml('<div>');
        natsort($arrAtividade);
        foreach ($arrAtividade as $arrInfoAtividade) {
            $this->addHtml('<tr data-catalogo-servico-atividade="' . $arrInfoAtividade['id_catalogo_servico'] . '">');
            $this->addHtml('<td>' . $arrInfoAtividade['descricao']);
            $this->addHidden(
                array(
                    'name' => 'id_atividade[]',
                    'value' => $arrInfoAtividade['id_atividade'],
                    'attr_data' => array(
                        'id_atividade' => $arrInfoAtividade['id_atividade']
                    )
                )
            );
            $this->addHidden(array('name' => 'id_catalogo_servico_' . $arrInfoAtividade['id_catalogo_servico'], 'value' => $arrInfoAtividade['id_catalogo_servico']));
            $this->addHtml('</td>');
            # vl_complexidade
            $this->addHtml('<td>');
            $this->addSelect(array('name' => 'vl_complexidade_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_complexidade','value_options' => DemandaEntity::$arrGrauDemanda, 'empty_option' => 'Selecione'));
            $this->addHtml('</td>');
            # vl_impacto
            $this->addHtml('<td>');
            $this->addSelect(array('name' => 'vl_impacto_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_impacto', 'value_options' => DemandaEntity::$arrGrauDemanda, 'empty_option' => 'Selecione'));
            $this->addHtml('</td>');
            # vl_criticidade
            $this->addHtml('<td>');
            $this->addSelect(array('name' => 'vl_criticidade_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_criticidade', 'value_options' => DemandaEntity::$arrGrauCriticidade, 'empty_option' => 'Selecione'));
            $this->addHtml('</td>');
            # vl_fator_ponderacao
            $this->addHtml('<td>');
            $this->addText(array('name' => 'vl_fator_ponderacao_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_fator_ponderacao', 'placeholder' => 'FP', 'disabled' => true));
            $this->addHtml('</td>');
            # vl_facim
            $this->addHtml('<td>');
            $this->addSelect(array('name' => 'vl_facim_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_facim', 'value_options' => DemandaEntity::$arrTypeFatorConhecimento, 'empty_option' => 'Selecione'));
            $this->addHtml('</td>');
            # vl_qma
            $this->addHtml('<td>');
            $this->addNumber(array('name' => 'vl_qma_' . $arrInfoAtividade['id_catalogo_servico'], 'class' => 'vl_qma', 'disabled' => true));
            $this->addHtml('</td>');
            # acoe
            $this->addHtml('<td><i class="fa fa-minus-circle excluir-atividade" title="Excluir a atividade do serviço." style="cursor: pointer;"></i></td>');
            $this->addHtml('</tr>');
        }
        $this->addHtml('</tbody></table>');
        return $this;
    }

}
