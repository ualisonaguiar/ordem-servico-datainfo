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
!function(a){"use strict";a.cookie("contrast")&&a("body").addClass("contrast"),window.ParsleyConfig={errorClass:"has-error",successClass:"has-success",classHandler:function(a){return a.$element.closest(".form-group")},errorsWrapper:'<span class="help-block hide"></span>',errorTemplate:'<span class="block"></span>'}}(jQuery),function(a){"use strict";var b={init:function(){a('[data-toggle="tooltip"]').tooltip(),a(".dropdown-toggle").dropdown()}},c={init:function(){a('[data-toggle="checked"]').on("change",function(){var b=a(this).data("target");a(this).is(":checked")&&"1"===a(this).val()?(a(b).attr("disabled",!1),a(b).attr("required",!0)):(a(b).attr("disabled",!0),a(b).attr("required",!1),a(b).removeClass("parsley-error").closest(".form-group").find(".help-block").removeClass("filled").find("span").remove())}),a(".date").mask("00/00/0000"),a(".time").mask("00:00:00"),a(".date_time").mask("00/00/0000 00:00:00"),a(".cep").mask("00000-000"),a(".phone").mask("0000-0000"),a(".phone_with_ddd").mask("(00) 0000-0000"),a(".phone_us").mask("(000) 000-0000"),a(".mixed").mask("AAA 000-S0S"),a(".cpf").mask("000.000.000-00",{reverse:!0}),a(".money").mask("000.000.000.000.000,00",{reverse:!0}),a(".money2").mask("#.##0,00",{reverse:!0,maxlength:!1}),a(".ip_address").mask("0ZZ.0ZZ.0ZZ.0ZZ",{translation:{Z:{pattern:/[0-9]/,optional:!0}}}),a(".ip_address").mask("099.099.099.099"),a(".percent").mask("##0,00%",{reverse:!0})}},d={init:function(){a("a.contrast").on("click",function(b){b.preventDefault(),a("body").toggleClass("contrast"),a("body").hasClass("contrast")?a.cookie("contrast",!0):a.removeCookie("contrast")})}},e={init:function(){b.init(),c.init(),d.init()}},f={init:function(){}},g={init:function(){}},h={init:function(){}};a(document).ready(e.init),a(window).load(f.init),a(window).resize(g.init),a(window).scroll(h.init)}(jQuery);