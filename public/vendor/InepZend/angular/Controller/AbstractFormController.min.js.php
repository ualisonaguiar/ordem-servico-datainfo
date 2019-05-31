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
angular.module('AbstractFormController',['AbstractCoreController']).controller('AbstractFormController',['$scope','$controller','AsyncMessage','$location',function($scope,$controller,AsyncMessage,$location){if(empty($scope.find)){$scope.find=function(mixPk){if(empty($scope.service)){AsyncMessage.addError('Serviço não definido!');return false}var callback=function(mixResult){mixResult=mixResult.result;for(var strAttribute in mixResult){if(mixResult[strAttribute])mixResult[strAttribute]=mixResult[strAttribute].toString()}$scope.data=mixResult;var form=document.getElementById($scope.strIdController);var arrTextarea=$('textarea',form).get();for(var intCount in arrTextarea){var strTextarea=arrTextarea[intCount].getAttribute('id');var arrResult=getLengthCounterHtml($scope.data[strTextarea],$('#'+strTextarea).attr('maxlength'));$('.counterCharacters_'+strTextarea+' span.countMin').html(arrResult[0])}};return $scope.service.find(callback,mixPk)}}if(empty($scope.save)){$scope.save=function(){if(empty($scope.service)){AsyncMessage.addError('Serviço não definido!');return false}var form=document.getElementById($scope.strIdController);if(!$('form',form).valid())return false;var callback=function(){AsyncMessage.addSuccess('Operação realizada com sucesso!');var strUrl=$location.absUrl();var arrUrl=explode('/edit/',strUrl);if(arrUrl.length<=1){arrUrl=explode('/add',strUrl);if(arrUrl.length<=1)return}$scope.locationHref(arrUrl[0])};return $scope.service.save(callback,$scope.data)}}angular.extend($scope,$controller('AbstractCoreController',{$scope:$scope}));if(!isBoolean($scope.initFind))$scope.initFind=true;$scope.init=function(){if(empty($scope.service)){AsyncMessage.addError('Serviço não definido!');return false}if(empty($scope.data))$scope.data=$scope.getDataEmptyFromForm();if($scope.initFind===false)return true;var strUrl=$location.absUrl();var arrUrl=explode('/edit/',strUrl);if(arrUrl.length<=1)return true;var strParam=arrUrl[1].substr(5);var arrParam=explode('/',strParam);return $scope.find(arrParam[0])};$scope.init()}]);