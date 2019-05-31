angular.module('AbstractFormController', ['AbstractCoreController'])
	.controller('AbstractFormController', ['$scope', '$controller', 'AsyncMessage', '$location', function($scope, $controller, AsyncMessage, $location) {
		
		if (empty($scope.find)) {
			$scope.find = function(mixPk) {
				if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
				var callback = function(mixResult) {
					mixResult = mixResult.result;
					for (var strAttribute in mixResult) {
	                    if (mixResult[strAttribute])
	                        mixResult[strAttribute] = mixResult[strAttribute].toString();
	                }
					$scope.data = mixResult;
//					$scope.formatDataForm();
					var form = document.getElementById($scope.strIdController);
//					var arrMaskMoney = $('input[data-money="true"]', form).get();
//					for (var intCount in arrMaskMoney) {
//						var strMaskMoney = arrMaskMoney[intCount].getAttribute('id');
//						if (!empty($scope.data[strMaskMoney]))
//							$scope.data[strMaskMoney] = formatMoney($scope.data[strMaskMoney]);
//					}
					var arrTextarea = $('textarea', form).get();
					for (var intCount in arrTextarea) {
						var strTextarea = arrTextarea[intCount].getAttribute('id');
						var arrResult = getLengthCounterHtml($scope.data[strTextarea], $('#' + strTextarea).attr('maxlength'));
						$('.counterCharacters_' + strTextarea + ' span.countMin').html(arrResult[0]);
					}
	 			};
	 			return $scope.service.find(callback, mixPk);
			};
		}
		
		if (empty($scope.save)) {
			$scope.save = function() {
				if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
				var form = document.getElementById($scope.strIdController);
				if (!$('form', form).valid())
					return false;
				var callback = function() {
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
//	 			var arrMaskMoney = $('input[data-maskmoney="true"]', form).get();
//				for (var intCount in arrMaskMoney) {
//					var strMaskMoney = arrMaskMoney[intCount].getAttribute('id');
//					$scope.data[strMaskMoney] = $('#' + strMaskMoney).val();
//				}
	 			return $scope.service.save(callback, $scope.data);
			};
		}
		
//		$scope.formatDataForm = function() {
//			var form = document.getElementById($scope.strIdController);
//			var arrMaskMoney = $('input[data-money="true"]', form).get();
//			for (var intCount in arrMaskMoney) {
//				var strMaskMoney = arrMaskMoney[intCount].getAttribute('id');
//				if (!empty($scope.data[strMaskMoney]))
//					$scope.data[strMaskMoney] = formatMoney($scope.data[strMaskMoney]);
//			}
//			var arrTextarea = $('textarea', form).get();
//			for (intCount in arrTextarea) {
//				var strTextarea = arrTextarea[intCount].getAttribute('id');
//				var arrResult = getLengthCounterHtml($scope.data[strTextarea], $('#' + strTextarea).attr('maxlength'));
//				$('.counterCharacters_' + strTextarea + ' span.countMin').html(arrResult[0]);
//			}
//		};
		
		angular.extend($scope, $controller('AbstractCoreController', {$scope: $scope}));

		if (!isBoolean($scope.initFind))
			$scope.initFind = true;
		$scope.init = function() {
			if (empty($scope.service)) {
				AsyncMessage.addError('Serviço não definido!');
				return false;
			}
			if (empty($scope.data))
				$scope.data = $scope.getDataEmptyFromForm();
			if ($scope.initFind === false)
				return true;
			var strUrl = $location.absUrl();
			var arrUrl = explode('/edit/', strUrl);
			if (arrUrl.length <= 1)
				return true;
			var strParam = arrUrl[1].substr(5);
			var arrParam = explode('/', strParam);
			return $scope.find(arrParam[0]);
		};
		$scope.init();
		
	}]);