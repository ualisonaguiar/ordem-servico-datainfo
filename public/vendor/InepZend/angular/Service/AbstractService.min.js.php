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
var AbstractService=Class.extend(function(){var self=this;self.booDebug=false;self.strService=undefined;self.strForm=undefined;self.RestClient=undefined;self.AsyncMessage=undefined;self.scope=undefined;self.constructor=function(RestClient,AsyncMessage,scope){self.RestClient=RestClient;self.AsyncMessage=AsyncMessage;self.scope=scope};self.find=function(callback,mixPk){return self.RestClient.runService(self.strService,'findAction',[mixPk],'WS_RSRC_SERVICE_FIND',callback)};self.findBy=function(callback,arrCriteria,arrOrderBy){if(!empty(arrCriteria))arrCriteria=clearEmptyParam(arrCriteria);var arrParam=[arrCriteria];if(!empty(arrOrderBy))arrParam[arrParam.length]=arrOrderBy;return self.RestClient.runService(self.strService,'findByAction',arrParam,'WS_RSRC_SERVICE_FIND',callback)};self.findByPaged=function(callback,arrCriteria,strSortName,strSortOrder,intPage,intItemPerPage){if(!empty(arrCriteria))arrCriteria=clearEmptyParam(arrCriteria);return self.RestClient.runService(self.strService,'findByPagedAction',[arrCriteria,strSortName,strSortOrder,intPage,intItemPerPage],'WS_RSRC_SERVICE_FIND',callback,undefined,true)};self.fetchPairs=function(callback,arrCriteria,arrOrderBy){if(!empty(arrCriteria))arrCriteria=clearEmptyParam(arrCriteria);var arrParam=[arrCriteria];if(!empty(arrOrderBy))arrParam[arrParam.length]=arrOrderBy;return self.RestClient.runService(self.strService,'fetchPairsAction',arrParam,'WS_RSRC_SERVICE_FIND',callback)};self.save=function(callback,arrData){return self.RestClient.runService(self.strService,'saveAction',[arrData,undefined,self.strForm],'WS_RSRC_SERVICE_SAVE',callback)};self.delete=function(callback,arrData){return self.RestClient.runService(self.strService,'deleteAction',[arrData],'WS_RSRC_SERVICE_DELETE',callback)};self.getIdentity=function(callback){return self.RestClient.runService('InepZend\\Module\\Application\\Service\\Application','getIdentity',undefined,'WS_RSRC_SERVICE_IDENTITY',callback)};self.addScope=function(scope){self.scope=scope;return this}});