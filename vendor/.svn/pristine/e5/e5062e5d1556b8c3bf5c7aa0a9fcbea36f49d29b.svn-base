<?php

namespace InepZend\Upload;

use InepZend\Upload\AbstractUploadFile;
use InepZend\Upload\UploadGD;
use InepZend\Compression\ZipFile;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

/**
 * @example
 * $arrParam = array();
 * $arrParam[UploadFile::PARAM_FILE_ATTRIBUTE] = 'ds_comprovante';
 * $arrParam[UploadFile::PARAM_PATH_UPLOAD] = 'data/teste';
 * $arrParam[UploadFile::PARAM_EXTENSION_PERMITED] = array('txt'); // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_OBRIGATORY] = true; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_BYTE_MAX_FILE_SIZE] = 100; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_CLEAR_PATH_UPLOAD] = false; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_WIDTH_IMG] = 100; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_HEIGHT_IMG] = 100; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_PROPORTION_IMG] = false; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_EXTRACT_ZIP] = true; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_EXTENSION_PERMITED_ZIP] = array('txt', 'pdf', 'xls'); // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_PREFIX_FILE_NAME] = time(); // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_SUFIX_FILE_NAME] = time() . '_final'; // Nao obrigatorio
 * $arrParam[UploadFile::PARAM_NEW_FILE_NAME] = 'oficio' . time(); // Nao obrigatorio
 * $uploadFile = new UploadFile();
 * $arrResult = $uploadFile->realizarUpload($arrParam);
 */
class UploadFile extends AbstractUploadFile
{

    use UploadGD;

    const FORCE_CHECK_MIME_CONTENT = true;

    private $arrInfoFileName = array();

    /**
     * 
     * @param array $arrParam
     * @return array
     */
    public function realizarUpload($arrParam = array())
    {
        $this->debugExecFile(__FUNCTION__);
        $strFileAttribute = @(!empty($arrParam[self::PARAM_FILE_ATTRIBUTE])) ? $arrParam[self::PARAM_FILE_ATTRIBUTE] : null;
        $arrFile = @(!empty($arrParam[self::PARAM_FILES])) ? $arrParam[self::PARAM_FILES] : null;
        $arrParam = $this->convertParamToUploadFile($arrParam);
        $strStatus = self::STATUS_OK;
        $arrData = array();
        $arrError = array();
        if (count((array) $arrFile) == 0) {
            $arrFileInfo = $this->getFileInfo();
            if ((!is_array($arrFileInfo)) || (empty($arrFileInfo))) {
                $strStatus = self::STATUS_EMPTY;
                $arrError[] = 'N&atilde;o foram encontradas as informa&ccedil;&otilde;es de upload!';
            }
        }
        if (($strStatus == self::STATUS_OK) && (empty($strFileAttribute))) {
            if (isset($arrFileInfo))
                $strFileAttribute = reset(array_keys($arrFileInfo));
            elseif (count((array) $arrFile) != 0)
                $strFileAttribute = reset(array_keys($arrFile));
            if (empty($strFileAttribute)) {
                $strStatus = self::STATUS_VALIDATE;
                $arrError[] = 'N&atilde;o foi parametrizado o atributo que deveria realizar o upload!';
            }
        }
        if ($strStatus == self::STATUS_OK) {
            $arrArgument = array();
            foreach ($arrParam as $intKey => $mixParam)
                $arrArgument[] = '$arrParam[' . $intKey . ']';
            eval('$mixResult = $this->uploadFile($strFileAttribute, ' . implode(', ', $arrArgument) . ');');
            if ($mixResult === false) {
                $strStatus = self::STATUS_FAIL;
                $arrError[] = $this->getError($strFileAttribute);
            } elseif (!is_bool($mixResult))
                $arrData[self::KEY_FILE_INFO] = $mixResult;
        }
        return array($strStatus, $arrError, $arrData);
    }

