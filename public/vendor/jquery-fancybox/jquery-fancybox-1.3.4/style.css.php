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
html, body, div, ul {
	margin: 0;
	padding: 0;
}

body {
    color: #262626;
	background: #f4f4f4;
	font: normal 12px/18px Verdana, sans-serif;
}

#content {
	width: 400px;
	margin: 40px auto 0 auto;
	padding: 0 60px 30px 60px;
	border: solid 1px #cbcbcb;
	background: #fafafa;
	-moz-box-shadow: 0px 0px 10px #cbcbcb;
	-webkit-box-shadow: 0px 0px 10px #cbcbcb;
}

h1 {
	margin: 30px 0 15px 0;
	font-size: 30px;
	font-weight: bold;
	font-family: Arial;
}

h1 span {
	font-size: 50%;
	letter-spacing: -0.05em;
}

hr {
	border: none;
	height: 1px; line-height: 1px;
	background: #E5E5E5;
	margin-bottom: 20px;
	padding: 0;
}

p {
	margin: 0;
	padding: 7px 0;
}

a {
	outline: none;
}

a img {
	border: 1px solid #BBB;
	padding: 2px;
	margin: 10px 20px 10px 0;
	vertical-align: top;
}

a img.last {
	margin-right: 0;	
}

ul {
	margin-bottom: 24px;
	padding-left: 30px;
}
