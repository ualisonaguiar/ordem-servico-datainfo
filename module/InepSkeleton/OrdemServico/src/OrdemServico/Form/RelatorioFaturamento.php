<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;

class RelatorioFaturamento extends FormGenerator
{

    public function prepareElementsFilter()
    {
        $this->setAttributes([
            'name' => 'gerarRelatorio',
        ]);

        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate');
        $this->addDateRange(array(
                'name' => 'dt_prazo',
                'label' => 'Data de Finalização da OS',
                'required' => true,
                'attr_data' => array(
                    'ng-model' => 'data.dt_prazo'
                )
            )
        );

        $this->addButton(
            array(
                'name' => 'btnPesquisar',
                'value' => 'Pesquisar Ordem de Servio',
                'type' => 'button',
                'ng-click' => 'pesquisarOrdemServico();',
            )
        );
        $this->addHtml('<br />');
        $this->addHtml('<br />');
        $this->addHtml('<br />');
        $this->addHtml('<div id="gridRelatorio" ui-grid="gripOptions" ui-grid-auto-resize ui-grid-selection ng-show="booExibeBotaoGerarRelatorio"></div>');
        $this->addHtml('</div>');
        $this->addHtml('<div class="well" style="overflow: hidden;" ng-show="booExibeBotaoGerarRelatorio"><h3>Informações adicionais para o relatório.</h3>');
        $this->addText(array('name' => 'ds_nr_relatorio', 'label' => 'Nº do Relatório', 'placeholder' => 'Nº do Relatório', 'maxlength' => 5, 'required' => true, 'style' => 'float: left;', 'attr_data' => array('ng-model' => 'data.ds_nr_relatorio')));
        $this->addText(array('name' => 'ds_mes_ano_relatorio', 'label' => 'Mês e Ano do Relatório', 'placeholder' => 'Janeiro/2016', 'maxlength' => 20, 'required' => true, 'style' => 'float: left;', 'attr_data' => array('ng-model' => 'data.ds_mes_ano_relatorio')));
        $this->addText(array('name' => 'dt_relatorio', 'label' => 'Data do Relatório', 'placeholder' => 'Brasília-DF 29 de Janeiro de 2016.', 'maxlength' => 50, 'required' => true, 'style' => 'float: left;', 'attr_data' => array('ng-model' => 'data.dt_relatorio')));

        $this->addButton(
            array(
                'name' => 'btnGerarRelatorio',
                'value' => 'Gerar Relatório',
                'type' => 'button',
                'attr_data' => [
                    'ng-click' => 'emitirRelatorio();',
                    'ng-show' => 'booExibeBotaoGerarRelatorio'
                ]
            )
        );
        $this->addHtml('</div>');
        return $this;
    }
}
