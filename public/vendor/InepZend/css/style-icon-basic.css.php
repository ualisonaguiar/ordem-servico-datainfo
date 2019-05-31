<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/css");
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
@media screen {
	.icoHelper {
	    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAwMi8wMi8xMU1XPxUAAAAldEVYdFNvZnR3YXJlAE1hY3JvbWVkaWEgRmlyZXdvcmtzIE1YIDIwMDSHdqzPAAACKUlEQVR4nG2Tz0tUURTHP/MrRrQGB0JTG5Igi8KkwnDh5v0H0yZwF5nD7GxTRESP2rQ0EERbthX68Qe4axMFqallUurMyHN8o6O9Gcd33723xai8xnfhLO7h+/2cc+89N6S1pnHNmLE0MAL0H6Y+A1OGKd41akN+wIwZ6wSepm7fy7b1pmlKdAFQ2y1gzX8g/+XtpPIOXhqmKBx5on5aOBp/djX9OpO8cB3tbaPFHwDiLU10Dw7T2j2YWXz/MAI8OPb4qg+d672Tae3sQFVn0W4OPBs8G+3mUNVZEm1J2nvTwzNmbOgEAMi2X+lHVudQwg4MWZ2j7dINgGwQoC8S+oEWJSItt9ByDy226iEdIs030WKLCEsAfUEAKSvLyP3fCHua6OlBtOegZYVIywDCnkbWcnjOEoAMusSvle2yceash5RllPWG+PnnEI5TW32MVn9BK5ySc/SsJzqYyC+soaRESw/lllCiiBYllNip56SksLgOMHECYJhi2rFL4/n5VdDqMDSgj/f572s4tj3uH6j/5gB4ZK0UIuFoKNtxuatuBrRWWMsbWL/yE8ATv8F/BAxT7AMvNlc261Wpd6A8j42fGwCvDFM4fk9jB3zq+WYlix9xiz1cbO6iaG8xv3CXXG1Axa7dXzca9OFGAEA4miCZ6CSkY8TCcTz3FHsVFawNSrquy+7uHgA75TIHB7UgGdDwG/1rdHR00rKsEdd1SaVSU2NjY5kg3T8+aiUh/cgIpwAAAABJRU5ErkJggg==) no-repeat;
	    *background: url(../images/icons-inep/ajuda.png) no-repeat;    
	}
}