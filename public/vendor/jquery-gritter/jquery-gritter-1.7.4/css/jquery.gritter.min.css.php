<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/css");
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
#gritter-notice-wrapper{position:fixed;top:20px;right:20px;width:301px;z-index:9999}#gritter-notice-wrapper.top-left{left:20px;right:auto}#gritter-notice-wrapper.bottom-right{top:auto;left:auto;bottom:20px;right:20px}#gritter-notice-wrapper.bottom-left{top:auto;right:auto;bottom:20px;left:20px}.gritter-item-wrapper{position:relative;margin:0 0 10px;background:url(../images/ie-spacer.gif)}.gritter-top{background:url(../images/gritter.png) left -30px no-repeat;height:10px}.hover .gritter-top{background-position:right -30px}.gritter-bottom{background:url(../images/gritter.png) left bottom no-repeat;height:8px;margin:0}.hover .gritter-bottom{background-position:bottom right}.gritter-item{display:block;background:url(../images/gritter.png) left -40px no-repeat;color:#eee;padding:2px 11px 8px;font-size:11px;font-family:verdana}.hover .gritter-item{background-position:right -40px}.gritter-item p{padding:0;margin:0;word-wrap:break-word}.gritter-close{display:none;position:absolute;top:5px;left:3px;background:url(../images/gritter.png) left top no-repeat;cursor:pointer;width:30px;height:30px;text-indent:-9999em}.gritter-title{font-size:14px;font-weight:700;padding:0 0 7px;display:block;text-shadow:1px 1px 0 #000}.gritter-image{width:48px;height:48px;float:left}.gritter-with-image,.gritter-without-image{padding:0}.gritter-with-image{width:220px;float:right}.gritter-light .gritter-bottom,.gritter-light .gritter-close,.gritter-light .gritter-item,.gritter-light .gritter-top{background-image:url(../images/gritter-light.png);color:#222}.gritter-light .gritter-title{text-shadow:none}