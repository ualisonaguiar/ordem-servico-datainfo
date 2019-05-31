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
	body {
	    font-size: 14px !important
	}
	
	.header-banner {
	    margin-top: 5px !important
	}
	
	.container-fluid div#navbar-collapse {
	    margin-top: -20px !important
	}
	
	.hide-print {
	    display: none !important
	}
	
	.show-print {
	    display: block !important
	}
	
	.ul-print,
	.ul-print li {
	    list-style-type: none !important
	}
	
	.navbar-right {
	    float: right !important
	}
	
	.navbar-right li {
	    float: left !important;
	    padding-left: 10px !important
	}
	
	.navbar-right a.dropdown-toggle {
	    margin-top: 15px !important;
	    float: right !important
	}
	
	ul.list-inline {
	    float: left !important;
	    padding-left: 0px !important;
	    margin: 0px !important
	}
	
	.text-center,
	.text-nowrap,
	ul li,
	.controlFontSize {
	    font-family: Verdana,Arial,Sans !important;
	    font-size: 12px !important;
	    font-weight: normal !important
	}
	
	#contentContainer {
	    padding-top: 0px !important
	}
	
	h1, h2, h3 {
	    margin-top: 0px !important;
	    font-size: 25px !important
	}
	
	.divMultiCheckRadio input {
	    float: none !important
	}
	
	.cDrag {
	    display: none !important
	}
	
	.bDiv {
	    height: auto !important
	}
	
	.block {
	    display: block !important
	}
	
	.mce-container {
	    visibility: visible !important
	}
	
	.mce-container-body iframe {
	    border: 1px solid #000 !important;
	    width: 99% !important;
	    min-height: 300px !important
	}
	
	.mce-container .mce-toolbar,
	.mce-container .mce-statusbar{
	    display: none !important
	}
	
	textarea {
	    width: 99% !important;
	    min-height: 300px !important
	}
}