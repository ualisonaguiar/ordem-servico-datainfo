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
var jcrop_api;function managerImageCrop(strFileName,strIdButton){$('#img_'+strFileName).Jcrop({onChange:exibePreview,onSelect:exibePreview,},function(){jcrop_api=this});jcrop_api.enable();updateButton(strFileName,strIdButton,'Salvar Recorte','cropImagem')}function exibePreview(coordinateImage){var strCoordinate=coordinateImage.w+'|'+coordinateImage.h+'|'+coordinateImage.x+'|'+coordinateImage.y;if(!$('#coord_image_crop').length)createHiddenIntoRepository('formAjaxUpload','coord_image_crop','coord_image_crop',null);$('#coord_image_crop').val(strCoordinate)}function updateButton(strFileName,strIdButton,strLabel,strFunction){var buttonImagem=$('#'+strIdButton);buttonImagem.attr('title',strLabel).attr('value',strLabel).data('type-action','salve').attr('onclick',strFunction+"('"+strFileName+"', '"+strIdButton+"');");buttonImagem.html(strLabel);buttonImagem.focus()}function enableButtonCrop(strIdButton){$('#btn_crop_'+strIdButton).removeClass('hide')}