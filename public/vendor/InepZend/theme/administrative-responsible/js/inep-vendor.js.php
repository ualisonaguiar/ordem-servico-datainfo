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
function setCookie(strCookieName, strCookieValue, intExpireDay, strPath)
{
    var strCookieExpires = '';
    if (!empty(intExpireDay)) {
        var date = new Date();
        date.setTime(date.getTime() + (intExpireDay * 24 * 60 * 60 * 1000));
        strCookieExpires = ' expires=' + date.toGMTString() + ';';
    }
    var strCookiePath = '';
    if (!empty(strPath))
        strCookiePath = ' path=' + strPath + ';';
    document.cookie = strCookieName + '=' + strCookieValue + ';' + strCookieExpires + strCookiePath;
}

function getCookie(strCookieName)
{
    var strName = strCookieName + '=';
    var arrCookie = document.cookie.split(';');
    for (var intCount = 0; intCount < arrCookie.length; ++intCount) {
        var strCookie = arrCookie[intCount];
        while (strCookie.charAt(0) == ' ')
            strCookie = strCookie.substring(1);
        if (strCookie.indexOf(strName) != -1) {
            strCookie = strCookie.substring(strName.length, strCookie.length);
            if (strCookieName == 'contrast_theme')
                setCookie('contrast', strCookie);
            return strCookie;
        }
    }
    return '';
}

var strGlobalFirstSessionId;
var intGlobalIntervalCheckAlterSessionId;
function controlAlterSessionId()
{
    if (strGlobalControlAlterSessionIdCallback == strGlobalControlAlterSessionIdCallbackDefault)
        return false;
    if (empty(strGlobalFirstSessionId))
        strGlobalFirstSessionId = getCookie('PHPSESSID');
    intGlobalIntervalCheckAlterSessionId = setInterval(checkAlterSessionId, 10000);
    return true;
}

var booGlobalCheckAlterSessionId = true;
function checkAlterSessionId()
{
    if ((strGlobalFirstSessionId == getCookie('PHPSESSID')) || (booGlobalCheckAlterSessionId === false))
        return true;
    if (empty(strGlobalControlAlterSessionIdCallback))
        strGlobalControlAlterSessionIdCallback = 'window.location.href = "' + strGlobalBasePath + '/";';
    eval(strGlobalControlAlterSessionIdCallback);
    clearInterval(intGlobalIntervalCheckAlterSessionId);
    return false;
}

execFunctionOnLoadEvent('controlAlterSessionId();');function ajaxGetCoUfFromSigla(strSglUf, mixUf, arrData, booCache)
{
    if (isNumeric(strSglUf))
        return strSglUf;
    var arrUrlParam = [];
    arrUrlParam.sigla = strSglUf;
    var mixResult = ajaxRequest('/ajaxgetcouffromsigla', arrUrlParam, undefined, undefined, undefined, undefined, false, false, (!isBoolean(booCache)) ? true : booCache);
    if (!empty(mixUf)) {
        var uf = getObject(mixUf);
        if (!empty(uf)) {
            uf.value = mixResult;
            execFeedSelectOnChange(uf, (((isArray(arrData)) && (!empty(arrData.co_ibge))) ? arrData.co_ibge : undefined));
        }
    }
    return mixResult;
}

function ajaxUfOnChange(intCoMunicipio, mixMunicipio, arrData)
{
    if (!empty(mixMunicipio)) {
        var municipio = getObject(mixMunicipio);
        var arrUf = getElementsByAttribute(document.body, 'SELECT', 'data-depend', municipio.getAttribute('id'));
        if (arrUf.length > 0)
            execFeedSelectOnChange(arrUf[0], intCoMunicipio);
    }
    return true;
}

function editOnEvent(strOnEvent, strSymbol)
{
    if ((empty(strOnEvent)) || (empty(strSymbol)))
        return false;
    if (strOnEvent.indexOf(strSymbol) == -1)
        return strOnEvent;
    var intLength = strOnEvent.length - 1;
    if (strOnEvent[intLength] == strSymbol)
        strOnEvent = trim(strOnEvent.substr(0, intLength));
    return strOnEvent;
}var strGlobalCepValue;
function ajaxCorreiosDne(mixCep, arrConvertMap, jsonReadonly, strClass, strMethod)
{
    if (empty(mixCep))
        return false;
    var cep = getObject(mixCep);
    if (empty(cep))
        return false;
    var strCepValue = replaceAll(cep.value, new Array('_', '-'), '');
    if (DEBUG_AJAX) {
        console.log(cep.value);
        console.log(strCepValue);
    }
    if (strCepValue.length != 8)
        return false;
    if (strGlobalCepValue == strCepValue)
        return true;
    strGlobalCepValue = strCepValue;
    openWaitDialog(undefined, undefined, undefined, undefined, 'ajaxCorreiosDne');
    if (empty(strClass))
        strClass = '\\InepZend\\WebService\\Client\\Corporative\\Correios\\Dne';
    if (empty(strMethod))
        strMethod = 'solicitarDadosPorCep';
    var arrInput = getElementsByAttribute(document.body, 'INPUT', 'data-domain', $(cep).attr('id'));
    if (DEBUG_AJAX) {
        console.log(strClass);
        console.log(strMethod);
        console.log(arrInput);
    }
    var element;
    for (var intCount = 0; intCount < arrInput.length; ++intCount) {
        element = arrInput[intCount];
        if ($(element).val() !== '')
            element.value = '';
        $(element).valid();
        eval('var booReadonly = jsonReadonly.' + $(element).attr('name') + ';');
        configReadonlyFromValue(element, booReadonly);
    }
    var mixResult = ajaxWebService(strCepValue, strClass, strMethod, false, false, 400);
    if (mixResult === false) {
        closeWaitDialog('ajaxCorreiosDne');
        return false;
    }
    var json = getJsonObject(mixResult);
    if (DEBUG_AJAX)
        console.log(json);
    if ((empty(json.RESPOSTA)) || (empty(json.RESPOSTA.STATUS))) {
        closeWaitDialog('ajaxCorreiosDne');
        return false;
    }
    var booEmpty = (json.RESPOSTA.STATUS == 'empty');
    if (booEmpty) {
        validateDialog('CEP inválido.');
        $(cep).next().val('');
        setTimeout('$("#' + cep.getAttribute('id') + '").val(""); $("#' + cep.getAttribute('id') + '").valid();', 10);
        $(cep).val('');
    }
    var arrNodeList = json.RESPOSTA.NODELIST;
    if (!isArray(arrNodeList))
        arrNodeList = parseArray(arrNodeList, true);
    for (var strAttribute in arrNodeList) {
        var arrAttribute = new Array(strAttribute, dasherize(strAttribute), lcfirst(camelize(strAttribute)));
        for (intCount = 0; intCount < arrAttribute.length; ++intCount) {
            element = getObject(arrAttribute[intCount]);
            if (empty(element))
                continue;
            if (!empty(arrNodeList[strAttribute]))
                element.value = arrNodeList[strAttribute];
            $(element).valid();
            eval('var booReadonly = jsonReadonly.' + strAttribute + ';');
            configReadonlyFromValue(element, booReadonly);
        }
    }
    if (isFirefox())
        closeWaitDialog('ajaxCorreiosDne');
    else
        setTimeout(closeWaitDialog('ajaxCorreiosDne'), 100);
    if (isArray(arrConvertMap)) {
        for (strAttribute in arrConvertMap) {
            var mixValue = arrConvertMap[strAttribute];
            var mixObject = '';
            var strFunction = '';
            if (!isArray(mixValue))
                mixObject = mixValue;
            else {
                if (mixValue.length >= 1)
                    mixObject = mixValue[0];
                if (mixValue.length >= 2)
                    strFunction = mixValue[1];
            }
            element = getObject(mixObject);
            if (empty(element))
                continue;
            if (empty(strFunction)) {
                if (!empty(arrNodeList[strAttribute]))
                    element.value = arrNodeList[strAttribute];
            } else {
                var booEval = true;
                switch (strFunction) {
                    case 'ajaxGetCoUfFromSigla':
                        var intCoUf = arrNodeList.co_uf;
                        if (!empty(intCoUf)) {
                            element.value = intCoUf;
                            booEval = false;
                        }
                        if (booEmpty) {
                            if ($(element).val() !== '')
                                element.value = '';
                            booEval = false;
                        }
                        break;
                    case 'ajaxUfOnChange':
                        if (booEmpty) {
                            clearValueElement(element);
                            booEval = false;
                        }
                        break;
                }
                if (booEval) {
                    eval('var mixResultFunction = ' + strFunction + '(arrNodeList[strAttribute], element, arrNodeList);');
                    if (!isBoolean(mixResultFunction))
                        element.value = mixResultFunction;
                }
            }
            $(element).valid();
            eval('var booReadonly = jsonReadonly.' + $(element).attr('name') + ';');
            configReadonlyFromValue(element, booReadonly);
        }
    }
    return true;
}function addMessage(mixMessage)
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
}var DEBUG_AJAX = false;
var arrGlobalAjaxRequest = [];
var arrGlobalAjaxResult = [];
var globalLastAjaxRequest;

function ajaxRequest(strUrl, mixUrlParam, strAfterFunction, arrAfterFunctionParam, strMethod, strDataType, booWait, booAsync, booCache, intMilisecondSemaphoreRequest, intMilisecondLifetimeResult)
{
    if (empty(strUrl))
        return false;
    if (empty(strMethod))
        strMethod = 'POST';
    if (empty(strDataType))
        strDataType = 'text';
    if (empty(booWait))
        booWait = false;
    if (empty(booAsync))
        booAsync = false;
    if (empty(booCache))
        booCache = false;
    var strRequestName = base64Encode(strUrl + '_' + implode('_', parseArray(mixUrlParam)));
    if (DEBUG_AJAX) {
        console.log(booCache);
        console.log(booAsync);
        console.log(strRequestName);
    }
    if (booCache) {
        if (!empty(arrGlobalAjaxResult[strRequestName])) {
            var strResult = arrGlobalAjaxResult[strRequestName][0];
            var intMilisecondResult = arrGlobalAjaxResult[strRequestName][1];
            if ((new Date().getTime() - intMilisecondResult) < getMilisecondLifetimeResult(intMilisecondLifetimeResult)) {
                if (!empty(strAfterFunction)) {
                    eval('mixResultAjax = ' + strAfterFunction + '(strResult, arrAfterFunctionParam);');
                    if (empty(mixResultAjax))
                        mixResultAjax = strResult;
                } else
                    mixResultAjax = (booAsync) ? true : strResult;
                if (DEBUG_AJAX)
                    console.log(mixResultAjax);
                return mixResultAjax;
            }
        }
    }
    if (strMethod.toUpperCase() == 'POST') {
        if (!empty(arrGlobalAjaxRequest[strRequestName]))
            if ((new Date().getTime() - arrGlobalAjaxRequest[strRequestName]) < getMilisecondSemaphoreRequest(intMilisecondSemaphoreRequest))
                return false;
        arrGlobalAjaxRequest[strRequestName] = new Date().getTime();
    }
    var strNameDialog = 'waitDialog' + new Date().getTime();
    if ((booWait === true) && (existFunction('openWaitDialog')))
        openWaitDialog(undefined, undefined, undefined, undefined, strNameDialog);
    strUrl = strGlobalBasePath + strUrl;
    var arrParamAjaxRequest = [];
    arrParamAjaxRequest.url = strUrl;
    if (!empty(mixUrlParam)) {
        var urlParam = {};
        if (isArray(mixUrlParam)) {
        	var strAttribute;
            for (var mixKey in mixUrlParam) {
                if (empty(mixUrlParam[mixKey]))
                    continue;
                var strAttributeHierarchy = replaceAll(mixKey, '[]', '');
                var arrAttributeValue;
                var intPosOpen = strAttributeHierarchy.indexOf('[');
                if ((intPosOpen != -1) && (strAttributeHierarchy.indexOf(']') != -1)) {
                    strAttribute = strAttributeHierarchy.substr(0, intPosOpen);
                    if (isArray(urlParam[strAttribute]))
                        arrAttributeValue = urlParam[strAttribute];
                }
                urlParam = createAttributeHierarchyIntoObject(strAttributeHierarchy, mixUrlParam[mixKey], urlParam);
                if ((isArray(arrAttributeValue)) && (isArray(urlParam[strAttribute]))) {
                    var arrAttributeValueMerged = arrAttributeValue;
                    var arrUrlParamAttribute = urlParam[strAttribute];
                    for (var intCount = 0; intCount < arrUrlParamAttribute.length; ++intCount) {
                        var mixUrlParamAttribute = arrUrlParamAttribute[intCount];
                        if (empty(mixUrlParamAttribute))
                            continue;
                        arrAttributeValueMerged[intCount] = mixUrlParamAttribute;
                    }
                    urlParam[strAttribute] = arrAttributeValueMerged;
                }
            }
        }
        arrParamAjaxRequest.data = urlParam;
    }
    arrParamAjaxRequest.type = strMethod;
    arrParamAjaxRequest.dataType = strDataType;
    arrParamAjaxRequest.async = booAsync;
    arrParamAjaxRequest.cache = booCache;
    var mixResultAjax = booAsync;
    var ajaxRequest = $.ajax(arrParamAjaxRequest);
    ajaxRequest.fail(
            function (jqXHR, textStatus, errorThrown)
            {
                if ((booWait === true) && (existFunction('closeWaitDialog')))
                    closeWaitDialog(strNameDialog);
                if (textStatus != 'abort')
                    alertDialog('Ocorreu um erro e a operação não pôde ser realizada!', 'Erro', 500, 300);
                mixResultAjax = false;
            }
    );
    if (empty(arrAfterFunctionParam))
        arrAfterFunctionParam = [];
    ajaxRequest.done(
            function (data, textStatus, jqXHR)
            {
                if ((booWait === true) && (existFunction('closeWaitDialog')))
                    closeWaitDialog(strNameDialog);
                if (!empty(strAfterFunction))
                    eval('mixResultAjax = ' + strAfterFunction + '(data, arrAfterFunctionParam);');
                if (booAsync === true)
                    mixResultAjax = true;
                else if ((empty(strAfterFunction)) || (empty(mixResultAjax))) {
                    mixResultAjax = data;
                    arrGlobalAjaxResult[strRequestName] = new Array(mixResultAjax, new Date().getTime());
                }
            }
    );
    if (DEBUG_AJAX)
        console.log(mixResultAjax);
    globalLastAjaxRequest = ajaxRequest;
    return mixResultAjax;
}

function feedSelect(mixInvoker, mixReceiver, strUrl, mixValueReceiver, booWait, booAsync, booCache, strAfterFunction)
{
    if ((empty(mixInvoker)) || (empty(mixReceiver)))
        return false;
    var invoker = getObject(mixInvoker);
    var receiver = getObject(mixReceiver);
    if ((empty(invoker)) || (empty(invoker.id)) || (empty(receiver)))
        return false;
    var booClearSelect = clearSelect(receiver);
    if (!booClearSelect)
        return false;
    if ((empty(invoker.value)) || (empty(strUrl)))
        return true;
    var arrUrlParam = [];
    arrUrlParam[invoker.id] = invoker.value;
    if (!isBoolean(booCache))
        booCache = true;
    return ajaxRequest(strUrl, arrUrlParam, 'feedSelectAfterAjax', new Array(receiver, mixValueReceiver, strAfterFunction), undefined, 'json', booWait, booAsync, booCache, 10);
}

function feedSelectAfterAjax(mixData, arrParam)
{
    var receiver = arrParam[0];
    var mixValueReceiver = arrParam[1];
    var strAfterFunction = arrParam[2];
    for (var intCount = 0; intCount < mixData.length; ++intCount) {
        if (empty(mixData[intCount]))
            continue;
        var option = document.createElement('OPTION');
        option.value = mixData[intCount].value;
        option.innerHTML = mixData[intCount].text;
        if ((!empty(mixValueReceiver)) && (mixData[intCount].value == mixValueReceiver))
            option.selected = true;
        receiver.appendChild(option);
    }
    if (!empty(strAfterFunction)) {
        eval('var mixResult = ' + strAfterFunction + ';');
        return mixResult;
    }
}

function execFeedSelectOnChange(select, mixValue)
{
    select = getObject(select);
    if ((!empty(select)) && (!empty(select.onchange))) {
        var strOnChange = trim(replaceAll(select.onchange.toString(), new Array('function onchange(event)', "\n"), ''));
        if (strOnChange.indexOf('{') === 0)
            strOnChange = trim(strOnChange.substr(1));
        if ((strOnChange.indexOf('feedSelect') != -1) && (!empty(mixValue)))
            strOnChange = replaceAll(editOnEvent(strOnChange, '}'), 'undefined', mixValue);
        eval(strOnChange);
        return true;
    }
    return false;
}

function filterPaginator(strUrl, mixForm, strReference, booAllowEmptyFilter, arrIgnoreCheckAllowEmptyFilter, strSortName, strSortOrder, booClearUrlParam, strMessage, booCache)
{
    if (empty(mixForm)) {
        var arrForm = document.getElementsByTagName('FORM');
        if (arrForm.length === 0)
            return false;
        mixForm = arrForm[0];
    }
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    if (!$(form).valid())
        return false;
    if (empty(strUrl)) {
        form.submit();
        return true;
    }
    if (empty(strReference)) {
        var arrTable = getElementsFromAttribute(document.body, 'TABLE', 'summary', 'flexigridTable');
        if (arrTable.length > 0) {
            var table = arrTable[0];
            if (!empty(table.getAttribute('id')))
                strReference = '#' + table.getAttribute('id');
        }
    }
    if (empty(strReference))
        strReference = '#tableData';
    if (!isBoolean(booAllowEmptyFilter))
        booAllowEmptyFilter = true;
    if (!isBoolean(booClearUrlParam))
        booClearUrlParam = true;
    var arrSelectMultiple = $(form).find('select[multiple="multiple"]');
    if (arrSelectMultiple.size() > 0)
        managerTransfer();
    var arrValuesForm = getValuesForm(mixForm);
    var arrUrlParam = [];
    var mixKey;
    var intCount2;
    for (var intCount = 0; intCount < arrValuesForm.length; ++intCount) {
        loopValuesForm: for (mixKey in arrValuesForm[intCount]) {
            if (empty(arrValuesForm[intCount][mixKey]))
                continue;
            if (!empty(arrIgnoreCheckAllowEmptyFilter)) {
                for (intCount2 = 0; intCount2 < arrIgnoreCheckAllowEmptyFilter.length; ++intCount2) {
                    if (empty(arrIgnoreCheckAllowEmptyFilter[intCount2]))
                        continue;
                    var elementIgnore = getObject(arrIgnoreCheckAllowEmptyFilter[intCount2][0]);
                    var strValueIgnore = arrIgnoreCheckAllowEmptyFilter[intCount2][1];
                    if (((empty(elementIgnore)) || (mixKey === elementIgnore.getAttribute('id'))) && (arrValuesForm[intCount][mixKey] === strValueIgnore))
                        continue loopValuesForm;
                }
            }
            arrUrlParam[mixKey] = arrValuesForm[intCount][mixKey];
        }
    }
    var booExistsFilter = false;
    for (mixKey in arrUrlParam) {
        if (arrUrlParam[mixKey] !== '') {
            booExistsFilter = true;
            if (booClearUrlParam !== true)
                break;
        } else if (booClearUrlParam === true)
            delete arrUrlParam[mixKey];
    }
    if ((booAllowEmptyFilter === false) && (booExistsFilter === false)) {
        if (empty(strMessage))
            strMessage = 'Informe pelo menos um filtro para pesquisa.';
        alertDialog(strMessage, 'Alerta', 500, 300);
        return false;
    }
    setParamIntoInputHidden(arrUrlParam, null, strReference);
    try {
        strGlobalFlexigridRequestName = base64Encode(implode('_', parseArray(arrUrlParam)));
        var arrResult = arrGlobalFlexigridResult[strGlobalFlexigridRequestName];
        if (!empty(arrResult)) {
            var tbody = arrResult[0];
            var arrPaginatorInfo = arrResult[1];
            var intMilisecondResult = arrResult[2];
            if ((new Date().getTime() - intMilisecondResult) < getMilisecondLifetimeResult()) {
                var arrThInfo = [];
                var arrTd = tbody.getElementsByTagName('TR')[0].getElementsByTagName('TD');
                var strAbbr;
                for (intCount = 0; intCount < arrTd.length; ++intCount) {
                    var td = arrTd[intCount];
                    strAbbr = td.getAttribute('abbr');
                    if (empty(strAbbr))
                        continue;
                    arrThInfo[arrThInfo.length] = new Array(strAbbr, td.className);
                }
                $(strReference).find('tbody').replaceWith($(tbody));
                var arrTh = $('div.hDiv').get()[0].getElementsByTagName('THEAD')[0].getElementsByTagName('TH');
                var th;
                for (intCount = 0; intCount < arrThInfo.length; ++intCount) {
                    th = arrTh[intCount];
                    strAbbr = th.getAttribute('abbr');
                    var strAbbrCached = arrThInfo[intCount][0];
                    if ((empty(strAbbr)) || (strAbbr == strAbbrCached))
                        continue;
                    var strClassCached = arrThInfo[intCount][1];
                    for (intCount2 = 0; intCount2 < arrTh.length; ++intCount2) {
                        var thTarget = arrTh[intCount2];
                        var strAbbrTarget = thTarget.getAttribute('abbr');
                        if (empty(strAbbrTarget))
                            continue;
                        if (strAbbrTarget != strAbbrCached)
                            continue;
                        $(th).before($(thTarget));
                        break;
                    }
                }
                arrTh = $('div.hDiv').get()[0].getElementsByTagName('THEAD')[0].getElementsByTagName('TH');
                for (intCount = 0; intCount < arrTh.length; ++intCount) {
                    th = arrTh[intCount];
                    strAbbr = th.getAttribute('abbr');
                    if (empty(strAbbr))
                        continue;
                    th.className = arrThInfo[intCount][1];
                }
                var intResultPerPage = arrPaginatorInfo[0];
                var intCurrentPage = arrPaginatorInfo[1];
                var intTotalPage = arrPaginatorInfo[2];
                var strStatPage = arrPaginatorInfo[3];
                $('div.pDiv').find('select').val(intResultPerPage);
                $('div.pDiv').find('input').val(intCurrentPage);
                $('div.pDiv').find('span.pcontrol span').html(intTotalPage);
                $('div.pDiv').find('.pPageStat').html(strStatPage);
                var arrInfo = explode('|', replaceAll(replaceAll(replaceAll(strStatPage, new Array('Listando', 'registro(s)', ' '), ''), 'até', '|'), 'de', '|'));
                var intFirstRow = arrInfo[0];
                var intLastRow = arrInfo[1];
                var intTotalRow = arrInfo[2];
                var intRowPage = ((arrInfo[1] - arrInfo[0]) + 1);
                $(strReference).flexOptions({page: intCurrentPage, pages: intTotalPage, newp: intCurrentPage});
                $('div.gBlock').hide();
                return;
            }
        }
    } catch (exception) {

    }
/*    return ajaxRequest(strUrl, arrUrlParam, 'filterPaginatorAfterAjax', new Array(strReference, strSortName, strSortOrder));*/
    return filterPaginatorAfterAjax('ok', new Array(strReference, strSortName, strSortOrder, booCache));
}

function filterPaginatorAfterAjax(mixData, arrParam)
{
    if (mixData.toString().toLowerCase() == 'ok') {
        var strReference = arrParam[0];
        var strSortName = arrParam[1];
        var strSortOrder = arrParam[2];
        var booCache = arrParam[3];
        if (empty(booCache))
            booCache = false;
        booGlobalFlexigridCache = booCache;
        if (empty(strSortName))
            reloadFlexigrid(undefined, undefined, strReference);
        else {
            var arrSortedTitle = getElementsFromAttribute(document.body, 'TH', 'class', 'sorted');
            if (arrSortedTitle.length !== 0)
                reloadFlexigrid(undefined, undefined, strReference);
            else {
                if (empty(strSortOrder))
                    strSortOrder = 'asc';
                reloadFlexigrid(undefined, {sortname: strSortName, sortorder: strSortOrder}, strReference);
                var arrElement = getElementsFromAttribute(document.body, 'TH', 'abbr', strSortName);
                if (arrElement.length > 0) {
                    var th = arrElement[0];
                    th.className = 'sorted';
                    arrElement = th.getElementsByTagName('DIV');
                    if (arrElement.length > 0) {
                        var div = arrElement[0];
                        div.className = 's' + strSortOrder.toString().toLowerCase();
                    }
                }
            }
        }
    } else
        alertDialog(mixData.toString(), 'Alerta', 500, 400);
}

