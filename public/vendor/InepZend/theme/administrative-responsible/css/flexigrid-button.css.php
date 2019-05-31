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
@media screen {
	.flexigrid .tDiv2 .add,
	.flexigrid .tDiv2 .show,
	.flexigrid .tDiv2 .update,
	.flexigrid .tDiv2 .delete,
	.flexigrid .pFirst,
	.flexigrid .pPrev,
	.flexigrid .pNext,
	.flexigrid .pLast,
	.flexigrid .pReload,
	.flexigrid .flexigridColButtonAction .add,
	.flexigrid .flexigridColButtonAction .show,
	.flexigrid .flexigridColButtonAction .update,
	.flexigrid .flexigridColButtonAction .delete {
	    background-image: none !important;
	}
	
	.flexigrid .fbutton button {
	    padding-left: 10px !important;
	}
}