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
.ddsmoothmenu-v
ul{margin:0;padding:0;width:160px;list-style-type:none}.ddsmoothmenu-v ul
li{position:relative;float:none;display:block}.ddsmoothmenu-v ul li
a{display:block;overflow:auto;color:white;text-decoration:none;border-bottom:1px solid #c4c0b9;border-right:1px solid #c4c0b9;height:22px;padding-top:2px;padding-left:10px}.ddsmoothmenu-v ul li a:link, .ddsmoothmenu-v ul li a:visited, .ddsmoothmenu-v ul li a:active{background-color:#e2e2e2;background-image:linear-gradient(to bottom, #e2e2e2, #cccccc);background-repeat:repeat-x;color:#000}.ddsmoothmenu-v ul li
a.selected{background-color:#999;background-image:linear-gradient(to bottom, #e2e2e2, #999999);background-repeat:repeat-x}.ddsmoothmenu-v ul li a:hover{background-color:#999;background-image:linear-gradient(to bottom, #e2e2e2, #999999);background-repeat:repeat-x}.ddsmoothmenu-v ul li
ul{position:absolute;width:170px;top:0;font-weight:normal;visibility:hidden}.menuVerticalSize{width:160px;float:left}* html .ddsmoothmenu-v ul
li{float:left;height:1%}* html .ddsmoothmenu-v ul li
a{height:1%}