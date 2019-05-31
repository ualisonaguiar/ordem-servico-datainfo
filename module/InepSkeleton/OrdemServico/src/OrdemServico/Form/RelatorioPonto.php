<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use OrdemServico\Form\UtilDemandaForm;
use OrdemServico\Entity\Usuario;

class RelatorioPonto extends FormGenerator
{
    use UtilDemandaForm;

    public function prepareElementsFilter()
    {
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-init', 'setValorInicialData();');
//        if ($this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Inserindo arquivo do Ponto</h3>');
            $this->addFile([
                'name' => 'arquivo_ponto',
                'label' => 'Upload do arquivo AFD00014003750066549',
                'attr_data' => [
                    'ng-model' => 'data.arquivo_ponto'
                ]
            ]);
            $this->addButton(
                array(
                    'name' => 'btnInserirArquivo',
                    'value' => 'Inserir Arquivo',
                    'attr_data' => [
                        'ng-click' => 'inserirArquivo();'
                    ]
                )
            );
            $this->addHtml('</div>');
//        }

        $this->addHtml('<div class="well" style="overflow: hidden;"><div><p class="text-danger"><label>Arquivo inserindo no dia:</label> {{ strInfoDataArquivo }} por {{ usuarioResponsavelUpload }}<p></div>');
        $this->addHtml('<h3>Filtros da Pesquisa</h3>');
        $this->addDateRange([
            'name' => 'dt_ponto',
            'label' => 'Periodicidade',
            'required' => true,
            'attr_data' => [
                'ng-model' => 'data.dt_ponto',
            ]
        ]);

        if ($this->getService('OrdemServico\Service\Profile')->hasUsuarioPreposto()) {
            $this->addSelect(
                array(
                    'name' => 'no_executor',
                    'label' => 'Funcionário',
                    'value_options' => $this->getListagemUsuario([
                            'in_ativo' => true,
                            'tp_vinculo' => [
                                UsuarioEntity::CO_PERFIL_FUNCIONARIO,
                                UsuarioEntity::CO_PERFIL_PREPOSTO,
                                UsuarioEntity::CO_PERFIL_CE,
                            ]]
                    ),
                    'empty_option' => 'Selecione',
                    'style' => 'float: left; width: 420px;',
                    'attr_data' => array(
                        'ng-model' => 'data.no_executor',
                    )
                )
            );
        }

        $this->addButton(
            array(
                'name' => 'btnPesquisar',
                'value' => 'Visualizar',
                'attr_data' => [
                    'ng-click' => 'pesquisarPonto(true);',
//                    'ng-disabled' => '(gripOptions.data).length == 0'
                ]
            )
        );
        $this->addHtml('</div>');

        $this->addHtml('<div class="well">');
        $this->addHtml('<div ng-show="(gripOptions.data).length !== 0"><p><label>Total de Horas Trabalhadas:&nbsp;</label>{{ totalHoraTrabalhada }}</p></div>');
        $this->addHtml('<div  ng-show="(gripOptions.data).length !== 0"><p><label>Total de Horas a Trabalhar:&nbsp;</label>{{ totalHoraTrabalhar }}</p></div>');
        $this->addHtml('<p class="text-danger ng-binding">* Horário em azul é a previsão de saída para completar a carga horária diária 08:30</p>');
        $this->addHtml('<div id="gridAtividade" ui-grid="gripOptions" ui-grid-auto-resize ng-hide="(gripOptions.data).length == 0"></div>');

        $this->addHtml('</div>');

        if ($this->getService('OrdemServico\Service\Profile')->getTipoVinculo() == Usuario::CO_PERFIL_CE ) {
            $this->addHtml('<div id="hrConsultorExterno" class="well">');
            $this->addHtml('<h3>Lançar Consultor Externo</h3>');
            $this->addHtml('<p class="text-danger"><b>IMPORTANTE:</b> É responsabilidade do funcionário conferir o lançamento de seu ponto</p>');
            $this->addDate([
                'name' => 'dt_ponto_ce',
                'label' => 'Data',
                'required' => true,
                'attr_data' => [
                    'ng-model' => 'data.dt_ponto_ce',
                ]
            ]);
            $this->addMultiCheckbox([
                'name' => 'hr_ponto_ce',
                'label' => 'Turno',
                'required' => true,
                'value_options' => ['manha'=>'Manha (8h00 as 12h00)', 'tarde'=>'Tarde (14h00 as 18h30)', 'noite'=>'Noite (19h00 as 23h00)'],
            ]);
            $this->addButton(
                array(
                    'name' => 'btnPonto',
                    'value' => 'Lançar Ponto',
                    'attr_data' => [
                        'ng-click' => 'lancarPonto();',
                        'ng-disabled' => "(data.dt_ponto_ce === '') || (data.dt_ponto_ce === undefined)"
                    ]
                )
                );
            $this->addHtml('<br /><br /></div>');
        }
        
        $this->addHtml('<div class="modalJustificarPonto hidden">');

        $this->addDate([
            'name' => 'dt_ponto',
            'label' => 'Data Ponto',
            'disabled' => true,
        ]);
        $this->addTime([
            'name' => 'hr_ponto',
            'label' => 'Hora justificada',
            'required' => true
        ]);
        $this->addButton([
            'name' => 'btnJustificar',
            'value' => 'Salvar',
        ]);
        $this->addHtml('</div>');

        $this->modalEnvioApex();

        return $this;
    }

