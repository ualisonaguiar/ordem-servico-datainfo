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
var iconGlobal;
var booRemovePersistence = false;
function removeFromCrud(icon, strPersistence)
{
    if (empty(icon))
        return false;
    iconGlobal = icon;
    if (!empty(strPersistence))
        booRemovePersistence = true;
    confirmDialog('Deseja realmente realizar a operação de EXCLUSÃO deste registro?', 'Operação de EXCLUSÃO', 300, 200, 'removeFromCrudAfterConfirm("' + strPersistence + '");');
    return true;
}

function removeFromCrudAfterConfirm(strPersistence)
{
    var tbody = iconGlobal.parentNode.parentNode.parentNode;
    if (tbody.childNodes.length == 1)
        $(tbody.parentNode.parentNode.parentNode.parentNode).hide();
    if (booRemovePersistence === true) {
        var arrParam = getJsonObject($(iconGlobal.parentNode).children('input').val());
        arrParam = parseArray(arrParam, true);
        var mixResult = ajaxRequest(strPersistence, arrParam, undefined, undefined, 'POST', 'json', false, false);
        if (mixResult.status === true) {
            $(iconGlobal.parentNode.parentNode).remove();
            iconGlobal = undefined;
            return true;
        } else
            alertDialog(mixResult.message, 'Erro', 350, 160);
        return true;
    }
    $(iconGlobal.parentNode.parentNode).remove();
    iconGlobal = undefined;
    return true;
}

