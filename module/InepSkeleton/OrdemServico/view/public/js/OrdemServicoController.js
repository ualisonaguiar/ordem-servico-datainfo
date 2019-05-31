/* global angular, OrdemServicoService */

var strController = 'OrdemServicoController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('OrdemServicoService', ['RestClient', 'AsyncMessage', OrdemServicoService])
    .service('OrdemServicoAceiteService', ['RestClient', 'AsyncMessage', OrdemServicoAceiteService])
    .controller(strController, ['$scope', '$controller', 'OrdemServicoService', 'OrdemServicoAceiteService', 'AsyncMessage',
        function ($scope, $controller, OrdemServicoService, OrdemServicoAceiteService, AsyncMessage) {
            $scope.booPrintRelatorio = false;
            $scope.download = function (strPath) {
                window.open(strGlobalBasePath + '/vendor/InepZend/php/showfile.php?path=' + base64Encode(strPath), '_blank');
            };

            $scope.booButton = false;
            $scope.confirmaImpressao = function (ordemServico) {
                $scope.booPrintRelatorio = false;
                var modalImpressao = $('.modal-impressao');
                openDialog(modalImpressao.html(), 'Confirmação de Impressão - OS' + ordemServico.nu_ordem_servico + '-' + ordemServico.ds_nome, 550, 200);
                $('.idOrdemServicoImpressao:last').val(ordemServico.id_ordem_servico);
            };
            $scope.rowSelectionCount = 0;
            var strIcon = '<i class="fa fa-plus-circle" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.adicionarImpressao(row.entity);" title="Adicionar OS para impressão"></i>';
            strIcon += '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.edit(row.entity);" title="Alterar"></i>';
            strIcon += '<i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.delete(row.entity);" title="Remover"></i>';
            strIcon += '<i class="fa fa-print" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.confirmaImpressao(row.entity);" title="Imprimir"></i>'

            $scope.service = OrdemServicoService;
            $scope.arrColumnDef = [
                {field: 'id_ordem_servico', visible: false},
                {field: 'nu_ordem_servico', displayName: 'Número', width: '8%'},
                {field: 'ds_nome', displayName: 'Descrição', width: '35%'},
                {field: 'dt_prazo', displayName: 'Prazo', width: '10%'},
                {
                    field: 'aceite_1',
                    displayName: 'P',
                    width: '4%',
                    cellTemplate: '<i class="fa fa-{{COL_FIELD}}"></i>'
                },
                {
                    field: 'aceite_2',
                    displayName: 'FT',
                    width: '4%',
                    cellTemplate: '<i class="fa fa-{{COL_FIELD}}"></i>'
                },
                {
                    field: 'aceite_3',
                    displayName: 'FR',
                    width: '4%',
                    cellTemplate: '<i class="fa fa-{{COL_FIELD}}"></i>'
                },
                {
                    field: 'aceite_4',
                    displayName: 'G',
                    width: '4%',
                    cellTemplate: '<i class="fa fa-{{COL_FIELD}}"></i>'
                },
                {
                    field: 'situacao',
                    displayName: 'Situação',
                    width: '10%'
                },
                {
                    name: 'Ações',
                    cellTemplate: strIcon,
                    enableSorting: false,
                    width: '8%'
                }
            ];

            var strIconImpressao = '<i class="fa fa-minus-circle" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.removerImpressao(row.entity);" title="Remover item"></i>';
            $scope.arrOrdemServioImpressao = [];
            $scope.gridOrdemServicoImpressao = {
                enableSorting: false,
                columnDefs: [
                    {field: 'id_ordem_servico', visible: false},
                    {field: 'nu_ordem_servico', displayName: 'Número', width: '10%'},
                    {field: 'ds_nome', displayName: 'Descrição', width: '50%'},
                    {field: 'situacao', displayName: 'Situação', width: '10%'},
                    {
                        name: 'Ações',
                        cellTemplate: strIconImpressao,
                        enableSorting: false,
                        width: '8%'
                    }
                ]
            };

            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));
            $scope.findByPaged(true);

            $scope.pesquisar = function () {
                var arrGestao = new Array();
                if ($('#tp_gestao option').length > 0) {
                    $('#tp_gestao option').each(function (intPosicao) {
                        arrGestao[intPosicao] = $(this).val();
                    });
                }
                $scope.data.tp_gestao = arrGestao.toString();
                $scope.findByPaged();
            };

            $scope.adicionarImpressao = function (rowEntity) {
                var booIncludeGrid = true;
                angular.forEach($scope.gridOrdemServicoImpressao.data, function (register) {
                    if (register.id_ordem_servico === rowEntity.id_ordem_servico) {
                        booIncludeGrid = false;
                    }
                });
                if (booIncludeGrid) {
                    ++$scope.gridOrdemServicoImpressao.totalItems;
                    $scope.gridOrdemServicoImpressao.data.push(rowEntity);
                }
            };

            $scope.removerImpressao = function (rowEntity) {
                angular.forEach($scope.gridOrdemServicoImpressao.data, function (register, intPosicao) {
                    if (register.id_ordem_servico === rowEntity.id_ordem_servico) {
                        delete $scope.gridOrdemServicoImpressao.data[intPosicao];
                        --$scope.gridOrdemServicoImpressao.totalItems;
                        $scope.gridOrdemServicoImpressao.data.splice(intPosicao, 1);
                    }
                });
            };

            $scope.imprimirOrdemServicoSelecionado = function () {
                $scope.service.imprimirOrdemServicoSelecionado(function (mixResult) {
                    $scope.download(mixResult.result);
                }, $scope.gridOrdemServicoImpressao.data);
            };

            $scope.gripOptions.onRegisterApi = function (gridApi) {
                $scope.gridApi = gridApi;
                gridApi.selection.on.rowSelectionChanged($scope, function (row) {
                    $scope.rowSelectionCount = $scope.gridApi.selection.getSelectedRows().length;
                });

                gridApi.selection.on.rowSelectionChangedBatch($scope, function (rows) {
                    $scope.rowSelectionCount = $scope.gridApi.selection.getSelectedRows().length;
                });

                $scope.gridApi.core.on.sortChanged($scope, function (grid, sortColumns) {
                    if (sortColumns.length == 0) {
                        paginationOptions.sort = null;
                    } else {
                        paginationOptions.sort = sortColumns[0].sort.direction;
                    }
                    getPage();
                });
                gridApi.pagination.on.paginationChanged($scope, function (newPage, pageSize) {
                    $scope.paginationOptions.pageNumber = newPage;
                    $scope.paginationOptions.pageSize = pageSize;
                    $scope.findByPaged();
                });
            };

            $scope.aceiteLote = function () {
                if ($scope.gridApi.selection.getSelectedRows().length) {
                    var mixResult = '<p>Ordem de serviço selecionado: <strong>',
                        arrOrdemSelecionado = new Array(),
                        arrParam = new Array();
                    angular.forEach($scope.gridApi.selection.getSelectedRows(), function (ordemServico, intPosicao) {
                        arrOrdemSelecionado[intPosicao] = ordemServico.nu_ordem_servico;
                    });
                    mixResult += arrOrdemSelecionado.toString() + '</strong></p>' + ajaxRequest('/ordemdeservico/ajax-aceite-lote', arrParam);
                    openDialog(mixResult, 'Aceite em lote', 550, 200);
                }
            };

            $('body').on('click', '.btnImpressao:last', function () {
                if ($scope.booPrintRelatorio === false) {
                    if ($('.ui-dialog-content input:checkbox:checked').length === 0) {
                        alertDialog('Informa qual documento que deseja ser impresso.');
                        return false;
                    }
                    $('.ui-dialog-titlebar-close').trigger('click');
                    var arrTypePrint = new Array();
                    $('.ui-dialog-content input:checkbox:checked').each(function (intPosicao, typePrint) {
                        arrTypePrint[intPosicao] = typePrint.value;
                    });
                    var callback = function (mixResult) {
                        $('.ui-widget-content').remove();
                        $scope.download(mixResult.result);
                    };
                    $scope.service.getImprimirOrdemServico(callback, $('.idOrdemServicoImpressao:last').val(), arrTypePrint);
                    $scope.booPrintRelatorio = true;
                }
            }).on('click', '#btnCancelar', function () {
                $('.ui-dialog-titlebar-close').trigger('click');
            }).on('click', '#btnConfirmarLote', function () {
                if ($('.ui-dialog-content:last input:checkbox:checked').length == 0) {
                    AsyncMessage.addError('Favor selecionar qual tipo de aceite será feito na Ordem de Serviço');
                    return false;
                }
                var arrOrdemSelecionado = new Array(),
                    arrAceiteGestao = new Array();
                angular.forEach($scope.gridApi.selection.getSelectedRows(), function (ordemServico, intPosicao) {
                    arrOrdemSelecionado[intPosicao] = ordemServico.id_ordem_servico;
                });
                $('.ui-dialog-content:last input:checkbox:checked').each(function (intPosicao) {
                    arrAceiteGestao[intPosicao] = $(this).val();
                });
                OrdemServicoAceiteService.aceiteLote(function (mixResult) {
                    if (mixResult.result === true) {
                        $('.ui-dialog-titlebar-close').trigger('click');
                        AsyncMessage.addSuccess('OS Aceita com sucesso em lote.');
                        $scope.pesquisar();
                    }
                }, arrOrdemSelecionado, arrAceiteGestao)
            });

        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}