/* global angular, DemandaService */

var strController = 'DemandaController';
angular.module(strController, ['AbstractGridController'])
    .service('DemandaService', ['RestClient', 'AsyncMessage', DemandaService])
    .controller(strController, ['$scope', '$controller', 'DemandaService', function ($scope, $controller, DemandaService) {
        $scope.service = DemandaService;
        $scope.arrColumnDef = [
            {field: 'id_demanda', visible: false},
            {field: 'no_demanda', displayName: 'Nome da Demanda', width: '50%'},
            {field: 'nu_ordem_servico', displayName: 'OS', width: '4%'},
            {field: 'no_catalogo_servico', displayName: 'Catálogo Serviço', width: '20%'},
            {field: 'no_executor', displayName: 'Executor', width: '15%'},
            {field: 'dt_abertura', displayName: 'Abertura', width: '7%'},
            //{field: 'tp_situacao', displayName: 'Situação', width: '15%'},
            {
                name: 'Ações',
                cellTemplate: '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.edit(row.entity);" title="Alterar"></i><i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.delete(row.entity);" title="Remover"></i>',
                enableSorting: false,
                width: '8%'
            }
        ];
        $scope.initFind = false;
        angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

        $scope.init = function() {
            $scope.findByPaged(true);
        };
        $scope.init();

        $scope.getAtividadeServicoAssessoria = function () {
            var callback = function (mixResult) {
                $scope.arrCatalagoServico = mixResult.result;
            };
            $scope.service.getAtividadesVinculadaAssessoria(callback, $scope.co_area_assessoria);
        };

    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}