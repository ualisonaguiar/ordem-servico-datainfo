var strController = 'LoginController';
angular.module(strController, ['AbstractCoreController'])
	.controller(strController, ['$scope', '$controller', 'WindowUtil', 'RestClient', 'AsyncMessage', function($scope, $controller, WindowUtil, RestClient, AsyncMessage) {
		
		$scope.init = function() {
			$scope.data = $scope.getDataEmptyFromForm();
		};
		
		$scope.authenticate = function() {
			if (!$('#login').valid())
				return false;
			var callback = function(mixResult, arrParam) {
				mixResult = mixResult.result;
				if (empty(mixResult[1]))
					AsyncMessage.addError('Não foi possível realizar a operação!');
				else {
					if (!empty(mixResult[1].identity)) {
						AsyncMessage.addSuccess(mixResult[1].messages[0]);
						WindowUtil.init($scope).locationHref('/' + strGlobalInitRoute);
						return;
					}
					AsyncMessage.addError(mixResult[1].messages[0]);					
				}
				if ((!empty(arrParam[0])) && (empty(arrParam[0].captcha))) {
					WindowUtil.init($scope).locationHref('/logoff');
					$scope.$destroy();
				}
			};
			return RestClient.runService('InepZend\\Module\\Authentication\\Service\\Authentication', 'authenticateAction', [$scope.data, undefined, 'InepZend\\Module\\Authentication\\Form\\Login'], 'WS_RSRC_LOGIN_ACTION', callback)
		};
		
		angular.extend($scope, $controller('AbstractCoreController', {$scope: $scope}));
		
		$scope.init();
		
	}]);
try {
	angular.bootstrap($('.' + strController), [strController]); 
} catch (exception) {
	
}