<?php

namespace OrdemServico\Form;

use InepZend\FormGenerator\FormGenerator;
use OrdemServico\Form\OrdemServicoFilter;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;
use OrdemServico\Form\UtilDemandaForm;
use InepZend\Util\Date;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use OrdemServico\Entity\OrdemServicoAceite as OrdemServicoAceiteEntity;

class OrdemServico extends FormGenerator
{

    use UtilDemandaForm;

    const DATA_ABERTUTA = 'abertura';
    const DATA_PRAZO = 'prazo';

    public function prepareElementsFilter()
    {
        $this->prepareElementModal();
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Filtros da Pesquisa</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'findByPaged();');

        $this->addDateRange([
            'name' => 'dt_prazo',
            'label' => 'Data de Prazo',
            'style' => 'float: left;',
            'attr_data' => ['ng-model' => 'data.dt_prazo']
        ]);

        $this->addNumber([
            'name' => 'nu_ordem_servico',
            'style' => 'float: left;',
            'label' => 'N° da Ordem de Serviço',
            'placeholder' => 'N° da Ordem de Serviço',
            'maxlength' => 8,
            'attr_data' => ['ng-model' => 'data.nu_ordem_servico']
        ]);
        $arrSituacao = OrdemServicoEntity::$arrSituacaoDemanda;
        $this->addSelect([
            'name' => 'tp_situacao',
            'style' => 'float: left;',
            'label' => 'Situação',
            'value_options' => $arrSituacao,
            'empty_option' => 'Selecione',
            'attr_data' => array('ng-model' => 'data.tp_situacao')
        ]);

        $this->addTransfer([
            'name' => 'tp_gestao',
            'value_options' => OrdemServicoAceiteEntity::$arrGestao,
            'attr_data' => ['ng-model' => 'data.tp_gestao'],
            'label' => 'Perfil'
        ]);

        $intTpVinculo = $this->getVinculoUsuario();
        if ($intTpVinculo !== UsuarioEntity::CO_PERFIL_SERVIDOR) {
            $this->addButton(array('name' => 'btnIncluir', 'style' => 'margin-top: 20px;', 'value' => 'Incluir', 'type' => 'button', 'attr_data' => array('ng-click' => 'locationHref(\'/ordemdeservico/add\');')));
        }
        $this->addButton(array(
            'name' => 'btnPesquisar',
            'style' => 'margin-top: 20px;',
            'value' => 'Pesquisar',
            'type' => 'button',
            'attr_data' => [
                'ng-click' => 'pesquisar();'
            ]
        ));
        $this->addButton(array('name' => 'btnLimpar', 'style' => 'margin-top: 20px;', 'value' => 'Limpar', 'type' => 'button', 'attr_data' => array('ng-click' => 'clearData();')));
        $this->addHtml('</div>');

        $this->addHtml('<div id="gridOrdemServico" style="display: none;" ui-grid="gripOptions" ui-grid-pagination ui-grid-auto-resize ui-grid-selection></div><br /><br />');

        $this->addButton([
            'name' => 'btnGerarLote',
            'title' => 'Assinar em lote',
            'attr_data' => array(
                'ng-show' => 'rowSelectionCount !== 0',
                'ng-click' => 'aceiteLote();'
            )
        ]);

