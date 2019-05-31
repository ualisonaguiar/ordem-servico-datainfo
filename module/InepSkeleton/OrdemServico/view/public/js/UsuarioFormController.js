var strController = 'UsuarioFormController';
angular.module(strController, ['AbstractFormController'])
    .service('UsuarioService', ['RestClient', 'AsyncMessage', UsuarioService])
    .controller(strController, ['$scope', '$controller', 'UsuarioService', function ($scope, $controller, UsuarioService) {

        $scope.service = UsuarioService;

        angular.extend($scope, $controller('AbstractFormController', {$scope: $scope}));
    }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}