function ajaxSubmitForm(mixForm, strAfterFunction, arrAfterFunctionParam, strMethod, strDataType, booWait, booAsync, booCache, strAfterFunctionComplete, arrAfterFunctionCompleteParam)
{
    if (empty(mixForm))
        return false;
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    if (empty(arrAfterFunctionParam))
        arrAfterFunctionParam = [];
    if (empty(strMethod))
        strMethod = 'POST';
    if (empty(strDataType))
        strDataType = null;
    if (!isBoolean(booWait))
        booWait = true;
    if (empty(booAsync))
        booAsync = false;
    if (empty(booCache))
        booCache = false;
    if (empty(arrAfterFunctionCompleteParam))
        arrAfterFunctionCompleteParam = [];
    if ((booWait === true) && (existFunction('openWaitDialog')))
        openWaitDialog();
    form.setAttribute('method', strMethod);
    if (document.all) {
        var arrSelectReplace = [];
        var arrHiddenReplace = [];
        var arrSelect = form.getElementsByTagName('SELECT');
        for (var intCount = 0; intCount < arrSelect.length; ++intCount) {
            var select = arrSelect[intCount];
            if ((empty(select)) || (!isEmptyAttribute(select, 'multiple')) || (isEmptyAttribute(select, 'name')) /*|| (select.getAttribute('name') == 'rp')*/)
                continue;
            var strId = (isEmptyAttribute(select, 'id')) ? select.getAttribute('name') : select.getAttribute('id');
            var selectValue = getObject(strId);
            if (empty(selectValue))
                continue;
            arrSelectReplace[arrSelectReplace.length] = select;
            arrHiddenReplace[arrHiddenReplace.length] = createHiddenIntoRepository(undefined, strId, select.getAttribute('name'), selectValue.value);
        }
        var intLength = arrSelectReplace.length;
        for (intCount = 0; intCount < intLength; ++intCount) {
            if ((empty(arrHiddenReplace[intCount])) || (empty(arrSelectReplace[intCount])))
                continue;
            try {
                form.replaceChild(arrHiddenReplace[intCount], arrSelectReplace[intCount]);
            } catch (exception) {
                continue;
            }
        }
        if ((!isEmptyAttribute(form, 'name')) || (!isEmptyAttribute(form, 'id'))) {
            var strFormName = (!isEmptyAttribute(form, 'name')) ? form.getAttribute('name') : undefined;
            var strFormId = (!isEmptyAttribute(form, 'id')) ? form.getAttribute('id') : undefined;
            var arrForm = document.getElementsByTagName('FORM');
            var booExists = false;
            for (intCount = 0; intCount < arrForm.length; ++intCount) {
                var formIntern = arrForm[intCount];
                if (empty(formIntern))
                    continue;
                var strFormInternName = (!isEmptyAttribute(formIntern, 'name')) ? formIntern.getAttribute('name') : undefined;
                var strFormInternId = (!isEmptyAttribute(formIntern, 'id')) ? formIntern.getAttribute('id') : undefined;
                if ((strFormName == strFormInternName) && (strFormId == strFormInternId)) {
                    booExists = true;
                    break;
                }
            }
            if (!booExists) {
                form.style.display = 'none';
                document.body.appendChild(form);
            }
        }
    }
    var mixResultAjax = booAsync;
    include_once('/vendor/jquery-form/jquery-form-3.28.0/jquery.form.min.js' + ((document.all) ? '' : strGlobalSufixJsGzip));
    $(form).ajaxForm(
            {
                type: strMethod,
                dataType: strDataType,
                async: booAsync,
                cache: booCache,
                complete: function (jqXHR) {
                    if ((booWait === true) && (existFunction('closeWaitDialog')))
                        closeWaitDialog();
                    if (!empty(strAfterFunctionComplete))
                        eval('mixResultAjax = ' + strAfterFunctionComplete + '(jqXHR, arrAfterFunctionCompleteParam);');
                    if (booAsync === true)
                        mixResultAjax = true;
                    else if ((empty(strAfterFunctionComplete)) || (empty(mixResultAjax)))
                        mixResultAjax = jqXHR;
                },
                error: function () {
                    alertDialog('Ocorreu um erro e a operação não pôde ser realizada!', 'Erro', 500, 300);
                    mixResultAjax = false;
                },
                success: function (data, textStatus, jqXHR) {
                    if (!empty(strAfterFunction))
                        eval('mixResultAjax = ' + strAfterFunction + '(data, arrAfterFunctionParam);');
                    if (booAsync === true)
                        mixResultAjax = true;
                    else if ((empty(strAfterFunction)) || (empty(mixResultAjax)))
                        mixResultAjax = data;
                }
            }
    );
    include_once('/vendor/jquery-validate/jquery-validate-1.11.0pre/jquery.validate.js' + strGlobalSufixJsGzip);
    $(form).submit();
    return mixResultAjax;
}

function ajaxUpload(mixInputFile, strAfterFunction, arrAfterFunctionParam, strUrl, mixForm, booWait, booAsync, booCache)
{
    if (empty(mixInputFile))
        return false;
    var inputFile = getObject(mixInputFile);
    if (empty(inputFile))
        return false;
    if (empty(inputFile.value)) {
        alertDialog('É necessário selecionar algum arquivo para realizar a operação!', 'Alerta', 500, 300);
        return true;
    }
    if (empty(arrAfterFunctionParam))
        arrAfterFunctionParam = [];
    var form;
    if (empty(mixForm)) {
        form = document.getElementById('formAjaxUpload');
        if (empty(form)) {
            form = document.createElement('FORM');
            form.setAttribute('id', 'formAjaxUpload');
            form.setAttribute('method', 'POST');
            form.setAttribute('enctype', 'multipart/form-data');
            form.style.display = 'none';
            document.body.appendChild(form);
        }
    } else {
        form = getObject(mixForm);
        if ((empty(form)) || (!$(form).valid()))
            return false;
    }
    if (!empty(strUrl)) {
        strUrl = strGlobalBasePath + strUrl;
        form.setAttribute('action', strUrl);
    }
    var booModal = ($(inputFile).parents('.ui-dialog').length !== 0);
    var parentNode = inputFile.parentNode;
    var span = parentNode;
    if (((parentNode.tagName + '') != 'SPAN') || (parentNode.getAttribute('name') != 'spanInputFile')) {
        span = document.createElement('SPAN');
        span.setAttribute('name', 'spanInputFile');
        parentNode.replaceChild(span, inputFile);
        span.appendChild(inputFile);
    }
    span.innerHTML = '';
    if (!booModal)
    	span.appendChild(inputFile.cloneNode(true));
    else {
    	if (!inputFile.getAttribute('required'))
    		span.appendChild(inputFile.cloneNode(true));
    }
    form.appendChild(inputFile);
    if (booModal)
        inputFile.style.display = 'none';
    return ajaxSubmitForm(form, undefined, undefined, undefined, undefined, booWait, booAsync, booCache, 'ajaxUploadAfterAjax', new Array(inputFile, span, strAfterFunction, arrAfterFunctionParam, booModal));
}

function ajaxUploadAfterAjax(jqXHR, arrParam)
{
    var inputFile = arrParam[0];
    var span = arrParam[1];
    var strAfterFunction = arrParam[2];
    var arrAfterFunctionParam = arrParam[3];
    var booModal = arrParam[4];
    span.innerHTML = '';
    if (booModal !== false)
        inputFile.style.display = '';
    span.appendChild(inputFile);
    if (!empty(strAfterFunction))
        eval(strAfterFunction + '(jqXHR, arrAfterFunctionParam);');
}

function ajaxWebService(mixParam, strClass, strMethod, booCache, booWait, intMilisecondSemaphoreRequest)
{
    if ((empty(mixParam)) || (empty(strClass)) || (empty(strMethod)))
        return false;
    if (!isArray(mixParam))
        mixParam = new Array(mixParam);
    if (!isBoolean(booWait))
        booWait = true;
    var arrUrlParam = [];
    arrUrlParam.class = strClass;
    arrUrlParam.method = strMethod;
    for (var intCount = 0; intCount < mixParam.length; ++intCount)
        arrUrlParam['param[' + intCount + ']'] = mixParam[intCount];
    return ajaxRequest('/ajaxwebservice', arrUrlParam, undefined, undefined, undefined, undefined, booWait, false, (!isBoolean(booCache)) ? true : booCache, intMilisecondSemaphoreRequest);
}

function getMilisecondLifetimeResult(intMilisecondLifetimeResult)
{
    return (empty(intMilisecondLifetimeResult)) ? 180000 : intMilisecondLifetimeResult;
}

function getMilisecondSemaphoreRequest(intMilisecondSemaphoreRequest)
{
    return (empty(intMilisecondSemaphoreRequest)) ? 2000 : intMilisecondSemaphoreRequest;
}var arrDialog, strGlobalHtmlForm;
function openDialog(mixText, strTitle, intWidth, intHeight, arrButton, booModal, booResizable, booClose, strEvalOpen, strName, strEvalClose, booFocusButton)
{
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    if ((isObject($.ui)) && (booFocusButton !== true))
        $.ui.dialog.prototype._focusTabbable = function () {};
    if (empty(mixText))
        mixText = '';
    else if ((isObject(mixText)) && (mixText.tagName.toLowerCase() == 'form')) {
        if (empty(strGlobalHtmlForm)) {
            strGlobalHtmlForm = $(mixText).html();
            $(mixText).remove();
        }
        mixText = strGlobalHtmlForm;
    }
    if (empty(intWidth))
        intWidth = 500;
    if (empty(intHeight))
        intHeight = 300;
    if (!isBoolean(booModal))
        booModal = true;
    if (!isBoolean(booResizable))
        booResizable = true;
    if (!isBoolean(booClose))
        booClose = true;
    if (empty(strEvalOpen))
        strEvalOpen = '';
    strEvalOpen = 'setDialogGlobal(this, strName);' + strEvalOpen;
    var arrParam = [];
    if (!empty(strTitle))
        arrParam.title = strTitle;
    if (booClose) {
        arrParam.closeText = 'fechar';
        arrParam.open = function (event, ui) {
            eval(strEvalOpen);
        }
    } else {
        arrParam.closeOnEscape = false;
        arrParam.open = function (event, ui) {
            eval(strEvalOpen);
            $('.ui-dialog-titlebar-close', $(this).parent()).hide();
        }
    }
    arrParam.width = (isMobileWidth()) ? 'auto' : intWidth;
    arrParam.height = (isMobileWidth()) ? 'auto' : intHeight;
    arrParam.modal = booModal;
    arrParam.resizable = booResizable;
    if (isArray(arrButton)) {
        arrParam.buttons = arrButton;
        arrParam.open = function (event, ui) {
            var arrButton = $(this.parentNode).find('button');
            var removeClassButtonHover = function () {
                $(this).removeClass('ui-state-hover');
                $(this).removeClass('ui-state-focus');
                $(this).removeClass('ui-state-active');
                $(this).removeClass('ui-state-default');
            };
            for (var intCount = 0; arrButton.length > intCount; ++intCount) {
                var button = arrButton[intCount];
                if ($(button).attr('class').indexOf('titlebar-close') == -1) {
                    var strAccesskeyNext = getAccesskeyNext(true);
                    if (strAccesskeyNext != 'a') {
                        button.setAttribute('accesskey', strAccesskeyNext);
                        button.setAttribute('class', 'btnUi btnDefault btn btn-info');
                        $(button).hover(removeClassButtonHover);
                    }
                }
            }
        };
        arrParam.close = function (event, ui) {
            if (!empty(strEvalClose))
                eval(strEvalClose);
            var arrButton = $(this.parentNode).find('button');
            for (var intCount = 0; arrButton.length > intCount; ++intCount) {
                var button = arrButton[intCount];
                if ($(button).attr('class').indexOf('titlebar-close') == -1)
                    $(button).remove();
            }
        };
    }
    if ((!isObject(mixText)) && (!isObject(getObject(mixText))))
        mixText = '<div>' + mixText + '</div>';
    try {
        var modalForm = $((isObject(getObject(mixText))) ? getObject(mixText) : mixText);
        modalForm.dialog(arrParam);
        if (modalForm.is('form')) {
            if (modalForm.validate())
                modalForm.validate().resetForm();
        }
    } catch (exception) {

    }
    return;
}

function confirmDialog(mixText, strTitle, intWidth, intHeight, strEvalOk, strEvalCancel, booModal, booResizable, strName, strEvalClose, booFocusButton)
{
    var arrButton = addButton('OK', strEvalOk);
    arrButton = addButton('Cancelar', strEvalCancel, arrButton);
    return openDialog(mixText, strTitle, intWidth, intHeight, arrButton, booModal, booResizable, undefined, undefined, strName, strEvalClose, booFocusButton);
}

function yesNoDialog(mixText, strTitle, intWidth, intHeight, strEvalYes, strEvalNo, booModal, booResizable, strName, strEvalClose, booFocusButton)
{
    var arrButton = addButton('Sim', strEvalYes);
    arrButton = addButton('Não', strEvalNo, arrButton);
    return openDialog(mixText, strTitle, intWidth, intHeight, arrButton, booModal, booResizable, undefined, undefined, strName, strEvalClose, booFocusButton);
}

function clearDialog(mixText, strTitle, intWidth, intHeight, booModal, booResizable, strName, strEvalClose, booFocusButton)
{
    return openDialog(mixText, strTitle, intWidth, intHeight, undefined, booModal, booResizable, undefined, undefined, strName, strEvalClose, booFocusButton);
}

function alertDialog(mixText, strTitle, intWidth, intHeight, strEvalOk, booModal, booResizable, strName, strEvalClose, booFocusButton)
{
    var arrButton = addButton('OK', strEvalOk);
    return openDialog(mixText, strTitle, intWidth, intHeight, arrButton, booModal, booResizable, undefined, undefined, strName, strEvalClose, booFocusButton);
}

function validateDialog(mixText, booShowValidate, strEval, intWidth, intHeight)
{
    if (!isBoolean(booShowValidate))
        booShowValidate = true;
    if (booShowValidate !== true)
        return false;
    if (empty(intWidth))
        intWidth = 200;
    if (empty(intHeight))
        intHeight = 150;
    setTimeout(function() {
    	strGlobalCheckValue = undefined;
    }, 1000);
    return alertDialog(mixText, 'Validação', intWidth, intHeight, strEval, undefined, undefined, undefined, undefined, true);
}

function openWaitDialog(mixText, strTitle, intWidth, intHeight, strName, strEvalClose)
{
    if (empty(mixText))
        mixText = '<br />Aguarde a realização das devidas operações...<br /><br /><img src="' + strGlobalBasePath + '/vendor/InepZend/images/progress.gif" />';
    mixText = '<div id="divOpenWaitDialog" style="text-align: center;">' + ((!isObject(mixText)) ? mixText : mixText.innerHTML) + '</div>';
    if (empty(strTitle))
        strTitle = 'Aguarde';
    if (empty(intWidth))
        intWidth = 250;
    if (empty(intHeight))
        intHeight = 175;
    if (empty(strName))
        strName = 'waitDialog';
    return openDialog(mixText, strTitle, intWidth, intHeight, undefined, undefined, undefined, false, undefined, strName, strEvalClose, true);
}

function closeWaitDialog(strName)
{
    if (empty(strName))
        strName = 'waitDialog';
    closeDialog(strName);
}

function closeDialog(strName, booDestroy)
{
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    var strAction = (empty(booDestroy)) ? 'close' : 'destroy';
    var dialog;
    if (!empty(strName)) {
        dialog = getDialogGlobal(strName);
        if (empty(dialog))
            return false;
        $(dialog).dialog(strAction);
        setDialogGlobal(undefined, strName);
    } else {
        arrDialog = getDialogGlobal();
        for (var mixKey in arrDialog) {
            dialog = arrDialog[mixKey];
            if ((strAction == 'close') && ((empty(dialog)) || ($(dialog).dialog('isOpen') === false)))
                continue;
            $(dialog).dialog(strAction);
            setDialogGlobal(undefined, mixKey);
        }
    }
    clearDialogGlobal();
}

function getDialogGlobal(mixKey)
{
    if (empty(arrDialog))
        arrDialog = [];
    return (empty(mixKey)) ? arrDialog : arrDialog[mixKey];
}

function setDialogGlobal(dialog, strName)
{
    arrDialog = getDialogGlobal();
    arrDialog[(empty(strName)) ? arrDialog.length : strName] = dialog;
    arrDialog = clearDialogGlobal();
}

function clearDialogGlobal()
{
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    arrDialog = getDialogGlobal();
    var arrResult = [];
    for (var mixKey in arrDialog) {
        if ((empty(arrDialog[mixKey])) || ($(arrDialog[mixKey]).dialog('isOpen') === false))
            continue;
        arrResult[mixKey] = arrDialog[mixKey];
    }
    return arrResult;
}

function addButton(strText, strEval, arrButton)
{
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    if (empty(arrButton))
        arrButton = [];
    var intKey = arrButton.length;
    arrButton[intKey] = [];
    arrButton[intKey].text = strText;
    arrButton[intKey].title = strText;
    arrButton[intKey].click = function () {
        eval(strEval);
        $(this).dialog('close');
    };
    return arrButton;
}

var dialogFunctions = function($) {
    /**
     * Abre modal com apenas um botao de OK.
     *
     * @param object option
     *
     * @example
     * option.mixText - Conteudo que fica no centro da modal.
     * option.strTitle - Titulo da modal.
     * option.intWidth - Largura da modal.
     * option.intHeight - Altura da modal.
     * option.strEvalOk - Funcao JS.
     * option.booModal
     * option.booResizable
     * option.strName
     * option.strEvalClose
     * option.booFocusButton
     */
    $.dialogAlert = function (option)
    {
        var optionDefault = {
            'mixText': '',
            'strTitle': 'Aviso!',
            'intWidth': '500',
            'intHeight': '200',
            'strEvalOk': '',
            'booModal': '',
            'booResizable': '',
            'strName': '',
            'strEvalClose': '',
            'booFocusButton': ''
        };
        option = $.extend({}, optionDefault, option);
        alertDialog(option.mixText, option.strTitle, option.intWidth, option.intHeight, option.strEvalOk, option.booModal, option.booResizable, option.strName, option.strEvalClose, option.booFocusButton);
    };

    /**
     * Abre modal com botoes de confirmacao.
     *
     * @param object option
     *
     * @example
     * option.mixText - Conteudo que fica no centro da modal.
     * option.strTitle - Titulo da modal.
     * option.intWidth - Largura da modal.
     * option.intHeight - Altura da modal.
     * option.strEvalOk - Funcao JS.
     * option.strEvalCancel - Funcao JS.
     * option.booModal
     * option.booResizable
     * option.strName
     * option.strEvalClose
     * option.booFocusButton
     */
    $.dialogConfirm = function (option)
    {
        var optionDefault = {
            'mixText': '',
            'strTitle': 'Aviso!',
            'intWidth': '500',
            'intHeight': '200',
            'strEvalOk': '',
            'strEvalCancel': '',
            'booModal': '',
            'booResizable': '',
            'strName': '',
            'strEvalClose': '',
            'booFocusButton': ''
        };
        option = $.extend({}, optionDefault, option);
        confirmDialog(option.mixText, option.strTitle, option.intWidth, option.intHeight, option.strEvalOk, option.strEvalCancel, option.booModal, option.booResizable, option.strName, option.strEvalClose, option.booFocusButton);
    };
};
dialogFunctions(jQuery);/**
 * Retorna qual o formulario algum determinado objeto (elemento) pertence.
 *
 * @param object element
 * @return object form
 */
function getFormByElement(element)
{
    var form = null;
    var actual = element;
    while ((form === null) && (!empty(actual)) && (actual.parentNode != document.body)) {
        actual = actual.parentNode;
        if (empty(actual))
            break;
        var strTagName = actual.tagName + '';
        if (strTagName.toUpperCase() == 'FORM')
            form = actual;
    }
    return form;
}

/**
 * Verifica se o texto tem o numero de caracteres maior que o definido.
 *
 * @param mix mixElement
 * @param handler event
 * @param integer intLength
 * @param boolean booOnlyIe
 * @return boolean
 */
function maxLengthControll(mixElement, intLength, event, booOnlyIe)
{
    if ((empty(mixElement)) || (empty(intLength)))
        return false;
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    if (empty(booOnlyIe))
        booOnlyIe = false;
    if ((booOnlyIe) && (!document.all))
        return true;
    var strTextContent = '';
    var arrStructure = new Array('value', 'textContent', 'text');
    for (var intCount = 0; intCount < arrStructure.length; ++intCount) {
        var strStructure = arrStructure[intCount];
        eval('var booStructure = (element.' + strStructure + ');');
        if (booStructure) {
            eval('strTextContent = element.' + strStructure + ';');
            if (strTextContent.length > intLength) {
                eval('element.' + strStructure + ' = strTextContent.substring(0, intLength);');
                return false;
            }
        }
    }
    strTextContent = captureValueFromElement(element);
    if (strTextContent.length < intLength)
        return true;
    if (!empty(event)) {
        var strKeyType = getKeyType(getIntKeyCode(event));
        if ((strKeyType == 'position') || (strKeyType == 'Fn') || (strKeyType == 'backspace') || (strKeyType == 'delete') || (strKeyType == 'tab'))
            return true;
    }
    event = false;
    return false;
}

/**
 * Verifica apos 10 milisegundos (devido ao onpaste via mouse) se o texto tem o numero de
 * caracteres maior que o definido (nao precisa do evento).
 *
 * @param mix mixElement
 * @param integer intLength
 * @param boolean booOnlyIe
 * @return boolean
 */
function maxLengthControllTimeout(mixElement, intLength, booOnlyIe)
{
    if ((empty(mixElement)) || (empty(intLength)))
        return false;
    var element = getObject(mixElement);
    if ((!empty(element)) && (!empty(element.id))) {
        setTimeout("maxLengthControll('" + element.id + "', " + intLength + ", undefined, " + booOnlyIe + ");", 10);
        return true;
    }
    return false;
}

/**
 * Checa e descheca todos os elementos de um determinado name.
 *
 * @param mix mixElementInvoker
 * @param string strElementsName
 * @param string strFunctionExec
 * @param boolean booNotUseDisabled
 * @return boolean
 */
function checkUncheckFromName(mixElementInvoker, strElementsName, strFunctionExec, booNotUseDisabled)
{
    if ((empty(mixElementInvoker)) || (empty(strElementsName)))
        return false;
    var elementInvoker = getObject(mixElementInvoker);
    var arrCheckbox = document.getElementsByName(strElementsName);
    for (var intCount = 0; intCount < arrCheckbox.length; ++intCount) {
        var elementCheckbox = arrCheckbox[intCount];
        if ((booNotUseDisabled === true) && (elementCheckbox.disabled))
            continue;
        elementCheckbox.checked = elementInvoker.checked;
        if (!empty(strFunctionExec))
            eval(replaceAll(strFunctionExec, 'this', "document.getElementById('" + elementCheckbox.id + "')"));
    }
    return true;
}

/**
 * Checa e descheca o elemento que invoca a acao de selecionar ou nao todos
 * outros elementos de um determinado name.
 *
 * @param mix mixElementInvoker
 * @param string strElementsName
 * @param boolean booNotUseDisabled
 * @return boolean
 */
function checkUncheckInvoker(mixElementInvoker, strElementsName, booNotUseDisabled)
{
    if ((empty(mixElementInvoker)) || (empty(strElementsName)))
        return false;
    var elementInvoker = getObject(mixElementInvoker);
    var arrCheckbox = document.getElementsByName(strElementsName);
    var booChecked = true;
    for (var intCount = 0; intCount < arrCheckbox.length; ++intCount) {
        if ((booNotUseDisabled === true) && (arrCheckbox[intCount].disabled))
            continue;
        if (!arrCheckbox[intCount].checked) {
            booChecked = false;
            break;
        }
    }
    elementInvoker.checked = booChecked;
    return true;
}

