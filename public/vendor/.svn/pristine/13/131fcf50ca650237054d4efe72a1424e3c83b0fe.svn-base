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
.classForm{margin:5px
auto 0}.classForm
label{width:100px;background-color:#EEE;float:left;font-weight:bold;height:31px;line-height:31px;text-align:right;font-size:12px}.classForm input, .classForm select, .classForm
textarea{font-size:12px;overflow:hidden}.classForm input[type=checkbox]{margin-top:15px;margin-bottom:21px;*margin-bottom:15px}.classForm input[type=file]{*background-color:#FFF;*border:1px
solid #CCC;*margin-top: -1px;margin-bottom:9px}.classForm
.divRequired{width:7px;background-color:#EEE;float:left;font-weight:bold;height:31px;line-height:31px;text-align:left;font-size:12px;color:red;padding-left:2px}form select, form input, form textarea, form
input{display:inline}