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
tinymce.PluginManager.add("visualblocks",function(e,t){function n(){var t=this;t.active(r),e.on("VisualBlocks",function(){t.active(e.dom.hasClass(e.getBody(),"mce-visualblocks"))})}var i,a,r;window.NodeList&&(e.addCommand("mceVisualBlocks",function(){var n,o=e.dom;i||(i=o.uniqueId(),n=o.create("link",{id:i,rel:"stylesheet",href:t+"/css/visualblocks.css"}),e.getDoc().getElementsByTagName("head")[0].appendChild(n)),e.on("PreviewFormats AfterPreviewFormats",function(t){r&&o.toggleClass(e.getBody(),"mce-visualblocks","afterpreviewformats"==t.type)}),o.toggleClass(e.getBody(),"mce-visualblocks"),r=e.dom.hasClass(e.getBody(),"mce-visualblocks"),a&&a.active(o.hasClass(e.getBody(),"mce-visualblocks")),e.fire("VisualBlocks")}),e.addButton("visualblocks",{title:"Show blocks",cmd:"mceVisualBlocks",onPostRender:n}),e.addMenuItem("visualblocks",{text:"Show blocks",cmd:"mceVisualBlocks",onPostRender:n,selectable:!0,context:"view",prependToContext:!0}),e.on("init",function(){e.settings.visualblocks_default_state&&e.execCommand("mceVisualBlocks",!1,null,{skip_focus:!0})}),e.on("remove",function(){e.dom.removeClass(e.getBody(),"mce-visualblocks")}))});