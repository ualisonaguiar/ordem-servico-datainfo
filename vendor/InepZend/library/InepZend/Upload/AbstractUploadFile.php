<?php

namespace InepZend\Upload;

use InepZend\Util\DebugExec;
use InepZend\Util\String;
use InepZend\Util\PhpIni;

abstract class AbstractUploadFile
{

    use DebugExec;

    const DEBUG = false;
    const NAME = 'name';
    const TYPE = 'type';
    const TEMPORARY_NAME = 'tmp_name';
    const ERROR = 'error';
    const SIZE = 'size';
    const ERROR_MESSAGE = 'error_message';
    const EDITED_NAME = 'edited_name';
    const UPLOADED_PATH = 'uploaded_path';
    const KEY_FILE = 'arrFile';
    const KEY_ERROR = 'arrError';
    const KEY_FILE_INFO = 'arrFileInfo';
    const PARAM_FILE_ATTRIBUTE = 'strFileAttribute';
    const PARAM_PATH_UPLOAD = 'strPathToUpload';
    const PARAM_EXTENSION_PERMITED = 'arrExtensionPermited';
    const PARAM_OBRIGATORY = 'booObrigatory';
    const PARAM_BYTE_MAX_FILE_SIZE = 'intByteMaxFileSize';
    const PARAM_CLEAR_PATH_UPLOAD = 'booClearPathToUpload';
    const PARAM_WIDTH_IMG = 'intWidthImg';
    const PARAM_HEIGHT_IMG = 'intHeightImg';
    const PARAM_PROPORTION_IMG = 'booProportionImg';
    const PARAM_EXTRACT_ZIP = 'booExtractZipIntoFolder';
    const PARAM_EXTENSION_PERMITED_ZIP = 'arrExtensionPermitedZip';
    const PARAM_PREFIX_FILE_NAME = 'strPrefixFileName';
    const PARAM_SUFIX_FILE_NAME = 'strSufixFileName';
    const PARAM_NEW_FILE_NAME = 'strFileName';
    const PARAM_FILES = 'arrFile';
    const STATUS_OK = 'ok';
    const STATUS_ERROR = 'erro';
    const STATUS_FAIL = 'falha';
    const STATUS_VALIDATE = 'validacao';
    const STATUS_EMPTY = 'inexistencia';
    const CONST_NOME = self::NAME;
    const CONST_TIPO = self::TYPE;
    const CONST_NOME_TEMPORARIO = self::TEMPORARY_NAME;
    const CONST_ERRO = self::ERROR;
    const CONST_TAMANHO = self::SIZE;
    const CONST_ERRO_DESCRICAO = self::ERROR_MESSAGE;
    const CONST_NOME_EDITADO = self::EDITED_NAME;
    const CONST_CAMINHO = self::UPLOADED_PATH;
    const CONST_KEY_FILE = self::KEY_FILE;
    const CONST_KEY_ERROR = self::KEY_ERROR;
    const CONST_KEY_FILE_INFO = self::KEY_FILE_INFO;
    const CONST_PARAM_FILE_ATTRIBUTE = self::PARAM_FILE_ATTRIBUTE;
    const CONST_PARAM_PATH_UPLOAD = self::PARAM_PATH_UPLOAD;
    const CONST_PARAM_EXTENSION_PERMITED = self::PARAM_EXTENSION_PERMITED;
    const CONST_PARAM_OBRIGATORY = self::PARAM_OBRIGATORY;
    const CONST_PARAM_BYTE_MAX_FILE_SIZE = self::PARAM_BYTE_MAX_FILE_SIZE;
    const CONST_PARAM_CLEAR_PATH_UPLOAD = self::PARAM_CLEAR_PATH_UPLOAD;
    const CONST_PARAM_WIDTH_IMG = self::PARAM_WIDTH_IMG;
    const CONST_PARAM_HEIGHT_IMG = self::PARAM_HEIGHT_IMG;
    const CONST_PARAM_PROPORTION_IMG = self::PARAM_PROPORTION_IMG;
    const CONST_PARAM_EXTRACT_ZIP = self::PARAM_EXTRACT_ZIP;
    const CONST_PARAM_EXTENSION_PERMITED_ZIP = self::PARAM_EXTENSION_PERMITED_ZIP;
    const CONST_PARAM_PREFIX_FILE_NAME = self::PARAM_PREFIX_FILE_NAME;
    const CONST_PARAM_SUFIX_FILE_NAME = self::PARAM_SUFIX_FILE_NAME;
    const CONST_PARAM_NEW_FILE_NAME = self::PARAM_NEW_FILE_NAME;
    const CONST_PARAM_FILES = self::PARAM_FILES;

