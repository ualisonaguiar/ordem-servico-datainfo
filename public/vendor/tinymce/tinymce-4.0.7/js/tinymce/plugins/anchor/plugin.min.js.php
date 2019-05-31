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
tinymce.PluginManager.add("anchor",function(e){function t(){var t=e.selection.getNode();e.windowManager.open({title:"Anchor",body:{type:"textbox",name:"name",size:40,label:"Name",value:t.name||t.id},onsubmit:function(t){e.execCommand("mceInsertContent",!1,e.dom.createHTML("a",{id:t.data.name}))}})}e.addButton("anchor",{icon:"anchor",tooltip:"Anchor",onclick:t,stateSelector:"a:not([href])"}),e.addMenuItem("anchor",{icon:"anchor",text:"Anchor",context:"insert",onclick:t})});