<?php

namespace InepZend\Upload;

use InepZend\Upload\UploadFile;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

trait FileUnitTestTrait
{
    private static $booContainerPath = false;
    
    public function createParamToUpload($arrParamMerge = null)
    {
        $arrParam = array();
        $arrParam[UploadFile::PARAM_FILE_ATTRIBUTE] = 'ds_file_test';
        $arrParam[UploadFile::PARAM_PATH_UPLOAD] = $this->getPath() . 'move';
        $arrParam[UploadFile::PARAM_EXTENSION_PERMITED] = array('jpg', 'png', 'txt');
        $arrParam[UploadFile::PARAM_OBRIGATORY] = true;
        $arrParam[UploadFile::PARAM_BYTE_MAX_FILE_SIZE] = null;
        $arrParam[UploadFile::PARAM_CLEAR_PATH_UPLOAD] = false;
        $arrParam[UploadFile::PARAM_WIDTH_IMG] = null;
        $arrParam[UploadFile::PARAM_HEIGHT_IMG] = null;
        $arrParam[UploadFile::PARAM_PROPORTION_IMG] = true;
        $arrParam[UploadFile::PARAM_EXTRACT_ZIP] = false;
        $arrParam[UploadFile::PARAM_EXTENSION_PERMITED_ZIP] = array();
        $arrParam[UploadFile::PARAM_PREFIX_FILE_NAME] = time();
        $arrParam[UploadFile::PARAM_SUFIX_FILE_NAME] = null;
        $arrParam[UploadFile::PARAM_NEW_FILE_NAME] = null;
        $arrParam[UploadFile::PARAM_FILES] = $this->createFile();
        if (is_array($arrParamMerge))
            $arrParam = array_merge($arrParam, $arrParamMerge);
        return $arrParam;
    }

    public function createFile()
    {
        $strPathFile = $this->getPath() . 'UploadFile.txt';
        FileSystem::insertContentIntoFile($strPathFile, __CLASS__ . '-' . date('YmdHis'));
        $_FILES = array(
            'ds_file_test' => array(
                'name' => 'UploadFile.txt',
                'type' => FileSystem::getMimeContentFromFile($strPathFile),
                'tmp_name' => $strPathFile,
                'error' => UPLOAD_ERR_OK,
                'size' => filesize($strPathFile),
            )
        );
        return $_FILES;
    }

    public function getPath()
    {
        $strContainerPath = Server::getBasePathApplication() . '/data/upload/';
        if (self::$booContainerPath === false) {
            $intMode = 0777;
            if (!is_dir($strContainerPath))
                mkdir($strContainerPath, $intMode, true);
            elseif (!FileSystem::isWritable($strContainerPath))
                chmod($strContainerPath, $intMode);
            self::$booContainerPath = true;
        }
        return $strContainerPath;
    }

    public function getInstance($strName = null, $arrOptions = null)
    {
        if ((is_null($strName)) && (is_null($arrOptions))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof UploadFile))
                self::setInstanceOf(new UploadFile());
        } else
            self::setInstanceOf(new UploadFile($strName, $arrOptions));
        return self::getInstanceOf();
    }

    public function callRealizarUpload($arrParamMerge = null, $booCreateParamToUpload = true, $booReturnStatus = true)
    {
        $arrResult = self::getInstanceOf()->realizarUpload(($booCreateParamToUpload) ? $this->createParamToUpload($arrParamMerge) : null);
        $strStatus = $arrResult[0];
//        $arrError = $arrResult[1];
//        $arrData = $arrResult[2];
        return ($booReturnStatus) ? $strStatus : $arrResult;
    }

    public function callUploadFile($arrParamMerge = null, $booCreateParamToUpload = true)
    {
        $arrParam = ($booCreateParamToUpload) ? $this->createParamToUpload($arrParamMerge) : null;
        $arrArgument = array();
        if (is_array($arrParam)) {
            unset($arrParam[UploadFile::PARAM_FILES]);
            foreach ($arrParam as $strKey => $mixParam)
                $arrArgument[] = '$arrParam["' . $strKey . '"]';
        }
        eval('$mixResult = self::getInstanceOf()->uploadFile(' . implode(', ', $arrArgument) . ');');
        return $mixResult;
    }    
}