var strController = 'MonitoramentoEnvioController';
angular.module(strController, ['AbstractCoreController'])
	.controller(strController, ['$scope', '$controller', function($scope, $controller) {
		
		angular.extend($scope, $controller('AbstractCoreController', {$scope: $scope}));
		
	}]);
try {
	angular.bootstrap($('.' + strController), [strController]); 
} catch (exception) {
	
}