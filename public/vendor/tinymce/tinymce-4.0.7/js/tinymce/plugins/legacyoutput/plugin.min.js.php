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
!function(e){e.on("AddEditor",function(e){e.editor.settings.inline_styles=!1}),e.PluginManager.add("legacyoutput",function(t){t.on("init",function(){var n="p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img",i=e.explode(t.settings.font_size_style_values),o=t.schema;t.formatter.register({alignleft:{selector:n,attributes:{align:"left"}},aligncenter:{selector:n,attributes:{align:"center"}},alignright:{selector:n,attributes:{align:"right"}},alignjustify:{selector:n,attributes:{align:"justify"}},bold:[{inline:"b",remove:"all"},{inline:"strong",remove:"all"},{inline:"span",styles:{fontWeight:"bold"}}],italic:[{inline:"i",remove:"all"},{inline:"em",remove:"all"},{inline:"span",styles:{fontStyle:"italic"}}],underline:[{inline:"u",remove:"all"},{inline:"span",styles:{textDecoration:"underline"},exact:!0}],strikethrough:[{inline:"strike",remove:"all"},{inline:"span",styles:{textDecoration:"line-through"},exact:!0}],fontname:{inline:"font",attributes:{face:"%value"}},fontsize:{inline:"font",attributes:{size:function(t){return e.inArray(i,t.value)+1}}},forecolor:{inline:"font",attributes:{color:"%value"}},hilitecolor:{inline:"font",styles:{backgroundColor:"%value"}}}),e.each("b,i,u,strike".split(","),function(e){o.addValidElements(e+"[*]")}),o.getElementRule("font")||o.addValidElements("font[face|size|color|style]"),e.each(n.split(","),function(e){var t=o.getElementRule(e);t&&(t.attributes.align||(t.attributes.align={},t.attributesOrder.push("align")))})})})}(tinymce);