<?php

namespace InepZend\Upload;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Upload\UploadFile;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class UploadFileSpecificTest extends AbstractUnitTest
{

    const CONTAINER_PATH = '/data/upload/';
    const DESTINATION_PATH = 'move';
    const FILE_NAME = 'UploadFile.txt';
    const FILE_ATTRIBUTE = 'ds_file_test';

    private static $booContainerPath = false;

    protected function setUp()
    {
        parent::setUp();
        $this->createFile();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('InepZend\Upload\UploadFile', self::getInstanceOf());
    }

    public function testRealizarUpload()
    {
        $this->assertEquals(UploadFile::STATUS_OK, $this->callRealizarUpload());
    }

    public function testRealizarUpload2()
    {
        $this->assertEquals(UploadFile::STATUS_FAIL, $this->callRealizarUpload(array(UploadFile::PARAM_EXTENSION_PERMITED => array('jpg'))));
    }

    public function testRealizarUpload3()
    {
        $this->assertEquals(UploadFile::STATUS_OK, $this->callRealizarUpload(array(UploadFile::PARAM_EXTENSION_PERMITED => array('txt'))));
    }

    public function testRealizarUpload4()
    {
        $this->assertEquals(UploadFile::STATUS_FAIL, $this->callRealizarUpload(null, false));
    }

    /**
     * @depends testRealizarUpload
     */
    public function testRealizarUpload5()
    {
        $arrData = @$this->callRealizarUpload(null, true, false)[2];
        $this->assertFalse(is_file(@$arrData[UploadFile::KEY_FILE_INFO][UploadFile::TEMPORARY_NAME]));
        $this->assertTrue(is_file(@$arrData[UploadFile::KEY_FILE_INFO][UploadFile::UPLOADED_PATH]));
    }

    public function testUploadFile()
    {
        $this->assertNotFalse($this->callUploadFile());
    }

    public function testUploadFile2()
    {
        $this->assertFalse($this->callUploadFile(array(UploadFile::PARAM_EXTENSION_PERMITED => array('jpg'))));
    }

    public function testUploadFile3()
    {
        $this->assertNotFalse($this->callUploadFile(array(UploadFile::PARAM_EXTENSION_PERMITED => array('txt'))));
    }

    public function testUploadFile4()
    {
        $this->assertFalse($this->callUploadFile(null, false));
    }

    /**
     * @depends testUploadFile
     */
    public function testUploadFile5()
    {
        $arrData = $this->callUploadFile(null, true);
        $this->assertFalse(is_file(@$arrData[UploadFile::TEMPORARY_NAME]));
        $this->assertTrue(is_file(@$arrData[UploadFile::UPLOADED_PATH]));
    }

    private function createParamToUpload($arrParamMerge = null)
    {
        $arrParam = array();
        $arrParam[UploadFile::PARAM_FILE_ATTRIBUTE] = self::FILE_ATTRIBUTE;
        $arrParam[UploadFile::PARAM_PATH_UPLOAD] = $this->getPath() . self::DESTINATION_PATH;
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

    private function createFile()
    {
        $strPathFile = $this->getPath() . self::FILE_NAME;
        FileSystem::insertContentIntoFile($strPathFile, __CLASS__ . '-' . date('YmdHis'));
        $_FILES = array(
            self::FILE_ATTRIBUTE => array(
                'name' => self::FILE_NAME,
                'type' => FileSystem::getMimeContentFromFile($strPathFile),
                'tmp_name' => $strPathFile,
                'error' => UPLOAD_ERR_OK,
                'size' => filesize($strPathFile),
            )
        );
        return $_FILES;
    }

    private function getPath()
    {
        $strContainerPath = Server::getBasePathApplication() . self::CONTAINER_PATH;
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

    private function getInstance($strName = null, $arrOptions = null)
    {
        if ((is_null($strName)) && (is_null($arrOptions))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof UploadFile))
                self::setInstanceOf(new UploadFile());
        } else
            self::setInstanceOf(new UploadFile($strName, $arrOptions));
        return self::getInstanceOf();
    }

    private function callRealizarUpload($arrParamMerge = null, $booCreateParamToUpload = true, $booReturnStatus = true)
    {
        $arrResult = self::getInstanceOf()->realizarUpload(($booCreateParamToUpload) ? $this->createParamToUpload($arrParamMerge) : null);
        $strStatus = $arrResult[0];
//        $arrError = $arrResult[1];
//        $arrData = $arrResult[2];
        return ($booReturnStatus) ? $strStatus : $arrResult;
    }

    private function callUploadFile($arrParamMerge = null, $booCreateParamToUpload = true)
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
