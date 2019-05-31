/* global angular, CatalogoService, AtividadeService, CatalogoServicoAtividade, DemandaService, AsyncMessage */

var strController = 'CatalogoFormController';
angular.module(strController, ['AbstractGridController'])
    .service('CatalogoService', ['RestClient', 'AsyncMessage', CatalogoService])
    .service('AtividadeService', ['RestClient', AtividadeService])
    .service('CatalogoServicoAtividade', ['RestClient', CatalogoServicoAtividade])
    .service('DemandaService', ['RestClient', DemandaService])
    .controller(strController, ['$scope', '$controller', 'CatalogoService', 'CatalogoServicoAtividade', 'AtividadeService', 'DemandaService', '$location', 'AsyncMessage', function ($scope, $controller, CatalogoService, CatalogoServicoAtividade, AtividadeService, DemandaService, $location, AsyncMessage) {
        $scope.service = CatalogoService;
        $scope.serviceAtividade = AtividadeService;
        $scope.serviceCatalogoServicoAtividade = CatalogoServicoAtividade;
        $scope.serviceDemanda = DemandaService;

        $scope.arrColumnDef = [
            {field: 'id_atividade', visible: false},
            {field: 'id_catalogo_servico_atividade', visible: false},
            {field: 'no_atividade', displayName: 'Atividade', width: '80%'},
            {
                name: 'Ações',
                cellTemplate: '<i class="fa fa-times" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.removeAtividade(row.entity);" title="Remover"></i>',
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

        $scope.adicionarItemGrid = function (arrAtividade) {
            ++$scope.gripOptions.totalItems;
            $scope.gripOptions.data.push(arrAtividade);
            $scope.gripOptions.data.sort(function (atividadeFist, atividadeSecond) {
                return atividadeFist.id_atividade - atividadeSecond.id_atividade;
            });
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

        $scope.removeAtividade = function (atividade) {
            if (confirm('Deseja realmente remove este item?')) {
                $scope.service.removeVinculo(function (mixResult) {
                    if (mixResult.status === 'ok') {
                        angular.forEach($scope.gripOptions.data, function (atividadeVinculada, intPosicao) {
                            if (atividadeVinculada.nu_sequencia === atividade.nu_sequencia) {
                                $scope.gripOptions.data.splice(intPosicao, 1);
                            }
                        });
                        --$scope.gripOptions.totalItems;
                        var grid = $scope.gridApi.grid.element;
                        if ($scope.gripOptions.data.length != 0)
                            $(grid).show();
                        else
                            $(grid).hide();
                        AsyncMessage.addSuccess('Item removido com sucesso');
                    }
                }, atividade.id_catalogo_servico_atividade)
            }
        };

        $scope.vincularAtividade = function () {
            if ($scope.data.co_atividade !== undefined && $scope.data.co_atividade !== '') {
                var arrAtividade = {
                    id_atividade: $scope.data.co_atividade,
                    no_atividade: $('#co_atividade option[value="' + $scope.data.co_atividade + '"]').html(),
                    nu_sequencia: Math.random() * 6
                };
                $scope.adicionarItemGrid(arrAtividade);
            }
        };

        $scope.save = function () {
            var callback = function () {
                AsyncMessage.addSuccess('Operação realizada com sucesso!');
                var strUrl = $location.absUrl();
                var arrUrl = explode('/edit/', strUrl);
                if (arrUrl.length <= 1) {
                    arrUrl = explode('/add', strUrl);
                    if (arrUrl.length <= 1)
                        return;
                }
                $scope.locationHref(arrUrl[0]);
            };
            if ($scope.gripOptions.data.length === 0) {
                AsyncMessage.addError('Deverá vincular atividade no catálogo.');
                return false;
            }

            $scope.data.id_atividade_vinculada = $scope.gripOptions.data;
            return $scope.service.save(callback, $scope.data);
        };

        $scope.init = function () {
            var strUrl = $location.absUrl();
            ;
            var arrUrl = explode('/edit/', strUrl);
            if (arrUrl.length <= 1) {
                return true;
            }
            var callbackCatalogoServiceAtividade = function (mixResult) {
                angular.forEach(mixResult.result, function (atividadeVinculada, intPosicao) {
                    var callbackAtividade = function (mixResult) {
                        $scope.adicionarItemGrid(
                            {
                                id_atividade: mixResult.result.id_atividade,
                                no_atividade: mixResult.result.co_atividade + ' - ' + mixResult.result.no_atividade,
                                nu_sequencia: atividadeVinculada.id_catalogo_servico_atividade,
                                id_catalogo_servico_atividade: atividadeVinculada.id_catalogo_servico_atividade
                            }
                        );
                    };
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