        $this->addHtml('<div><hr /><h3 ng-show="(gridOrdemServicoImpressao.data).length !== 0">Arquivos para serem imprimidos</h3>');
        $this->addButton([
            'name' => 'btnImpressao',
            'title' => 'Imprimir Ordem Serviço',
            'attr_data' => array(
                'ng-show' => '(gridOrdemServicoImpressao.data).length !== 0',
                'ng-click' => 'imprimirOrdemServicoSelecionado();'
            )
        ]);
        $this->addHtml('</div>');
        $this->addHtml('<br /><br /><br />');
        $this->addHtml('<div id="gridOrdemServicoImpressao" ui-grid="gridOrdemServicoImpressao" ui-grid-pagination ui-grid-auto-resize ng-show="(gridOrdemServicoImpressao.data).length !== 0"></div>');
        $this->setInputFilter(new OrdemServicoFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElements()
    {
        $dtAbertura = $this->getDateOs(self::DATA_ABERTUTA);
        $dtPrazo = $this->getDateOs(self::DATA_PRAZO);

        $this->prepareElementModal();
        $arrResponsavel = $this->getService('config')['responsavel-ordem-servico'];
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>Informações de uma ordem de serviço</h3>');
        $this->setAttribute('onsubmit', 'return false;')
            ->setAttribute('novalidate', 'novalidate')
            ->setAttribute('data-ng-submit', 'saveOrdemServico();');
        $this->addHtml('<div class="pull-right alert-danger" ng-show="exibeDataAlteracao">Alterado no dia: {{ data_alteracao }} por {{ no_usuario }}</div>');
        $this->addHidden(array('name' => 'id_ordem_servico', 'attr_data' => array('ng-model' => 'data.id_ordem_servico')));
        $this->addHidden(array('name' => 'id_demanda_vinculada', 'attr_data' => array('ng-model' => 'data.id_demanda_vinculada', 'ng-disabled' => 'booChecked')));
        $this->addText(array('name' => 'ds_contrato', 'label' => 'Descrição do Contrato', 'placeholder' => 'Descrição do Contrato', 'maxlength' => 20, 'required' => true, 'style' => 'float: left;', 'attr_data' => array('ng-model' => 'data.ds_contrato', 'ng-disabled' => 'booChecked')));
        $this->addText(array(
            'name' => 'nu_ordem_servico',
            'label' => 'Nº da Ordem de Serviço',
            'placeholder' => 'Nº da Ordem de Serviço',
            'required' => true,
            'maxlength' => 255,
            'style' => 'float: left;',
            'attr_data' => array(
                'ng-model' => 'data.nu_ordem_servico',
                'ng-disabled' => 'true'
            )
        ));
        $this->addText(array('name' => 'ds_nome', 'label' => 'Descrição', 'placeholder' => 'Descrição do Contrato', 'maxlength' => 255, 'required' => true, 'attr_data' => array('ng-model' => 'data.ds_nome', 'ng-disabled' => 'booChecked', 'ng-change' => 'setPathSvn()')));
        $this->addDateTime(array('name' => 'dt_prazo', 'value' => $dtPrazo . ' 16:00', 'label' => 'Data de Prazo', 'style' => 'float: left;', 'required' => true, 'attr_data' => array('ng-model' => 'data.dt_prazo', 'ng-disabled' => 'booChecked')));
        $this->addDateTime(array('name' => 'dt_emissao', 'value' => $dtAbertura . ' 08:00', 'label' => 'Data de Emissão', 'style' => 'float: left;', 'required' => true, 'attr_data' => array('ng-model' => 'data.dt_emissao', 'ng-disabled' => 'booChecked')));
        $this->addDateTime(array('name' => 'dt_recepcao', 'value' => $dtAbertura . ' 08:00', 'label' => 'Data de Recepção', 'required' => true, 'attr_data' => array('ng-model' => 'data.dt_recepcao', 'ng-disabled' => 'booChecked')));
        $this->addTextarea(array(
            'name' => 'ds_descricao',
            'label' => 'Descrição da OS',
            'attr_data' => array(
                'ng-model' => 'data.ds_descricao',
                'ng-disabled' => 'booChecked'
            ),
            'maxlength' => '6000',
        ));

        $this->addHtml('<br /><div class="caixaVazada">');
        $this->addLabel(array('label' => 'Filtros do Vincular Demanda'));
        $this->addHtml('<div class="pull-right">');

        $this->addHtml('<i class="fa fa-plus-square-o" ng-click="exibeFiltroDemandaVinculada()" ng-hide="!booOcultaFiltro" style="cursor: point;"></i>');
        $this->addHtml('<i class="fa fa-minus-square-o" ng-click="exibeFiltroDemandaVinculada()" ng-hide="booOcultaFiltro" style="cursor: point;"></i>');

        $this->addHtml('</div><div ng-hide="booOcultaFiltro">');
        # periodo de abertura
        $this->addDateRange(array('name' => 'dt_abertura', 'label' => 'Data de Abertura', 'attr_data' => array('ng-model' => 'data.dt_abertura')));
        # tipo de atividade
        $this->addSelect(array('name' => 'tipo_atividade', 'label' => 'Atividade', 'empty_option' => 'Selecione', 'value_options' => $this->getListActivity(), 'attr_data' => array('ng-model' => 'data.tipo_atividade')));
        # Resoponsavel
        $this->addSelect(array('name' => 'no_executor', 'label' => 'Nome do Executor', 'style' => 'float: left;width: 355px;', 'value_options' => $this->getListUser(), 'empty_option' => 'Selecione', 'attr_data' => array('ng-model' => 'data.no_executor')));
        $this->addButton(array('name' => 'btnPesquisaFiltro', 'label' => 'Filtrar', 'title' => 'Filtrar', 'attr_data' => array('ng-click' => 'filtrarDemandaVinculada()')));
        $this->addHtml('</div></div>');
        $this->addHtml('<br />');

        $this->addSelect(array(
            'name' => 'demanda_vinculada',
            'label' => 'Vincular Demanda',
            'empty_option' => 'Selecione',
            'attr_data' => array(
                'ng-model' => 'data.demanda_vinculada',
                'ng-change' => 'vincularDemanda()',
                'ng-options' => "optionDemanda.value as optionDemanda.label group by optionDemanda.group for optionDemanda in optionDemandaSemVinculo | orderBy:'id_demanda'",
                'ng-disabled' => 'booChecked'
            ),
            'help_text' => 'Após selecionar a demanda deverá clicar no botão de salvar.'
        ));

        $strHelp = 'Justificar todas as demandas que tiverem o fato alterado. Exemplo: Complexidade: M, A; Impacto: M, A; Criticidade: C; FACIM: PD e I';
        $this->addHtml('<div id="gridOrdemServicoDemanda" style="height: 380px; margin-bottom: 15px;" ui-grid="gripOptions" ui-grid-auto-resize></div>');
        $this->addHtml('<div class="pull-right">Total demanda vinculada: {{ (gripOptions.data).length   }}</div><br />');
        $this->addTextarea(array(
            'name' => 'ds_justificativa',
            'style' => 'height: 273px;',
            'label' => 'Justificativa',
            'placeholder' => $strHelp,
            'attr_data' => array(
                'ng-model' => 'data.ds_justificativa',
                'ng-disabled' => 'booChecked'
            ),
            'maxlength' => '6000',
        ));
        $arrPreposto = $this->getService('OrdemServico\Service\UsuarioFile')
            ->fetchPairs(
                [
                    'tp_vinculo' => UsuarioEntity::CO_PERFIL_PREPOSTO,
                    'in_ativo' => UsuarioEntity::CO_SITUACAO_ATIVO
                ],
                'getNoUsuario',
                'getNoUsuario',
                ['no_usuario' => 'asc']
            );
        $arrServidor = $this->getService('OrdemServico\Service\UsuarioFile')
            ->fetchPairs(
                [
                    'tp_vinculo' => UsuarioEntity::CO_PERFIL_SERVIDOR,
                    'in_ativo' => UsuarioEntity::CO_SITUACAO_ATIVO
                ],
                'getNoUsuario',
                'getNoUsuario',
                ['no_usuario' => 'asc']
            );

        $arrGestor = $this->getService('OrdemServico\Service\UsuarioFile')
            ->fetchPairs(
                [
                    'tp_vinculo' => UsuarioEntity::CO_PERFIL_GESTOR,
                    'in_ativo' => UsuarioEntity::CO_SITUACAO_ATIVO
                ],
                'getNoUsuario',
                'getNoUsuario',
                ['no_usuario' => 'asc']
            );

        $strUsuarioLogado = $this->getIdentity()->usuarioSistema->usuario->nome;
        $arrInfoGestao = [
            'no_preposto' => [
                'label' => 'Preposto',
                'in_gestao' => OrdemServicoAceiteEntity::CO_ACEITE_PREPOSTO,
                'values' => $arrPreposto
            ],
            'no_fiscal_requisitante' => [
                'label' => 'Fiscal Requisitante',
                'in_gestao' => OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_REQUISITANTE,
                'values' => $arrServidor
            ],
            'no_fiscal_tecnico' => [
                'label' => 'Fiscal Técnico',
                'in_gestao' => OrdemServicoAceiteEntity::CO_ACEITE_FISCAL_TECNICO,
                'values' => $arrServidor
            ],
            'no_gestor_contrato' => [
                'label' => 'Gestor do Contrato',
                'in_gestao' => OrdemServicoAceiteEntity::CO_ACEITE_GESTOR_CONTRATO,
                'values' => $arrGestor
            ],
        ];

        $this->addHtml('<div>');
        $booAcessoAceite = $this->validarAcessoAceite();
        foreach ($arrInfoGestao as $strField => $arrGestao) {
            if ($booAcessoAceite) {
                $this->addHtml('<div style="margin-right: 475px;" ng-show="booExibeBottonAceite">');
                $this->addButton([
                    'name' => 'btn-aceite-' . $strField,
                    'value' => 'Aceitar',
                    'style' => 'margin-right: 5px; margin-top: 20px;',
                    'class' => 'btnAceite',
                    'attr_data' => array(
                        'value' => $arrGestao['in_gestao'],
                        'ng-click' => 'inserirAceite(' . $arrGestao['in_gestao'] . ');'
                    ),
                ]);
                $this->addButton([
                    'name' => 'btn-remove-' . $strField,
                    'value' => 'Remove aceite',
                    'style' => 'margin-right: 5px;',
                    'style' => 'margin-right: 5px; margin-top: 20px;',
                    'class' => 'btnRemove',
                    'attr_data' => array(
                        'value' => $arrGestao['in_gestao'],
                        'ng-click' => 'removeAceite(' . $arrGestao['in_gestao'] . ');'
                    ),
                ]);
                $this->addHtml('</div>');
            }
            $this->addSelect(
                array(
                    'name' => $strField,
                    'value_options' => $arrGestao['values'],
                    'empty_option' => 'Selecione',
                    'label' => $arrGestao['label'],
                    'placeholder' => $arrGestao['label'],
                    'required' => true,
                    'attr_data' => array(
                        'ng-model' => 'data.' . $strField,
                        'ng-disabled' => 'booChecked'
                    ),
                    'value' => $strUsuarioLogado,
                    'style' => 'width: 500px;'
                )
            );
            $this->addHtml('<div class="message-aceite alteracaoAceite' . $arrGestao['in_gestao'] . '" style="margin-top: -20px; width: 500px;"></div>');
        }
        $this->addHtml('</div>');

        $this->addHtml('<div ng-show="booChecked">
            <dl ng-repeat="responsavel in arrResponsavel">
                <dt>
                    <label class="block">{{ responsavel.cargo }}</label>
                </dt>
                <dd>{{ responsavel.responsavel }}</dd>
            </dl>
        </div>');

        $this->addText(array(
            'name' => 'ds_svn',
            'label' => 'SVN',
            'attr_data' => array(
                'ng-model' => 'data.ds_svn',
                'ng-disabled' => 'true'
            )
        ));
        $this->addText(array('name' => 'ds_impedimento_execucao', 'label' => 'Impedimento Execução', 'attr_data' => array('ng-model' => 'data.ds_impedimento_execucao', 'ng-disabled' => 'booChecked')));
        $this->addText(array('name' => 'ds_sugestao_melhoria', 'label' => 'Sugestão Melhoria', 'attr_data' => array('ng-model' => 'data.ds_sugestao_melhoria', 'ng-disabled' => 'booChecked')));

        $this->prepareElementButtons();
        $this->addHtml('</div>');
        $this->setInputFilter(new OrdemServicoFilter(__FUNCTION__));
        return $this;
    }

    public function prepareElementModal()
    {
        $this->addHtml('<div class="modal-impressao hide">');
        $this->addMultiCheckbox(array(
            'name' => 'tp_impressao',
            'label' => 'Documento a ser impresso',
            'required' => true,
            'value_options' => OrdemServicoEntity::$arrTypeDocuments
        ));
        $this->addButton(array('name' => 'btnImpressao', 'class' => 'btnImpressao', 'value' => 'Imprimir'));
        $this->addHidden(array('name' => 'idOrdemServicoImpressao', 'class' => 'idOrdemServicoImpressao', 'required' => true));
        $this->addHtml('</div>');
    }

    protected function prepareElementButtons()
    {
        $intTpVinculo = $this->getVinculoUsuario();
        if ($intTpVinculo !== UsuarioEntity::CO_PERFIL_SERVIDOR) {
            $this->addButton(array(
                'name' => 'btnEmitir',
                'value' => 'Emitir',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'emitirOrdemServico();',
                    'ng-disabled' => 'booCheckedBtnEmitir',
                    'ng-hide' => 'booCheckedBtnEmitir'
                )
            ));
            $this->addButton(array(
                'name' => 'btnAnalise',
                'value' => 'Análise',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'emitirAnalise();',
                    'ng-disabled' => 'booButtonAnalise',
                    'ng-hide' => 'booButtonAnalise'
                )
            ));
            $this->addButton(array(
                'name' => 'btnCorrecao',
                'value' => 'Corrigir OS',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'voltarCorrecao();',
                    'ng-disabled' => 'booButtonCorrecao',
                    'ng-hide' => 'booButtonCorrecao'
                )
            ));
            $this->addButton(array(
                'name' => 'btnSalvar',
                'value' => 'Salvar',
                'type' => 'submit',
                'ng-disabled' => 'booChecked',
                'ng-hide' => 'booChecked'
            ));
            $this->addButton(array(
                'name' => 'btnSuspender',
                'value' => 'Suspender',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'suspenderOS();',
                    'ng-disabled' => 'booButtonSuspender',
                    'ng-hide' => 'booButtonSuspender'
                )
            ));
            $this->addButton(array(
                'name' => 'btnReativar',
                'value' => 'Reativar',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'reabrirOS();',
                    'ng-disabled' => 'booButtonReativar',
                    'ng-hide' => 'booButtonReativar'
                )
            ));
            $this->addButton(array(
                'name' => 'btnImprimirHtml',
                'value' => 'Imprimir HTML',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'imprimirOrdemServicoHtml();',
                    'ng-disabled' => 'booCheckedBtnImpressao'
                )
            ));
            $this->addButton(array(
                'name' => 'btnImprimir',
                'value' => 'Imprimir',
                'type' => 'button',
                'attr_data' => array(
                    'ng-click' => 'imprimirOrdemServico();',
                    'ng-disabled' => 'booCheckedBtnImpressao',
                    'ng-hide' => 'booCheckedBtnImpressao'
                )
            ));
        }
        $this->addButton(array(
            'name' => 'btnVoltar',
            'value' => 'Voltar',
            'type' => 'button',
            'attr_data' => array(
                'ng-click' => 'locationHref(\'/ordemdeservico\');'
            )
        ));
    }

    private function validarAcessoAceite()
    {
        $serviceProfile = $this->getService('OrdemServico\Service\Profile');
        return ($serviceProfile->hasUsuarioPreposto() == true || $serviceProfile->hasUsuarioServidor() == true);
    }

    private function getDateOs($dtVerificacaoOs)
    {
        if (self::DATA_ABERTUTA == $dtVerificacaoOs) {
            $dtAbertura = date("20/m/Y", strtotime("-1 month"));
            $dtAbertura = Date::nextDayNotWeekend($dtAbertura);
            return $dtAbertura;
        }

        if (self::DATA_PRAZO == $dtVerificacaoOs) {
            $dtPrazo = date("19/m/Y");
            $dtPrazo = Date::nextDayNotWeekend($dtPrazo, '-');
            return $dtPrazo;
        }
    }

    private function getVinculoUsuario()
    {
        return $this->getService('OrdemServico\Service\Profile')->getTipoVinculo();
    }
}
