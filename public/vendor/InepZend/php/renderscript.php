<?php

require_once(__DIR__ . '/../../../../vendor/InepZend/library/InepZend/Util/Functions/FileSystem.php');

$arrNamespace = getInfoNamespaceToRenderScript((array_key_exists('namespace', $_GET)) ? $_GET['namespace'] : null);
$strModule = (array_key_exists('module', $_GET)) ? $_GET['module'] : $arrNamespace[0];
$strSubModule = (array_key_exists('sub_module', $_GET)) ? $_GET['sub_module'] : $arrNamespace[1];
$strType = (array_key_exists('type', $_GET)) ? $_GET['type'] : $arrNamespace[2];
$strFileName = (array_key_exists('filename', $_GET)) ? $_GET['filename'] : $arrNamespace[3];
exit(renderScript($strModule, $strSubModule, $strType, $strFileName));