/**
 * Cria um elemento em um repositorio.
 *
 * @param mix mixRepositoryElement
 * @param string strId
 * @param string strName
 * @param string strValue
 * @return object
 */
function createHiddenIntoRepository(mixRepositoryElement, strId, strName, strValue)
{
	var repositoryElement;
    if (!empty(mixRepositoryElement)) {
        repositoryElement = getObject(mixRepositoryElement);
        if (empty(repositoryElement))
            return;
    }
    var inputHidden = document.createElement('INPUT');
    inputHidden.setAttribute('type', 'hidden');
    if (!empty(strId))
        inputHidden.id = strId;
    if (!empty(strName))
        inputHidden.name = strName;
    if (!empty(strValue))
        inputHidden.value = strValue;
    if (!empty(mixRepositoryElement))
        repositoryElement.appendChild(inputHidden);
    return inputHidden;
}

/**
 * Retorna um array com todos os valores do formulario.
 *
 * @param mix mixForm
 * @param boolean booNotDisabled
 * @return string
 */
function getValuesForm(mixForm, booNotDisabled)
{
    if (empty(mixForm))
        return false;
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    if (!isBoolean(booNotDisabled))
        booNotDisabled = true;
    var arrInput = (booNotDisabled) ? form.querySelectorAll('input:not([disabled]') : form.getElementsByTagName('INPUT');
    var arrSelect = (booNotDisabled) ? form.querySelectorAll('select:not([disabled]') : form.getElementsByTagName('SELECT');
    var arrTextarea = (booNotDisabled) ? form.querySelectorAll('textarea:not([disabled]') : form.getElementsByTagName('TEXTAREA');
    var arrValuesForm = [];
    var strName;
    var intKey;
    var strValue;
    for (var intCount = 0; intCount < arrInput.length; ++intCount) {
        var input = arrInput[intCount];
        if (empty(input.getAttribute('name')))
            continue;
        var booExec = ((input.type == 'checkbox') || (input.type == 'radio')) ? input.checked : true;
        if (booExec) {
            strValue = input.value;
            strName = input.getAttribute('name');
            if ((document.all) && (input.getAttribute('placeholder') == strValue))
                strValue = '';
            if (input.getAttribute('name') !== '') {
                intKey = arrValuesForm.length;
                arrValuesForm[intKey] = [];
                arrValuesForm[intKey][strName] = strValue;
            }
        }
    }
    for (intCount = 0; intCount < arrSelect.length; ++intCount) {
        var select = arrSelect[intCount];
        if (empty(select.getAttribute('name')))
            continue;
        if ((isSelectMultiple(select)) && (select.getAttribute('name').indexOf(strGlobalSufixTransferNotSelectable) != -1))
            continue;
        var mixValue = captureValueFromElement(select);
        strName = select.getAttribute('name');
        if (select.getAttribute('name') !== '') {
            intKey = arrValuesForm.length;
            arrValuesForm[intKey] = [];
            arrValuesForm[intKey][strName] = mixValue;
        }
    }
    for (intCount = 0; intCount < arrTextarea.length; ++intCount) {
        var textarea = arrTextarea[intCount];
        if (empty(textarea.getAttribute('name')))
            continue;
        strValue = textarea.value;
        strName = textarea.getAttribute('name');
        if ((document.all) && (textarea.getAttribute('placeholder') == strValue))
            strValue = '';
        if (textarea.getAttribute('name') !== '') {
            intKey = arrValuesForm.length;
            arrValuesForm[intKey] = [];
            arrValuesForm[intKey][strName] = strValue;
        }
    }
    return arrValuesForm;
}

/**
 * Retorna a string referente a todos os parametros de um formulario + o atributo
 * action.
 *
 * @param mix mixForm
 * @param string strUrlBase
 * @return string
 */
function getUrlForm(mixForm, strUrlBase)
{
    var arrValuesForm = getValuesForm(mixForm);
    if (arrValuesForm === false)
        return false;
    var form = getObject(mixForm);
    if (empty(strUrlBase))
        strUrlBase = form.getAttribute('action');
    var strUrl = strUrlBase;
    var strLastCharac = (strUrl !== '') ? strUrl.substring((strUrl.length - 1)) : '';
    if ((strLastCharac != '?') && (strLastCharac != '&')) {
        var strSymbol = (strUrl.indexOf('?') == -1) ? '?' : '&';
        strUrl += strSymbol;
    }
    for (var intCount = 0; intCount < arrValuesForm.length; ++intCount) {
        for (var strName in arrValuesForm[intCount])
            strUrl += strName + '=' + arrValuesForm[intCount][strName] + '&';
    }
    return strUrl;
}

/**
 * "Submete" o formulario usando o method get com os nomes dos atributos em md5
 * e os valores em base64.
 *
 * @param mix mixFormElement
 * @param string strUrlBase
 * @return boolean
 */
function submitGet(mixFormElement, strUrlBase)
{
    var mixUrl = getUrlForm(mixFormElement, strUrlBase);
    if (mixUrl === false)
        return mixUrl;
    window.location.href = mixUrl;
    return true;
}

/**
 * Captura os campos de um formulario.
 *
 * @param mix mixForm
 * @param boolean booShowHidden
 * @param boolean booShowDisabled
 * @return array
 */
function captureFieldsFromForm(mixForm, booShowHidden, booShowDisabled)
{
    if (empty(mixForm))
        mixForm = 'frm';
    if (!isBoolean(booShowHidden))
        booShowHidden = true;
    if (!isBoolean(booShowDisabled))
        booShowDisabled = true;
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    var arrElementsInputForm = parseArray(form.getElementsByTagName('INPUT'));
    var arrElementsSelectForm = parseArray(form.getElementsByTagName('SELECT'));
    var arrElementsTextareaForm = parseArray(form.getElementsByTagName('TEXTAREA'));
    var arrElementsInputFormEdited = [];
    for (var intCount = 0; intCount < arrElementsInputForm.length; ++intCount) {
        var fieldInputForm = arrElementsInputForm[intCount];
        if ((!empty(fieldInputForm)) && (isObject(fieldInputForm))) {
            if (booShowHidden)
                arrElementsInputFormEdited.push(fieldInputForm);
            else if (fieldInputForm.getAttribute('type') != 'hidden')
                arrElementsInputFormEdited.push(fieldInputForm);
        }
    }
    var arrElements = arrElementsInputFormEdited.concat(arrElementsSelectForm, arrElementsTextareaForm);
    var arrReturn = [];
    for (intCount = 0; intCount < arrElements.length; ++intCount) {
        var fieldForm = arrElements[intCount];
        if ((!empty(fieldForm)) && (isObject(fieldForm))) {
            if (booShowDisabled)
                arrReturn.push(fieldForm);
            else if (fieldForm.disabled === false)
                arrReturn.push(fieldForm);
        }
    }
    return arrReturn;
}

/**
 * Desabilita ou habilita todos os elementos nao ocultos de um formulario.
 *
 * @param boolean booDisabled
 * @param mix mixForm
 * @return boolean
 */
function disabledAllElementsFromForm(booDisabled, mixForm)
{
    if (!isBoolean(booDisabled))
        booDisabled = true;
    var arrElements = captureFieldsFromForm(mixForm, false);
    for (var intCount = 0; intCount < arrElements.length; ++intCount) {
        if (!empty(arrElements[intCount]))
            arrElements[intCount].disabled = booDisabled;
    }
    return true;
}

/**
 * Limpa os campos de um formulario.
 *
 * @param mix mixForm
 * @param boolean booClearHidden
 * @param boolean booClearDisabled
 * @param array arrIdHiddenElementsRestrict
 * @param array arrIdDisabledElementsRestrict
 * @param string strFunctionExec
 * @return boolean
 */
function clearValuesFromFieldsForm(mixForm, booClearHidden, booClearDisabled, arrIdHiddenElementsRestrict, arrIdDisabledElementsRestrict, strFunctionExec)
{
    if (empty(mixForm)) {
        var arrForm = document.getElementsByTagName('FORM');
        if (arrForm.length === 0)
            return false;
        mixForm = arrForm[0];
    }
    if (empty(booClearHidden))
        booClearHidden = false;
    if (empty(booClearDisabled))
        booClearDisabled = false;
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    var arrDisabledValue = [];
    var intCount;
    var arrDisabled = [];
    if (booClearDisabled === false) {
        arrDisabled = $(form).find('*:disabled').get();
        for (intCount = 0; intCount < arrDisabled.length; ++intCount)
            arrDisabledValue[intCount] = $(arrDisabled[intCount]).val();
    }
    form.reset();
    if (arrDisabledValue.length !== 0)
        for (intCount = 0; intCount < arrDisabled.length; ++intCount)
            $(arrDisabled[intCount]).val(arrDisabledValue[intCount]);
    var arrElements = captureFieldsFromForm(mixForm, true, booClearDisabled);
    for (intCount = 0; intCount < arrElements.length; ++intCount) {
        var element = arrElements[intCount];
        var strTagName = element.tagName + '';
        if (element.getAttribute) {
            if ((!empty(arrIdDisabledElementsRestrict)) && (element.disabled === true) && (array_search(element.id, arrIdDisabledElementsRestrict) != -1))
                continue;
            if ((strTagName.toUpperCase() == 'INPUT') && (element.type.toUpperCase() == 'HIDDEN')) {
                if (element.className == 'hiddenTree')
                    $(element.parentNode).children('i.glyphicon').click();
                if (!booClearHidden)
                    continue;
            }
            switch (strTagName.toUpperCase()) {
                case 'SELECT':
                    if (element.options.length > 0)
                        element.options[0].selected = true;
                    break;
                case 'TEXTAREA':
                    element.value = '';
                    if ($('#' + element.id).hasClass('editorFormElement'))
                        tinyMCE.get(element.id).setContent('');
                    $('.counterCharacters_' + element.id + ' .countMin').html(' 0');
                    break;
                case 'INPUT':
                    switch (element.type.toUpperCase()) {
                        case 'RADIO':
                            var arrRadio = document.getElementsByName(element.name);
                            for (var intCount2 = 0; intCount2 < arrRadio.length; ++intCount2) {
                                var booRadioChecked = (intCount2 === 0);
//                                var booRadioChecked = false;
//                                arrRadio[intCount2].checked = booRadioChecked;
                            }
                            break;
                        case 'CHECKBOX':
                            element.checked = false;
                            break;
                        case 'HIDDEN':
                            if (!empty(arrIdHiddenElementsRestrict)) {
                                if (array_search(element.id, arrIdHiddenElementsRestrict) == -1)
                                    element.value = "";
                            } else
                                element.value = "";
                            break;
                        case 'FILE':
                            if (document.all) {
                                var strValueInputFile = element.value;
                                element.outerHTML = replaceAll(element.outerHTML, strValueInputFile, '');
                            } else
                                element.value = '';
                            var divInputFile = getObject('link_' + element.getAttribute('id'));
                            if (!empty(divInputFile))
                                divInputFile.innerHTML = '';
                            break;
                        default:
                            if (element.name !== 'page_grid')
                                element.value = '';
                            break;
                    }
                    break;
            }
        }
    }
    var strSufixTransferNotSelectable = replaceAll(strGlobalSufixTransferNotSelectable, new Array('[', ']'), new Array('', ''));
    if ($('select[multiple="multiple"]:not([id*="' + strSufixTransferNotSelectable + '"])').length) {
        $('select[multiple="multiple"]:not([id*="' + strSufixTransferNotSelectable + '"])').each(function () {
            transferOptions($('select[multiple="multiple"][id="' + $(this).attr('id') + strGlobalSufixTransferNotSelectable + '"]').attr('id'), $(this).attr('id'), '<<', undefined, undefined);
        });
    }
    if ($('.classForm div[class*="counterCharacters"]').length > 1) {
        $('.classForm div[class*="counterCharacters"]').each(function () {
            if ($(this).find('.countMin').length)
                $(this).find('.countMin').html(0);
        });
    }
    if (!empty(strFunctionExec))
        eval(strFunctionExec);
    return true;
}

/**
 * Captura o valor checado de um radio ou checkbox.
 *
 * @param string strNameRadioCheckbox
 * @return mix
 */
function getValueFromRadioCheckbox(strNameRadioCheckbox)
{
    if (empty(strNameRadioCheckbox))
        return false;
    var arrRadioCheckbox = document.getElementsByName(strNameRadioCheckbox);
    var arrValue = [];
    for (var intCount = 0; intCount < arrRadioCheckbox.length; ++intCount) {
        var radioCheckbox = arrRadioCheckbox[intCount];
        if (radioCheckbox.checked === true)
            arrValue[arrValue.length] = radioCheckbox.value;
    }
    var mixValueReturn = null;
    if (arrValue.length == 1)
        mixValueReturn = arrValue[0];
    else if (arrValue.length > 1)
        mixValueReturn = arrValue;
    return mixValueReturn;
}

/**
 * Seta o timeout para realizar a captura de um arquivo de um input file sem ter
 * que submete-lo.
 *
 * @param mix mixInputFile
 * @return boolean
 */
function getFileFromInputFile(mixInputFile)
{
    if (empty(mixInputFile))
        return false;
    var inputFile = getObject(mixInputFile);
    if ((empty(inputFile)) || (empty(inputFile.value)))
        return false;
    setTimeout("getFileFromInputFileLink('" + inputFile.getAttribute("id") + "');", 500);
    return true;
}

/**
 * Cria um link para realizar a captura de um arquivo de um input file sem ter que
 * submete-lo.
 *
 * @param mix mixInputFile
 * @return boolean
 */
function getFileFromInputFileLink(mixInputFile)
{
    if (empty(mixInputFile))
        return false;
    var inputFile = getObject(mixInputFile);
    if ((empty(inputFile)) || (empty(inputFile.value)))
        return false;
    var inputFileParent = inputFile.parentNode;
    var strInputFileId = inputFile.getAttribute('id');
    var strInputFileName = inputFile.getAttribute('name');
    var link = document.getElementById('link_' + strInputFileId);
    if (!empty(link))
        inputFileParent.removeChild(link);
    var arrFile = inputFile.files;
    for (var intFile = 0; intFile < arrFile.length; ++intFile) {
        var strInputValue = replaceAll(arrFile[intFile].name, '/', '\\');
        var arrInputValue = explode('\\', strInputValue);
        var strFileName = arrInputValue[(arrInputValue.length - 1)];
        link = document.createElement('DIV');
        link.innerHTML += '<u>' + strFileName + '</u>';
        link.style.cursor = 'pointer';
        link.setAttribute('id', 'link_' + strInputFileId);
        link.setAttribute('name', 'link_' + strInputFileName);
        link.setAttribute('title', 'Capturar arquivo: ' + arrFile[intFile].name);
        inputFileParent.appendChild(link);
        insertFunctionIntoEventElement(link, 'onclick', "getFileFromInputFileAction('" + inputFile.getAttribute("id") + "', " + intFile + ");");
    }
    return true;
}

/**
 * Realiza a captura de um arquivo de um input file sem ter que submete-lo.
 *
 * @param mix mixInputFile
 * @param integer intFile
 * @return boolean
 */
function getFileFromInputFileAction(mixInputFile, intFile)
{
    if (empty(mixInputFile))
        return false;
    var inputFile = getObject(mixInputFile);
    if ((empty(inputFile)) || (empty(inputFile.value)))
        return false;
    if (empty(intFile))
        intFile = 0;
    var strInputFileId = inputFile.getAttribute('id');
    var strInputFileName = inputFile.getAttribute('name');
    var strUrl = strGlobalBasePath + '/inputfile';
    var form = document.createElement('FORM');
    form.setAttribute('action', strUrl);
    form.setAttribute('method', 'POST');
    form.setAttribute('id', 'form_' + strInputFileId);
    form.setAttribute('name', 'form_' + strInputFileName);
    var arrFile = inputFile.files;
    var strInputValue = arrFile[intFile].name;
    createHiddenIntoRepository(form, 'path', 'path', base64Encode(strInputValue));
    var strContentFromInputFile = '';
    if (typeof (FileReader) != 'undefined') {
        var reader = new FileReader();
        reader.onload = function (event) {
            return insertContentIntoForm(form, event.target.result);
        };
        reader.readAsDataURL(inputFile.files.item(intFile));
        return true;
    } else if ((inputFile.files) && (inputFile.files.item(intFile).getAsDataURL))
        strContentFromInputFile = inputFile.files.item(intFile).getAsDataURL();
    else if ((inputFile.files) && (!inputFile.files.item(intFile).getAsDataURL)) {

    } else {
        try {
            strContentFromInputFile = strInputValue;
        } catch (exception) {

        }
    }
    return (strContentFromInputFile !== '') ? insertContentIntoForm(form, strContentFromInputFile) : false;
}

function insertContentIntoForm(mixForm, strContent)
{
    if (empty(mixForm))
        return false;
    var form = getObject(mixForm);
    if (empty(form))
        return false;
    if (!document.all)
        createHiddenIntoRepository(form, 'content', 'content', base64Encode(strContent));
    document.body.appendChild(form);
    form.submit();
    return true;
}

/**
 * Seleciona ou desmarca todos os options do select.
 *
 * @param mix mixSelect
 * @param boolean booSelected
 * @return mix
 */
function selectedAllOption(mixSelect, booSelected)
{
    var select = getObject(mixSelect);
    if (empty(select))
        return false;
    if (!isBoolean(booSelected))
        booSelected = true;
    var arrOption = select.getElementsByTagName('OPTION');
    for (var intCount = 0; intCount < arrOption.length; ++intCount) {
        var option = arrOption[intCount];
        option.selected = booSelected;
    }
    return arrOption;
}

/**
 * Transefere um option de um select para outro select.
 *
 * @param mix mixSelectNotSelectable
 * @param mix mixSelectSelectable
 * @param string strSymbolDirection
 * @param array arrOptionValue
 * @param string strCallback
 * @param string strCallbackCheck
 * @return boolean
 */
function transferOptions(mixSelectNotSelectable, mixSelectSelectable, strSymbolDirection, arrOptionValue, strCallback, strCallbackCheck)
{
    var selectNotSelectable = getObject(mixSelectNotSelectable);
    var selectSelectable = getObject(mixSelectSelectable);
    if ((empty(selectNotSelectable)) || (empty(selectSelectable)))
        return false;
    if (empty(strSymbolDirection))
        strSymbolDirection = '>';
    var arrOptionNotSelectable = selectNotSelectable.getElementsByTagName('OPTION');
    var arrOptionSelectable = selectSelectable.getElementsByTagName('OPTION');
    var arrOptionContainer;
    var selectDestination;
    if (strSymbolDirection.indexOf('<') != -1) {
        arrOptionContainer = arrOptionSelectable;
        selectDestination = selectNotSelectable;
    } else if (strSymbolDirection.indexOf('>') != -1) {
        arrOptionContainer = arrOptionNotSelectable;
        selectDestination = selectSelectable;
    } else
        return false;
    if (!empty(strCallbackCheck)) {
        strCallbackCheck = 'var mixResult = (' + replaceAll(strCallbackCheck, new Array('(', ')', ';'), new Array('', '', '')) + '(selectSelectable, selectNotSelectable));';
        eval(strCallbackCheck);
        if (mixResult === false)
            return false;
    }
    if (!empty(strCallback))
        strCallback = replaceAll(strCallback, new Array('(', ')', ';'), new Array('', '', '')) + '(selectSelectable, selectNotSelectable);';
    if ((strSymbolDirection.length == 1) && (arrOptionContainer.length === 0)) {
        if (!empty(strCallback))
            eval(strCallback);
        return true;
    }
    var intCount;
    var option;
    if (!empty(arrOptionValue)) {
        if (!isArray(arrOptionValue)) {
            var arrOptionValueNew = [];
            arrOptionValueNew[arrOptionValueNew.length] = arrOptionValue;
            arrOptionValue = arrOptionValueNew;
        }
        for (intCount = 0; intCount < arrOptionValue.length; ++intCount) {
            var mixOptionValue = arrOptionValue[intCount];
            for (var intCount2 = 0; intCount2 < arrOptionContainer.length; ++intCount2) {
                option = arrOptionContainer[intCount2];
                var mixValue = captureValueFromElement(option);
                if (mixOptionValue == mixValue)
                    appendUniqueOption(option, selectDestination);
            }
        }
        if (!empty(strCallback))
            eval(strCallback);
        return true;
    }
    var arrOption = [];
    for (intCount = 0; intCount < arrOptionContainer.length; ++intCount) {
        option = arrOptionContainer[intCount];
        if ((option.selected) || (strSymbolDirection.length > 1))
            arrOption[arrOption.length] = option;
    }
    for (intCount = 0; intCount < arrOption.length; ++intCount) {
        option = arrOption[intCount];
        appendUniqueOption(option, selectDestination);
    }
    if (!empty(strCallback))
        eval(strCallback);
    checkElementValueRequired(selectSelectable);
    return true;
}

function appendUniqueOption(option, select)
{
    if ((empty(option)) || (empty(select)))
        return false;
    var arrOption = select.getElementsByTagName('OPTION');
    var booExists = false;
    for (var intCount = 0; intCount < arrOption.length; ++intCount) {
        if (arrOption[intCount].value == option.value) {
            booExists = true;
            arrOption[intCount].selected = false;
            break;
        }
    }
    if (!booExists) {
        select.appendChild(option);
        option.selected = false;
    } else
        $(option).remove();
    return true;
}

/**
 * Seleciona ou desmarca todos os options do select do transfer para uma submissao
 * de formulario.
 *
 * @param boolean booSelected
 * @return void
 */
function managerTransfer(booSelected)
{
    if (!isBoolean(booSelected))
        booSelected = true;
    var arrSelect = document.getElementsByTagName('SELECT');
    for (var intCount = arrSelect.length - 1; intCount >= 0; --intCount) {
        var select = arrSelect[intCount];
        if (document.all) {
            if ((select.getAttribute('multiple') === false) || (select.getAttribute('ondblclick') === false) || (select.getAttribute('ondblclick') === null) || (select.getAttribute('name') === false))
                continue;
        } else {
            if ((select.getAttribute('multiple') === null) || (select.getAttribute('ondblclick') === null) || (select.getAttribute('name') === null))
                continue;
        }
        if (select.getAttribute('ondblclick').toString().indexOf('transferOptions') == -1)
        	continue;
        if ((select.getAttribute('required')) && (select.length === 0))
        	return false;
        if (select.getAttribute('name').indexOf(strGlobalSufixTransferNotSelectable) == -1) {
            if (booSelected) {
                var arrOption = selectedAllOption(select, booSelected);
                if (arrOption.length === 0) {
                    select.disabled = booSelected;
                    createHiddenIntoRepository(getFormByElement(select), select.getAttribute('name') + '[Hidden]', replaceAll(select.getAttribute('name'), '[]', ''), null);
                }
            } else 
            	select.disabled = booSelected;
        } else 
        	select.disabled = booSelected;
    }
    if (booSelected)
        setTimeout(managerTransfer(false), 1000);
}

/**
 * Altera a mascara de um telefone a partir de um numero de DDD.
 *
 * @param mix mixDdd
 * @param mix mixPhone
 * @return boolean
 */
function changeMaskPhoneFromDdd(mixDdd, mixPhone, strParamMask)
{
    var ddd = getObject(mixDdd);
    var phone = getObject(mixPhone);
    if ((empty(ddd)) || (empty(phone)))
        return false;
    var intDigit = 8;
    eval('var arrDdd9Digit = ' + strGlobalListDdd9Digit + ';');
    for (var intCount = 0; intCount < arrDdd9Digit.length; ++intCount) {
        if (ddd.value != arrDdd9Digit[intCount])
            continue;
        intDigit = 9;
    }
    var strPhone = phone.value;
    var intPhone = replaceAll(replaceAll(strPhone, '_', ''), '-', '');
    if ((intDigit == 9) && (intPhone.length >= 9))
        return true;
    var strMask = '';
    for (intCount = 0; intCount < intDigit; ++intCount) {
        if ((intDigit - intCount) == 4)
            strMask += '-';
        strMask += '9';
    }
    include_once('/vendor/jquery-maskedinput/jquery-maskedinput-1.3.1/jquery.maskedinput.js' + strGlobalSufixJsGzip);
    if (intDigit == 9) {
        if (strParamMask.indexOf(strMask) == -1)
            strParamMask = replaceAll(strParamMask, '9999-9999', strMask);
    } else {
        if (strParamMask.indexOf('9' + strMask) != -1)
            strParamMask = replaceAll(strParamMask, '9' + strMask, strMask);
    }
    if (strMask == '99999-9999') {
        strMask = '9999-9999?9';
        strParamMask = replaceAll(strParamMask, '99999-9999', strMask);
    }
    eval('$(phone).mask("' + strMask + '"' + strParamMask + ');');
    return true;
}

