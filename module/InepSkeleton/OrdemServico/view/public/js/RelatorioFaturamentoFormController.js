var strController = 'RelatorioFaturamentoFormController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('RelatorioFaturamentoService', ['RestClient', 'AsyncMessage', RelatorioFaturamentoService])
    .controller(strController, ['$scope', '$controller', 'RelatorioFaturamentoService', function ($scope, $controller, RelatorioFaturamentoService) {

        $scope.service = RelatorioFaturamentoService;
        $scope.arrColumnDef = [
            {field: 'id_ordem_servico', visible: false},
            {field: 'nu_ordem_servico', displayName: 'Número', width: '10%', enableSorting: false},
            {field: 'ds_nome', displayName: 'Descrição', width: '35%', enableSorting: false},
            {field: 'dt_prazo', displayName: 'Prazo', width: '15%', enableSorting: false},
        ];
        angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

        $scope.init = function () {
            var actualDateEnd = new Date(),
                dateStar = new Date(actualDateEnd.getFullYear(), actualDateEnd.getMonth() - 1, actualDateEnd.getDate()),
                mixMonthStart = (dateStar.getMonth() + 1),
                mixMonthEnd = (actualDateEnd.getMonth() + 1);
            if (mixMonthStart < 10)
                mixMonthStart = '0' + mixMonthStart;
            if (mixMonthEnd < 10)
                mixMonthEnd = '0' + mixMonthEnd;
            $scope.data.dt_prazo_inicio = '21/' + mixMonthStart + '/' + dateStar.getFullYear();
            $scope.data.dt_prazo_fim = '20/' + mixMonthEnd + '/' + actualDateEnd.getFullYear();
            $scope.booExibeBotaoGerarRelatorio = false;
            $scope.pesquisarOrdemServico();
        };

        $scope.pesquisarOrdemServico = function() {
            var callback = function(mixResult) {
                var arrResult = mixResult.result;
                if (arrResult.length !== 0) {
                    angular.forEach(arrResult, function(ordemRegistro) {
                        ++$scope.gripOptions.totalItems;
                        $scope.gripOptions.data.push(ordemRegistro);
                    });
                    $scope.booExibeBotaoGerarRelatorio = true;
                }
            };
            $scope.gripOptions.totalItems = 0;
            $scope.gripOptions.data = [];
            $scope.booExibeBotaoGerarRelatorio = false;
            $scope.service.pesquisarOrdemServico(callback, $scope.data);
        };

        $scope.emitirRelatorio = function() {
            $scope.data.arrIdOrdemServico = $scope.gridApi.selection.getSelectedRows();
            $scope.data.arrIdOrdemServico.sort(function (ordemServicoFist, ordemServicoSecond) {
                return parseInt(ordemServicoFist.nu_ordem_servico) - parseInt(ordemServicoSecond.nu_ordem_servico);
            });
            if ($scope.data.arrIdOrdemServico.length === 0) {
                AsyncMessage.addNotice('Favor selecione na listagem a(s) Orden(s) de Serviço(s).');
                return false;
            }
            var callbackRelatorio = function(mixResult) {
                window.open(strGlobalBasePath + '/vendor/InepZend/php/showfile.php?path=' + base64Encode(mixResult.result), '_blank');
            };
            $scope.service.getGerarRelatorio(callbackRelatorio, $scope.data);
        };

        $scope.init();
    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}