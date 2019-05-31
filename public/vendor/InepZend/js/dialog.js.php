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
var arrDialog, strGlobalHtmlForm;
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
dialogFunctions(jQuery);