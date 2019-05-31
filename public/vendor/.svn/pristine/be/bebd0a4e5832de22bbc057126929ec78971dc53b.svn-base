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
function addMessage(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessage');
}

function addMessageSuccess(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessageSuccess');
}

function addMessageError(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessageError');
}

function addMessageWarning(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessageWarning');
}

function addMessageNotice(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessageNotice');
}

function addMessageValidate(mixMessage)
{
    return ajaxServiceMessage(mixMessage, 'addMessageValidate');
}

function ajaxServiceMessage(mixMessage, strMethod)
{
    if ((empty(mixMessage)) || (empty(strMethod)))
        return false;
    if (!isArray(mixMessage))
        mixMessage = new Array(mixMessage);
    var arrUrlParam = [];
    arrUrlParam.method = strMethod;
    for (var intCount = 0; intCount < mixMessage.length; ++intCount)
        arrUrlParam['message[' + intCount + ']'] = mixMessage[intCount];
    var strUrl = '/message';
    var mixResult = ajaxRequest(strUrl, arrUrlParam, undefined, undefined, undefined, undefined, false, false, true);
    if (mixResult === false)
        return false;
    var messageContainer = getObject('messageContainer');
    if (empty(messageContainer))
        return false;
    messageContainer.innerHTML += mixResult;
    return true;
}