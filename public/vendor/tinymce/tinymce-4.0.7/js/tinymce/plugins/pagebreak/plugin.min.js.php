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
tinymce.PluginManager.add("pagebreak",function(e){var t,n="mce-pagebreak",i=e.getParam("pagebreak_separator","<!-- pagebreak -->"),a='<img src="'+tinymce.Env.transparentSrc+'" class="'+n+'" data-mce-resize="false" />';t=new RegExp(i.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g,function(e){return"\\"+e}),"gi"),e.addCommand("mcePageBreak",function(){e.execCommand("mceInsertContent",0,a)}),e.addButton("pagebreak",{title:"Page break",cmd:"mcePageBreak"}),e.addMenuItem("pagebreak",{text:"Page break",icon:"pagebreak",cmd:"mcePageBreak",context:"insert"}),e.on("ResolveName",function(t){"IMG"==t.target.nodeName&&e.dom.hasClass(t.target,n)&&(t.name="pagebreak")}),e.on("click",function(t){t=t.target,"IMG"===t.nodeName&&e.dom.hasClass(t,n)&&e.selection.select(t)}),e.on("BeforeSetContent",function(e){e.content=e.content.replace(t,a)}),e.on("PreInit",function(){e.serializer.addNodeFilter("img",function(e){for(var t,n,a=e.length;a--;)t=e[a],n=t.attr("class"),n&&-1!==n.indexOf("mce-pagebreak")&&(t.type=3,t.value=i,t.raw=!0)})})});