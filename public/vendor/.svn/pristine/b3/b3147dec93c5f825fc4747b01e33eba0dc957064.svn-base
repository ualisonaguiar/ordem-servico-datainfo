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
function ajaxGetCoUfFromSigla(strSglUf, mixUf, arrData, booCache)
{
    if (isNumeric(strSglUf))
        return strSglUf;
    var arrUrlParam = [];
    arrUrlParam.sigla = strSglUf;
    var mixResult = ajaxRequest('/ajaxgetcouffromsigla', arrUrlParam, undefined, undefined, undefined, undefined, false, false, (!isBoolean(booCache)) ? true : booCache);
    if (!empty(mixUf)) {
        var uf = getObject(mixUf);
        if (!empty(uf)) {
            uf.value = mixResult;
            execFeedSelectOnChange(uf, (((isArray(arrData)) && (!empty(arrData.co_ibge))) ? arrData.co_ibge : undefined));
        }
    }
    return mixResult;
}

function ajaxUfOnChange(intCoMunicipio, mixMunicipio, arrData)
{
    if (!empty(mixMunicipio)) {
        var municipio = getObject(mixMunicipio);
        var arrUf = getElementsByAttribute(document.body, 'SELECT', 'data-depend', municipio.getAttribute('id'));
        if (arrUf.length > 0)
            execFeedSelectOnChange(arrUf[0], intCoMunicipio);
    }
    return true;
}

function editOnEvent(strOnEvent, strSymbol)
{
    if ((empty(strOnEvent)) || (empty(strSymbol)))
        return false;
    if (strOnEvent.indexOf(strSymbol) == -1)
        return strOnEvent;
    var intLength = strOnEvent.length - 1;
    if (strOnEvent[intLength] == strSymbol)
        strOnEvent = trim(strOnEvent.substr(0, intLength));
    return strOnEvent;
}