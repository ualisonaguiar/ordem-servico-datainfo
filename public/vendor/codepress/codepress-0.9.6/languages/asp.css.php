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
 * CodePress color styles for ASP-VB syntax highlighting
 * By Martin D. Kirk
 */
/* tags */

b {
	color:#000080;
} 
/* comments */
big, big b, big em, big ins, big s, strong i, strong i b, strong i s, strong i u, strong i a, strong i a u, strong i s u {
	color:gray;
	font-weight:normal;
}
/* ASP comments */
strong dfn, strong dfn a,strong dfn var, strong dfn a u, strong dfn u{
	color:gray;
	font-weight:normal;
}
 /* attributes */ 
s, s b, span s u, span s cite, strong span s {
	color:#5656fa ;
	font-weight:normal;
}
 /* strings */ 
strong s,strong s b, strong s u, strong s cite {
	color:#009900;
	font-weight:normal;
}
strong ins{
	color:#000000;
	font-weight:bold;
}
 /* Syntax */
strong a, strong a u {
	color:#0000FF;
	font-weight:;
}
 /* Native Keywords */
strong u {
	color:#990099;
	font-weight:bold;
}
/* Numbers */
strong var{
	color:#FF0000;
}
/* ASP Language */
span{
	color:#990000;
	font-weight:bold;
}
strong i,strong a i, strong u i {
	color:#009999;
}
/* style */
em {
	color:#800080;
	font-style:normal;
}
 /* script */ 
ins {
	color:#800000;
	font-weight:bold;
}

/* <?php and ?> */
cite, s cite {
	color:red;
	font-weight:bold;
}