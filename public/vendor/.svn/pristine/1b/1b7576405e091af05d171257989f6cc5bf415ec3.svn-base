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
 * CodePress color styles for HTML syntax highlighting
 * By RJ Bruneel
 */
 
b {color:#000080;} /* tags */
ins, ins b, ins s, ins em {color:gray;} /* comments */
s, s b {color:#7777e4;} /* attribute values */
a {color:#E67300;} /* links */
u {color:#CC66CC;} /* forms */
big {color:#db0000;} /* images */
em, em b {color:#800080;} /* style */
strong {color:#800000;} /* script */
tt i {color:darkblue;font-weight:bold;} /* script reserved words */
xsl {color:green;} /* xsl */
