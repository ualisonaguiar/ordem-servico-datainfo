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
.ddsmoothmenu {
    background-color: #e2e2e2; 
    background-image: linear-gradient(to bottom, #e2e2e2, #cccccc); 
    background-repeat: repeat-x; 
    height: 22px;
    border-top: 1px solid #c4c0b9; 
    border-bottom: 1px solid #c4c0b9;
    width: 100%;
}

.ddsmoothmenu ul {
    z-index: 100;
    margin: 0;
    padding: 0;
    list-style-type: none;
}

.ddsmoothmenu ul li {
    position: relative;
    display: inline;
    float: left;
}

.ddsmoothmenu ul li a {
    display: block;
    background-color: #e2e2e2; 
    background-image: linear-gradient(to bottom, #e2e2e2, #cccccc); 
    background-repeat: repeat-x; 
    border-right: 1px solid #c4c0b9;
    text-decoration: none;
    font-family: Arial,Helvetica,sans-serif!important;
    font-size: 12px;
    color: #000000;
    padding-top: 2px;
    padding-left: 15px;
    padding-right: 15px;
}

* html .ddsmoothmenu ul li a {
    display: inline-block;
}

.ddsmoothmenu ul li a:link, .ddsmoothmenu ul li a:visited {
    color: #000;
}

.ddsmoothmenu ul li a.selected {
    background-color: #999999; 
    background-image: linear-gradient(to bottom, #e2e2e2, #999999); 
    background-repeat: repeat-x; 
}

.ddsmoothmenu ul li a:hover {
    background-color: #999999; 
    background-image: linear-gradient(to bottom, #e2e2e2, #999999); 
    background-repeat: repeat-x; 
}

.ddsmoothmenu ul li ul {
    position: absolute;
    left: -3000px;
    display: none;
    visibility: hidden;
}

.ddsmoothmenu ul li ul li {
    display: list-item;
    float: none;
}

.ddsmoothmenu ul li ul li ul {
    top: 0;
}

.ddsmoothmenu ul li ul li a {
    width: 160px;
    margin: 0;
    border-top-width: 0;
    border-bottom: 1px solid #c4c0b9;
    font-weight: normal;
}

* html .ddsmoothmenu {
    height: 1%;
}

.rightarrowclass {
    position: absolute;
    top: 3px;
    right: 8px;
    width: 23px;
    height: 22px;
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAVCAYAAACt4nWrAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB90GGxIwOmzEGDAAAAETSURBVDjL3dW9SsNQGMbx/zkpWYQgCBGydHBzaV3UW8g9dMidGO8k0EvpDdSlDbYOWQIGCuWQOITmxCFpFXRovgZ91hd+z+F8cAR15uADHjCmfSIgmJWlDyBqeDkyzYnl2FxcXbaWs90eFScc8vxlVpZTMQd/ZJpP17c3SMOga3RR8L5645DnzxLwLMfuBQaQhoHl2ACeBMZdtuK31N5YMmD+KZ6qjFRljWdn4W64xV1vfiCp+qhm4bY9vni8AyFwV6+nglRluOGmmj9MO+y51lWBlKeC42oX9xMoy44H+r1gvfmCe7stxwIhzoabXUWtG8F//xFF2W7fK1p7kQQCFSfoougF1kWBihOAYNifaMg/9BP/kIk97ur8gwAAAABJRU5ErkJggg==) no-repeat; 
    *background: url(/vendor/InepZend/images/submenu_seta.png) no-repeat; 
}

.ddshadow { 
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    height: 0;
    background-color: #ccc;
}

.toplevelshadow {
    margin: 5px 0 0 5px;
    opacity: 0.8;
}

.ddcss3support .ddshadow.toplevelshadow {
    margin: 0;
}

.ddcss3support .ddshadow {
    background-color: transparent;
    box-shadow: 5px 5px 5px #aaa;
    -moz-box-shadow: 5px 5px 5px #aaa;
    -webkit-box-shadow: 5px 5px 5px #aaa;
}

.menuList {
    padding-top: 2px; 
    font-size: 12px; 
    font-weight: bold; 
    list-style: none;
}

.menuList li {
    float: left; 
    /*padding-right: 30px;*/
    display: block!important;
}

.menuList li a {
    text-decoration: none;
    color: #000000;
    font-family: Arial,Helvetica,sans-serif!important;
    font-size: 12px;
}

.menuList li a:visited {
    text-decoration: none;
    color: #000000;
}

.menuList li a:hover {
    color: #000000;
}

.menuList li ul{
    width: 210px!important;
    border-radius: 4px;
}
.menuList li ul li{
    width: 210px!important;
}