    public function uploadFile($strFileAttribute = null, $strPathToUpload = null, $arrExtensionPermited = array(), $booObrigatory = false, $intByteMaxFileSize = null, $booClearPathToUpload = false, $intWidthImg = null, $intHeightImg = null, $booProportionImg = true, $booExtractZipIntoFolder = false, $arrExtensionPermitedZip = array(), $strPrefixFileName = null, $strSufixFileName = null, $strNewFileName = null)
    {
        $this->debugExecFile(__FUNCTION__);
        $this->debugExecFile(func_get_args());
        if (!$this->checkFileAttribute($strFileAttribute))
            return false;
        if (!$this->checkPathToUpload($strFileAttribute, $strPathToUpload))
            return false;
        $arrFileInfo = $this->getFileInfo($strFileAttribute);
        if (!$this->checkFileInfo($strFileAttribute, $arrFileInfo))
            return false;
        if (!$this->checkError($strFileAttribute, $arrFileInfo, $booObrigatory))
            return false;
        if (!$this->checkSize($strFileAttribute, $arrFileInfo, $booObrigatory, $intByteMaxFileSize))
            return false;
        if (!$this->checkType($strFileAttribute, $arrFileInfo, $arrExtensionPermited))
            return false;
        if (!$this->checkTemporaryName($strFileAttribute, $arrFileInfo))
            return false;
        $strPathToUpload = $this->managePathToUpload($strPathToUpload, $booClearPathToUpload);
        if (!$this->moveUploadedFile($strFileAttribute, $arrFileInfo, $strPathToUpload, $strPrefixFileName, $strSufixFileName, $strNewFileName))
            return false;
        if (!$this->manageWidthHeightImg($strFileAttribute, $arrFileInfo, $strPathToUpload, $intWidthImg, $intHeightImg, $booProportionImg))
            return false;
        if (!$this->manageZip($strFileAttribute, $arrFileInfo, $strPathToUpload, $booExtractZipIntoFolder, $arrExtensionPermitedZip))
            return false;
        $this->manageFile($strFileAttribute, $arrFileInfo);
        return $this->getFile($strFileAttribute);
    }

    private function convertParamToUploadFile($arrParam = array())
    {
        return array(
            @(!empty($arrParam[self::PARAM_PATH_UPLOAD])) ? $arrParam[self::PARAM_PATH_UPLOAD] : null,
            @(!empty($arrParam[self::PARAM_EXTENSION_PERMITED])) ? $arrParam[self::PARAM_EXTENSION_PERMITED] : array(),
            @(is_bool($arrParam[self::PARAM_OBRIGATORY])) ? $arrParam[self::PARAM_OBRIGATORY] : false,
            @(!is_null($arrParam[self::PARAM_BYTE_MAX_FILE_SIZE])) ? $arrParam[self::PARAM_BYTE_MAX_FILE_SIZE] : null,
            @(is_bool($arrParam[self::PARAM_CLEAR_PATH_UPLOAD])) ? $arrParam[self::PARAM_CLEAR_PATH_UPLOAD] : false,
            @(!is_null($arrParam[self::PARAM_WIDTH_IMG])) ? $arrParam[self::PARAM_WIDTH_IMG] : null,
            @(!is_null($arrParam[self::PARAM_HEIGHT_IMG])) ? $arrParam[self::PARAM_HEIGHT_IMG] : null,
            @(is_bool($arrParam[self::PARAM_PROPORTION_IMG])) ? $arrParam[self::PARAM_PROPORTION_IMG] : true,
            @(is_bool($arrParam[self::PARAM_EXTRACT_ZIP])) ? $arrParam[self::PARAM_EXTRACT_ZIP] : false,
            @(!empty($arrParam[self::PARAM_EXTENSION_PERMITED_ZIP])) ? $arrParam[self::PARAM_EXTENSION_PERMITED_ZIP] : array(),
            @(!empty($arrParam[self::PARAM_PREFIX_FILE_NAME])) ? $arrParam[self::PARAM_PREFIX_FILE_NAME] : null,
            @(!empty($arrParam[self::PARAM_SUFIX_FILE_NAME])) ? $arrParam[self::PARAM_SUFIX_FILE_NAME] : null,
            @(!empty($arrParam[self::PARAM_NEW_FILE_NAME])) ? $arrParam[self::PARAM_NEW_FILE_NAME] : null,
        );
    }

    private function checkFileAttribute($strFileAttribute = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if (empty($strFileAttribute)) {
            $this->addError('(sem atributo)', 'N&atilde;o foi parametrizado o atributo que deveria realizar o upload!');
            return false;
        }
        return true;
    }

    private function checkPathToUpload($strFileAttribute = null, $strPathToUpload = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if (empty($strPathToUpload)) {
            $this->addError($strFileAttribute, 'N&atilde;o foi parametrizado o caminho que deveria armazenar o arquivo!');
            return false;
        }
        return true;
    }

