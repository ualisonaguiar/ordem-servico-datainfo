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
tinymce.PluginManager.add("save",function(e){function t(){var t,n;return t=tinymce.DOM.getParent(e.id,"form"),!e.getParam("save_enablewhendirty",!0)||e.isDirty()?(tinymce.triggerSave(),(n=e.getParam("save_onsavecallback"))?(e.execCallback("save_onsavecallback",e)&&(e.startContent=tinymce.trim(e.getContent({format:"raw"})),e.nodeChanged()),void 0):(t?(e.isNotDirty=!0,(!t.onsubmit||t.onsubmit())&&("function"==typeof t.submit?t.submit():e.windowManager.alert("Error: Form submit field collision.")),e.nodeChanged()):e.windowManager.alert("Error: No form element found."),void 0)):void 0}function n(){var t,n=tinymce.trim(e.startContent);return(t=e.getParam("save_oncancelcallback"))?(e.execCallback("save_oncancelcallback",e),void 0):(e.setContent(n),e.undoManager.clear(),e.nodeChanged(),void 0)}function i(){var t=this;e.on("nodeChange",function(){t.disabled(e.getParam("save_enablewhendirty",!0)&&!e.isDirty())})}e.addCommand("mceSave",t),e.addCommand("mceCancel",n),e.addButton("save",{icon:"save",text:"Save",cmd:"mceSave",disabled:!0,onPostRender:i}),e.addButton("cancel",{text:"Cancel",icon:!1,cmd:"mceCancel",disabled:!0,onPostRender:i}),e.addShortcut("ctrl+s","","mceSave")});