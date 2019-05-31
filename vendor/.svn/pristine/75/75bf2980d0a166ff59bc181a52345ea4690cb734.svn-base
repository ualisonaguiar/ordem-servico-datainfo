<?php

namespace InepZend\Compression;

use ZipArchive;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\FileSystem;

/**
 * @example
 * # Para criacao do arquivo zip
 * $zipFile = ZipFile::getInstance();
 * $arrResult = $zipFile->openZip('teste.zip', ZIPARCHIVE::CREATE);
 * $arrResult = $zipFile->addFileIntoZip('default_script.php', 'script.php');
 * $arrResult = $zipFile->createFolderIntoZip('teste');
 * $arrResult = $zipFile->addFileIntoZip('default_backend.php' ,'teste/backend.php');
 * $arrResult = $zipFile->addContentIntoZip('testando...', 'teste.txt');
 * $arrResult = $zipFile->closeZip(false, false); // Primeiro bool para download, segundo bool para remover o arquivo do diretorio
 * # Para visualizacao das informacoes do arquivo zip
 * $zipFile = ZipFile::getInstance();
 * $arrResult = $zipFile->openZip('teste.zip');
 * print_r(var_dump($zipFile->getNumFilesFromZip()));
 * print_r(var_dump($zipFile->getStatusFromZip()));
 * print_r(var_dump($zipFile->getStatusSysFromZip()));
 * print_r(var_dump($zipFile->getFileNameFromZip()));
 * print_r(var_dump($zipFile->getCommentFromZip()));
 * print_r(var_dump($zipFile->getInfoItensFromZip()));
 * $arrResult = $zipFile->closeZip();
 */
class ZipFile
{

    use AttributeStaticTrait;

    const CONST_LANGUAGE = 'br';

    public static function getInstance()
    {
        return self::getAttributeStaticInstance(__CLASS__, 'zipFileSingleton');
    }

    private static function getInstanceArchive()
    {
        return self::getAttributeStaticInstance('ZipArchive', 'zipArchiveSingleton');
    }

    public function openZip($strPathZip = null, $intFlag = null)
    {
        if (empty($strPathZip))
            return array(null, 'Par&acirc;metro n&atilde;o informado!');
        $strFlag = (is_null($intFlag)) ? '' : ' , ' . $intFlag;
        eval('if ($intError = self::getInstanceArchive()->open($strPathZip' . $strFlag . ') !== true) return (array($intError, $this->getMessageError($intError, self::CONST_LANGUAGE)));');
        self::getInstance()->strPathZip = $strPathZip;
        return array(true, 'Opera&ccedil;&atilde;o realizada com sucesso!');
    }

