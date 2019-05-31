<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Form\AtividadeFilter;

class Atividade extends FormGenerator
{

    public function prepareElementsFilter()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'findByPaged();');
        $this->addText(array('name' => 'co_atividade', 'style' => 'float: left;', 'label' => 'Código da Atividade', 'placeholder' => 'Código da Atividade', 'maxlength' => 4, 'attr_data' => array('ng-model' => 'data.co_atividade')));
        $this->addButton(array('name' => 'btnIncluir', 'style' => 'margin-top: 20px;', 'value' => 'Incluir', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/atividade/add\');')));
        $this->addButton(array('name' => 'btnPesquisar', 'style' => 'margin-top: 20px;', 'value' => 'Pesquisar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnLimpar', 'style' => 'margin-top: 20px;', 'value' => 'Limpar', 'type' => 'button', 'attr_data' => array('ng-click' => 'clearData();')));
        $this->addHtml('</div><div id="gridAtividade" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize></div>');
        $this->setInputFilter(new AtividadeFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma atividade</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'save();');
        $this->addHidden(array('name' => 'id_atividade', 'attr_data' => array('ng-model' => 'data.id_atividade')));
        $this->addText(array('name' => 'co_atividade', 'label' => 'Código da Atividade', 'placeholder' => 'Código da Atividade', 'maxlength' => 4, 'required' => true, 'style' => 'float: left;', 'attr_data' => array('ng-model' => 'data.co_atividade')));
        $this->addFloat(array('name' => 'vl_baixo_definido', 'label' => 'Valor do Baixo/Definido', 'required' => true, 'attr_data' => array('ng-model' => 'data.vl_baixo_definido')));
        $this->addText(array('name' => 'no_atividade', 'label' => 'Nome', 'placeholder' => 'Nome', 'maxlength' => 500, 'required' => true, 'attr_data' => array('ng-model' => 'data.no_atividade')));
        $this->addTextarea(array('name' => 'ds_descricao', 'label' => 'Descrição', 'placeholder' => 'Descrição', 'attr_data' => array('ng-model' => 'data.ds_descricao')));
        $this->addText(array('name' => 'ds_area_assessoria', 'label' => 'Área de Assessoria', 'placeholder' => 'Área de Assessoria', 'maxlength' => 255, 'required' => true, 'attr_data' => array('ng-model' => 'data.ds_area_assessoria')));
        $this->addButton(array('name' => 'btnSalvar', 'value' => 'Salvar', 'type' => 'submit'));
        $this->addButton(array('name' => 'btnVoltar', 'value' => 'Voltar', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/atividade\');')));
        $this->addHtml('</div>');
        $this->setInputFilter(new AtividadeFilter(__FUNCTION__));
        return $this;
    }

}
