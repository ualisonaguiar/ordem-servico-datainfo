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
function popupFull(strUrl,strWindowName,strJsExecOnClose){var strComplement='toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=no,copyhistory=1,width='+screen.availWidth+',height='+screen.availHeight+',top=0,left=0';return popup(strUrl,strWindowName,strComplement,strJsExecOnClose)}function popup(strUrl,strWindowName,strComplement,strJsExecOnClose){if((empty(strUrl))||(empty(strWindowName)))return false;if(empty(strComplement))strComplement='scrollbars=yes,resizable=yes,width=1017,height=460';var windowOpen=window.open(strUrl,strWindowName,strComplement);checkPopupExists(windowOpen,strJsExecOnClose);try{windowOpen.focus(windowOpen.name)}catch(exception){}return windowOpen}function popupModal(strUrl,strWindowName,strComplement,strJsExecOnClose){var windowOpen=popup(strUrl,strWindowName,strComplement,strJsExecOnClose);if(!windowOpen)return false;return true}var intGlobalIntervalPopup;var windowGlobalPopup;var strGlobalJsExecOnClosePopup;function checkPopupExists(windowOpen,strJsExecOnClose){if((empty(windowOpen))||(!isObject(windowOpen)))return false;intGlobalIntervalPopup=setInterval(checkPopupExistsInterval,1000);windowGlobalPopup=windowOpen;strGlobalJsExecOnClosePopup=strJsExecOnClose;return true}function checkPopupExistsInterval(){try{var strHref=windowGlobalPopup.location.href;if(empty(strHref))throw'Exception'}catch(exception){if(!empty(intGlobalIntervalPopup)){clearInterval(intGlobalIntervalPopup);if(!empty(strGlobalJsExecOnClosePopup))eval(strGlobalJsExecOnClosePopup);intGlobalIntervalPopup=null;windowGlobalPopup=null;strGlobalJsExecOnClosePopup=null}}return true}