function showMenuInepZend()
{
    var arrElement = new Array('inepZendMenu', 'inepZendBreadcrumbs', 'inepZendMenuContainer');
    for (var intCount = 0; intCount < arrElement.length; ++intCount) {
        var strId = arrElement[intCount];
        var element = getObject(strId);
        if (!empty(element)) {
            if (strId == 'inepZendMenuContainer') {
                if (document.all)
                    setTimeout('document.getElementById("' + strId + '").style.cssText = "";', 10);
                else
                    element.style.cssText = '';
            } else {
                if (document.all)
                    setTimeout('document.getElementById("' + strId + '").style.display = "";', 10);
                else
                    element.style.display = '';
            }
        }
    }
}

var booGlobalInitMenuInepZend = false;
function initMenuInepZend(strOrientation)
{
//    include_once('/vendor/ddsmoothmenu/ddsmoothmenu-2.0/js/ddsmoothmenu.js' + strGlobalSufixJsGzip);
    if ((!isObject(ddsmoothmenu)) || (booGlobalInitMenuInepZend))
        return;
    var strClass = (strOrientation == 'v') ? '-' + strOrientation : '';
    ddsmoothmenu.init({
        mainmenuid: 'inepZendMenu',
        orientation: strOrientation,
        classname: strClass,
        contentsource: 'markup',
        arrowswap: true
    });
    booGlobalInitMenuInepZend = true;
}