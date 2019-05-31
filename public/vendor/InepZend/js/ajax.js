var DEBUG_AJAX = false;
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
}