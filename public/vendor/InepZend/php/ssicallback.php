<?php

$arrData = (array) $_GET;
if (!array_key_exists('oauth_token', $arrData)) {
    parse_str(@$_SERVER['QUERY_STRING'], $arrQueryString);
    $arrData = array_merge($arrData, (array) $arrQueryString);
}
$arrExplode = explode('vendor/InepZend/php/ssicallback.php', $_SERVER['PHP_SELF']);
header(sprintf('Location: ' . reset($arrExplode) . 'ssicallback/%s', rtrim(strtr(base64_encode(gzdeflate(serialize($arrData), 9)), '+/', '-_'), '=')));
exit();
