<?php

function insertContentIntoFile($strPathFile = null, $strContent = '', $strMode = 'w+')
{
    $strPath = str_replace(end($arrExplode = explode('/', $strPathFile)), '', $strPathFile);
    if (!is_dir($strPath))
        mkdir($strPath, 0777, true);
    if ((is_null($strPathFile)) || (empty($strPathFile)))
        return false;
    if (!$hanFile = fopen($strPathFile, $strMode))
        return false;
    if (!fwrite($hanFile, $strContent))
        return false;
    fclose($hanFile);
    return true;
}