    public function closeZip($booDownload = false, $booRemoveFile = false)
    {
        $booClose = self::getInstanceArchive()->close();
        if (($booClose === true) && ($booDownload === true)) {
            $strPathZip = str_replace('//', '/', self::getInstance()->strPathZip);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . end($arrExplode = explode('/', $strPathZip)) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($strPathZip));
            readfile($strPathZip);
            if ($booRemoveFile === true)
                unlink($strPathZip);
            exit();
        }
        self::setAttributeStatic('zipArchiveSingleton', null);
        return array($booClose, 'Opera&ccedil;&atilde;o realizada com ' . (($booClose === true) ? 'sucesso' : 'falha') . '!');
    }

    public function extractZipIntoFolder($strFolder = null, $booClearFolder = false)
    {
        if (empty($strFolder))
            return array(null, 'Par&acirc;metro n&atilde;o informado!');
        if ($booClearFolder)
            FileSystem::undir($strFolder);
        $booExtract = self::getInstanceArchive()->extractTo($strFolder);
        return array($booExtract, 'Opera&ccedil;&atilde;o realizada com ' . (($booExtract === true) ? 'sucesso' : 'falha') . '!');
    }

    public function createFolderIntoZip($strFolder = null)
    {
        if (empty($strFolder))
            return array(null, 'Par&acirc;metro n&atilde;o informado!');
        $booCreate = self::getInstanceArchive()->addEmptyDir($strFolder);
        return array($booCreate, 'Opera&ccedil;&atilde;o realizada com ' . (($booCreate === true) ? 'sucesso' : 'falha') . '!');
    }

    public function addFileIntoZip($strPathFile = null, $strFileNameIntoZip = null)
    {
        if (empty($strPathFile))
            return array(null, 'Par&acirc;metro n&atilde;o informado!');
        $booAdd = (is_file($strPathFile)) ? self::getInstanceArchive()->addFile($strPathFile, $strFileNameIntoZip) : false;
        return array($booAdd, 'Opera&ccedil;&atilde;o realizada com ' . (($booAdd === true) ? 'sucesso' : 'falha') . '!');
    }

    public function addContentIntoZip($strContent = null, $strFileNameIntoZip = null)
    {
        if ((empty($strContent)) || (empty($strFileNameIntoZip)))
            return array(null, 'Par&acirc;metros n&atilde;o informados!');
        $booAdd = self::getInstanceArchive()->addFromString($strFileNameIntoZip, $strContent);
        return array($booAdd, 'Opera&ccedil;&atilde;o realizada com ' . (($booAdd === true) ? 'sucesso' : 'falha') . '!');
    }

    public function addFolderIntoZip($strFolder = null)
    {
        if (empty($strFolder))
            return array(null, 'Par&acirc;metro n&atilde;o informado!');
        $arrOption = array('add_path' => end($arrExplode = explode('\\', $strFolder)) . '/', 'remove_all_path' => true);
        $mixAdd = self::getInstanceArchive()->addGlob($strFolder . '\\*', GLOB_BRACE, $arrOption);
        return array($mixAdd, 'Opera&ccedil;&atilde;o realizada com ' . ((($mixAdd === true) || (is_array($mixAdd))) ? 'sucesso' : 'falha') . '!');
    }

    public function getNumFilesFromZip()
    {
        return self::getInstanceArchive()->numFiles;
    }

    public function getStatusFromZip()
    {
        return self::getInstanceArchive()->status;
    }

    public function getStatusSysFromZip()
    {
        return self::getInstanceArchive()->statusSys;
    }

    public function getFileNameFromZip()
    {
        return self::getInstanceArchive()->filename;
    }

    public function getCommentFromZip()
    {
        return self::getInstanceArchive()->comment;
    }

    public function getInfoItensFromZip()
    {
        $arrInfoFiles = array();
        for ($intCount = 0; $intCount < $this->getNumFilesFromZip(); ++$intCount)
            $arrInfoFiles[$intCount] = $this->getInstanceArchive()->statIndex($intCount);
        return $arrInfoFiles;
    }

    private function getMessageMode($intMode = null, $strLanguage = 'br')
    {
        $strMessage = null;
        $strLanguage = strtolower($strLanguage);
        switch ($intMode) {
            case ZIPARCHIVE::CREATE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Cria o arquivo se ele n&atilde;o existir.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Create the archive if it does not exist.';
                    break;
                }
            case ZIPARCHIVE::OVERWRITE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Sempre inicia um novo arquivo, este modo sobreescrever&aacute; o arquivo se ele j&aacute; existir.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Always start a new archive, this mode will overwrite the file if it already exists.';
                    break;
                }
            case ZIPARCHIVE::EXCL: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Emite erro se o arquivo j&aacute; existir.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Error if archive already exists.';
                    break;
                }
            case ZIPARCHIVE::CHECKCONS: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Executa uma adicional verifica&ccedil;&atilde;o de consist&ecirc;ncia no arquivo, e emite erro se ele falhar.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Perform additional consistency checks on the archive, and error if they fail.';
                    break;
                }
        }
        return $strMessage;
    }

    private function getMessageFlag($intFlag = null, $strLanguage = 'br')
    {
        $strMessage = null;
        $strLanguage = strtolower($strLanguage);
        switch ($intFlag) {
            case ZIPARCHIVE::FL_NOCASE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Ignora mai&uacute;sculo e min&uacute;sculo no nome.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Ignore case on name lookup.';
                    break;
                }
            case ZIPARCHIVE::FL_NODIR: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Ignora componentes de diret&oacute;rio.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Ignore directory component.';
                    break;
                }
            case ZIPARCHIVE::FL_COMPRESSED: {
                    if ($strLanguage == 'br')
                        $strMessage = 'L&ecirc; a informa&ccedil;&atilde;o comprimida.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Read compressed data.';
                    break;
                }
            case ZIPARCHIVE::FL_UNCHANGED: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Usa os dados originais, ignorando mudan&ccedil;as.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Use original data, ignoring changes.';
                    break;
                }
        }
        return $strMessage;
    }

    private function getMessageOption($intOption = null, $strLanguage = 'br')
    {
        $strMessage = null;
        $strLanguage = strtolower($strLanguage);
        switch ($intOption) {
            case ZIPARCHIVE::CM_DEFAULT: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Melhor de esvaziar ou armazenar.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Better of deflate or store.';
                    break;
                }
            case ZIPARCHIVE::CM_STORE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Armazenado (n&atilde;o compresso).';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Stored (uncompressed).';
                    break;
                }
            case ZIPARCHIVE::CM_SHRINK: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Escolhido.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Shrunk.';
                    break;
                }
            case ZIPARCHIVE::CM_REDUCE_1: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Reduzido com o fator 1.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Reduced with factor 1.';
                    break;
                }
            case ZIPARCHIVE::CM_REDUCE_2: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Reduzido com o fator 2.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Reduced with factor 2.';
                    break;
                }
            case ZIPARCHIVE::CM_REDUCE_3: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Reduzido com o fator 3.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Reduced with factor 3.';
                    break;
                }
            case ZIPARCHIVE::CM_REDUCE_4: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Reduzido com o fator 4.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Reduced with factor 4.';
                    break;
                }
            case ZIPARCHIVE::CM_IMPLODE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Implodido.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Imploded.';
                    break;
                }
            case ZIPARCHIVE::CM_DEFLATE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Deflacionado.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Deflated.';
                    break;
                }
            case ZIPARCHIVE::CM_DEFLATE64: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Deflacionado64.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Deflate64.';
                    break;
                }
            case ZIPARCHIVE::CM_PKWARE_IMPLODE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'PKWARE implodindo.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'PKWARE imploding.';
                    break;
                }
