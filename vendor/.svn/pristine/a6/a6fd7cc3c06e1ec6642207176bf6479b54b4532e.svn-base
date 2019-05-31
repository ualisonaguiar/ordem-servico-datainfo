<?php

require_once(__DIR__ . '/Server.php');

function showFile($strPathFile = null, $strForceDownload = null)
{
    $arrPathAuthentication = array(
        'bin',
        'config',
        'data/cache',
        'data/Database',
        'data/DoctrineORMModule',
        'data/log',
        'data/pass-enem',
        'vendor',
        'build.xml',
        'composer.json',
        'phpunit.xml',
    );
    $strContent = null;
    $booPermitedDownload = true;
    if (!empty($strPathFile)) {
        $strFile = str_replace(getBasePathApplication() . '/', '', $strPathFile);
        if (str_replace('\\', '/', $strFile{0}) == '/')
            $strFile = substr($strFile, 1);
        foreach ($arrPathAuthentication as $strPathAuthentication) {
            if (strpos($strFile, $strPathAuthentication) === 0) {
                $booPermitedDownload = false;
                break;
            }
        }
        if ($booPermitedDownload) {
            if (file_exists($strPathFile)) {
                $strMimeContent = (class_exists('\InepZend\Util\FileSystem')) ? \InepZend\Util\FileSystem::getMimeContentFromFile($strPathFile) : mime_content_type($strPathFile);
                if ((strtolower($strForceDownload) == 'true') || ((stripos($strMimeContent, 'image/') === false) && (stripos($strMimeContent, 'text/html') === false))) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . end($arrExplode = explode('/', $strPathFile)) . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($strPathFile));
                } else
                    header('Content-Type: ' . $strMimeContent . ';');
                readfile($strPathFile);
            } else
                $strContent = 'Arquivo inexistente! ' . str_replace(getBasePathApplication() . '/', '', $strPathFile);
        } else
            $strContent = 'Opera&ccedil;&atilde;o n&atilde;o permetida!';
    } else
        $strContent = 'Par&acirc;metros incorretos!';
    return $strContent;
}

function getShowFileUrl($strPathFile = null, $strForceDownload = null)
{
    $strUrl = '/vendor/InepZend/php/showfile.php';
    $arrParam = array();
    if (!empty($strPathFile))
        $arrParam[] = 'path=' . base64_encode($strPathFile);
    if (!empty($strForceDownload))
        $arrParam[] = 'force_download=' . base64_encode($strForceDownload);
    if (count($arrParam) > 0)
        $strUrl .= '?' . implode('&', $arrParam);
    return $strUrl;
}

function renderScript($strModule = null, $strSubModule = null, $strType = null, $strFileName = null)
{
    $strResult = '';
    if ((!empty($strModule)) && (!empty($strType)) && (!empty($strFileName))) {
        $arrHeader = array(
            'js' => 'Content-Type: application/x-javascript',
            'css' => 'Content-Type: text/css',
        );
        if (array_key_exists($strType, $arrHeader)) {
            $strModulePath = $strModule;
            if (!empty($strSubModule))
                $strModulePath .= '/' . $strSubModule;
            $strPathBase = getReplacedBasePathApplication('/../../../');
            $strPathBaseModule = $strPathBase . '/module/';
            if (!is_dir($strPathBaseModule . $strModulePath)) {
                $strPathBase = getBasePathVendor();
                $strPathBaseModule = $strPathBase . '/vendor/InepZend/module/';
                if ($strModule == 'InepZend')
                    $strModulePath = str_replace($strModule . '/', '', $strModulePath);
            }
            $strPathPart = $strModulePath . '/view/public/' . $strType . '/' . $strFileName . '.' . $strType;
            $arrPathFile = array($strPathBaseModule . $strPathPart);
            $arrModulePath = @$GLOBALS['module_listener_options']['module_paths'];
            if (empty($arrModulePath)) {
                $arrModulePath = require getReplacedBasePathApplication('/../../../../../../config/application.config.php');
                $arrModulePath = @$arrModulePath['module_listener_options']['module_paths'];
            }
            if (is_array($arrModulePath))
                foreach ($arrModulePath as $strPathModule)
                    if (strpos($strPathModule, $strPathModulePart = './module/') === 0)
                        $arrPathFile[] = $strPathBaseModule . str_replace($strPathModulePart, '', $strPathModule) . '/' . $strPathPart;
            $arrPathFile[] = $strPathBase . '/../module/' . $strPathPart;
            foreach ($arrPathFile as $strPathFile) {
                if (file_exists($strPathFile)) {
                    if ((!$hanFile = fopen($strPathFile, 'r')) || (!$intSizeFile = filesize($strPathFile)))
                        return;
                    $intLastModifiedTime = filemtime($strPathFile);
                    $strETag = md5_file($strPathFile);
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
                    header("Etag: " . $strETag);
                    header($arrHeader[$strType]);
                    header("Cache-Control: max-age=604800, public, must-revalidate");
                    header("Pragma: max-age=604800, public, must-revalidate");
                    if ((is_null($mixZlib = ini_get("zlib.output_compression"))) || ($mixZlib == ""))
                        ini_set("zlib.output_compression", true);
                    header("Accept-Encoding: gzip");
                    if ((@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) == $intLastModifiedTime) || (trim(@$_SERVER["HTTP_IF_NONE_MATCH"]) == $strETag)) {
                        header("HTTP/1.1 304 Not Modified");
                        exit;
                    }
                    $strResult = fread($hanFile, $intSizeFile);
                    fclose($hanFile);
                    break;
                }
            }
        }
        return $strContent = trim(str_replace(array("\t", "\r", "    ", "   ", "  "), ' ', $strResult));
    }
    return $strResult;
}

function getRenderScriptUrl($strNamespace = null, $strModule = null, $strSubModule = null, $strType = null, $strFileName = null)
{
    $strUrl = '/vendor/InepZend/php/renderscript.php';
    $arrParam = array();
    if (!empty($strNamespace))
        $arrParam[] = 'namespace=' . $strNamespace;
    else {
        if (!empty($strModule))
            $arrParam[] = 'module=' . $strModule;
        if (!empty($strSubModule))
            $arrParam[] = 'sub_module=' . $strSubModule;
        if (!empty($strType))
            $arrParam[] = 'type=' . $strType;
        if (!empty($strFileName))
            $arrParam[] = 'filename=' . $strFileName;
    }
    if (count($arrParam) > 0)
        $strUrl .= '?' . implode('&', $arrParam);
    return $strUrl;
}

function getInfoNamespaceToRenderScript($strNamespace = null)
{
    $arrNamespace = array_replace(array(null, null, null, null), explode('/', $strNamespace));
    if (empty($arrNamespace[2])) {
        $arrNamespace[2] = $arrNamespace[1];
        $arrNamespace[1] = null;
    } elseif (empty($arrNamespace[3])) {
        $arrNamespace[3] = $arrNamespace[2];
        $arrNamespace[2] = $arrNamespace[1];
        $arrNamespace[1] = null;
    }
    return $arrNamespace;
}

require_once __DIR__ . '/FileSystemLibrary.php';