    protected function modalEnvioApex ()
    {
        $this->addHtml('<div class="modalEnviarApex hidden">');
        $this->addHtml('<fieldset class="form-group">');
        $this->addHtml('<legend>Informação Demanda</legend>');
        $this->addHidden([
            'name' => 'dt_ponto_apex',
            'required' => true
        ]);
        $this->addHidden([
            'name' => 'hr_ponto_apex',
            'required' => true
        ]);
        $this->addSelect([
            'name' => 'id_ordem_servico',
            'label' => 'OS',
            'empty_option' => 'Selecione',
            'value_options' => $this->getListListOrdemServicoVinculadoUsario(),
        ]);
        $this->addSelect([
            'name' => 'id_demanda',
            'label' => 'Demanda',
            'empty_option' => 'Selecione',
        ]);
        $this->addSelect([
            'name' => 'id_atividade',
            'label' => 'Atividade',
            'empty_option' => 'Selecione',
        ]);
        $this->addText([
            'name' => 'ds_descricao',
            'label' => 'Descrição'
        ]);
        $this->addHtml('</fieldset>');

        $this->addHtml('<fieldset class="form-group">');
        $this->addHtml('<legend>Informação do lançamento</legend>');
        $this->addHtml('<div id="informacaoPonto"></div>');
        $this->addHtml('</fieldset>');

        $intIdUsuario = $this->getService('OrdemServico\Service\Profile')->getIdUsuarioLogado();
        $usuario = $this->getService('OrdemServico\Service\UsuarioFile')->find($intIdUsuario);
        if ($usuario->getDsHashApex() == null) {
            $this->addHtml('<fieldset class="form-group">');
            $this->addHtml('<legend>Informação do usuário</legend>');
            $this->addText([
                'name' => 'no_usario',
                'label' => 'Usuário do APEX',
                'maxlength' => 255,
                'placeholder' => 'Usuário do sistema APEX',
            ]);
            $this->addPassword([
                'name' => 'no_senha',
                'label' => 'Senha do APEX',
                'maxlength' => 255,
                'placeholder' => 'Senha do sistema APEX',
            ]);
            $this->addHtml('</fieldset>');
        }
        $this->addButton([
            'name' => 'btnEnviarApex',
            'value' => 'Enviar APEX',
        ]);
        $this->addHtml('</div>');
    }
}