function changeMaskPhoneFromNumber(mixDdd, mixPhone, strParamMask)
{
    var ddd = getObject(mixDdd);
    var phone = getObject(mixPhone);
    if ((empty(ddd)) || (empty(phone)))
        return false;
    var intDigit = 8;
    eval('var arrDdd9Digit = ' + strGlobalListDdd9Digit + ';');
    for (var intCount = 0; intCount < arrDdd9Digit.length; ++intCount) {
        if (ddd.value != arrDdd9Digit[intCount])
            continue;
        intDigit = 9;
    }
    if (intDigit == 8)
        return true;
    var strPhone = phone.value;
    var intPhone = replaceAll(replaceAll(strPhone, '_', ''), '-', '');
    if (intPhone.length >= 8) {
        var strMask = '';
        for (intCount = 0; intCount < intDigit; ++intCount) {
            if ((intDigit - intCount) == 4)
                strMask += '-';
            strMask += '9';
        }
        include_once('/vendor/jquery-maskedinput/jquery-maskedinput-1.3.1/jquery.maskedinput.js' + strGlobalSufixJsGzip);
        if (strParamMask.indexOf(strMask) == -1)
            strParamMask = replaceAll(strParamMask, '9999-9999', strMask);
        if (intPhone.length == 8) {
            if (strMask == '99999-9999') {
                strMask = '9999-9999?9';
                strParamMask = replaceAll(strParamMask, '99999-9999', strMask);
            }
            phone.value = intPhone;
        } else if (array_search(strPhone.substr(0, 1), new Array(6, 7, 8, 9)) == -1) {
            if (strMask == '99999-9999') {
                strMask = '9999-9999?9';
                strParamMask = replaceAll(strParamMask, '99999-9999', strMask);
            }
            phone.value = intPhone.substr(0, 8);
        }
        eval('$(phone).mask("' + strMask + '"' + strParamMask + ');');
    }
    return true;
}

function configReadonlyFromValue(element, booReadonly, booForceDisabled)
{
    element = getObject(element);
    if (empty(element))
        return false;
    if (booReadonly) {
        var booDisabled;
        if (isBoolean(booForceDisabled))
            booDisabled = booForceDisabled;
        else
            booDisabled = (($(element).val() !== '') && ($(element).val() != 'null'));
        if ((document.all) && ($(element).val() == 'null'))
            $(element).val('');
        $(element).prop('disabled', booDisabled);
        var parent = element.parentNode;
        var input = $(parent).children('input[type=hidden]');
        if (booDisabled) {
        	var inputHidden;
            if (input.attr('data-ref') != $(element).attr('name')) {
                inputHidden = document.createElement('INPUT');
                inputHidden.setAttribute('type', 'hidden');
                inputHidden.setAttribute('name', $(element).attr('name'));
                inputHidden.setAttribute('data-ref', $(element).attr('name'));
                parent.appendChild(inputHidden);
                inputHidden = $(inputHidden);
            } else {
                input.prop('disabled', false);
                inputHidden = input;
            }
            inputHidden.val($(element).val());
        } else {
            if (input.attr('data-ref') == $(element).attr('name'))
                input.prop('disabled', true);
        }
    }
    return true;
}

function nextTabindex(element)
{
    element = getObject(element);
    if ((isObject(element)) && (!empty(element.getAttribute('tabindex')))) {
        var form = getFormByElement(element);
        if (!empty(form)) {
            $(form).find(':input[tabindex=' + (parseInt(element.getAttribute('tabindex')) + 1) + ']').focus();
            return true;
        }
    }
    return false;
}/**
 * Retorna o objeto XML apartir de uma string deste padrao
 * 
 * @param STRING strXml
 * @return OBJECT
 */
function loadXMLString(strXml)
{
    if (empty(strXml))
        strXml = '';
    var xml;
    if (window.DOMParser) {
        var DOMParser = new DOMParser();
        return DOMParser.parseFromString(strXml, 'text/xml');
    }
    if (window.ActiveXObject) {
        xml = new ActiveXObject('Microsoft.XMLDOM');
        xml.async = 'false';
        xml.loadXML(strXml);
        return xml;
    }
    if ((document.implementation) && (document.implementation.createDocument)) {
        xml = document.implementation.createDocument('', '', null);
        xml.async = false;
        xml.load(strXml);
        return xml;
    }
    alert('Seu navegador nao esta apto a ler um arquivo XML');
    return;
}

/**
 * Retorna o objeto Element do XML, apartir de uma string que se refere a tag do nodo
 * 
 * @param OBJECT xml
 * @param STRING strNodeName
 * @return MIX
 */
function getNodeXml(xml, strNodeName)
{
    var arrHtmlCollection = xml.getElementsByTagName(strNodeName);
    if ((empty(arrHtmlCollection)) || (empty(arrHtmlCollection[0])))
        return;
    var arrResult = [];
    for (var intCount = 0; intCount < arrHtmlCollection.length; ++intCount)
        arrResult[arrResult.length] = arrHtmlCollection[intCount];
    return (arrResult.length == 1) ? arrResult[0] : arrResult;
}

/**
 * Retorna o valor do objeto Element do XML, apartir de uma string que se refere a tag do nodo
 * 
 * @param OBJECT xml
 * @param STRING strNodeName
 * @return MIX
 */
function getNodeValueXml(xml, strNodeName)
{
    var mixResult = getNodeXml(xml, strNodeName);
    if (empty(mixResult))
        return;
    var arrResult = [];
    for (var intCount = 0; intCount < mixResult.childNodes.length; ++intCount) {
        var childNode = mixResult.childNodes[intCount];
        if ((childNode.nodeType == 3) && ((empty(childNode.data)) || (childNode.data == ' ') || (childNode.data == '\n')))
            continue;
        arrResult[arrResult.length] = (childNode.nodeType == 3) ? childNode.data : childNode;
    }
    return (arrResult.length == 1) ? arrResult[0] : arrResult;
}function validateCpf(strCpf, booShowValidate, inputCpf)
{
    if (empty(booShowValidate))
        booShowValidate = true;
    strCpf = replaceAll(strCpf, '.', '');
    strCpf = replaceAll(strCpf, '-', '');
    strCpf = replaceAll(strCpf, '/', '');
    var strMessage = 'CPF inválido.';
    var intDigitosIguais = 1;
    if (strCpf.length < 11) {
        validateDialog(strMessage, booShowValidate);
        return false;
    }
    for (var intCount = 0; intCount < strCpf.length - 1; ++intCount) {
        if (strCpf.charAt(intCount) != strCpf.charAt((intCount + 1))) {
            intDigitosIguais = 0;
            break;
        }
    }
    if (!intDigitosIguais) {
        var intNumeros = strCpf.substring(0, 9);
        var intDigitos = strCpf.substring(9);
        var intSoma = 0;
        for (intCount = 10; intCount > 1; --intCount)
            intSoma += intNumeros.charAt((10 - intCount)) * intCount;
        var intResultado = intSoma % 11 < 2 ? 0 : 11 - intSoma % 11;
        if (intResultado != intDigitos.charAt(0)) {
            validateDialog(strMessage, booShowValidate);
            return false;
        }
        intNumeros = strCpf.substring(0, 10);
        intSoma = 0;
        for (intCount = 11; intCount > 1; --intCount)
            intSoma += intNumeros.charAt((11 - intCount)) * intCount;
        intResultado = intSoma % 11 < 2 ? 0 : 11 - intSoma % 11;
        if (intResultado != intDigitos.charAt(1)) {
            validateDialog(strMessage, booShowValidate);
            return false;
        }
        nextTabindex(inputCpf);
        return true;
    }
    validateDialog(strMessage, booShowValidate);
    return false;
}

function validateCnpj(strCnpj, booShowValidate, inputCnpj)
{
    if (empty(booShowValidate))
        booShowValidate = true;
    strCnpj = replaceAll(strCnpj, '.', '');
    strCnpj = replaceAll(strCnpj, '-', '');
    strCnpj = replaceAll(strCnpj, '/', '');
    var strMessage = 'CNPJ inválido.';
    var intDigitosIguais = 1;
    if (strCnpj.length != 14) {
        validateDialog(strMessage, booShowValidate);
        return false;
    }
    for (var intCount = 0; intCount < strCnpj.length - 1; ++intCount) {
        if (strCnpj.charAt(intCount) != strCnpj.charAt((intCount + 1))) {
            intDigitosIguais = 0;
            break;
        }
    }
    if (!intDigitosIguais) {
        var intTamanho = strCnpj.length - 2;
        var intNumeros = strCnpj.substring(0, intTamanho);
        var intDigitos = strCnpj.substring(intTamanho);
        var intSoma = 0;
        var intPos = intTamanho - 7;
        for (intCount = intTamanho; intCount >= 1; --intCount) {
            intSoma += intNumeros.charAt((intTamanho - intCount)) * intPos--;
            if (intPos < 2)
                intPos = 9;
        }
        var intResultado = intSoma % 11 < 2 ? 0 : 11 - intSoma % 11;
        if (intResultado != intDigitos.charAt(0)) {
            validateDialog(strMessage, booShowValidate);
            return false;
        }
        intTamanho = intTamanho + 1;
        intNumeros = strCnpj.substring(0, intTamanho);
        intSoma = 0;
        intPos = intTamanho - 7;
        for (intCount = intTamanho; intCount >= 1; --intCount) {
            intSoma += intNumeros.charAt(intTamanho - intCount) * intPos--;
            if (intPos < 2)
                intPos = 9;
        }
        intResultado = intSoma % 11 < 2 ? 0 : 11 - intSoma % 11;
        if (intResultado != intDigitos.charAt(1)) {
            validateDialog(strMessage, booShowValidate);
            return false;
        }
        nextTabindex(inputCnpj);
        return true;
    }
    validateDialog(strMessage, booShowValidate);
    return false;
}

function validatePisPasep(strPisPasep, booShowValidate, inputPisPasep)
{
    if (empty(strPisPasep))
        return false;
    if (!isBoolean(booShowValidate))
        booShowValidate = true;
    strPisPasep = replaceAll(strPisPasep, '.', '');
    strPisPasep = replaceAll(strPisPasep, '-', '');
    var strMessage = 'PIS/PASEP inexistente!';
    var strKey = '3298765432';
    var intTotal = 0;
    var intResto = 0;
    var strResto = '';
    var intDigitosIguais = 1;
    for (var intCount = 0; intCount < strPisPasep.length - 1; ++intCount) {
        if (strPisPasep.charAt(intCount) != strPisPasep.charAt((intCount + 1))) {
            intDigitosIguais = 0;
            break;
        }
    }
    if (!intDigitosIguais) {
        for (intCount = 0; intCount <= 9; ++intCount) {
            var intResultado = (strPisPasep.slice(intCount, (intCount + 1))) * (strKey.slice(intCount, (intCount + 1)));
            intTotal = intTotal + intResultado;
        }
        intResto = (intTotal % 11);
        if (intResto !== 0)
            intResto = (11 - intResto);
        if ((intResto == 10) || (intResto == 11)) {
            strResto = intResto + '';
            intResto = strResto.slice(1, 2);
        }
        if (intResto != (strPisPasep.slice(10, 11))) {
            validateDialog(strMessage, booShowValidate);
            return false;
        }
        nextTabindex(inputPisPasep);
        return true;
    }
    validateDialog(strMessage, booShowValidate);
    return false;
}

function validateDateBissexto(strDate, booShowValidate, inputDate)
{
    if (empty(strDate))
        return false;
    var booHasTime = (strDate.indexOf(':') != -1);
    var strMessage = (booHasTime) ? 'Data/Hora inválida!' : 'Data inválida!';
    if ((strDate.indexOf('00/') === 0) && (booShowValidate === true)) {
        validateDialog(strMessage, booShowValidate);
        return false;
    }
    if (!isBoolean(booShowValidate))
        booShowValidate = true;
    var arrDate = strDate.split(/[/-]/);
    var intYear = parseInt(arrDate[2]);
    var booValidate = true;
    if ((parseInt(arrDate[1]) == 2) && (parseInt(arrDate[0]) > 28))
        booValidate = ((intYear % 4 === 0) && ((intYear % 100 !== 0) || (intYear % 400 === 0)));
    if ((!booValidate) && (booShowValidate === true))
        validateDialog(strMessage, booShowValidate);
    return booValidate;
}

/**
 * Metodo responsavel por tratar a data minima e maxima do componente date range.
 *
 * @param string strIdfield
 * @returns boolean
 */
function validateDateRange(strIdfield)
{
    var field = getObject(strIdfield);
    var strDate = field.value;
    if ((empty(field)) || (empty(strDate)) || (strDate.indexOf('_') != -1))
        return false;
    var fieldJquery = $('#' + strIdfield);
    var strMinDate = convertDate(fieldJquery.datepicker('option', 'minDate'), 'd/m/Y');
    var strMaxDate = convertDate(fieldJquery.datepicker('option', 'maxDate'), 'd/m/Y');
    if ((!compareDatesValues(strMinDate, strDate)) || (!compareDatesValues(strDate, strMaxDate))) {
        field.value = '';
        return false;
    }
    return true;
}

function validatePhone(strPhone, booShowValidate, inputPhone)
{
    if ((empty(strPhone)) || (empty(inputPhone)) || (!isObject(inputPhone)))
        return false;
    if (!empty(inputPhone.context))
        inputPhone = inputPhone.context;
    var selectDdd = getObject(strGlobalPrefixDdd + inputPhone.getAttribute('id'));
    if (empty(selectDdd))
        return true;
    var intDdd = selectDdd.value;
    if (intDdd === '')
        return true;
    var intPhone = replaceAll(strPhone, '-', '');
    if (!isBoolean(booShowValidate))
        booShowValidate = true;
    var strMessage = 'Formato inválido!';
    var arrDdd = [];
    var arrOption = selectDdd.getElementsByTagName('OPTION');
    for (var intCount = 0; intCount < arrOption.length; ++intCount) {
        var mixValue = arrOption[intCount].value;
        if (mixValue === '')
            continue;
        arrDdd[arrDdd.length] = parseInt(arrOption[intCount].value);
    }
    eval('var arrDdd9Digit = ' + strGlobalListDdd9Digit + ';');
    var intDigit = 8;
    for (intCount = 0; intCount < arrDdd9Digit.length; ++intCount) {
        if (intDdd == arrDdd9Digit[intCount]) {
            intDigit = 9;
            break;
        }
    }
    var booValidate = (intPhone.length == intDigit);
    if ((!booValidate) && (booShowValidate === true))
        validateDialog(strMessage, booShowValidate);
    if (booValidate)
        nextTabindex(inputPhone);
    return booValidate;
}

var strGlobalCheckValue;
function checkValue(strValue, strType, booShowValidate, input)
{
    if (strGlobalCheckValue == strValue)
        return true;
    strGlobalCheckValue = strValue;
    var strRegex;
    switch (strType) {
        case 'hour':
            strRegex = /^\d{2}:\d{2}/;
            break;
        case 'date':
            strRegex = /^(?:(?:0[1-9]|[12]\d|3[01])\/(?:01|03|05|07|08|10|12)|(?:[0-2]\d|30)\/(?:04|06|09|11)|(?:[0-1]\d|2[0-9])\/02)\/(?:19\d{2}|20\d{2})/;
            break;
        case 'dateTime':
            strRegex = /^(?:(?:0[1-9]|[12]\d|3[01])\/(?:01|03|05|07|08|10|12)|(?:[0-2]\d|30)\/(?:04|06|09|11)|(?:[0-1]\d|2[0-9])\/02)\/(?:19\d{2}|20\d{2}) \d{2}:\d{2}/;
            break;
        case 'cpf':
            strRegex = /\d{3}.\d{3}.\d{3}-\d{2}/;
            break;
        case 'cnpj':
            strRegex = /\d\d\.\d\d\d\.\d\d\d\/\d\d\d\d\-\d\d/;
            break;
        case 'pispasep':
            strRegex = /\d{3}.\d{5}.\d{2}-\d{1}/;
            break;
        case 'cpfCnpj':
            strRegex = /^\d+$/;
            break;
        case 'cep':
            strRegex = /\d\d\d\d\d\-\d\d\d/;
            break;
        case 'integer':
            strRegex = /^\d+$/;
            break;
        case 'phone8':
            strRegex = /\d\d\d\d\-\d\d\d\d/;
            break;
        case 'phone9':
            strRegex = /\d\d\d\d\d\-\d\d\d\d/;
            break;
        case 'phone':
            strRegex = /(\d\d\d\d\-\d\d\d\d)|(\d\d\d\d\d\-\d\d\d\d)/;
            break;
        case 'email':
            if (strValue === '')
                return true;
            strRegex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
            break;
        default:
            return false;
    }
    switch (strType) {
        case 'date':
        case 'dateTime':
            if ((strValue.indexOf('_') === 0) || (strValue === ''))
                return true;
            break;
    }
    if (strValue.match(strRegex)) {
        switch (strType) {
            case 'cpf':
                return validateCpf(strValue, booShowValidate, input);
            case 'cnpj':
                return validateCnpj(strValue, booShowValidate, input);
            case 'pispasep':
                return validatePisPasep(strValue, booShowValidate, input);
            case 'date':
            case 'dateTime':
                return validateDateBissexto(strValue, booShowValidate, input);
            case 'phone8':
            case 'phone9':
                return validatePhone(strValue, booShowValidate, input);
        }
    } else {
        if (booShowValidate === true) {
        	var strMessage;
            switch (strType) {
                case 'date':
                    strMessage = 'Data inválida!';
                    break;
                case 'dateTime':
                    strMessage = 'Data/Hora inválida!';
                    break;
                case 'email':
                    strMessage = 'e-Mail inválido!';
                    break;
                default:
                    strMessage = 'Formato inválido!';
                    break;
            }
            var strEval = (input.getAttribute('id') !== '') ? 'setTimeout(\'document.getElementById("' + input.getAttribute('id') + '").focus();\', 100);' : '';
            validateDialog(strMessage, booShowValidate, strEval);
        }
        return false;
    }
    return true;
}

function validateValueMask(input, strMask, booShowValidate, strType)
{
    if (!isObject(input))
        input = getObject(input);
    if (!isObject(input))
        return false;
    if (empty(strMask))
        strMask = '';
    if (strMask == '999.999.999-99')
        strType = 'cpf';
    else if (strMask == '99.999.999/9999-99')
        strType = 'cnpj';
    else if (strMask == '999.99999.99-9')
        strType = 'pispasep';
    else if (strMask == '99/99/9999')
        strType = 'date';
    else if (strMask == '99/99/9999 99:99')
        strType = 'dateTime';
    else if (strMask == '9999-9999')
        strType = 'phone8';
    else if (strMask == '99999-9999')
        strType = 'phone9';
    else if ((strMask == '9999-9999?9') || (strMask == '99999-999?9'))
        strType = 'phone';
    else if (strMask == '@.')
        strType = 'email';
    if (empty(strType))
        return false;
    var mixValue;
    var booVal = false;
    try {
        mixValue = input.val();
        booVal = true;
    } catch (exception) {
        mixValue = input.value;
    }
    if (!checkValue(mixValue, strType, booShowValidate, input)) {
        if (strMask.indexOf('9') != -1) {
            var strValue = replaceAll(replaceAll(strMask, '9', '_'), '?', '_');
            if (booVal)
                input.val(strValue);
            else
                input.value = strValue;
        } else if (strMask.indexOf('@.') != -1)
            input.value = '';
        return false;
    }
    return true;
}/**
 * Remove os espacos em branco dos extremos de um string
 *
 * @param STRING strText
 * @return STRING
 */
function trim(strText)
{
//    return ((!strText) ? "" : strText.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1"));
    return ((!strText) ? '' : strText.replace(/^\s*/, '').replace(/\s*$/, ''));
}

/**
 * Insere o primeiro caracter de uma string em caixa alta
 *
 * @param STRING strText
 * @return STRING
 */
function ucfirst(strText)
{
//    return ((!strText) ? '' : strText.substr(0, 1).toUpperCase() + strText.substr(1).toLowerCase());
    return ((!strText) ? '' : strText.substr(0, 1).toUpperCase() + strText.substr(1));
}

/**
 * Insere o primeiro caracter de uma string em caixa baixa
 *
 * @param STRING strText
 * @return STRING
 */
function lcfirst(strText)
{
    return ((!strText) ? '' : strText.substr(0, 1).toLowerCase() + strText.substr(1));
}

/**
 * Substitui todas as ocorrencias de um texto (ou array de textos) por outro
 *
 * @param STRING strText
 * @param MIX mixFinder
 * @param STRING strReplacer
 * @return STRING
 */
function replaceAll(strText, mixFinder, strReplacer)
{
    if (isArray(mixFinder)) {
        for (var intCount = 0; intCount < mixFinder.length; ++intCount)
            strText = replaceRegex(strText, mixFinder[intCount], strReplacer);
    } else
        strText = replaceRegex(strText, mixFinder, strReplacer);
    return strText;
}

/**
 * Substitui todas as ocorrencias de um texto por outro
 *
 * @param STRING strText
 * @param STRING strFinder
 * @param STRING strReplacer
 * @return STRING
 */
