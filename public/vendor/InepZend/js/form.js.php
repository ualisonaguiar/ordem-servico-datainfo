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
/**
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
}