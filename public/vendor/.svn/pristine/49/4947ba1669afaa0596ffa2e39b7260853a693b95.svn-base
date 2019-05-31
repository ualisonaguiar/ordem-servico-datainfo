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
	body.contrast .bDiv {
	    background: #000 !important;
	    border-left: 1px solid #222 !important;
	    border-right: 1px solid #222 !important;
	    border-bottom: transparent !important;
	}
	
	body.contrast .flexigrid tr td.sorted {
	    background: #111 !important;
	    border-style: none;
	    border-color: #444 #444 !important;
	}
	
	body.contrast .flexigrid div.hDiv,
	body.contrast .flexigrid div.hDivBox {
	    background: #000 !important;
	    border-style: none !important;
	}
	
	body.contrast .navbar-header button,
	body.contrast .navbar-header button:hover,
	body.contrast .navbar-default .navbar-collapse,
	body.contrast .navbar-default .navbar-form {
	    border-color: #111 !important;
	    background-color: #111 !important;
	    border-color: #FFF !important;
	    border-bottom-color: #FFF !important;
	}
	
	body.contrast .flexigrid div.fbutton div button {
	    background-color: #333;
	    border: 1px solid #444 !important;
	}
	
	body.contrast .flexigrid div.fbutton div button:hover,
	body.contrast .flexigrid div.fbutton.fbOver {
	    background-color: #444;
	    text-decoration: none !important;
	}
	
	body.contrast .flexigrid div.bDiv tr:hover td,
	body.contrast .flexigrid div.bDiv tr:hover td.sorted,
	body.contrast .flexigrid div.bDiv tr.trOver td.sorted,
	body.contrast .flexigrid div.bDiv tr.trOver td {
	    color: #f0ad4e;
	    background: #333 no-repeat right top !important;
	    border-bottom: 1px solid #444 !important;
	}
	
	body.contrast .flexigrid div.bDiv tr:hover td .fa,
	body.contrast .flexigrid div.bDiv tr:hover td.sorted .fa,
	body.contrast .flexigrid div.bDiv tr.trOver td.sorted .fa,
	body.contrast .flexigrid div.bDiv tr.trOver td .fa {
	    color: #f0ad4e;
	}
	
	body.contrast .flexigrid div.bDiv tr.erow:hover {
	    border-bottom: 1px solid #444 !important;
	    color: #f0ad4e;
	    background: #333 no-repeat right top !important;
	}
	
	body.contrast .flexigrid div.hDiv th,
	body.contrast .flexigrid div.bDiv td {
	    border: 1px solid #444 !important;
	}
	
	body.contrast .hDivBox table * {
	    background-color: #333 !important;
	    color: #fff !important;
	}
	
	body.contrast .bDiv table,
	body.contrast .nDiv table,
	body.contrast .pDiv table, 
	body.contrast .vGrip {
	    background: #111;
	    color: #fff;
	    border-bottom: 1px solid #fff;
	}
	
	body.contrast .flexigrid td,
	body.contrast .flexigrid tr.erow td {
	    background: none repeat scroll 0 0 #111!important;
	    border-color: #444 !important;
	}
	
	body.contrast .flexigrid div.hDiv th div.sdesc{
	    background:url(../images/dn.png) no-repeat center top!important;
	}
	
	body.contrast .flexigrid div.hDiv th div.sasc{
	    background:url(../images/up.png) no-repeat center top!important;
	}
	
	body.contrast .flexigrid div.pDiv {
	    color: #FFF !important;
	}
	
	body.contrast .flexigrid .tDiv,
	body.contrast .flexigrid .pDiv,
	body.contrast .flexigrid div.hDivBox {
	    border-color: #222 !important;
	    border-bottom: #222;
	}
	
	body.contrast .flexigrid div.bDiv tr.trSelected:hover td,
	body.contrast .flexigrid div.bDiv tr.trSelected:hover td.sorted,
	body.contrast .flexigrid div.bDiv tr.trOver.trSelected td.sorted,
	body.contrast .flexigrid div.bDiv tr.trOver.trSelected td,
	body.contrast .flexigrid tr.trSelected td.sorted,
	body.contrast .flexigrid tr.trSelected td {
	    color: #f0ad4e;
	    background: #333 no-repeat right top !important;
	}
	
	body.contrast .gBlock {
	    background: #333 !important;
	}
	
	body.contrast .pDiv {
	    border-top: #333 !important;
	}
	
	body.contrast .flexigrid div.pDiv div.pButton:hover span,
	body.contrast .flexigrid div.pDiv div.pButton.pBtnOver span {
	    border:1px solid #333 !important;
	}
	
	body.contrast .flexigrid div.bDiv {
	    border-left: transparent !important;
	    border-right: transparent !important;    
	}
	
	body.contrast .flexigrid div.pDiv {
	    border: 1px solid #222 !important;
	}
	
	body.contrast .flexigrid {
	    border: 1px solid #222 !important;
	}
	
	body.contrast .flexigrid .pFirst,
	body.contrast .flexigrid .pPrev,
	body.contrast .flexigrid .pNext,
	body.contrast .flexigrid .pLast,
	body.contrast .flexigrid .pReload {
	    color: #FFF;
	}
}