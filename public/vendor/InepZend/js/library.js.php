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
include_once('/vendor/InepZend/js/array.js');
include_once('/vendor/InepZend/js/client.js');
include_once('/vendor/InepZend/js/event.js');
include_once('/vendor/InepZend/js/cookie.js');
include_once('/vendor/InepZend/js/date.js');
include_once('/vendor/InepZend/js/dom.js');
include_once('/vendor/InepZend/js/format.js');
include_once('/vendor/InepZend/js/json.js');
include_once('/vendor/InepZend/js/native.js');
include_once('/vendor/InepZend/js/popup.js');
include_once('/vendor/InepZend/js/print.js');
include_once('/vendor/InepZend/js/string.js');
include_once('/vendor/InepZend/js/validate.js');
include_once('/vendor/InepZend/js/xml.js');