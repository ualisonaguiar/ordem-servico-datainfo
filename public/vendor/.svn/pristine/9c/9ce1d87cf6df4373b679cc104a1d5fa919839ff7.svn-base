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
function formValidate() {
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
