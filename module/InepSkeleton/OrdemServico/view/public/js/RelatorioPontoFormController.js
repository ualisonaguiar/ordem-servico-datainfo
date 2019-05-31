var strController = 'RelatorioPontoFormController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('RelatorioPontoService', ['RestClient', 'AsyncMessage', RelatorioPontoService])
    .controller(strController, ['$scope', '$controller', 'RelatorioPontoService', 'AsyncMessage',
        function ($scope, $controller, RelatorioPontoService, AsyncMessage) {

            $scope.service = RelatorioPontoService;

            var strIcon = '<i class="fa fa-clock-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.modalJustificarPonto(row.entity);" title="Justificar Ponto"></i>',
                strHtmlForm = '';
            strIcon += '<i class="fa fa-paper-plane" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.enviarPontoApex(row.entity);" title="Enviar ponto ao apex"></i>';

            $scope.arrColumnDef = [
                {
                    field: 'data',
                    displayName: 'Data',
                    enableSorting: false,
                    width: '8%',
                },
                {
                    field: 'hora_0',
                    width: '10%',
                    displayName: 'Entrada',
                    enableSorting: false
                },
                {
                    field: 'hora_1',
                    width: '10%',
                    displayName: 'Saída',
                    enableSorting: false,
                    cellClass: function (grid, row, col) {
                        if (grid.getCellValue(row, col) === 'Justificar') {
                            return 'justificar-ponto-texto justificar-ponto-texto-cell text-center';
                        }
                    }
                },
                {
                    field: 'hora_2',
                    width: '10%',
                    displayName: 'Entrada',
                    enableSorting: false,
                    cellClass: function (grid, row, col) {
                        if (grid.getCellValue(row, col) === 'Justificar') {
                            return 'justificar-ponto-texto justificar-ponto-texto-cell text-center';
                        }
                    }
                },
                {
                    field: 'hora_3',
                    width: '10%',
                    displayName: 'Saída',
                    enableSorting: false,
                    cellClass: function (grid, row, col) {
                        var strCellValue = grid.getCellValue(row, col);
                        if (strCellValue === 'Justificar') {
                            return 'justificar-ponto-texto justificar-ponto-texto-cell text-center';
                        } else if (strrpos(strCellValue, '*') !== false) {
                            return 'sugestao-ponto-texto sugestao-ponto-texto-cell text-center';
                        }
                    }
                },
                {
                    field: 'hora_4',
                    width: '10%',
                    displayName: 'Entrada',
                    enableSorting: false,
                    cellClass: function (grid, row, col) {
                        if (grid.getCellValue(row, col) === '-') {
                            return 'text-center';
                        }
                    }
                },
                {
                    field: 'hora_5',
                    enableSorting: false,
                    width: '8%',
                    displayName: 'Saída',
                    cellClass: function (grid, row, col) {
                        if (grid.getCellValue(row, col) === '-') {
                            return 'text-center';
                        }
                    }
                },
                {
                    field: 'horas_trabalhada',
                    displayName: 'Horas Trabalhadas',
                    width: '13%',
                    enableSorting: false
                },
                {
                    field: 'total',
                    displayName: 'Saldo Horas',
                    width: '8%',
                    enableSorting: false
                },
                {
                    name: 'Ações',
                    cellTemplate: strIcon,
                    enableSorting: false,
                    width: '8%'
                }
            ];

            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.gripOptions = {
                enableSorting: false,
                columnDefs: $scope.arrColumnDef,
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                }
            };

            $scope.setValorInicialData = function () {
                var dataCurrent = new Date(),
                    intMonth = (dataCurrent.getMonth() + 1),
                    strMonth = ((intMonth < 10) ? '0' : '') + intMonth,
                    lastDate = new Date(dataCurrent.getFullYear(), intMonth, 0);
                $scope.data.dt_ponto_inicio = '01/' + strMonth + '/' + dataCurrent.getFullYear();
                $scope.data.dt_ponto_fim = lastDate.getDate() + '/' + strMonth + '/' + dataCurrent.getFullYear();
                RelatorioPontoService.getGerarRelatorio(function (mixResult) {
                    var mixResult = JSON.parse(mixResult.result);
                    $scope.strInfoDataArquivo = mixResult.date_file;
                    $scope.usuarioResponsavelUpload = mixResult.usuario;
                    $scope.pesquisarPonto();
                });
            };

            $scope.pesquisarPonto = function () {
                $scope.gripOptions.data = [];
                $scope.gripOptions.totalItems = 0;
                $scope.service.pesquisarPonto(function (mixResult) {
                    angular.forEach(mixResult.result.ponto, function (informationPonto) {
                        ++$scope.gripOptions.totalItems;
                        $scope.gripOptions.data.push(informationPonto);
                    });
                    RelatorioPontoService.getGerarRelatorio(function (mixResult) {
                        var mixResult = JSON.parse(mixResult.result);
                        $scope.strInfoDataArquivo = mixResult.date_file;
                        $scope.usuarioResponsavelUpload = mixResult.usuario;
                    });
                    $scope.totalHoraTrabalhada = mixResult.result.horaTrabalhada;
                    $scope.totalHoraTrabalhar = mixResult.result.horaTrabalhar;
                    $scope.totalHora = mixResult.result.totalHora;
                }, [$scope.data]);
            };

            $scope.inserirArquivo = function () {
                var filePonto = document.getElementById('arquivo_ponto').files[0],
                    readerFile = new FileReader(),
                    callback = function () {
                        document.getElementById('arquivo_ponto').value = '';
                        $scope.pesquisarPonto();
                        AsyncMessage.addSuccess('Arquivo carregado com sucesso.');
                    };
                readerFile.readAsBinaryString(filePonto);

                readerFile.onloadend = function (event) {
                    var strNameFile = document.getElementById('arquivo_ponto').value;
                    if (strNameFile.indexOf('.txt') !== -1)
                        $scope.service.enviarArquivo(callback, [{arquivo: event.target.result}]);
                    else {
                        AsyncMessage.addError('Arquivo informado inválido.');
                        return false;
                    }
                }
            };

            $scope.modalJustificarPonto = function (rowEntity) {
                var booExibeModal = false;
                angular.forEach(rowEntity, function (item, value) {
                    if (item === 'Justificar' || item.substr(0, 1) === '*') {
                        booExibeModal = true;
                        return false;
                    }
                });
                if (booExibeModal) {
                    openDialog($('.modalJustificarPonto').html(), 'Justificar Ponto', 400, 250);
                    $('.ui-dialog:last #dt_ponto').val(rowEntity.data);
                    $('.ui-dialog:last #hr_ponto').mask('99:99');
                } else {
                    AsyncMessage.addError('Não existem ponto para ser justificado.');
                }
            };

            $scope.justifica = function (strData, strHora) {
                $scope.service.justificarPonto(function (mixResult) {
                    if (mixResult.status === 'ok') {
                        AsyncMessage.addSuccess('Ponto Justificado');
                        $scope.pesquisarPonto();
                    }
                }, [{
                    dt_ponto: strData,
                    hr_ponto: strHora
                }]);
            };

            $scope.enviarPontoApex = function (rowEntity) {
                if ((rowEntity.hora_1 === 'Justificar' && rowEntity.hora_3 === 'Justificar')) {
                    AsyncMessage.addError('Não existe horário suficiente para lançar no APEX');
                    return false;
                } else {
                    if (!strHtmlForm) {
                        strHtmlForm = $('.modalEnviarApex').html();
                    }
                    openDialog(strHtmlForm, 'Enviar informações ao apex', 800, 600);
                    $('.modalEnviarApex').remove();
                    var strHtml = '<strong>Data: </strong>' + rowEntity.data + '<br />',
                        arrHorario = new Array();
                    rowEntity.hora_4 = replaceAll(rowEntity.hora_4, '-', '');
                    rowEntity.hora_5 = replaceAll(rowEntity.hora_5, '-', '');

                    arrHorario[0] = rowEntity.hora_0;
                    arrHorario[1] = rowEntity.hora_1;
                    arrHorario[2] = rowEntity.hora_2;
                    arrHorario[3] = rowEntity.hora_3;
                    if (rowEntity.hora_4)
                        arrHorario[4] = rowEntity.hora_4;
                    if (rowEntity.hora_5)
                        arrHorario[5] = rowEntity.hora_5;

                    strHtml += '<strong>Hora: </strong>' + arrHorario.toString();
                    $('.ui-dialog #informacaoPonto:last').html(strHtml);

                    $('.ui-dialog #dt_ponto_apex').val(rowEntity.data);
                    $('.ui-dialog #hr_ponto_apex').val(arrHorario.toString());
                }
            };

            $scope.enviarInformacaoApex = function (arrDados) {
                $scope.service.enviarInformacaoApex(function (mixResult) {
                    if (mixResult.status == 'ok') {
                        alertDialog('Ponto registrado com sucesso no APEX', 'Registro no APEX', 400, 200, 'location.reload()');
                    }
                }, [arrDados]);
            };

            $scope.lancarFeria = function () {
                openWaitDialog();
                $scope.service.lancamentoFeria(function (mixResult) {
                    closeWaitDialog();
                    if (mixResult.status == 'ok') {
                        alertDialog('Período de Férias registrado com sucesso no APEX', 'Registro no APEX', 400, 200, 'location.reload()');
                    }
                }, [$scope.data]);
            };
            
            $scope.lancarPonto = function () {
                openWaitDialog();
                var strPeriodo = '';
                if ($('#hrConsultorExterno input:checkbox').is(':checked') == true) {
                	$('#hrConsultorExterno input:checkbox:checked').each(function() {
                		strPeriodo += $(this).val() + '|';
                	});
                	$scope.data.periodo = strPeriodo;
                }
                $scope.service.lancamentoPonto(function (mixResult) {
                    closeWaitDialog();
                    if (mixResult.status == 'ok') {
                        alertDialog('Ponto Consultor Externo lançado com sucesso', 'Ponto Consultor Externo', 400, 200, 'location.reload()');
                    }
                }, [$scope.data]);
            };

            $('body').on('click', '.ui-dialog:last #btnJustificar', function () {
                if ($('.ui-dialog:last #hr_ponto').val() === '') {
                    AsyncMessage.addError('Favor informar a hora a ser justificada.');
                    return false;
                } else {
                    $('.ui-dialog:last .ui-icon-closethick').trigger('click');
                    $scope.justifica($('.ui-dialog:last #dt_ponto').val(), $('.ui-dialog:last #hr_ponto').val());
                }
            }).on('change', ".ui-dialog:last select[name='id_ordem_servico']", function () {
                $(".ui-dialog:last select[name='id_demanda']").empty();
                $(".ui-dialog:last select[name='id_atividade']").empty();
                $('.ui-dialog:last #ds_descricao').html('');
                var arrUrlParam = Array();
                arrUrlParam['id_ordem_servico'] = $("select[name='id_ordem_servico']:last").val();
                mixResult = ajaxRequest(
                    '/relatorioponto/ajaxListaDemanda',
                    arrUrlParam
                );
                mixResult = JSON.parse(mixResult);
                $(".ui-dialog:last select[name='id_demanda']").append(new Option('Selecione', ''));
                angular.forEach(mixResult, function (strNoDemanda, intIdDemanda) {
                    $(".ui-dialog:last select[name='id_demanda']:last").append(new Option(strNoDemanda, intIdDemanda));
                });
            }).on('change', ".ui-dialog:last select[name='id_demanda']", function () {
                $(".ui-dialog:last select[name='id_atividade']").empty();
                var arrUrlParam = Array();
                arrUrlParam['id_demanda'] = $(".ui-dialog:last select[name='id_demanda']").val();

                $('.ui-dialog:last #ds_descricao').val($(".ui-dialog:last select[name='id_demanda'] option:selected").text());

                mixResult = ajaxRequest(
                    '/relatorioponto/ajaxListaDemandaAtividade',
                    arrUrlParam
                );
                mixResult = JSON.parse(mixResult);
                $("select[name='id_atividade']:last").append(new Option('Selecione', ''));
                angular.forEach(mixResult, function (strNoAtividade, intIdDemandaAtividade) {
                    $("select[name='id_atividade']:last").append(new Option(strNoAtividade, intIdDemandaAtividade));
                });
            }).on('click', '.ui-dialog:last #btnEnviarApex', function () {
                var intIdAtividade = $("select[name='id_atividade']:last").val(),
                    strDescricao = $('#ds_descricao:last').val();
                if (
                    ($('#no_usario').length > 1 && $('#no_senha').length > 1) ||
                    ($('#no_usario').val() === '' && $('#no_senha').val() === '')
                ) {
                    AsyncMessage.addError('Favor informar usuário/senha de acesso ao sistema APEX.');
                    return false;
                }

                if (intIdAtividade === '') {
                    AsyncMessage.addError('Deverá selecionar uma atividade antes de enviar as informações ao APEX.');
                    return false;
                }
                if (strDescricao === '') {
                    AsyncMessage.addError('Favor informar uma descrição da atividade.');
                    return false;
                }

                $scope.enviarInformacaoApex({
                    'id_catalogo_servico_atividade': intIdAtividade,
                    'id_demanda': $("select[name='id_demanda']:last").val(),
                    'dt_ponto': $('#dt_ponto_apex:last').val(),
                    'hr_ponto': $('#hr_ponto_apex:last').val(),
                    'ds_descricao': strDescricao.replace(/[\u200B-\u200D\uFEFF]/g, ''),
                    'login': base64Encode($('#no_usario:last').val() + ':' + $('#no_senha:last').val())
                });
            });
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}