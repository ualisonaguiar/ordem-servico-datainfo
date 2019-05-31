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
function characterCounter(strIdTextarea)
{
    var elementTextarea = getObject(strIdTextarea);
    var intWidth = elementTextarea.style.width;
    if (empty(intWidth))
        intWidth = '100%';
    var strDivCounter = '<div class="text-danger pull-left counterCharacters counterCharacters_' + elementTextarea.id + '" style="width: ' + intWidth + ';">Caracteres digitados: <span> <span class="countMin"> ' + $.trim(elementTextarea.value).replace(/(<([^>]+)>)/ig, "").length + '</span>' + ((empty(elementTextarea.getAttribute('maxlength'))) ? '' : ' de ' + elementTextarea.getAttribute('maxlength')) + '</span></div><br />';
    if (!$('#' + elementTextarea.id).hasClass('editorFormElement')) {
        jQuery.fn.characterCounter = function () {
            this.each(function () {
                var elmentCounter = $(strDivCounter);
                $(this).after(elmentCounter);
                $(this).data("field-counter", elmentCounter);
                $(this).keyup(function () {
                    setFieldCounterHtml(this);
                });
            });
            return this;
        };
        $('#' + elementTextarea.id).characterCounter();
    }
}

function characterCounterEditor(strIdTextarea)
{
    var elementTextarea = getObject(strIdTextarea);
    var intWidth = elementTextarea.style.width;
    if (empty(intWidth))
        intWidth = '100%';
    var strDivCounter = '<div class="text-danger pull-left counterCharacters counterCharacters_' + elementTextarea.id + '" style="width: ' + intWidth + ';">Caracteres digitados: <span> <span class="countMin"> ' + tinymce.get(elementTextarea.id).getContent().length + '</span>' + ((empty(elementTextarea.getAttribute('maxlength'))) ? '' : ' de ' + elementTextarea.getAttribute('maxlength')) + '</span></div><br />';
    if ($('#' + elementTextarea.id).hasClass('editorFormElement')) {
        //strDivCounter += '<div class="text-danger pull-left counterCharacters counterCharacters_' + elementTextarea.id + '_html" style="width: ' + intWidth + ';">Caracteres HTML: <span class="countMin">' + tinymce.get(elementTextarea.id).getContent().length + '</span></div><br />';
        $('#' + elementTextarea.id).parent().append(strDivCounter);
    }
}

function setFieldCounterHtml(textareaFieldCounter)
{
    var arrResult = getLengthCounterHtml($(textareaFieldCounter).attr('value'));
    var intLength = arrResult[0];
    var strText = arrResult[1];
    if (intLength > $(textareaFieldCounter).attr('maxlength')) {
        $(textareaFieldCounter).val(strText.replace(/\r\n|\r|\n/g, "\r\n").slice(0, $(textareaFieldCounter).attr('maxlength')));
        displayCountCaracter(textareaFieldCounter, $(textareaFieldCounter).attr('maxlength'));
        return false;
    }
    if ($(textareaFieldCounter).attr('value') != strText)
    	$(textareaFieldCounter).val(strText);
    return (empty(textareaFieldCounter)) ? false : displayCountCaracter(textareaFieldCounter, intLength);
}

function displayCountCaracter(textareaFieldCounter, intLength)
{
    $(textareaFieldCounter).data("field-counter").html('Caracteres digitados: <span> <span class="countMin">' + intLength + '</span>' + ((empty($(textareaFieldCounter).attr('maxlength'))) ? '' : ' de ' + $(textareaFieldCounter).attr('maxlength')) + '</span>')
}

function getLengthCounterHtml(strText)
{
    if (!strText)
        return [0, strText];
    var newLines = strText.match(/(\r\n|\n|\r)/g);
    var intLength = 0;
    if (newLines !== null)
        intLength = newLines.length;
    intLength += strText.length;
    return [intLength, strText];
}
