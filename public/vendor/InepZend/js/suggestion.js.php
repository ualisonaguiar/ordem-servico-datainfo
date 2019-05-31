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
var strGlobalSuggestionLastTerm = '';
function suggestion(strInputText, strUrlListAvailableTag, strFunctionListAvailableTag, intMinLengthStart, intMaxLengthItem, strMethod, strHiddenValue)
{
    $(function () {
        var inputText = getObject(strInputText);
        if ((empty(inputText)) || ((empty(strUrlListAvailableTag)) && (empty(strFunctionListAvailableTag))))
            return;
        if (empty(intMinLengthStart))
            intMinLengthStart = 3;
        if (empty(strMethod))
            strMethod = 'post';
        var mixSource = strUrlListAvailableTag;
        if (!empty(strFunctionListAvailableTag)) {
            if (strFunctionListAvailableTag.indexOf('(') == -1)
                strFunctionListAvailableTag += '()';
            strFunctionListAvailableTag = replaceAll(strFunctionListAvailableTag, ';', '');
            mixSource = function (request, response) {
                var arrResponse = [];
                eval('var arrAvailableTag = ' + strFunctionListAvailableTag + ';');
                var arrAvailableTagClean = [];
                var arrAvailableTagToFilter = [];
                var strAvailableTag;
                for (var intCount = 0; intCount < arrAvailableTag.length; ++intCount) {
                    strAvailableTag = arrAvailableTag[intCount];
                    var strAvailableTagClean = clearWord(strAvailableTag);
                    arrAvailableTagClean[strAvailableTag] = strAvailableTagClean;
                    arrAvailableTagToFilter = insertDistinctValueIntoArray(arrAvailableTagToFilter, strAvailableTagClean);
                }
                var arrAvailableFiltrated = $.ui.autocomplete.filter(arrAvailableTagToFilter, clearWord(request.term));
                for (intCount = 0; intCount < arrAvailableFiltrated.length; ++intCount)
                    for (strAvailableTag in arrAvailableTagClean)
                        if (arrAvailableTagClean[strAvailableTag] == arrAvailableFiltrated[intCount])
                            arrResponse[arrResponse.length] = strAvailableTag;
                if ((!empty(intMaxLengthItem)) && (isArray(arrResponse)))
                    arrResponse = arrResponse.slice(0, intMaxLengthItem);
                response(arrResponse);
            }
        } else if (strMethod.toLowerCase() == 'post') {
            mixSource = function (request, response) {
                if (strGlobalSuggestionLastTerm.indexOf(request.term) === 0)
                    return;
                strGlobalSuggestionLastTerm = request.term;
                ajaxSuggestion(strUrlListAvailableTag, request.term, intMaxLengthItem, response, inputText.getAttribute('id'), strHiddenValue);
            }
        }
        include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
        $(inputText).autocomplete({
            minLength: intMinLengthStart,
            source: mixSource,
            change: function (event, ui) {
                var inputHiddenParam = getObject(inputText.getAttribute('id') + '_hidden');
                if ((empty(inputHiddenParam)) || (!empty(ui.item)))
                    return;
                inputText.value = '';
                inputHiddenParam.value = '';
            },
            search: function (event, ui) {
                var inputHiddenParam = getObject(inputText.getAttribute('id') + '_hidden');
                if (empty(inputHiddenParam))
                    return;
                inputHiddenParam.value = '';
            },
            select: function (event, ui) {
                var inputText = event.target;
                if (empty(inputText))
                    return;
                var inputHiddenParam = getObject(inputText.getAttribute('id') + '_hidden');
                if (empty(inputHiddenParam))
                    return;
                var strHiddenValue = inputHiddenParam.getAttribute('data-hidden-value');
                if (empty(strHiddenValue))
                    strHiddenValue = 'id';
                eval('inputHiddenParam.value = ui.item.' + strHiddenValue + ';');
            }
        });
    });
}

function ajaxSuggestion(strUrl, strTerm, intMaxLengthItem, response, strInputText, strHiddenValue)
{
    if ((empty(strUrl)) || (empty(strTerm)))
        return false;
    var arrUrlParam = [];
    arrUrlParam.term = strTerm;
    arrUrlParam.limit = intMaxLengthItem;
    if (!empty(globalLastAjaxRequest)) {
        globalLastAjaxRequest.abort();
        globalLastAjaxRequest = undefined;
    }
    return ajaxRequest(strUrl, arrUrlParam, 'ajaxSuggestionAfterAjax', new Array(response, strInputText, strHiddenValue), undefined, undefined, false, true, true);
}

function ajaxSuggestionAfterAjax(mixData, arrParam)
{
    var response = arrParam[0];
    var strInputText = arrParam[1];
    var strHiddenValue = arrParam[2];
    var result = getJsonObject(mixData);
    response(result);
    if ((!empty(strInputText)) && (!empty(strHiddenValue))) {
        var inputHiddenParam = setParamIntoInputHidden('', strInputText, 'hidden', false, getFormByElement(getObject(strInputText)));
        inputHiddenParam.setAttribute('data-hidden-value', strHiddenValue);
    }
    return result;
}

//function exampleListAvailableTag()
//{
//    var arrAvailableTag = [
//        'Java',
//        'JavaScript',
//        'PHP',
//        'Python',
//        'Ruby',
//        'amável',
//        'dócil',
//        'Cármen',
//        'cadáver',
//        'ímpar',
//        'bíceps',
//        'almíscar',
//        'fórceps',
//        'eden',
//        'éden',
//        'edema',
//        'edemilson',
//        'túnel',
//        'ônix',
//        'açúcar',
//        'tórax',
//        'hífen',
//        'órfã',
//        'sótão',
//        'órfão',
//        'jóquei',
//        'amáveis',
//        'fósseis',
//        'beribéri',
//        'júri',
//        'álbum',
//        'fóruns',
//        'íris',
//        'húmus',
//        'vírus',
//        'lápis'
//    ];
//    return arrAvailableTag;
//}