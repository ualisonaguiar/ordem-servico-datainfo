<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/javascript");
header("Cache-Control: max-age=604800, public, must-revalidate");
header("Pragma: max-age=604800, public, must-revalidate");
if ((is_null($mixZlib = ini_get("zlib.output_compression"))) || ($mixZlib == ""))
    ini_set("zlib.output_compression", true);
header("Accept-Encoding: gzip");
if ((@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) == $intLastModifiedTime) || (trim(@$_SERVER["HTTP_IF_NONE_MATCH"]) == $strETag)) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}
?>
angular.module('AbstractGridController', ['AbstractFormController', 'ui.grid', 'ui.grid.pagination', 'ui.grid.i18n', 'ui.grid.autoResize'])
	.controller('AbstractGridController', ['$scope', '$controller', 'AsyncMessage', '$location', '$window', 'i18nService', function($scope, $controller, AsyncMessage, $location, $window, i18nService) {

		$scope.paginationOptions = {
			pageNumber: 1,
			pageSize: 10,
			sort: '',
			field: ''
		};
		i18nService.setCurrentLang('pt');
		$scope.gripOptions = {
		    paginationPageSizes: [10, 15, 20, 30, 50],
		    paginationPageSize: 10,
		    useExternalPagination: true,
		    useExternalSorting: true,
			columnDefs: $scope.arrColumnDef,
		    onRegisterApi: function(gridApi) {
				$scope.gridApi = gridApi;
				$scope.gridApi.core.on.sortChanged($scope, function(grid, arrSortColumn) {
					if (arrSortColumn.length === 0) {
						$scope.paginationOptions.sort = '';
						$scope.paginationOptions.field = '';
					} else {
						$scope.paginationOptions.sort = arrSortColumn[0].sort.direction;
						$scope.paginationOptions.field = arrSortColumn[0].field;
					}
					$scope.findByPaged();
				});
				$scope.gridApi.pagination.on.paginationChanged($scope, function (intPageNew, intPageSize) {
					$scope.paginationOptions.pageNumber = intPageNew;
					$scope.paginationOptions.pageSize = intPageSize;
					$scope.findByPaged();
				});
			}
		};

		$scope.clearData = function() {
			if (empty($scope.data_empty))
				$scope.data_empty = $scope.getDataEmptyFromForm();
			angular.copy($scope.data_empty, $scope.data);
			return $scope;
		};

		if (empty($scope.edit)) {
			$scope.edit = function(element, strUrlComplement) {
				if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
				var strUrl = $location.absUrl() + (((empty(strUrlComplement)) || ($location.absUrl().indexOf(strUrlComplement) != -1)) ? '' : strUrlComplement) + '/edit';
				for (var intCount in $scope.service.arrPk) {
					var strPk = $scope.service.arrPk[intCount];
					strUrl += '/' + element[strPk];
				}
				return $scope.locationHref(strUrl);
			};
		}

		if (empty($scope.findBy)) {
	 		$scope.findBy = function(booInit) {
	 			if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
	 			var callback = function(mixResult) {
	 				mixResult = mixResult.result;
	 				if (booInit !== true)
	 					AsyncMessage.addSuccess('Operação realizada com sucesso!');
	 				$scope.gripOptions.data = mixResult;
	 				var grid = $scope.gridApi.grid.element;
					if ($scope.gripOptions.data.length !== 0)
						$(grid).show();
					else
						$(grid).hide();
	 			};
	 			return $scope.service.findBy(callback, $scope.data);
			};
		}

		if (empty($scope.findByPaged)) {
	 		$scope.findByPaged = function(booInit) {
	 			if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
	 			var callback = function(mixResult) {
	 				mixResult = [mixResult.result.arrRegister, mixResult.result.zendPaginator.adapter.count];
	 				if (booInit !== true)
	 					AsyncMessage.addSuccess('Operação realizada com sucesso!');
	 				$scope.gripOptions.data = mixResult[0];
					$scope.gripOptions.totalItems = mixResult[1];
					var grid = $scope.gridApi.grid.element;
					if ($scope.gripOptions.data.length !== 0)
						$(grid).show();
					else
						$(grid).hide();
	 			};
	 			return $scope.service.findByPaged(callback, $scope.data, $scope.paginationOptions.field, $scope.paginationOptions.sort, $scope.paginationOptions.pageNumber, $scope.paginationOptions.pageSize);
			};
		}

		if (empty($scope.delete)) {
			$scope.delete = function(element) {
				if (empty($scope.service)) {
					AsyncMessage.addError('Serviço não definido!');
					return false;
				}
				if (!$window.confirm('Realmente deseja realizar a remoção?'))
					return false;
				var callback = function() {
					$scope.findByPaged();
				};
				return $scope.service.delete(callback, element);
			};
		}

		angular.extend($scope, $controller('AbstractFormController', {$scope: $scope}));

		$scope.init = function() {
			$scope.clearData();
			setTimeout(function() {
				$('.ui-grid-pager-panel .ng-pristine:not([name])').attr('name', 'paginationInfo[]');
			}, 100);
		};
		$scope.init();

	}]);