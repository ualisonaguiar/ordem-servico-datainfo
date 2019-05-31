var strController = 'AtividadeFormController';
angular.module(strController, ['AbstractFormController'])
	.service('AtividadeService', ['RestClient', 'AsyncMessage', AtividadeService])
	.controller(strController, ['$scope', '$controller', 'AtividadeService', function($scope, $controller, AtividadeService) {
		
		$scope.service = AtividadeService;
		
		angular.extend($scope, $controller('AbstractFormController', {$scope: $scope}));
		
	}]);
try {
	angular.bootstrap($('.' + strController), [strController]); 
} catch (exception) {
	
}