function replaceRegex(strText, strFinder, strReplacer)
{
    if ((empty(strText)) || (empty(strFinder)) || (strReplacer === undefined) || (strReplacer === null))
        return;
    strText += '';
    var strSpecials = /(\.|\*|\^|\?|\&|\$|\+|\-|\#|\!|\(|\)|\[|\]|\{|\}|\|)/gi;
    strFinder = strFinder.replace(strSpecials, '\\$1');
    var regExp = new RegExp(strFinder, 'gi');
    return strText.replace(regExp, strReplacer);
}

/**
 * Funcao que trunca a expressao em determinado numero de caracteres
 *
 * @param STRING strText
 * @param INTEGER intChar
 * @param STRING strComplement
 * @param BOOLEAN booSpace
 * @return STRING
 */
function truncate(strText, intChar, strComplement, booSpace)
{
    var strResult = '';
    var intLastSpace = 0;
    if (empty(strText))
        strText = '';
    if (empty(intChar))
        intChar = 0;
    if (empty(strComplement))
        strComplement = '';
    if (!isBoolean(booSpace))
        booSpace = true;
    var arrText = explode('', strText);
    for (var intCount = 0; intCount < arrText.length; ++intCount) {
        if (intCount < intChar) {
            strResult += arrText[intCount];
            if (arrText[intCount] == ' ')
                intLastSpace = intCount;
        } else
            break;
    }
    if (intChar <= strText.length) {
        if (booSpace)
            strResult = strResult.substr(0, intLastSpace);
        strResult += strComplement;
    }
    return strResult;
}

/**
 * Repete o caracter x vezes
 *
 * @param STRING strText
 * @param INTEGER intRepeat
 * @return STRING
 */
function str_repeat(strText, intRepeat)
{
    var strReturn = '';
    for (var intCount = 0; intCount < intRepeat; ++intCount)
        strReturn += strText;
    return strReturn;
}

/**
 * Substitui alguns caracteres especiais
 *
 * @param STRING strText
 * @return STRING
 */
function str_slice(strText)
{
    var strReturn = strText;
    strReturn = replaceAll(strText, "\"", "\\\\\"");
//    strReturn = replaceAll(strReturn, "\'", "\\\'");
    return strReturn;
}

/**
 * Substitui alguns caracteres especiais e retorna em uma linha
 *
 * @param STRING strText
 * @return STRING
 */
function str_slice_line(strText)
{
    var strReturn = str_slice(strText);
//    strReturn = replaceAll(strReturn, "\n", "\\n ");
    strReturn = replaceAll(strReturn, '\n', ' ');
    return strReturn;
}

/**
 * Encontra a posicao da ultima ocorrencia de um caractere em uma string
 * 
 * @param STRING strText
 * @param STRING strFinder
 * @param INTEGER intOffset
 * @return MIX
 */
function strrpos(strText, strFinder, intOffset)
{
    var intCount = -1;
    if (intOffset) {
        intCount = (strText + '').slice(intOffset).lastIndexOf(strFinder);
        if (intCount !== -1)
            intCount += intOffset;
    } else
        intCount = (strText + '').lastIndexOf(strFinder);
    return intCount >= 0 ? intCount : false;
}

function str_pad(strText, intPadLength, strPad, strPadType) {
    var strHalf = '', strPadToGo;
    var str_pad_repeater = function (strValue, intLen) {
        var strCollection = '', i;
        while (strCollection.length < intLen)
            strCollection += strValue;
        strCollection = strCollection.substr(0, intLen);
        return strCollection;
    };
    strText += '';
    strPad = strPad !== undefined ? strPad : ' ';
    if ((strPadType !== 'STR_PAD_LEFT') && (strPadType !== 'STR_PAD_RIGHT') && (strPadType !== 'STR_PAD_BOTH'))
        strPadType = 'STR_PAD_RIGHT';
    if ((strPadToGo = intPadLength - strText.length) > 0) {
        if (strPadType === 'STR_PAD_LEFT')
            strText = str_pad_repeater(strPad, strPadToGo) + strText;
        else if (strPadType === 'STR_PAD_RIGHT')
            strText = strText + str_pad_repeater(strPad, strPadToGo);
        else if (strPadType === 'STR_PAD_BOTH') {
            strHalf = str_pad_repeater(strPad, Math.ceil(strPadToGo / 2));
            strText = strHalf + strText + strHalf;
            strText = strText.substr(0, intPadLength);
        }
    }
    return strText;
}

/**
 * Retorna o valor ASCII de um determinado caracter
 * 
 * @param STRING strCarac
 * @return MIX
 */
function ord(strCarac)
{
    strCarac = strCarac + '';
    var code = strCarac.charCodeAt(0);
    if ((0xD800 <= code) && (code <= 0xDBFF)) {
        var hi = code;
        if (strCarac.length === 1)
            return code;
        var low = strCarac.charCodeAt(1);
        return ((hi - 0xD800) * 0x400) + (low - 0xDC00) + 0x10000;
    }
    return code;
}

/**
 * Limpa determinado texto, retirando caracteres desnecessarios
 * 
 * @param STRING strText
 * @param STRING strChars
 * @param BOOLEAN booAcceptChar
 * @return STRING
 */
function clearText(strText, strChars, booAcceptChar)
{
    if (empty(strText))
        return false;
    if (!isBoolean(booAcceptChar))
        booAcceptChar = true;
    var strSymbol = (booAcceptChar === true) ? '!=' : '==';
    var strResult = '';
    for (var intCount = 0; intCount < strText.length; ++intCount)
        eval('if (strChars.indexOf(strText.charAt(intCount)) ' + strSymbol + ' -1) strResult += strText.charAt(intCount);');
    return strResult;
}

/**
 * Edita uma string para o formato dasherize
 *
 * @param STRING strText
 * @return STRING
 */
function dasherize(strText)
{
    var intPos = 0;
    while (intPos < strText.length) {
        var strCarac = strText[intPos];
        var intAscii = ord(strCarac);
        if ((!empty(strCarac)) && (strCarac == strCarac.toUpperCase()) && (((intAscii >= 48) && (intAscii <= 57)) || ((intAscii >= 65) && (intAscii <= 90)) || ((intAscii >= 97) && (intAscii <= 122)))) {
            strText = strText.substr(0, intPos) + strCarac.toLowerCase() + strText.substr(intPos + 1);
            if (intPos !== 0)
                strText = strText.substr(0, intPos) + '-' + strText.substr(intPos);
        }
        ++intPos;
    }
    strText = replaceAll(strText, new Array('_', ' ', '--'), '-');
    return strText.toLowerCase();
}

/**
 * Edita uma string para o formato camelize
 *
 * @param STRING strText
 * @return STRING
 */
function camelize(strText)
{
    strText = replaceAll(ucfirst(strText), new Array('_', ' '), '-');
    var intPos = strText.indexOf('-');
    while (intPos != -1) {
        strText = strText.substr(0, intPos) + strText.substr(intPos + 1);
        var strCarac = strText[intPos];
        if (!empty(strCarac))
            strText = strText.substr(0, intPos) + strCarac.toUpperCase() + strText.substr(intPos + 1);
        intPos = strText.indexOf('-');
    }
    return strText;
}

/**
 * Aplica o base64_encode em uma string
 *
 * @param STRING strText
 * @return STRING
 */
function base64Encode(strText)
{
    if ((!window.btoa) || (strText.indexOf('°') != -1)) {
        var strKey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var strOutput = '';
        var strChr1, strChr2, strChr3;
        var strEnc1, strEnc2, strEnc3, strEnc4;
        var intCount = 0;
        do
        {
            strChr1 = strText.charCodeAt(intCount++);
            strChr2 = strText.charCodeAt(intCount++);
            strChr3 = strText.charCodeAt(intCount++);
            strEnc1 = strChr1 >> 2;
            strEnc2 = ((strChr1 & 3) << 4) | (strChr2 >> 4);
            strEnc3 = ((strChr2 & 15) << 2) | (strChr3 >> 6);
            strEnc4 = strChr3 & 63;
            if (isNaN(strChr2))
                strEnc3 = strEnc4 = 64;
            else if (isNaN(strChr3))
                strEnc4 = 64;
            strOutput = strOutput + strKey.charAt(strEnc1) + strKey.charAt(strEnc2) + strKey.charAt(strEnc3) + strKey.charAt(strEnc4);
        }
        while (intCount < strText.length);
        return strOutput;
    }
    include_once('/vendor/jquery-base64/jquery-base64-0.1/jquery.base64.min.js' + strGlobalSufixJsGzip);
    return $.base64.btoa(strText, true);
}

/**
 * Aplica o base64_decode em uma string
 *
 * @param STRING strText
 * @return STRING
 */
function base64Decode(strText)
{
    if (!window.atob) {
        var strKey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var strOutput = '';
        var strChr1, strChr2, strChr3;
        var strEnc1, strEnc2, strEnc3, strEnc4;
        var intCount = 0;
        strText = strText.replace(/[^A-Za-z0-9\+\/\=]/g, '');
        do
        {
            strEnc1 = strKey.indexOf(strText.charAt(intCount++));
            strEnc2 = strKey.indexOf(strText.charAt(intCount++));
            strEnc3 = strKey.indexOf(strText.charAt(intCount++));
            strEnc4 = strKey.indexOf(strText.charAt(intCount++));
            strChr1 = (strEnc1 << 2) | (strEnc2 >> 4);
            strChr2 = ((strEnc2 & 15) << 4) | (strEnc3 >> 2);
            strChr3 = ((strEnc3 & 3) << 6) | strEnc4;
            strOutput = strOutput + String.fromCharCode(strChr1);
            if (strEnc3 != 64)
                strOutput = strOutput + String.fromCharCode(strChr2);
            if (strEnc4 != 64)
                strOutput = strOutput + String.fromCharCode(strChr3);
        }
        while (intCount < strText.length);
        return strOutput;
    }
    include_once('/vendor/jquery-base64/jquery-base64-0.1/jquery.base64.min.js' + strGlobalSufixJsGzip);
    return $.base64.atob(strText);
}

/**
 * Funcao responsavel em remover os acentos.
 *
 * @param string strWord
 * @return string
 */
function clearWord(strWord)
{
    strWord = strWord.replace(/[á|ã|â|à|ä]/gi, 'a');
    strWord = strWord.replace(/[Á|Ã|Â|À|Ä]/gi, 'A');
    strWord = strWord.replace(/[é|ê|è|ë]/gi, 'e');
    strWord = strWord.replace(/[É|Ê|È|Ë]/gi, 'E');
    strWord = strWord.replace(/[í|ì|î|ï]/gi, 'i');
    strWord = strWord.replace(/[Í|Ì|Î|Ï]/gi, 'I');
    strWord = strWord.replace(/[õ|ò|ó|ô|ö]/gi, 'o');
    strWord = strWord.replace(/[Õ|Ò|Ó|Ô|Ö]/gi, 'O');
    strWord = strWord.replace(/[ú|ù|û|ü]/gi, 'u');
    strWord = strWord.replace(/[Ú|Ù|Û|Ü]/gi, 'U');
    strWord = strWord.replace(/[ç]/gi, 'c');
    strWord = strWord.replace(/[Ç]/gi, 'Ç');
    strWord = strWord.replace(/[ñ]/gi, 'n');
    strWord = strWord.replace(/[Ñ]/gi, 'N');
    return strWord;
}/**
 * Imprime determinado texto
 *
 * @param STRING strMessage
 * @return BOOLEAN
 */
var strGlobalMessage = '';
function printMessage(strMessage)
{
    if (empty(strMessage))
        return false;
    var strIdIframe = 'iframeToPrintMessage';
    strGlobalMessage = strMessage;
    var iframeToPrint = document.getElementById(strIdIframe);
    if (empty(iframeToPrint)) {
        var strHtmlIframe = "<IFRAME frameborder='0' id='" + strIdIframe + "' name='" + strIdIframe + "' style='width:0px; height:0px; border:0px; float:left;'></IFRAME>";
        document.body.innerHTML = strHtmlIframe + document.body.innerHTML;
        iframeToPrint = document.getElementById(strIdIframe);
        setTimeout(printMessage(strGlobalMessage), 100);
        return false;
    }
    eval('parent.' + strIdIframe + '.document.body.innerHTML = "";');
    if (document.all) {
        eval('parent.' + strIdIframe + '.document.body.innerHTML = strGlobalMessage;');
        setTimeout("frames['" + strIdIframe + "'].focus(); frames['" + strIdIframe + "'].print();", 500);
    } else {
        parent.document.getElementById(strIdIframe).contentDocument.body.innerHTML = strGlobalMessage;
        setTimeout("frames['" + strIdIframe + "'].print();", 500);
    }
    return true;
}/**
 * Abre uma janela popup com dimensoes de tela cheia
 * 
 * @param STRING strUrl
 * @param STRING strWindowName
 * @param STRING strJsExecOnClose
 * @return MIX
 */
function popupFull(strUrl, strWindowName, strJsExecOnClose)
{
    var strComplement = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=1,resizable=no,copyhistory=1,width=' + screen.availWidth + ',height=' + screen.availHeight + ',top=0,left=0';
    return popup(strUrl, strWindowName, strComplement, strJsExecOnClose);
}

/**
 * Abre uma janela popup
 * 
 * @param STRING strUrl
 * @param STRING strWindowName
 * @param STRING strComplement
 * @param STRING strJsExecOnClose
 * @return MIX
 */
function popup(strUrl, strWindowName, strComplement, strJsExecOnClose)
{
    if ((empty(strUrl)) || (empty(strWindowName)))
        return false;
    if (empty(strComplement))
        strComplement = 'scrollbars=yes,resizable=yes,width=1017,height=460';
    var windowOpen = window.open(strUrl, strWindowName, strComplement);
    checkPopupExists(windowOpen, strJsExecOnClose);
    try {
        windowOpen.focus(windowOpen.name);
    } catch (exception) {

    }
    return windowOpen;
}

/**
 * Abre uma janela popup modal
 * 
 * @param STRING strUrl
 * @param STRING strWindowName
 * @param STRING strComplement
 * @param STRING strJsExecOnClose
 * @return MIX
 */
function popupModal(strUrl, strWindowName, strComplement, strJsExecOnClose)
{
    var windowOpen = popup(strUrl, strWindowName, strComplement, strJsExecOnClose);
    if (!windowOpen)
        return false;
//    openBackground();
    return true;
}

var intGlobalIntervalPopup;
var windowGlobalPopup;
var strGlobalJsExecOnClosePopup;
function checkPopupExists(windowOpen, strJsExecOnClose)
{
    if ((empty(windowOpen)) || (!isObject(windowOpen)))
        return false;
    intGlobalIntervalPopup = setInterval(checkPopupExistsInterval, 1000);
    windowGlobalPopup = windowOpen;
    strGlobalJsExecOnClosePopup = strJsExecOnClose;
    return true;
}

function checkPopupExistsInterval()
{
    try {
        var strHref = windowGlobalPopup.location.href;
        if (empty(strHref))
            throw 'Exception';
    }
    catch (exception) {
        if (!empty(intGlobalIntervalPopup)) {
            clearInterval(intGlobalIntervalPopup);
//            closeBackground();
            if (!empty(strGlobalJsExecOnClosePopup))
                eval(strGlobalJsExecOnClosePopup);
            intGlobalIntervalPopup = null;
            windowGlobalPopup = null;
            strGlobalJsExecOnClosePopup = null;
        }
    }
    return true;
}/**
 * Confere se o parametro e externo do javascript
 *
 * @param OBJECT element
 * @return BOOLEAN
 */
function isAlien(element)
{
    return isObject(element) && typeof element.constructor != 'function';
}

/**
 * Confere se o parametro enviado e um array
 *
 * @param MIX array
 * @return BOOLEAN
 */
function isArray(array)
{
    return isObject(array) && array.constructor == Array;
}

/**
 * Confere se o objeto enviado e um boleano
 *
 * @param MIX boolean
 * @return BOOLEAN
 */
function isBoolean(boolean)
{
    return typeof boolean == 'boolean';
}

/**
 * Confere se o objeto enviado e vazio
 *
 * @param OBJECT element
 * @return BOOLEAN
 */
function isEmpty(element)
{
    var strProperty, mixValue;
    if (isObject(element)) {
        for (strProperty in element) {
            mixValue = element[strProperty];
            if ((isUndefined(mixValue)) && (isFunction(mixValue)))
                return false;
        }
    }
    return true;
}

/**
 * Confere se o parametro enviado e uma funcao
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isFunction(mixElement)
{
    return typeof mixElement == 'function';
}

/**
 * Confere se existe funcao com o nome informado
 *
 * @param STRING strNameFunction
 * @return BOOLEAN
 */
function existFunction(strNameFunction)
{
    return (!empty(window[strNameFunction])) ? isFunction(window[strNameFunction]) : false;
}

/**
 * Confere se o parametro enviado e nulo
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isNull(mixElement)
{
    return typeof mixElement == 'object' && !mixElement;
}

/**
 * Confere se o parametro enviado e um numero
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isNumber(mixElement)
{
    return typeof mixElement == 'number' && isFinite(mixElement);
}

/**
 * Confere se o parametro enviado e numerico
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isNumeric(mixElement)
{
    var strWhitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    return (typeof mixElement === 'number' || (typeof mixElement === 'string' && strWhitespace.indexOf(mixElement.slice(-1)) === -1)) && mixElement !== '' && !isNaN(mixElement);
}

/**
 * Confere se o elemento enviado e um objeto
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isObject(mixElement)
{
    return (mixElement && typeof mixElement == 'object') || isFunction(mixElement);
}

/**
 * Confere se o elemento enviado e um texto
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isString(mixElement)
{
    return typeof mixElement == 'string';
}

/**
 * Confere se o elemento enviado e indefinido
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function isUndefined(mixElement)
{
    return typeof mixElement == 'undefined';
}

/**
 * Confere se o elemento enviado e vazio
 *
 * @param MIX mixValue
 * @return BOOLEAN
 */
function empty(mixValue)
{
    return ((mixValue === undefined) || (mixValue === null) || (mixValue === false) || (mixValue === '') || (mixValue === 0));
}

/**
 * Insere elementos em outro (tratando erro no ie principalmente com o innerHTML para tbody)
 *
 * @param MIX mixRepository
 * @param STRING strText
 * @param BOOLEAN booClear
 * @param STRING strTagNameInText
 * @return BOOLEAN
 */
function innerHTMLsuper(mixRepository, strText, booClear, strTagNameInText)
{
    if ((empty(mixRepository)) || (empty(strText)))
        return false;
    if (!isBoolean(booClear))
        booClear = true;
    if (!empty(strTagNameInText))
        strTagNameInText = strTagNameInText.toUpperCase();
    var repository;
    var strIdRepository;
    var strOpener = '';
    if (isObject(mixRepository)) {
        repository = mixRepository;
        strIdRepository = repository.id;
        strOpener = (empty(document.getElementById(strIdRepository))) ? 'opener.' : '';
    } else {
        repository = document.getElementById(mixRepository);
        if (empty(repository)) {
            strOpener = 'opener.';
            repository = opener.document.getElementById(mixRepository);
            if (empty(repository))
                return false;
        }
        strIdRepository = repository.id;
    }
    var strTextBackup;
    if (repository.tagName.toLowerCase() == 'tbody') {
        var strRepositoryBackup = replaceAll(new Array(' ', '/\n', '/\t'), '', trim(repository.innerHTML));
        strTextBackup = replaceAll(new Array(' ', '/\n', '/\t'), '', trim(strText));
        if (strTextBackup.indexOf('<') != -1) {
            if ((strTextBackup.substring(strTextBackup.indexOf('<'), 4).toUpperCase() == '<TAB') || (strTextBackup.substring(strTextBackup.indexOf('<'), 4).toUpperCase() == '<DIV')) {
                var strFirstTd = strRepositoryBackup.substring(strRepositoryBackup.toUpperCase().indexOf('<TD'));
                var strPartRepositoryBackup = strRepositoryBackup.substring(0, (strRepositoryBackup.toUpperCase().indexOf('<TD') + strFirstTd.indexOf('>') + 1));
                strText = strPartRepositoryBackup + strText + '</td></tr>';
            }
        }
    }
    if (document.all) {
        if (booClear)
            removeChildNodes(repository);
        strTextBackup = replaceAll(new Array(' ', '/\n', '/\t'), '', trim(strText));
        var strPartTextBackup = strTextBackup.substring(0, 3).toUpperCase();
        var booStartTd = (strPartTextBackup == '<TD');
        var booStartTr = (strPartTextBackup == '<TR');
        var booStartTbody = (strPartTextBackup == '<TBODY');
        var booStartThead = (strPartTextBackup == '<THEAD');
        if (booStartTd)
            strText = "<TABLE style='width:100%;'><TBODY><TR>" + strText + '</TR></TBODY></TABLE>';
        if (booStartTr)
            strText = "<TABLE style='width:100%;'><TBODY>" + strText + '</TBODY></TABLE>';
        if (booStartTbody)
            strText = "<TABLE style='width:100%;'>" + strText + '</TABLE>';
        if (booStartThead)
            strText = "<TABLE style='width:100%;'>" + strText + '</TABLE>';
        if ((booStartTd) || (booStartTr) || (booStartTbody) || (booStartThead))
            strTagNameInText = strPartTextBackup.substring(1).toUpperCase();
        eval("var divBackup = " + strOpener + "document.createElement('DIV');");
        divBackup.innerHTML = strText;
        var arrBackupElements = (empty(strTagNameInText)) ? divBackup.childNodes : divBackup.getElementsByTagName(strTagNameInText);
        while (arrBackupElements.length > 0)
            repository.appendChild(arrBackupElements[0]);
    } else {
        if (booClear)
            repository.innerHTML = strText;
        else
            repository.innerHTML += strText;
    }
    return true;
}

/**
 * Atrasa a execucao do script javascript em milisegundos
 *
 * @param INTEGER intMilisegundos
 * @return VOID 
 */
function sleep(intMilisegundos)
{
    if (empty(intMilisegundos))
        intMilisegundos = 0;
    var intStart = new Date().getTime();
    for (var intCount = 0; intCount < 1e7; ++intCount) {
        if ((new Date().getTime() - intStart) > intMilisegundos)
            break;
    }
}/**
 * Retorna o objeto JSON apartir de uma string deste padrao
 * 
 * @param STRING strJson
 * @return OBJECT
 */
function getJsonObject(strJson)
{
    return eval('(' + strJson + ')');
}/**
 * Remove tudo que nao seja inteiro de uma string
 *
 * @param STRING strText
 * @param BOOLEAN booLeftZero
 * @example alert(forceInt("1a2b3c4"))
 */
function forceInt(strText, booLeftZero)
{
    strText += '';
    booLeftZero = (empty(booLeftZero)) ? false : booLeftZero;
    var strNumbers = '1234567890\n';
    var strNewText = '';
    for (var intCount = 0; intCount < strText.length; ++intCount) {
        if (strNumbers.indexOf(strText.charAt(intCount)) != -1)
            strNewText += strText.charAt(intCount);
    }
    if (strNewText === '')
        return '';
    if (!booLeftZero)
        strNewText = parseInt(strNewText, 10);
    return strNewText;
}

/**
 * Remove tudo que nao seja ponto flutuante de uma string
 *
 * @param STRING strText
 * @param STRING strDot
 * @param FLOAT
 * @example alert(forceDouble("1a2b3c4.5aX"))
 */
function forceDouble(strText, strDot)
{
    strText = strText.replace(strDot, '.');
    var strNumbers = '1234567890.\n';
    var strNewText = '';
    for (var intCount = 0; intCount < strText.length; ++intCount) {
        if (strNumbers.indexOf(strText.charAt(intCount)) != -1)
            strNewText += strText.charAt(intCount);
    }
    if (strNewText === '')
        return '';
    var floNew = parseFloat(strNewText, 10);
    strNewText = floNew + '';
    strText = strText.replace('.', strDot);
    return strText;
}

/**
 * Remove todos os numeros de uma string
 *
 * @param STRING strValue
 * @return STRING
 */
function removeAllNumber(strValue)
{
    if (empty(strValue))
        return;
    var intCount = 0;
    while (intCount <= 10) {
        strValue = replaceAll(strValue, intCount + '', '');
        ++intCount;
    }
    return strValue;
}

function formatMoney(floValue, mixPlaces, strSymbol, strThousand, strDecimal)
{
	mixPlaces = !isNaN(mixPlaces = Math.abs(mixPlaces)) ? mixPlaces : 2;
	strSymbol = strSymbol !== undefined ? strSymbol : 'R$ ';
	strThousand = strThousand || '.';
	strDecimal = strDecimal || ',';
	var number = floValue, 
	    negative = number < 0 ? '-' : '',
	    i = parseInt(number = Math.abs(+number || 0).toFixed(mixPlaces), 10) + '',
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return strSymbol + negative + (j ? i.substr(0, j) + strThousand : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + strThousand) + (mixPlaces ? strDecimal + Math.abs(number - i).toFixed(mixPlaces).slice(2) : '');
}

function formatCpfCnpj(strValue)
{
	if (!empty(strValue)) {
		var strValueEdited = replaceAll(strValue, '.', '');
		strValueEdited = replaceAll(strValueEdited, ',', '');
		strValueEdited = replaceAll(strValueEdited, '-', '');
		strValueEdited = replaceAll(strValueEdited, '/', '');
		strValueEdited = replaceAll(strValueEdited, ' ', '');
		var arrValue = [];
		var intLenght = strValueEdited.length;
		if (intLenght < 11)
			strValueEdited = str_pad(strValueEdited, 11, '0', 'STR_PAD_LEFT');
		if (intLenght == 11) {
			arrValue[arrValue.length] = strValueEdited.substr(0, 3);
			arrValue[arrValue.length] = strValueEdited.substr(3, 3);
			arrValue[arrValue.length] = strValueEdited.substr(6, 3);
			arrValue[arrValue.length] = strValueEdited.substr(9, 2);
			strValue = arrValue[0] + '.' + arrValue[1] + '.' + arrValue[2] + '-' + arrValue[3];
		} else if (intLenght == 14) {
			arrValue[arrValue.length] = strValueEdited.substr(0, 2);
			arrValue[arrValue.length] = strValueEdited.substr(2, 3);
			arrValue[arrValue.length] = strValueEdited.substr(5, 3);
			arrValue[arrValue.length] = strValueEdited.substr(8, 4);
			arrValue[arrValue.length] = strValueEdited.substr(12, 2);
			strValue = arrValue[0] + '.' + arrValue[1] + '.' + arrValue[2] + '/' + arrValue[3] + '-' + arrValue[4];
		}
	}
	return strValue;
}function setEvent(mixElement, strEvent, mixFunction)
{
    if ((empty(mixElement)) || (empty(strEvent)) || (empty(mixFunction)))
        return false;
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    var strBindEvent = replaceAll(strEvent, 'pre-', '');
    if (isFunction(mixFunction))
        $(element).bind(strBindEvent, mixFunction);
    else {
        $(element).bind(strBindEvent, function () {
            if (mixFunction.indexOf('return false') === 0)
                return false;
            if ((strEvent == 'paste') || (strEvent == 'drop'))
                setTimeout("eval(\"" + mixFunction + "\");", 50);
            else
                eval(mixFunction);
            return true;
        });
    }
    return true;
}

function clearEvent(strEvent)
{
    return setEvent(window, strEvent, function () {
        return void(0);
    });
}

function setOnBeforeUnload(mixElement, mixFunction)
{
    return setEvent(mixElement, 'beforeunload', mixFunction);
}

function setOnBlur(mixElement, mixFunction)
{
    return setEvent(mixElement, 'blur', mixFunction);
}

function setOnChange(mixElement, mixFunction)
{
    return setEvent(mixElement, 'change', mixFunction);
}

function setOnClick(mixElement, mixFunction)
{
    return setEvent(mixElement, 'click', mixFunction);
}

function setOnContextMenu(mixElement, mixFunction)
{
    return setEvent(mixElement, 'contextmenu', mixFunction);
}

function setOnCopy(mixElement, mixFunction)
{
    return setEvent(mixElement, 'copy', mixFunction);
}

function setOnCut(mixElement, mixFunction)
{
    return setEvent(mixElement, 'cut', mixFunction);
}

function setOnDblClick(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dblclick', mixFunction);
}

function setOnDrag(mixElement, mixFunction)
{
    return setEvent(mixElement, 'drag', mixFunction);
}

function setOnDragEnd(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dragend', mixFunction);
}

function setOnDragEnter(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dragenter', mixFunction);
}

function setOnDragLeave(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dragleave', mixFunction);
}

function setOnDragOver(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dragover', mixFunction);
}

function setOnDragStart(mixElement, mixFunction)
{
    return setEvent(mixElement, 'dragstart', mixFunction);
}

function setOnDrop(mixElement, mixFunction)
{
    return setEvent(mixElement, 'drop', mixFunction);
}

function setOnError(mixElement, mixFunction)
{
    return setEvent(mixElement, 'error', mixFunction);
}

function setOnFocus(mixElement, mixFunction)
{
    return setEvent(mixElement, 'focus', mixFunction);
}

function setOnHashChange(mixElement, mixFunction)
{
    return setEvent(mixElement, 'hashchange', mixFunction);
}

function setOnInput(mixElement, mixFunction)
{
    return setEvent(mixElement, 'input', mixFunction);
}

function setOnKeyDown(mixElement, mixFunction)
{
    return setEvent(mixElement, 'keydown', mixFunction);
}

function setOnKeyPress(mixElement, mixFunction)
{
    return setEvent(mixElement, 'keypress', mixFunction);
}

function setOnKeyUp(mixElement, mixFunction)
{
    return setEvent(mixElement, 'keyup', mixFunction);
}

function setOnLoad(mixElement, mixFunction)
{
    return setEvent(mixElement, 'load', mixFunction);
}

function setOnMessage(mixElement, mixFunction)
{
    return setEvent(mixElement, 'message', mixFunction);
}

function setOnMouseDown(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mousedown', mixFunction);
}

function setOnMouseMove(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mousemove', mixFunction);
}

function setOnMouseOut(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mouseout', mixFunction);
}

function setOnMouseOver(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mouseover', mixFunction);
}

function setOnMouseUp(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mouseup', mixFunction);
}

function setOnMouseWheel(mixElement, mixFunction)
{
    return setEvent(mixElement, 'mousewheel', mixFunction);
}

function setOnPaste(mixElement, mixFunction)
{
    return setEvent(mixElement, 'paste', mixFunction);
}

function setOnPrePaste(mixElement, mixFunction)
{
    return setEvent(mixElement, 'pre-paste', mixFunction);
}

function setOnPasteDrop(mixElement, mixFunction)
{
    var booReturn = setOnPaste(mixElement, mixFunction);
    if (booReturn)
        booReturn = setOnDrop(mixElement, mixFunction);
    return booReturn;
}

function setNotPaste(mixNotPaste)
{
    if (empty(mixNotPaste))
        return false;
    var arrNotPaste = (isArray(mixNotPaste)) ? mixNotPaste : new Array(mixNotPaste);
    for (var intCount = 0; intCount < arrNotPaste.length; ++intCount) {
        var notPaste = getObject(arrNotPaste[intCount]);
        if (!empty(notPaste)) {
            setOnPrePaste(notPaste, 'return false;');
            setOnDrop(notPaste, 'return false;');
        }
    }
    return true;
}

function setOnReset(mixElement, mixFunction)
{
    return setEvent(mixElement, 'reset', mixFunction);
}

function setOnResize(mixElement, mixFunction)
{
    return setEvent(mixElement, 'resize', mixFunction);
}

function setOnScroll(mixElement, mixFunction)
{
    return setEvent(mixElement, 'scroll', mixFunction);
}

function setOnSelect(mixElement, mixFunction)
{
    return setEvent(mixElement, 'select', mixFunction);
}

function setOnSubmit(mixElement, mixFunction)
{
    return setEvent(mixElement, 'submit', mixFunction);
}

function setOnUnload(mixElement, mixFunction)
{
    return setEvent(mixElement, 'unload', mixFunction);
}

function clearBeforeUnload()
{
    return clearEvent('beforeunload');
}

/**
 * Funcao que atualiza a tela window
 *
 * @param ARRAY arrParamNotUse
 * @param STRING strParamComplement
 * @param BOOLEAN booNotUseAllParam
 * @return BOOLEAN
 */
function refreshWindow(arrParamNotUse, strParamComplement, booNotUseAllParam)
{
    if (empty(arrParamNotUse))
        arrParamNotUse = [];
    if (!isArray(arrParamNotUse))
        arrParamNotUse = new Array(arrParamNotUse);
    var arrUrl = explode('#', window.location.href);
    var strUrl = arrUrl[0];
    if (strUrl.indexOf('?') != -1) {
        if (booNotUseAllParam === true)
            strUrl = strUrl.substring(0, strUrl.indexOf('?'));
        else {
            var arrUrlParam = explode('?', strUrl);
            arrUrlParam = explode('&', arrUrlParam[1]);
            for (var intCount = 0; intCount < arrParamNotUse.length; ++intCount) {
                var strParamNotUse = arrParamNotUse[intCount];
                for (var intCount2 = 0; intCount2 < arrUrlParam.length; ++intCount2) {
                    var strUrlParam = arrUrlParam[intCount2];
                    if (strUrlParam.indexOf(strParamNotUse) != -1) {
                        strUrl = replaceAll(strUrl, strUrlParam, '');
                        break;
                    }
                }
            }
            strUrl = replaceAll(strUrl, '?&', '?');
            strUrl = replaceAll(strUrl, '&&', '&');
        }
    }
    if (strUrl.substring((strUrl.length - 1)) == '?')
        strUrl = replaceAll(strUrl, '?', '');
    if (strUrl.substring((strUrl.length - 1)) == '&')
        strUrl = replaceAll(strUrl, '&', '');
    var strSymbol = (strUrl.indexOf('?') == -1) ? '?' : '&';
    if (!empty(strParamComplement))
        strUrl += strSymbol + strParamComplement;
    window.location.href = strUrl;
    return true;
}

/**
 * Funcao que atualiza a tela parent (pai da tela de popup)
 *
 * @return BOOLEAN
 */
function refreshParent()
{
    window.opener.location.href = window.opener.location.href;
    window.close();
    return true;
}

/**
 * Atualiza a janela pai com a URL da janela filho
 * 
 * @return VOID
 */
function refreshParentWithCurrentUrl()
{
    var booExecute = false;
    try {
        if ((!empty(parent)) && (!empty(parent.window)) && (parent.window.location.href != window.location.href))
            booExecute = true;
    }
    catch (exception) {
        if ((exception + ''.toLowerCase().indexOf('location.href') != -1) && (exception + ''.toLowerCase().indexOf('https://') != -1))
            booExecute = true;
    }
    if (booExecute === true)
        parent.window.location.href = replaceAll(window.location.href, 'https://', 'http://');
    return;
}

/**
 * Funcao que posiciona a barra de rolagem em uma ponto especificado da tela
 *
 * @param MIX mixAnchor
 * @return VOID
 */
function goToAnchor(mixAnchor)
{
    if (empty(mixAnchor))
        return;
    window.location.href = window.location.href + '#' + mixAnchor;
}

/**
 * Executa uma funcao aplicada ao evento onload do objeto window
 *
 * @param STRING strFunction
 * @return VOID
 */
function execFunctionOnLoadEvent(strFunction)
{
    if (empty(strFunction))
        return;
    var mixWindowLoad = window.onload;
    window.onload = function () {
        if (mixWindowLoad)
            mixWindowLoad();
        eval(strFunction);
    };
    return;
}

/**
 * Insere uma funcao a um evento aplicado a um determinado elemento
 *
 * @param MIX mixElement
 * @param STRING strEvent
 * @param STRING strEventFunction
 * @param BOOLEAN booClear
 * @return BOOL
 */
function insertFunctionIntoEventElement(mixElement, strEvent, strEventFunction, booClear)
{
    if ((empty(mixElement)) || (empty(strEvent)))
        return false;
    if (empty(booClear))
        booClear = false;
    var element = getObject(mixElement);
    var strEventFunctionIntern = element.getAttribute(strEvent);
    if (empty(strEventFunctionIntern))
        strEventFunctionIntern = '';
    else if (document.all) {
        strEventFunctionIntern = replaceAll(strEventFunctionIntern, 'function anonymous() {', '');
        strEventFunctionIntern = strEventFunctionIntern.substring(0, (strEventFunctionIntern.length - 2));
        strEventFunctionIntern = replaceAll(strEventFunctionIntern, '\n', '');
    }
    strEventFunctionIntern = (booClear === false) ? strEventFunction + strEventFunctionIntern : strEventFunction;
    if (document.all)
        eval('element.' + strEvent + ' = new Function("' + strEventFunctionIntern + '");');
    else
        element.setAttribute(strEvent, strEventFunctionIntern);
    return true;
}

/**
 * Funcao que aciona a contagem regressiva de uma data futura ate a data atual e 
 * executa uma funcao quando a contagem nao zerar e/ou quando zerar
 *
 * @param INTEGER intTimestamp
 * @param STRING strFunctionExecNoZero
 * @param STRING strFunctionExecZero
 * @return MIX
 */
var intGlobalIntervalRegressiveCount;
function regressiveCount(intTimestamp, strFunctionExecNoZero, strFunctionExecZero)
{
    if (empty(intTimestamp))
        return false;
    intGlobalIntervalRegressiveCount = setInterval('regressiveCountInternval("' + intTimestamp + '", "' + strFunctionExecNoZero + '", "' + strFunctionExecZero + '");', 1000);
    return intGlobalIntervalRegressiveCount;
}

/**
 * Funcao que aciona a contagem regressiva de uma data futura ate a data atual apos a
 * aplicacao do intervalo
 *
 * @param INTEGER intTimestamp
 * @param STRING strFunctionExecNoZero
 * @param STRING strFunctionExecZero
 * @return BOOLEAN
 */
var intGlobalHoursRegressiveCount;
var intGlobalMinutesRegressiveCount;
var intGlobalSecondsRegressiveCount;
function regressiveCountInternval(intTimestamp, strFunctionExecNoZero, strFunctionExecZero)
{
    var date = new Date();
    var intTimestampActual = date.getTime().toString().substring(0, 10);
    var intDifference = intTimestamp - intTimestampActual;
    var intHoursDivisor = intDifference % (60 * 60);
    var intHours = Math.floor(intDifference / (60 * 60));
    var intMinutesDivisor = intHoursDivisor % (60);
    var intMinutes = Math.floor(intHoursDivisor / (60));
    var intSeconds = intMinutesDivisor;
    intHours = ((intHours < 10) && (intHours >= 0)) ? '0' + intHours : intHours;
    intMinutes = ((intMinutes < 10) && (intMinutes >= 0)) ? '0' + intMinutes : intMinutes;
    intSeconds = ((intSeconds < 10) && (intSeconds >= 0)) ? '0' + intSeconds : intSeconds;
    intGlobalHoursRegressiveCount = intHours;
    intGlobalMinutesRegressiveCount = intMinutes;
    intGlobalSecondsRegressiveCount = intSeconds;
    if ((intHours < 0) || (intMinutes < 0) || (intSeconds < 0)) {
        if (!empty(strFunctionExecZero))
            eval(strFunctionExecZero);
        clearInterval(intGlobalIntervalRegressiveCount);
    } else if (!empty(strFunctionExecNoZero))
        eval(strFunctionExecNoZero);
    return true;
}

/**
 * Retorna um inteiro que identifica a tecla pressionada
 *
 * @param HANDLER de evento de tecla 
 * @return INTEGER
 */
function getIntKeyCode(keyEvent)
{
    var intKeyCode = ((keyEvent.which) ? keyEvent.which : keyEvent.keyCode);
    if (keyEvent.shiftKey)
        intKeyCode += 1000;
    return intKeyCode;
}

/**
 * Retorna o tipo de tecla pressionada
 *
 * @require getIntKeyCode
 * @param INTEGER intKeyCode
 * @return STRING
 */
var intGlobalLastTypeKeyCode = 'unknown';
var intGlobalLastKeyCode = -1;
function getKeyType(intKeyCode)
{
    var strType = 'unknown';
    if (intGlobalLastTypeKeyCode == 'special')
        strType = 'letter';
    else if (intKeyCode == 8)
        strType = 'backspace';
    else if ((intKeyCode == 9) || (intKeyCode == 1009))
        strType = 'tab';
    else if (intKeyCode == 13)
        strType = 'enter';
    else if (intKeyCode == 32)
        strType = 'space';
    else if (((intKeyCode >= 33) && (intKeyCode <= 40)) || ((intKeyCode >= 1033) && (intKeyCode <= 1040)))
        strType = 'position';
    else if (intKeyCode == 46)
        strType = 'delete';
    else if (((intKeyCode >= 48) && (intKeyCode <= 57)) || ((intKeyCode >= 96) && (intKeyCode <= 105)))
        strType = 'number';
    else if (((intKeyCode >= 59) && (intKeyCode <= 90)) || ((intKeyCode >= 1059) && (intKeyCode <= 1090)))
        strType = 'letter';
//    else if (((intKeyCode >= 97) && (intKeyCode <= 122)) || ((intKeyCode >= 1097) && (intKeyCode <= 1122))) 
//        strType = 'letter';
    else if ((intKeyCode >= 112) && (intKeyCode <= 123))
        strType = 'Fn';
    else if ((intKeyCode == 219) || (intKeyCode == 1219) || (intKeyCode == 222) || (intKeyCode == 1222))
        strType = 'special';
    intGlobalLastKeyCode = intKeyCode;
    intGlobalLastTypeKeyCode = strType;
    return strType;
}

var eventFunctions = function($) {
	/**
     * Redireciona colocando a url global antes.
     *
     * @param string strLocation
     */
    $.redirect = function (strLocation)
    {
        window.location.href = strGlobalBasePath + strLocation;
    };
};
eventFunctions(jQuery);/**
 * Retorna um objeto pelo ID
 *
 * @param MIX mixElement
 * @return OBJECT
 */
function getObject(mixElement)
{
	var element = mixElement;
    if (!isObject(mixElement)) {
        element = document.getElementById(mixElement);
        if ((document.all) && (!empty(element)) && (element.getAttribute('id') != mixElement)) {
            var elementIntern;
            var arrElement = document.getElementsByName(mixElement);
            for (var intCount = 0; intCount < arrElement.length; ++intCount) {
                if (arrElement[intCount].getAttribute('id') == mixElement) {
                    elementIntern = arrElement[intCount];
                    break;
                }
            }
            if (!empty(elementIntern))
                element = elementIntern;
        }
    }
    return element;
}

/**
 * Verifica se determinado atributo do objeto eh vazio ou nao existe
 * 
 * @param MIX mixElement
 * @param STRING strAttributeName
 * @return ARRAY
 */
function isEmptyAttribute(mixElement, strAttributeName)
{
    if ((empty(mixElement)) || (empty(strAttributeName)))
        return false;
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    return empty(element.getAttribute(strAttributeName));
}

/**
 * Retorna elementos de um repositorio que possuem determinados atributos e valores (via regex)
 * 
 * @param OBJECT element
 * @param MIX mixTagName
 * @param STRING strAttributeName
 * @param STRING strAttributeValue
 * @return ARRAY
 */
function getElementsByAttribute(element, mixTagName, strAttributeName, strAttributeValue)
{
	var arrElement = [];
	var intCount;
    if (typeof (mixTagName) == 'string')
        arrElement = ((mixTagName == '*') && (element.all)) ? element.all : element.getElementsByTagName(mixTagName);
    else if (typeof (mixTagName) == 'object') {
        var arrOneOfElement;
        for (intCount = 0; intCount < mixTagName.length; ++intCount) {
            arrOneOfElement = element.getElementsByTagName(mixTagName[intCount]);
            arrElement.concat(arrOneOfElement);
        }
    } else
        arrElement = element.all;
    var arrReturnElement = [];
    var mixAttributeValue = (typeof strAttributeValue != 'undefined') ? new RegExp('(^|\\s)' + strAttributeValue + '(\\s|$)') : null;
    var current;
    var attribute;
    for (intCount = 0; intCount < arrElement.length; ++intCount) {
        current = arrElement[intCount];
        attribute = current.getAttribute && current.getAttribute(strAttributeName);
        if (!empty(attribute)) {
            if (document.all)
                attribute = attribute.toString();
            if ((typeof attribute == 'string') && (attribute.length > 0)) {
                if (typeof strAttributeValue == 'undefined' || (mixAttributeValue && mixAttributeValue.test(attribute)))
                    arrReturnElement.push(current);
            }
        }
    }
    return arrReturnElement;
}

/**
 * Retorna elementos de um repositorio que possuem determinados atributos e valores (via DOM)
 * 
 * @param MIX mixRepository
 * @param STRING strTagName
 * @param STRING strAttributeName
 * @param STRING strAttributeValue
 * @param BOOLEAN booPartValue
 * @return ARRAY
 */
function getElementsFromAttribute(mixRepository, strTagName, strAttributeName, strAttributeValue, booPartValue)
{
    if ((empty(strTagName)) || (empty(strAttributeName)) || (empty(strAttributeValue)))
        return [];
    if (booPartValue)
        booPartValue = false;
    if (empty(mixRepository))
        mixRepository = document.body;
    var repository = getObject(mixRepository);
    if (empty(repository))
        return [];
    var arrElement = repository.getElementsByTagName(strTagName);
    var arrReturn = [];
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        var strAttributeValueElement = (strAttributeName == 'class') ? arrElement[intCount].className : arrElement[intCount].getAttribute(strAttributeName);
        if (booPartValue) {
            if (strAttributeValueElement.indexOf(strAttributeValue) != -1)
                arrReturn.push(arrElement[intCount]);
        } else if (strAttributeValueElement == strAttributeValue)
            arrReturn.push(arrElement[intCount]);
    }
    return arrReturn;
}

