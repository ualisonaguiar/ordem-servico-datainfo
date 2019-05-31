<?php

namespace InepZend\Module\TrocaArquivo\EnvioDado\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Compression\ZipFile;
use InepZend\Dto\ResultDto;
use InepZend\Upload\UploadFile;
use InepZend\Util\Date;
use InepZend\Util\FileSystem;
use InepZend\Util\String;

class EnvioDado extends AbstractServiceFileFlow
{

    const CONTROL_UPLOAD = 'upload.control';

    /**
     * Metodo responsavel em realizar o upload do arquivo zip e iniciar as operacoes
     * para o andamento de container.
     * 
     * @param array $arrData
     * @return mix
     */
    protected function upload($arrData = null)
    {
        self::configPhpIni();
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $intTime = date('YmdHis');
        $intIdConfiguracao = (is_array($arrData)) ? @$arrData['idConfiguracao'] : 0;
        $this->debugExecFile($intIdConfiguracao);
        if ((empty($intIdConfiguracao)) || (!is_object($configuracao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->find((integer) $intIdConfiguracao))))
            return self::getResult(ResultDto::STATUS_ERROR, 'Configuração inexistente/inválida.');
        $this->debugExecFile($configuracao);
        $mixResult = $this->checkInterdependence($configuracao);
        $this->debugExecFile($mixResult);
        if (is_array($mixResult))
            return $mixResult;
        $arrResponsavel = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->getPersonalInfo(array('co_projeto' => $configuracao->getCoProjeto(), 'sg_uf' => $configuracao->getSgUf()));
        $this->debugExecFile($arrResponsavel);
        if (empty($arrResponsavel))
            return self::getResult(ResultDto::STATUS_ERROR, 'Inexistência de responsável pelo envio do arquivo.', null, null, $intIdConfiguracao);
        unset($arrData['idConfiguracao']);
        $arrParam = array(
            'path' => self::BASEPATH . self::UPLOAD,
            'permited' => array('zip'),
            'required' => true,
            'zip' => true,
            'zip_permited' => array('txt', 'xml'),
            'prefix' => $intTime,
            'files' => $arrData,
        );
        $this->debugExecFile($arrParam);
        $mixResult = $this->getService('InepZend\Module\Application\Service\Application')->uploadFile($arrParam);
        $this->debugExecFile($arrParam);
        $this->debugExecFile($mixResult);
        if ((is_array($mixResult)) && (!is_null(@$mixResult['status'])))
            return $mixResult;
        if (!is_array($mixResult))
            $mixResult = array($mixResult);
        $arrCountType = array();
        foreach ($mixResult as $strPath) {
            $booXml = (stripos($strPath, '.xml') !== false);
            $strKey = ($booXml) ? 'xml' : 'txt';
            $arrCountType[$strKey] = (integer) @$arrCountType[$strKey] + 1;
            if (($arrCountType[$strKey] > 0) && ((integer) @$arrCountType[($booXml) ? 'txt' : 'xml'] > 0))
                return self::getResult(ResultDto::STATUS_ERROR, 'O arquivo compactado deve possuir exclusivamente arquivos TXT ou XML.', null, null, $intIdConfiguracao);
            if ((integer) @$arrCountType['txt'] > 1)
                return self::getResult(ResultDto::STATUS_ERROR, 'O arquivo compactado deve possuir somente 1 arquivo TXT.', null, null, $intIdConfiguracao);
        }
        $strNoArquivo = @$arrParam['info'][UploadFile::NAME];
        $this->debugExecFile($strNoArquivo);
        $intIdArquivo = null;
        $mixArquivo = $this->saveArquivo(null, $intIdConfiguracao, $strNoArquivo, $strNoArquivo, $arrResponsavel[0]->getIdResponsavel());
        $this->debugExecFile($mixArquivo);
        if (is_object($mixArquivo)) {
            $intIdArquivo = $mixArquivo->getIdArquivo();
            $mixAndamento = $this->insertAndamento(null, self::UPLOAD, null, null, $intIdArquivo);
            $this->debugExecFile($mixAndamento);
        }
        if ($booXml) {
            $this->createPath(self::CONTAINER);
            $strPath = str_replace($this->getNoArquivo(reset($mixResult)), '', str_replace('\\', '/', reset($mixResult)));
            $strPathZip = str_replace('/' . self::UPLOAD . '/', '/' . self::CONTAINER . '/' . $intTime . $intIdArquivo, $strPath . $strNoArquivo);
            $this->debugExecFile($strPathZip);
            $zipFile = ZipFile::getInstance();
            $zipFile->openZip($strPathZip, 1);
        }
        foreach ($mixResult as $strPath) {
            $strPathOri = $strPath;
            $strPath = str_replace('/' . self::UPLOAD . '/', '/' . self::UPLOAD . '/' . $intTime . $intIdArquivo, str_replace('\\', '/', $strPathOri));
            if (!$booXml) {
                $this->debugExecFile($strPath);
                $strFunction = (self::REMOVE_PROCESS_FILE) ? 'rename' : 'copy';
                $booResult = $strFunction($strPathOri, $strPath);
                $this->debugExecFile($booResult);
                if (!$booResult) {
                    if ((self::REMOVE_PROCESS_FILE) && (is_file($strPathOri)))
                        @unlink($strPathOri);
                    return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a inserção do prefixo nos arquivos descompactados.', null, $intIdArquivo, $intIdConfiguracao);
                }
                $this->runServiceRest('convertToXml', array($intIdConfiguracao, $strPath, $strNoArquivo, $intIdArquivo));
                return true;
            }
            $zipFile->addFileIntoZip($strPathOri, end(explode('/', str_replace('\\', '/', $strPath))));
        }
        $zipFile->closeZip(false, false);
        if (!is_file($strPathZip))
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo ZIP: "' . $strPathZip . '".', null, $intIdArquivo, $intIdConfiguracao);
        foreach ($mixResult as $strPath)
            if ((self::REMOVE_PROCESS_FILE) && (is_file($strPath)))
                @unlink($strPath);
        $this->runServiceRest(self::CONTAINER, array($intIdConfiguracao, $strPathZip, $strNoArquivo, date('Y-m-d H:i:s'), $intIdArquivo), 'InepZend\Module\TrocaArquivo\Common\Service\FileFlow');
        return true;
    }