    private static $arrFile = array();
    private static $arrError = array();

    public function __construct($arrFile = null)
    {
        return $this->addFile($arrFile);
    }

    public function getName($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::NAME, $strFileAttribute);
    }

    public function getType($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::TYPE, $strFileAttribute);
    }

    public function getTemporaryName($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::TEMPORARY_NAME, $strFileAttribute);
    }

    public function getErrorUpload($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::ERROR, $strFileAttribute);
    }

    public function getSize($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::SIZE, $strFileAttribute);
    }

    public function getErrorUploadMessage($strFileAttribute = null, $booCheckIntoErrorUpload = true)
    {
        $mixErrorUploadMessage = $this->getFromFileInfo(self::ERROR_MESSAGE, $strFileAttribute);
        if (($booCheckIntoErrorUpload === false) || (is_bool($mixErrorUploadMessage)))
            return $mixErrorUploadMessage;
        $mixErrorUpload = $this->getErrorUpload($strFileAttribute);
        if (!is_array($mixErrorUploadMessage))
            return ((!empty($mixErrorUploadMessage)) ? $mixErrorUploadMessage : ((is_bool($mixErrorUpload)) ? false : $this->getErrorMessageTranslated($mixErrorUpload)));
        $mixErrorUploadMessageResult = array();
        foreach ($mixErrorUploadMessage as $intKeyFileAttribute => $strErrorUploadMessage) {
            if (!empty($strErrorUploadMessage))
                $mixErrorUploadMessageResult[$intKeyFileAttribute] = $strErrorUploadMessage;
            else
                $mixErrorUploadMessageResult[$intKeyFileAttribute] = (is_bool($mixErrorUpload[$intKeyFileAttribute])) ? false : $this->getErrorMessageTranslated($mixErrorUpload[$intKeyFileAttribute]);
        }
        return $mixErrorUploadMessageResult;
    }

    public function getEditedName($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::EDITED_NAME, $strFileAttribute);
    }

    public function getUploadedPath($strFileAttribute = null)
    {
        return $this->getFromFileInfo(self::UPLOADED_PATH, $strFileAttribute);
    }

    public function getFileInfo($strFileAttribute = null)
    {
        $arrFileInfo = $this->getFile($strFileAttribute);
        if ($arrFileInfo === false) {
            $this->addFile();
            $arrFileInfo = $this->getFile($strFileAttribute);
        }
        return $arrFileInfo;
    }

    public function addFile($arrFile = null)
    {
        $this->debugExecFile($arrFile);
        if (empty($arrFile)) {
            $arrFile = $_FILES;
            $this->debugExecFile($arrFile);
            if (empty($arrFile))
                return false;
        }
        if (!is_array($arrFile)) {
            $arrFile = array($arrFile);
            $this->debugExecFile($arrFile);
        }
        $this->setAttribute(self::KEY_FILE, $arrFile);
        return true;
    }

    public function getFile($strFileAttribute = null)
    {
        $this->debugExecFile($strFileAttribute);
        $arrFile = $this->getAttribute(self::KEY_FILE);
        if (empty($arrFile))
            return false;
        if (empty($strFileAttribute)) {
            $this->debugExecFile($arrFile);
            return $arrFile;
        }
        if ((!isset($arrFile[$strFileAttribute])) || (empty($arrFile[$strFileAttribute])))
            return false;
        $this->debugExecFile($arrFile[$strFileAttribute]);
        return $arrFile[$strFileAttribute];
    }

    public function saveItemIntoFile($strFileAttribute = null, $strItemName = null, $mixItemValue = null, $intKeyFileAttribute = null)
    {
        $arrFile = $this->getFile();
        $this->debugExecFile(func_get_args());
        $this->debugExecFile($mixItemValue);
        if (($arrFile === false) || (empty($strFileAttribute)) || (empty($strItemName)))
            return false;
        $this->debugExecFile($intKeyFileAttribute);
        if (!is_numeric($intKeyFileAttribute))
            $arrFile[$strFileAttribute][$strItemName] = $mixItemValue;
        else
            $arrFile[$strFileAttribute][$strItemName][$intKeyFileAttribute] = $mixItemValue;
        $this->debugExecFile($arrFile);
        $this->addFile($arrFile, false);
        return true;
    }

    public function addError($strFileAttribute = null, $strError = null, $intKeyFileAttribute = null)
    {
        if ((empty($strFileAttribute)) || (empty($strError)))
            return false;
        $arrError = $this->getAttribute(self::KEY_ERROR);
        if (!is_numeric($intKeyFileAttribute)) {
            if (empty($arrError[$strFileAttribute]))
                $arrError[$strFileAttribute] = $strError;
            else {
                if (!is_array($arrError[$strFileAttribute]))
                    $arrError[$strFileAttribute] = array($arrError[$strFileAttribute]);
                if (!in_array($strError, $arrError[$strFileAttribute]))
                    $arrError[$strFileAttribute][] = $strError;
            }
        } else {
            if (empty($arrError[$strFileAttribute][$intKeyFileAttribute]))
                $arrError[$strFileAttribute][$intKeyFileAttribute] = $strError;
            else {
                if (!is_array($arrError[$strFileAttribute][$intKeyFileAttribute]))
                    $arrError[$strFileAttribute][$intKeyFileAttribute] = array($arrError[$strFileAttribute][$intKeyFileAttribute]);
                if (!in_array($strError, $arrError[$strFileAttribute][$intKeyFileAttribute]))
                    $arrError[$strFileAttribute][$intKeyFileAttribute][] = $strError;
            }
        }
        $this->debugExecFile($arrError);
        $this->setAttribute(self::KEY_ERROR, $arrError);
        $this->saveItemIntoFile($strFileAttribute, self::ERROR_MESSAGE, $arrError[$strFileAttribute], $intKeyFileAttribute);
        return true;
    }

    public function getError($strFileAttribute = null, $intKeyFileAttribute = null)
    {
        if (empty($strFileAttribute))
            return false;
        $arrError = $this->getAttribute(self::KEY_ERROR);
        return (!is_numeric($intKeyFileAttribute)) ? $arrError[$strFileAttribute] : $arrError[$strFileAttribute][$intKeyFileAttribute];
    }

    public function getErrorMessage($strFileAttribute = null, $intKeyFileAttribute = null)
    {
        if (empty($strFileAttribute))
            return false;
        $arrFileInfo = $this->getFile($strFileAttribute);
        if ($arrFileInfo === false)
            return false;
        return $this->getErrorMessageTranslated((!is_numeric($intKeyFileAttribute)) ? (integer) $arrFileInfo[self::ERROR] : (integer) $arrFileInfo[self::ERROR][$intKeyFileAttribute]);
    }

    public function getAttribute($strAttribute = null)
    {
        return (empty($strAttribute)) ? null : self::$$strAttribute;
    }

    public function setAttribute($strAttribute = null, $mixValue = null)
    {
        if (empty($strAttribute))
            return;
        self::$$strAttribute = $mixValue;
        return $this;
    }

    protected function clearFileInfo(&$arrFileInfo = array())
    {
        if (!is_array($arrFileInfo[self::SIZE]))
            return false;
        $arrKeyFileAttributeClear = array();
        foreach ($arrFileInfo[self::SIZE] as $intKeyFileAttribute => $intByteFileSize)
            if ($intByteFileSize == 0)
                $arrKeyFileAttributeClear[] = $intKeyFileAttribute;
        $arrUnset = array(self::NAME, self::TYPE, self::TEMPORARY_NAME, self::ERROR, self::SIZE, self::ERROR_MESSAGE, self::EDITED_NAME, self::UPLOADED_PATH);
        foreach ($arrKeyFileAttributeClear as $intKeyFileAttributeClear)
            foreach ($arrUnset as $strUnset)
                if (isset($arrFileInfo[$strUnset][$intKeyFileAttributeClear]))
                    unset($arrFileInfo[$strUnset][$intKeyFileAttributeClear]);
        return true;
    }

    protected function insertPrefixSufixIntoFileName(&$strFileName, &$strFileFullName, $strPrefixFileName = null, $strSufixFileName = null)
    {
        $this->debugExecFile($strPrefixFileName);
        $this->debugExecFile($strSufixFileName);
        if ((!empty($strPrefixFileName)) || (!empty($strSufixFileName))) {
            $arrFileName = explode('.', $strFileName);
            $strFileNameWithoutExtension = '';
            $strExtension = '';
            if (count($arrFileName) == 1)
                $strFileNameWithoutExtension = end($arrFileName);
            else {
                $arrFileNameCopy = $arrFileName;
                unset($arrFileNameCopy[count($arrFileNameCopy) - 1]);
                $strFileNameWithoutExtension = implode('.', $arrFileNameCopy);
                $strExtension = end($arrFileName);
            }
            $this->debugExecFile($strFileNameWithoutExtension);
            $this->debugExecFile($strExtension);
            $strFileNameNew = '';
            if (!empty($strPrefixFileName))
                $strFileNameNew .= $strPrefixFileName;
            $strFileNameNew .= $strFileNameWithoutExtension;
            if (!empty($strSufixFileName))
                $strFileNameNew .= $strSufixFileName;
            if (!empty($strExtension))
                $strFileNameNew .= '.' . $strExtension;
            $this->debugExecFile($strFileNameNew);
            $strFileFullName = str_replace($strFileName, $strFileNameNew, $strFileFullName);
            $this->debugExecFile($strFileFullName);
            $strFileName = $strFileNameNew;
        }
    }

    protected function renameFile($strFileName = '')
    {
        return String::clearText(String::clearWord(str_replace(array(' ', ':', '....', '...', '..'), array('_', '', '.', '.', '.'), $strFileName), false), ',;<>?][}{|*+="\'!@#$%&*()´`^~³°ªº§¬£¢', false);
    }

    private function getFromFileInfo($strKeyFileInfo = null, $strFileAttribute = null)
    {
        if (empty($strKeyFileInfo))
            return false;
        $arrFileInfo = $this->getFileInfo($strFileAttribute);
        if (!is_array($arrFileInfo))
            return false;
        if (!empty($strFileAttribute))
            return @$arrFileInfo[$strKeyFileInfo];
        $arrResult = array();
        foreach ($arrFileInfo as $arrFileInfoIntern) {
            if (!array_key_exists($strKeyFileInfo, $arrFileInfoIntern))
                $arrResult[] = null;
            elseif (!is_array($arrFileInfoIntern[$strKeyFileInfo]))
                $arrResult[] = $arrFileInfoIntern[$strKeyFileInfo];
            else
                foreach ($arrFileInfoIntern[$strKeyFileInfo] as $strFileInfo)
                    $arrResult[] = $strFileInfo;
        }
        return (count($arrResult) == 1) ? reset($arrResult) : $arrResult;
    }

    private function getErrorMessageTranslated($intError = null)
    {
        switch ($intError) {
            case UPLOAD_ERR_OK:
                $strErrorMessage = 'N&atilde;o houve erro, o upload foi bem sucedido.';
                break;
            case UPLOAD_ERR_INI_SIZE:
                $strErrorMessage = 'O arquivo enviado para upload &eacute; maior do que o limite definido (' . PhpIni::getUploadMaxFilesize() . 'MB(s)).';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $strErrorMessage = 'Os dados enviados ultrapassa o limite de tamanho especificado para o formul&aacute;rio (' . PhpIni::getPostMaxSize() . 'MB(s)).';
                break;
            case UPLOAD_ERR_PARTIAL:
                $strErrorMessage = 'O upload do arquivo foi realizado parcialmente.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $strErrorMessage = 'N&atilde;o foi encontrado algum arquivo a ser realizado o upload.';
                break;
            default:
                $strErrorMessage = 'Erro de upload desconhecido.';
                break;
        }
        return $strErrorMessage;
    }

}
