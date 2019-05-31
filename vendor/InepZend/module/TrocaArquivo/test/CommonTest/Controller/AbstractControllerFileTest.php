<?php
namespace InepZend\Module\TrocaArquivo\CommonTest\Controller;

use InepZend\UnitTest\AbstractCrudControllerUnitTest;
use InepZend\Http\RequestTrait;
use InepZend\Util\FileSystem;
use InepZend\Upload\UploadFile;
use DoctrineORMModule\Proxy\__CG__\Publicacao\Entity\Publicacao;

class AbstractControllerFileTest extends AbstractCrudControllerUnitTest
{
    use RequestTrait;

    const PATH_DIR = __DIR__;

    const PATH_UPLOAD_DEFINITIVE = self::PATH_DIR;

    const PATH_UPLOAD_TMP = self::PATH_UPLOAD_DEFINITIVE;

    const FILE_NAME = 'ENEM1510401_N02_AP_013_G190.TXT';

    const LIMIT = 1;

    public $layout = null;

    public function __construct($strController = null)
    {
        $this->setLogin('98993534187');
        $this->setPassword('*Guerreiro7');
        $strNameSpaceController = ($strController == null) ? __CLASS__ : $strController;
        parent::__construct($strNameSpaceController);
        $this->getLayout();
    }

    public function getFile()
    {
        return FileSystem::insertContentIntoFile(self::PATH_DIR . '/../../data/txtTests' . self::FILE_NAME, date('d-m-Y'));
    }

    public function getDateFileUpload()
    {
        return array(
            UploadFile::CONST_NOME => self::FILE_NAME,
            UploadFile::CONST_PARAM_FILE_ATTRIBUTE => self::FILE_NAME,
            UploadFile::CONST_PARAM_PATH_UPLOAD => self::PATH_UPLOAD_TMP,
            UploadFile::CONST_CAMINHO => self::PATH_UPLOAD_TMP,
            self::PATH_UPLOAD_TMP => self::PATH_UPLOAD_TMP,
            self::PATH_UPLOAD_DEFINITIVE => self::PATH_UPLOAD_TMP
        );
    }

    public function testAddAction()
    {
        return true;
    }

    public function testAddActionCanBeAccessed()
    {
        return true;
    }

    public function getLayout()
    {
        if ($this->layout == null)
            $this->layout = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy());
        return reset($this->layout);
    }
}