/**
 * Remove os objetos filhos (ou determinado objeto filho) de um objeto parametrizado
 *
 * @param MIX mixElement
 * @param STRING strIdChild
 * @return BOOLEAN
 */
function removeChildNodes(mixElement, strIdChild)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    while (element.childNodes.length > 0) {
        if ((empty(strIdChild)) || (strIdChild == element.id))
            element.removeChild(element.childNodes[0], true);
    }
    if ((document.all) && (element.tagName.toLowerCase() == 'div'))
        element.outerHTML = element.outerHTML;
    return true;
}

/**
 * Retorna o value do elemento
 *
 * @param MIX mixElement
 * @return BOOLEAN
 */
function captureValueFromElement(mixElement)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    if (isSelectMultiple(element)) {
        var arrValue = [];
        var arrOption = element.getElementsByTagName('OPTION');
        for (var intCount = 0; intCount < arrOption.length; ++intCount) {
            var option = arrOption[intCount];
            if (option.selected)
                arrValue[arrValue.length] = option.value;
        }
        return arrValue;
    }
    if (element.value !== undefined)
        return element.value;
    if (element.innerHTML !== undefined)
        return element.innerHTML;
    if (element.textContent !== undefined)
        return element.textContent;
    if (element.text !== undefined)
        return element.text;
}

/**
 * Caso o objeto esteja oculta, visualiza-o e vice-versa
 *
 * @param MIX mixElement
 * @return BOOL
 */
function showHide(mixElement)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    if (element.style.display == 'none') {
        element.style.display = '';
        return true;
    } else {
        element.style.display = 'none';
        return false;
    }
}

/**
 * Oculta o objeto
 *
 * @param MIX mixElement
 * @return VOID
 */
function hideObject(mixElement)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    if (isObject(element))
        element.style.display = 'none';
}

/**
 * Visualiza o objeto
 *
 * @param MIX mixElement
 * @return VOID
 */
function showObject(mixElement)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    if (isObject(element))
        element.style.display = '';
}

/**
 * Aplica o display a um array de elementos
 *
 * @param ARRAY arrElement
 * @param STRING strDisplay
 * @return BOOLEAN
 */
function showHideObjects(arrElement, strDisplay)
{
    if (empty(arrElement))
        return false;
    if (!isArray(arrElement))
        arrElement = new Array(arrElement);
    if (empty(strDisplay))
        strDisplay = '';
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        var mixElement = arrElement[intCount];
        var element = getObject(mixElement);
        if (!empty(element))
            element.style.display = strDisplay;
    }
    return true;
}

/**
 * Cria um elemento em um repositorio
 *
 * @param STRING strElementTag
 * @param MIX mixRepositoryElement
 * @param STRING strId
 * @param STRING strName
 * @param STRING strClass
 * @param STRING strStyle
 * @param BOOLEAN booStart
 * @param OBJECT element
 * @return OBJECT
 */
function createElementIntoRepository(strElementTag, mixRepositoryElement, strId, strName, strClass, strStyle, booStart, element)
{
    if (empty(strElementTag))
        strElementTag = 'DIV';
    if (empty(mixRepositoryElement))
        mixRepositoryElement = document.body;
    if (empty(booStart))
        booStart = false;
    var repositoryElement = getObject(mixRepositoryElement);
    if (empty(repositoryElement))
        return;
    if (empty(element))
        element = document.createElement(strElementTag.toUpperCase());
    if (!empty(strId))
        element.setAttribute('id', strId);
    if (!empty(strName))
        element.setAttribute('name', strName);
    if (!empty(strClass))
        element.className = strClass;
    if (!empty(strStyle))
        element.style.cssText = strStyle;
    if (booStart) {
        if (checkIfExistsElementIntoRepositoy(element, repositoryElement) === false) {
            var strOldValues = repositoryElement.innerHTML;
            repositoryElement.innerHTML = "";
            repositoryElement.appendChild(element);
            repositoryElement.innerHTML += strOldValues;
        }
    } else
        repositoryElement.appendChild(element);
    return element;
}

/**
 * Verifica se o elemento existe dentro de um repositorio
 *
 * @param OBJECT element
 * @param OBJECT repositoryElement
 * @return BOOLEAN
 */
function checkIfExistsElementIntoRepositoy(element, repositoryElement)
{
    var arrChildElementFromRepositoy = repositoryElement.childNodes;
    for (var intCount = 0; intCount < arrChildElementFromRepositoy.length; ++intCount) {
        if ((arrChildElementFromRepositoy[intCount]) && (arrChildElementFromRepositoy[intCount] == element))
            return true;
    }
    return false;
}

/**
 * Remove um elemento dentro de um repositorio
 *
 * @param OBJECT repositoryElement
 * @param STRING strId
 * @return BOOLEAN
 */
function removeElementFromRepository(repositoryElement, strId)
{
    if (empty(strId))
        return false;
    if (empty(repositoryElement))
        repositoryElement = document.body;
    var arrElement = repositoryElement.childNodes;
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        if ((arrElement[intCount]) && (arrElement[intCount].id == strId)) {
            repositoryElement.removeChild(document.getElementById(strId));
            break;
        }
    }
    return true;
}

