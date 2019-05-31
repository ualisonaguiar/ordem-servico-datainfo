<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class RelatorioGestorProjeto extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'pesquisar();');

        $this->addHtml('<div class="col-md-3">');
        $this->addText([
            'name' => 'nu_ordem_servico',
            'label' => 'N° da Ordem de Serviço',
            'placeholder' => 'N° da Ordem de Serviço',
            'maxlength' => 200,
            'attr_data' => ['ng-model' => 'data.nu_ordem_servico']
        ]);
        $this->addHtml('</div>');

        $this->addHtml('<div class="col-md-12">');
        $this->addButton(array(
            'name' => 'btnPesquisar',
            'value' => 'Pesquisar',
            'class' => 'pull-right',
            'type' => 'button',
            'attr_data' => [
                'ng-click' => 'pesquisar();'
            ]
        ));
        $this->addHtml('');
        $this->addHtml('</div>');
        $this->addHtml('<div class="clearfix"></div><br />');
        $this->addHtml('<div id="gridRelatorioGestorProjeto" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize></div>');
        $this->addHtml('
            <br />
            <div ng-show="arrOrdemServico.length > 0">
                <div class="pull-right">
                   <strong>Soma total: {{ valorTotalMaT }}</strong>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>OS</th>
                            <th>Valor</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="ordemServico in arrOrdemServico">
                        <td>{{ ordemServico.numero_os }} - {{ ordemServico.descricao_os }}</td>
                        <td>{{ ordemServico.vlr_mat }}</td>
                        <td>
                            <i class="fa fa-trash-o" ng-click="remove(ordemServico);"></i>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        ');
        return $this;
    }
}
