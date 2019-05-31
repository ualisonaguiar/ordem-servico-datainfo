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
tinymce.PluginManager.add("nonbreaking",function(e){var t=e.getParam("nonbreaking_force_tab");if(e.addCommand("mceNonBreaking",function(){e.insertContent(e.plugins.visualchars&&e.plugins.visualchars.state?'<span data-mce-bogus="1" class="mce-nbsp">&nbsp;</span>':"&nbsp;")}),e.addButton("nonbreaking",{title:"Insert nonbreaking space",cmd:"mceNonBreaking"}),e.addMenuItem("nonbreaking",{text:"Nonbreaking space",cmd:"mceNonBreaking",context:"insert"}),t){var n=+t>1?+t:3;e.on("keydown",function(t){if(9==t.keyCode){if(t.shiftKey)return;t.preventDefault();for(var i=0;n>i;i++)e.execCommand("mceNonBreaking")}})}});