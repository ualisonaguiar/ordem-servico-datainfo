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
body {
	margin-top:13px;
	_margin-top:14px;
	background:white;
	margin-left:32px;
	font-family:monospace;
	font-size:13px;
	white-space:pre;
	background-image:url("images/line-numbers.png");
	background-repeat:repeat-y;
	background-position:0 3px;
	line-height:16px;
	height:100%;
}
pre {margin:0;}
html>body{background-position:0 2px;}
P {margin:0;padding:0;border:0;outline:0;display:block;white-space:pre;}
b, i, s, u, a, em, tt, ins, big, cite, strong, var, dfn {text-decoration:none;font-weight:normal;font-style:normal;font-size:13px;}

body.hide-line-numbers {background:white;margin-left:16px;}
body.show-line-numbers {background-image:url("images/line-numbers.png");margin-left:32px;}