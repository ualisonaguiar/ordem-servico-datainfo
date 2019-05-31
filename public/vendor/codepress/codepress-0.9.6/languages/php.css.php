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
 * CodePress color styles for PHP syntax highlighting
 */

b {color:#000080;} /* tags */
big, big b, big em, big ins, big s, strong i, strong i b, strong i s, strong i u, strong i a, strong i a u, strong i s u {color:gray;font-weight:normal;} /* comments */
s, s b, strong s u, strong s cite {color:#5656fa;font-weight:normal;} /* attributes and strings */
strong a, strong a u {color:#006700;font-weight:bold;} /* variables */
em {color:#800080;font-style:normal;} /* style */
ins {color:#800000;} /* script */
strong u {color:#7F0055;font-weight:bold;} /* reserved words */
cite, s cite {color:red;font-weight:bold;} /* <?php and ?> */
