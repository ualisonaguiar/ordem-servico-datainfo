<?php

namespace InepZend\Module\TrocaArquivo\Common\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Doctrine\DBAL\Logging\FileSQLLogger;
use InepZend\Dto\ResultDto;
use InepZend\Compression\ZipFile;
use InepZend\Util\FileSystem;
use InepZend\Util\Date;
use InepZend\Util\Sql;
use InepZend\Util\Server;
use InepZend\Util\Xml;
use InepZend\Util\ArrayCollection;
use \Exception as ExceptionNative;

class FileFlow extends AbstractServiceFileFlow
{
    
    const CONTROL_LOAD = 'load.control';

    /**
     * Metodo responsavel em realizar a insercao na base da entidade Arquivo equivalente
     * a um arquivo zip (de arquivos xml) e redirecionar para o pre-processamento.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @param string $strNoArquivo
     * @param string $strDtAndamento
     * @param integer $intIdArquivo
     * @return mix
     * 
     * @rest true
     * @rest_resource 70a4019ceb888e65a2759769abc9d7ca
     * @rest_auth false
     */
    protected function container($intIdConfiguracao = null, $strPathZip = null, $strNoArquivo = null, $strDtAndamento = null, $intIdArquivo = null)
    {
        self::configPhpIni($intIdArquivo);
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        if (empty($strDtAndamento))
            $strDtAndamento = date('Y-m-d H:i:s');
        $this->debugExecFile($strDtAndamento);
        $this->createPath(self::CONTAINER);
        $mixResult = $this->saveArquivo($intIdArquivo, $intIdConfiguracao, $strPathZip, $strNoArquivo);
        $this->debugExecFile($mixResult);
        if (is_array($mixResult))
            return $mixResult;
        return self::startFlow($intIdConfiguracao, $strPathZip, self::CONTAINER, self::PREPROCESS, null, $strDtAndamento);
    }

    /**
     * Metodo responsavel em realizar a iniciacao do pre-processamento (validacao
     * estrutural) de um arquivo zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @return mix
     * 
     * @rest true
     * @rest_resource 181f68659da2d6cba8c198a5e492a6fc
     * @rest_auth false
     */
    protected function preprocess($intIdConfiguracao = null, $strPathZip = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        return self::startFlow($intIdConfiguracao, $strPathZip, self::PREPROCESS, null, 'validateStructureZip', null, self::RUNNING);
    }

