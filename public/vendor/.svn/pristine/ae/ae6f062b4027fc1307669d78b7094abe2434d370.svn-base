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
/*
 * CodePress color styles for SQL syntax highlighting
 * By Merlin Moncure
 */
 
b {color:#0000FF;font-style:normal;font-weight:bold;} /* reserved words */
u {color:#FF0000;font-style:normal;} /* types */
a {color:#CD6600;font-style:normal;font-weight:bold;} /* commands */
i, i b, i u, i a, i s  {color:#A9A9A9;font-weight:normal;font-style:italic;} /* comments */
s, s b, s u, s a, s i {color:#2A00FF;font-weight:normal;} /* strings */
