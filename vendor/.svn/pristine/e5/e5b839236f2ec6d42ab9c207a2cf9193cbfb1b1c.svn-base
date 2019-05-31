var strController = 'NavigationController';
angular.module(strController, ['AbstractCoreController'])
	.controller(strController, ['$scope', '$controller', 'WindowUtil', '$window', function($scope, $controller, WindowUtil, $window) {
		
		$scope.clickMenu = function($event) {
			var element = $event.target;
			var strUrl = element.getAttribute('data-ng-href');
			if (strUrl === null)
				strUrl = element.getAttribute('ng-href');
			if (strUrl === null)
				strUrl = element.getAttribute('href');
			if (strUrl === null)
				return false;
			if (strUrl.indexOf('javascript:') === 0)
				return false;
		    var strUrlFull = $scope.getBaseUrl() + strUrl;
			if ((strUrl == '#') || (element.getAttribute('data-spa') == 'false') || (strUrlFull.indexOf('/readme') != -1) || ((strUrlFull.indexOf('/inicial') != -1) && (element.getAttribute('title').indexOf('Readme') != -1)))
				$window.location.href = strUrlFull;
			else
				WindowUtil.init($scope).locationHref(strUrlFull, element);
			return true;
		};
		
		angular.extend($scope, $controller('AbstractCoreController', {$scope: $scope}));
		
	}]);
try {
	angular.bootstrap($('.' + strController), [strController]); 
} catch (exception) {
	
}