var strController = 'RelatorioPessoalFormController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('RelatorioPessoalService', ['RestClient', 'AsyncMessage', RelatorioPessoalService])
    .controller(strController, ['$scope', '$controller', 'RelatorioPessoalService',
        function ($scope, $controller, RelatorioPessoalService) {
            $scope.service = RelatorioPessoalService;
            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.registro = [];
            $scope.pesquisar = function () {
                if ($scope.frm.$valid) {
                    openWaitDialog();
                    if ($scope.data.dt_prazo_inicio !== '' && $scope.data.dt_prazo_fim !== '') {
                        $scope.data.no_executor = [];
                        $('#no_executor option').each(function () {
                            $scope.data.no_executor.push($(this).val());
                        });
                        RelatorioPessoalService.getGerarRelatorio(function (mixResult) {
                            closeWaitDialog();
                            $('#resultado').html(mixResult.result);
                        }, $scope.data);
                    }
                }
            };
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}