/**
 * Insere valor para um elemento existente na janela pai (opener)
 * 
 * @param STRING strValue
 * @param MIX mixOpenerElement
 * @param STRING strSeparator
 * @return MIX
 */
function insertValueToOpenerElement(strValue, mixOpenerElement, strSeparator)
{
    if ((empty(strValue)) || (empty(mixOpenerElement)))
        return false;
    var openerElement;
    if (isObject(mixOpenerElement))
        openerElement = mixOpenerElement;
    else {
        if (empty(opener)) {
            alert('A janela-pai n&atilde;o foi encontrada e n&atilde;o &eacute; poss&iacute;vel realizar a opera&ccedil;&atilde;o!');
            return false;
        }
        try {
            openerElement = opener.document;
        }
        catch (exception) {
            alert('A janela-pai n&atilde;o foi encontrada e n&atilde;o &eacute; poss&iacute;vel realizar a opera&ccedil;&atilde;o!');
            return false;
        }
        openerElement = opener.document.getElementById(mixOpenerElement);
    }
    if (empty(openerElement))
        return false;
    var strTagName = openerElement.tagName + '';
    strTagName = strTagName.toUpperCase();
    if ((strTagName != 'INPUT') && (strTagName != 'SELECT') && (strTagName != 'BUTTON'))
        openerElement.innerHTML = ((empty(strSeparator)) || (empty(openerElement.innerHTML))) ? strValue : openerElement.innerHTML + strSeparator + strValue;
    else
        openerElement.value = ((empty(strSeparator)) || (empty(openerElement.value))) ? strValue : openerElement.value + strSeparator + strValue;
    return true;
}

/**
 * Aplica o disabled a um array de elementos
 *
 * @param ARRAY arrElement
 * @param STRING strDisplay
 * @param BOOLEAN booClearDisable
 * @return BOOLEAN
 */
function disableObjects(arrElement, booDisable, booClearDisable)
{
    if (empty(arrElement))
        return false;
    if (!isArray(arrElement))
        arrElement = new Array(arrElement);
    if (empty(booDisable))
        booDisable = false;
    if (empty(booClearDisable))
        booClearDisable = false;
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        var mixElement = arrElement[intCount];
        var element = getObject(mixElement);
        if (!empty(element))
            element.disabled = booDisable;
        if ((booClearDisable) && (booDisable))
            element.value = '';
    }
    return true;
}

/**
 * Retorno o objeto Document de um determinado IFRAME
 *
 * @param STRING strIdIframe
 * @return OBJECT
 */
function getDocumentFromIframe(strIdIframe)
{
    var documentElement;
    try {
        if (document.all)
        	documentElement = document.frames[strIdIframe].document;
        if (empty(documentElement))
            documentElement = parent.document.getElementById(strIdIframe).contentDocument;
    }
    catch (exception) {
        return;
    }
    return documentElement;
}

/**
 * Clona um elemento ou nodo
 *
 * @param MIX mixNode
 * @return MIX
 */
function cloneNode(mixNode)
{
    if (empty(mixNode))
        return false;
    var node = getObject(mixNode);
    if (empty(node))
        return false;
    var nodeClone = node.cloneNode(true);
    var arrTextarea = node.getElementsByTagName('TEXTAREA');
    var arrTextareaClone = nodeClone.getElementsByTagName('TEXTAREA');
    var arrInput = node.getElementsByTagName('INPUT');
    var arrInputClone = nodeClone.getElementsByTagName('INPUT');
    var arrSelect = node.getElementsByTagName('SELECT');
    var arrSelectClone = nodeClone.getElementsByTagName('SELECT');
    for (var intCount = 0; intCount < arrTextarea.length; ++intCount)
        arrTextareaClone[intCount].value = arrTextarea[intCount].value;
    for (intCount = 0; intCount < arrInput.length; ++intCount) {
        if (arrInput[intCount].type == 'text')
            continue;
        if ((arrInput[intCount].type == 'radio') || (arrInput[intCount].type == 'checkbox'))
            arrInputClone[intCount].checked = arrInput[intCount].checked;
        else {
            try {
                arrInputClone[intCount].value = arrInput[intCount].value;
            } catch (exception) {

            }
        }
    }
    for (intCount = 0; intCount < arrSelect.length; ++intCount)
        arrSelectClone[intCount].value = arrSelect[intCount].value;
    return nodeClone;
}

/**
 * Cria recursivamente um objeto atraves de uma string com objetos e arrays
 *
 * @param STRING strAttributeHierarchy
 * @param MIX mixAttributeValue
 * @param OBJECT container
 * @param MIX mixPartHierarchy
 * @return MIX
 */
function createAttributeHierarchyIntoObject(strAttributeHierarchy, mixAttributeValue, container, mixPartHierarchy)
{
    if (empty(strAttributeHierarchy))
        return false;
    if (empty(container))
        container = {};
    var intPosOpenArray = strrpos(strAttributeHierarchy, '[');
    var intPosOpenObject = strrpos(strAttributeHierarchy, '.');
    var strKey;
    var mixValue;
    if ((intPosOpenArray === false) && (intPosOpenObject === false)) {
        mixValue = (empty(mixPartHierarchy)) ? mixAttributeValue : mixPartHierarchy;
        eval('container.' + replaceAll(strAttributeHierarchy, ']', '') + ' = mixValue;');
        return container;
    } else if (((intPosOpenArray !== false) && (intPosOpenObject === false)) || (intPosOpenArray > intPosOpenObject)) {
        strKey = strAttributeHierarchy.substr(intPosOpenArray + 1);
        var intPosClose = strKey.indexOf(']');
        if (intPosClose === 0)
            strKey = 0;
        else if (intPosClose > 0)
            strKey = strKey.substr(0, intPosClose);
        mixValue = [];
        mixValue[strKey] = (empty(mixPartHierarchy)) ? mixAttributeValue : mixPartHierarchy;
        return createAttributeHierarchyIntoObject(strAttributeHierarchy.substr(0, intPosOpenArray), mixAttributeValue, container, mixValue);
    } else if (((intPosOpenArray === false) && (intPosOpenObject !== false)) || (intPosOpenArray < intPosOpenObject)) {
        strKey = strAttributeHierarchy.substr(intPosOpenObject + 1);
        if (isNumeric(strKey))
            strKey = '_' + strKey;
        mixValue = {};
        eval('mixValue.' + strKey + ' = (empty(mixPartHierarchy)) ? mixAttributeValue : mixPartHierarchy;');
        return createAttributeHierarchyIntoObject(strAttributeHierarchy.substr(0, intPosOpenObject), mixAttributeValue, container, mixValue);
    }
}

/**
 * Controla o tamanho das fontes
 *
 * @param STRING strSymbol // Simbolo que controla a operacao, ou seja, + para aumentar, - para diminuir a fonte e 0 para retornar o tamanho original
 * @param INTEGER intPercentMax	// Percentual maximo que se queira aumentar uma fonte (lembrando que a fonte inicial possui percentual de 100) - parametro opcional
 * @param INTEGER intPercentMin	// Percentual minimo que se queira diminuir uma fonte (lembrando que a fonte inicial possui percentual de 100) - parametro opcional
 * @param INTEGER intPercentOperation // Percentual que eh trabalhado em cada operacao - parametro opcional (default = 5)
 * @return BOOLEAN
 */
var intPercentFontSizeGlobal = 100;
function controlFontSize(strSymbol, intPercentMax, intPercentMin, intPercentOperation, strClassFontSize, arrTagFontSize)
{
    if ((empty(strSymbol)) || ((strSymbol != '+') && (strSymbol != '-')))
        strSymbol = '0';
    if (empty(intPercentOperation))
        intPercentOperation = 5;
    var intPercentFontSize;
    if (strSymbol == '0')
        intPercentFontSize = 100;
    else
        eval('intPercentFontSize = intPercentFontSizeGlobal ' + strSymbol + ' ' + intPercentOperation + ';');
    if ((!empty(intPercentMax)) && (intPercentFontSize > intPercentMax))
        return false;
    if ((!empty(intPercentMin)) && (intPercentFontSize < intPercentMin))
        return false;
    setTimeout(openWaitDialog, 100);
    if (empty(strClassFontSize))
        strClassFontSize = 'controlFontSize';
    intPercentFontSizeGlobal = intPercentFontSize;
    if (empty(arrTagFontSize))
        arrTagFontSize = new Array('BODY', 'FORM', 'DIV', 'LABEL', 'SPAN', 'FONT', 'INPUT', 'TEXTAREA', 'SELECT', 'TABLE', 'TBODY', 'THEAD', 'TR', 'TH', 'TD', 'P', 'A', 'STRONG', 'B', 'LI', /*'H1', 'H2', 'H3', 'H4', */'H5', 'H6');
    var arrElement = [];
    for (var intCount = 0; intCount < arrTagFontSize.length; ++intCount) {
        var arrTag = getElementsFromAttribute(document, arrTagFontSize[intCount], 'class', strClassFontSize, true);
        if (arrTag.length !== 0)
            arrElement = arrElement.concat(arrTag);
    }
    for (intCount = 0; intCount < arrElement.length; ++intCount) {
        var arrChild = getChildNodesRecursive(arrElement[intCount], arrTagFontSize);
        arrElement = arrElement.concat(arrChild);
    }
    for (intCount = 0; intCount < arrElement.length; ++intCount) {
        var tag = arrElement[intCount];
        if (!empty(tag.style.fontSize))
            tag.style.fontSize = intPercentFontSizeGlobal + '%';
    }
    setTimeout(closeWaitDialog, 110);
    return true;
}

/**
 * Captura recursivamente todos os elementos filhos (com possibilidade de restricao de determinadas tags)
 *
 * @param MIX mixElement
 * @param ARRAY arrTag
 * @return BOOLEAN
 */
function getChildNodesRecursive(mixElement, arrTag)
{
    var element = getObject(mixElement);
    if (!isObject(element))
        return;
    var arrElement = [];
    try {
        if (element.hasChildNodes()) {
            var arrChild = element.childNodes;
            for (var intCount = 0; intCount < arrChild.length; ++intCount) {
                var child = arrChild[intCount];
                if (child.nodeType === 1) {
                    if (isArray(arrTag)) {
                        var booContinue = true;
                        for (var intCount2 = 0; intCount2 < arrTag.length; ++intCount2) {
                            if (arrTag[intCount2].toLowerCase() == child.tagName.toLowerCase()) {
                                booContinue = false;
                                break;
                            }
                        }
                        if (booContinue)
                            continue;
                    }
                    arrElement[arrElement.length] = child;
                    var arrElementRecursive = getChildNodesRecursive(child, arrTag);
                    arrElement = arrElement.concat(arrElementRecursive);
                }
            }
        }
    }
    catch (exception) {

    }
    return arrElement;
}

/**
 * Verifica se o elemento eh um select multiple
 *
 * @param MIX mixSelect
 * @return MIX
 */
function isSelectMultiple(mixSelect)
{
    if (empty(mixSelect))
        return false;
    var select = getObject(mixSelect);
    if (empty(select))
        return false;
    if (select.tagName.toLowerCase() != 'select')
        return false;
    var booMultiple = true;
    if (document.all)
        booMultiple = (select.getAttribute('multiple') === false) ? false : true;
    else
        booMultiple = (select.getAttribute('multiple') === null) ? false : true;
    return booMultiple;
}

/**
 * Define o valor do atributo HTML autocomplete
 *
 * @param MIX mixElement
 * @param STRING strValue
 * @return MIX
 */
function setAutocomplete(mixElement, strValue)
{
    if (empty(mixElement))
        return false;
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    if (empty(strValue))
        strValue = '';
    strValue = strValue.toLowerCase();
    if ((strValue != 'on') && (strValue != 'off'))
        strValue = 'on';
    return element.setAttribute('autocomplete', strValue);
}

function setParamIntoInputHidden(mixParam, strInputHiddenParam, mixReference, booTableData, mixRepository)
{
    if (empty(strInputHiddenParam))
        strInputHiddenParam = 'filter_criteria';
    if (!isBoolean(booTableData))
        booTableData = true;
    if (booTableData) {
    	var strReference = 'tableData';
        if (!empty(mixReference))
            strReference = (getObject(mixReference)) ? getObject(mixReference).attr('id') : mixReference.replace('#', '');
        strInputHiddenParam += '_' + strReference;
    } else if (!empty(mixReference))
        strInputHiddenParam += '_' + mixReference;
    var inputHiddenParam = getObject(strInputHiddenParam);
    if (empty(inputHiddenParam)) {
        if (empty(mixRepository))
            mixRepository = document.body;
        createElementIntoRepository('INPUT', mixRepository, strInputHiddenParam);
        inputHiddenParam = getObject(strInputHiddenParam);
        inputHiddenParam.setAttribute('type', 'hidden');
    }
    if (isArray(mixParam)) {
        var arrParamJson = [];
        for (var mixKey in mixParam) {
            if (empty(mixParam[mixKey]))
                continue;
            arrParamJson[arrParamJson.length] = JSON.stringify(new Array(mixKey, mixParam[mixKey]));
        }
        inputHiddenParam.value = JSON.stringify(arrParamJson);
    } else
        inputHiddenParam.value = mixParam;
    return inputHiddenParam;
}

function getButtonWithAccesskey()
{
    return getElementsByAttribute(document.body, 'BUTTON', 'accesskey', '*');
}

function getAccesskeyUsed(arrAccesskeyAdd)
{
    var arrAccesskeyUsed = [];
    var arrButton = getButtonWithAccesskey();
    for (var intCount = 0; arrButton.length > intCount; ++intCount) {
        var button = arrButton[intCount];
        arrAccesskeyUsed[arrAccesskeyUsed.length] = button.getAttribute('accesskey');
    }
    if (isArray(arrAccesskeyAdd))
        arrAccesskeyUsed = arrAccesskeyAdd.concat(arrAccesskeyUsed);
    return arrAccesskeyUsed;
}

function getAccesskeyNext(booCapsLock)
{
    var arrAccesskeyUsed = getAccesskeyUsed(new Array('i', 'u', 'a', 'g', 'n', 't'));
    if ((!isArray(arrAccesskeyUsed)) || (arrAccesskeyUsed.length === 0))
        return 'a';
    var arrAccesskeyPossible = new Array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z');
    var intCount;
    if (booCapsLock === true) {
        var arrAccesskeyPossibleCapsLock = [];
        for (intCount = 0; arrAccesskeyPossible.length > intCount; ++intCount)
            arrAccesskeyPossibleCapsLock[arrAccesskeyPossibleCapsLock.length] = arrAccesskeyPossible[intCount].toUpperCase();
        for (intCount = 0; arrAccesskeyPossibleCapsLock.length > intCount; ++intCount)
            arrAccesskeyPossible[arrAccesskeyPossible.length] = arrAccesskeyPossibleCapsLock[intCount];
    }
//    var strAccesskeyLast = arrAccesskeyUsed.sort().reverse().shift();
//    for (intCount = 0; arrAccesskeyPossible.length > intCount; ++intCount)
//        if (arrAccesskeyPossible[intCount] == strAccesskeyLast)
//            return (empty(arrAccesskeyPossible[intCount + 1])) ? arrAccesskeyPossible[intCount] : arrAccesskeyPossible[intCount + 1];
    for (intCount = 0; arrAccesskeyPossible.length > intCount; ++intCount)
        if ((array_search(arrAccesskeyPossible[intCount], arrAccesskeyUsed) != -1) && (array_search(arrAccesskeyPossible[intCount + 1], arrAccesskeyUsed) == -1))
            return (empty(arrAccesskeyPossible[intCount + 1])) ? arrAccesskeyPossible[intCount] : arrAccesskeyPossible[intCount + 1];
    return false;
}

function clearSelect(mixSelect)
{
    var select = getObject(mixSelect);
    if (empty(select))
        return false;
    var arrOption = select.childNodes;
    var optionFirst;
    if ((arrOption.length > 0) && (arrOption[0].value === '')) {
        optionFirst = document.createElement('OPTION');
        optionFirst.value = arrOption[0].value;
        optionFirst.innerHTML = arrOption[0].innerHTML;
    }
    removeChildNodes(select);
    if (!empty(optionFirst))
        select.appendChild(optionFirst);
    return true;
}

function clearValueElement(mixElement)
{
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    if ($(element).prop('tagName') == 'SELECT')
        clearSelect(element);
    else
        element.value = '';
    return true;
}/**
 * Converte uma string data (DD/MM/YYYY ou YYYY-MM-DD) em objeto data.
 *
 * @param string strDate
 * @return mix
 */
function strToDate(strDate)
{
    if ((empty(strDate)) || ((strDate.indexOf('/') == -1) && (strDate.indexOf('-') == -1)))
        return false;
    var arrDate;
    var intYear;
    var intDay;
    if (strDate.indexOf('/') != -1) {
        arrDate = explode('/', strDate);
        intYear = arrDate[2];
        intDay = arrDate[0];
    } else {
        arrDate = explode('-', strDate);
        intYear = arrDate[0];
        intDay = arrDate[2];
    }
    var intMonth = parseInt(arrDate[1]) - 1;
    var intHour = 0;
    var intMinute = 0;
    var intSec = 0;
    if (strDate.indexOf(' ') != -1) {
        var arrTime = explode(' ', strDate);
        arrTime = explode(':', arrTime[arrTime.length - 1]);
        intHour = arrTime[0];
        intMinute = arrTime[1];
        intSec = arrTime[2];
    }
    return new Date(parseInt(intYear), intMonth, parseInt(intDay), parseInt(intHour), parseInt(intMinute), parseInt(intSec));
}

function convertDate(mixDate, strFormat)
{
    if (empty(strFormat))
        strFormat = 'd/m/Y';
    var date = (isObject(mixDate)) ? mixDate : strToDate(mixDate);
    if (!date)
        return false;
    var strValue = strFormat;
    strValue = replaceAll(strValue, 'd', str_pad(date.getDate(), 2, '0', 'STR_PAD_LEFT'));
    strValue = replaceAll(strValue, 'm', str_pad(date.getMonth() + 1, 2, '0', 'STR_PAD_LEFT'));
    strValue = replaceAll(strValue, 'Y', str_pad(date.getFullYear(), 4, '0', 'STR_PAD_LEFT'));
    strValue = replaceAll(strValue, 'H', str_pad(date.getHours(), 2, '0', 'STR_PAD_LEFT'));
    strValue = replaceAll(strValue, 'i', str_pad(date.getMinutes(), 2, '0', 'STR_PAD_LEFT'));
    strValue = replaceAll(strValue, 's', str_pad(date.getSeconds(), 2, '0', 'STR_PAD_LEFT'));
    return strValue;
}

/**
 * Retorna a diferenca que existe entre duas datas no formato DD/MM/YYYY ou YYYY-MM-DD, em dias
 *
 * @param STRING strDate1
 * @param STRING strDate2
 * @return INTEGER
 */
function dateDiff(strDate1, strDate2)
{
    if ((empty(strDate1)) || (empty(strDate2)))
        return false;
    var date1 = strToDate(strDate1);
    var date2 = strToDate(strDate2);
    var intDiff = (date2.getTime() > date1.getTime()) ? (date2.getTime() - date1.getTime()) : (date1.getTime() - date2.getTime());
    return Math.floor(intDiff / (60 * 60 * 24 * 1000));
}

/**
 * Verifica se a data inicial eh maior que a data final, 
 * dentro de elementos inputs
 *
 * @param MIX mixDataInicial 
 * @param MIX mixDataFinal
 * @return BOOL 
 */
function compareDates(mixDataInicial, mixDataFinal)
{
    var dataInicial = getObject(mixDataInicial);
    var dataFinal = getObject(mixDataFinal);
    if ((empty(dataInicial)) || (empty(dataFinal)))
        return false;
    return compareDatesValues(dataInicial.value, dataFinal.value);
}

/**
 * Verifica se a data inicial eh maior que a data final
 *
 * @param STRING strDataInicial 
 * @param STRING strDataFinal
 * @return BOOL 
 */
function compareDatesValues(strDataInicial, strDataFinal)
{
    if ((empty(strDataInicial)) || (empty(strDataFinal)))
        return false;
    if ((strDataInicial.length < 10) || (strDataFinal.length < 10))
        return false;
    if (convertDate(strDataInicial, 'YmdHis') > convertDate(strDataFinal, 'YmdHis')) {
        alertDialog('A data inicial deve ser sempre menor ou igual a data final.', 'Validação', 250, 150);
        return false;
    }
    return true;
}function getBrowser()
{
    return navigator.userAgent || navigator.vendor || window.opera;
}

/**
 * Confere se o navegador eh internet explorer ou nao
 *
 * @return BOOL
 */
function isIE()
{
    return document.all;
}

function isChrome()
{
    return getBrowser().toLowerCase().indexOf('chrome') > -1;
}

function isFirefox()
{
    return getBrowser().toLowerCase().indexOf('firefox') > -1;
}

function isMobile()
{
    var booCheck = false;
    (function (a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
            booCheck = true
    })(getBrowser());
    return booCheck;
}

function isMobileWidth()
{
    return (getWindowWidth() <= 768);
}

function getWindowWidth()
{
    return window.innerWidth;
}

function getWindowHeight()
{
    return window.innerHeight;
}/**
 * Concatena todos os itens de um array ligando-os por um string
 *
 * @param STRING strGlue
 * @param ARRAY arrPieces
 * @return STRING
 */
function implode(strGlue, arrPieces)
{
    if (empty(arrPieces))
        return 'undefined';
    var strResult = '';
    for (var intCount = 0; intCount < arrPieces.length; ++intCount) {
        if (strResult !== '')
            strResult += strGlue;
        strResult += arrPieces[intCount];
    }
    return strResult;
}

/**
 * Quebra uma expressao (com uma string de separacao) em array
 *
 * @param STRING strSeparator
 * @param STRING strText
 * @return ARRAY
 */
function explode(strSeparator, strText)
{
    strText += '';
    strSeparator += '';
    var intCount = 0;
    var intCountMax = strText.length;
    var arrResult = [];
    var intSeparatorPos = strText.indexOf(strSeparator);
    var boolInsert = true;
    var strBefore;
    var strAfter;
    while ((intSeparatorPos != -1) && (intCount < intCountMax)) {
        if (intSeparatorPos === 0) {
            strBefore = strText.substr(0, 1);
            strAfter = strText.substr(1);
            boolInsert = false;
        } else {
            strBefore = strText.substr(0, intSeparatorPos);
            strAfter = strText.substr(intSeparatorPos + 1);
        }
        if (!empty(strBefore))
            arrResult.push(strBefore);
        strText = strAfter;
        intSeparatorPos = strText.indexOf(strSeparator);
        ++intCount;
    }
    if (boolInsert)
        arrResult.push(strText);
    return arrResult;
}

/**
 * Funcao que realiza um cast array, ou seja, converte um objeto em array
 *
 * @param OBJECT object
 * @param BOOLEAN booOriginalKey
 * @return ARRAY
 */
function parseArray(object, booOriginalKey)
{
    if (empty(object))
        return false;
    if (empty(booOriginalKey))
        booOriginalKey = false;
    var arrNew = [];
    if (object.length) {
        for (var intCount = 0; intCount < object.length; ++intCount)
            arrNew[intCount] = object[intCount];
    } else {
        for (var strAttribute in object) {
            if (!isFunction(object[strAttribute]))
                arrNew[(booOriginalKey) ? strAttribute : arrNew.length] = object[strAttribute];
        }
    }
    return arrNew;
}

/**
 * Funcao que realiza um cast array, ou seja, converte um objeto em array
 *
 * @param MIX mixElement
 * @param INTEGER intDepthOfRecursive
 * @return ARRAY
 */
