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
tinymce.PluginManager.add("contextmenu",function(e){var n;e.on("contextmenu",function(t){var o;if(t.preventDefault(),o=e.settings.contextmenu||"link image inserttable | cell row column deletetable",n)n.show();else{var i=[];tinymce.each(o.split(/[ ,]/),function(n){var t=e.menuItems[n];"|"==n&&(t={text:n}),t&&(t.shortcut="",i.push(t))});for(var c=0;c<i.length;c++)"|"==i[c].text&&(0===c||c==i.length-1)&&i.splice(c,1);n=new tinymce.ui.Menu({items:i,context:"contextmenu"}),n.renderTo(document.body),e.on("remove",function(){n.remove(),n=null})}var l={x:t.pageX,y:t.pageY};e.inline||(l=tinymce.DOM.getPos(e.getContentAreaContainer()),l.x+=t.clientX,l.y+=t.clientY),n.moveTo(l.x,l.y)})});