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
 * Retorna o objeto XML apartir de uma string deste padrao
 * 
 * @param STRING strXml
 * @return OBJECT
 */
function loadXMLString(strXml)
{
    if (empty(strXml))
        strXml = '';
    var xml;
    if (window.DOMParser) {
        var DOMParser = new DOMParser();
        return DOMParser.parseFromString(strXml, 'text/xml');
    }
    if (window.ActiveXObject) {
        xml = new ActiveXObject('Microsoft.XMLDOM');
        xml.async = 'false';
        xml.loadXML(strXml);
        return xml;
    }
    if ((document.implementation) && (document.implementation.createDocument)) {
        xml = document.implementation.createDocument('', '', null);
        xml.async = false;
        xml.load(strXml);
        return xml;
    }
    alert('Seu navegador nao esta apto a ler um arquivo XML');
    return;
}

/**
 * Retorna o objeto Element do XML, apartir de uma string que se refere a tag do nodo
 * 
 * @param OBJECT xml
 * @param STRING strNodeName
 * @return MIX
 */
function getNodeXml(xml, strNodeName)
{
    var arrHtmlCollection = xml.getElementsByTagName(strNodeName);
    if ((empty(arrHtmlCollection)) || (empty(arrHtmlCollection[0])))
        return;
    var arrResult = [];
    for (var intCount = 0; intCount < arrHtmlCollection.length; ++intCount)
        arrResult[arrResult.length] = arrHtmlCollection[intCount];
    return (arrResult.length == 1) ? arrResult[0] : arrResult;
}

/**
 * Retorna o valor do objeto Element do XML, apartir de uma string que se refere a tag do nodo
 * 
 * @param OBJECT xml
 * @param STRING strNodeName
 * @return MIX
 */
function getNodeValueXml(xml, strNodeName)
{
    var mixResult = getNodeXml(xml, strNodeName);
    if (empty(mixResult))
        return;
    var arrResult = [];
    for (var intCount = 0; intCount < mixResult.childNodes.length; ++intCount) {
        var childNode = mixResult.childNodes[intCount];
        if ((childNode.nodeType == 3) && ((empty(childNode.data)) || (childNode.data == ' ') || (childNode.data == '\n')))
            continue;
        arrResult[arrResult.length] = (childNode.nodeType == 3) ? childNode.data : childNode;
    }
    return (arrResult.length == 1) ? arrResult[0] : arrResult;
}