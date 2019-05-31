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
}