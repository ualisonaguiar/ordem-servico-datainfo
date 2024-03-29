function setCookie(strCookieName, strCookieValue, intExpireDay, strPath)
{
    var strCookieExpires = '';
    if (!empty(intExpireDay)) {
        var date = new Date();
        date.setTime(date.getTime() + (intExpireDay * 24 * 60 * 60 * 1000));
        strCookieExpires = ' expires=' + date.toGMTString() + ';';
    }
    var strCookiePath = '';
    if (!empty(strPath))
        strCookiePath = ' path=' + strPath + ';';
    document.cookie = strCookieName + '=' + strCookieValue + ';' + strCookieExpires + strCookiePath;
}

function getCookie(strCookieName)
{
    var strName = strCookieName + '=';
    var arrCookie = document.cookie.split(';');
    for (var intCount = 0; intCount < arrCookie.length; ++intCount) {
        var strCookie = arrCookie[intCount];
        while (strCookie.charAt(0) == ' ')
            strCookie = strCookie.substring(1);
        if (strCookie.indexOf(strName) != -1) {
            strCookie = strCookie.substring(strName.length, strCookie.length);
            if (strCookieName == 'contrast_theme')
                setCookie('contrast', strCookie);
            return strCookie;
        }
    }
    return '';
}

var strGlobalFirstSessionId;
var intGlobalIntervalCheckAlterSessionId;
function controlAlterSessionId()
{
    if (strGlobalControlAlterSessionIdCallback == strGlobalControlAlterSessionIdCallbackDefault)
        return false;
    if (empty(strGlobalFirstSessionId))
        strGlobalFirstSessionId = getCookie('PHPSESSID');
    intGlobalIntervalCheckAlterSessionId = setInterval(checkAlterSessionId, 10000);
    return true;
}

var booGlobalCheckAlterSessionId = true;
function checkAlterSessionId()
{
    if ((strGlobalFirstSessionId == getCookie('PHPSESSID')) || (booGlobalCheckAlterSessionId === false))
        return true;
    if (empty(strGlobalControlAlterSessionIdCallback))
        strGlobalControlAlterSessionIdCallback = 'window.location.href = "' + strGlobalBasePath + '/";';
    eval(strGlobalControlAlterSessionIdCallback);
    clearInterval(intGlobalIntervalCheckAlterSessionId);
    return false;
}

execFunctionOnLoadEvent('controlAlterSessionId();');