    private function checkFileInfo($strFileAttribute = null, $arrFileInfo = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if ($arrFileInfo === false) {
            $this->addError($strFileAttribute, 'N&atilde;o foram encontradas as informa&ccedil;&otilde;es de upload!');
            return false;
        }
        return true;
    }

    private function checkError($strFileAttribute = null, $arrFileInfo = null, $booObrigatory = false)
    {
        $this->debugExecFile(__FUNCTION__);
        if (!is_array($arrFileInfoError = $arrFileInfo[self::ERROR]))
            $arrFileInfoError = array(null => $arrFileInfoError);
        $arrErrorPermited = array(UPLOAD_ERR_OK);
        if ($booObrigatory !== true)
            $arrErrorPermited[] = UPLOAD_ERR_NO_FILE;
        $booCheck = true;
        $this->debugExecFile($arrFileInfoError);
        foreach ($arrFileInfoError as $intKeyFileAttribute => $intError) {
            if (!in_array($intError, $arrErrorPermited)) {
                $this->addError($strFileAttribute, $this->getErrorMessage($strFileAttribute, $intKeyFileAttribute), $intKeyFileAttribute);
                $booCheck = false;
            }
        }
        return $booCheck;
    }

    private function checkSize($strFileAttribute = null, &$arrFileInfo = null, $booObrigatory = false, $intByteMaxFileSize = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if (!is_array($arrFileInfoSize = $arrFileInfo[self::SIZE]))
            $arrFileInfoSize = array(null => $arrFileInfoSize);
        $booAllEmpty = true;
        foreach ($arrFileInfoSize as $intKeyFileAttribute => $intByteFileSize) {
            if ($intByteFileSize != 0) {
                $booAllEmpty = false;
                break;
            }
        }
        if ($booAllEmpty) {
            if ($booObrigatory !== true)
                return true;
            $this->addError($strFileAttribute, 'O arquivo &eacute; menor do que o tamanho m&iacute;nimo permitido (1 byte)!');
            return false;
        }
        if (is_array($arrFileInfo[self::SIZE]))
            $this->clearFileInfo($arrFileInfo);
        $booCheck = true;
        $this->debugExecFile($arrFileInfoSize);
        foreach ($arrFileInfoSize as $intKeyFileAttribute => $intByteFileSize) {
            if ((!empty($intByteMaxFileSize)) && ($intByteFileSize > $intByteMaxFileSize)) {
                $this->addError($strFileAttribute, 'O arquivo enviado para upload &eacute; maior do que o limite definido (' . FileSystem::filesizeFormated(null, $intByteMaxFileSize, false) . ').', $intKeyFileAttribute);
                $booCheck = false;
            }
        }
        return $booCheck;
    }

    private function checkType($strFileAttribute = null, $arrFileInfo = null, $arrExtensionPermited = array())
    {
        $this->debugExecFile(__FUNCTION__);
        if ((is_array($arrExtensionPermited)) && (count($arrExtensionPermited) > 0)) {
            $this->debugExecFile($arrExtensionPermited);
            if (!is_array($arrFileInfoName = $arrFileInfo[self::NAME]))
                $arrFileInfoName = array(null => $arrFileInfoName);
            if (!is_array($arrFileInfoType = $arrFileInfo[self::TYPE]))
                $arrFileInfoType = array(null => $arrFileInfoType);
            if (!is_array($arrFileInfoTemporaryName = $arrFileInfo[self::TEMPORARY_NAME]))
                $arrFileInfoTemporaryName = array(null => $arrFileInfoTemporaryName);
            $arrValidate = array();
            $arrContentValidateFromMime = array('application/download', 'application/octet-stream', 'application/save');
            foreach ($arrExtensionPermited as $strExtensionPermited) {
                $arrMimeContentFromExtension = FileSystem::getMimeContentFromExtension($strExtensionPermited);
                foreach ($arrFileInfoType as $intKeyFileAttribute => $strType) {
                    $strFileInfoName = $arrFileInfoName[$intKeyFileAttribute];
                    if (strpos($strFileInfoName, '.') !== false) {
                        $strExtension = end(explode('.', $strFileInfoName));
                        if ((!in_array(strtolower($strExtension), $arrExtensionPermited)) && (!in_array(strtoupper($strExtension), $arrExtensionPermited)))
                            break (2);
                    }
                    if ((self::FORCE_CHECK_MIME_CONTENT === true) || (in_array(strtolower($strType), $arrContentValidateFromMime))) {
                        $strMimeContent = FileSystem::getMimeContentFromFile($arrFileInfoTemporaryName[$intKeyFileAttribute]);
                        $this->debugExecFile($strMimeContent);
                        if (!is_bool($strMimeContent))
                            $arrFileInfoType[$intKeyFileAttribute] = $strMimeContent;
                    }
                    if (in_array(strtolower($arrFileInfoType[$intKeyFileAttribute]), $arrMimeContentFromExtension))
                        $arrValidate[$intKeyFileAttribute] = true;
                    if (count($arrFileInfoType) == count($arrValidate))
                        break (2);
                }
            }
            $this->debugExecFile($arrFileInfoType);
            $this->debugExecFile($arrValidate);
            if (count($arrFileInfoType) != count($arrValidate)) {
                $this->debugExecFile($arrFileInfoType);
                foreach ($arrFileInfoType as $intKeyFileAttribute => $strType)
                    if (!array_key_exists($intKeyFileAttribute, $arrValidate))
                        $this->addError($strFileAttribute, 'O arquivo enviado para upload deve possuir a(s) seguinte(s) extens&atilde;o(&otilde;es): ' . strtoupper(implode(', ', $arrExtensionPermited)), $intKeyFileAttribute);
                return false;
            }
        }
        return true;
    }

