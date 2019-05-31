<?php

namespace InepZend\Module\TrocaArquivo\Cliente\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Compression\ZipFile;
use InepZend\Dto\ResultDto;
use InepZend\Upload\UploadFile;
use InepZend\Paginator\Paginator;
use InepZend\Util\Date;
use InepZend\Util\FileSystem;
use InepZend\Util\String;

class Cliente extends AbstractServiceFileFlow
{

    const CONTROL_UPLOAD = 'upload.control';
    const CONTROL_VALIDATE = 'validate.control';
    const OUTPUT = 'output';

    /**
     * Metodo responsavel em realizar o upload do arquivo zip e iniciar as operacoes
     * para o preprocessamento.
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
        $intIdLayout = (is_array($arrData)) ? @$arrData['idLayout'] : 0;
        $this->debugExecFile($intIdLayout);
        if ((empty($intIdLayout)) || (!is_object($layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((integer) $intIdLayout))))
            return self::getResult(ResultDto::STATUS_ERROR, 'Layout inexistente/inválido.');
        $this->debugExecFile($layout);
        unset($arrData['idLayout']);
        $arrParam = array(
            'path' => self::BASEPATH . self::UPLOAD,
            'permited' => array(
                'txt',
                'zip'
            ),
            'required' => true,
            'zip' => true,
            'zip_permited' => array(
                'txt',
                'xml'
            ),
            'prefix' => $intTime,
            'files' => $arrData
        );
        $this->debugExecFile($arrParam);
        $mixResult = $this->getService('InepZend\Module\Application\Service\Application')->uploadFile($arrParam);
        $this->debugExecFile($arrParam);
        $this->debugExecFile($mixResult);
        if ((is_array($mixResult)) && ((@$mixResult[0] == 'falha') || (!is_null(@$mixResult['status']))))
            return $mixResult;
        if (!is_array($mixResult))
            $mixResult = array(
                $mixResult
            );
        $arrCountType = array();
        foreach ($mixResult as $strPath) {
            $booXml = (stripos($strPath, '.xml') !== false);
            $strKey = ($booXml) ? 'xml' : 'txt';
            $arrCountType[$strKey] = (integer) @$arrCountType[$strKey] + 1;
            if (($arrCountType[$strKey] > 0) && ((integer) @$arrCountType[($booXml) ? 'txt' : 'xml'] > 0))
                return self::getResult(ResultDto::STATUS_ERROR, 'O arquivo compactado deve possuir exclusivamente arquivos TXT ou XML.');
            if ((integer) @$arrCountType['txt'] > 1)
                return self::getResult(ResultDto::STATUS_ERROR, 'O arquivo compactado deve possuir somente 1 arquivo TXT.');
        }
        $strNoArquivo = @$arrParam['info'][UploadFile::NAME];
        $this->debugExecFile($strNoArquivo);
        if ($booXml) {
            $this->createPath(self::CONTAINER);
            $strPath = str_replace($this->getNoArquivo(reset($mixResult)), '', str_replace('\\', '/', reset($mixResult)));
            $strPathZip = str_replace('/' . self::UPLOAD . '/', '/' . self::CONTAINER . '/' . $intTime, $strPath . $strNoArquivo);
            $this->debugExecFile($strPathZip);
            $zipFile = ZipFile::getInstance();
            $zipFile->openZip($strPathZip, 1);
        }
        foreach ($mixResult as $strPath) {
            $strPathOri = $strPath;
            if (($mixPosPathTime = strpos($strPathOri, $intTime)) === false)
                $strPath = str_replace('/' . self::UPLOAD . '/', '/' . self::UPLOAD . '/' . $intTime, str_replace('\\', '/', $strPathOri));
            if (!$booXml) {
                $this->debugExecFile($strPath);
                $booResult = ($mixPosPathTime === false) ? rename($strPathOri, $strPath) : true;
                $this->debugExecFile($booResult);
                if (!$booResult) {
                    if (is_file($strPathOri))
                        @unlink($strPathOri);
                    return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a inseração do prefixo nos arquivos descompactados.');
                }
                $this->runServiceRest('convertToXml', array(
                    $intIdLayout,
                    $strPath,
                    $strNoArquivo
                ));
                return true;
            }
            $zipFile->addFileIntoZip($strPathOri, end(explode('/', str_replace('\\', '/', $strPath))));
        }
        $zipFile->closeZip(false, false);
        if (!is_file($strPathZip))
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo ZIP: "' . $strPathZip . '".');
        foreach ($mixResult as $strPath)
            if (is_file($strPath))
                @unlink($strPath);
        $this->runServiceRest('validateStructureZip', array(
            $intIdLayout,
            $strPathZip
        ));
        return true;
    }

    /**
     * Metodo responsavel em realizar a convercao assincrona do arquivo txt para
     * xml.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPath            
     * @param string $strNoArquivo            
     * @return mix
     */
    protected function convertToXml($intIdLayout = null, $strPath = null, $strNoArquivo = null)
    {
        self::configPhpIni();
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $strBasepath = substr($strPath, 0, strrpos(str_replace('\\', '/', $strPath), '/')) . '/' . $this->getNoArquivo($strPath, true);
        $this->debugExecFile($strBasepath);
        if (is_dir($strBasepath))
            return true;
        $this->createPath($strBasepath, true);
        return $this->getConvertToXmlAsync($intIdLayout, $strPath, $strNoArquivo, $strBasepath);
    }

