/* global angular, AtividadeService */

var strController = 'CatalogoController';
angular.module(strController, ['AbstractGridController'])
    .service('AtividadeService', ['RestClient', 'AsyncMessage', CatalogoService])
    .controller(strController, ['$scope', '$controller', 'AtividadeService', function ($scope, $controller, CatalogoService) {

        $scope.service = CatalogoService;
        $scope.arrColumnDef = [
            {field: 'id_catalogo_servico', visible: false},
            {field: 'area', displayName: 'Área', width: '30%'},
            {field: 'no_catalogo_servico', displayName: 'Catálogo Servico', width: '30%'},
            {field: 'codigo', displayName: 'Atividade Vinculadas', width: '30%'},
            {
                name: 'Ações',
                cellTemplate: '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.edit(row.entity);" title="Alterar"></i><i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.delete(row.entity);" title="Remover"></i>',
                enableSorting: false,
                width: '8%'
            }
        ];
        angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));
        $scope.findByPaged(true);
        sessionStorage.clear();
    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}