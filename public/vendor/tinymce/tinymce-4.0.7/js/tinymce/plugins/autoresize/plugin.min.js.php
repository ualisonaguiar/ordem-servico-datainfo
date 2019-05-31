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
tinymce.PluginManager.add("autoresize",function(e){function t(a){var r,o,c=e.getDoc(),s=c.body,u=c.documentElement,l=tinymce.DOM,m=n.autoresize_min_height;"setcontent"==a.type&&a.initial||e.plugins.fullscreen&&e.plugins.fullscreen.isFullscreen()||(o=tinymce.Env.ie?s.scrollHeight:tinymce.Env.webkit&&0===s.clientHeight?0:s.offsetHeight,o>n.autoresize_min_height&&(m=o),n.autoresize_max_height&&o>n.autoresize_max_height?(m=n.autoresize_max_height,s.style.overflowY="auto",u.style.overflowY="auto"):(s.style.overflowY="hidden",u.style.overflowY="hidden",s.scrollTop=0),m!==i&&(r=m-i,l.setStyle(l.get(e.id+"_ifr"),"height",m+"px"),i=m,tinymce.isWebKit&&0>r&&t(a)))}var n=e.settings,i=0;e.settings.inline||(n.autoresize_min_height=parseInt(e.getParam("autoresize_min_height",e.getElement().offsetHeight),10),n.autoresize_max_height=parseInt(e.getParam("autoresize_max_height",0),10),e.on("init",function(){e.dom.setStyle(e.getBody(),"paddingBottom",e.getParam("autoresize_bottom_margin",50)+"px")}),e.on("change setcontent paste keyup",t),e.getParam("autoresize_on_init",!0)&&e.on("load",t),e.addCommand("mceAutoResize",t))});