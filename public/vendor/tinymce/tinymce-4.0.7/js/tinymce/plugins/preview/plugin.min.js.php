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
tinymce.PluginManager.add("preview",function(e){var t=e.settings;e.addCommand("mcePreview",function(){e.windowManager.open({title:"Preview",width:parseInt(e.getParam("plugin_preview_width","650"),10),height:parseInt(e.getParam("plugin_preview_height","500"),10),html:'<iframe src="javascript:\'\'" frameborder="0"></iframe>',buttons:{text:"Close",onclick:function(){this.parent().parent().close()}},onPostRender:function(){var n,i=this.getEl("body").firstChild.contentWindow.document,a="";tinymce.each(e.contentCSS,function(t){a+='<link type="text/css" rel="stylesheet" href="'+e.documentBaseURI.toAbsolute(t)+'">'});var r=t.body_id||"tinymce";-1!=r.indexOf("=")&&(r=e.getParam("body_id","","hash"),r=r[e.id]||r);var o=t.body_class||"";-1!=o.indexOf("=")&&(o=e.getParam("body_class","","hash"),o=o[e.id]||""),n="<!DOCTYPE html><html><head>"+a+"</head>"+'<body id="'+r+'" class="mce-content-body '+o+'">'+e.getContent()+"</body>"+"</html>",i.open(),i.write(n),i.close()}})}),e.addButton("preview",{title:"Preview",cmd:"mcePreview"}),e.addMenuItem("preview",{text:"Preview",cmd:"mcePreview",context:"view"})});