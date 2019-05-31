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
tinymce.PluginManager.add("wordcount",function(e){function t(){e.theme.panel.find("#wordcount").text(["Words: {0}",a.getCount()])}var n,i,a=this;n=e.getParam("wordcount_countregex",/[\w\u2019\x27\-]+/g),i=e.getParam("wordcount_cleanregex",/[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g),e.on("init",function(){var n=e.theme.panel&&e.theme.panel.find("#statusbar")[0];n&&window.setTimeout(function(){n.insert({type:"label",name:"wordcount",text:["Words: {0}",a.getCount()],classes:"wordcount"},0),e.on("setcontent beforeaddundo",t),e.on("keyup",function(e){32==e.keyCode&&t()})},0)}),a.getCount=function(){var t=e.getContent({format:"raw"}),a=0;if(t){t=t.replace(/\.\.\./g," "),t=t.replace(/<.[^<>]*?>/g," ").replace(/&nbsp;|&#160;/gi," "),t=t.replace(/(\w+)(&.+?;)+(\w+)/,"$1$3").replace(/&.+?;/g," "),t=t.replace(i,"");var o=t.match(n);o&&(a=o.length)}return a}});