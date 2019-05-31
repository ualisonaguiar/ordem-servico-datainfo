function validateCpf(strCpf, booShowValidate, inputCpf)
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
}