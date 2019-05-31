<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;
use InepZend\Compression\ZipFile;

class ArquivoTeste extends AbstractServiceFileFlow
{

    use AttributeStaticTrait;

    const FILE_XML_ADPATER = 'InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator\Adapter\AdapterFileXML';
    const PATH_GENERATOR_TEST = '/../../../../../../../data/TrocaArquivo/teste';

    protected $infoMassGenerator;

    public function __construct()
    {
        self::configPhpIni();
    }

    public static function getInstance($strNamespace = null)
    {
        if (empty($strNamespace))
            $strNamespace = self::FILE_XML_ADPATER;
        return self::getAttributeStaticInstance($strNamespace, 'instanceFile', $strNamespace);
    }

    /**
     * Metodo responsavel por realizar o download do arquivo gerado.
     * 
     * @param integer $intIdMassaTeste
     */
    protected function download($intIdMassaTeste = null)
    {
        $strPath = $this->compactarFile($intIdMassaTeste);
        $strNameFile = $this->getNameFile($intIdMassaTeste);
        FileSystem::downloadContent($strNameFile . '.zip', FileSystem::getContentFromFile($strPath), FileSystem::getMimeContentFromExtension($strPath));
    }

    /**
     * Metodo responsavel para encaminhar o arquivo para a funcionalidade envio 
     * de dado.
     * 
     * @param integer $intIdMassaTeste
     */
    protected function forwardFile($intIdMassaTeste = null)
    {
        $strNameFile = $this->getNameFile($intIdMassaTeste);
        $strPathZip = $this->compactarFile($intIdMassaTeste);
        $configureLayout = end($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy(array('id_layout' => (int) $this->infoMassGenerator->getIdLayout())));
        $intIdConfiguracao = $configureLayout->getIdConfiguracao();
        $mixArquivo = $this->saveArquivo(null, $intIdConfiguracao, $strPathZip, $strNameFile, $this->getIdentity()->usuarioSistema->id); # @TODO nao eh o id_usuario_sistema e sim o id_responsavel
        $this->debugExecFile($mixArquivo);
        if (is_object($mixArquivo)) {
            $intIdArquivo = $mixArquivo->getIdArquivo();
            $strNameFile .= '.' . $this->getInstance()->strExtension;
            $this->createPath(self::CONTAINER);
            # @TODO realizar a criacao paginada dos xmls e inserir em arquivo zip na pasta container (procedimento a ser realizado em momento anterior)
            // ja esta com o zip de varios xmls na pasta teste (colocar o nome da pasta para teste)
            copy($strPathZip, self::BASEPATH . self::CONTAINER . '/' . end(explode('/', $strPathZip)));
            $this->runServiceRest(self::CONTAINER, array($intIdConfiguracao, $strPathZip, $strNameFile, date('Y-m-d H:i:s'), $intIdArquivo), 'InepZend\Module\TrocaArquivo\Common\Service\FileFlow');
            return self::getResult();

//            $mixAndamento = $this->insertAndamento(null, self::UPLOAD, null, null, $intIdArquivo);
//            $this->debugExecFile($mixAndamento);
//            $strNameFile .= '.' . $this->getInstance()->strExtension;
//            $strPath = self::BASEPATH . self::CONTAINER . '/' . $strNameFile;
//            copy($strPath, $strPath);
//            $this->runServiceRest(self::CONTAINER, array($intIdConfiguracao, $strPath, $strNameFile, date('Y-m-d H:i:s'), $intIdArquivo), 'InepZend\Module\TrocaArquivo\Common\Service\FileFlow');
//            return self::getResult();
        }
        return $mixArquivo;
    }

    /**
     * Metodo responsavel por retornar o nome do arquivo gerado.
     * 
     * @param integer $intIdMassaTeste
     * @param boolean $booExtension
     * @return string
     */
    protected function getNameFile($intIdMassaTeste)
    {
        $strService = 'InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile';
        $massaTest = $this->getService($strService)->find($intIdMassaTeste);
        $this->infoMassGenerator = $massaTest;
        $strNameFile = $this->getService('InepZend\Module\TrocaArquivo\MassaTeste\Service\MassaTeste')->makeNameFile($massaTest);
        return $strNameFile . '_' . $intIdMassaTeste;
    }

    /**
     * Metodo responsavel por compactar o arquivo e retorna o caminho do arquivo compactado.
     * 
     * @param integer $intIdMassaTeste
     * @return string
     */
    protected function compactarFile($intIdMassaTeste)
    {
        $strBaseFileZip = Server::getReplacedBasePathApplication(self::PATH_GENERATOR_TEST . '/' . $this->getNameFile($intIdMassaTeste)) . '.zip';
        if (is_file($strBaseFileZip))
            return $strBaseFileZip;
        $strBasepath = Server::getReplacedBasePathApplication(self::PATH_GENERATOR_TEST . '/file_' . $intIdMassaTeste);
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip($strBaseFileZip, 1);
        $arrPathXml = (!empty($strBasepath)) ? FileSystem::globRecursive($strBasepath) : array();
        foreach ($arrPathXml as $strPathOri) {
            $strPath = str_replace('/' . self::UPLOAD . '/', '/' . self::UPLOAD . '/' . $intTime, str_replace('\\', '/', $strPathOri));
            $zipFile->addFileIntoZip($strPathOri, end(explode('/', str_replace('\\', '/', $strPath))));
        }
        $zipFile->closeZip(false, false);
        FileSystem::undir($strBasepath);
        return $strBaseFileZip;
    }

}
