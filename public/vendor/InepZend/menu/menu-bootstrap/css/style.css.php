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
#inepZendMenuBootstrapMenu {
    background-color: #D3D3D3;
}

#inepZendMenuBootstrapMenu a {
    font-size: 12px;    
}

.menu-personalizado a {
    color: #000000;
    font-weight: bold;
    background: -moz-linear-gradient(#CCCCCC, #E2E2E2);
    background: -webkit-linear-gradient(#CCCCCC, #E2E2E2);
    background: -o-linear-gradient(#CCCCCC, #E2E2E2);
    background: -ms-linear-gradient(#CCCCCC, #E2E2E2);/*For IE10*/
    background: linear-gradient(#CCCCCC, #E2E2E2);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#CCCCCC', endColorstr='#E2E2E2');/*For IE7-8-9*/ 
    color: #000;
    border-color: #fff;
}

.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, .nav > li.dropdown.open.active > a:hover, .nav > li.dropdown.open.active > a:focus {
    background: #9A0000!important;
    filter:none;
}

.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a {
    color: #000000;
    font-weight: bold;
    background: -moz-linear-gradient(#C1C1C1, #E2E2E2,#C1C1C1);
    background: -webkit-linear-gradient(#C1C1C1, #E2E2E2,#C1C1C1);
    background: -o-linear-gradient(#C1C1C1, #E2E2E2,#C1C1C1);
    background: -ms-linear-gradient(#C1C1C1, #E2E2E2,#C1C1C1);/*For IE10*/
    background: linear-gradient(#C1C1C1, #E2E2E2,#C1C1C1);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#C1C1C1', endColorstr='#E2E2E2');/*For IE7-8-9*/ 
    color: #000;
    border-color: #fff;
    font-weight: bold;
}

.dropdown-submenu > a:after, .dropdown-submenu:hover > a:after {
    border-left-color: #005580;
}

.nav {
    margin-bottom: 0px;
}

.position-verticial > li{
    float: none;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #000;
}

ul.menu-personalizado .icon-home {
    margin-top: -1px;
}

#inepZendMenuBootstrapBreadcrumbs .icon-home,
#inepZendMenuBootstrapBreadcrumbs .icon-lock,
#inepZendMenuBootstrapBreadcrumbs .icon-info-sign {
    margin-top: -1px;
}

.nav-tabs > li > a,
.nav-pills > li > a {
    line-height: 20px;
}