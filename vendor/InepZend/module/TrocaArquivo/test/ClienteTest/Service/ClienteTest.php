<?php

namespace InepZend\Module\TrocaArquivo\Cliente\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\FileSystem;
use InepZend\Compression\ZipFile;
use \ZipArchive;
use InepZend\Upload\FileUnitTestTrait;

class ClienteTest extends AbstractServiceUnitTest
{

    use FileUnitTestTrait;

    protected $strService = 'InepZend\Module\TrocaArquivo\Cliente\Service\Cliente';
    protected $strName = 'ENEM1510401_N02_AP_13_G190_199';

    const ID_Cliente_TESTE = 999;
    const MAX_RESULT = 6;
    const LIMIT = 1;

    protected function setUp()
    {
        parent::setUp();
        self::getServiceInstance()->createEntityManager();
    }

    /**
     * @test
     */
    public function geInantaceOftCliente()
    {
//        $this->markTestSkipped();
        $this->assertInstanceOf($this->strService, self::getServiceInstance());
    }

    /**
     * @test
     */
    public function upload()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('TXT'), 1);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $this->assertTrue($this->getService($this->strService)->upload($arrData));
    }

    /**
     * @test
     */
    public function upload2()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('TXT'), 1);
        $arrData = array(
            'idLayout' => null,
            'noArquivo' => $arrInfoData[0][1],
        );
        $arrResult = $this->getService($this->strService)->upload($arrData);
        $this->assertSame('error', $arrResult['status']);
        $this->assertSame('Layout inexistente/inválido.', $arrResult['messages']);
    }

    /**
     * @test
     */
    public function upload3()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('PDF'), 10);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $arrResult = $this->getService($this->strService)->upload($arrData);
        $this->assertSame('falha', $arrResult[0]);
        $this->assertSame('O(s) arquivo(s) interno(s) do ZIP enviado para upload deve(m) possuir a(s) seguinte(s) extens&atilde;o(&otilde;es): TXT, XML', reset($arrResult[1]));
    }

    /**
     * @test
     */
    public function upload4()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('TXT', 'XML'), 5);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $arrResult = $this->getService($this->strService)->upload($arrData);
        $this->assertSame('error', $arrResult['status']);
        $this->assertSame('O arquivo compactado deve possuir exclusivamente arquivos TXT ou XML.', $arrResult['messages']);
    }    

    /**
     * @test
     */
    public function upload5()
    {
        $this->markTestSkipped('Verificar a regra de negocio');
        $arrInfoData = $this->listDataUpload(array('XML'), 5);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $arrResult = $this->getService($this->strService)->upload($arrData);
        $this->assertSame('error', $arrResult['status']);
        $this->assertSame('O arquivo compactado deve possuir somente 1 arquivo TXT.', $arrResult['messages']);
    }
    
    /**
     * @test
     */
    public function upload6()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('XML'), 5);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $this->assertTrue($this->getService($this->strService)->upload($arrData));
    }
    
    /**
     * @test
     * @depends upload6
     */
    public function convertToXml()
    {
//        $this->markTestSkipped();
        $arrInfoData = $this->listDataUpload(array('XML'), 5);
        $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
        $this->assertTrue($this->getService($this->strService)->convertToXml($arrInfoData[0][0], $arrFilesUpload[0], $this->strName));
    }

    /**
     * @test
     * @depends upload6
     */
    public function convertToXml2()
    {
//        $this->markTestSkipped();
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
        $strPathFile = substr($arrFilesUpload[0], strlen('data/TrocaArquivo/upload'));
        $arrResult = $this->getService($this->strService)->convertToXml((end($arrLayout)->getIdLayout() + 1), $strPathFile, $this->strName);
        $this->assertSame($arrResult['status'], 'error');
        $this->assertSame($arrResult['messages'], 'Layout inexistente/inválido.');
    }

    /**
     * @test
     * @depends convertToXml
     * 
     * @TODO os metodos getInfoCollectionLayout (nao retorna o conteudo) e getConvertToXmlAsync (alteracao de parametros) foram alterados e por isso este teste deve ser revisto
     */
