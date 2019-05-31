<?php

namespace InepZend\Module\TrocaArquivo\Common\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;
use InepZend\Module\TrocaArquivo\Common\Service\ValidateStructureTrait;
use InepZend\Module\TrocaArquivo\Common\Service\ValidateSemanticsTrait;
use InepZend\Session\SessionTrait;
use InepZend\Dto\ResultDto;
use InepZend\Mail\Mail;
use InepZend\Util\FileSystem;
use InepZend\Util\PhpIni;
use InepZend\Util\Date;

abstract class AbstractServiceFileFlow extends AbstractService
{

    use SessionTrait,
        ValidateStructureTrait,
        ValidateSemanticsTrait;

    const SESSION_USE = false;
    const MAX_ERROR = 30;
    const MAX_REGISTER_XML = 12500;
    const BASEPATH = 'data/TrocaArquivo/';
    const UPLOAD = 'upload';
    const CONTAINER = 'container';
    const DATABASE = 'database';
    const PREPROCESS = 'preprocess';
    const PROCESS = 'process';
    const LOAD = 'load';
    const COMPLETED = 'completed';
    const FAILURE = 'failure';
    const RUNNING = 'running';
    const REMOVE_PROCESS_FILE = true;

    /**
     * Metodo responsavel em realizar todos os procedimentos necessarios para iniciar
     * um determinado andamento para a troca de arquivos zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPathZip
     * @param string $strStartFlow
     * @param string $strNextFlow
     * @param string $strMethod
     * @param string $strDtAndamento
     * @param string $strFlowNotFailure
     * @param boolean $booCheckIntegrity
     * @return mix
     */
    protected function startFlow($intIdConfiguracao = null, $strPathZip = null, $strStartFlow = null, $strNextFlow = null, $strMethod = null, $strDtAndamento = null, $strFlowNotFailure = null, $booCheckIntegrity = null)
    {
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPathZip);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        if ($booCheckIntegrity !== false) {
            $mixResult = $this->checkIntegrity($strPathZip);
            $this->debugExecFile($mixResult);
            if (is_array($mixResult))
                return $mixResult;
        }
        if (empty($strStartFlow))
            $strStartFlow = self::CONTAINER;
        $mixAndamento = $this->insertAndamento($strPathZip, $strStartFlow, $strDtAndamento);
        $this->debugExecFile($mixAndamento);
        if (is_array($mixAndamento))
            return $mixAndamento;
        $intIdArquivo = (integer) $mixAndamento->getIdArquivo();
        self::configPhpIni($intIdArquivo);
        if (!empty($strMethod)) {
            $mixResult = $this->$strMethod($intIdConfiguracao, $strPathZip);
            $this->debugExecFile($mixResult);
            if (!is_bool($mixResult)) {
                $this->insertAndamento($strPathZip, self::getFlowStatus($strStartFlow, self::FAILURE));
                return $mixResult;
            }
            if (empty($strFlowNotFailure))
                $strFlowNotFailure = self::COMPLETED;
            $booInsert = ($strFlowNotFailure == self::COMPLETED);
            if (!$booInsert) {
                $arrAndamento = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile')->findBy(array('id_arquivo' => (integer) $intIdArquivo, 'tp_andamento' => self::getFlowStatus($strStartFlow, self::COMPLETED)));
                $booInsert = (count($arrAndamento) == 0);
            }
            if ($booInsert) {
                $mixResult = $this->insertAndamento($strPathZip, self::getFlowStatus($strStartFlow, $strFlowNotFailure));
                $this->debugExecFile($mixResult);
                if (is_array($mixResult))
                    return $mixResult;
            }
        }
        if (!empty($strNextFlow))
            $this->runServiceRest($strNextFlow, array($intIdConfiguracao, $strPathZip));
        return true;
    }

    /**
     * Metodo responsavel em inserir/alterar na base a entidade Arquivo equivalente
     * a um arquivo.
     * 
     * @param integer $intIdArquivo
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param string $strNoArquivo
     * @param integer $intIdResponsavel
     * @param string $strDtEnvio
     * @return mix
     */
    protected function saveArquivo($intIdArquivo = null, $intIdConfiguracao = null, $strPath = null, $strNoArquivo = null, $intIdResponsavel = null, $strDtEnvio = null)
    {
        $this->debugExecFile(func_get_args());
        $arrResult = $this->getInfoCollection($intIdConfiguracao, $strPath);
        $this->debugExecFile($arrResult);
        if ((!is_array($arrResult)) || (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK))
            return $arrResult;
        unset($arrResult);
        $arquivo = $this->getArquivo($strPath);
        $this->debugExecFile($arquivo);
        if (is_object($arquivo))
            return $arquivo;
        $arquivoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile');
        if (empty($strNoArquivo))
            $strNoArquivo = $this->getNoArquivo($strPath);
        if (!empty($intIdArquivo)) {
            $arquivoCurrent = $arquivoService->find((integer) $intIdArquivo);
            $this->debugExecFile($arquivoCurrent);
            if (is_object($arquivoCurrent)) {
                if (empty($intIdResponsavel))
                    $intIdResponsavel = $arquivoCurrent->getIdResponsavel();
                if (empty($strDtEnvio))
                    $strDtEnvio = Date::convertDate($arquivoCurrent->getDtEnvio(), 'Y-m-d H:i:s');
            }
        } elseif (empty($strDtEnvio))
            $strDtEnvio = date('Y-m-d H:i:s');
        $arrData = array(
            'id_arquivo' => (is_numeric($intIdArquivo)) ? (integer) $intIdArquivo : null,
            'id_configuracao' => (integer) $intIdConfiguracao,
            'no_arquivo' => $strNoArquivo,
            'ds_caminho' => $strPath,
            'ds_integridade' => $this->getIntegrity($strPath),
            'id_responsavel' => $intIdResponsavel,
            'dt_envio' => $strDtEnvio,
        );
        $this->debugExecFile($arrData);
        $mixResult = $arquivoService->save($arrData);
        $this->debugExecFile($mixResult);
        if (!$mixResult)
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a inserção do arquivo "' . $strPath . '".', null, $intIdArquivo, $intIdConfiguracao);
        return $mixResult;
    }

    /**
     * Metodo responsavel em inserir na base a entidade Andamento de um arquivo
     * zip.
     * 
     * @param string $strPathZip
     * @param string $strTpAndamento
     * @param string $strDtAndamento
     * @param string $strDsComplemento
     * @param integer $intIdArquivo
     * @return mix
     */
    protected function insertAndamento($strPathZip = null, $strTpAndamento = null, $strDtAndamento = null, $strDsComplemento = null, $intIdArquivo = null)
    {
        $this->debugExecFile(func_get_args());
        if (empty($intIdArquivo))
            $intIdArquivo = $this->getIdArquivo($strPathZip);
        $this->debugExecFile($intIdArquivo);
        if (is_null($intIdArquivo))
            return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo inexistente/inválido: "' . $strPathZip . '".', null, $intIdArquivo);
        $this->debugExecFile($strTpAndamento);
        $arrTpAndamentoAllowed = array(
            self::UPLOAD,
            self::CONTAINER,
            self::PREPROCESS,
            self::getFlowStatus(self::PREPROCESS, self::RUNNING),
            self::getFlowStatus(self::PREPROCESS, self::COMPLETED),
            self::getFlowStatus(self::PREPROCESS, self::FAILURE),
            self::PROCESS,
            self::getFlowStatus(self::PROCESS, self::RUNNING),
            self::getFlowStatus(self::PROCESS, self::COMPLETED),
            self::getFlowStatus(self::PROCESS, self::FAILURE),
            self::LOAD,
            self::getFlowStatus(self::LOAD, self::RUNNING),
            self::getFlowStatus(self::LOAD, self::COMPLETED),
            self::getFlowStatus(self::LOAD, self::FAILURE),
        );
        if (!in_array($strTpAndamento, $arrTpAndamentoAllowed))
            return self::getResult(ResultDto::STATUS_ERROR, 'Andamento "' . $strTpAndamento . '" do arquivo "' . $strPathZip . '" inválido.', null, $intIdArquivo);
        $andamentoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile');
        $arrAndamento = $andamentoService->findBy(array('id_arquivo' => (integer) $intIdArquivo, 'tp_andamento' => $strTpAndamento));
        if (!empty($arrAndamento))
            return end($arrAndamento);
        $arrData = array(
            'id_andamento' => null,
            'id_arquivo' => (integer) $intIdArquivo,
            'ds_complemento' => $strDsComplemento,
            'tp_andamento' => $strTpAndamento,
            'dt_andamento' => (empty($strDtAndamento)) ? date('Y-m-d H:i:s') : $strDtAndamento,
        );
        $this->debugExecFile($arrData);
        $mixResult = $andamentoService->insert($arrData);
        $this->debugExecFile($mixResult);
        if (!$mixResult)
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a inserção do andamento "' . $strTpAndamento . '" do arquivo "' . $strPathZip . '".', null, $intIdArquivo);
        return $mixResult;
    }

    /**
     * Metodo responsavel em inserir/alterar na base a entidade ResultadoValidacao
     * de um arquivo xml.
     * 
     * @param integer $intIdResultado
     * @param integer $intIdArquivo
     * @param string $strPath
     * @param string $strDtInicio
     * @param string $strDtFim
     * @param string $strNoStatus
     * @param string $strTpValidacao
     * @return mix
     */
    protected function saveResultadoValidacao($intIdResultado = null, $intIdArquivo = null, $strPath = null, $strDtInicio = null, $strDtFim = null, $strNoStatus = null, $strTpValidacao = null)
    {
        $this->debugExecFile(func_get_args());
        if ((is_null($intIdArquivo)) || (empty($strPath)) || (!is_file($strPath)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Informações obrigatórias não informadas.', null, $intIdArquivo);
        if (empty($strTpValidacao))
            $strTpValidacao = 'estrutural';
        $arrData = array(
            'id_resultado' => $intIdResultado,
            'id_arquivo' => (integer) $intIdArquivo,
            'tp_validacao' => $strTpValidacao,
            'ds_caminho' => $strPath,
            'no_status' => $strNoStatus,
            'dt_inicio' => (empty($strDtInicio)) ? date('Y-m-d H:i:s') : $strDtInicio,
            'dt_fim' => $strDtFim,
        );
        $this->debugExecFile($arrData);
        $mixResult = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResultadoValidacaoFile')->save($arrData);
        $this->debugExecFile($mixResult);
        if (!$mixResult)
            return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar o registro do resultado da validação do arquivo "' . $strPath . '".', null, $intIdArquivo);
        return $mixResult;
    }

    /**
     * Metodo responsavel em realizar determinadas validacoes e retornar uma colecao
     * de informacoes uteis (configuracao, layout, conteudo, titulos, arquivo) para
     * a troca de arquivos zip.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strPath
     * @param boolean $booContent
     * @param boolean $booArquivo
     * @param boolean $booIsFile
     * @param boolean $booResponsavel
     * @return array
     */
    protected function getInfoCollection($intIdConfiguracao = null, $strPath = null, $booContent = false, $booArquivo = false, $booIsFile = true, $booResponsavel = false)
    {
        $this->debugExecFile(func_get_args());
        if ((is_null($intIdConfiguracao)) || (empty($strPath)) || (($booIsFile) && (strpos(str_replace('\\', '/', $strPath), '/') !== false) && (!is_file($strPath))))
            return self::getResult(ResultDto::STATUS_ERROR, 'Informações obrigatórias não informadas.');
        $configuracao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->find((integer) $intIdConfiguracao);
        $this->debugExecFile($configuracao);
        if (!is_object($configuracao))
            return self::getResult(ResultDto::STATUS_ERROR, 'Configuração inexistente/inválida.');
        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((integer) $configuracao->getIdLayout());
        $this->debugExecFile($layout);
        if ((!is_object($layout)) || (is_null($layout->getDsUrl())))
            return self::getResult(ResultDto::STATUS_ERROR, 'Layout inexistente/inválido ou incompleto.', null, null, $configuracao->getIdConfiguracao());
        $arrResult = array(
            'configuracao' => $configuracao,
            'layout' => $layout,
        );
        if ($booContent === true) {
            $arrContent = explode($layout->getDsSeparadorLinha(), FileSystem::getContentFromFile($strPath));
            $this->debugExecFile(count($arrContent));
            if (empty($arrContent))
                return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo vazio.', null, null, $configuracao->getIdConfiguracao());
            $arrNode = explode($layout->getDsSeparadorColuna(), trim($arrContent[0]));
            unset($arrContent[0]);
            $arrResult['content'] = $arrContent;
            $arrResult['node'] = $arrNode;
        }
        $arquivo = null;
        if ($booArquivo === true) {
            $arquivo = $this->getArquivo($strPath);
            $this->debugExecFile($arquivo);
            if (!is_object($arquivo))
                return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo inexistente/inválido: "' . $strPath . '".', null, null, $configuracao->getIdConfiguracao());
            $arrResult['arquivo'] = $arquivo;
            if ($booResponsavel === true) {
                $responsavel = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->find((integer) $arquivo->getIdResponsavel());
                $this->debugExecFile($responsavel);
                if (!is_object($responsavel))
                    return self::getResult(ResultDto::STATUS_ERROR, 'Responsável inexistente/inválido: "' . $strPath . '".', null, null, $configuracao->getIdConfiguracao());
                $arrResult['responsavel'] = $responsavel;
            }
        }
        return self::getResult(ResultDto::STATUS_OK, null, $arrResult, (is_object($arquivo)) ? $arquivo->getIdArquivo() : null);
    }

    /**
     * Metodo responsavel em realizar determinadas validacoes e retornar uma colecao
     * de informacoes uteis (layout, conteudo, titulos) para a troca de arquivos zip.
     * 
     * @param integer $intIdLayout
     * @param string $strPath
     * @return array
     */
    protected function getInfoCollectionLayout($intIdLayout = null, $strPath = null)
    {
        $this->debugExecFile(__CLASS__ . '::' . __FUNCTION__);
        $this->debugExecFile(func_get_args());
        if ((empty($intIdLayout)) || (! is_object($layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->find((integer) $intIdLayout))))
            return self::getResult(ResultDto::STATUS_ERROR, 'Layout inexistente/inválido.');
        $this->debugExecFile($layout);
        if (is_null($layout->getDsUrl()))
            return self::getResult(ResultDto::STATUS_ERROR, 'Layout incompleto.');
        $arrResult = array(
            'layout' => $layout,
        );
        if ((!empty($strPath)) && (is_file($strPath))) {
            $arrNode = explode($layout->getDsSeparadorColuna(), trim(FileSystem::getContentFromFileChunk($strPath)));
            $arrResult['node'] = $arrNode;
        }
        return self::getResult(ResultDto::STATUS_OK, null, $arrResult);
    }

    /**
     * Metodo responsavel em realizar a checagem de integridade do arquivo zip.
     * 
     * @param string $strPathZip
     * @return mix
     */
    protected function checkIntegrity($strPathZip = null)
    {
        $this->debugExecFile(func_get_args());
        if (!is_file($strPathZip))
            return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo inexistente/inválido: "' . $strPathZip . '".');
        $arquivo = $this->getArquivo($strPathZip);
        $this->debugExecFile($arquivo);
        if (!is_object($arquivo))
            return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo inexistente/inválido: "' . $strPathZip . '".');
        if ($this->getIntegrity($strPathZip) == $arquivo->getDsIntegridade())
            return true;
        return self::getResult(ResultDto::STATUS_ERROR, 'Arquivo não íntegro: "' . $strPathZip . '".', null, $arquivo->getIdArquivo(), $arquivo->getIdConfiguracao());
    }

    /**
     * Metodo responsavel em realizar a checagem de interdependencia entre layouts.
     * 
     * @param object $configuracao
     * @return mix
     */
    protected function checkInterdependence($configuracao = null)
    {
        $this->debugExecFile(func_get_args());
        if (!is_object($configuracao))
            return self::getResult(ResultDto::STATUS_ERROR, 'Configuração inexistente/inválida.');
        $arrInterdependencia = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->findBy(array('id_layout' => (integer) $configuracao->getIdLayout()));
        $this->debugExecFile($arrInterdependencia);
        if (empty($arrInterdependencia))
            return true;
        $arrSent = array();
        $arrNoLayout = array();
        $layoutService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile');
        $configuracaoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile');
        $arquivoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile');
        $andamentoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\AndamentoFile');
        foreach ($arrInterdependencia as $interdependencia) {
            $arrSent[$interdependencia->getIdInterdependencia()] = false;
            $layout = $layoutService->find((integer) $interdependencia->getIdLayoutDependente());
            $this->debugExecFile($layout);
            if (!is_object($layout))
                continue;
            if ((integer) $layout->getInStatus() == 0) {
                $arrSent[$interdependencia->getIdInterdependencia()] = true;
                continue;
            }
            $arrNoLayout[] = $layout->getNoLayout();
            $arrConfiguracao = $configuracaoService->findBy(array('id_layout' => (integer) $interdependencia->getIdLayoutDependente(), 'co_projeto' => (integer) $configuracao->getCoProjeto(), 'co_evento' => (integer) $configuracao->getCoEvento(), 'sg_uf' => $configuracao->getSgUf()));
            $this->debugExecFile($arrConfiguracao);
            if (empty($arrConfiguracao))
                continue;
            foreach ($arrConfiguracao as $configuracaoDependente) {
                $arrArquivo = $arquivoService->findBy(array('id_configuracao' => (integer) $configuracaoDependente->getIdConfiguracao()));
                $this->debugExecFile($arrArquivo);
                if (empty($arrArquivo))
                    continue;
                foreach ($arrArquivo as $arquivoDependente) {
                    $arrAndamento = $andamentoService->findBy(array('id_arquivo' => (integer) $arquivoDependente->getIdArquivo(), 'tp_andamento' => self::getFlowStatus(self::LOAD, self::COMPLETED)));
                    $this->debugExecFile($arrAndamento);
                    if (empty($arrAndamento))
                        continue;
                    $arrSent[$interdependencia->getIdInterdependencia()] = true;
                    break 2;
                }
            }
        }
        $booOk = (!in_array(false, $arrSent));
        $this->debugExecFile($arrSent);
        $this->debugExecFile($booOk);
        if (!$booOk)
            return self::getResult(ResultDto::STATUS_ERROR, 'É necessário inicialmente realizar o envio dos dados do(s) layout(s): "' . implode(', ', $arrNoLayout) . '".');
        return true;
    }

    /**
     * Metodo responsavel em retornar o nome de um arquivo a partir de seu path.
     * 
     * @param string $strPath
     * @param string $booRemoveExtension
     * @return string
     */
    protected function getNoArquivo($strPath = null, $booRemoveExtension = false)
    {
        $strNoArquivo = end(explode('/', str_replace('\\', '/', $strPath)));
        return ($booRemoveExtension) ? reset(explode('.', $strNoArquivo)) : $strNoArquivo;
    }

    /**
     * Metodo responsavel em retornar o id_arquivo a partir do path do arquivo zip.
     * 
     * @param string $strPathZip
     * @return mix
     */
    protected function getIdArquivo($strPathZip = null)
    {
        $arquivo = $this->getArquivo($strPathZip);
        return (is_object($arquivo)) ? $arquivo->getIdArquivo() : false;
    }

    /**
     * Metodo responsavel em retornar a entidade Arquivo a partir do path do arquivo
     * zip.
     * 
     * @param string $strPathZip
     * @return mix
     */
    protected function getArquivo($strPathZip = null)
    {
        if (self::SESSION_USE) {
            $strSessionKey = $this->getSessionKey(__FUNCTION__, func_get_args());
            if (!is_null($mixResult = self::getAttributeSession($strSessionKey)))
                return $mixResult;
        }
        $arquivo = null;
        if (!empty($strPathZip)) {
            $arrArquivo = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile')->findBy(array('ds_caminho' => $strPathZip));
            if (!empty($arrArquivo))
                $arquivo = reset($arrArquivo);
        }
        if (self::SESSION_USE)
            self::setAttributeSession($strSessionKey, $arquivo);
        $this->debugExecFile($arquivo);
        return $arquivo;
    }

    /**
     * Metodo responsavel em retornar a entidade Configuracao a partir do path do
     * arquivo zip.
     * 
     * @param string $strPathZip
     * @return mix
     */
    protected function getConfiguracao($strPathZip = null)
    {
        if (self::SESSION_USE) {
            $strSessionKey = $this->getSessionKey(__FUNCTION__, func_get_args());
            if (!is_null($mixResult = self::getAttributeSession($strSessionKey)))
                return $mixResult;
        }
        $arquivo = $this->getArquivo($strPathZip);
        if (!is_object($arquivo))
            return false;
        $configuracao = null;
        $arrConfiguracao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy(array('id_configuracao' => (integer) $arquivo->getIdConfiguracao()));
        if (!empty($arrConfiguracao))
            $configuracao = reset($arrConfiguracao);
        if (self::SESSION_USE)
            self::setAttributeSession($strSessionKey, $configuracao);
        $this->debugExecFile($configuracao);
        return $configuracao;
    }

    /**
     * Metodo responsavel em retornar a entidade Layout a partir do path do arquivo
     * zip.
     * 
     * @param string $strPathZip
     * @return mix
     */
    protected function getLayout($strPathZip = null)
    {
        if (self::SESSION_USE) {
            $strSessionKey = $this->getSessionKey(__FUNCTION__, func_get_args());
            if (!is_null($mixResult = self::getAttributeSession($strSessionKey)))
                return $mixResult;
        }
        $configuracao = $this->getConfiguracao($strPathZip);
        if (!is_object($configuracao))
            return false;
        $layout = null;
        $arrLayout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy(array('id_layout' => (integer) $configuracao->getIdLayout()));
        if (!empty($arrLayout))
            $layout = reset($arrLayout);
        if (self::SESSION_USE)
            self::setAttributeSession($strSessionKey, $layout);
        $this->debugExecFile($layout);
        return $layout;
    }

    /**
     * Metodo responsavel em criar via FileSystem um determinado path.
     * 
     * @param string $strPath
     * @param boolean $booForce
     * @return boolean
     */
    protected function createPath($strPath = null, $booForce = false)
    {
        $booResult = false;
        $arrPathAllowed = array(
            self::UPLOAD,
            self::CONTAINER,
            self::DATABASE,
            self::FAILURE,
        );
        $arrPath = (empty($strPath)) ? $arrPathAllowed : array($strPath);
        foreach ($arrPath as $strPath) {
            if ((!$booForce) && (!in_array($strPath, $arrPathAllowed)))
                continue;
            if (!$booForce)
                $strPath = self::getBasepath() . $strPath;
            if (!is_dir($strPath)) {
                mkdir($strPath, 0777, true);
                $booResult = true;
            }
        }
        return $booResult;
    }
    
    /**
     * Metodo responsavel em mover o arquivo para a pasta de destino.
     *  
     * @param string $strPath
     * @param string $strFrom
     * @param string $strTo
     * @return boolean
     */
    protected function moveFile($strPath = null, $strFrom = self::CONTAINER, $strTo = self::FAILURE)
    {
        $strPathTo = str_replace('/' . $strFrom . '/', '/' . $strTo . '/', str_replace('\\', '/', $strPath));
        $arrPathTo = explode('/', $strPathTo);
        array_pop($arrPathTo);
        $this->createPath(implode('/', $arrPathTo), true);
        $strFunction = (self::REMOVE_PROCESS_FILE) ? 'rename' : 'copy';
        return ((is_file($strPath)) && (!is_file($strPathTo))) ? $strFunction($strPath, $strPathTo) : false;
    }

    /**
     * Metodo responsavel em realizar as chamadas assincronas dos servicos destinados
     * para a realizacao de andamentos na troca de arquivos zip.
     * 
     * @param string $strService
     * @param array $arrParam
     * @param string $strClass
     * @param boolean $booCurl
     * @return mix
     */
    protected function runServiceRest($strService = null, array $arrParam = array(), $strClass = null, $booCurl = false)
    {
        $this->debugExecFile(func_get_args());
        if (empty($strClass))
            $strClass = get_class($this);
        $strResource = md5($strClass . '::' . $strService);
        $this->debugExecFile($strClass);
        $this->debugExecFile($strResource);
        $this->debugExecFile($booCurl);
        $arrOption = array('timeout' => 4);
        if ($booCurl)
            $arrOption['curloptions'] = array(
                CURLOPT_FRESH_CONNECT => true, 
                CURLOPT_PROXY => null, 
                CURLOPT_PROXYPORT => null,
            );
        return $this->getService('InepZend\WebService\Server\Rest\Service\RestClient')->runServiceAsync($strClass, $strService, $arrParam, $strResource, null, null, null, null, $arrOption, $booCurl);
    }

    /**
     * Metodo responsavel em retornar a string equivalente a integridade de um arquivo
     * zip.
     * 
     * @param string $strPathZip
     * @return string
     */
    protected function getIntegrity($strPathZip = null)
    {
        return md5($strPathZip . FileSystem::filesize($strPathZip));
    }
    
    /**
     * Metodo responsavel em retornar o microsegundo referente ao intervalo de determinados
     * andamentos.
     * 
     * @param string $strIntervalFlow
     * @return mix
     */
    protected function getIntervalFlow($strIntervalFlow = null)
    {
        if (!empty($strIntervalFlow)) {
            $arrConfig = $this->getService('Config');
            if ((is_array(@$arrConfig['troca_arquivo'])) && (is_array(@$arrConfig['troca_arquivo']['interval'])) && (!is_null(@$arrConfig['troca_arquivo']['interval'][$strIntervalFlow])))
                return $arrConfig['troca_arquivo']['interval'][$strIntervalFlow];
        }
        return false;
    }

    /**
     * Metodo responsavel em retornar o andamento com/sem status.
     * 
     * @param string $strFlow
     * @param string $strStatus
     * @return string
     */
    protected static function getFlowStatus($strFlow = null, $strStatus = null)
    {
        return $strFlow . ((empty($strStatus)) ? '' : '-' . $strStatus);
    }

    /**
     * Metodo responsavel em retorar o path raiz da aplicacao.
     * 
     * @return string
     */
    private static function getRootpath()
    {
        return str_replace(array('\\', '//'), '/', __DIR__ . '/../../../../../../../');
    }

    /**
     * Metodo responsavel em retorar o path raiz do componente/modulo de troca de
     * arquivos zip.
     * 
     * @return string
     */
    protected static function getBasepath()
    {
        return self::getRootpath() . self::BASEPATH;
    }

    /**
     * Metodo responsavel em retornar uma chave, utilizando a assinatura do metodo
     * com seus parametros, para uso no armazenamento de informacoes na sessao.
     * 
     * @param string $strMethod
     * @param array $arrArg
     * @return string
     */
    private function getSessionKey($strMethod = null, $arrArg = null)
    {
        return $strMethod . '[' . implode('-', (array) $arrArg) . ']';
    }

    /**
     * Metodo responsavel em definir as informacoes de configuracao do PHP necessarias
     * para o correto funcionamento da troca de arquivos zip.
     * 
     * @param integer $intIdArquivo
     * @param integer $intMegabyteMemoryLimit
     * @param integer $intSecondMaxExecutionTime
     * @return void
     */
    public static function configPhpIni($intIdArquivo = null, $intMegabyteMemoryLimit = -1, $intSecondMaxExecutionTime = 0)
    {
        PhpIni::setTimeLimit($intSecondMaxExecutionTime);
        PhpIni::allocatesMemory($intMegabyteMemoryLimit);
    }
    
    /**
     * Metodo responsavel em enviar determinados conteudos por email para os devidos
     * contatos dos destinatarios.
     * 
     * @param integer $intIdConfiguracao
     * @param string $strContent
     * @param string $strSubject
     * @return mix
     */
    protected function sendMail($intIdConfiguracao = null, $strContent = null, $strSubject = null)
    {
        if ((is_null($intIdConfiguracao)) || (empty($strContent)))
            return false;
        $this->debugExecFile(__FUNCTION__);
        $this->debugExecFile($intIdConfiguracao);
        $this->debugExecFile($strSubject);
        $this->debugExecFile($strContent);
        $arrConfiguracaoContato = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->findBy(array('id_configuracao' => (integer) $intIdConfiguracao));
        $this->debugExecFile($arrConfiguracaoContato);
        if (empty($arrConfiguracaoContato))
            return false;
        if (empty($strSubject))
            $strSubject = 'Troca de Arquivos';
        $arrTo = array();
        foreach ($arrConfiguracaoContato as $configuracaoContato)
            $arrTo[] = $configuracaoContato->getDsEmail();
        $this->debugExecFile($arrTo);
        $mixResult = (new Mail())->sendMail($strContent, $strSubject, $arrTo);
        $this->debugExecFile($mixResult);
        return $mixResult;
    }

    /**
     * Metodo responsavel em retornar um determinado resultado de forma padronizada,
     * inserindo na entidade Erro em status diferentes de ok.
     * 
     * @param string $strStatus
     * @param mix $mixMessage
     * @param mix $mixResult
     * @param integer $intIdArquivo
     * @param integer $intIdConfiguracao
     * @param boolean $booSendMail
     * @return array
     */
    public static function getResult($strStatus = null, $mixMessage = null, $mixResult = null, $intIdArquivo = null, $intIdConfiguracao = null, $booSendMail = true)
    {
        $arrResult = parent::getResult($strStatus, $mixMessage, $mixResult);
        if (strtolower(@$arrResult['status']) != ResultDto::STATUS_OK) {
            self::debugExecFile($arrResult, self::DEBUG);
            $arrDebugBacktrace = debug_backtrace();
            $arrData = array(
                'id_erro' => null,
                'id_arquivo' => $intIdArquivo,
                'no_classe' => @$arrDebugBacktrace[1]['class'],
                'no_metodo' => @$arrDebugBacktrace[1]['function'],
                'nu_linha' => @$arrDebugBacktrace[1]['line'],
                'ds_param' => @$arrDebugBacktrace[1]['args'],
                'no_status' => strtolower(@$arrResult['status']),
                'ds_mensagem' => @$arrResult['messages'],
                'ds_resultado' => @$arrResult['result'],
                'dt_ocorrencia' => date('Y-m-d H:i:s'),
            );
            if (empty($arrData['ds_resultado'])) {
                $arrResultEdited = $arrResult;
                unset($arrResultEdited['result']);
                $arrBacktrace = @$arrDebugBacktrace[1];
                unset($arrBacktrace['object'], $arrBacktrace['type']);
                $arrData['ds_resultado'] = array(
                    $arrBacktrace,
                    $arrResultEdited,
                );
            }
            self::debugExecFile($arrData, self::DEBUG);
            self::getServiceManager()->get('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')->insert($arrData);
        }
        if ($booSendMail)
            self::getServiceManager()->get('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->sendMail($intIdConfiguracao, $mixMessage);
        return $arrResult;
    }

}