    private function checkTemporaryName($strFileAttribute = null, $arrFileInfo = null)
    {
        $this->debugExecFile(__FUNCTION__);
        $booCheck = true;
        if (!Server::isPhpUnit()) {
            if (!is_array($arrFileInfoTemporaryName = $arrFileInfo[self::TEMPORARY_NAME]))
                $arrFileInfoTemporaryName = array(null => $arrFileInfoTemporaryName);
            $this->debugExecFile($arrFileInfoTemporaryName);
            foreach ($arrFileInfoTemporaryName as $intKeyFileAttribute => $strTemporaryName) {
                if (!is_uploaded_file($strTemporaryName)) {
                    $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de upload do arquivo n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                    $booCheck = false;
                }
            }
        }
        return $booCheck;
    }

    private function managePathToUpload($strPathToUpload = null, $booClearPathToUpload = false, $booDir = true)
    {
        $this->debugExecFile(__FUNCTION__);
        $strPathToUpload = str_replace(array('\\', '//'), '/', $strPathToUpload);
        if ($booDir) {
            if (!is_dir($strPathToUpload))
                mkdir($strPathToUpload, 0777, true);
            elseif ($booClearPathToUpload) {
                FileSystem::undir($strPathToUpload);
                mkdir($strPathToUpload, 0777);
            }
        }
        $this->debugExecFile($strPathToUpload);
        return $strPathToUpload;
    }

    private function moveUploadedFile($strFileAttribute = null, $arrFileInfo = null, $strPathToUpload = null, $strPrefixFileName = null, $strSufixFileName = null, $strNewFileName = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if (!is_array($arrFileInfoName = $arrFileInfo[self::NAME]))
            $arrFileInfoName = array(null => $arrFileInfoName);
        if (!is_array($arrFileInfoTemporaryName = $arrFileInfo[self::TEMPORARY_NAME]))
            $arrFileInfoTemporaryName = array(null => $arrFileInfoTemporaryName);
        $arrInfoFileName = array();
        $booCheck = true;
        $this->debugExecFile($arrFileInfoName);
        foreach ($arrFileInfoName as $intKeyFileAttribute => $strFinalName) {
            $strFileName = (!empty($strNewFileName)) ? $strNewFileName . '.' . end($arrExplode = explode('.', $strFinalName)) : $this->renameFile($strFinalName);
            $this->debugExecFile($strFileName);
            $strFileFullName = str_replace('//', '/', ($strPathToUpload . '/' . $strFileName));
            $this->debugExecFile($strFileFullName);
            if (empty($strNewFileName))
                $this->insertPrefixSufixIntoFileName($strFileName, $strFileFullName, $strPrefixFileName, $strSufixFileName);
            $arrInfoFileName[$intKeyFileAttribute] = array($strFileName, $strFileFullName);
            $this->debugExecFile($strFinalName);
            $this->debugExecFile($strFileFullName);
            $strFunction = (!Server::isPhpUnit()) ? 'move_uploaded_file' : 'rename';
            if (!$strFunction($arrFileInfoTemporaryName[$intKeyFileAttribute], $strFileFullName)) {
                $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de mover o arquivo do upload n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                $booCheck = false;
            }
        }
        if ($booCheck) {
            $this->debugExecFile($arrInfoFileName);
            $this->setInfoFileName($arrInfoFileName);
        }
        return $booCheck;
    }

