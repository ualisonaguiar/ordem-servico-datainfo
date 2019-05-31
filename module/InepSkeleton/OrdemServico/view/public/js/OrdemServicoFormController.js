/* global angular, OrdemServicoService */

var strController = 'OrdemServicoFormController';
angular.module(strController, ['CalculaMathController', 'AbstractGridController'])
    .service('OrdemServicoService', ['RestClient', 'AsyncMessage', OrdemServicoService])
    .service('OrdemServicoDemandaService', ['RestClient', 'AsyncMessage', OrdemServicoDemandaService])
    .service('OrdemServicoAceiteService', ['RestClient', 'AsyncMessage', OrdemServicoAceiteService])
    .controller(strController, ['$scope', '$controller', 'OrdemServicoService', 'OrdemServicoDemandaService', 'AsyncMessage', '$location', 'OrdemServicoAceiteService',
        function ($scope, $controller, OrdemServicoService, OrdemServicoDemandaService, AsyncMessage, $location, OrdemServicoAceiteService) {
            var strIcon = '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.editarDemanda(row.entity);" title="Alterar"></i>'
            strIcon += '<i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.removeDemanda(row.entity);" title="Remover"></i>';
            strIcon += '<i class="fa fa-tasks" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.redirecionaDemanda(row.entity);" title="Editar Demanda"></i>';
            $scope.arrColumnDef = [
                {field: 'id_demanda', visible: false},
                {field: 'co_sequencia', displayName: 'Sequência', visible: true, width: '8%'},
                {field: 'dt_abertura', visible: false},
                {field: 'no_demanda', visible: false},
                {field: 'ds_descricao', visible: false},
                {field: 'ds_solucao', visible: false},
                {field: 'co_atividade', displayName: 'ID', width: '5%'},
                {field: 'no_atividade', displayName: 'Atividade', width: '40%'},
                {field: 'vl_complexidade', displayName: 'CO', width: '5%'},
                {field: 'vl_impacto', displayName: 'I', width: '5%'},
                {field: 'vl_criticidade', displayName: 'CR', width: '5%'},
                {field: 'vl_fator_ponderacao', displayName: 'FP', width: '5%'},
                {field: 'vl_facim', displayName: 'FACIM', width: '5%'},
                {field: 'vl_qma', displayName: 'QMA', width: '5%'},
                {field: 'no_executor', visible: false},
                {field: 'no_projeto', visible: false},
                {field: 'ds_ambiente', visible: false},
                {name: 'Ações', cellTemplate: strIcon, enableSorting: false, width: '10%'}
            ];
            $scope.service = OrdemServicoService;
            $scope.serviceOrdemServicoDemanda = OrdemServicoDemandaService;
            $scope.booHabilitarResponsavelOS = true;

            $scope.getDemandaSemOrdemServico = function () {
                if ($scope.serviceOrdemServicoDemanda === undefined) {
                    AsyncMessage.addError(strMsgE5);
                    return false;
                }
                return $scope.serviceOrdemServicoDemanda.listDemandaSemOrdemServico(function (mixResult) {
                    $scope.optionDemandaSemVinculo = mixResult.result;
                });
            };

            $scope.vincularDemanda = function () {
                if (!$scope.data.demanda_vinculada)
                    return;
                var intIdDemanda = $scope.data.demanda_vinculada;
                $scope.optionDemandaSemVinculo = $scope.optionDemandaSemVinculo.filter(function (demanda) {
                    return demanda.value !== $scope.data.demanda_vinculada;
                });
                $scope.getAtividadeRequerida(intIdDemanda);
            };

            $scope.getAtividadeRequerida = function (intIdDemanda) {
                if ($scope.serviceOrdemServicoDemanda === undefined) {
                    AsyncMessage.addError(strMsgE5);
                    return false;
                }
                return $scope.serviceOrdemServicoDemanda.getAtividadeRequerida(function (mixResult) {
                    angular.forEach(mixResult.result, function (informacaoAtividade) {
                        $scope.adicionarItemGrid(informacaoAtividade);
                    });
                    OrdemServicoDemandaService.organizarAtividadeVinculada($scope);
                }, intIdDemanda);
            };

            $scope.adicionarItemGrid = function (informacaoAtividade) {
                ++$scope.gripOptions.totalItems;
                $scope.gripOptions.data.push(informacaoAtividade);
                var grid = $scope.gridApi.grid.element;
                if ($scope.gripOptions.data.length != 0)
                    $(grid).show();
                else
                    $(grid).hide();
            };

            $scope.editarDemanda = function (demanda) {
                if ($scope.booChecked === false) {
                    var arrParam = new Array(),
                        mixResult;
                    angular.forEach(demanda, function (strInforDemanda, strField) {
                        arrParam[strField] = strInforDemanda;
                    });
                    arrParam['acao'] = 'editar';
                    mixResult = ajaxRequest('/demanda/atividade-vinculada-servico', arrParam);
                    openDialog(mixResult, strMsgA1 + demanda.co_sequencia, 1250, 200);
                    $('#atividadeVinculada').html(mixResult);
                    $scope.getValorFatorPonderacao();
                    angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                        if (demandaVinculada.id_demanda === parseInt($('#id_demanda:last').val())) {
                            if ($scope.gripOptions.data[(intPosicao - 1)] === undefined) {
                                $('#btnAnterior').attr('disabled', true);
                            }
                            if ($scope.gripOptions.data[(intPosicao + 1)] === undefined) {
                                $('#btnProximo').attr('disabled', true);
                            }
                        }
                    });
                } else {
                    AsyncMessage.addError(strMsgE5);
                }
            };

            $scope.redirecionaDemanda = function (demanda) {
                window.open(strGlobalBasePath + '/demanda/edit/' + demanda.id_demanda, '_blank');
            };

            $scope.removeDemanda = function (demanda) {
                if (
                    ($scope.data.tp_situacao).toString() === CO_SITUACAO_FINALIZADA ||
                    ($scope.data.tp_situacao).toString() === CO_SITUACAO_SUSPENSO ||
                    ($scope.data.tp_situacao).toString() === CO_SITUACAO_ANALISE
                ) {
                    AsyncMessage.addError(strMsgE5);
                    return false;
                }

                if (confirm(strMsgA4)) {
                    angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                        if (demandaVinculada.id_demanda === demanda.id_demanda) {
                            delete $scope.gripOptions.data[intPosicao];
                            --$scope.gripOptions.data.length;
                        }
                    });

                    if ($scope.data.id_ordem_servico !== '') {
                        var callback = function (mixResult) {
                            if (mixResult.status === 'ok') {
                                OrdemServicoDemandaService.organizarAtividadeVinculada($scope);
                                $scope.filtrarDemandaVinculada();
                            }
                        };
                        $scope.serviceOrdemServicoDemanda.removeVinculoDemanda(callback, {
                            id_demanda: demanda.id_demanda,
                            id_ordem_servico: $scope.data.id_ordem_servico
                        });
                    }
                }
            };

            $scope.download = function (strPath) {
                window.open(strGlobalBasePath + '/vendor/InepZend/php/showfile.php?path=' + base64Encode(strPath), '_blank');
            };

            $scope.emitirOrdemServico = function () {
                if (!$scope.verificarJustificativaAtividade()) {
                    return false;
                }
                var callback = function (mixResult) {
                    $scope.download(mixResult.result);
                    $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                    $scope.getInformacaoAlteracao($scope.data.id_ordem_servico);
                };
                $scope.service.getEmitirOrdemServico(callback, $scope.data);
            };

            $scope.emitirAnalise = function () {
                console.log($scope.gripOptions.data);
                if (($scope.gripOptions.data).length === 0) {
                    AsyncMessage.addError(strMsgE6);
                    return false;
                }
                $scope.service.getAnaliseOrdemServico(function () {
                    $scope.service.getIdentity(function (mixResult) {
                        if (mixResult.result.no_fiscal_requisitante !== mixResult.result.usuarioSistema.usuario.nome) {
                            $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                        }
                        $scope.getInformacaoAlteracao($scope.data.id_ordem_servico);
                    });
                }, $scope.data, CO_SITUACAO_ANALISE);
            };

            $scope.voltarCorrecao = function () {
                $scope.service.getIdentity(function (mixResult) {
                    if (
                        $scope.data.no_fiscal_tecnico === mixResult.result.usuarioSistema.usuario.nome ||
                        $scope.data.no_preposto === mixResult.result.usuarioSistema.usuario.nome
                    ) {
                        $scope.service.getAnaliseOrdemServico(function () {
                            $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                        }, $scope.data, CO_SITUACAO_ABERTA);
                    } else {
                        AsyncMessage.addError('Ação não permitida');
                    }
                    $scope.getInformacaoAlteracao($scope.data.id_ordem_servico);
                });
            };

            $scope.suspenderOS = function () {
                if (confirm(strMsgA2)) {
                    $scope.service.alterarSituacaoSuspender(function () {
                        $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                    }, $scope.data, CO_SITUACAO_SUSPENSO);
                }
            };

            $scope.reabrirOS = function () {
                if (confirm(strMsgA3)) {
                    $scope.service.alterarSituacaoSuspender(function () {
                        $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                    }, $scope.data, CO_SITUACAO_ABERTA);
                }
            };

            $scope.verificarJustificativaAtividade = function () {
                if ($scope.gripOptions.data.length === 0) {
                    AsyncMessage.addError(strMsgE7);
                    return false;
                }
                var booJustificativa = false;
                var arrCondicaoJustificativa = ['M', 'A', 'C', 'PD', 'I'];
                angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                    if (
                        arrCondicaoJustificativa.indexOf(demandaVinculada.vl_complexidade) != -1 ||
                        arrCondicaoJustificativa.indexOf(demandaVinculada.vl_impacto) != -1 ||
                        arrCondicaoJustificativa.indexOf(demandaVinculada.vl_criticidade) != -1 ||
                        arrCondicaoJustificativa.indexOf(demandaVinculada.vl_facim) != -1
                    )
                        booJustificativa = true;
                });
                if (booJustificativa === true && $scope.data.ds_justificativa == '') {
                    AsyncMessage.addError(strMsgE8);
                    return false;
                }
                return true;
            };

            $scope.getDesabilitarCampoEmitido = function (intIdOrdemServico) {
                var callback = function (mixResult) {
                    switch ((mixResult.result.tp_situacao).toString()) {
                        case CO_SITUACAO_ABERTA:
                            $scope.booCheckedBtnEmitir = true;
                            $scope.booButtonCorrecao = true;
                            $scope.booButtonAnalise = false;
                            $scope.booChecked = false;
                            $scope.booButtonSuspender = false;
                            $scope.booButtonReativar = true;
                            break;
                        case CO_SITUACAO_FINALIZADA:
                            $scope.booButtonCorrecao = true;
                            $scope.booButtonAnalise = true;
                            $scope.booCheckedBtnEmitir = true;
                            $scope.booChecked = true;
                            $scope.booButtonSuspender = true;
                            $scope.booButtonReativar = true;
                            openWaitDialog();
                            setTimeout(function () {
                                $scope.arrResponsavel = [
                                    {
                                        "cargo": "Fiscal Requisitante",
                                        "responsavel": $scope.data.no_fiscal_requisitante
                                    },
                                    {
                                        "cargo": "Fiscal Técnico",
                                        "responsavel": $scope.data.no_fiscal_tecnico
                                    },
                                    {
                                        "cargo": "Gestor do Contrato",
                                        "responsavel": $scope.data.no_gestor_contrato
                                    },
                                    {
                                        "cargo": "Preposto",
                                        "responsavel": $scope.data.no_preposto
                                    }
                                ];
                                closeWaitDialog();
                            }, 4000);
                            break;
                        case CO_SITUACAO_ANALISE:
                            $scope.booButtonCorrecao = false;
                            $scope.booCheckedBtnEmitir = false;
                            $scope.booButtonAnalise = true;
                            $scope.booButtonSuspender = false;
                            $scope.booButtonSuspender = true;
                            $scope.booButtonReativar = true;
                            $scope.booChecked = true;
                            break;
                        case CO_SITUACAO_SUSPENSO:
                            $scope.booButtonCorrecao = true;
                            $scope.booButtonAnalise = true;
                            $scope.booCheckedBtnEmitir = true;
                            $scope.booChecked = true;
                            $scope.booButtonSuspender = true;
                            $scope.booButtonReativar = false;
                            break;
                    }

                    if ((mixResult.result.tp_situacao).toString() !== CO_SITUACAO_FINALIZADA) {
                        $scope.findByAceite(intIdOrdemServico);
                    }
                };
                $scope.service.find(callback, intIdOrdemServico);
            };

            $scope.imprimirOrdemServico = function () {
                var callback = function (mixResult) {
                    $scope.download(mixResult.result);
                };
                $scope.service.getImprimirOrdemServico(callback, $scope.data.id_ordem_servico);
            };

            $scope.imprimirOrdemServicoHtml = function () {
                var callback = function (mixResult) {
                    $scope.download(mixResult.result);
                };
                $scope.service.getImprimirOrdemServicoHtml(callback, $scope.data.id_ordem_servico);
            };

            $scope.saveOrdemServico = function () {
                if ($('form').valid()) {
                    var callback = function (mixResult) {
                        AsyncMessage.addSuccess(strMsgE9);
                        $scope.getInformacaoAlteracao(mixResult.result.id_ordem_servico);
                        $scope.data.id_ordem_servico = mixResult.result.id_ordem_servico;
                        $scope.data.nu_ordem_servico = mixResult.result.nu_ordem_servico;
                        $scope.getDesabilitarCampoEmitido($scope.data.id_ordem_servico);
                    };
                    var arrDemandaVinculada = [];
                    angular.forEach($scope.gripOptions.data, function (demandaVinculada) {
                        arrDemandaVinculada.push(demandaVinculada.id_demanda);
                    });
                    $scope.data.id_demanda_vinculada = arrDemandaVinculada;
                    $scope.service.save(callback, $scope.data);
                }
            };

            $scope.setPathSvn = function () {
                if ($scope.data.ds_nome !== '') {
                    $scope.data.ds_nome = $scope.data.ds_nome.split(' ').join('');
                    $scope.data.ds_svn = 'http://ic.inep.gov.br/svn/atsi-doc/OS/' + (new Date().getFullYear()) + '/OS' + $scope.data.nu_ordem_servico + '-' + $scope.data.ds_nome;
                }
            };

            angular.extend($scope, $controller('CalculaMathController', {$scope: $scope}));
            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.gripOptions = {
                enableSorting: false,
                columnDefs: $scope.arrColumnDef,
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                }
            };

            $scope.exibeFiltroDemandaVinculada = function () {
                $scope.booOcultaFiltro = ($scope.booOcultaFiltro) ? false : true;
            };

            $scope.filtrarDemandaVinculada = function () {
                var arrParameter = {
                    dt_abertura_inicio: $scope.data.dt_abertura_inicio,
                    dt_abertura_fim: $scope.data.dt_abertura_fim,
                    tipo_atividade: $scope.data.tipo_atividade,
                    no_executor: $scope.data.no_executor
                };
                var callbackDemandaSemVinculo = function (mixResult) {
                    $scope.optionDemandaSemVinculo = mixResult.result;
                    var dataGrid = $scope.gripOptions.data;
                    angular.forEach($scope.optionDemandaSemVinculo, function (register, mixIndex) {
                        if (register.value != undefined) {
                            var booExists = false;
                            angular.forEach(dataGrid, function (dataGridValue) {
                                if (register.value == dataGridValue.id_demanda) {
                                    booExists = true;
                                    angular.break;
                                }
                            });
                            if (booExists) {
                                var optionNew = [];
                                angular.forEach($scope.optionDemandaSemVinculo, function (option, intKey) {
                                    if (mixIndex != intKey)
                                        optionNew[optionNew.length] = option;
                                });
                                $scope.optionDemandaSemVinculo = optionNew;
                            }
                        }
                    });
                };
                $scope.serviceOrdemServicoDemanda.listDemandaSemOrdemServico(callbackDemandaSemVinculo, arrParameter);
            };

            $scope.getInformacaoAlteracao = function (intidOrdemServico) {
                $scope.service.getInformacaoAlteracao(function (mixResult) {
                    if (mixResult.result === undefined) {
                        return false;
                    }
                    if (mixResult.result.length !== 0) {
                        $scope.exibeDataAlteracao = true;
                        $scope.data_alteracao = mixResult.result.dt_alteracao;
                        $scope.no_usuario = mixResult.result.no_usuario;
                    }
                }, intidOrdemServico);
            };

            $scope.findByAceite = function (intIdOrdemServico) {
                OrdemServicoAceiteService.getListaAceiteGestao(function (mixResult) {
                    $scope.booExibeBottonAceite = true;
                    $('.btnRemove').hide();
                    $('.message-aceite').html('');
                    if ('result' in mixResult) {
                        angular.forEach(mixResult.result, function (ordemAceite) {
                            $('.alteracaoAceite' + ordemAceite.inGestao).append('<div class="alert-info">Aceite ' + ordemAceite.situacao +' por ' + ordemAceite.usuario +'</div>');
                            $('.btnRemove[data-value=' + ordemAceite.inGestao + ']').show();
                            var strLabelButton = 'Remove aceite ' + ordemAceite.situacao;
                            if (ordemAceite.inSituacao == 2) {
                                $('.btnAceite[data-value=' + ordemAceite.inGestao + ']').hide();
                            }
                            $('.btnRemove[data-value=' + ordemAceite.inGestao + ']').html(strLabelButton);
                        });
                    }
                }, intIdOrdemServico);
            };

            $scope.init = function () {
                $scope.data.ds_contrato = '51/2013';
                $scope.booOcultaFiltro = true;
                var strUrl = $location.absUrl();
                var arrUrl = explode('/edit/', strUrl);
                $scope.booExibeBottonAceite = false;
                $scope.booButtonReativar = true;
                if (arrUrl.length <= 1) {
                    $scope.booCheckedBtnEmitir = true;
                    $scope.booCheckedBtnImpressao = true;
                    $scope.booButtonAnalise = true;
                    $scope.booButtonCorrecao = true;
                    $scope.booButtonSuspender = true;
                    $scope.service.getNumeroSequencialOrdemServico(function (mixResult) {
                        $scope.data.nu_ordem_servico = mixResult.result;
                    });
                    return true;
                }
                var callback = function (mixResult) {
                    angular.forEach(mixResult.result, function (demandaVinculada) {
                        if (demandaVinculada.atividade !== undefined) {
                            $scope.adicionarItemGrid(demandaVinculada.atividade);
                        }

                        if (demandaVinculada.servico !== undefined) {
                            angular.forEach(demandaVinculada.servico, function (demandaServico) {
                                $scope.adicionarItemGrid(demandaServico);
                            });
                        }
                    });
                    OrdemServicoDemandaService.organizarAtividadeVinculada($scope);
                };
                $scope.serviceOrdemServicoDemanda.getListDemandaVinculada(callback, arrUrl[1].substr(5));
                $scope.getDesabilitarCampoEmitido(arrUrl[1].substr(5));
                $scope.getInformacaoAlteracao(arrUrl[1].substr(5));
            };

            $scope.atualizarTarefaDemanda = function (demanda, atividade) {
                angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                    if (demandaVinculada.id_demanda === parseInt(demanda.id_demanda)) {
                        $scope.atualizarItemGrid(intPosicao, atividade, demanda);
                    }
                });
            };

            $scope.atualizarTarefaDemandaServico = function (demanda, atividade) {
                angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                    if (demandaVinculada.id_demanda === parseInt(demanda.id_demanda) && demandaVinculada.id_catalogo_servico_atividade === parseInt(demanda.id_catalogo_servico_atividade)) {
                        $scope.atualizarItemGrid(intPosicao, atividade, demanda);
                    }
                });
            };

            $scope.atualizarItemGrid = function (intPosicao, atividade, demanda) {
                $scope.gripOptions.data[intPosicao].co_atividade = atividade.co_atividade;
                $scope.gripOptions.data[intPosicao].no_atividade = atividade.no_atividade;
                $scope.gripOptions.data[intPosicao].vl_complexidade = demanda.vl_complexidade;
                $scope.gripOptions.data[intPosicao].vl_impacto = demanda.vl_impacto;
                $scope.gripOptions.data[intPosicao].vl_criticidade = demanda.vl_criticidade;
                $scope.gripOptions.data[intPosicao].vl_fator_ponderacao = demanda.vl_fator_ponderacao;
                $scope.gripOptions.data[intPosicao].vl_facim = demanda.vl_facim;
                $scope.gripOptions.data[intPosicao].vl_qma = demanda.vl_qma;
            };

            $scope.removeAceite = function(intTpGestao) {
                if (confirm('Deseja relamente remove o aceite desta ordem de serviço?')) {
                    OrdemServicoAceiteService.remover(function(mixResult) {
                        if (mixResult.status === "ok") {
                            AsyncMessage.addSuccess('Aceite removido com sucesso.');
                            $scope.findByAceite($scope.data.id_ordem_servico);
                            $('.btnAceite[data-value=' + intTpGestao + ']').show();
                        }
                    }, intTpGestao, $scope.data.id_ordem_servico);
                }
            };

            $scope.inserirAceite = function(intTpGestao) {
                OrdemServicoAceiteService.inserir(function(mixResult) {
                    if (mixResult.status === "ok") {
                        AsyncMessage.addSuccess('OS aceitada com sucesso.');
                        $scope.findByAceite($scope.data.id_ordem_servico);
                    }
                }, intTpGestao, $scope.data.id_ordem_servico);
            };

            $scope.init();
            $scope.getDemandaSemOrdemServico();

            $('body').on('click', '.btnSalvaDemanda:last', function () {
                salvarEdicaoDemanda();
                $('.ui-dialog-titlebar-close').trigger('click');
            }).on('click', '.btnProximo:last', function () {
                var demandaGrid = [];
                angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                    if (demandaVinculada.id_demanda === parseInt($('#id_demanda:last').val())) {
                        demandaGrid = $scope.gripOptions.data[(intPosicao + 1)];
                    }
                });
                abrirEdicaoDemandaBotaoVoltarProximo(demandaGrid)
            }).on('click', '.btnAnterior:last', function () {
                var demandaGrid = [];
                angular.forEach($scope.gripOptions.data, function (demandaVinculada, intPosicao) {
                    if (demandaVinculada.id_demanda === parseInt($('#id_demanda:last').val())) {
                        demandaGrid = $scope.gripOptions.data[(intPosicao - 1)];
                    }
                });
                abrirEdicaoDemandaBotaoVoltarProximo(demandaGrid)
            }).on('click', '.ui-dialog-titlebar-close:last', function () {
                closeDialog(undefined, true);
            });

            function abrirEdicaoDemandaBotaoVoltarProximo(demandaGrid) {
                salvarEdicaoDemanda();
                closeDialog(undefined, true);
                $scope.editarDemanda(demandaGrid);
            }

            function salvarEdicaoDemanda() {
                var callback = function (mixResult) {
                        if (mixResult.result.status === true) {
                            var demanda = mixResult.result.demanda;
                            var atividade = mixResult.result.demanda.atividade;
                            if (demanda.id_catalogo_servico_atividade !== undefined)
                                $scope.atualizarTarefaDemandaServico(demanda, atividade);
                            else
                                $scope.atualizarTarefaDemanda(demanda, atividade);
                            AsyncMessage.addSuccess('Demanda alterada com sucesso.');
                        }
                    },
                    $intCatalogoServicoAtividade = undefined;
                if ($('.ui-dialog-content input:hidden[name="id_catalogo_servico_atividade"]:last').length !== 0) {
                    $intCatalogoServicoAtividade = $('.ui-dialog-content input:hidden[name="id_catalogo_servico_atividade"]:last').val();
                }
                var arrParam = {
                    id_demanda: $('.ui-dialog-content input:hidden[name="id_demanda"]:last').val(),
                    'id_catalogo_servico_atividade': $intCatalogoServicoAtividade,
                    id_atividade: $('.ui-dialog-content #id_atividade:last').val(),
                    vl_complexidade: $('.ui-dialog-content #vl_complexidade:last').val(),
                    vl_impacto: $('.ui-dialog-content #vl_impacto:last').val(),
                    vl_criticidade: $('.ui-dialog-content #vl_criticidade:last').val(),
                    vl_fator_ponderacao: $('.ui-dialog-content #vl_fator_ponderacao:last').val(),
                    vl_facim: $('.ui-dialog-content #vl_facim:last').val(),
                    vl_qma: $('.ui-dialog-content #vl_qma:last').val()
                };
                $scope.serviceOrdemServicoDemanda.saveAtividadeVinculada(callback, arrParam);
            }

            $scope.consultarNumeroOs = function () {
                var callbackConsultarNumeroOs = function (mixResult) {
                    if (true === mixResult.result) {
                        AsyncMessage.addNotice('Este número de OS já existe.');
                        $scope.data.nu_ordem_servico = '';
                        return false;
                    }
                };
                if ("" !== $scope.data.nu_ordem_servico) {
                    $scope.service.getConsultarNumeroOs(callbackConsultarNumeroOs, $scope.data.nu_ordem_servico);
                }
            };
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}