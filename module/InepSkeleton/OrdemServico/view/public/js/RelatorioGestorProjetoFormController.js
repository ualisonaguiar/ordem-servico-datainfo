var strController = 'RelatorioGestorProjetoFormController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('RelatorioGestorProjetoService', ['RestClient', 'AsyncMessage', RelatorioGestorProjetoService])
    .controller(strController, ['$scope', '$controller', 'RelatorioGestorProjetoService',
        function ($scope, $controller, RelatorioGestorProjetoService) {
            var strIconImpressao = '<i class="fa fa-pencil-square-o" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.redirecionaInformacaoOs(row.entity);" title="Somar OS"></i>';
            strIconImpressao += '<i class="fa fa-plus-circle" style="margin: 10px; margin-right: 0px; cursor: pointer;" data-ng-click="grid.appScope.somarOrdemServico(row.entity);" title="Visualizar OS"></i>';

            $scope.service = RelatorioGestorProjetoService;
            $scope.arrColumnDef = [
                {field: 'id_ordem_servico', visible: false},
                {field: 'numero_os', displayName: 'OS', width: '8%'},
                {field: 'dt_fim', displayName: 'Data Fim', width: '15%'},
                {field: 'tp_situacao', displayName: 'Situação', width: '10%'},
                {field: 'vlr_mat', displayName: 'MAT', width: '10%'},
                {
                    name: 'Ações',
                    cellTemplate: strIconImpressao,
                    enableSorting: false,
                    width: '8%'
                }
            ];

            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.findByPaged(true);

            $scope.redirecionaInformacaoOs = function (ordemServico) {
                window.open(strGlobalBasePath + '/ordemdeservico/edit/' + ordemServico.id_ordem_servico, '_blank');
            };

            $scope.somarOrdemServico = function (ordemServico) {
                if ($scope.arrOrdemServico.indexOf(ordemServico) === -1) {
                    $scope.arrOrdemServico.push(ordemServico);
                    $scope.valorTotalMaT += ordemServico.vlr_mat;
                } else {
                    alertDialog('A OS:<strong>' + ordemServico.numero_os + '-' + ordemServico.descricao_os + '</strong> já encontra adicionando na lista abaixo.', 'Aviso');
                }
            };

            $scope.remove = function (ordemServico) {
                var intIndex = $scope.arrOrdemServico.indexOf(ordemServico);
                $scope.arrOrdemServico.splice(intIndex, 1);
                $scope.valorTotalMaT -= ordemServico.vlr_mat;
            };

            $scope.pesquisar = function () {
                $scope.findByPaged();
            };

            $scope.arrOrdemServico = [];
            $scope.valorTotalMaT = 0;
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}