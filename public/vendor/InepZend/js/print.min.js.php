<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/javascript");
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
var strGlobalMessage='';function printMessage(strMessage){if(empty(strMessage))return false;var strIdIframe='iframeToPrintMessage';strGlobalMessage=strMessage;var iframeToPrint=document.getElementById(strIdIframe);if(empty(iframeToPrint)){var strHtmlIframe="<IFRAME frameborder='0' id='"+strIdIframe+"' name='"+strIdIframe+"' style='width:0px; height:0px; border:0px; float:left;'></IFRAME>";document.body.innerHTML=strHtmlIframe+document.body.innerHTML;iframeToPrint=document.getElementById(strIdIframe);setTimeout(printMessage(strGlobalMessage),100);return false}eval('parent.'+strIdIframe+'.document.body.innerHTML = "";');if(document.all){eval('parent.'+strIdIframe+'.document.body.innerHTML = strGlobalMessage;');setTimeout("frames['"+strIdIframe+"'].focus(); frames['"+strIdIframe+"'].print();",500)}else{parent.document.getElementById(strIdIframe).contentDocument.body.innerHTML=strGlobalMessage;setTimeout("frames['"+strIdIframe+"'].print();",500)}return true}