/**
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
}