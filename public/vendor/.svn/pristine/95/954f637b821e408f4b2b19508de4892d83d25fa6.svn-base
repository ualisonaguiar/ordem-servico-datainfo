var strGlobalCepValue;
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
}