    /**
     * 
     * @param integer $intIdLayout
     * @param string $strPath
     * @param string $strNoArquivo
     * @param string $strBasepath
     * @return boolean
     */
    protected function getConvertToXmlAsync($intIdLayout, $strPath, $strNoArquivo, $strBasepath)
    {
        $intLineCount = FileSystem::getLineCountFromFile($strPath);
        $this->debugExecFile($intLineCount);
        if ($intLineCount > 1) {
            $intIntervalFlow = $this->getIntervalFlow('convert_xml');
            $this->debugExecFile($intIntervalFlow);
            $intXmlFile = ceil(($intLineCount - 1)/self::MAX_REGISTER_XML) - 1;
            $this->debugExecFile($intXmlFile);
            for ($intXml = 0; $intXml <= $intXmlFile; ++$intXml) {
                $arrParam = array($intIdLayout, $strPath, $strNoArquivo, $strBasepath, $intXml, $intXmlFile);
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
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPath            
     * @param string $strNoArquivo            
     * @param string $strBasepath            
     * @param integer $intXml            
     * @param integer $intXmlFile            
     * @return mix
     */
    protected function convertToXmlAsync($intIdLayout = null, $strPath = null, $strNoArquivo = null, $strBasepath = null, $intXml = null, $intXmlFile = null)
    {
        self::configPhpIni();
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout, $strPath);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $arrNode = $arrResult['result']['node'];
        $layout = $arrResult['result']['layout'];
        unset($arrResult);
        $arrRegister = explode($layout->getDsSeparadorLinha(), FileSystem::getContentFromFileChunk($strPath, self::MAX_REGISTER_XML, (($intXml * self::MAX_REGISTER_XML) + 1)));
        if (empty($arrRegister))
            return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo vazio: "' . $strPath . '".');
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
        if (!is_file($strPathXml))
            $mixResult = $this->createXmlConvert($strNoLayout, $strPathXml, $layout, $arrRegister, $arrNode, $strBasepath, $layout->getDsEncode());
        $this->runServiceRest('resultConvertToXml', array(
            $intIdLayout,
            $strPath,
            $strNoArquivo,
            $strBasepath,
            $intXml,
            $intXmlFile
        ));
        return $mixResult;
    }

    protected function createXmlConvert($strNoLayout, $strPathXml, $layout, $arrRegister, $arrNode, $strBasepath, $strDsEncode)
    {
        $booUtf8 = (stripos($strDsEncode, 'utf') !== false);
        $this->debugExecFile($booUtf8);
        $strXml = '<?xml version="1.0" encoding="' . $strDsEncode . '"?>' . "\n";
        $strXml .= '<registers xmlns="http://inepskeleton.local/xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://inepskeleton.local/xsd ' . $strNoLayout . '.xsd">' . "\n";
        $mixResult = FileSystem::insertContentIntoFile($strPathXml, $strXml);
        $this->debugExecFile($mixResult);
        if (!$mixResult)
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo convertido em XML: "' . $strPathXml . '".');
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
        return $mixResult;
    }

    /**
     * Metodo responsavel em realizar a verificacao dos resultados das convercoes
     * do arquivo txt para xml.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPath            
     * @param string $strNoArquivo            
     * @param string $strBasepath            
     * @param integer $intXml            
     * @param integer $intXmlFile            
     * @return mix
     */
    protected function resultConvertToXml($intIdLayout = null, $strPath = null, $strNoArquivo = null, $strBasepath = null, $intXml = null, $intXmlFile = null)
    {
        self::configPhpIni();
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $intXmlFinished = count(file($strBasepath . '/' . self::CONTROL_UPLOAD));
        $this->debugExecFile($intXmlFinished);
        if (((integer) $intXmlFile == (integer) $intXmlFinished) || ((integer) $intXmlFile === 0)) {
            $this->runServiceRest(self::CONTAINER, array(
                $intIdLayout,
                $strPath,
                $strNoArquivo,
                $strBasepath
            ));
        }
        return true;
    }

    /**
     * Metodo responsavel em realizar a insercao do arquivo zip (de arquivos xml)
     * no path do container e redirecionar para o container padrao.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPath            
     * @param string $strNoArquivo            
     * @param string $strBasepath            
     * @return mix
     */
    protected function container($intIdLayout = null, $strPath = null, $strNoArquivo = null, $strBasepath = null)
    {
        self::configPhpIni();
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $strDtAndamento = date('Y-m-d H:i:s');
        $this->createPath(self::CONTAINER);
        $strPathZip = str_ireplace(array(
            '\\',
            '.txt',
            '/' . self::UPLOAD . '/'
                ), array(
            '/',
            '.zip',
            '/' . self::CONTAINER . '/'
                ), $strPath);
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
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo ZIP: "' . $strPathZip . '".');
            if (!empty($strBasepath))
                FileSystem::undir($strBasepath);
        }
        if (is_file($strPath))
            @unlink($strPath);
        $this->runServiceRest('validateStructureZip', array(
            $intIdLayout,
            $strPathZip
        ));
        return true;
    }

    /**
     * Metodo responsavel em realizar a validacao estrutural assincrona de um arquivo
     * zip.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPathZip            
     * @return mix
     */
    protected function validateStructureZip($intIdLayout = null, $strPathZip = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $layout = $arrResult['result']['layout'];
        unset($arrResult);
        self::configPhpIni();
        $strBasepath = substr($strPathZip, 0, strrpos(str_replace('\\', '/', $strPathZip), '/')) . '/' . $this->getNoArquivo($strPathZip, true);
        $this->debugExecFile($strBasepath);
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip($strPathZip, 1);
        if (!is_dir($strBasepath)) {
            $arrResult = $zipFile->extractZipIntoFolder($strBasepath);
            $this->debugExecFile($arrResult);
            if ($arrResult[0] === false) {
                $zipFile->closeZip();
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a extração dos arquivos compactados em "' . $strPathZip . '" para "' . $strBasepath . '".');
            }
        }
        $arrZipFile = $zipFile->getInfoItensFromZip();
        $zipFile->closeZip();
        $this->debugExecFile($arrZipFile);
        $intXmlFile = count($arrZipFile);
        $intIntervalFlow = $this->getIntervalFlow('validate_structure');
        $this->debugExecFile($intIntervalFlow);
        foreach ($arrZipFile as $arrInfoXmlFile) {
            $this->debugExecFile($arrInfoXmlFile);
            $this->runServiceRest('validateStructureAsync', array(
                $intIdLayout,
                $strPathZip,
                $strBasepath,
                $arrInfoXmlFile['name'],
                $layout->toArray(),
                $intXmlFile
            ));
            if (!empty($intIntervalFlow))
                usleep($intIntervalFlow);
        }
        return true;
    }

    /**
     * Metodo responsavel em realizar a validacao estrutural de um unico arquivo
     * xml compactado em um arquivo zip.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPathZip            
     * @param string $strBasepath            
     * @param string $strNoArquivoXml            
     * @param array $arrLayout            
     * @param integer $intXmlFile            
     * @return mix
     */
    protected function validateStructureAsync($intIdLayout = null, $strPathZip = null, $strBasepath = null, $strNoArquivoXml = null, $arrLayout = null, $intXmlFile = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathXml = $strBasepath . '/' . $strNoArquivoXml;
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        self::configPhpIni();
        $mixResult = $this->validateStructure($strPathXml, @$arrLayout['ds_url']);
        $this->debugExecFile($mixResult);
        FileSystem::insertContentIntoFile($strBasepath . '/' . self::CONTROL_VALIDATE, $strPathXml . '::' . (($mixResult === true) ? 'true' : 'false') . "\n", 'a+');
        if (!is_bool($mixResult)) {
            if (is_array($mixResult))
                $mixResult = reset(array_chunk($mixResult, self::MAX_ERROR, true));
            $mixResult = self::getResult(ResultDto::STATUS_VALIDATE, null, $mixResult);
        }
        $this->runServiceRest('resultValidateStructure', array(
            $intIdLayout,
            $strPathZip,
            $strBasepath,
            $intXmlFile
        ));
        return $mixResult;
    }

    /**
     * Metodo responsavel em realizar a verificacao dos resultados das validacoes
     * estruturais dos arquivos xmls compactados em um arquivo zip e redirecionar
     * para o processamento.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPathZip            
     * @param string $strBasepath            
     * @param integer $intXmlFile            
     * @return mix
     */
    protected function resultValidateStructure($intIdLayout = null, $strPathZip = null, $strBasepath = null, $intXmlFile = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollectionLayout($intIdLayout);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        self::configPhpIni();
        $arrRow = file($strBasepath . '/' . self::CONTROL_VALIDATE);
        $intXmlFinished = count($arrRow);
        $this->debugExecFile($intXmlFinished);
        if ((integer) $intXmlFile == (integer) $intXmlFinished) {
            $this->debugExecFile($arrRow);
            $booValided = true;
            foreach ($arrRow as $strRow) {
                if (strpos($strRow, '::') === false)
                    continue;
                $strRow = trim(str_replace("\n", '', $strRow));
                $strResult = end(explode('::', $strRow));
                $this->debugExecFile($strResult);
                if ($strResult != 'true') {
                    $booValided = false;
                    break;
                }
            }
            $this->debugExecFile($booValided);
            if ($booValided)
                $this->runServiceRest('finish', array(
                    $intIdLayout,
                    $strPathZip,
                    $strBasepath
                ));
            else
                $this->moveFile($strPathZip);
        }
        return true;
    }

    /**
     * Metodo responsavel em concluir a operacao de preprocessamento.
     *
     * @rest true
     * @rest_auth false
     *
     * @param integer $intIdLayout            
     * @param string $strPathZip            
     * @param string $strBasepath            
     * @return mix
     */
    protected function finish($intIdLayout = null, $strPathZip = null, $strBasepath = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        if (!empty($strBasepath))
            FileSystem::undir($strBasepath);
        $strPathZipMove = str_replace('/' . self::CONTAINER . '/', '/' . self::OUTPUT . '/', $strPathZip);
        $this->debugExecFile($strPathZipMove);
        if ((is_file($strPathZip)) && (!is_file($strPathZipMove))) {
            $arrPathInfo = pathinfo($strPathZip);
            $strDsDestino = str_replace('/' . self::CONTAINER, '/' . self::OUTPUT, $arrPathInfo['dirname']);
            $this->debugExecFile($strDsDestino);
            $this->createPath($strDsDestino, true);
            $booResult = rename($strPathZip, $strPathZipMove);
            $this->debugExecFile($booResult);
            if (!$booResult)
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a movimentação do arquivo "' . $strPathZip . '" para o destino.');
        }
        return true;
    }

    public function findByPagedArquivo(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        if (!is_array($arrCriteria))
            $arrCriteria = array();
        if (!array_key_exists('ds_path', $arrCriteria))
            $arrCriteria['ds_path'] = self::OUTPUT;
        $arrArquivo = array();
        $strPathContainer = self::getBasepath() . $arrCriteria['ds_path'];
        $arrFile = FileSystem::scandirRecursive($strPathContainer, array(
                    'zip',
                    'txt'
        ));
        foreach ($arrFile as $strFile) {
            $strFlow = '';
            if (strpos($strFile, self::UPLOAD) !== false)
                $strFlow = '<font style="color: blue;">Dados em Envio e Preparação</font>';
            elseif (strpos($strFile, self::CONTAINER) !== false)
                $strFlow = '<font style="color: orange;">Dados em Preprocessamento</font>';
            elseif (strpos($strFile, self::FAILURE) !== false)
                $strFlow = '<font style="color: red;">Dados Inválidos</font>';
            else
                $strFlow = '<font style="color: green;">Dados Preprocessados e Padronizados</font>';
            $arrInfFile = (is_file($strFile)) ? stat($strFile) : array();
            $strNoFile = end(explode('/', str_replace('\\', '/', $strFile)));
            $strDsSize = (array_key_exists('size', $arrInfFile)) ? FileSystem::filesizeFormated(null, $arrInfFile['size']) : null;
            $strDtCreate = (array_key_exists('mtime', $arrInfFile)) ? date('d/m/Y H:i:s', $arrInfFile['mtime']) : null;
            $arrArquivo[$strNoFile] = array(
                'NO_FILE' => $strNoFile,
                'DS_PATH' => end(explode('../', str_replace('\\', '/', $strFile))),
                'DS_SIZE' => $strDsSize,
                'DT_CREATE' => $strDtCreate,
                'DS_FLOW' => $strFlow
            );
        }
        unset($arrFile);
        if (empty($strSortOrder))
            $strSortOrder = 'desc';
        if (strtolower($strSortOrder) == 'asc')
            ksort($arrArquivo);
        else
            krsort($arrArquivo);
        $arrArquivo = array_values($arrArquivo);
        return new Paginator($arrArquivo, $intPage, $intItemPerPage);
    }

}
