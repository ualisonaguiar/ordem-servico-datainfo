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
var arrGlobalIncludeOnce = [];
function include(strFilePath, booHead)
{
    if ((empty(strFilePath)) || (strFilePath == 'null'))
        return;
    if (intGlobalGulp == 1) {
    	if (
    	    (strFilePath.indexOf('InepZend/js/') != -1) ||
    	    (strFilePath.indexOf('InepZend/angular/Util/') != -1) ||
    	    (strFilePath.indexOf('InepZend/angular/Service/') != -1) ||
    	    (strFilePath.indexOf('InepZend/theme/') != -1) ||
    	    (strFilePath.indexOf('InepZend/menu/') != -1) ||
    	    (strFilePath.indexOf('jquery.min.js') != -1) ||
    	    (strFilePath.indexOf('bootstrap.min.js') != -1) ||
    	    (strFilePath.indexOf('jquery.migrate.') != -1) ||
    	    (strFilePath.indexOf('placeholders.jquery.') != -1) ||
    	    (strFilePath.indexOf('jquery.gritter.') != -1) ||
    	    (strFilePath.indexOf('jquery.alphanumeric.') != -1) ||
    	    (strFilePath.indexOf('angular.min.js') != -1) ||
    	    (strFilePath.indexOf('jquery.maskedinput.') != -1) ||
    	    (strFilePath.indexOf('jquery.validate.') != -1) ||
    	    (strFilePath.indexOf('jquery.base64.') != -1) ||
    	    (strFilePath.indexOf('jquery.maskmoney.') != -1) ||
    	    (strFilePath.indexOf('extend.') != -1) ||
    	    (strFilePath.indexOf('loading-bar.') != -1)
    	)    
    	    return;
    }
    arrGlobalIncludeOnce[arrGlobalIncludeOnce.length] = strFilePath;
    if ((document.all) && (intGlobalOptimizer == 1))
        strFilePath = replaceAll(strFilePath, '.php', '');
    if (!isBoolean(booHead))
        booHead = true;
    var booExternal = (strFilePath.indexOf(':/') != -1);
    var strSource = (!booExternal) ? strGlobalBasePath + strFilePath : strFilePath;
    if (booHead) {
		var script = document.createElement('SCRIPT');
        script.setAttribute('type', 'text/javascript');
        script.setAttribute('src', strSource);
        $('head').append(script);
    } else
        document.body.innerHTML += unescape("%3Cscript src='" + strSource + "' type='text/javascript' defer%3E%3C/script%3E");
}

function include_once(strFilePath, booHead)
{
	if ((empty(strFilePath)) || (strFilePath == 'null') || (array_search(strFilePath, arrGlobalIncludeOnce) != -1))
        return;
    var arrScript = document.getElementsByTagName('SCRIPT');
    for (var intCount = 0; intCount < arrScript.length; ++intCount) {
        var script = arrScript[intCount];
        if ((!empty(script)) && (!empty(script.src)) && (script.src == strFilePath))
            return;
    }
    include(strFilePath, booHead);
}

$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
	if ((options.dataType == 'script') || (originalOptions.dataType == 'script'))
		options.cache = true;
});