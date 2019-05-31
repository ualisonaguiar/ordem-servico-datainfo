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
function scriptBtnMenuAdministrativeResponsible()
{
	$('#btn-menu-administrative-responsible').click(function () {
        if ($('#menu-administrative-responsible:visible').length) {
            $('#contentContainer').removeClass('container-menu-responsible');
            $('#menu-administrative-responsible').hide();
            setCookie('menu-toggle', false, undefined, '/');
        }
        else {
            $('#contentContainer').addClass('container-menu-responsible');
            setCookie('menu-toggle', true, undefined, '/');
            $('#menu-administrative-responsible').removeClass('hide');
            $('#menu-administrative-responsible').removeAttr('style');
        }
    });	
}

$(document).ready(function () {
    $('#navbar-toggle-info-usuario').click(function () {
    	if (document.all) {
    		if ($('#navbar-collapse.collapse:not(.in)').is(':visible'))
    			$('#navbar-collapse.collapse:not(.in)').hide();
    		else
    			$('#navbar-collapse.collapse:not(.in)').show();    			
    	} else {
    		$('#navbar-collapse.collapse:not(.in)').collapse('show');
            $('#navbar-collapse.collapse.in').collapse('hide');
    	}
    });
    scriptBtnMenuAdministrativeResponsible();
    if (document.all) {
        $('input[maxLength]').each(function () {
            var intMaxlength = $(this).attr('maxLength');
            $(this).attr('maxlength', intMaxlength);
        });
    }
});