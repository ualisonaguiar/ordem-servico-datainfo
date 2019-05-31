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
/*
ExtendJS 0.2.3
More info at http://extendjs.org

Copyright (c) 2013+ ChrisBenjaminsen.com

Distributed under the terms of the MIT license.
http://extendjs.org/licence.txt

This notice shall be included in all copies or substantial portions of the Software.
*/
!function(a){"use strict";function b(a){a.parent instanceof Function&&(b.apply(this,[a.parent]),this.super=c(this,d(this,this.constructor))),a.apply(this,arguments)}function c(a,b){for(var c in a)"super"!==c&&a[c]instanceof Function&&!(a[c].prototype instanceof Class)&&(b[c]=a[c].super||d(a,a[c]));return b}function d(a,b){var c=a.super;return b.super=function(){return a.super=c,b.apply(a,arguments)}}a.Class=function(){},a.Class.extend=function e(a){function d(){b!==arguments[0]&&(b.apply(this,[a]),c(this,this),this.initializer instanceof Function&&this.initializer.apply(this),this.constructor.apply(this,arguments))}return d.prototype=new this(b),d.prototype.constructor=d,d.toString=function(){return a.toString()},d.extend=function(b){return b.parent=a,e.apply(d,arguments)},d},a.Class=a.Class.extend(function(){this.constructor=function(){}})}(this);