//     public function getConvertToXmlAsync()
//     {
//         $arrInfoData = $this->listDataUpload(array('TXT'), 1);
//         $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
//         $arrResult = $this->getService($this->strService)->getInfoCollectionLayout($arrInfoData[0][0], $arrFilesUpload[0]);
//         $arrContent = $arrResult['result']['content'];
//         $strBasepath = substr($arrFilesUpload[0], 0, strrpos(str_replace('\\', '/', $arrFilesUpload[0]), '/')) . '/' . $this->getService($this->strService)->getNoArquivo($arrFilesUpload[0], true);
//         $booReturn = $this->getService($this->strService)->getConvertToXmlAsync($arrContent, $arrInfoData[0][0], $arrFilesUpload[0], $this->strName, $strBasepath);
//         $this->assertTrue($booReturn);
//     }
    
    /**
     * @test
     */
    public function convertToXmlAsync()
    {
//        $this->markTestSkipped();
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        $intIdLayout = (end($arrLayout)->getIdLayout() + 1);
        $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
        $strPath = $arrFilesUpload[0];
        $strNoArquivo = $this->strName;
        $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getService($this->strService)->getNoArquivo($strPath, true);
        $intXml = 1;
        $intXmlFile = 1;
        $arrResult = $this->getService($this->strService)->convertToXmlAsync($intIdLayout, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile);
        $this->assertSame($arrResult['status'], 'error');
        $this->assertSame($arrResult['messages'], 'Layout inexistente/inválido.');        
    }
    
    /**
     * @test
     */
    public function convertToXmlAsync2()
    {
//        $this->markTestSkipped();
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        $intIdLayout = end($arrLayout)->getIdLayout();
        $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
        $strPath = $arrFilesUpload[0];
        $strNoArquivo = $this->strName;
        $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getService($this->strService)->getNoArquivo($strPath, true);
        $intXml = 1;
        $intXmlFile = 1;
        $arrResult = $this->getService($this->strService)->convertToXmlAsync($intIdLayout, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile);
        $this->assertSame($arrResult['status'], 'error');
        $this->assertSame($arrResult['messages'], 'Arquivo vazio: "' . $strPath .'".');        
    }

    /**
     * @test
     */
    public function convertToXmlAsync3()
    {
        FileSystem::undir('data/TrocaArquivo/upload');
        $arrInfoData = $this->listDataUpload(array('TXT'), 1);
        $arrData = array(
            'idLayout' => $arrInfoData[0][0],
            'noArquivo' => $arrInfoData[0][1],
        );
        $this->assertTrue($this->getService($this->strService)->upload($arrData));
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        $intIdLayout = end($arrLayout)->getIdLayout();
        $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
        $strPath = $arrFilesUpload[0];
        $strNoArquivo = $this->strName;
        $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getService($this->strService)->getNoArquivo($strPath, true);
        $intXml = 0;
        $intXmlFile = 2;
        $booReturn = $this->getService($this->strService)->convertToXmlAsync($intIdLayout, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile);
        $this->assertTrue($booReturn);
    }
    
    /**
     * @test
     * @TODO os metodos getInfoCollectionLayout (nao retorna o conteudo) e createXmlConvert (alteracao de parametro) foram alterados e por isso este teste deve ser revisto
     */
//     public function createXmlConvert()
//     {
//         $layout = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy(array(), array(), self::LIMIT));
//         $strLayout = $layout->getNoLayout();
        
//         FileSystem::undir('data/TrocaArquivo/upload');
//         $arrInfoData = $this->listDataUpload(array('TXT'), 1);
//         $arrData = array(
//             'idLayout' => $arrInfoData[0][0],
//             'noArquivo' => $arrInfoData[0][1],
//         );
//         $this->assertTrue($this->getService($this->strService)->upload($arrData));
//         $arrFilesUpload = FileSystem::globRecursive('data/TrocaArquivo/upload');
//         $strPathXml = $arrFilesUpload[0];        
//         $strPath = $arrFilesUpload[0];
        
//         $arrResult = $this->getService($this->strService)->getInfoCollectionLayout($arrInfoData[0][0], $arrFilesUpload[0]);
//         $arrContent = $arrResult['result']['content'];
//         $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getService($this->strService)->getNoArquivo($strPath, true);
//         $this->getService($this->strService)->createXmlConvert(
//             $strLayout,
//             $strPathXml,
//             $layout,
//             $arrContent[2],
//             $arrResult['result']['node'],
//             $strBasepath
//         );
//         \InepZend\Util\Library::debug($strPathXml, 1);
//     }

    /**
     * 
     * @param type $arrExtension
     * @param type $intQtdFile
     * @return type
     */
    public function listDataUpload($arrExtension, $intQtdFile)
    {
        $strNameTemp = date('Ymd_His');
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy(array(), array(), self::LIMIT);
        if (!$arrLayout)
            $this->markTestIncomplete('Não existem layout cadastrado.');
        $this->createFile($this->strName, $strNameTemp, $arrExtension, $intQtdFile);
        $_FILES = array(
            'noArquivo' => array(
                'name' => $this->strName,
                'type' => 'application/zip',
                'tmp_name' => '/tmp/' . $strNameTemp,
                'error' => 0,
                'size' => filesize('/tmp/' . $strNameTemp)
            )
        );
        return array(
            array(
                $arrLayout[0]->getIdLayout(),
                array(
                    'name' => $this->strName,
                    'type' => 'application/zip',
                    'tmp_name' => '/tmp/' . $strNameTemp,
                    'error' => 0,
                    'size' => filesize('/tmp/' . $strNameTemp)
                )
            )
        );
    }

    protected function createFile($strNameFile, $strNameTemp, $arrExtension, $intQtdFile)
    {
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip(__DIR__ . '/' . $strNameFile . '.zip', ZipArchive::CREATE);
        $arrFileCreate = array();
        for ($intPosicao = 1; $intPosicao <= $intQtdFile; $intPosicao ++) {
            foreach ($arrExtension as $strExtension) {
                $strNameFileCreate = __DIR__ . '/' . $strNameFile . '_' . $intPosicao . '.' . $strExtension;
                FileSystem::insertContentIntoFile($strNameFileCreate, "\n\nArquitetura\n\nTeste\n\nTeste40");
                $arrFileCreate[] = $strNameFileCreate;
            }
        }
        foreach ($arrFileCreate as $intNumberFile => $strPath)
            $zipFile->addFileIntoZip($strPath, $strNameFile . '_' . ($intNumberFile + 1) . '.' . FileSystem::getExtensionFromFileName($strPath));
        $zipFile->closeZip();
        foreach ($arrFileCreate as $strPath)
            unlink($strPath);
        copy(__DIR__ . '/' . $strNameFile . '.zip', '/tmp/' . $strNameTemp);
        unlink(__DIR__ . '/' . $strNameFile . '.zip');
    }

}