    private function manageWidthHeightImg($strFileAttribute = null, $arrFileInfo = null, $strPathToUpload = null, $intWidthImg = null, $intHeightImg = null, $booProportionImg = true)
    {
        $this->debugExecFile(__FUNCTION__);
        $booCheck = true;
        if ((!empty($intWidthImg)) && (!empty($intHeightImg))) {
            if (!is_array($arrFileInfoName = $arrFileInfo[self::NAME]))
                $arrFileInfoName = array(null => $arrFileInfoName);
            $arrInfoFileName = $this->getInfoFileName();
            $this->debugExecFile($arrFileInfoName);
            foreach ($arrFileInfoName as $intKeyFileAttribute => $strFinalName) {
                $strFileName = $arrInfoFileName[$intKeyFileAttribute][0];
                $strFileFullName = $arrInfoFileName[$intKeyFileAttribute][1];
                $mixResult = $this->editImgFile($strPathToUpload, $strFileName, $intWidthImg, $intHeightImg, $booProportionImg);
                $this->debugExecFile($mixResult);
                if ($mixResult === false) {
                    if (is_file($strFileFullName))
                        unlink($strFileFullName);
                    $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de editar a imagem n&atilde;o foi realizada corretamente! ', $intKeyFileAttribute);
                    $booCheck = false;
                    continue;
                }
                $strFileFullName = str_replace($strFileName, $mixResult, $strFileFullName);
                $strFileName = $mixResult;
                $arrInfoFileName[$intKeyFileAttribute] = array($strFileName, $strFileFullName);
                $this->setInfoFileName($arrInfoFileName);
            }
        }
        return $booCheck;
    }

