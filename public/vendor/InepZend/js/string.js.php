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
 * Remove os espacos em branco dos extremos de um string
 *
 * @param STRING strText
 * @return STRING
 */
function trim(strText)
{
//    return ((!strText) ? "" : strText.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1"));
    return ((!strText) ? '' : strText.replace(/^\s*/, '').replace(/\s*$/, ''));
}

/**
 * Insere o primeiro caracter de uma string em caixa alta
 *
 * @param STRING strText
 * @return STRING
 */
function ucfirst(strText)
{
//    return ((!strText) ? '' : strText.substr(0, 1).toUpperCase() + strText.substr(1).toLowerCase());
    return ((!strText) ? '' : strText.substr(0, 1).toUpperCase() + strText.substr(1));
}

/**
 * Insere o primeiro caracter de uma string em caixa baixa
 *
 * @param STRING strText
 * @return STRING
 */
function lcfirst(strText)
{
    return ((!strText) ? '' : strText.substr(0, 1).toLowerCase() + strText.substr(1));
}

/**
 * Substitui todas as ocorrencias de um texto (ou array de textos) por outro
 *
 * @param STRING strText
 * @param MIX mixFinder
 * @param STRING strReplacer
 * @return STRING
 */
function replaceAll(strText, mixFinder, strReplacer)
{
    if (isArray(mixFinder)) {
        for (var intCount = 0; intCount < mixFinder.length; ++intCount)
            strText = replaceRegex(strText, mixFinder[intCount], strReplacer);
    } else
        strText = replaceRegex(strText, mixFinder, strReplacer);
    return strText;
}

/**
 * Substitui todas as ocorrencias de um texto por outro
 *
 * @param STRING strText
 * @param STRING strFinder
 * @param STRING strReplacer
 * @return STRING
 */