    /**
     * Metodo responsavel em realizar a convercao assincrona do arquivo txt para
     * xml.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param string $strNoArquivo
     * @param integer $intIdArquivo
     * @return mix
     * 
     * @rest true
     * @rest_resource 3cae0885ed114dd994228a8731a2ab4c
     * @rest_auth false
     */
    protected function convertToXml($intIdConfiguracao = null, $strPath = null, $strNoArquivo = null, $intIdArquivo = null)
    {
        self::configPhpIni($intIdArquivo);
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPath);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getNoArquivo($strPath, true);
        $this->debugExecFile($strBasepath);
        if (is_dir($strBasepath))
            return true;
        $this->createPath($strBasepath, true);
        $intLineCount = FileSystem::getLineCountFromFile($strPath);
        $this->debugExecFile($intLineCount);
        if ($intLineCount > 1) {
            $intIntervalFlow = $this->getIntervalFlow('convert_xml');
            $this->debugExecFile($intIntervalFlow);
            $intXmlFile = ceil(($intLineCount - 1)/self::MAX_REGISTER_XML) - 1;
            $this->debugExecFile($intXmlFile);
            for ($intXml = 0; $intXml <= $intXmlFile; ++$intXml) {
                $arrParam = array($intIdConfiguracao, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile, $intIdArquivo);
                $this->debugExecFile($arrParam);
                $this->runServiceRest('convertToXmlAsync', $arrParam);
                if (!empty($intIntervalFlow))
                    usleep($intIntervalFlow);
            }
        }
        return true;
    }

    /**
     * Metodo responsavel em realizar a convercao de parte do arquivo txt para xml.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param string $strNoArquivo
     * @param string $strBasepath
     * @param integer $intXml
     * @param integer $intXmlFile
     * @param integer $intIdArquivo
     * @return mix
     * 
     * @rest true
     * @rest_resource 422d6b01639dd2868e3c79c050cdb5f4
     * @rest_auth false
     */
    protected function convertToXmlAsync($intIdConfiguracao = null, $strPath = null, $strNoArquivo = null, $strBasepath = null, $intXml = null, $intXmlFile = null, $intIdArquivo = null)
    {
        self::configPhpIni($intIdArquivo);
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPath);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $layout = $arrResult['result']['layout'];
        $arrNode = explode($layout->getDsSeparadorColuna(), trim(FileSystem::getContentFromFileChunk($strPath)));
        unset($arrResult);
        $arrRegister = explode($layout->getDsSeparadorLinha(), FileSystem::getContentFromFileChunk($strPath, self::MAX_REGISTER_XML, (($intXml * self::MAX_REGISTER_XML) + 1)));
        if (empty($arrRegister))
            return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo vazio: "' . $strPath . '".', null, $intIdArquivo, $intIdConfiguracao);
        $strNoArquivoNotExtension = $this->getNoArquivo($strPath, true);
        $strNoLayout = $layout->getNoLayout();
        if (empty($strNoLayout)) {
            $arrInfo = explode('_', $strNoArquivoNotExtension);
            $strNoLayout = (is_null(@$arrInfo[1])) ? 'ndefault' : $arrInfo[1];
        }
        $strNoLayout = strtolower($strNoLayout);
        $this->debugExecFile($strNoLayout);
        $strPathXml = $strBasepath . '/' . $strNoArquivoNotExtension . '-' . $intXml . '.xml';
        $this->debugExecFile($strPathXml);
        if (!is_file($strPathXml)) {
            $booUtf8 = (stripos($layout->getDsEncode(), 'utf') !== false);
            $this->debugExecFile($booUtf8);
            $strXml = '<?xml version="1.0" encoding="' . $layout->getDsEncode() . '"?>' . "\n";
            $strXml .= '<registers xmlns="http://inepskeleton.local/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://inepskeleton.local/xsd ' . $strNoLayout . '.xsd">' . "\n";
            $mixResult = FileSystem::insertContentIntoFile($strPathXml, $strXml);
            $this->debugExecFile($mixResult);
            if (!$mixResult)
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo convertido em XML: "' . $strPathXml . '".', null, $intIdArquivo, $intIdConfiguracao);
            $this->startCount();
            $strXml = '';
            $arrColDate = array();
            $strRegister = null;
            foreach ($arrRegister as $intLine => $strLine) {
                $arrLine = explode($layout->getDsSeparadorColuna(), trim($strLine));
                if ((empty($arrLine)) || (count($arrNode) != count($arrLine)))
                    continue;
                $booUtf8Line = String::isUTF8($strLine);
                $strRegister = '<register>';
                foreach ($arrLine as $intCol => $mixCol) {
                    $mixValue = $mixCol;
                    if ((in_array($intCol, $arrColDate)) || ((strpos($mixCol, '/') !== false) && (Date::isDateTemplate($mixCol)))) {
                        $mixValue = Date::convertDate($mixCol);
                        $arrColDate[$intCol] = $intCol;
                    }
                    $strRegister .= '<' . $arrNode[$intCol] . '' . (((is_null($mixCol)) || ($mixCol == '')) ? ' xsi:nil="true"' : '') . '>' . ((!$booUtf8Line) ? utf8_encode($mixValue) : $mixValue) . '</' . $arrNode[$intCol] . '>';
                }
                $strRegister .= '</register>' . "\n";
                $strXml .= $strRegister;
                if (($intLine % 500) == 0) {
                    FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
                    $strXml = '';
                }
            }
            $strXml .= '</registers>';
            FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
            FileSystem::insertContentIntoFile($strBasepath . '/' . self::CONTROL_UPLOAD, $strPathXml . "\n", 'a+');
            if (empty($strRegister))
                @unlink($strPathXml);
            $this->debugExecFile($this->finishCount());
        }
        $this->runServiceRest('resultConvertToXml', array($intIdConfiguracao, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile, $intIdArquivo));
        return $mixResult;
    }

    /**
     * Metodo responsavel em realizar a verificacao dos resultados das convercoes 
     * do arquivo txt para xml.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param string $strNoArquivo
     * @param string $strBasepath
     * @param integer $intXml
     * @param integer $intXmlFile
     * @param integer $intIdArquivo
     * @return mix
     * 
     * @rest true
     * @rest_resource de988010c0dc721df32c84305b9c4441
     * @rest_auth false
     */
    protected function resultConvertToXml($intIdConfiguracao = null, $strPath = null, $strNoArquivo = null, $strBasepath = null, $intXml = null, $intXmlFile = null, $intIdArquivo = null)
    {
        self::configPhpIni($intIdArquivo);
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPath);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $intXmlFinished = count(file($strBasepath . '/' . self::CONTROL_UPLOAD));
        $this->debugExecFile($intXmlFinished);
        if (((integer) $intXmlFile == (integer) $intXmlFinished) || ((integer) $intXmlFile === 0))
            $this->runServiceRest(self::CONTAINER, array($intIdConfiguracao, $strPath, $strNoArquivo, $strBasepath, $intIdArquivo));
        return true;
    }

    /**
     * Metodo responsavel em realizar a insercao do arquivo zip (de arquivos xml)
     * no path do container e redirecionar para o container padrao.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param string $strNoArquivo
     * @param string $strBasepath
     * @param integer $intIdArquivo
     * @return mix
     * 
     * @rest true
     * @rest_resource 4862e46d2ef3318533c774abe9cf6910
     * @rest_auth false
     */
    protected function container($intIdConfiguracao = null, $strPath = null, $strNoArquivo = null, $strBasepath = null, $intIdArquivo = null)
    {
        self::configPhpIni($intIdArquivo);
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPath);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $strDtAndamento = date('Y-m-d H:i:s');
        $this->createPath(self::CONTAINER);
        $strPathZip = str_ireplace(array('\\', '.txt', '/' . self::UPLOAD . '/'), array('/', '.zip', '/' . self::CONTAINER . '/'), $strPath);
        $this->debugExecFile($strPathZip);
        if (!is_file($strPathZip)) {
            $zipFile = ZipFile::getInstance();
            $zipFile->openZip($strPathZip, 1);
            $arrPathXml = (!empty($strBasepath)) ? FileSystem::globRecursive($strBasepath) : array();
            $this->debugExecFile($arrPathXml);
            foreach ($arrPathXml as $strPathXml) {
                if (stripos($strPathXml, '.xml') === false)
                    continue;
                $zipFile->addFileIntoZip($strPathXml, end(explode('/', str_replace('\\', '/', $strPathXml))));
            }
            $zipFile->closeZip(false, false);
            if (!is_file($strPathZip))
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo ZIP: "' . $strPathZip . '".', null, $intIdArquivo, $intIdConfiguracao);
            if ((self::REMOVE_PROCESS_FILE) && (!empty($strBasepath)))
                FileSystem::undir($strBasepath);
        }
        if ((self::REMOVE_PROCESS_FILE) && (is_file($strPath)))
            @unlink($strPath);
        $this->runServiceRest(self::CONTAINER, array($intIdConfiguracao, $strPathZip, $strNoArquivo, $strDtAndamento, $intIdArquivo), 'InepZend\Module\TrocaArquivo\Common\Service\FileFlow');
        return true;
    }

}
