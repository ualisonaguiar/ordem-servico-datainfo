<?php

namespace InepZend\Util;

use InepZend\Util\Math;
use InepZend\Util\PhpIni;
use InepZend\Util\Server;

class FileSystem
{

    /**
     * Metodo responsavel em inserir conteudo em arquivo.
     *
     * @example \InepZend\Util\FileSystem::insertContentIntoFile('./path/') <br /> \InepZend\Util\FileSystem::insertContentIntoFile('./path/', 'content') <br /> \InepZend\Util\FileSystem::insertContentIntoFile('./path/', 'content', 'mode')
     *
     * @param string $strPathFile
     * @param string $strContent
     * @param string $strMode
     * @return boolean
     *
     * @assert (__DIR__ . '/testFile.txt', date('d-m-Y')) == true
     */
    public static function insertContentIntoFile($strPathFile = null, $strContent = '', $strMode = 'w+')
    {
        require_once __DIR__ . '/Functions/FileSystemLibrary.php';
        return insertContentIntoFile($strPathFile, $strContent, $strMode);
    }

    /**
     * Metodo responsavel em capturar o conteudo de um arquivo.
     *
     * @example \InepZend\Util\FileSystem::getContentFromFile('./path_arquivo.php');
     *
     * @param string $strPathFile
     * @param boolean $booPhpIni
     * @return mix
     *
     * @assert () === false
     * @assert ('arquivo_nao_existe') === false
     * @assert (__DIR__ . '/test.txt') === "nao_remover\n"
     */
    public static function getContentFromFile($strPathFile = null, $booPhpIni = true)
    {
        if ((empty($strPathFile)) || (!is_file($strPathFile)))
            return false;
        if ($booPhpIni) {
            PhpIni::setTimeLimit(0);
            PhpIni::allocatesMemory(-1);
        }
        return file_get_contents($strPathFile);
    }
    
    public static function getContentFromFileChunk($strPathFile = null, $intLimit = 1, $intOffset = 0, $booPhpIni = true)
    {
        if ((empty($strPathFile)) || (!is_file($strPathFile)))
            return false;
        if ($booPhpIni) {
            PhpIni::setTimeLimit(0);
            PhpIni::allocatesMemory(-1);
        }
        $strContent = '';
        $hanFile = @fopen($strPathFile, 'r');
        if ($hanFile) {
            $intRow = 0;
            $intCount = 0;
            while (($strLine = fgets($hanFile, 4096)) !== false) {
                ++$intRow;
                if ($intRow <= $intOffset)
                    continue;
                ++$intCount;
                $strContent .= $strLine;
                if ($intCount >= $intLimit)
                    break;
            }
            fclose($hanFile);
        }
        return $strContent;
    }
    
    public static function getLineCountFromFile($strPathFile = null, $booPhpIni = true)
    {
        if ((empty($strPathFile)) || (!is_file($strPathFile)))
            return false;
        if ($booPhpIni) {
            PhpIni::setTimeLimit(0);
            PhpIni::allocatesMemory(-1);
        }
        $intCount = 0;
        $hanFile = @fopen($strPathFile, 'r');
        while (!feof($hanFile)) {
            fgets($hanFile);
            ++$intCount;
        }
        fclose($hanFile);
        return $intCount;
    }

    /**
     * Metodo responsavel em realizar o download de um conteudo em determinado 
     * formato (tipo) de arquivo.
     *
     * @example \InepZend\Util\FileSystem::downloadContent('file.txt') <br /> \InepZend\Util\FileSystem::downloadContent('file.txt', 'content') <br /> \InepZend\Util\FileSystem::downloadContent('file.txt', 'content', 'type')
     *
     * @param string $strFileName
     * @param string $strContent
     * @param string $strContentType
     * @return void
     */
    public static function downloadContent($strFileName = null, $strContent = '', $strContentType = null)
    {
        return self::headerContent($strFileName, $strContent, $strContentType);
    }

    public static function showContent($strFileName = null, $strContent = '', $strContentType = null)
    {
        $arrValidateContentType = array();
        $arrExtension = array(
            'txt',
            'htm',
            'html',
            'css',
            'js',
            'json',
            'xml',
            'csv',
            'png',
            'jpe',
            'jpeg',
            'jpg',
            'gif',
            'bmp',
            'ico',
            'tiff',
            'tif',
            'svg',
            'svgz',
            'pdf',
            'psd',
            'ai',
            'eps',
            'ps',
            'doc',
            'docx',
            'rtf',
            'xls',
            'ppt',
            'xlsx',
            'pptx',
            'odt',
            'ods',
            'odp',
            'odf',
        );
        $arrContentType = self::getMimeContentStructure();
        foreach ($arrExtension as $strExtension)
            $arrValidateContentType = array_merge($arrValidateContentType, (array) @$arrContentType[$strExtension]);
        return self::headerContent($strFileName, $strContent, $strContentType, 'inline', $arrValidateContentType);
    }