function parseArrayRecursive(mixElement, intDepthOfRecursive)
{
    if (empty(intDepthOfRecursive))
        intDepthOfRecursive = -1;
    if (intDepthOfRecursive > 0)
        --intDepthOfRecursive;
    else {
        if (intDepthOfRecursive === 0)
            return mixElement;
        if (intDepthOfRecursive < 0)
            return null;
    }
    var arrNew = [];
    if (empty(mixElement)) {
        // mixElemento vazio
    } else if (isString(mixElement) || isNumber(mixElement) || isBoolean(mixElement))
        arrNew[arrNew.length] = mixElement;
    else if (mixElement.length) {
        for (var intCount = 0; intCount < mixElement.length; ++intCount)
            arrNew[intCount] = parseArrayRecursive(mixElement[intCount], intDepthOfRecursive);
    }
    else if (mixElement.innerHTML)
        arrNew = mixElement.innerHTML;
    else if (isObject(mixElement)) {
        for (var strAttribute in mixElement) {
            if (!isFunction(mixElement[strAttribute]))
                arrNew[arrNew.length] = parseArrayRecursive(mixElement[strAttribute], intDepthOfRecursive);
        }
    } else
        arrNew = null;
    return arrNew;
}

/**
 * Procura por um elemento no array e retorna sua posicao caso seja 
 * encontrado, ou -1 caso nao encontre
 *
 * @param MIX mixElement
 * @param ARRAY arrContainer
 * @param INTEGER intNumElementsArray
 * @param INTEGER
 */
function array_search(mixElement, arrContainer, intNumElementsArray)
{
    if (!arrContainer)
        return -1;
    for (var intCount = 0; intCount < arrContainer.length; ++intCount) {
        if (empty(intNumElementsArray)) {
            if (arrContainer[intCount] == mixElement)
                return intCount;
        } else {
            var mixNumElementsArrayParam = [];
            if ((isArray(mixElement)) && (isArray(arrContainer[intCount]))) {
                mixNumElementsArrayParam = intNumElementsArray;
                if (mixElement.length < intNumElementsArray)
                    mixNumElementsArrayParam = mixElement.length;
                if (arrContainer[intCount].length < intNumElementsArray)
                    mixNumElementsArrayParam = arrContainer[intCount].length;
            }
            var boolEqual = true;
            for (var intCount2 = 0; intCount2 < mixNumElementsArrayParam; ++intCount2) {
                if (mixElement[intCount2] != arrContainer[intCount][intCount2]) {
                    boolEqual = false;
                    break;
                }
            }
            if (boolEqual)
                return intCount;
        }
    }
    return -1;
}

/**
 * Insere um valor no array caso o valor nao exista no mesmo.
 *
 * @param ARRAY arrElements
 * @param MIX mixValue
 * @return ARRAY
 */
function insertDistinctValueIntoArray(arrElements, mixValue)
{
    if ((empty(arrElements)) || (empty(mixValue)))
        return false;
    if (array_search(mixValue, arrElements) == -1)
        arrElements[arrElements.length] = mixValue;
    return arrElements;
}

function clearEmptyParam(arrParam)
{
	for (var mixKey in arrParam)
		if (empty(arrParam[mixKey]))
			delete arrParam[mixKey];
	return arrParam;
}var arrGlobalIncludeOnce = [];
function include(strFilePath, booHead)
{
    if ((empty(strFilePath)) || (strFilePath == 'null'))
        return;
    if (intGlobalGulp == 1) {
    	if (
    	    (strFilePath.indexOf('InepZend/js/') != -1) ||
    	    (strFilePath.indexOf('InepZend/angular/Util/') != -1) ||
    	    (strFilePath.indexOf('InepZend/angular/Service/') != -1) ||
    	    (strFilePath.indexOf('InepZend/theme/') != -1) ||
    	    (strFilePath.indexOf('InepZend/menu/') != -1) ||
    	    (strFilePath.indexOf('jquery.min.js') != -1) ||
    	    (strFilePath.indexOf('bootstrap.min.js') != -1) ||
    	    (strFilePath.indexOf('jquery.migrate.') != -1) ||
    	    (strFilePath.indexOf('placeholders.jquery.') != -1) ||
    	    (strFilePath.indexOf('jquery.gritter.') != -1) ||
    	    (strFilePath.indexOf('jquery.alphanumeric.') != -1) ||
    	    (strFilePath.indexOf('angular.min.js') != -1) ||
    	    (strFilePath.indexOf('jquery.maskedinput.') != -1) ||
    	    (strFilePath.indexOf('jquery.validate.') != -1) ||
    	    (strFilePath.indexOf('jquery.base64.') != -1) ||
    	    (strFilePath.indexOf('jquery.maskmoney.') != -1) ||
    	    (strFilePath.indexOf('extend.') != -1) ||
    	    (strFilePath.indexOf('loading-bar.') != -1)
    	)    
    	    return;
    }
    arrGlobalIncludeOnce[arrGlobalIncludeOnce.length] = strFilePath;
    if ((document.all) && (intGlobalOptimizer == 1))
        strFilePath = replaceAll(strFilePath, '.php', '');
    if (!isBoolean(booHead))
        booHead = true;
    var booExternal = (strFilePath.indexOf(':/') != -1);
    var strSource = (!booExternal) ? strGlobalBasePath + strFilePath : strFilePath;
    if (booHead) {
		var script = document.createElement('SCRIPT');
        script.setAttribute('type', 'text/javascript');
        script.setAttribute('src', strSource);
        $('head').append(script);
    } else
        document.body.innerHTML += unescape("%3Cscript src='" + strSource + "' type='text/javascript' defer%3E%3C/script%3E");
}

function include_once(strFilePath, booHead)
{
	if ((empty(strFilePath)) || (strFilePath == 'null') || (array_search(strFilePath, arrGlobalIncludeOnce) != -1))
        return;
    var arrScript = document.getElementsByTagName('SCRIPT');
    for (var intCount = 0; intCount < arrScript.length; ++intCount) {
        var script = arrScript[intCount];
        if ((!empty(script)) && (!empty(script.src)) && (script.src == strFilePath))
            return;
    }
    include(strFilePath, booHead);
}

$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
	if ((options.dataType == 'script') || (originalOptions.dataType == 'script'))
		options.cache = true;
});/**
 * Responsavel pelo menu administrative responsible
 */
function getIndexMenuCookie()
{
    var strIndexMenuCookie = getCookie('indexMenu');
    if (empty(strIndexMenuCookie))
        strIndexMenuCookie = '';
    return strIndexMenuCookie;
}

function setIndexMenuCookie(strIndexMenuCookie)
{
    return setCookie('indexMenu', strIndexMenuCookie);
}

function clearIndexMenuCookie()
{
    return setIndexMenuCookie('');
}

function getIndexMenu(element)
{
    if (empty(element))
        return;
    var strIndexMenu = '';
    var intMaxLoop = 0;
    while (((element.parent().prop('tagName') == 'UL') || (element.parent().prop('tagName') == 'LI')) && (intMaxLoop <= 10)) {
        if (element.prop('tagName') == 'A') {
            var arrIndexMenu = explode('<', element.html());
            strIndexMenu += jQuery.trim(arrIndexMenu[0]);
            if ((strIndexMenu === '') || (strIndexMenu == '<')) {
                strIndexMenu = '';
                arrIndexMenu = explode('>', element.html());
                arrIndexMenu = explode('<', arrIndexMenu[2]);
                strIndexMenu += jQuery.trim(arrIndexMenu[0]);
            }
        }
        if ((element.prop('tagName') == 'UL') || (element.prop('tagName') == 'LI'))
            strIndexMenu += '-' + element.index();
        element = element.parent();
        ++intMaxLoop;
    }
    return '[' + strIndexMenu + ']';
}

var booGlobalEditMenu = false;
function editMenu()
{
    if (booGlobalEditMenu)
        return;
//    clearIndexMenuCookie();
    var strIndexMenuCookie = getIndexMenuCookie();
    $('#menu-administrative-responsible li ul').each(function () {
        var strIndexMenu = getIndexMenu($(this).parent().children('a'));
        var strClass = 'up';
        if (strIndexMenuCookie.indexOf(strIndexMenu) == -1) {
            $(this).addClass('hide');
            strClass = 'down';
        }
        $(this).parent().children('a').append('<i class="fa fa-angle-' + strClass + ' pull-right"></i>');
    });
    editClickMenu();
    if ($('#menu-administrative-responsible .active').length > 1) {
        var arrElementActive = $('#menu-administrative-responsible .active'),
                intCountActive = arrElementActive.length - 1;
        arrElementActive.each(function (intPosicao) {
            if (intPosicao < intCountActive)
                $(this).removeClass('active');
        });
    }
    booGlobalEditMenu = true;
}

function editClickMenu()
{
    $('#menu-administrative-responsible a').on('click', function (event) {
        var elementList = $(this).parent().children('ul');
        if (elementList.length) {
            var strIndexMenu = getIndexMenu($(this));
            var strIndexMenuCookie = getIndexMenuCookie();
            if (elementList.hasClass('hide')) {
                $(this).children('i:last').removeClass('fa-angle-down').addClass('fa-angle-up');
                elementList.removeClass('hide');
                strIndexMenuCookie += strIndexMenu;
            } else {
                $(this).children('i:last').removeClass('fa-angle-up').addClass('fa-angle-down');
                elementList.addClass('hide');
                strIndexMenuCookie = replaceAll(strIndexMenuCookie, strIndexMenu, '');
            }
            setIndexMenuCookie(strIndexMenuCookie);
        } else 
        	angular.element(this).scope().clickMenu(event);
    });
}

function scriptMenuBootstap()
{
	editMenu();
    $('#inepZendMenuBootstrapMenu').show();
    $('#inepZendMenuBootstrapBreadcrumbs').show();
    $('.menu-personalizado ul').addClass('dropdown-menu');
    $('.menu-personalizado li').each(function () {
        if ($(this).children('ul').length) {
            $(this).addClass('dropdown');
            $(this).children('a').attr('data-toggle', 'dropdown').addClass('dropdown-toggle');
            if (!$(this).parent('ul').hasClass('dropdown-menu'))
                $(this).children('a').html($(this).children('a').html() + '<b class="caret"></b>');
        }
    });
    $('ul.dropdown-menu').each(function () {
        if ($(this).children('li').children('ul').length) {
            $(this).children('li').children('a').removeClass('dropdown-toggle');
            $(this).children('li').find('ul').parent().addClass('dropdown-submenu');
        }
    });
    if ($('.menu-personalizado').hasClass('hide'))
        $('.menu-personalizado').removeClass('hide');
}

$(document).ready(function () {
	scriptMenuBootstap();
});

function enableMenuReponsible()
{
    $('#contentContainer #contentApplication').removeClass('col-md-12 col-md-offset-0').addClass('col-md-10 col-md-offset-2');
    $('#menu-administrative-responsible').removeClass('hidden');
    $('#menu-administrative-responsible').removeAttr('style');
    setCookie('menu-toggle-responsible-not-fix', true, undefined, '/');
}

function disableMenuReponsible()
{
    $('#contentContainer #contentApplication').removeClass('col-md-10 col-md-offset-2').addClass('col-md-12 col-md-offset-0');
    $('#menu-administrative-responsible').addClass('hidden');
    $('#menu-administrative-responsible').attr('style', 'display: none; visibility: hidden');
    setCookie('menu-toggle-responsible-not-fix', false, undefined, '/');
}

function addIcoMenuBar()
{
    if (($('#userAuthenticated').length) && ($('body #btn-menu-administrative-responsible').length)) {
        $('.navbar-header a').attr('style', 'padding-left: 40px;');
        $('.navbar-header button:first').after('<a class="navbar-brand open-menu-administrative-responsible-not-fix pull-left" style="cursor: pointer;"><i class="fa fa-bars" style="color: white"></i></a>');
    }
}

function scriptMenuNotFix(booClick)
{
	if (booClick !== false) {
		$('body').on('click', '.open-menu-administrative-responsible-not-fix, #btn-menu-administrative-responsible', function () {
	        if ($('#contentContainer #contentApplication').hasClass('col-md-12 col-md-offset-0')) {
	            enableMenuReponsible();
	        } else {
	            if ($('#contentContainer').hasClass('container-menu-responsible')) {
	                enableMenuReponsible();
	                $('#contentContainer').removeClass('container-menu-responsible');
	                return false;
	            }
	            disableMenuReponsible();
	        }
	    });
	}
    if ($('#userAuthenticated').length) {
        $('#menu-administrative-responsible').attr('style', 'display: none; visibility: hidden');
        $('#contentContainer .content').removeClass('col-md-10 col-md-offset-2').addClass('col-md-12 col-md-offset-0');
        if ((booClick !== false) && (getCookie('menu-toggle-responsible-not-fix') == "true"))
            $('.open-menu-administrative-responsible-not-fix').trigger('click');
    }
}function formValidate() {
    include_once('/vendor/jquery-validate/jquery-validate-1.11.0pre/jquery.validate.js' + strGlobalSufixJsGzip);
    $.extend($.validator.messages, {
        required: function (mixValue, element) {
            var strName = getNameFromElement(element);
            eval('var strMessage = (jsonGlobalFilterMessageRequired.hasOwnProperty(strName)) ? jsonGlobalFilterMessageRequired.' + strName + ' : undefined;');
            if ($('#' + strName).hasClass('editorFormElement') === true  && getObject(strName).getAttribute('maxlength') !== undefined)
                validateMaxlengthEditor(strName, strMessage);
            else {
                if ((!empty(strName)) && (strName.indexOf('[]') === -1)) {
                    return (empty(strMessage)) ? 'Campo obrigatório.' : strMessage;
                }
                return 'Campo obrigatório.';
            }
        },
        email: 'E-mail inválido.',
        url: 'URL inválida.',
        date: 'Data inválida.',
        dateISO: 'Data (ISO) inválida.',
        number: 'Número inválido.',
        digits: 'Somente dígitos.',
        creditcard: 'Número do cartão inválido.'
    });
    $.validator.setDefaults({
        errorElement: 'div',
        ignoreTitle: true,
    });
    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i.test(value);
    };
    $('.classForm').each(function (index) {
        $(this).validate({
            ignore: ".ignore, input:hidden:not(.required), .ui-grid-pager-control-input",
            errorPlacement: function (arrError, element) {
                arrError.appendTo(element.prev());
                return setErrorIntoLabel(element, false, arrError);
            },
            onclick: function (element, event) {
                if ($(element).prop('tagName') != 'OPTION')
                    return;
                checkElementValueRequired(element.parentNode);
                if (element.name in this.submitted)
                    this.element(element);
                else if (element.parentNode.name in this.submitted)
                    this.element(element.parentNode);
                setErrorIntoLabel(element);
            },
            onkeyup: function (element, event) {
                if ((event.which === 9) && (this.elementValue(element) === ''))
                    return;
                else if ((element.name in this.submitted) || (element === this.lastElement))
                    this.element(element);
                setErrorIntoLabel(element);
            },
            onfocusout: function (element, event) {
                if ((!this.checkable(element)) && ((element.name in this.submitted) || (!this.optional(element)))) {
                    var currentObj = this;
                    var currentElement = element;
                    var delay = function () {
                        currentObj.element(currentElement);
                    };
                    setTimeout(delay, 0);
                }
                setErrorIntoLabel(element);
            },
            invalidHandler: function (element, validator) {
                if ((isMobile()) && (strGlobalThemeDefined == 'AdministrativeResponsible') && ($('.error').length))
                    upFirstError();
            }
        });
    });
}

function upFirstError() {
    $('html, body').animate({
        scrollTop: ($('.error').first().parent().offset().top - $('.header-banner').first().parent().offset().top)
    }, 'linear');
}

function setErrorIntoLabel(element, booValid, arrError) {
    if (empty(element))
        return false;
    if (!isBoolean(booValid))
        booValid = true;
    if ((!empty(element.tagName)) && (element.tagName.toUpperCase() == 'OPTION'))
        element = element.parentNode;
    if ((!empty(element.tagName)) && (element.tagName.toUpperCase() == 'OPTGROUP'))
        element = element.parentNode;
    if (booValid) {
        if (!isString(parseInt(element.name))) {
            var strName = element.name;
            $(element).attr('name', '_' + strName);
            $(element).valid();
            $(element).attr('name', strName);
        } else
            $(element).valid();
    }
    var arrLabel = getElementsFromAttribute(document.body, 'LABEL', 'for', $(element).attr('name'));
    if (arrLabel.length === 0)
        arrLabel = getElementsFromAttribute(document.body, 'LABEL', 'for', $(element).attr('id'));
    if (arrLabel.length === 0)
        arrLabel = getElementsFromAttribute(document.body, 'LABEL', 'for', strGlobalPrefixDdd + $(element).attr('name'));
    if (element instanceof jQuery) {
        if (strGlobalThemeDefined == 'AdministrativeResponsible') {
            if ((element.css('float') == 'left') && (element.next().attr('class') != 'helpText'))
                element.css('float', 'none');
        }
        element = element.get();
    }
    if (arrLabel.length > 0) {
        var label = arrLabel[0];
        if (empty(arrError))
            arrError = getElementsFromAttribute(document.body, 'DIV', 'for', $(element).attr('name'));
        if (empty(arrError))
            arrError = getElementsFromAttribute(document.body, 'DIV', 'for', $(element).attr('id'));
        if (empty(arrError))
            arrError = getElementsFromAttribute(document.body, 'DIV', 'for', strGlobalPrefixDdd + $(element).attr('name'));
        if (arrError.length > 0) {
            var errorElement = arrError[0];
            errorElement.style.fontSize = '9px';
            errorElement.style.marginTop = '-21px';
            if (strGlobalThemeDefined == 'AdministrativeResponsible') {
                errorElement.style.fontSize = '13px';
                errorElement.style.marginTop = '0px';
                if ($(element).parent().find('.helpText').length)
                    errorElement.style.marginTop = '38px';
                var parentElement = $(element).parent();
                if (parentElement.attr('class') == 'divMultiCheckRadio')
                    parentElement = $(parentElement).parent();
                parentElement.append(errorElement);
            } else
                label.appendChild(errorElement);
            if ((isMobile()) && (strGlobalThemeDefined == 'AdministrativeResponsible')) {
                $('html, body').animate({
                    scrollTop: ($('.error').first().parent().offset().top - $('.header-banner').first().parent().offset().top)
                }, 'linear');
            }
        }
    }
    return true;
}

function getNameFromElement(element) {
    if (empty(element))
        return false;
    var strAttribute;
    if (jsonGlobalFilterMessageRequired.hasOwnProperty(element.getAttribute('name')))
        strAttribute = element.getAttribute('name');
    else {
        var strName = element.getAttribute('name');
        if (strName.indexOf('[input]') != -1)
            strName = replaceAll(strName, '[input]', '');
        if (jsonGlobalFilterMessageRequired.hasOwnProperty(strName))
            strAttribute = strName;
        else {
            var strId = element.getAttribute('id');
            if (jsonGlobalFilterMessageRequired.hasOwnProperty(strId))
                strAttribute = strId;
            else
                strAttribute = $(element).attr('name');
        }
    }
    return strAttribute;
}

function checkElementValueRequired(mixElement) {
    var element = getObject(mixElement);
    if (empty(element))
        return false;
    if (($(element).val() !== null) || ((isSelectMultiple(element)) && (element.length !== 0)))
        $('div.error[for="' + element.getAttribute('id') + '"]').remove();
    else {
        $('div.error[for="' + element.getAttribute('id') + '"]').show();
        $(element).addClass('error');
    }
    return true;
}

function validateFieldConfirmationEmail(mixElementConfirmation, mixElement) {
    mixElementConfirmation = getObject(mixElementConfirmation);
    mixElement = getObject(mixElement);
    if ((mixElement.value !== '') && (mixElementConfirmation.value !== ''))
        return validateValueFieldConfirmation(mixElement.value, mixElementConfirmation.value, mixElementConfirmation);
    return true;
}

function validateFieldConfirmationTelefone(mixElementConfirmation, mixElement) {
    var strPhoneConfirmation = '',
        strPhone = '';
    if ((mixElementConfirmation.indexOf("nu_ddd") !== -1)) {
        strPhoneConfirmation = getObject(mixElementConfirmation).value;
        strPhoneConfirmation += getObject(replaceAll(mixElementConfirmation, 'nu_ddd_', '')).value;
        strPhone = getObject(mixElement).value;
        strPhone += getObject(replaceAll(mixElement, 'nu_ddd_', '')).value;
    } else {
        strPhoneConfirmation = getObject('nu_ddd_' + mixElementConfirmation).value;
        strPhoneConfirmation += getObject(mixElementConfirmation).value;
        strPhone = getObject('nu_ddd_' + mixElement).value;
        strPhone += getObject(mixElement).value;
    }
    if ((strPhoneConfirmation.length > 3) && (strPhone.length > 3))
        return validateValueFieldConfirmation(strPhone, strPhoneConfirmation, getObject(mixElementConfirmation));
    return true;
}

function validateValueFieldConfirmation(strValue, strValueConfirmation, mixElementConfirmation) {
    if (strValueConfirmation !== strValue) {
        alertDialog('Valor de confirmação não confere!', 'Validação', 300, 200);
        mixElementConfirmation.value = '';
        return false;
    }
    return true;
}

function validateMaxlengthEditor(strName, strMessage) {
    if (strMessage === undefined) {
        strMessage = '';
    }
    var intCountEditorCaracter = tinymce.get(strName).getContent().length,
    	intCountTextarea = getObject(strName).getAttribute('maxlength');
    if (intCountEditorCaracter > intCountTextarea && intCountTextarea !== null) {
        var strMessageEditor = 'O Campo "' + $.trim($('label[for="' + strName + '"]').text()) + '" ultrapassou o limite de caracteres permitidos.';
        return (empty(strMessage)) ? strMessageEditor : strMessage;
    }
    return null;
}

function hasValidateEditorTinymce(strName) {
    var strMessageError = validateMaxlengthEditor(strName);
    if (strMessageError !== null) {
        $('textarea#' + strName).parent().append('<div for="' + strName + '" class="error error-caracter-tinyMCE">' + strMessageError + '</div>');
        return false;
    }
    $('#' + strName).val(tinyMCE.get(strName).getContent());
    if ($('form').valid() === true) {
        $('form').submit();
        return true;
    }
    if ($('.error[for="' + strName + '"]').html() === '') {
        $('.error[for="' + strName + '"]').html(eval('jsonGlobalFilterMessageRequired.' + strName))
    }
    return false;
}

$(document).ready(function () {
    if (!empty(formValidate))
        formValidate();
});
function scriptContrast()
{
    if (getCookie('contrast_theme') === 'true')
        $('body').addClass('contrast');
    $('a.contrast').on('click', function (element) {
        element.preventDefault();
        $('body').toggleClass('contrast');
        ($('body').hasClass('contrast')) ? setCookie('contrast_theme', true, undefined, '/') : setCookie('contrast_theme', false, undefined, '/');
    });
}

$(document).ready(function () {
	scriptContrast();
});var jcrop_api;

/**
 *
 * @param {type} strFileName
 * @param {type} strIdButton
 * @returns {undefined}
 */
function managerImageCrop(strFileName, strIdButton)
{
    $('#img_' + strFileName).Jcrop({
        onChange: exibePreview,
        onSelect: exibePreview,
    }, function () {
        jcrop_api = this;
    });
    jcrop_api.enable();
    updateButton(strFileName, strIdButton, 'Salvar Recorte', 'cropImagem');
}

/**
 *
 * @param {type} coordinateImage
 * @returns {undefined}
 */
function exibePreview(coordinateImage)
{
    var strCoordinate = coordinateImage.w + '|' + coordinateImage.h + '|' + coordinateImage.x + '|' + coordinateImage.y;
    if (!$('#coord_image_crop').length)
        createHiddenIntoRepository('formAjaxUpload', 'coord_image_crop', 'coord_image_crop', null);
    $('#coord_image_crop').val(strCoordinate);
}

/**
 *
 * @param {type} strFileName
 * @param {type} strIdButton
 * @param {type} strLabel
 * @param {type} strFunction
 * @returns {undefined}
 */
function updateButton(strFileName, strIdButton, strLabel, strFunction)
{
    var buttonImagem = $('#' + strIdButton);
    buttonImagem.attr('title', strLabel).attr('value', strLabel).data('type-action', 'salve').attr('onclick', strFunction + "('" + strFileName + "', '" + strIdButton + "');");
    buttonImagem.html(strLabel);
    buttonImagem.focus();
}

/**
 *
 * @param {type} strIdButton
 * @returns {undefined}
 */
function enableButtonCrop(strIdButton)
{
    $('#btn_crop_' + strIdButton).removeClass('hide');
}
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