function insertIntoCrud(strTableName, strExtensionPermited, strUrlPersistence, booRequired, strJsEvalValidate)
{
    if (empty(strTableName))
        return false;
    var mixResult;
    if (!empty(strJsEvalValidate)) {
        eval('mixResult = ' + strJsEvalValidate + ';');
        if (mixResult !== true)
            return false;
    }
    var divTable = getObject(strTableName);
    if (empty(divTable))
        return false;
    if (empty(booRequired))
        booRequired = false;
    var arrElement = getElementsByAttribute(document.body, '*', 'data-domain', strTableName);
    var arrParam = [];
    var register = {};
    var element;
    var elementOther;
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        element = arrElement[intCount];
        arrParam[element.getAttribute('name')] = $(element).val();
        if ((empty(strJsEvalValidate)) && ($(element).val() === '')) {
            if ((!booRequired) || ((booRequired) && (element.getAttribute('required')))) {
                alertDialog('É necessário preencher as devidas informações para que a operação possa ser realizada com sucesso!', 'Validação', 300, 200);
                return false;
            }
        }
        var strElementName = element.getAttribute('name');
        if ((strElementName.indexOf('_confirmacao') != -1) || (strElementName.indexOf('Confirmacao') != -1)) {
            elementOther = getObject(replaceAll(replaceAll(strElementName, '_confirmacao', ''), 'Confirmacao', ''));
            if ((!empty(elementOther)) && ($(element).val() != $(elementOther).val())) {
                alertDialog('Valor de confirmação não confere!', 'Validação', 300, 200);
                return false;
            }
        }
        if (element.type == 'file') {
            mixResult = ajaxUpload(element, undefined, undefined, '/ajaxuploadfile/' + strExtensionPermited);
            var json = getJsonObject(mixResult.responseText);
            if (json.status != 'ok') {
                var strMessage = json.messages;
                if (empty(strMessage))
                    strMessage = 'Ocorreu um erro e a operação não pôde ser realizada!';
                alertDialog(strMessage, 'Erro', 350, 160);
                return false;
            }
            register[element.getAttribute('name') + '[name]'] = $(element).val();
            register[element.getAttribute('name') + '[tmp_name]'] = json.file;
        } else {
            register[element.getAttribute('name')] = $(element).val();
            if (element.type == 'select-one')
                register[replaceAll(element.id, 'co', 'no')] = document.getElementById(element.id).options[document.getElementById(element.id).selectedIndex].text;
        }
        if (element.getAttribute('name') == 'txEmail') {
            strGlobalCheckValue = '';
            if (checkValue($(element).val(), 'email', true, getObject('txEmail')) === false) {
                return false;
            }
        }
    }
    if ((strTableName.indexOf('nu_telefone') != -1) || (strTableName.indexOf('tx_email') != -1)) {
    	var booExists = false;
    	$('.google-visualization-table-table tbody tr').each(function () {
    		var arrTd = $(this).find('td');
    		if (strTableName.indexOf('nu_telefone') != -1)
    			booExists = (arrTd[1].innerHTML.replace(/(-|\)|\(| )/g, "") == (register.nu_ddd_nuTelefone  + '' + register.nuTelefone).replace(/(-|\)|\(| )/g, ""));
    		else
    			booExists = (arrTd[1].innerHTML == (register.txEmail));
    		if (booExists)
    			return false;
    	});
    	if (booExists) {
    		alertDialog('Essa informação já existe na lista!', 'Validação', 300, 200);
    		return false;
    	}
    }
    $(divTable).show();
    var arrTh = $(divTable).find('thead tr th').get();
    if (arrTh.length === 0)
        return false;
    var arrTbody = $(divTable).find('tbody').get();
    if (arrTbody.length === 0)
        return false;
    var tbody = arrTbody[0];
    var trNew = document.createElement('TR');
    trNew.setAttribute('class', 'google-visualization-table-tr-even');
    var arrInputTitleStyle = getElementsFromAttribute(document.body, 'INPUT', 'name', strTableName + '[titleStyle]');
    var jsonTitleStyle = (arrInputTitleStyle.length > 0) ? getJsonObject(arrInputTitleStyle[0].value) : undefined;
    var arrInputIcon = getElementsFromAttribute(document.body, 'INPUT', 'name', strTableName + '[icon]');
    var jsonIcon = (arrInputIcon.length > 0) ? getJsonObject(arrInputIcon[0].value) : undefined;
    for (intCount = 0; intCount < arrTh.length; ++intCount) {
        var tdNew = document.createElement('TD');
        tdNew.setAttribute('class', 'google-visualization-table-td');
        var strTitleStyle = jsonTitleStyle[intCount];
        if (!empty(strTitleStyle))
            tdNew.style.cssText = strTitleStyle;
        var booIcon = false;
        if ((arrTh.length - 1) == intCount) {
            var strIcon = jsonIcon[0];
            if (!empty(strIcon)) {
                tdNew.innerHTML = '<input type="hidden" name="' + strTableName + '[]" value=\'' + JSON.stringify(register) + '\' />' + strIcon;
                booIcon = true;
            }
        }
        if (!booIcon) {
            element = arrElement[intCount];
            var strHtml;
            if (element.type == 'file')
                strHtml = '<a href="javascript:popup(\'' + strGlobalBasePath + strGlobalShowFileUrl + '?path=' + base64Encode(register[element.getAttribute('name') + '[tmp_name]']) + '\', \'popupInsertIntoCrud\');void(0);">' + register[element.getAttribute('name') + '[name]'] + '</a>';
            else {
                strHtml = (element.tagName.toUpperCase() == 'SELECT') ? $(element).find('option:selected').text() : $(element).val();
                if (element.getAttribute('name').indexOf(strGlobalPrefixDdd) === 0) {
                    strHtml = '(' + strHtml + ') ';
                    elementOther = getObject(replaceAll(element.getAttribute('name'), strGlobalPrefixDdd, ''));
                    if (!empty(elementOther))
                        strHtml += (elementOther.tagName.toUpperCase() == 'SELECT') ? $(elementOther).find('option:selected').text() : $(elementOther).val();
                }
            }
            tdNew.innerHTML = strHtml;
        }
        trNew.appendChild(tdNew);
    }
    if (!empty(strUrlPersistence)) {
        var request = ajaxRequest(strUrlPersistence, arrParam, undefined, undefined, 'POST', 'json', false, false);
        if (request.status === true) {
            tbody.appendChild(trNew);
            for (intCount = 0; intCount < arrElement.length; ++intCount)
                $(arrElement[intCount]).val("");
            return true;
        } else
            alertDialog(request.message, 'Erro', 350, 160);
        return true;
    }
    tbody.appendChild(trNew);
    for (intCount = 0; intCount < arrElement.length; ++intCount)
        $(arrElement[intCount]).val("");
    return true;
}