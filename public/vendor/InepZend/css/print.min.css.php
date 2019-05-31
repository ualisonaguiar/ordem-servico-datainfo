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
body{font-family:"Times New Roman",Times;margin-top:0}a{text-decoration:underline;color:#000}pre{white-space:normal!important}.no-print{display:none}.logo{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJEAAAAqCAYAAACz1bmVAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB90ICRIzOZvAOzwAAAKJSURBVHja7ds7aBRRFMbx/yaL+ICoWIgGA8EUURRMZSOINgoWUbGxsBAL0UrrgGePiI2QaBH7SBALA9olGlKJD2x8lBZpxBglPmKIolnXwgTiMsrszszuzPj9YJvLzJ0zcz527j6mUCqVKtTmuJndWj7g7iPAUZpjChgEhszsddid3H0C2Ee6vDGz9qo6dwAvm1jTJHANGDazmaANWsi+TcAlYMzdz7v7WiROncAAMO7uZ9x9TR5DtGQ70A/cdfdO9T5WBWAXcB247e4deQ3Rkr3APXfvVu8TcRC44+5b8hwigC7gpruvU88T0QP0u/vKPIdo6UT71O/EHAMO5z1EACfdfZv6nZjT7r467yHaAJxSrxOzBzhQT4gKGfuq4JC7bwwYb01hra0ZC1EROFsE3tW449eAsfk65mmU9cBWYLpqfCaFNU8HjC2k+NoC7CxUKhVEomjRJRCFSBQiyb6iu3fVuM9bM5tbPuDu7cCqqPOEtfjbWGsTak5a2cwmq+pcAXSk+Y2oCLyqcacTwHDV2A1gfwzzhPUMaIt4rBFgd8oaMgtU/wuhG3iet9vZQsDYh5jmCWsuhmPNp7AfQef1M+V3s6ctTQyjZN8P4LKaL1FMAKMKkUQxaGbfFCKp1xAwprWM1OsxcM7MvitEUo/7QK+ZfdKnKqnVLL8fhOg1sz/+VVDUtUmVzSmsaQp4Alwxs4dBGyhE4T0CxhM+xpcY57kacY4y8B54YGYv/rWhQhTeqJldzEitH83sQqMOpjVReG0ZqrWhbw4KkShEDfRZl0BroqiO/OWpkViDamZ9ClF+9Sy+klQmg0/t6naWLtNaE4kW1iIKkShEohCJQiSiEIlCJAqR/Ld+AVFDnKqhIhfKAAAAAElFTkSuQmCC) no-repeat scroll 0 0 transparent;*background:url("/vendor/InepZend/images/id_inep_print.png") no-repeat scroll 0 0 transparent;display:block;text-indent: -9999em!important;width:145px;height:42px}#nomeInep{font-family:Verdana,Arial,Sans;font-size:12px!important;font-weight:normal!important}#footerBackground{position:fixed;bottom:0}