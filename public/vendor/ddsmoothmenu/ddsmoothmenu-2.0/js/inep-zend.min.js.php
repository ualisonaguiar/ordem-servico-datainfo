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
function showMenuInepZend(){var arrElement=new Array('inepZendMenu','inepZendBreadcrumbs','inepZendMenuContainer');for(var intCount=0;intCount<arrElement.length;++intCount){var strId=arrElement[intCount];var element=getObject(strId);if(!empty(element)){if(strId=='inepZendMenuContainer'){if(document.all)setTimeout('document.getElementById("'+strId+'").style.cssText = "";',10);else element.style.cssText=''}else{if(document.all)setTimeout('document.getElementById("'+strId+'").style.display = "";',10);else element.style.display=''}}}}var booGlobalInitMenuInepZend=false;function initMenuInepZend(strOrientation){if((!isObject(ddsmoothmenu))||(booGlobalInitMenuInepZend))return;var strClass=(strOrientation=='v')?'-'+strOrientation:'';ddsmoothmenu.init({mainmenuid:'inepZendMenu',orientation:strOrientation,classname:strClass,contentsource:'markup',arrowswap:true});booGlobalInitMenuInepZend=true}