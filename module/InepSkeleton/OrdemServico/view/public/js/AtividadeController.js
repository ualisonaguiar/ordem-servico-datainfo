/* global angular, AtividadeService */

var strController = 'AtividadeController';
angular.module(strController, ['AbstractGridController'])
    .service('AtividadeService', ['RestClient', 'AsyncMessage', AtividadeService])
    .controller(strController, ['$scope', '$controller', 'AtividadeService', '$http', function ($scope, $controller, AtividadeService, $http) {

        $scope.service = AtividadeService;
        $scope.arrColumnDef = [
            {field: 'id_atividade', visible: false},
            {field: 'co_atividade', displayName: 'Código da Atividade', width: '15%'},
            {field: 'no_atividade', displayName: 'Nome'},
            {field: 'ds_descricao', visible: false},
            {field: 'vl_baixo_definido', displayName: 'Valor do Baixo/Definido', width: '15%'},
            {field: 'ds_area_assessoria', visible: false},
            {
                name: 'Ações',
                cellTemplate: '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.edit(row.entity);" title="Alterar"></i><i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.delete(row.entity);" title="Remover"></i>',
                enableSorting: false,
                width: '8%'
            }
        ];
        angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

        //$scope.findByPaged(true);

    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}