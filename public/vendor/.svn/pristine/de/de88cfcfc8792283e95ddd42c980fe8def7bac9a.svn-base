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
function RestClient(http, location, q, AsyncMessage) {
	
	var self = this;
	self.booDebug = false;
	self.scope = undefined;
	self.http = http;
	self.location = location;
	self.q = q;
	self.AsyncMessage = AsyncMessage;
	
	self.init = function(scope) {
		if (!empty(self.scope))
			return this;
		self.scope = scope;
		if ((!empty(self.scope)) && (!empty(self.q))) {
			self.scope.q = self.q;
			self.scope.canceller = self.q.defer();
		}
		return this;
	};
	
	self.runService = function(strClass, strService, arrParam, strResource, callback, strMethod, booPromise) {
		var successCallback = function(response) {
			if (self.booDebug)
				console.log(response);
			if (!isObject(response)) {
				self.AsyncMessage.addError('Ocorreu algum ERRO durante a operação!');
				return;
			}
			var mixData = response.data;
			if ((isObject(mixData)) && (mixData.status.toLowerCase() == 'ok')) {
				if (!empty(callback))
					callback(mixData, arrParam);
			} else {
				var strError = (!isArray(mixData.result)) ? mixData.result.message : mixData.result[1].messages[0];
				self.AsyncMessage.addError(strError);
			}
		};
		return self.runServiceRest(strClass, strService, arrParam, strResource, undefined, undefined, undefined, undefined, successCallback, strMethod, booPromise);
	};
	
	self.runServiceRest = function(strClass, strService, arrParam, strResource, strUserSsi, strPassSsi, strUserPhpAuth, strPassPhpAuth, successCallback, strMethod, booPromise) {
		if ((empty(self.http)) || (empty(self.location)) || (empty(strClass)) || (empty(strService))) {
			if (self.booDebug)
				console.log('Parâmetros obrigatórios não informados.');
			return false;
		}
	    if (empty(strUserPhpAuth))
	        strUserPhpAuth = 'InepAuthUser';
	    if (empty(strPassPhpAuth))
	        strPassPhpAuth = 'InepAuthPass';
	    var strUser = strUserPhpAuth + ((empty(strUserSsi)) ? '' : '-' + strUserSsi);
	    var strPass = strPassPhpAuth + ((empty(strPassSsi)) ? '' : '-' + strPassSsi);
	    var strHost = '';
	    if (!empty(self.location))
	    	strHost = replaceAll(self.location.protocol() + '://' + self.location.host() + ':' + self.location.port() + '/', ':80/', '/');
	    var strUrl = strHost.substr(0, strHost.length - 1) + ((strGlobalBasePath !== '') ? strGlobalBasePath : '') + '/rest';
	    if (empty(strMethod))
	    	strMethod = 'POST';
	    strMethod = strMethod.toLowerCase();
	    if (isObject(arrParam))
	    	for (var mixKey in arrParam)
		    	if ((isObject(arrParam[mixKey])) && ($.isEmptyObject(arrParam[mixKey])))
		    		arrParam[mixKey] = undefined;
	    var parameters = $.param({
			'url': strUrl,
			'class': strClass,
			'service': strService,
			'params': arrParam,
			'secret_key': base64Encode('7421D190B6718F404DFCC30B25C112999BC5AC50CA9B29213C474C71E97D14F8' + base64Encode('' + new Date().getTime())),
			'resource': strResource
	    });
	    if (self.booDebug) {
	    	console.log(strMethod);
	    	console.log(strUser + ':' + strPass);
	        console.log(parameters);
	    }
		var mixParams = parameters;
		var mixData;
		var header = {
				'Authorization': 'Basic ' + base64Encode(strUser + ':' + strPass)
			};
		if (strMethod == 'post') {
			mixParams = undefined;
			mixData = parameters;
			header = {
					'Content-Type': 'application/x-www-form-urlencoded',
					'Authorization': 'Basic ' + base64Encode(strUser + ':' + strPass)
				};
		}
		if (self.booDebug)
    		console.log(header);
		var errorCallback = function(response) {
			if (self.booDebug) {
				console.log('Ocorreu algum ERRO durante a operação!');
				console.log(response);
			}
            if (isObject(response)) {
                var mixData = response.data;
                if ((isObject(mixData)) && (isObject(mixData.result)) && (isObject(mixData.result.exception))) {
                    self.AsyncMessage.addError(mixData.result.exception.message);                        
                    return false;
                }
            }
            self.AsyncMessage.addError('Ocorreu algum ERRO durante a operação!');
            return false;
		};
		var parametersHttp = {
			'method': strMethod.toUpperCase(),
			'url': strUrl,
			'data': mixData,
			'params': mixParams,
			'headers': header
		};
		if ((booPromise) && (!empty(self.scope)) && (!empty(self.scope.canceller))) {
			self.scope.canceller.resolve();
			self.scope.canceller = self.scope.q.defer();
			parametersHttp.timeout = self.scope.canceller.promise;
		}
		var mixResult = self.http(parametersHttp).then(successCallback, errorCallback);
	    if (self.booDebug)
	    	console.log(mixResult);
	    return mixResult;
	};
	
}