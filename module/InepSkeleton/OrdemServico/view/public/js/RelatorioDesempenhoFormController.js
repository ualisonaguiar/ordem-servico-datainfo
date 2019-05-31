var strController = 'RelatorioDesempenhoFormController';
angular.module(strController, ['AbstractGridController', 'ui.grid.selection'])
    .service('RelatorioDesempenhoService', ['RestClient', 'AsyncMessage', RelatorioDesempenhoService])
    .controller(strController, ['$scope', '$controller', 'RelatorioDesempenhoService',
        function ($scope, $controller, RelatorioDesempenhoService) {

            $scope.download = function (strPath) {
                window.open(strGlobalBasePath + '/vendor/InepZend/php/showfile.php?path=' + base64Encode(strPath), '_blank');
            };

            $scope.pesquisar = function () {
                if ($scope.data.dt_prazo_inicio !== '' && $scope.data.dt_prazo_fim !== '') {
                    RelatorioDesempenhoService.getGerarRelatorio(function (mixResult) {
                        if (mixResult.status === 'ok') {
                            $scope.download(mixResult.result.path);
                        }
                    }, $scope.data);
                }
            };
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}