//            case ZIPARCHIVE::CM_BZIP2: {
//                    if ($strLanguage == 'br')
//                        $strMessage = 'BZIP2 algoritmo.';
//                    elseif ($strLanguage == 'en')
//                        $strMessage = 'BZIP2 algorithm.';
//                    break;
//                }
        }
        return $strMessage;
    }

    private function getMessageError($intError = null, $strLanguage = 'br')
    {
        $strMessage = null;
        $strLanguage = strtolower($strLanguage);
        switch ($intError) {
            case ZIPARCHIVE::ER_OK: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Sem erro.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'No error.';
                    break;
                }
            case ZIPARCHIVE::ER_MULTIDISK: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Arquivos Multi-disk zip n&atilde;o suportados.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Multi-disk zip archives not supported.';
                    break;
                }
            case ZIPARCHIVE::ER_RENAME: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Falha na renomea&ccedil;&atilde;o do arquivo tempor&aacute;rio.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Renaming temporary file failed.';
                    break;
                }
            case ZIPARCHIVE::ER_CLOSE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Falha no fechamento do arquivo zip.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Closing zip archive failed.';
                    break;
                }
            case ZIPARCHIVE::ER_SEEK: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Procura o erro.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Seek error.';
                    break;
                }
            case ZIPARCHIVE::ER_READ: {
                    if ($strLanguage == 'br')
                        $strMessage = 'L&ecirc; o erro.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Read error.';
                    break;
                }
            case ZIPARCHIVE::ER_WRITE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Escreve o erro.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Write error.';
                    break;
                }
            case ZIPARCHIVE::ER_CRC: {
                    if ($strLanguage == 'br')
                        $strMessage = 'CRC error.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'CRC error.';
                    break;
                }
            case ZIPARCHIVE::ER_ZIPCLOSED: {
                    if ($strLanguage == 'br')
                        $strMessage = 'O conte&uacute;do do arquivo zip foi fechado.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Containing zip archive was closed.';
                    break;
                }
            case ZIPARCHIVE::ER_NOENT: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Arquivo n&atilde;o encontrado.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'No such file.';
                    break;
                }
            case ZIPARCHIVE::ER_EXISTS: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Arquivo j&aacute; existente.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'File already exists.';
                    break;
                }
            case ZIPARCHIVE::ER_OPEN: {
                    if ($strLanguage == 'br')
                        $strMessage = 'N&atilde;o foi poss&iacute;vel abrir o arquivo.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Can\'t open file.';
                    break;
                }
            case ZIPARCHIVE::ER_TMPOPEN: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Falha ao criar arquivo tempor&aacute;rio.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Failure to create temporary file.';
                    break;
                }
            case ZIPARCHIVE::ER_ZLIB: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Erro da Zlib.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Zlib error.';
                    break;
                }
            case ZIPARCHIVE::ER_MEMORY: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Falha na aloca&ccedil;&atilde;o de mem&oacute;ria.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Memory allocation failure.';
                    break;
                }
            case ZIPARCHIVE::ER_CHANGED: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Entrada foi modificada.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Entry has been changed.';
                    break;
                }
            case ZIPARCHIVE::ER_COMPNOTSUPP: {
                    if ($strLanguage == 'br')
                        $strMessage = 'M&eacute;todo de compress&atilde;o n&atilde;o suportado.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Compression method not supported.';
                    break;
                }
            case ZIPARCHIVE::ER_EOF: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Prematuro EOF.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Premature EOF.';
                    break;
                }
            case ZIPARCHIVE::ER_INVAL: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Argumento inv&aacute;lido.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Invalid argument.';
                    break;
                }
            case ZIPARCHIVE::ER_NOZIP: {
                    if ($strLanguage == 'br')
                        $strMessage = 'N&atilde;o &eacute; um arquivo zip.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Not a zip archive.';
                    break;
                }
            case ZIPARCHIVE::ER_INTERNAL: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Erro interno.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Internal error.';
                    break;
                }
            case ZIPARCHIVE::ER_INCONS: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Arquivo zip inconsistente.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Zip archive inconsistent.';
                    break;
                }
            case ZIPARCHIVE::ER_REMOVE: {
                    if ($strLanguage == 'br')
                        $strMessage = 'N&atilde;o foi poss&iacute;vel remove o arquivo.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Can\'t remove file.';
                    break;
                }
            case ZIPARCHIVE::ER_DELETED: {
                    if ($strLanguage == 'br')
                        $strMessage = 'Entrada foi deletada.';
                    elseif ($strLanguage == 'en')
                        $strMessage = 'Entry has been deleted.';
                    break;
                }
        }
        return $strMessage;
    }

}
