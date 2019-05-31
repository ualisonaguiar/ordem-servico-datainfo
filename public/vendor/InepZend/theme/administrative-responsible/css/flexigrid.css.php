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
/* #94d7e4 Cor de fundo dos butoes, tag th e hover das tr */
/* #0e377d Cor das letras das tag de th e dos butoes */

@media screen {
	.flexigrid {
	    font-family: "Open Sans",Helvetica,Arial,sans-serif;
	    font-size: 13px !important;
	    margin-top: 10px;
	}
	
	.flexigrid div.tDiv {
	    background: none !important;
	    padding-right: 0px !important;
	    margin-right: 0px !important;
	    border-radius: 3px;
	    border-width: 0px !important;
	}
	
	.flexigrid div.tDiv2 {
	    float: right !important;
	    padding-right: 0px !important;
	    margin-right: 0px !important;
	}
	
	.flexigrid div.fbutton {
	    margin: 0px !important;
	    padding: 0px !important;
	}
	
	.flexigrid div.fbutton div {
	    margin: 0px !important;
	    padding: 0px !important;
	}
	
	.flexigrid div.fbutton div button {
	    margin: 10px 10px 10px 0px !important;
	    font-weight: bold;
	    font-family: "Open Sans",Helvetica;
	}
	
	.flexigrid div.tDiv:hover {
	    text-decoration: none !important;
	}
	
	.flexigrid div.tDiv2:hover {
	    text-decoration: none !important;
	}
	
	.flexigrid div.fbutton:hover {
	    border: 0px !important;
	    text-decoration: none !important;
	}
	
	.flexigrid div.fbutton div:hover {
	    border: 0px !important;
	    text-decoration: none !important;
	}
	
	.flexigrid div.fbutton div button:hover,
	.flexigrid div.fbutton.fbOver {
	    text-decoration: none !important;
	}
	
	.tDiv2 div.btnseparator {
	    border-left: 0px !important;
	    border-right: 0px !important;
	}
	
	.hDivBox th,
	.hDivBox th.sorted {
	    font-weight: bold !important;
	}
	
	.flexigrid div.pDiv div.pButton:hover,
	.flexigrid div.pDiv div.pButton.pBtnOver {
	    width: 22px!important;
	    height: 22px!important;
	    border: 0px !important;
	}
	
	.flexigrid tr td,
	.flexigrid tr td.sorted {
	    background: none repeat scroll 0 0 #fff !important;
	}
	
	.flexigrid div.bDiv tr:hover td,
	.flexigrid div.bDiv tr:hover td.sorted,
	.flexigrid div.bDiv tr.trOver td.sorted,
	.flexigrid div.bDiv tr.trOver td {
	    cursor: pointer;
	}
	
	.flexigrid tr td,
	.flexigrid tr.erow td {
	    border-bottom: 0px solid black;
	}
	
	.flexigrid div.hDiv th, 
	.flexigrid div.bDiv td {
	    border-bottom: 1px solid #ddd !important;
	    border-right: 1px solid #ddd !important;
	}
	
	.flexigrid div.hDiv,
	.flexigrid div.hDivBox {
	    border-style: none !important;
	}
	
	.flexigrid div.hDiv {
	    border-top: 0px !important;
	}
	
	.flexigrid div.pDiv {
	    background: none !important;
	    background-color: rgba(0, 0, 0, 0.1) !important;
	}
	
	.flexigrid div.hDiv th.thMove div {
	    color:#0e377d !important;
	}
	
	div.colCopy div {
	    font-size: 13px;
	    font-weight: bold;
	    height: 23px;
	}
	
	.flexigrid div.nBtn {
	    margin-top: 1px !important;
	}
	
	.flexigrid div.bDiv {
	    border-width: 0px !important;
	}
	
	.flexigrid div.vGrip {
	    border-width: 0px !important;
	}
	
	.flexigrid div.bDiv table {
	    border-right: 1px solid #ccc !important;
	}
	
	.flexigrid div.hDiv th,
	.flexigrid div.bDiv td {
	    border-left: 1px solid #ddd !important;
	}
	
	.flexigrid .flexigridColButtonAction .fa {
	    margin-top: 3px;
	    height: 17px !important;
	}
}