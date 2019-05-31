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
* {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
}

body {
    padding-top: 60px;
    padding-bottom: 40px;
    margin: 0px;
    border: none;
}

img, dl, dt, dd, h1, h2, h3, h4, h5, h6, form {
    padding: 0px;
    margin: 0px;
    border: none;
}

h1, h2, h3, h4, h5, h6 {
    color: #9A0000;
    font-weight: bold;
}

h1 {
    font-size: 24px;
}

h2 {
    font-size: 22px;
}

h3 {
    font-size: 20px;
}

h4 {
    font-size: 18px;
}

h5 {
    font-size: 16px;
}

h6 {
    font-size: 14px;
}

.logoInepGray {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJEAAAAqCAYAAACz1bmVAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB90ICRIzOZvAOzwAAAKJSURBVHja7ds7aBRRFMbx/yaL+ICoWIgGA8EUURRMZSOINgoWUbGxsBAL0UrrgGePiI2QaBH7SBALA9olGlKJD2x8lBZpxBglPmKIolnXwgTiMsrszszuzPj9YJvLzJ0zcz527j6mUCqVKtTmuJndWj7g7iPAUZpjChgEhszsddid3H0C2Ee6vDGz9qo6dwAvm1jTJHANGDazmaANWsi+TcAlYMzdz7v7WiROncAAMO7uZ9x9TR5DtGQ70A/cdfdO9T5WBWAXcB247e4deQ3Rkr3APXfvVu8TcRC44+5b8hwigC7gpruvU88T0QP0u/vKPIdo6UT71O/EHAMO5z1EACfdfZv6nZjT7r467yHaAJxSrxOzBzhQT4gKGfuq4JC7bwwYb01hra0ZC1EROFsE3tW449eAsfk65mmU9cBWYLpqfCaFNU8HjC2k+NoC7CxUKhVEomjRJRCFSBQiyb6iu3fVuM9bM5tbPuDu7cCqqPOEtfjbWGsTak5a2cwmq+pcAXSk+Y2oCLyqcacTwHDV2A1gfwzzhPUMaIt4rBFgd8oaMgtU/wuhG3iet9vZQsDYh5jmCWsuhmPNp7AfQef1M+V3s6ctTQyjZN8P4LKaL1FMAKMKkUQxaGbfFCKp1xAwprWM1OsxcM7MvitEUo/7QK+ZfdKnKqnVLL8fhOg1sz/+VVDUtUmVzSmsaQp4Alwxs4dBGyhE4T0CxhM+xpcY57kacY4y8B54YGYv/rWhQhTeqJldzEitH83sQqMOpjVReG0ZqrWhbw4KkShEDfRZl0BroqiO/OWpkViDamZ9ClF+9Sy+klQmg0/t6naWLtNaE4kW1iIKkShEohCJQiSiEIlCJAqR/Ld+AVFDnKqhIhfKAAAAAElFTkSuQmCC) no-repeat;
    *background: url(../images/id_inep_print.png);
    width: 145px;
    height: 42px;
}

.selectPaginationControl {
    font-size: 12px;
    height: 18px;
    width: 50px;
    padding: 0px;
    vertical-align: baseline;
    margin: 0px;
}

.appVersion {
    font-size: 10px;
    color: #955;
    text-align: center;
}

.helpText {
    cursor: help;
    float: left;
    margin-top: 6px;
    height: 18px;
    margin-left: 1px;
    margin-top: 4px;
    width: 15px;    
}

#loginContainer {
    text-align: right;
    font-weight: bold;
}

.tercoTela {
    margin-left: 33%;
    margin-right: 33%;
    overflow: visible;
}

.meiaTela {
    margin-left: 25%;
    margin-right: 25%;
    overflow: visible;
}

.parcialTela20 {
    margin-left: 20%;
    margin-right: 20%;
    overflow: visible;
}

.caixaVazada {
    /*background: none repeat scroll 0 0 #FFFFFF;*/
    border: 1px solid #DDDDDD;
    border-radius: 6px 6px 6px 6px;
    display: block;
    padding: 7px;
    overflow: hidden;
}

.caixaVazada h1 {
    font-size: 24px;
}

.caixaVazada h2 {
    font-size: 22px;
}

.caixaVazada h3 {
    font-size: 20px;
}

@media screen {
    .noPrint { 
        display: block; 
    }

    .yesPrint{ 
        display: block !important; 
    }
}

@media print {
    .noPrint { 
        display: none; 
    }

    .yesPrint{ 
        display: block !important; 
    }
}

.no-screen {
    display: none;
}

.red {
    border: 1px solid red;
}

.ui-dialog {
    z-index: 9999!important;
}

.breadcrumbNameApplication {
    color: #369 !important;
    font-weight: bold;
}

.breadcrumb a {
    display: inline-block;
    vertical-align: middle;
}

.breadcrumb {
    padding: 10px 15px;
    margin: 0 0 0px;
}