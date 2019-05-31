var strController = 'OrdemServicoAceiteFormController';
angular.module(strController, ['AbstractGridController'])
    .service('OrdemServicoAceiteService', ['RestClient', 'AsyncMessage', OrdemServicoAceiteService])
    .controller(strController, ['$scope', '$controller', 'OrdemServicoAceiteService', function ($scope, $controller, OrdemServicoAceiteService) {

        angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));
    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}