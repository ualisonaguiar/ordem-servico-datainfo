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