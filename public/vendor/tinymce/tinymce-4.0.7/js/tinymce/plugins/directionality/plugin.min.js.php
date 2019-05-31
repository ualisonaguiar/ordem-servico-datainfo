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
tinymce.PluginManager.add("directionality",function(e){function t(t){var n,i=e.dom,a=e.selection.getSelectedBlocks();a.length&&(n=i.getAttrib(a[0],"dir"),tinymce.each(a,function(e){i.getParent(e.parentNode,"*[dir='"+t+"']",i.getRoot())||(n!=t?i.setAttrib(e,"dir",t):i.setAttrib(e,"dir",null))}),e.nodeChanged())}function n(e){var t=[];return tinymce.each("h1 h2 h3 h4 h5 h6 div p".split(" "),function(n){t.push(n+"[dir="+e+"]")}),t.join(",")}e.addCommand("mceDirectionLTR",function(){t("ltr")}),e.addCommand("mceDirectionRTL",function(){t("rtl")}),e.addButton("ltr",{title:"Left to right",cmd:"mceDirectionLTR",stateSelector:n("ltr")}),e.addButton("rtl",{title:"Right to left",cmd:"mceDirectionRTL",stateSelector:n("rtl")})});