    public static function headerContent($strFileName = null, $strContent = '', $strContentType = null, $strContentDisposition = null, $arrValidateContentType = null)
    {
        if (empty($strFileName))
            $strFileName = time();
        if ((empty($strContent)) && (is_file($strFileName)))
            $strContent = self::getContentFromFile($strFileName);
        if (empty($strContentDisposition))
            $strContentDisposition = 'attachment';
        if (empty($strContentType))
            $strContentType = ($strContentDisposition != 'attachment') ? self::getMimeContentFromFile($strFileName) : (((isset($_SERVER['HTTP_USER_AGENT'])) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))) ? 'application/force-download' : 'application/octet-stream');
        if ((is_array($arrValidateContentType)) && (!in_array($strContentType, $arrValidateContentType)))
            return false;
        if(Server::isPhpUnit())
            return $strContent;
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: public', false);
        header('Content-Description: File Transfer');
        header('Content-type: ' . $strContentType);
        header("Content-Disposition: " . $strContentDisposition . "; filename=\"" . end($arrExplode = explode('/', str_replace('\\', '/', $strFileName))) . "\";");
        exit($strContent);
    }

    /**
     * Metodo responsavel em retornar a estrutura de tipos MIME mapeados no metodo.
     *
     * @example Retorna todos mapeados. <br /> \InepZend\Util\FileSystem::getMimeContentStructure(); <br /> Retorna um tipo especifico. <br /> \InepZend\Util\FileSystem::getMimeContentStructure()['html'];
     *
     * @return array
     *
     * @assert () === array( 'txt' => array('text/plain', 'application/txt', 'browser/internal', 'text/anytext', 'widetext/plain', 'widetext/paragraph'), 'htm' => array('text/html', 'text/plain'), 'html' => array('text/html', 'text/plain'), 'php' => array('application/x-httpd-php', 'text/php', 'application/php', 'magnus-internal/shellcgi', 'application/x-php', 'text/html'), 'java' => array('text/x-java-source', 'text/java', 'text/x-java', 'application/ms-java'), 'css' => array('text/css', 'application/css-stylesheet'), 'js' => array('application/x-javascript', 'text/javascript', 'application/javascript'), 'json' => array('application/json'), 'xml' => array('text/xml', 'application/xml', 'application/x-xml'), 'swf' => array('application/x-shockwave-flash', 'application/x-shockwave-flash2-preview', 'application/futuresplash', 'image/vnd.rn-realflash'), 'flv' => array('video/x-flv'), 'csv' => array('text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext', 'text/plain'), 'png' => array('image/png', 'image/x-png', 'application/png', 'application/x-png'), 'jpe' => array('image/jpeg'), 'jpeg' => array('image/jpeg', 'image/jpg', 'image/jpe_', 'image/pjpeg', 'image/vnd.swiftview-jpeg'), 'jpg' => array('image/jpeg', 'image/jpg', 'image/jp_', 'application/jpg', 'application/x-jpg', 'image/pjpeg', 'image/pipeg', 'image/vnd.swiftview-jpeg', 'image/x-xbitmap'), 'gif' => array('image/gif', 'image/x-xbitmap', 'image/gi_'), 'bmp' => array('image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap'), 'ico' => array('image/ico', 'image/x-icon', 'application/ico', 'application/x-ico', 'application/x-win-bitmap', 'image/x-win-bitmap', 'image/vnd.microsoft.icon'), 'tiff' => array('image/tiff'), 'tif' => array('image/tif', 'image/x-tif', 'image/tiff', 'image/x-tiff', 'application/tif', 'application/x-tif', 'application/tiff', 'application/x-tiff'), 'svg' => array('image/svg+xml'), 'svgz' => array('image/svg+xml'), 'zip' => array('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip', 'application/octet-stream'), 'rar' => array('application/x-rar-compressed', 'application/rar'), 'exe' => array('application/octet-stream', 'application/x-msdownload', 'application/exe', 'application/x-exe', 'application/dos-exe', 'vms/exe', 'application/x-winexe', 'application/msdos-windows', 'application/x-msdos-program', 'application/x-dosexe'), 'msi' => array('application/x-ole-storage', 'text/mspg-legacyinfo', 'application/x-msdownload'), 'cab' => array('vnd.ms-cab-compressed', 'application/vnd.ms-cab-compressed'), 'jar' => array('application/java-archive'), 'dll' => array('application/x-msdownload', 'application/octet-stream', 'application/x-msdos-program'), 'cmp' => array('application/octet-stream'), 'mp3' => array('audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio'), 'qt' => array('video/quicktime'), 'mov' => array('video/quicktime', 'video/x-quicktime', 'image/mov', 'audio/aiff', 'audio/x-midi', 'audio/x-wav', 'video/avi'), 'avi' => array('video/avi', 'video/msvideo', 'video/x-msvideo', 'image/avi', 'video/xmpg2', 'application/x-troff-msvideo', 'audio/aiff', 'audio/avi'), 'pdf' => array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf', 'application/x-download'), 'psd' => array('image/photoshop', 'image/x-photoshop', 'image/psd', 'application/photoshop', 'application/psd', 'zz-application/zz-winassoc-psd', 'image/vnd.adobe.photoshop'), 'ai' => array('application/postscript'), 'eps' => array('application/postscript', 'application/eps', 'application/x-eps', 'image/eps', 'image/x-eps'), 'ps' => array('application/postscript', 'application/ps', 'application/x-postscript', 'application/x-ps', 'text/postscript', 'application/x-postscript-not-eps'), 'doc' => array('application/msword', 'application/doc', 'appl/text', 'application/vnd.msword', 'application/vnd.ms-word', 'application/winword', 'application/word', 'application/x-msw6', 'application/x-msword'), 'docx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.document'), 'rtf' => array('application/rtf', 'application/x-rtf', 'text/rtf', 'text/richtext', 'application/x-soffice', 'application/save'), 'xls' => array('application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/vnd.ms-office'), 'ppt' => array('application/vnd.ms-powerpoint', 'application/mspowerpoint', 'application/ms-powerpoint', 'application/mspowerpnt', 'application/vnd-mspowerpoint', 'application/powerpoint', 'application/x-powerpoint', 'application/x-m'), 'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'), 'pptx' => array('application/vnd.openxmlformats-officedocument.presentationml.presentation'), 'odt' => array('application/vnd.oasis.opendocument.text', 'application/x-vnd.oasis.opendocument.text'), 'ods' => array('application/vnd.oasis.opendocument.spreadsheet', 'application/x-vnd.oasis.opendocument.spreadsheet'), 'odp' => array('application/vnd.oasis.opendocument.presentation', 'application/x-vnd.oasis.opendocument.presentation'), 'odf' => array('application/vnd.oasis.opendocument.formula', 'application/x-vnd.oasis.opendocument.formula'))
     */
    public static function getMimeContentStructure()
    {
        $arrMimeContentStructure = array(
            # Gerais
            'txt' => array('text/plain', 'application/txt', 'browser/internal', 'text/anytext', 'widetext/plain', 'widetext/paragraph'),
            'htm' => array('text/html', 'text/plain'),
            'html' => array('text/html', 'text/plain'),
            'php' => array('application/x-httpd-php', 'text/php', 'application/php', 'magnus-internal/shellcgi', 'application/x-php', 'text/html'),
            'java' => array('text/x-java-source', 'text/java', 'text/x-java', 'application/ms-java'),
            'css' => array('text/css', 'application/css-stylesheet'),
            'js' => array('application/x-javascript', 'text/javascript', 'application/javascript'),
            'json' => array('application/json'),
            'xml' => array('text/xml', 'application/xml', 'application/x-xml'),
            'swf' => array('application/x-shockwave-flash', 'application/x-shockwave-flash2-preview', 'application/futuresplash', 'image/vnd.rn-realflash'),
            'flv' => array('video/x-flv'),
            'csv' => array('text/comma-separated-values', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext', 'text/plain'),
            # Imagens
            'png' => array('image/png', 'image/x-png', 'application/png', 'application/x-png'),
            'jpe' => array('image/jpeg'),
            'jpeg' => array('image/jpeg', 'image/jpg', 'image/jpe_', 'image/pjpeg', 'image/vnd.swiftview-jpeg'),
            'jpg' => array('image/jpeg', 'image/jpg', 'image/jp_', 'application/jpg', 'application/x-jpg', 'image/pjpeg', 'image/pipeg', 'image/vnd.swiftview-jpeg', 'image/x-xbitmap'),
            'gif' => array('image/gif', 'image/x-xbitmap', 'image/gi_'),
            'bmp' => array('image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap'),
            'ico' => array('image/ico', 'image/x-icon', 'application/ico', 'application/x-ico', 'application/x-win-bitmap', 'image/x-win-bitmap', 'image/vnd.microsoft.icon'),
            'tiff' => array('image/tiff'),
            'tif' => array('image/tif', 'image/x-tif', 'image/tiff', 'image/x-tiff', 'application/tif', 'application/x-tif', 'application/tiff', 'application/x-tiff'),
            'svg' => array('image/svg+xml'),
            'svgz' => array('image/svg+xml'),
            # Comprimidos e executaveis
            'zip' => array('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip', 'application/octet-stream'),
            'rar' => array('application/x-rar-compressed', 'application/rar'),
            'exe' => array('application/octet-stream', 'application/x-msdownload', 'application/exe', 'application/x-exe', 'application/dos-exe', 'vms/exe', 'application/x-winexe', 'application/msdos-windows', 'application/x-msdos-program', 'application/x-dosexe'),
            'msi' => array('application/x-ole-storage', 'text/mspg-legacyinfo', 'application/x-msdownload'),
            'cab' => array('vnd.ms-cab-compressed', 'application/vnd.ms-cab-compressed'),
            'jar' => array('application/java-archive'),
            'dll' => array('application/x-msdownload', 'application/octet-stream', 'application/x-msdos-program'),
            'cmp' => array('application/octet-stream'),
            # Audio/Video
            'mp3' => array('audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio'),
            'qt' => array('video/quicktime'),
            'mov' => array('video/quicktime', 'video/x-quicktime', 'image/mov', 'audio/aiff', 'audio/x-midi', 'audio/x-wav', 'video/avi'),
            'avi' => array('video/avi', 'video/msvideo', 'video/x-msvideo', 'image/avi', 'video/xmpg2', 'application/x-troff-msvideo', 'audio/aiff', 'audio/avi'),
            # Adobe
            'pdf' => array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf', 'application/x-download'),
            'psd' => array('image/photoshop', 'image/x-photoshop', 'image/psd', 'application/photoshop', 'application/psd', 'zz-application/zz-winassoc-psd', 'image/vnd.adobe.photoshop'),
            'ai' => array('application/postscript'),
            'eps' => array('application/postscript', 'application/eps', 'application/x-eps', 'image/eps', 'image/x-eps'),
            'ps' => array('application/postscript', 'application/ps', 'application/x-postscript', 'application/x-ps', 'text/postscript', 'application/x-postscript-not-eps'),
            # MSOffice
            'doc' => array('application/msword', 'application/doc', 'appl/text', 'application/vnd.msword', 'application/vnd.ms-word', 'application/winword', 'application/word', 'application/x-msw6', 'application/x-msword'),
            'docx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
            'rtf' => array('application/rtf', 'application/x-rtf', 'text/rtf', 'text/richtext', 'application/x-soffice', 'application/save'),
            'xls' => array('application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/vnd.ms-office'),
            'ppt' => array('application/vnd.ms-powerpoint', 'application/mspowerpoint', 'application/ms-powerpoint', 'application/mspowerpnt', 'application/vnd-mspowerpoint', 'application/powerpoint', 'application/x-powerpoint', 'application/x-m'),
            'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            'pptx' => array('application/vnd.openxmlformats-officedocument.presentationml.presentation'),
            # OpenOffice
            'odt' => array('application/vnd.oasis.opendocument.text', 'application/x-vnd.oasis.opendocument.text'),
            'ods' => array('application/vnd.oasis.opendocument.spreadsheet', 'application/x-vnd.oasis.opendocument.spreadsheet'),
            'odp' => array('application/vnd.oasis.opendocument.presentation', 'application/x-vnd.oasis.opendocument.presentation'),
            'odf' => array('application/vnd.oasis.opendocument.formula', 'application/x-vnd.oasis.opendocument.formula'),
        );
        return $arrMimeContentStructure;
    }

    /**
     * Metodo responsavel em capturar o tipo MIME a partir de uma determinada 
     * extensao de arquivo mapeado no metodo getMimeContentStructure.
     *
     * @example \InepZend\Util\FileSystem::getMimeContentFromExtension('html');
     *
     * @param string $strExtension
     * @return mix
     *
     * @assert ('html') === array('text/html', 'text/plain')
     * @assert ('empty') === array()
     * @assert ('') === null
     * @assert () === null
     */
    public static function getMimeContentFromExtension($strExtension = null)
    {
        if (empty($strExtension))
            return;
        $strExtension = strtolower($strExtension);
        $arrMimeContentStructure = self::getMimeContentStructure();
        $arrMimeContentFromExtension = (array_key_exists($strExtension, $arrMimeContentStructure)) ? $arrMimeContentStructure[$strExtension] : array();
        return $arrMimeContentFromExtension;
    }

    /**
     * Metodo responsavel em capturar o tipo MIME do conteudo do arquivo.
     *
     * @example \InepZend\Util\FileSystem::getMimeContentFromFile('./path_arquivo.php');
     *
     * @param string $strPathFile
     * @return mix
     *
     * @assert () === false
     * @aseert ('path_not_exisist.php') === false
     * @assert (__DIR__ . '/test.txt') == 'text/plain'
     */
    public static function getMimeContentFromFile($strPathFile = null)
    {
        if ((is_null($strPathFile)) || (empty($strPathFile)) || (!file_exists($strPathFile)))
            return false;
        $booCheck = false;
        if (function_exists('mime_content_type')) {
            $strMimeContent = mime_content_type($strPathFile);
            if (($strMimeContent == 'inode/x-empty') || ($strMimeContent === false))
                $booCheck = true;
        } else
            $booCheck = true;
        if ($booCheck)
            $strMimeContent = reset(self::getMimeContentFromExtension(array_pop(explode('.', $strPathFile))));
        return $strMimeContent;
    }

    /**
     * Metodo responsavel em capturar a(s) extensao(oes) a partir de um 
     * determinado tipo MIME mapeado no metodo getMimeContentStructure.
     *
     * @example \InepZend\Util\FileSystem::getExtensionFromMimeContent('text/plain');
     *
     * @param string $strMimeContent
     * @return mix
     *
     * @assert () === null
     * @assert ('text/plain') === array('txt', 'htm', 'html', 'csv')
     * @assert ('type/not') === null
     */
    public static function getExtensionFromMimeContent($strMimeContent = null)
    {
        if (empty($strMimeContent))
            return;
        $strMimeContent = strtolower($strMimeContent);
        $arrMimeContentStructure = self::getMimeContentStructure();
        $arrExtensionFromMimeContent = array();
        foreach ($arrMimeContentStructure as $strExtension => $arrMimeContentFromExtension) {
            foreach ($arrMimeContentFromExtension as $strMimeContentIntern) {
                if ($strMimeContent == strtolower($strMimeContentIntern)) {
                    if (!array_key_exists($strMimeContent, $arrExtensionFromMimeContent))
                        $arrExtensionFromMimeContent[$strMimeContent] = array();
                    if (!in_array($strExtension, $arrExtensionFromMimeContent[$strMimeContent]))
                        $arrExtensionFromMimeContent[$strMimeContent][] = $strExtension;
                }
            }
        }
        return (array_key_exists($strMimeContent, $arrExtensionFromMimeContent)) ? $arrExtensionFromMimeContent[$strMimeContent] : null;
    }

    /**
     * Metodo responsavel pelo retorno da extensao do arquivo.
     *
     * @example \InepZend\Util\FileSystem::getExtensionFromFileName('test.txt')
     *
     * @param string $strFileName
     * @return string
     *
     * @assert () === null
     * @assert ('test.txt') === 'txt'
     * @assert ('InstitutoNacionalEnsiso.Anisio.Texeira.pdf') === 'pdf'
     * @assert ('Instituto.Nacional.Ensiso.Anisio.Texeira.pdf') === 'pdf'
     */
    public static function getExtensionFromFileName($strFileName = null)
    {
        return (empty($strFileName)) ? null : strtolower(array_pop(explode('.', $strFileName)));
    }

    /**
     * Metodo responsavel em deletar em cascata todos os arquivos de um diretorio 
     * e ele proprio tambem.
     *
     * @example \InepZend\Util\FileSystem::undir('./path/file.php')
     *
     * @param string $strPath
     * @return void
     */
    public static function undir($strPath = null)
    {
        if (!self::isWritable($strPath))
            return;
        $strPath = str_replace('//', '/', $strPath);
        if (is_dir($strPath)) {
            foreach (glob($strPath . '/*') as $strSubPath) {
                $strSubPath = str_replace('//', '/', $strSubPath);
                if (!self::isWritable($strSubPath))
                    continue;
                if ((is_dir($strSubPath)) && (!is_link($strSubPath))) {
                    self::undir($strSubPath);
                    if (is_dir($strSubPath))
                        @rmdir($strSubPath);
                } elseif (is_file($strSubPath))
                    @unlink($strSubPath);
            }
        }
        if (is_dir($strPath))
            @rmdir($strPath);
    }

    /**
     * Metodo responsavel em realizar a copia completa e recursiva.
     * 
     * @param string $strSource
     * @param string $strDest
     * @return void
     */
    public static function recurse_copy($strSource = null, $strDest = null)
    {
        if ((!is_dir($strSource)) && (!is_file($strSource)) && (!is_link($strSource)))
            return;
        $hanDir = opendir($strSource);
        mkdir($strDest, 0777, true);
        while (false !== ($strFile = readdir($hanDir))) {
            if (($strFile != '.') && ($strFile != '..')) {
                if (is_dir($strSource . '/' . $strFile))
                    self::recurse_copy($strSource . '/' . $strFile, $strDest . '/' . $strFile);
                else
                    copy($strSource . '/' . $strFile, $strDest . '/' . $strFile);
            }
        }
        closedir($hanDir);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa glob recursivamente.
     *
     * @example \InepZend\Util\FileSystem::globRecursive('./path/to/dir') <br /> \InepZend\Util\FileSystem::globRecursive('./path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::globRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\FileSystem::globRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     *
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     */
    public static function globRecursive($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return self::listFileFolderRecursive('glob', $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa scandir recursivamente.
     *
     * @example \InepZend\Util\FileSystem::scandirRecursive('./path/to/dir') <br /> \InepZend\Util\FileSystem::scandirRecursive('./path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::scandirRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\FileSystem::scandirRecursive('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     *
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/FormGenerator/', null, array(), true, true) === array(__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/FormGenerator/Add', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/FormGenerator/Element')
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     */
    public static function scandirRecursive($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return self::listFileFolderRecursive('scandir', $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar funcoes nativas recursivamente para listar 
     * arquivos e diretorios.
     *
     * @example \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir') <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict')) <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false) <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false) <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php')) <br /> \InepZend\Util\FileSystem::listFileFolderRecursive('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php'), 100)
     *
     * @param string $strMethod
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @param array $arrFiles
     * @param integer $intDepth
     * @return array
     *
     * @assert ('glob',__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert ('scandir',__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/bin', null, array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/bin', null, array(), false, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, false) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, false) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), false, true) === array()
     *
     * @TODO Rever testes com uma subpasta
     */
    public static function listFileFolderRecursive($strMethod = 'glob', $strPath = null, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false, $arrFiles = array(), $intDepth = 0)
    {
        if ((is_null($strMethod)) || (empty($strMethod)))
            $strMethod = 'glob';
        $strMethod = strtolower($strMethod);
        if ($strPath{ (strlen($strPath) - 1) } == '/')
            $strPath = substr($strPath, 0, (strlen($strPath) - 1));
        $strPath = str_replace('//', '/', $strPath);
        ++$intDepth;
        if (is_dir($strPath)) {
            $booContinue = true;
            foreach ($arrPathRestrict as $strPathRestrict) {
                if (stripos($strPath, $strPathRestrict) !== false) {
                    $booContinue = false;
                    break;
                }
            }
            if (($booShowDir === true) && (is_dir($strPath)) && (!is_link($strPath)) && ($booContinue === true) && ($intDepth != 1) && (!in_array($strPath, $arrFiles)))
                $arrFiles[] = $strPath;
            if ($strMethod == 'scandir') {
                $strFolder = str_replace(end($arrExplode = explode('/', $strPath)), '', $strPath);
                $arrPath = scandir($strPath);
            } else {
                $intFlagGlob = ($booShowOnlyDir === true) ? GLOB_ONLYDIR : null;
                $arrPath = glob($strPath . '/*', $intFlagGlob);
            }
            if (is_array($arrPath)) {
                foreach ((array) $arrPath as $strSubPath) {
                    if (($strMethod == 'scandir') && (in_array($strSubPath, array('.', '..', '.svn'))))
                        continue;
                    if ($strMethod == 'scandir')
                        $strSubPath = $strPath . '/' . $strSubPath;
                    $strSubPath = str_replace('//', '/', $strSubPath);
                    if ((is_dir($strSubPath)) && (!is_link($strSubPath))) {
                        $booContinue = true;
                        foreach ($arrPathRestrict as $strPathRestrict) {
                            if (stripos($strSubPath, $strPathRestrict) !== false) {
                                $booContinue = false;
                                break;
                            }
                        }
                        if ($booContinue === true)
                            $arrFiles = self::listFileFolderRecursive($strMethod, $strSubPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir, $arrFiles, $intDepth);
                    } elseif ($booShowOnlyDir === false) {
                        $booInsertFile = true;
                        if (!empty($mixExtension)) {
                            $booInsertFile = false;
                            if (!is_array($mixExtension))
                                $mixExtension = array($mixExtension);
                            foreach ($mixExtension as $strExtension) {
                                if (strtolower($strExtension) == strtolower(end($arrExplode = explode('.', $strSubPath)))) {
                                    $booInsertFile = true;
                                    break;
                                }
                            }
                        }
                        if (($booInsertFile === true) && (!in_array($strSubPath, $arrFiles)))
                            $arrFiles[] = $strSubPath;
                    }
                }
            }
        }
        return $arrFiles;
    }

    /**
     * Metodo responsavel em listar a arvore de diretorios de um determinado 
     * caminho.
     *
     * @example \InepZend\Util\FileSystem::listTreePath('/path/to/dir/') <br /> \InepZend\Util\FileSystem::listTreePath('/path/to/dir/', 1) <br /> \InepZend\Util\FileSystem::listTreePath('/path/to/dir/', 2, 1)
     *
     * @param string $strPath
     * @param integer $intDepthMax
     * @param integer $intDepthCount
     * @return mix
     *
     * @assert (__DIR__ . '/') == array('strPath' => __DIR__ . '/', 'arrSubPath' => array())
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util') == array('strPath' => __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'arrSubPath' => array())
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/', 1, 2) == null
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/', 2, 1) != array()
     *
     * @TODO ('./path/') != ('./path') | Tem diferenca se tem '/' no final do path.
     */
    public static function listTreePath($strPath = '/', $intDepthMax = 0, $intDepthCount = 0)
    {
        if ($intDepthCount > $intDepthMax)
            return;
        $arrPath = array();
        $path = dir($strPath);
        while (($strPathName = $path->read()) !== false) {
            if (($strPathName != '.') && ($strPathName != '..') && (is_dir($strPath . $strPathName))) {
                if (!array_key_exists($intDepthCount, $arrPath))
                    $arrPath[$intDepthCount] = array();
                if (!array_key_exists('arrInfoPath', $arrPath[$intDepthCount]))
                    $arrPath[$intDepthCount]['arrInfoPath'] = array();
                $intCount = (is_array($arrPath[$intDepthCount]['arrInfoPath'])) ? count($arrPath[$intDepthCount]['arrInfoPath']) : 0;
                $arrPath[$intDepthCount]['arrInfoPath'][$intCount] = array(
                    'strPath' => $strPathName,
                    'arrSubPath' => self::listTreePath($strPath . $strPathName . '/', $intDepthMax, ($intDepthCount + 1))
                );
            }
        }
        $path->close();
        if ($intDepthCount == 0) {
            $arrPath['strPath'] = $strPath;
            $arrPath['arrSubPath'] = array();
            if (isset($arrPath[$intDepthCount])) {
                $arrPath['arrSubPath'] = array($arrPath[$intDepthCount]);
                unset($arrPath[$intDepthCount]);
            }
        }
        return (count($arrPath) == 0) ? null : $arrPath;
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa glob recursivamente, 
     * apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\FileSystem::globRecursivePartPath('./path/to/dir') <br /> \InepZend\Util\FileSystem::globRecursivePartPath('./path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::globRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\FileSystem::globRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     *
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     */
    public static function globRecursivePartPath($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return self::listFileFolderRecursivePartPath('glob', $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar a funcao nativa scandir recursivamente, 
     * apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\FileSystem::scandirRecursivePartPath('./path/to/dir') <br /> \InepZend\Util\FileSystem::scandirRecursivePartPath('./path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::scandirRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo')) <br /> \InepZend\Util\FileSystem::scandirRecursivePartPath('./path/to/dir', 'extension', array('DirOne','DirTwo'), true/false, true/false)
     *
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     *
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert (__DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     */
    public static function scandirRecursivePartPath($strPath, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        return self::listFileFolderRecursivePartPath('scandir', $strPath, $mixExtension, $arrPathRestrict, $booShowDir, $booShowOnlyDir);
    }

    /**
     * Metodo responsavel em utilizar funcoes nativas recursivamente para listar 
     * arquivos e diretorios, apartir de parte do nome do diretorio.
     *
     * @example \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir') <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension') <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict')) <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false) <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false) <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php')) <br /> \InepZend\Util\FileSystem::listFileFolderRecursivePartPath('glob/scandir', './path/to/dir', 'extension', array('pathRestrict'), true/false, true/false, array('nameFiles.php'), 100)
     *
     * @param string $strMethod
     * @param string $strPath
     * @param mix $mixExtension
     * @param array $arrPathRestrict
     * @param boolean $booShowDir
     * @param boolean $booShowOnlyDir
     * @return array
     *
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/library/InepZend/') !== null
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/bin', 'bat') === array(__DIR__ . '/../../../../../vendor/InepZend/bin/apigen_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/classmap_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/full_generator.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit-module.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/phpunit.bat', __DIR__ . '/../../../../../vendor/InepZend/bin/templatemap_generator.bat')
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), true, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', null, array(), false, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/bin', null, array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/bin', null, array(), false, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, false) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, false) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), true, true) === array()
     * @assert ('glob', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), false, true) === array()
     * @assert ('scandir', __DIR__ . '/../../../../../vendor/InepZend/test/InepZend/Util', 'Util', array(), false, true) === array()
     *
     * @TODO Rever testes com uma subpasta
     */
    public static function listFileFolderRecursivePartPath($strMethod = 'glob', $strPath = null, $mixExtension = null, $arrPathRestrict = array(), $booShowDir = false, $booShowOnlyDir = false)
    {
        if ((is_null($strMethod)) || (empty($strMethod)))
            $strMethod = 'glob';
        $strMethod = strtolower($strMethod);
        $strPath = str_replace('//', '/', $strPath);
        $arrPath = array();
        if (!is_dir($strPath)) {
            $strLastFolder = end($arrExplode = explode('/', $strPath));
            $strPathEdited = str_replace('/' . $strLastFolder, '', $strPath);
            $arrSubPathEdited = glob($strPathEdited . '/*', GLOB_ONLYDIR);
            foreach ($arrSubPathEdited as $strSubPathEdited) {
                if (($strSubPathEdited == '.') || ($strSubPathEdited == '..'))
                    continue;
                if (stripos(str_replace($strPathEdited . '/', '', $strSubPathEdited), $strLastFolder) === 0)
                    $arrPath[] = $strSubPathEdited;
            }
        } else
            $arrPath[] = $strPath;
        $arrFiles = array();
        foreach ($arrPath as $strPathIntern)
            eval('$arrFiles = array_merge($arrFiles , self::' . $strMethod . 'Recursive($strPathIntern , $mixExtension , $arrPathRestrict , $booShowDir , $booShowOnlyDir));');
        $arrFiles = array_unique($arrFiles);
        return $arrFiles;
    }

    /**
     * Metodo responsavel em retornar o mode (permissao) de um arquivo ou 
     * diretorio, caso exista.
     *
     * @example \InepZend\Util\FileSystem::getChmod('./path/')
     *
     * @param string $strPath
     * @return mix
     *
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) === InepZend\Util\FileSystem::getChmod(\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'))
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) !== false
     * @assert ('./path/') === false
     */
    public static function getChmod($strPath)
    {
        if ((empty($strPath)) || ((!is_file($strPath)) && (!is_dir($strPath))))
            return false;
        return substr(sprintf('%o', fileperms($strPath)), -4);
    }

    /**
     * Metodo responsavel em retornar as permissoes de um arquivo ou diretorio, 
     * caso exista.
     *
     * @example \InepZend\Util\FileSystem::getPermission('./path/')
     *
     * @param string $strPath
     * @return mix
     *
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) === InepZend\Util\FileSystem::getPermission(\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'))
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) !== false
     * @assert ('./path/') === false
     */
    public static function getPermission($strPath)
    {
        if ((empty($strPath)) || ((!is_file($strPath)) && (!is_dir($strPath))))
            return false;
        $strPermissionResult = '';
        $strPermission = fileperms($strPath);
        if (($strPermission & 0xC000) == 0xC000)
            $strPermissionResult .= 's';
        elseif (($strPermission & 0xA000) == 0xA000)
            $strPermissionResult .= 'l';
        elseif (($strPermission & 0x8000) == 0x8000)
            $strPermissionResult .= '-';
        elseif (($strPermission & 0x6000) == 0x6000)
            $strPermissionResult .= 'b';
        elseif (($strPermission & 0x4000) == 0x4000)
            $strPermissionResult .= 'd';
        elseif (($strPermission & 0x2000) == 0x2000)
            $strPermissionResult .= 'c';
        elseif (($strPermission & 0x1000) == 0x1000)
            $strPermissionResult .= 'p';
        else
            $strPermissionResult .= 'u';
        $strPermissionResult .= (($strPermission & 0x0100) ? 'r' : '-');
        $strPermissionResult .= (($strPermission & 0x0080) ? 'w' : '-');
        $strPermissionResult .= (($strPermission & 0x0040) ? (($strPermission & 0x0800) ? 's' : 'x' ) : (($strPermission & 0x0800) ? 'S' : '-'));
        $strPermissionResult .= (($strPermission & 0x0020) ? 'r' : '-');
        $strPermissionResult .= (($strPermission & 0x0010) ? 'w' : '-');
        $strPermissionResult .= (($strPermission & 0x0008) ? (($strPermission & 0x0400) ? 's' : 'x' ) : (($strPermission & 0x0400) ? 'S' : '-'));
        $strPermissionResult .= (($strPermission & 0x0004) ? 'r' : '-');
        $strPermissionResult .= (($strPermission & 0x0002) ? 'w' : '-');
        $strPermissionResult .= (($strPermission & 0x0001) ? (($strPermission & 0x0200) ? 't' : 'x' ) : (($strPermission & 0x0200) ? 'T' : '-'));
        return $strPermissionResult;
    }

    /**
     * Metodo responsavel em retornar os significados das permissoes de um 
     * arquivo ou diretorio, caso exista.
     *
     * @example \InepZend\Util\FileSystem::getPermissionMeaning('./path/')
     *
     * @param string $strPath
     * @return mix
     *
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) == InepZend\Util\FileSystem::getPermissionMeaning(\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'))
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) !== null
     * @assert ('./path/') == false
     */
    public static function getPermissionMeaning($strPath)
    {
        $mixPermissionResult = self::getPermission($strPath);
        if (is_bool($mixPermissionResult))
            return false;
        $arrResult = array(
            'type' => ($mixPermissionResult[0] == '-') ? 'file' : (($mixPermissionResult[0] == 'd') ? 'directory' : 'link'),
            'owner' => array(),
            'group' => array(),
            'others' => array(),
        );
        $arrSymbol = array(
            'r' => 'read',
            'w' => 'write',
            'x' => 'execute',
        );
        $arrMap = array(
            'owner' => array(1, 2, 3),
            'group' => array(4, 5, 6),
            'others' => array(7, 8, 9),
        );
        foreach ($arrMap as $strKey => $arrKey) {
            foreach ($arrKey as $intKey) {
                if (array_key_exists($mixPermissionResult[$intKey], $arrSymbol))
                    $arrResult[$strKey][] = $arrSymbol[$mixPermissionResult[$intKey]];
            }
        }
        return $arrResult;
    }

    /**
     * Metodo responsavel em converter uma string da permissao em valores do 
     * mode (octal e decimal).
     *
     * @example \InepZend\Util\FileSystem::convertPermissionToChmod('./path/')
     *
     * @param string $strPermission
     * @return mix
     *
     * @assert ('drwxrwxrwx') === array('octal' => '0777', 'decimal' => 511)
     * @assert ('lrwxrwxrwx') === array('octal' => '0777', 'decimal' => 511)
     * @assert ('-rw-------') === array('octal' => '0600', 'decimal' => 384)
     * @assert ('drwxr-xr-x') === array('octal' => '0755', 'decimal' => 493)
     * @assert ('çrplk9xr6x') === array('octal' => '0000', 'decimal' => 0)
     * @assert ('') === false
     */
    public static function convertPermissionToChmod($strPermission)
    {
        if (empty($strPermission))
            return false;
        $intMode = 0;
        if ($strPermission[1] == 'r')
            $intMode += 0400;
        if ($strPermission[2] == 'w')
            $intMode += 0200;
        if ($strPermission[3] == 'x')
            $intMode += 0100;
        else if ($strPermission[3] == 's')
            $intMode += 04100;
        else if ($strPermission[3] == 'S')
            $intMode += 04000;
        if ($strPermission[4] == 'r')
            $intMode += 040;
        if ($strPermission[5] == 'w')
            $intMode += 020;
        if ($strPermission[6] == 'x')
            $intMode += 010;
        else if ($strPermission[6] == 's')
            $intMode += 02010;
        else if ($strPermission[6] == 'S')
            $intMode += 02000;
        if ($strPermission[7] == 'r')
            $intMode += 04;
        if ($strPermission[8] == 'w')
            $intMode += 02;
        if ($strPermission[9] == 'x')
            $intMode += 01;
        else if ($strPermission[9] == 't')
            $intMode += 01001;
        else if ($strPermission[9] == 'T')
            $intMode += 01000;
        return array('octal' => (sprintf('%04o', $intMode)), 'decimal' => (integer) sprintf('%d', $intMode));
    }

    /**
     * Metodo responsavel em verificar se um arquivo ou diretorio possui as 
     * devidas permissoes de leitura, caso exista.
     *
     * @example \InepZend\Util\FileSystem::isReadable('./path/')
     *
     * @param string $strPath
     * @param string $strProfile
     * @return mix
     *
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) == true
     * @assert ('./path/') == false
     */
    public static function isReadable($strPath, $strProfile = null)
    {
        $booCheck = self::checkPermission($strPath, $strProfile, 'read');
        if ($booCheck)
            $booCheck = is_readable($strPath);
        return $booCheck;
    }

    /**
     * Metodo responsavel em verificar se um arquivo ou diretorio possui as 
     * devidas permissoes de escrita, caso exista.
     *
     * @example \InepZend\Util\FileSystem::isWritable('./path/')
     *
     * @param string $strPath
     * @param string $strProfile
     * @return mix
     *
     * @assert ('') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) == true
     * @assert ('./path/') == null
     */
    public static function isWritable($strPath, $strProfile = null)
    {
        $booCheck = self::checkPermission($strPath, $strProfile, 'write');
        if ($booCheck)
            $booCheck = is_writable($strPath);
        return $booCheck;
    }

    /**
     * Metodo responsavel em verificar se um arquivo ou diretorio possui as 
     * devidas permissoes de execucao, caso exista.
     *
     * @example \InepZend\Util\FileSystem::isExecutable('./path/') <br /> \InepZend\Util\FileSystem::isExecutable('./path/', 'profile')
     *
     * @param string $strPath
     * @param string $strProfile
     * @return mix
     *
     * @assert ('') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) == true
     * @assert ('./path/') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'type') == false
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'owner') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'group') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'others') == true
     */
    public static function isExecutable($strPath, $strProfile = null)
    {
        $booCheck = self::checkPermission($strPath, $strProfile, 'execute');
        if (($booCheck) && (!is_dir($strPath)))
            $booCheck = is_executable($strPath);
        return $booCheck;
    }

    /**
     * Metodo responsavel em verificar se um arquivo ou diretorio possui as 
     * devidas permissoes, caso exista.
     *
     * @example \InepZend\Util\FileSystem::checkPermission('./path/') <br /> \InepZend\Util\FileSystem::checkPermission('./path/', 'profile') <br /> \InepZend\Util\FileSystem::checkPermission('./path/', 'profile', 'actionProfile')
     *
     * @param string $strPath
     * @param string $strProfile
     * @param string $strPermissionAction
     * @return mix
     *
     * @assert ('') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) == null
     * @assert ('./path/') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'type') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'owner') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'group') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'others') == null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'owner', 'write') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'group', 'write') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'others', 'write') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'owner', 'execute') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'group', 'execute') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'others', 'execute') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'owner', 'read') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'group', 'read') == true
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/'), 'others', 'read') == true
     */
    public static function checkPermission($strPath, $strProfile = null, $strPermissionAction = null)
    {
        if (empty($strPermissionAction))
            return;
        $mixPermissionMeaning = self::getPermissionMeaning($strPath);
        if (is_bool($mixPermissionMeaning))
            return;
        $arrReadable = array();
        foreach ($mixPermissionMeaning as $strKey => $mixValue) {
            if ($strKey == 'type')
                continue;
            if ((!empty($strProfile)) && ($strProfile != $strKey))
                continue;
            if (in_array($strPermissionAction, $mixValue))
                $arrReadable[] = $strKey;
        }
        return (count($arrReadable) > 0);
    }

    /**
     * Metodo responsavel em retornar a data da ultima modificacao de um arquivo 
     * ou diretorio.
     *
     * @example \InepZend\Util\FileSystem::getModificationTime('./pathOrFile/')
     *
     * @param string $strPath
     * @return mix
     *
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) !== null
     * @assert (\InepZend\Util\Server::getReplacedBasePathApplication('/../../../../../data/')) !== false
     * @assert ('./pathOrFile.php') == false
     */
    public static function getModificationTime($strPath)
    {
        return (!file_exists($strPath)) ? false : date('d/m/Y H:i:s', filemtime($strPath));
    }

    /**
     * Metodo responsavel em retornar o tamanho do diretorio ou arquivo caso exista.
     *
     * @example \InepZend\Util\FileSystem::filesize('./pathOrFile/') <br /> \InepZend\Util\FileSystem::filesize('./pathOrFile/', 'megabyte') <br /> \InepZend\Util\FileSystem::filesize(null, null, 123456) <br /> \InepZend\Util\FileSystem::filesize(null, 'megabyte', 123456)
     *
     * @param string $strPath
     * @param string $strUnitOfMeasure
     * @param integer $intByte
     * @return mix
     *
     * @assert (__DIR__ . '/') !== null
     * @assert (__DIR__ . '/test.txt') !== null
     * @assert (__DIR__ . '/', 'kilobyte') !== null
     * @assert (__DIR__ . '/test.txt', 'kilobyte') !== null
     * @assert (__DIR__ . '/', 'bit') !== null
     * @assert (__DIR__ . '/test.txt', 'bit') !== null
     *
     * @TODO assert (__DIR__ . '/naoExiste.txt', 'bit') | Tratar o erro que he gerado no phpunit
     */
    public static function filesize($strPath = null, $strUnitOfMeasure = null, $intByte = null)
    {
        $arrUnitOfMeasure = array('bit', 'byte', 'kilobyte', 'megabyte', 'gigabyte', 'terabyte');
        $mixFilesize = ((!empty($strPath)) && (is_file($strPath))) ? @filesize($strPath) : (integer) $intByte;
        if ((is_numeric($mixFilesize)) && ($mixFilesize < 0)) {
            $curl = curl_init('file://' . $strPath);
            curl_setopt($curl, CURLOPT_NOBODY, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, true);
            $mixData = curl_exec($curl);
            curl_close($curl);
            if (($mixData !== false) && (preg_match('/Content-Length: (\d+)/', $mixData, $arrMatch)))
                $mixFilesize = (integer) $arrMatch[1];
        }
        if ((empty($strUnitOfMeasure)) || ($mixFilesize === false) || ($mixFilesize === 0) || (!in_array(($strUnitOfMeasure = strtolower($strUnitOfMeasure)), $arrUnitOfMeasure)))
            return $mixFilesize;
        $mixResult = null;
        foreach ($arrUnitOfMeasure as $intKey => $strUnit) {
            if ($strUnit != $strUnitOfMeasure)
                continue;
            $mixResult = $mixFilesize;
            if ($intKey == 0)
                $mixResult *= 8;
            elseif ($intKey > 1) {
                for ($intCount = 1; $intCount < $intKey; ++$intCount)
                    $mixResult /= 1024;
            }
        }
        if ((!empty($mixResult)) && (is_float($mixResult)))
            $mixResult = (float) number_format($mixResult, 2);
        return $mixResult;
    }

    /**
     * Metodo responsavel em retornar o tamanho do diretorio ou arquivo formatado, 
     * caso exista.
     *
     * @param string $strPath
     * @param integer $intByte
     * @param boolean $booSigla
     * @return string
     *
     * @assert (__DIR__ . '/') !== null
     * @assert (__DIR__ . '/test.txt') !== null
     */
    public static function filesizeFormated($strPath = null, $intByte = null, $booSigla = true)
    {
        $intBit = (integer) self::filesize($strPath, 'bit', $intByte);
        $intByte = $intBit / 8;
        $strFilesize = null;
        if ($intBit < 8)
            $strFilesize = $intBit . ' bit';
        elseif ($intBit < Math::loopOperation('8', '*', '1024', 1))
            $strFilesize = number_format($intByte, 2) . ' byte';
        elseif ($intBit < Math::loopOperation('8', '*', '1024', 2))
            $strFilesize = number_format(Math::loopOperation($intByte, '/', '1024', 1), 2) . ' ' . (($booSigla === false) ? 'Kilobyte' : 'KB');
        elseif ($intBit < Math::loopOperation('8', '*', '1024', 3))
            $strFilesize = number_format(Math::loopOperation($intByte, '/', '1024', 2), 2) . ' ' . (($booSigla === false) ? 'Megabyte' : 'MB');
        elseif ($intBit < Math::loopOperation('8', '*', '1024', 4))
            $strFilesize = number_format(Math::loopOperation($intByte, '/', '1024', 3), 2) . ' ' . (($booSigla === false) ? 'Gigabyte' : 'GB');
        elseif ($intBit < Math::loopOperation('8', '*', '1024', 5))
            $strFilesize = number_format(Math::loopOperation($intByte, '/', '1024', 4), 2) . ' ' . (($booSigla === false) ? 'Terabyte' : 'TB');
        if ((!is_null($strFilesize)) && ((integer) $strFilesize > 0))
            $strFilesize .= 's';
        return str_replace('.00', '', $strFilesize);
    }

    /**
     * Metodo responsavel em retornar o nome do arquivo.
     *
     * @example \InepZend\Util\FileSystem::getFileNameFromPath('./path/file.txt')
     *
     * @param string $strPath
     * @return string
     *
     * @assert (__DIR__ . '/test.txt') == 'test.txt'
     * @assert (__DIR__ . '/') == ''
     *
     * @TODO assert ('./pathNoExist') == 'pathNoExist' | Nao faz a validacao se o arquivo existe
     */
    public static function getFileNameFromPath($strPath)
    {
        return end($arrExplode = explode('/', str_replace('\\', '/', (string) $strPath)));
    }

}
