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
angular.module('AbstractCoreController', ['angular-loading-bar'])
	.service('AsyncMessage', AsyncMessage)
	.service('WindowUtil', ['$http', '$location', '$q', '$window', '$compile', WindowUtil])
	.service('RestClient', ['$http', '$location', '$q', 'AsyncMessage', RestClient])
	.controller('AbstractCoreController', ['$scope', '$location', 'WindowUtil', function($scope, $location, WindowUtil) {
		
		$scope.getBaseUrl = function() {
			var strHost = replaceAll($location.protocol() + '://' + $location.host() + ':' + $location.port() + '/', ':80/', '/');
		    return strHost.substr(0, strHost.length - 1) + ((strGlobalBasePath !== '') ? strGlobalBasePath : '') + '/';
		};

		$scope.locationHref = function(strUrl) {
			if (strUrl === null)
				return;
			return WindowUtil.init($scope).locationHref(strUrl);
		};

		$scope.getDataEmptyFromForm = function() {
			var dataEmpty = {};
 			var arrElement = $('*[data-ng-model]', document.getElementById($scope.strIdController)).get();
			for (var intCount in arrElement) {
				var strElement = replaceAll(arrElement[intCount].getAttribute('id'), '-', '');
                var intPos = strElement.indexOf('[');
                if (intPos != -1) {
                	var strElementParent = strElement.substr(0, intPos);
                	if (empty(dataEmpty[strElementParent])) 
                		dataEmpty[strElementParent] = {};
                	if (strElement.indexOf('captcha') != -1) {
                		if (strElement.indexOf('[id]') != -1)
                			dataEmpty[strElementParent].id = arrElement[intCount].value;
                		else
                			dataEmpty[strElementParent].input = '';
                	}
                } else {
                	if (arrElement[intCount].type == 'checkbox')
                		arrElement[intCount].checked = false;
                	else
                		dataEmpty[strElement] = arrElement[intCount].value;
                }
			}
			return dataEmpty;
		};
		
		$scope.getDateCurrent = function () {
            var dateCurrent = new Date(),
                strDateNow = dateCurrent.toLocaleString(),
                arrDateNow = strDateNow.split(' ');
            return arrDateNow[0];
        };

	}])
	.config(function ($locationProvider, $compileProvider) {
		$locationProvider.html5Mode({
			'enabled': (!document.all),
			'requireBase': false
		}).hashPrefix('#');
		$compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|file|javascript):/);
	});