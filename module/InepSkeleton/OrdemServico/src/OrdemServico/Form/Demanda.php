<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Form\DemandaFilter;
use OrdemServico\Entity\Demanda as DemandaEntity;
use OrdemServico\Entity\Atividade as AtividadeEntity;
use OrdemServico\Form\UtilDemandaForm;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class Demanda extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'findByPaged();');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        if ($this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $this->addSelect(
                array(
                    'name' => 'id_usuario',
                    'label' => 'Nome do Executor',
                    'value_options' => $this->getListagemUsuario(['tp_vinculo' => [
                        UsuarioEntity::CO_PERFIL_FUNCIONARIO,
                        UsuarioEntity::CO_PERFIL_PREPOSTO,
                        UsuarioEntity::CO_PERFIL_CE,
                    ]]),
                    'empty_option' => 'Selecione',
                    'style' => 'width: 420px;',
                    'attr_data' => array(
                        'ng-model' => 'data.id_usuario',
                    )
                )
            );
        }
        $this->addText(
            array(
                'name' => 'no_demanda',
                'label' => 'Nome da Demanda',
                'style' => 'float: left; width: 555px;',
                'attr_data' => array(
                    'ng-model' => 'data.no_demanda',
                )
            )
        );
        $this->addDateRange(
            array(
                'name' => 'dt_abertura',
                'style' => 'float: left;',
                'label' => 'Data de abertura',
                'attr_data' => array('ng-model' => 'data.dt_abertura')
            )
        );
        $this->addSelect(
            array(
                'name' => 'tp_situacao',
                'label' => 'Situação',
                'value_options' => DemandaEntity::$arrSituacao,
                'empty_option' => 'Selecione',
                'attr_data' => array('ng-model' => 'data.tp_situacao'),
                'style' => 'width: 300px; float: left;',
            )
        );
        $this->addSelect(
            array(
                'name' => 'co_area_assessoria',
                'label' => 'Área de Assessoria',
                'empty_option' => 'Selecione',
                'value_options' => AtividadeEntity::$arrAreaAssesoria,
                'attr_data' => array(
                    'ng-model' => 'co_area_assessoria',
                    'ng-disabled' => 'booChecked',
                    'ng-change' => 'getAtividadeServicoAssessoria()'
                ),
                'style' => 'float: left;',
            )
        );
        $this->addSelect(
            array(
                'name' => 'id_catalogo_servico',
                'label' => 'Serviço',
                'required' => true,
                'empty_option' => 'Selecione',
                'attr_data' => array(
                    'ng-model' => 'data.id_catalogo_servico',
                    'ng-disabled' => '!co_area_assessoria',
                    'ng-change' => 'vincularServico()',
                    'ng-options' => 'servico.value as servico.name for servico in arrCatalagoServico',
                    'ng-required' => 'data.no_area_assessoria'
                ),
            )
        );

        $this->addButton(array('name' => 'btnIncluir', 'style' => 'margin-top: 20px;', 'value' => 'Incluir', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/demanda/add\');')));
        $this->addButton(array('name' => 'btnPesquisar', 'style' => 'margin-top: 20px;', 'value' => 'Pesquisar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnLimpar', 'style' => 'margin-top: 20px;', 'value' => 'Limpar', 'type' => 'button', 'attr_data' => array('ng-click' => 'clearData();')));

        $this->addHtml('</div><div id="gridDemanda" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize></div>');
        $this->setInputFilter(new DemandaFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->setAttributes([
                'onsubmit' => 'return false;',
                'novalidate' => 'novalidate',
                'data-ng-submit' => 'save();'
            ]);
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma demanda</h3>');
        $this->addHidden(array('name' => 'id_demanda', 'attr_data' => array('ng-model' => 'data.id_demanda')));
        $this->addHtml('<div class="row">', 'strartRow1');
        $this->addHtml('<div class="pull-right alert-danger" ng-show="exibeDataAlteracao">Alterado no dia: {{ data_alteracao }} por {{ no_usuario }}</div>');
        $this->addHtml('<div class="col-xs-8 col-sm-12" ng-show="booExibeOrdemServicoAberto">', 'starElemento5');
        $this->addSelect(
            array(
                'name' => 'id_ordem_servico',
                'label' => 'Ordem de Serviço',
                'value_options' => $this->getListOrdemServicoAtivo(['tp_situacao' => OrdemServicoEntity::CO_SITUACAO_ABERTA]),
                'empty_option' => 'Selecione',
                'required' => true,
                'attr_data' => array(
                    'ng-model' => 'data.id_ordem_servico',
                    'ng-disabled' => 'booChecked',
                ),
                'style' => 'width: 500px;'
            )
        );
        $this->addHtml('</div>', 'endElemento5');
        $this->addHtml('<div class="col-xs-8 col-sm-12" ng-show="booExibeOrdemServicoFechado">', 'starElemento5');
        $this->addSelect(
            array(
                'name' => 'id_ordem_servico_encerrada',
                'label' => 'Ordem de Serviço',
                'value_options' => $this->getListOrdemServicoAtivo(),
                'empty_option' => 'Selecione',
                'required' => true,
                'attr_data' => array(
                    'ng-model' => 'data.id_ordem_servico_encerrada',
                    'ng-disabled' => 'booChecked',
                ),
                'style' => 'width: 500px;'
            )
        );
        $this->addHtml('</div>', 'endElemento5');
        $this->addHtml('<div class="col-xs-8 col-sm-2">', 'starElemento1');
        $this->addDate(array('name' => 'dt_abertura', 'label' => 'Data de abertura', 'required' => true, 'attr_data' => array('ng-model' => 'data.dt_abertura', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</div>', 'endElemento1');
        $this->addHtml('<div class="col-xs-8 col-sm-10">', 'starElemento1');
        $this->addText(array('name' => 'no_demanda', 'label' => 'Assunto da Demanda', 'placeholder' => 'Ex: Deploy do sistema Enem em produção', 'maxlength' => 500, 'required' => true, 'attr_data' => array('ng-model' => 'data.no_demanda', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</div>', 'endElemento1');
        $this->addHtml('</div>', 'endtRow1');
        $this->addText(array(
            'name' => 'no_projeto',
            'label' => 'Sistema/Projeto',
            'maxlength' => 255,
            'placeholder' => 'Nome do Projeto ou Sistema',
            'required' => true,
            'attr_data' => array(
                'ng-model' => 'data.no_projeto',
                'ng-disabled' => 'booChecked'
            )
        ));
        $this->addText(array(
            'name' => 'ds_ambiente',
            'label' => 'Ambiente',
            'maxlength' => 255,
            'placeholder' => 'Ambiente quando houver',
            'attr_data' => array(
                'ng-model' => 'data.ds_ambiente',
                'ng-disabled' => 'booChecked'
            )
        ));
        $this->addSelect(
            array(
                'name' => 'no_area_assessoria',
                'label' => 'Área de Assessoria',
                'empty_option' => 'Selecione',
                'value_options' => AtividadeEntity::$arrAreaAssesoria,
                'attr_data' => array(
                    'ng-model' => 'data.no_area_assessoria',
                    'ng-disabled' => 'booChecked',
                    'ng-change' => 'getAtividadeServicoAssessoria()'
                ),
            )
        );
        $this->addSelect(
            array(
                'name' => 'id_catalogo_servico',
                'label' => 'Serviço',
                'empty_option' => 'Selecione',
                'attr_data' => array(
                    'ng-model' => 'data.id_catalogo_servico',
                    'ng-disabled' => 'booChecked',
                    'ng-change' => 'vincularServico()',
                    'ng-options' => 'servico.value as servico.name for servico in id_catalogo_servico',
                ),
            )
        );
        $this->addHidden(array('name' => 'catalogo_servico_vinculo', 'required' => true, 'attr_data' => array('ng-model' => 'data.catalogo_servico_vinculo')));
        $this->addHtml('<div id="atividadeVinculada"></div>');
        $this->addTextarea(
            array(
                'name' => 'ds_descricao',
                'style' => 'height: 273px;',
                'label' => 'Descrição - Escopo',
                'placeholder' => 'Descrição ou escopo da Demanda',
                'required' => true,
                'maxlength' => '6000',
                'attr_data' => array(
                    'ng-model' => 'data.ds_descricao',
                    'ng-disabled' => 'booChecked'
                )
            )
        );
        $this->addTextarea(
            array(
                'name' => 'ds_solucao',
                'style' => 'height: 273px;',
                'label' => 'Solução',
                'placeholder' => 'Informações que vão para o relatório técnico ou de atividades',
                'maxlength' => '6000',
                'attr_data' => array(
                    'ng-model' => 'data.ds_solucao',
                    'ng-disabled' => 'booChecked'
                )
            )
        );
        $this->addHtml('<div class="row">', 'strartRow3');
        $this->addHtml('<div class="col-xs-8 col-sm-4">', 'starElemento5');
        $this->addSelect(
            array(
                'name' => 'id_usuario',
                'label' => 'Nome do Executor',
                'value_options' => $this->getListagemUsuario([
                    'in_ativo' => true,
                    'tp_vinculo' => [
                        UsuarioEntity::CO_PERFIL_FUNCIONARIO,
                        UsuarioEntity::CO_PERFIL_PREPOSTO,
                        UsuarioEntity::CO_PERFIL_CE
                    ]]
                ),
                'empty_option' => 'Selecione',
                'required' => true,
                'attr_data' => array(
                    'ng-model' => 'data.id_usuario',
                    'ng-disabled' => 'booChecked'
                ),
                'value' => $this->getService('OrdemServico\Service\DemandaFile')->getIdUsuarioLogado()
            )
        );
        $this->addHtml('</div>', 'endElemento5');
        $this->addHtml('<div class="col-xs-8 col-sm-2">', 'starElemento6');
        $this->addHtml('</div>', 'endElemento6');
        $this->addHtml('</div>', 'endtRow3');
        $this->addButton(array('name' => 'btnSalvar', 'value' => 'Salvar', 'type' => 'submit', 'attr_data' => array('ng-hide' => 'booChecked')));
        $this->addButton(array('name' => 'btnVoltar', 'value' => 'Voltar', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/demanda\');')));
        $this->addHtml('<br /><br />');
        $this->setInputFilter(new DemandaFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementsAtividadeVinculada($booShowBunttonSave = false, $booServico = false)
    {
        $this->setViewValidate(false);
        $arrTitle = $this->getTextHelp();
        $this->addHtml('<div>');
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
                    </tr>
                </thead>
                <tbody>'
            );
        $this->addHtml('<div>');
        # atividade
        $this->addHtml('<tr"><td>');
        $this->addSelect(
            array(
                'name' => 'id_atividade',
                'class' => 'list_atividade',
                'style' => 'width: 500px;',
                'value_options' => $this->getListActivity(),
                'empty_option' => 'Selecione',
                'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked'),
                'disabled' => $booServico
            )
        );
        $this->addHtml('</td>');
        # vl_complexidade
        $this->addHtml('<td>');
        $this->addSelect(array('name' => 'vl_complexidade', 'class' => 'vl_complexidade','value_options' => DemandaEntity::$arrGrauDemanda, 'empty_option' => 'Selecione', 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        # vl_impacto
        $this->addHtml('<td>');
        $this->addSelect(array('name' => 'vl_impacto', 'class' => 'vl_impacto', 'value_options' => DemandaEntity::$arrGrauDemanda, 'empty_option' => 'Selecione', 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        # vl_criticidade
        $this->addHtml('<td>');
        $this->addSelect(array('name' => 'vl_criticidade', 'class' => 'vl_criticidade', 'value_options' => DemandaEntity::$arrGrauCriticidade, 'empty_option' => 'Selecione', 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        # vl_fator_ponderacao
        $this->addHtml('<td>');
        $this->addText(array('name' => 'vl_fator_ponderacao', 'class' => 'vl_fator_ponderacao', 'placeholder' => 'FP', 'disabled' => true, 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        # vl_facim
        $this->addHtml('<td>');
        $this->addSelect(array('name' => 'vl_facim', 'class' => 'vl_facim', 'value_options' => DemandaEntity::$arrTypeFatorConhecimento, 'empty_option' => 'Selecione', 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        # vl_qma
        $this->addHtml('<td>');
        $this->addNumber(array('name' => 'vl_qma', 'class' => 'vl_qma', 'disabled' => true, 'attr_data' => array('ng-model' => 'data.id_atividade', 'ng-disabled' => 'booChecked')));
        $this->addHtml('</td>');
        $this->addHtml('</tr>');
        $this->addHtml('</tbody></table>');

        if ($booShowBunttonSave) {
            $this->addHidden(array('name' => 'id_demanda', 'required' => true, 'class' => 'id_demanda'));
            if ($booServico) {
                $this->addHidden(array('name' => 'id_catalogo_servico_atividade', 'required' => true, 'class' => 'id_catalogo_servico_atividade'));
            }
            $this->addButton(
                [
                    'name' => 'btnProximo',
                    'class' => 'btnProximo',
                    'value' => 'Próximo'
                ]
            );
            $this->addButton(array('name' => 'btnSalvar', 'class' => 'btnSalvaDemanda', 'value' => 'Salvar'));
            $this->addButton(
                [
                    'name' => 'btnAnterior',
                    'class' => 'btnAnterior',
                    'value' => 'Anterior'
                ]
            );
        }
        return $this;
    }


    protected function getListDemandaSuperior()
    {
        $serviceDemanda = $this->getService('OrdemServico\Service\DemandaFile');
        $arrDemanda = $serviceDemanda->findBy(array('tp_situacao' => DemandaEntity::SITUACAO_ATIVO));
        $arrDemandaSuperior = array();
        if ($arrDemanda) {
            $arrDemandaVinculo = $this->getService('OrdemServico\Service\OrdemServicoDemandaFile')->fetchPairs(array(), 'getIdDemanda', 'getIdOrdemServico');
            foreach ($arrDemanda as $intPosicao => $demanda) {
                if (array_key_exists($demanda->getIdDemanda(), $arrDemandaVinculo) || $demanda->getIdDemandaSuperior())
                    unset($arrDemanda[$intPosicao]);
                else {
                    if ($serviceDemanda->hasDemandaVinculadaSituacao($demanda)) {
                        $arrDemandaSuperior[$demanda->getIdDemanda()] = $demanda->getNoDemanda();
                    }
                }
            }
        }
        return $arrDemandaSuperior;
    }

}
