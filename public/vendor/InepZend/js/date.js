/**
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
}