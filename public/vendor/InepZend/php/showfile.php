<?php

require_once(__DIR__ . '/../../../../vendor/InepZend/library/InepZend/Util/Functions/FileSystem.php');

$strPathFile = (array_key_exists('path', $_GET)) ? $_GET['path'] : null;
if (!empty($strPathFile))
    $strPathFile = getReplacedBasePathApplication('/../../../../' . base64_decode($strPathFile));
$strForceDownload = (array_key_exists('force_download', $_GET)) ? $_GET['force_download'] : null;
if (!empty($strForceDownload))
    $strForceDownload = base64_decode($strForceDownload);
exit(showFile($strPathFile, $strForceDownload));