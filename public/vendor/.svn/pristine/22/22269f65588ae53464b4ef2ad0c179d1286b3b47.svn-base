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
tinymce.PluginManager.add("fullscreen",function(e){function t(){var e,t,n=window,i=document,a=i.body;return a.offsetWidth&&(e=a.offsetWidth,t=a.offsetHeight),n.innerWidth&&n.innerHeight&&(e=n.innerWidth,t=n.innerHeight),{w:e,h:t}}function n(){function n(){l.setStyle(c,"height",t().h-(s.clientHeight-c.clientHeight))}var s,c,u,d=document.body,m=document.documentElement;o=!o,s=e.getContainer().firstChild,c=e.getContentAreaContainer().firstChild,u=c.style,o?(i=u.width,a=u.height,u.width=u.height="100%",l.addClass(d,"mce-fullscreen"),l.addClass(m,"mce-fullscreen"),l.addClass(s,"mce-fullscreen"),l.bind(window,"resize",n),n(),r=n):(u.width=i,u.height=a,l.removeClass(d,"mce-fullscreen"),l.removeClass(m,"mce-fullscreen"),l.removeClass(s,"mce-fullscreen"),l.unbind(window,"resize",r)),e.fire("FullscreenStateChanged",{state:o})}var i,a,r,o=!1,l=tinymce.DOM;if(!e.settings.inline)return e.on("init",function(){e.addShortcut("Ctrl+Alt+F","",n)}),e.on("remove",function(){r&&l.unbind(window,"resize",r)}),e.addCommand("mceFullScreen",n),e.addMenuItem("fullscreen",{text:"Fullscreen",shortcut:"Ctrl+Alt+F",selectable:!0,onClick:n,onPostRender:function(){var t=this;e.on("FullscreenStateChanged",function(e){t.active(e.state)})},context:"view"}),e.addButton("fullscreen",{tooltip:"Fullscreen",shortcut:"Ctrl+Alt+F",onClick:n,onPostRender:function(){var t=this;e.on("FullscreenStateChanged",function(e){t.active(e.state)})}}),{isFullscreen:function(){return o}}});