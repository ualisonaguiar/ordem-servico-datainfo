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
@media print {
	* {
		color: #000 !important;
		text-shadow: none !important;
		background: 0 0 !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important
	}
	
	a, a:visited {
		text-decoration: underline !important
	}
	
	a[href]:after {
		content: "(" attr(href) ")" !important
	}
	
	abbr[title]:after {
		content: "(" attr(title) ")" !important
	}
	
	a[href^="javascript:"]:after, a[href^="#"]:after {
		content: "" !important
	}
	
	blockquote, pre {
		border: 1px solid #999 !important;
		page-break-inside: avoid !important
	}
	
	thead {
		display: table-header-group !important
	}
	
	img, tr {
		page-break-inside: avoid !important
	}
	
	img {
		max-width: 100% !important
	}
	
	h2, h3, p {
		orphans: 3 !important;
		widows: 3 !important
	}
	
	h2, h3 {
		page-break-after: avoid !important
	}
	
	select {
		background: #fff !important
	}
	
	.navbar {
		display: none !important
	}
	
	.table td, .table th {
		background-color: #fff !important
	}
	
	.btn>.caret, .dropup>.btn>.caret {
		border-top-color: #000 !important
	}
	
	.label {
		border: 1px solid #000 !important
	}
	
	.table {
		border-collapse: collapse !important
	}
	
	.table-bordered td, .table-bordered th {
		border: 1px solid #ddd !important
	}
	
	.visible-print {
		display: block !important
	}
	
	table.visible-print {
		display: table !important
	}
	
	tr.visible-print {
		display: table-row !important
	}
	
	td.visible-print, th.visible-print {
		display: table-cell !important
	}
	
	.visible-print-block {
		display: block !important
	}
	
	.visible-print-inline {
		display: inline !important
	}
	
	.visible-print-inline-block {
		display: inline-block !important
	}
	
	.hidden-print {
		display: none !important
	}
}