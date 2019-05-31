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
/**
 * CodePress color styles for AutoIt syntax highlighting
 */

u {font-style:normal;color:#000090;font-weight:bold;font-family:Monospace;}
var {color:#AA0000;font-weight:bold;font-style:normal;}
em {color:#FF33FF;}
ins {color:#AC00A9;}
i {color:#F000FF;}
b {color:#FF0000;}
a {color:#0080FF;font-weight:bold;}
s, s u, s b {color:#9999CC;font-weight:normal;}
cite, cite *{color:#009933;font-weight:normal;}