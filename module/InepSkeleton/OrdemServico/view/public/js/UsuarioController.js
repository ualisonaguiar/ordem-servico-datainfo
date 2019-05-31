/* global angular, AtividadeService */

var strController = 'UsuarioController';
angular.module(strController, ['AbstractGridController'])
	.service('UsuarioService', ['RestClient', 'AsyncMessage', UsuarioService])
	.controller(strController, ['$scope', '$controller', 'UsuarioService', function($scope, $controller, UsuarioService) {

        var strIcon = '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.edit(row.entity);" title="Alterar"></i>';
        strIcon += '<i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.delete(row.entity);" title="Remover"></i>';

		$scope.service = UsuarioService;
		$scope.arrColumnDef = [
			{ field: 'id_usuario', visible: false },
			{ field: 'no_usuario', displayName: 'Nome do Usuário'},
			{ field: 'in_ativo', displayName: 'Situacao', width: '10%'},
			{
				field: 'tp_vinculo',
				displayName: 'Vínculo',
				width: '7%',
				cellClass: function (grid, row, col) {
					if (grid.getCellValue(row, col) == 'Preposto') {
						return 'preposto-texto preposto-texto-cell';
					}
				}
			},
			{ name: 'Ações', cellTemplate: strIcon, enableSorting: false, width: '8%' }
		];
		angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

		$scope.findByPaged(true);

        $scope.vincular = function(rowEntity) {
            var arrParam = new Array(),
                mixResult;
            arrParam['id_usuario'] = rowEntity.id_usuario;
            arrParam['ds_email'] = rowEntity.ds_email;
            arrParam['ds_login'] = rowEntity.ds_login;
            arrParam['no_usuario'] = rowEntity.no_usuario;
            arrParam['nu_pis'] = rowEntity.nu_pis;
            mixResult = ajaxRequest('/usuario/ajaxVinculo', arrParam);
            openDialog(mixResult, 'Vincular usuário');
        };
	}]);
try {
	angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}