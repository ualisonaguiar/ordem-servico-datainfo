<?php

function getBasePathApplication()
{
    $strScriptFilename = str_replace(array('\\', '../', '//'), array('/', '', '/'), $_SERVER['SCRIPT_FILENAME']);
    $strExplode = null;
    if (strpos($strScriptFilename, '/public/') !== false)
        $strExplode = '/public/';
    elseif (strpos($strScriptFilename, '/vendor/InepZend/') !== false)
        $strExplode = '/vendor/InepZend/';
    elseif (strpos($strScriptFilename, '/vendor/phpunit/') !== false)
        $strExplode = '/vendor/phpunit/';
    elseif ((strpos($strScriptFilename, '/bin/phpunit') !== false) || (strpos($strScriptFilename, 'phpunit.phar') !== false) || (php_sapi_name() == 'cli')) {
        if ((array_key_exists('PWD', $_SERVER)) && (!empty($_SERVER['PWD'])))
            return reset($arrExplode = explode('/module/', str_replace('\\', '/', $_SERVER['PWD'])));
        $strScriptFilename = str_replace(array('\\', '../', '//'), array('/', '', '/'), __DIR__);
        $strExplode = '/vendor/InepZend/';
    }
	if (empty($strExplode))
		return '';
	$arrExplode = explode($strExplode, $strScriptFilename);
    return reset($arrExplode);
}

function getBasePathVendor()
{
	$arrExplode = explode('/vendor/InepZend', str_replace('\\', '/', __FILE__));
    return reset($arrExplode);
}

function getReplacedBasePathApplication($strPath = null)
{
    return str_replace('../', '', getBasePathApplication() . (string) $strPath);
}
