<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class RelatorioDesempenho extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'pesquisar();');

        $this->setViewValidate(true);
        $this->setInputFilter(new RelatorioDesempenhoFilter());
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate');
        $this->addDateRange([
            'name' => 'dt_abertura',
            'label' => 'Data de Finalização da OS',
            'required' => true,
            'attr_data' => [
                'ng-model' => 'data.dt_abertura'
            ]
        ]);

        $this->addSelect(
            array(
                'name' => 'no_executor',
                'label' => 'Nome do Executor',
                'value_options' => $this->getListUser(['in_ativo' => true, 'tp_vinculo' => [UsuarioEntity::CO_PERFIL_FUNCIONARIO, UsuarioEntity::CO_PERFIL_PREPOSTO]]),
                'empty_option' => 'Selecione',
                'style' => 'float: left; width: 420px;',
                'attr_data' => array(
                    'ng-model' => 'data.no_executor',
                )
            )
        );

        $this->addButton(
            array(
                'name' => 'btnPesquisar',
                'value' => 'Pesquisar',
                'type' => 'submit'
            )
        );
        return $this;
    }
}
