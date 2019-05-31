/* global angular, CatalogoService, AtividadeService, CatalogoServicoAtividade, DemandaService */

var strController = 'CatalogoServiceFormController';
angular.module(strController, ['AbstractGridController'])
        .service('CatalogoService', ['RestClient', 'AsyncMessage', CatalogoService])
        .service('AtividadeService', ['RestClient', AtividadeService])
        .service('CatalogoServicoAtividade', ['RestClient', CatalogoServicoAtividade])
        .service('DemandaService', ['RestClient', DemandaService])
        .controller(strController, ['$scope', '$controller', 'CatalogoService', 'CatalogoServicoAtividade', 'AtividadeService', 'DemandaService', '$location', function ($scope, $controller, CatalogoService, CatalogoServicoAtividade, AtividadeService, DemandaService, $location) {
            $scope.service = CatalogoService;
            $scope.serviceAtividade = AtividadeService;
            $scope.serviceCatalogoServicoAtividade = CatalogoServicoAtividade;
            $scope.serviceDemanda = DemandaService;

            $scope.arrColumnDef = [
                {field: 'id_atividade', visible: false},
                {field: 'no_atividade', displayName: 'Atividade', width: '80%'},
                {name: 'Ações', cellTemplate: '<i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.removeAtividade(row.entity);" title="Remover"></i>', enableSorting: false, width: '8%'}
            ];
            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.gripOptions = {
                enableSorting: false,
                columnDefs: $scope.arrColumnDef,
                onRegisterApi: function(gridApi) {
                    $scope.gridApi = gridApi;
                }
            };

            $scope.adicionarItemGrid = function(arrAtividade) {
                ++$scope.gripOptions.totalItems;
                $scope.gripOptions.data.push(arrAtividade);
                if (!$scope.data.id_atividade_vinculada)
                    $scope.data.id_atividade_vinculada = [];
                $scope.data.id_atividade_vinculada.push(arrAtividade);
                var grid = $scope.gridApi.grid.element;
                if ($scope.gripOptions.data.length !== 0)
                    $(grid).show();
                else
                    $(grid).hide();
                $scope.data.co_atividade = '';
            };

            $scope.removeAtividade = function(atividade) {
                $scope.data.id_atividade_vinculada.splice($scope.data.id_atividade_vinculada.indexOf(atividade.id_atividade), 1);
                angular.forEach($scope.gripOptions.data, function (atividadeVinculada, intPosicao) {
                    if (atividadeVinculada.id_atividade === atividade.id_atividade) {
                        $scope.gripOptions.data.splice(intPosicao, 1);
                    }
                });
                --$scope.gripOptions.totalItems;
                var grid = $scope.gridApi.grid.element;
                if ($scope.gripOptions.data.length != 0)
                    $(grid).show();
                else
                    $(grid).hide();
            };

            $scope.vincularAtividade = function() {
                var arrAtividade = {
                    id_atividade: $scope.data.co_atividade,
                    no_atividade: $('#co_atividade option[value="' + $scope.data.co_atividade +'"]').html()
                };
                $scope.adicionarItemGrid(arrAtividade);
            };
            $scope.init = function () {
                var strUrl = $location.absUrl();
                var arrUrl = explode('/edit/', strUrl);
                if (arrUrl.length <= 1) {
                    return true;
                }
                var callbackCatalogoServiceAtividade = function(mixResult) {
                    angular.forEach(mixResult.result, function (atividadeVinculada, intPosicao) {
                        var callbackAtividade = function(mixResult) {
                            $scope.adicionarItemGrid(
                                {
                                    id_atividade: mixResult.result.id_atividade,
                                    no_atividade: mixResult.result.co_atividade + ' - ' + mixResult.result.no_atividade
                                }
                            );
                        }
                        $scope.serviceAtividade.find(callbackAtividade, atividadeVinculada.id_atividade);
                    });
                };
                $scope.serviceCatalogoServicoAtividade.findBy(callbackCatalogoServiceAtividade, {id_catalogo_servico: arrUrl[1].substr(5)});
            };
            $scope.init();
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}