function replaceRegex(strText, strFinder, strReplacer)
{
    if ((empty(strText)) || (empty(strFinder)) || (strReplacer === undefined) || (strReplacer === null))
        return;
    strText += '';
    var strSpecials = /(\.|\*|\^|\?|\&|\$|\+|\-|\#|\!|\(|\)|\[|\]|\{|\}|\|)/gi;
    strFinder = strFinder.replace(strSpecials, '\\$1');
    var regExp = new RegExp(strFinder, 'gi');
    return strText.replace(regExp, strReplacer);
}

/**
 * Funcao que trunca a expressao em determinado numero de caracteres
 *
 * @param STRING strText
 * @param INTEGER intChar
 * @param STRING strComplement
 * @param BOOLEAN booSpace
 * @return STRING
 */
function truncate(strText, intChar, strComplement, booSpace)
{
    var strResult = '';
    var intLastSpace = 0;
    if (empty(strText))
        strText = '';
    if (empty(intChar))
        intChar = 0;
    if (empty(strComplement))
        strComplement = '';
    if (!isBoolean(booSpace))
        booSpace = true;
    var arrText = explode('', strText);
    for (var intCount = 0; intCount < arrText.length; ++intCount) {
        if (intCount < intChar) {
            strResult += arrText[intCount];
            if (arrText[intCount] == ' ')
                intLastSpace = intCount;
        } else
            break;
    }
    if (intChar <= strText.length) {
        if (booSpace)
            strResult = strResult.substr(0, intLastSpace);
        strResult += strComplement;
    }
    return strResult;
}

/**
 * Repete o caracter x vezes
 *
 * @param STRING strText
 * @param INTEGER intRepeat
 * @return STRING
 */
function str_repeat(strText, intRepeat)
{
    var strReturn = '';
    for (var intCount = 0; intCount < intRepeat; ++intCount)
        strReturn += strText;
    return strReturn;
}

/**
 * Substitui alguns caracteres especiais
 *
 * @param STRING strText
 * @return STRING
 */
function str_slice(strText)
{
    var strReturn = strText;
    strReturn = replaceAll(strText, "\"", "\\\\\"");
//    strReturn = replaceAll(strReturn, "\'", "\\\'");
    return strReturn;
}

/**
 * Substitui alguns caracteres especiais e retorna em uma linha
 *
 * @param STRING strText
 * @return STRING
 */
function str_slice_line(strText)
{
    var strReturn = str_slice(strText);
//    strReturn = replaceAll(strReturn, "\n", "\\n ");
    strReturn = replaceAll(strReturn, '\n', ' ');
    return strReturn;
}

/**
 * Encontra a posicao da ultima ocorrencia de um caractere em uma string
 * 
 * @param STRING strText
 * @param STRING strFinder
 * @param INTEGER intOffset
 * @return MIX
 */
function strrpos(strText, strFinder, intOffset)
{
    var intCount = -1;
    if (intOffset) {
        intCount = (strText + '').slice(intOffset).lastIndexOf(strFinder);
        if (intCount !== -1)
            intCount += intOffset;
    } else
        intCount = (strText + '').lastIndexOf(strFinder);
    return intCount >= 0 ? intCount : false;
}

function str_pad(strText, intPadLength, strPad, strPadType) {
    var strHalf = '', strPadToGo;
    var str_pad_repeater = function (strValue, intLen) {
        var strCollection = '', i;
        while (strCollection.length < intLen)
            strCollection += strValue;
        strCollection = strCollection.substr(0, intLen);
        return strCollection;
    };
    strText += '';
    strPad = strPad !== undefined ? strPad : ' ';
    if ((strPadType !== 'STR_PAD_LEFT') && (strPadType !== 'STR_PAD_RIGHT') && (strPadType !== 'STR_PAD_BOTH'))
        strPadType = 'STR_PAD_RIGHT';
    if ((strPadToGo = intPadLength - strText.length) > 0) {
        if (strPadType === 'STR_PAD_LEFT')
            strText = str_pad_repeater(strPad, strPadToGo) + strText;
        else if (strPadType === 'STR_PAD_RIGHT')
            strText = strText + str_pad_repeater(strPad, strPadToGo);
        else if (strPadType === 'STR_PAD_BOTH') {
            strHalf = str_pad_repeater(strPad, Math.ceil(strPadToGo / 2));
            strText = strHalf + strText + strHalf;
            strText = strText.substr(0, intPadLength);
        }
    }
    return strText;
}

/**
 * Retorna o valor ASCII de um determinado caracter
 * 
 * @param STRING strCarac
 * @return MIX
 */
function ord(strCarac)
{
    strCarac = strCarac + '';
    var code = strCarac.charCodeAt(0);
    if ((0xD800 <= code) && (code <= 0xDBFF)) {
        var hi = code;
        if (strCarac.length === 1)
            return code;
        var low = strCarac.charCodeAt(1);
        return ((hi - 0xD800) * 0x400) + (low - 0xDC00) + 0x10000;
    }
    return code;
}

/**
 * Limpa determinado texto, retirando caracteres desnecessarios
 * 
 * @param STRING strText
 * @param STRING strChars
 * @param BOOLEAN booAcceptChar
 * @return STRING
 */
function clearText(strText, strChars, booAcceptChar)
{
    if (empty(strText))
        return false;
    if (!isBoolean(booAcceptChar))
        booAcceptChar = true;
    var strSymbol = (booAcceptChar === true) ? '!=' : '==';
    var strResult = '';
    for (var intCount = 0; intCount < strText.length; ++intCount)
        eval('if (strChars.indexOf(strText.charAt(intCount)) ' + strSymbol + ' -1) strResult += strText.charAt(intCount);');
    return strResult;
}

/**
 * Edita uma string para o formato dasherize
 *
 * @param STRING strText
 * @return STRING
 */
function dasherize(strText)
{
    var intPos = 0;
    while (intPos < strText.length) {
        var strCarac = strText[intPos];
        var intAscii = ord(strCarac);
        if ((!empty(strCarac)) && (strCarac == strCarac.toUpperCase()) && (((intAscii >= 48) && (intAscii <= 57)) || ((intAscii >= 65) && (intAscii <= 90)) || ((intAscii >= 97) && (intAscii <= 122)))) {
            strText = strText.substr(0, intPos) + strCarac.toLowerCase() + strText.substr(intPos + 1);
            if (intPos !== 0)
                strText = strText.substr(0, intPos) + '-' + strText.substr(intPos);
        }
        ++intPos;
    }
    strText = replaceAll(strText, new Array('_', ' ', '--'), '-');
    return strText.toLowerCase();
}

/**
 * Edita uma string para o formato camelize
 *
 * @param STRING strText
 * @return STRING
 */
function camelize(strText)
{
    strText = replaceAll(ucfirst(strText), new Array('_', ' '), '-');
    var intPos = strText.indexOf('-');
    while (intPos != -1) {
        strText = strText.substr(0, intPos) + strText.substr(intPos + 1);
        var strCarac = strText[intPos];
        if (!empty(strCarac))
            strText = strText.substr(0, intPos) + strCarac.toUpperCase() + strText.substr(intPos + 1);
        intPos = strText.indexOf('-');
    }
    return strText;
}

/**
 * Aplica o base64_encode em uma string
 *
 * @param STRING strText
 * @return STRING
 */
function base64Encode(strText)
{
    if ((!window.btoa) || (strText.indexOf('°') != -1)) {
        var strKey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var strOutput = '';
        var strChr1, strChr2, strChr3;
        var strEnc1, strEnc2, strEnc3, strEnc4;
        var intCount = 0;
        do
        {
            strChr1 = strText.charCodeAt(intCount++);
            strChr2 = strText.charCodeAt(intCount++);
            strChr3 = strText.charCodeAt(intCount++);
            strEnc1 = strChr1 >> 2;
            strEnc2 = ((strChr1 & 3) << 4) | (strChr2 >> 4);
            strEnc3 = ((strChr2 & 15) << 2) | (strChr3 >> 6);
            strEnc4 = strChr3 & 63;
            if (isNaN(strChr2))
                strEnc3 = strEnc4 = 64;
            else if (isNaN(strChr3))
                strEnc4 = 64;
            strOutput = strOutput + strKey.charAt(strEnc1) + strKey.charAt(strEnc2) + strKey.charAt(strEnc3) + strKey.charAt(strEnc4);
        }
        while (intCount < strText.length);
        return strOutput;
    }
    include_once('/vendor/jquery-base64/jquery-base64-0.1/jquery.base64.min.js' + strGlobalSufixJsGzip);
    return $.base64.btoa(strText, true);
}

/**
 * Aplica o base64_decode em uma string
 *
 * @param STRING strText
 * @return STRING
 */
function base64Decode(strText)
{
    if (!window.atob) {
        var strKey = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var strOutput = '';
        var strChr1, strChr2, strChr3;
        var strEnc1, strEnc2, strEnc3, strEnc4;
        var intCount = 0;
        strText = strText.replace(/[^A-Za-z0-9\+\/\=]/g, '');
        do
        {
            strEnc1 = strKey.indexOf(strText.charAt(intCount++));
            strEnc2 = strKey.indexOf(strText.charAt(intCount++));
            strEnc3 = strKey.indexOf(strText.charAt(intCount++));
            strEnc4 = strKey.indexOf(strText.charAt(intCount++));
            strChr1 = (strEnc1 << 2) | (strEnc2 >> 4);
            strChr2 = ((strEnc2 & 15) << 4) | (strEnc3 >> 2);
            strChr3 = ((strEnc3 & 3) << 6) | strEnc4;
            strOutput = strOutput + String.fromCharCode(strChr1);
            if (strEnc3 != 64)
                strOutput = strOutput + String.fromCharCode(strChr2);
            if (strEnc4 != 64)
                strOutput = strOutput + String.fromCharCode(strChr3);
        }
        while (intCount < strText.length);
        return strOutput;
    }
    include_once('/vendor/jquery-base64/jquery-base64-0.1/jquery.base64.min.js' + strGlobalSufixJsGzip);
    return $.base64.atob(strText);
}

/**
 * Funcao responsavel em remover os acentos.
 *
 * @param string strWord
 * @return string
 */
function clearWord(strWord)
{
    strWord = strWord.replace(/[á|ã|â|à|ä]/gi, 'a');
    strWord = strWord.replace(/[Á|Ã|Â|À|Ä]/gi, 'A');
    strWord = strWord.replace(/[é|ê|è|ë]/gi, 'e');
    strWord = strWord.replace(/[É|Ê|È|Ë]/gi, 'E');
    strWord = strWord.replace(/[í|ì|î|ï]/gi, 'i');
    strWord = strWord.replace(/[Í|Ì|Î|Ï]/gi, 'I');
    strWord = strWord.replace(/[õ|ò|ó|ô|ö]/gi, 'o');
    strWord = strWord.replace(/[Õ|Ò|Ó|Ô|Ö]/gi, 'O');
    strWord = strWord.replace(/[ú|ù|û|ü]/gi, 'u');
    strWord = strWord.replace(/[Ú|Ù|Û|Ü]/gi, 'U');
    strWord = strWord.replace(/[ç]/gi, 'c');
    strWord = strWord.replace(/[Ç]/gi, 'Ç');
    strWord = strWord.replace(/[ñ]/gi, 'n');
    strWord = strWord.replace(/[Ñ]/gi, 'N');
    return strWord;
}