    private function manageZip($strFileAttribute = null, $arrFileInfo = null, $strPathToUpload = null, $booExtractZipIntoFolder = false, $arrExtensionPermitedZip = array())
    {
        $this->debugExecFile(__FUNCTION__);
        $arrCheck = array();
        if (($booExtractZipIntoFolder === true) || (count($arrExtensionPermitedZip) > 0)) {
            $arrInfoFileName = $this->getInfoFileName();
            $arrMimeContentFromExtension = FileSystem::getMimeContentFromExtension('zip');
            if (!is_array($arrFileInfoName = $arrFileInfo[self::NAME]))
                $arrFileInfoName = array(null => $arrFileInfoName);
            if (!is_array($arrFileInfoType = $arrFileInfo[self::TYPE]))
                $arrFileInfoType = array(null => $arrFileInfoType);
            $this->debugExecFile($arrFileInfoName);
            foreach ($arrFileInfoName as $intKeyFileAttribute => $strFinalName) {
                $strFileName = $arrInfoFileName[$intKeyFileAttribute][0];
                $strFileFullName = $arrInfoFileName[$intKeyFileAttribute][1];
                $this->debugExecFile($strFileFullName);
                if (in_array(strtolower($arrFileInfoType[$intKeyFileAttribute]), $arrMimeContentFromExtension)) {
                    $zipFile = ZipFile::getInstance();
                    $arrResult = $zipFile->openZip($strFileFullName);
                    if ($arrResult[0] === false) {
                        $zipFile->closeZip();
                        if (is_file($strFileFullName))
                            unlink($strFileFullName);
                        $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de abrir o arquivo ZIP n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                        $arrCheck[$intKeyFileAttribute] = false;
                        continue;
                    }
                    $arrZipFile = $zipFile->getInfoItensFromZip();
                    $this->debugExecFile($arrZipFile);
                    if ((is_array($arrExtensionPermitedZip)) && (count($arrExtensionPermitedZip) > 0)) {
                        $arrExtensionPermitedZip = explode('|', strtolower(implode('|', $arrExtensionPermitedZip)));
                        $this->debugExecFile($arrExtensionPermitedZip);
                        foreach ($arrZipFile as $arrInfoZipFile) {
                            $strExtensionZipFile = end($arrExplode = explode('.', $arrInfoZipFile['name']));
                            if (!in_array(strtolower($strExtensionZipFile), $arrExtensionPermitedZip)) {
                                $zipFile->closeZip();
                                if (is_file($strFileFullName))
                                    unlink($strFileFullName);
                                $this->addError($strFileAttribute, 'O(s) arquivo(s) interno(s) do ZIP enviado para upload deve(m) possuir a(s) seguinte(s) extens&atilde;o(&otilde;es): ' . strtoupper(implode(', ', $arrExtensionPermitedZip)), $intKeyFileAttribute);
                                $arrCheck[$intKeyFileAttribute] = false;
                                break;
                            }
                        }
                        if (@$arrCheck[$intKeyFileAttribute] === false)
                            continue;
                    }
                    if ($booExtractZipIntoFolder === true) {
                        $arrResult = $zipFile->extractZipIntoFolder($strPathToUpload);
                        if ($arrResult[0] === false) {
                            $zipFile->closeZip();
                            if (is_file($strFileFullName))
                                unlink($strFileFullName);
                            $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de descompactar o arquivo ZIP n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                            $arrCheck[$intKeyFileAttribute] = false;
                            continue;
                        }
                    }
                    $arrResult = $zipFile->closeZip();
                    if ($arrResult[0] === false) {
                        if (is_file($strFileFullName))
                            unlink($strFileFullName);
                        $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de fechar o arquivo ZIP n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                        $arrCheck[$intKeyFileAttribute] = false;
                        continue;
                    }
                    if ($booExtractZipIntoFolder === true) {
                        $arrFileName = array();
                        $arrFileFullName = array();
                        foreach ($arrZipFile as $arrInfoZipFile) {
                            $strZipFileName = $this->renameFile($arrInfoZipFile['name']);
                            $strZipFileFullName = str_replace('//', '/', ($strPathToUpload . '/' . $strZipFileName));
                            $this->debugExecFile($strZipFileName);
                            $this->debugExecFile($strZipFileFullName);
                            $booResult = rename(str_replace('//', '/', ($strPathToUpload . '/' . $arrInfoZipFile['name'])), $strZipFileFullName);
                            if ($booResult === false) {
                                if (is_file($strFileFullName))
                                    unlink($strFileFullName);
                                $this->addError($strFileAttribute, 'A opera&ccedil;&atilde;o de renomear um arquivo interno do ZIP n&atilde;o foi realizada corretamente!', $intKeyFileAttribute);
                                $arrCheck[$intKeyFileAttribute] = false;
                                break;
                            }
                            $arrFileName[] = $strZipFileName;
                            $arrFileFullName[] = $strZipFileFullName;
                        }
                        if (@$arrCheck[$intKeyFileAttribute] === false)
                            continue;
                        if (is_file($strFileFullName))
                            unlink($strFileFullName);
                        $strFileName = (count($arrFileName) == 1) ? $arrFileName[0] : $arrFileName;
                        $strFileFullName = (count($arrFileFullName) == 1) ? $arrFileFullName[0] : $arrFileFullName;
                        $arrInfoFileName[$intKeyFileAttribute] = array($strFileName, $strFileFullName);
                        $this->setInfoFileName($arrInfoFileName);
                    }
                }
            }
        }
        return (count($arrCheck) == 0);
    }

    private function manageFile($strFileAttribute = null, $arrFileInfo = null)
    {
        $this->debugExecFile(__FUNCTION__);
        if (!is_array($arrFileInfoName = $arrFileInfo[self::NAME]))
            $arrFileInfoName = array(null => $arrFileInfoName);
        $arrInfoFileName = $this->getInfoFileName();
        $this->debugExecFile($arrFileInfoName);
        $this->debugExecFile($arrInfoFileName);
        foreach ($arrFileInfoName as $intKeyFileAttribute => $strFinalName) {
            $strFileName = $arrInfoFileName[$intKeyFileAttribute][0];
            $strFileFullName = $arrInfoFileName[$intKeyFileAttribute][1];
            $this->saveItemIntoFile($strFileAttribute, self::EDITED_NAME, $strFileName, $intKeyFileAttribute);
            $this->saveItemIntoFile($strFileAttribute, self::UPLOADED_PATH, $strFileFullName, $intKeyFileAttribute);
        }
    }

    private function setInfoFileName($arrInfoFileName = array())
    {
        $this->arrInfoFileName = $arrInfoFileName;
        return $this;
    }

    private function getInfoFileName()
    {
        return $this->arrInfoFileName;
    }

}
