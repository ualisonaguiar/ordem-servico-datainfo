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
tinymce.PluginManager.add("example",function(t){t.addButton("example",{text:"My button",icon:!1,onclick:function(){t.windowManager.open({title:"Example plugin",body:[{type:"textbox",name:"title",label:"Title"}],onsubmit:function(e){t.insertContent("Title: "+e.data.title)}})}}),t.addMenuItem("example",{text:"Example plugin",context:"tools",onclick:function(){t.windowManager.open({title:"TinyMCE site",url:"http://www.tinymce.com",width:800,height:600,buttons:[{text:"Close",onclick:"close"}]})}})});