    /**
     * Metodo responsavel em realizar a validacao estrutural assincrona de um arquivo
     * zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @return mix
     */
    protected function validateStructureZip($intIdConfiguracao = null, $strPathZip = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip, false, true);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $layout = $arrResult['result']['layout'];
        $arquivo = $arrResult['result']['arquivo'];
        unset($arrResult);
        self::configPhpIni($arquivo->getIdArquivo());
        $strBasepath = substr($strPathZip, 0, strrpos(str_replace('\\', '/', $strPathZip), '/')) . '/' . $this->getNoArquivo($strPathZip, true);
        $this->debugExecFile($strBasepath);
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip($strPathZip, 1);
        if (!is_dir($strBasepath)) {
            $arrResult = $zipFile->extractZipIntoFolder($strBasepath);
            $this->debugExecFile($arrResult);
            if ($arrResult[0] === false) {
                $zipFile->closeZip();
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha na validação estrutural ao realizar a extração dos arquivos compactados em "' . $strPathZip . '" para "' . $strBasepath . '".', null, $arquivo->getIdArquivo(), $intIdConfiguracao);
            }
        }
        $arrZipFile = $zipFile->getInfoItensFromZip();
        $zipFile->closeZip();
        $this->debugExecFile($arrZipFile);
        $intXmlFile = count($arrZipFile);
        $intIntervalFlow = $this->getIntervalFlow('validate_structure');
        $this->debugExecFile($intIntervalFlow);
        $resultadoValidacaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile');
        foreach ($arrZipFile as $arrInfoXmlFile) {
            $this->debugExecFile($arrInfoXmlFile);
            $arrResultadoValidacao = $resultadoValidacaoFile->findBy(array('id_arquivo' => (integer) $arquivo->getIdArquivo(), 'tp_validacao' => 'estrutural', 'ds_caminho' => $strBasepath . '/' . $arrInfoXmlFile['name']));
            $this->debugExecFile($arrResultadoValidacao);
            $booExec = true;
            if (!empty($arrResultadoValidacao)) {
                $resultadoValidacao = end($arrResultadoValidacao);
                $strDtFim = $resultadoValidacao->getDtFim();
                if (!empty($strDtFim))
                    $booExec = false;
            }
            $this->debugExecFile($booExec);
            if ($booExec) {
                $this->runServiceRest('validateStructureAsync', array($intIdConfiguracao, $strBasepath, $arrInfoXmlFile['name'], $arquivo->toArray(), $layout->toArray(), $intXmlFile));
                if (!empty($intIntervalFlow))
                    usleep($intIntervalFlow);
            }
        }
        return true;
    }

    /**
     * Metodo responsavel em realizar a validacao estrutural de um unico arquivo
     * xml compactado em um arquivo zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param string $strNoArquivoXml
     * @param array $arrArquivo
     * @param array $arrLayout
     * @param integer $intXmlFile
     * @return mix
     * 
     * @rest true
     * @rest_resource 938e65c6c1cef25242b29d17b1ab072e
     * @rest_auth false
     */
    protected function validateStructureAsync($intIdConfiguracao = null, $strBasepath = null, $strNoArquivoXml = null, $arrArquivo = null, $arrLayout = null, $intXmlFile = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathXml = $strBasepath . '/' . $strNoArquivoXml;
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathXml);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        self::configPhpIni(@$arrArquivo['id_arquivo']);
        $resultadoValidacaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile');
        $intIdResultado = $resultadoValidacaoFile->nextVal($arrResultado = array('id_resultado' => null));
        $this->debugExecFile($intIdResultado);
        $resultado = $this->saveResultadoValidacao($intIdResultado, @$arrArquivo['id_arquivo'], $strPathXml);
        $this->debugExecFile($resultado);
        if (is_object($resultado))
            $arrResultado = $resultado->toArray();
        $mixResult = $this->validateStructure($strPathXml, @$arrLayout['ds_url']);
        $this->debugExecFile($mixResult);
        if (!is_bool($mixResult))
            $mixResult = self::getResult(ResultDto::STATUS_VALIDATE, null, $mixResult, @$arrArquivo['id_arquivo'], $intIdConfiguracao);
        if (is_file($strPathXml)) {
            $strDtInicio = @$arrResultado['dt_inicio'];
            if (empty($strDtInicio))
                $strDtInicio = date('Y-m-d H:i:s');
            $this->saveResultadoValidacao(@$arrResultado['id_resultado'], $arrArquivo['id_arquivo'], $strPathXml, Date::convertDate($strDtInicio, 'Y-m-d H:i:s'), date('Y-m-d H:i:s'), ((is_array($mixResult) ? self::FAILURE : self::COMPLETED)));
        }
        $this->runServiceRest('resultValidateStructure', array($intIdConfiguracao, $strBasepath, $arrArquivo, $intXmlFile));
        return $mixResult;
    }

    /**
     * Metodo responsavel em realizar a verificacao dos resultados das validacoes
     * estruturais dos arquivos xmls compactados em um arquivo zip e redirecionar
     * para o processamento.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param array $arrArquivo
     * @param integer $intXmlFile
     * @return mix
     * 
     * @rest true
     * @rest_resource 3cf96dbe62c788b5107fc4882a5671c0
     * @rest_auth false
     */
    protected function resultValidateStructure($intIdConfiguracao = null, $strBasepath = null, $arrArquivo = null, $intXmlFile = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathZip = (is_array($arrArquivo)) ? @$arrArquivo['ds_caminho'] : null;
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $intIdArquivo = (is_array($arrArquivo)) ? @$arrArquivo['id_arquivo'] : null;
        if ((is_null($intIdArquivo)) || (is_null($intXmlFile)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Parâmetros não informados adequadamente na validação estrutural.', null, $intIdArquivo, $intIdConfiguracao);
        self::configPhpIni($intIdArquivo);
        $arrResultadoValidacao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile')->findBy(array('id_arquivo' => (integer) $intIdArquivo, 'tp_validacao' => 'estrutural'));
        $this->debugExecFile(count($arrResultadoValidacao));
        $arrResultadoValidacaoFinished = array();
        foreach ($arrResultadoValidacao as $resultadoValidacao) {
            if (is_null($resultadoValidacao->getDtFim()))
                continue;
            $arrResultadoValidacaoFinished[$resultadoValidacao->getDsCaminho()] = $resultadoValidacao;
        }
        $intResultadoValidacao = count($arrResultadoValidacaoFinished);
        $this->debugExecFile($intResultadoValidacao);
        if ((integer) $intXmlFile == $intResultadoValidacao) {
            $booNotCompleted = false;
            foreach ($arrResultadoValidacaoFinished as $resultadoValidacao) {
                if ($resultadoValidacao->getNoStatus() != self::COMPLETED) {
                    $booNotCompleted = true;
                    break;
                }
            }
            $this->debugExecFile($booNotCompleted);
            $mixResult = $this->insertAndamento($strPathZip, self::getFlowStatus(self::PREPROCESS, (($booNotCompleted) ? self::FAILURE : self::COMPLETED)));
            $this->debugExecFile($mixResult);
            if (is_array($mixResult))
                return $mixResult;
            if (!$booNotCompleted)
                $this->runServiceRest(self::PROCESS, array($intIdConfiguracao, $strPathZip));
            else
                $this->moveFile($strPathZip);
        }
        return true;
    }

    /**
     * Metodo responsavel em realizar a iniciacao do processamento (validacao de
     * negocio via banco de dados) de um arquivo zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @return mix
     * 
     * @rest true
     * @rest_resource 764b40c3e359d551b85ca0748059be7e
     * @rest_auth false
     */
    protected function process($intIdConfiguracao = null, $strPathZip = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        return self::startFlow($intIdConfiguracao, $strPathZip, self::PROCESS, null, 'validateSemanticsZip', null, self::RUNNING);
    }

    /**
     * Metodo responsavel em realizar a validacao de negocio via banco de dados
     * de um arquivo zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @return mix
     */
    protected function validateSemanticsZip($intIdConfiguracao = null, $strPathZip = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip, false, true);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $layout = $arrResult['result']['layout'];
        $arquivo = $arrResult['result']['arquivo'];
        unset($arrResult);
        self::configPhpIni($arquivo->getIdArquivo());
        $strBasepath = substr($strPathZip, 0, strrpos(str_replace('\\', '/', $strPathZip), '/')) . '/' . $this->getNoArquivo($strPathZip, true);
        $this->debugExecFile($strBasepath);
        $zipFile = ZipFile::getInstance();
        $zipFile->openZip($strPathZip, 1);
        if (!is_dir($strBasepath)) {
            $arrResult = $zipFile->extractZipIntoFolder($strBasepath);
            $this->debugExecFile($arrResult);
            if ($arrResult[0] === false) {
                $zipFile->closeZip();
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha na validação semântica ao realizar a extração dos arquivos compactados em "' . $strPathZip . '" para "' . $strBasepath . '".', null, $arquivo->getIdArquivo(), $intIdConfiguracao);
            }
        }
        $arrZipFile = $zipFile->getInfoItensFromZip();
        $zipFile->closeZip();
        $this->debugExecFile($arrZipFile);
        $intXmlFile = count($arrZipFile);
        $intIntervalFlow = $this->getIntervalFlow('validate_semantics');
        $this->debugExecFile($intIntervalFlow);
        $resultadoValidacaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile');
        foreach ($arrZipFile as $arrInfoXmlFile) {
            $this->debugExecFile($arrInfoXmlFile);
            $arrResultadoValidacao = $resultadoValidacaoFile->findBy(array('id_arquivo' => (integer) $arquivo->getIdArquivo(), 'tp_validacao' => 'semântica', 'ds_caminho' => $strBasepath . '/' . $arrInfoXmlFile['name']));
            $this->debugExecFile($arrResultadoValidacao);
            $booExec = true;
            if (!empty($arrResultadoValidacao)) {
                $resultadoValidacao = end($arrResultadoValidacao);
                $strDtFim = $resultadoValidacao->getDtFim();
                if (!empty($strDtFim))
                    $booExec = false;
            }
            if ($booExec) {
                $this->runServiceRest('validateSemanticsAsync', array($intIdConfiguracao, $strBasepath, $arrInfoXmlFile['name'], $arquivo->toArray(), $layout->toArray(), $intXmlFile));
                if (!empty($intIntervalFlow))
                    usleep($intIntervalFlow);
            }
        }
        return true;
    }
    
    /**
     * Metodo responsavel em realizar a validacao semantica de um unico arquivo
     * xml compactado em um arquivo zip.
     *
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param string $strNoArquivoXml
     * @param array $arrArquivo
     * @param array $arrLayout
     * @param integer $intXmlFile
     * @return mix
     *
     * @rest true
     * @rest_resource 2ee336340b9208caf27e15ef389e6e36
     * @rest_auth false
     */
    protected function validateSemanticsAsync($intIdConfiguracao = null, $strBasepath = null, $strNoArquivoXml = null, $arrArquivo = null, $arrLayout = null, $intXmlFile = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathXml = $strBasepath . '/' . $strNoArquivoXml;
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathXml);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $configuracao = $arrResult['result']['configuracao'];
        unset($arrResult);
        self::configPhpIni(@$arrArquivo['id_arquivo']);
        $resultadoValidacaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile');
        $intIdResultado = $resultadoValidacaoFile->nextVal($arrResultado = array('id_resultado' => null));
        $this->debugExecFile($intIdResultado);
        $resultado = $this->saveResultadoValidacao($intIdResultado, @$arrArquivo['id_arquivo'], $strPathXml, null, null, null, 'semântica');
        $this->debugExecFile($resultado);
        if (is_object($resultado))
            $arrResultado = $resultado->toArray();
        $mixResult = $this->validateSemantics($strPathXml, @$arrLayout['id_layout'], @$arrLayout['no_layout'], $configuracao->getIdConfiguracao(), $configuracao->getCoProjeto(), $configuracao->getSgUf(), $configuracao->getInValidacaoImpeditiva(), @$arrArquivo['id_arquivo']);
        $this->debugExecFile($mixResult);
        if (!is_bool($mixResult)) {
            if (is_array($mixResult))
                $mixResult = reset(array_chunk($mixResult, self::MAX_ERROR, true));
            $mixResult = self::getResult(ResultDto::STATUS_VALIDATE, null, $mixResult, @$arrArquivo['id_arquivo'], $intIdConfiguracao);
        }
        if (is_file($strPathXml)) {
            $strDtInicio = @$arrResultado['dt_inicio'];
            if (empty($strDtInicio))
                $strDtInicio = date('Y-m-d H:i:s');
            $this->saveResultadoValidacao(@$arrResultado['id_resultado'], $arrArquivo['id_arquivo'], $strPathXml, Date::convertDate($strDtInicio, 'Y-m-d H:i:s'), date('Y-m-d H:i:s'), ((is_array($mixResult) ? self::FAILURE : self::COMPLETED)), 'semântica');
        }
        $this->runServiceRest('resultValidateSemantics', array($intIdConfiguracao, $strBasepath, $arrArquivo, $intXmlFile, $strPathXml));
        return $mixResult;
    }
    
    /**
     * Metodo responsavel em realizar a verificacao dos resultados das validacoes
     * semanticas dos arquivos xmls compactados em um arquivo zip e redirecionar
     * para a carga.
     *
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param array $arrArquivo
     * @param integer $intXmlFile
     * @param string $strPathXml
     * @return mix
     *
     * @rest true
     * @rest_resource c986a2f656e520e887370cc9fbaf69f2
     * @rest_auth false
     */
    protected function resultValidateSemantics($intIdConfiguracao = null, $strBasepath = null, $arrArquivo = null, $intXmlFile = null, $strPathXml = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathZip = (is_array($arrArquivo)) ? @$arrArquivo['ds_caminho'] : null;
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $configuracao = $arrResult['result']['configuracao'];
        unset($arrResult);
        $intIdArquivo = (is_array($arrArquivo)) ? @$arrArquivo['id_arquivo'] : null;
        if ((is_null($intIdArquivo)) || (is_null($intXmlFile)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Parâmetros não informados adequadamente na validação semântica.', null, $intIdArquivo, $intIdConfiguracao);
        self::configPhpIni($intIdArquivo);
        $arrResultadoValidacao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile')->findBy(array('id_arquivo' => (integer) $intIdArquivo, 'tp_validacao' => 'semântica'));
        $this->debugExecFile(count($arrResultadoValidacao));
        $arrResultadoValidacaoFinished = array();
        foreach ($arrResultadoValidacao as $resultadoValidacao) {
            if (is_null($resultadoValidacao->getDtFim()))
                continue;
            $arrResultadoValidacaoFinished[$resultadoValidacao->getDsCaminho()] = $resultadoValidacao;
        }
        $intResultadoValidacao = count($arrResultadoValidacaoFinished);
        $this->debugExecFile($intResultadoValidacao);
        if ((integer) $intXmlFile == $intResultadoValidacao) {
            $booNotCompleted = false;
            foreach ($arrResultadoValidacaoFinished as $resultadoValidacao) {
                if ($resultadoValidacao->getNoStatus() != self::COMPLETED) {
                    $booNotCompleted = true;
                    break;
                }
            }
            $arrPathXml = explode('-', $strPathXml);
            array_pop($arrPathXml);
            $strCacheAttribute = implode('-', $arrPathXml);
            $this->clearAttributeCache($strCacheAttribute);
            $mixResult = $this->insertAndamento($strPathZip, self::getFlowStatus(self::PROCESS, (($booNotCompleted) ? self::FAILURE : self::COMPLETED)));
            $this->debugExecFile($mixResult);
            if (is_array($mixResult))
                return $mixResult;
            if (($booNotCompleted) && ($configuracao->getInValidacaoImpeditiva() != 1)) {
                if (self::REMOVE_PROCESS_FILE)
                    @unlink($strPathZip);
                $this->createPath(self::FAILURE);
                $arrPartPathZip = array(self::COMPLETED, self::FAILURE);
                foreach ($arrPartPathZip as $strPartPathZip) {
                    $strPathZipIntern = ($strPartPathZip == self::FAILURE) ? str_replace('/' . self::CONTAINER . '/', '/' . $strPartPathZip . '/', str_replace('\\', '/', $strPathZip)) : $strPathZip;
                    $this->debugExecFile($strPathZipIntern);
                    $zipFile = ZipFile::getInstance();
                    $zipFile->openZip($strPathZipIntern, 1);
                    $arrPathXml = FileSystem::globRecursive($strBasepath . '/' . $strPartPathZip);
                    $this->debugExecFile($arrPathXml);
                    foreach ($arrPathXml as $strPathXml) {
                        if (stripos($strPathXml, '.xml') === false)
                            continue;
                        $zipFile->addFileIntoZip($strPathXml, end(explode('/', str_replace('\\', '/', $strPathXml))));
                    }
                    $zipFile->closeZip(false, false);
                    if (!is_file($strPathZipIntern))
                        return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo ZIP: "' . $strPathZipIntern . '".', null, $intIdArquivo, $intIdConfiguracao);
                }
                if (self::REMOVE_PROCESS_FILE)
                    FileSystem::undir($strBasepath);
                $this->runServiceRest(self::LOAD, array($intIdConfiguracao, $strPathZip, false));
            } else {
                if (self::REMOVE_PROCESS_FILE)
                    FileSystem::undir($strBasepath);
                if (!$booNotCompleted)
                    $this->runServiceRest(self::LOAD, array($intIdConfiguracao, $strPathZip));
                else
                    $this->moveFile($strPathZip);
            }
        }
        return true;
    }
    
    /**
     * Metodo responsavel em realizar a iniciacao da carga e movimento para um path
     * de destino de um arquivo zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @param boolean $booCheckIntegrity
     * @return mix
     * 
     * @rest true
     * @rest_resource 2e6c7515cede73c0a8edca77eff18f93
     * @rest_auth false
     */
    protected function load($intIdConfiguracao = null, $strPathZip = null, $booCheckIntegrity = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        return self::startFlow($intIdConfiguracao, $strPathZip, self::LOAD, null, 'loadDataBaseZip', null, self::RUNNING, (boolean) $booCheckIntegrity);
    }

    /**
     * Metodo responsavel em realizar o movimento um arquivo zip para um path de
     * destino definido na configuracao.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @param boolean $booSetUsuarioSistema
     * @return mix
     */
    protected function loadDataBaseZip($intIdConfiguracao = null, $strPathZip = null, $booSetUsuarioSistema = false)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip, false, true, false, true);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $configuracao = $arrResult['result']['configuracao'];
        $layout = $arrResult['result']['layout'];
        $arquivo = $arrResult['result']['arquivo'];
        $responsavel = $arrResult['result']['responsavel'];
        unset($arrResult);
        self::configPhpIni($arquivo->getIdArquivo());
        if (!is_null($layout->getDsTable())) {
            $strBasepath = substr($strPathZip, 0, strrpos(str_replace('\\', '/', $strPathZip), '/')) . '/' . $this->getNoArquivo($strPathZip, true);
            $this->debugExecFile($strBasepath);
            $zipFile = ZipFile::getInstance();
            $zipFile->openZip($strPathZip, 1);
            if (!is_dir($strBasepath)) {
                $arrResult = $zipFile->extractZipIntoFolder($strBasepath);
                $this->debugExecFile($arrResult);
                if ($arrResult[0] === false) {
                    $zipFile->closeZip();
                    return self::getResult(ResultDto::STATUS_ERROR, 'Falha na realização da carga ao realizar a extração dos arquivos compactados em "' . $strPathZip . '" para "' . $strBasepath . '".', null, $arquivo->getIdArquivo(), $intIdConfiguracao);
                }
            }
            $arrZipFile = $zipFile->getInfoItensFromZip();
            $zipFile->closeZip();
            $this->debugExecFile($arrZipFile);
            $intXmlFile = count($arrZipFile);
            $intIntervalFlow = $this->getIntervalFlow('load');
            $this->debugExecFile($intIntervalFlow);
            foreach ($arrZipFile as $arrInfoXmlFile) {
                $this->debugExecFile($arrInfoXmlFile);
                $this->runServiceRest('loadDataBaseAsync', array($intIdConfiguracao, $strBasepath, $arrInfoXmlFile['name'], $arquivo->toArray(), $layout->toArray(), $intXmlFile, $booSetUsuarioSistema, ((is_object($responsavel)) ? $responsavel->getIdUsuarioSistema() : null)));
                if (!empty($intIntervalFlow))
                    usleep($intIntervalFlow);
            }
            return true;
        }
        if (!is_null($layout->getDsProcedure())) {
            $connection = $this->getService('InepZend\Doctrine\ORM\EntityManager')->getConnection();
            FileSQLLogger::editConfiguration($connection->getConfiguration());
            $connection->beginTransaction();
            if (($booSetUsuarioSistema) && (is_object($responsavel))) {
                $this->debugExecFile('corp.pkg_utilitario.prc_set_usuario_sistema');
                try {
                    $statement = $connection->prepare('begin corp.pkg_utilitario.prc_set_usuario_sistema(:id_usuario_sistema, :ds_ip_user); end;');
                    foreach (array('id_usuario_sistema' => $responsavel->getIdUsuarioSistema(), 'ds_ip_user' => Server::getIp()) as $strBind => $mixValueBind)
                        $statement->bindValue($strBind, $mixValueBind);
                    $statement->execute();
                } catch (ExceptionNative $exception) {
                    $this->debugExecFile($exception);
                    $connection->rollback();
                    return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a chamada da package prc_set_usuario_sistema para o arquivo "' . $strPathZip . '" no banco de dados.' . "\n" . $exception->getMessage(), null, $arquivo->getIdArquivo(), $intIdConfiguracao);
                }
            }
            try {
                $connection->executeQuery($layout->getDsProcedure());
            } catch (ExceptionNative $exception) {
                $this->debugExecFile($exception);
                $connection->rollback();
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a chamada da procedure "' . $layout->getDsProcedure() . '" para o arquivo "' . $strPathZip . '" no banco de dados.' . "\n" . $exception->getMessage(), null, $arquivo->getIdArquivo(), $intIdConfiguracao);
            }
            $connection->commit();
            $connection->close();
            unset($connection);
        }
        $strDsDestino = $configuracao->getDsDestino();
        $this->debugExecFile($strDsDestino);
        if (!empty($strDsDestino)) {
            $this->createPath($strDsDestino, true);
            $strPathZipMove = str_replace(array('//', '\\'), '/', $strDsDestino . '/' . end(explode('/', str_replace('\\', '/', $strPathZip))));
            $this->debugExecFile($strPathZipMove);
            if ((is_file($strPathZip)) && (!is_file($strPathZipMove))) {
                $strFunction = (self::REMOVE_PROCESS_FILE) ? 'rename' : 'copy';
                $booResult = $strFunction($strPathZip, $strPathZipMove);
                $this->debugExecFile($booResult);
                if (!$booResult)
                    return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a movimentação do arquivo "' . $strPathZip . '" para o destino.', null, $arquivo->getIdArquivo(), $intIdConfiguracao);
            }
        }
        $strPartMail = 'totalmente com <font style="font-weight: bold: color: green;">SUCESSO</font>';
        if (is_file(str_replace('/' . self::CONTAINER . '/', '/' . self::FAILURE . '/', str_replace('\\', '/', $strPathZip))))
            $strPartMail = 'parcialmente com <font style="font-weight: bold: color: red;">FALHA</font>';
        self::sendMail($intIdConfiguracao, 'O envio dos dados do arquivo "' . $strPathZip . '" foi realizado ' . $strPartMail . '!');
        return true;
    }
    
    /**
     * Metodo responsavel em realizar a carga de um unico arquivo
     * xml compactado em um arquivo zip.
     *
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param string $strNoArquivoXml
     * @param array $arrArquivo
     * @param array $arrLayout
     * @param integer $intXmlFile
     * @param boolean $booSetUsuarioSistema
     * @param integer $intIdUsuarioSistema
     * @param boolean $booControl
     * @param integer $intRowDebug
     * @return mix
     *
     * @rest true
     * @rest_resource 7d6faeba337b99cf1ed1ac3a3b8eed80
     * @rest_auth false
     */
    protected function loadDataBaseAsync($intIdConfiguracao = null, $strBasepath = null, $strNoArquivoXml = null, $arrArquivo = null, $arrLayout = null, $intXmlFile = null, $booSetUsuarioSistema = false, $intIdUsuarioSistema = null, $booControl = true, $intRowDebug = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathXml = $strBasepath . '/' . $strNoArquivoXml;
        $this->debugExecFile($strPathXml);
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathXml, false, false, false);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $configuracao = $arrResult['result']['configuracao'];
        unset($arrResult);
        self::configPhpIni(@$arrArquivo['id_arquivo']);
        $connection = $this->getService('InepZend\Doctrine\ORM\EntityManager')->getConnection();
        FileSQLLogger::editConfiguration($connection->getConfiguration());
        $connection->beginTransaction();
        if (($booSetUsuarioSistema) && (is_numeric($intIdUsuarioSistema))) {
            $this->debugExecFile('corp.pkg_utilitario.prc_set_usuario_sistema');
            try {
                $statement = $connection->prepare('begin corp.pkg_utilitario.prc_set_usuario_sistema(:id_usuario_sistema, :ds_ip_user); end;');
                foreach (array('id_usuario_sistema' => $intIdUsuarioSistema, 'ds_ip_user' => Server::getIp()) as $strBind => $mixValueBind)
                    $statement->bindValue($strBind, $mixValueBind);
                $statement->execute();
            } catch (ExceptionNative $exception) {
                $this->debugExecFile($exception);
                $connection->rollback();
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a chamada da package prc_set_usuario_sistema para o arquivo "' . $strPathXml . '" no banco de dados.' . "\n" . $exception->getMessage(), null, @$arrArquivo['id_arquivo'], $intIdConfiguracao);
            }
        }
        if ($booControl) {
            $strPathControl = str_ireplace('.xml', '.control', $strPathXml);
            $this->debugExecFile($strPathControl);
            FileSystem::insertContentIntoFile($strPathControl, '');
            $intMicrotime = microtime(true);
        }
        $intError = 0;
        $intRow = 0;
        $arrRegister = Xml::convertToArray($strPathXml);
        if (!empty($arrRegister)) {
            if ((is_array($arrRegister)) && (array_key_exists('register', $arrRegister)))
                $arrRegister = (array) $arrRegister['register'];
            if (is_array($arrRegister)) {
                $this->debugExecFile('Existe registro para carga!');
                foreach ($arrRegister as $intKey => $mixBindValue) {
                    $arrBindValue = $mixBindValue;
                    if (is_object($mixBindValue)) {
                        $arrBindValue = array();
                        foreach ($mixBindValue->childNodes as $node)
                            $arrBindValue[$node->nodeName] = $node->nodeValue;
                    }
                    ArrayCollection::clearEmptyParam($arrBindValue, false, true);
                    if ((!is_null($intRowDebug)) && ($intRow >= $intRowDebug)) {
                        $this->debugExecFile($intRow . '-----------------', true);
                        $this->debugExecFile($arrBindValue, true);
                    }
                    if (empty($arrBindValue)) {
                        if (is_array($arrRegister))
                            unset($arrRegister[$intKey]);
                        else
                            unset($mixBindValue);
                        continue;
                    }
                    if (is_numeric($intIdUsuarioSistema))
                        $arrBindValue['id_usuario_alteracao'] = $intIdUsuarioSistema;
                    if ((!is_null($intRowDebug)) && ($intRow >= $intRowDebug))
                        $this->debugExecFile($arrBindValue, true);
                    try {
                        $strInsert = Sql::createInsert(@$arrLayout['ds_table'], $arrBindValue, true);
                        $connection->executeQuery($strInsert, $arrBindValue);
                        if ((!is_null($intRowDebug)) && ($intRow >= $intRowDebug))
                            $this->debugExecFile('OK', true);
                    } catch (ExceptionNative $exception) {
                        if ((!is_null($intRowDebug)) && ($intRow >= $intRowDebug))
                            $this->debugExecFile($exception, true);
                        $this->debugExecFile($exception);
                        $connection->rollback();
                        self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a inserção do arquivo "' . $strPathXml . '" para o banco de dados.' . "\n" . $exception->getMessage(), null, @$arrArquivo['id_arquivo'], $intIdConfiguracao, false);
                        $connection->beginTransaction();
                        if ($intError < (self::MAX_ERROR/3)) {
                            $this->debugExecFile([$strInsert, $arrBindValue, $strPathXml, $exception->getMessage()], true, false, true);
                            ++$intError;
                        }
                    }
                    ++ $intRow;
                    if (($booControl) && ((!is_null($intRowDebug)) || (($intRow % 500) == 0)))
                        FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime . "\n" . $intRow . "\n" . FileSystem::filesizeFormated(null, $intMemory = memory_get_usage(true)) . ' (' . $intMemory . ')');
                    if (is_array($arrRegister))
                        unset($arrRegister[$intKey]);
                    else
                        unset($mixBindValue);
                    if (($intRow % 1000) == 0) {
                        $connection->commit();
                        $connection->beginTransaction();
                    }
                }
            }
            if ($booControl)
                FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime . "\n" . $intRow . "\n" . FileSystem::filesizeFormated(null, $intMemory = memory_get_usage(true)) . ' (' . $intMemory . ')');
        } else
            $this->debugExecFile('XML sem registro!');
        $connection->commit();
        $connection->close();
        unset($connection);
        FileSystem::insertContentIntoFile($strBasepath . '/' . self::CONTROL_LOAD, (($intError == 0) ? self::COMPLETED : self::FAILURE) . ' ' . $strPathXml . "\n", 'a+');
        $this->runServiceRest('resultLoadDataBase', array($intIdConfiguracao, $strBasepath, $arrArquivo, $intXmlFile, $strPathXml));
        return true;
    }
    
    /**
     * Metodo responsavel em realizar a verificacao dos resultados das cargas
     * dos arquivos xmls compactados em um arquivo zip.
     *
     * @param integer $intIdConfiguracao
     * @param string $strBasepath
     * @param array $arrArquivo
     * @param integer $intXmlFile
     * @param string $strPathXml
     * @return mix
     *
     * @rest true
     * @rest_resource 403bf1ffdfeca7e8890cd5e2d850dcc8
     * @rest_auth false
     */
    protected function resultLoadDataBase($intIdConfiguracao = null, $strBasepath = null, $arrArquivo = null, $intXmlFile = null, $strPathXml = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        $strPathZip = (is_array($arrArquivo)) ? @$arrArquivo['ds_caminho'] : null;
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        $configuracao = $arrResult['result']['configuracao'];
        unset($arrResult);
        $intIdArquivo = (is_array($arrArquivo)) ? @$arrArquivo['id_arquivo'] : null;
        if ((is_null($intIdArquivo)) || (is_null($intXmlFile)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Parâmetros não informados adequadamente na carga.', null, $intIdArquivo, $intIdConfiguracao);
        self::configPhpIni($intIdArquivo);
        $arrResultPathXml = file($strBasepath . '/' . self::CONTROL_LOAD);
        $this->debugExecFile($arrResultPathXml);
        $intResultadoCarga = count($arrResultPathXml);
        $this->debugExecFile($intResultadoCarga);
        if ((integer) $intXmlFile == $intResultadoCarga) {
            $booNotCompleted = false;
            foreach ($arrResultPathXml as $strResultPathXml) {
                if (reset(explode(' ', $strResultPathXml)) != self::COMPLETED) {
                    $booNotCompleted = true;
                    break;
                }
            }
            $mixResult = $this->insertAndamento($strPathZip, self::getFlowStatus(self::LOAD, (($booNotCompleted) ? self::FAILURE : self::COMPLETED)));
            $this->debugExecFile($mixResult);
            if (is_array($mixResult))
                return $mixResult;
            $strDsDestino = $configuracao->getDsDestino();
            $this->debugExecFile($strDsDestino);
            if (!empty($strDsDestino)) {
                $this->createPath($strDsDestino, true);
                $strPathZipMove = str_replace(array('//', '\\'), '/', $strDsDestino . '/' . end(explode('/', str_replace('\\', '/', $strPathZip))));
                $this->debugExecFile($strPathZipMove);
                if ((is_file($strPathZip)) && (!is_file($strPathZipMove))) {
                    $strFunction = (self::REMOVE_PROCESS_FILE) ? 'rename' : 'copy';
                    $booResult = $strFunction($strPathZip, $strPathZipMove);
                    $this->debugExecFile($booResult);
                    if (!$booResult)
                        return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a movimentação do arquivo "' . $strPathZip . '" para o destino.', null, $intIdArquivo, $intIdConfiguracao);
                }
            }
            $strPartMail = 'totalmente com <font style="font-weight: bold: color: green;">SUCESSO</font>';
            if ($booNotCompleted)
                $strPartMail = 'parcialmente com <font style="font-weight: bold: color: red;">FALHA</font>';
            self::sendMail($intIdConfiguracao, 'O envio dos dados do arquivo "' . $strPathZip . '" foi realizado ' . $strPartMail . '!');
            if (self::REMOVE_PROCESS_FILE)
                FileSystem::undir($strBasepath);
        }
        return true;
    }

}
