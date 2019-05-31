<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class RelatorioPessoal extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'pesquisar();');

        $booProfilePreposto = $this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto();
        $this->setViewValidate(true);
        $this->setInputFilter(new RelatorioPessoalFilter());
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->addDateRange([
            'name' => 'dt_abertura',
            'label' => 'Data de abertura da OS',
            'required' => true,
            'attr_data' => [
                'ng-model' => 'data.dt_abertura'
            ]
        ]);
        if ($booProfilePreposto) {
            $this->addTransfer([
                'name' => 'no_executor',
                'label' => 'Nome do Executor',
                'value_options' => $this->getListUser(['in_ativo' => true, 'tp_vinculo' => [UsuarioEntity::CO_PERFIL_FUNCIONARIO, UsuarioEntity::CO_PERFIL_PREPOSTO]]),
                'attr_data' => array(
                    'ng-model' => 'data.no_executor',
                )
            ]);
        }
        $this->addButton(
            array(
                'name' => 'btnPesquisar',
                'value' => 'Pesquisar',
                'type' => 'submit'
            )
        );
        $this->addHtml('</div><div id="resultado"></div>');
        return $this;
    }
}
