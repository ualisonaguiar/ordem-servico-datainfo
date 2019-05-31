<?php
namespace InepZend\Module\TrocaArquivo\Common\Service;

use InepZend\Doctrine\DBAL\Logging\FileSQLLogger;
use InepZend\Dto\ResultDto;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;
use InepZend\Util\Sql;
use InepZend\Util\Xml;
use InepZend\Util\ArrayCollection;
use Zend\Json\Json;
use InepZend\Exception\Exception;
use Exception as ExceptionNative;

trait ValidateSemanticsTrait
{
    
    private static $arrDsColunaIlhaDado = array();

    /**
     * Metodo responsavel em realizar a validacao semantica via ilha de dados em cache.
     *
     * @param string $strPathXml
     * @param integer $intIdLayout
     * @param string $strNoLayout
     * @param integer $intIdConfiguracao
     * @param integer $intCoProjeto
     * @param string $strSgUf
     * @param integer $intInValidacaoImpeditiva
     * @param integer $intIdArquivo
     * @param boolean $booControl
     * @return mix
     */
    protected function validateSemantics($strPathXml = null, $intIdLayout = null, $strNoLayout = null, $intIdConfiguracao = null, $intCoProjeto = null, $strSgUf = null, $intInValidacaoImpeditiva = null, $intIdArquivo = null, $booControl = true)
    {
        $this->debugExecFile(func_get_args());
        if ((empty($strPathXml)) || (empty($intIdLayout)))
            return self::getResult(ResultDto::STATUS_ERROR, 'Informações obrigatórias não informadas para a validação semântica.');
        $arrRegraValidacao = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\RegraValidacaoFile')->findBy(array(
            'id_layout' => (integer) $intIdLayout,
            'in_ativo' => 1
        ));
        if (! is_array($arrRegraValidacao))
            return true;
        $arrError = array();
        $arrPathXml = explode('/', str_replace('\\', '/', $strPathXml));
        $strNameXml = array_pop($arrPathXml);
        $strBasePathXml = implode('/', $arrPathXml) . '/';
        $this->debugExecFile($strNameXml);
        $this->debugExecFile($strBasePathXml);
        if ($booControl) {
            $strPathControl = $strBasePathXml . __FUNCTION__ . '/' . str_ireplace('.xml', '.control', $strNameXml);
            $this->debugExecFile($strPathControl);
            FileSystem::insertContentIntoFile($strPathControl, '');
            $intMicrotime = microtime(true);
        }
        if ($intInValidacaoImpeditiva != 1) {
            $strNoLayout = strtolower($strNoLayout);
            $strPathXmlCompleted = $strBasePathXml . self::COMPLETED . '/' . $strNameXml;
            $strPathXmlFailure = $strBasePathXml . self::FAILURE . '/' . $strNameXml;
            $this->debugExecFile($strNoLayout);
            $this->debugExecFile($strPathXmlCompleted);
            $this->debugExecFile($strPathXmlFailure);
            $strXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $strXml .= '<registers xmlns="' . Server::getHost() . 'xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="' . Server::getHost() . 'xsd ' . $strNoLayout . '.xsd">' . "\n";
            $mixResult = FileSystem::insertContentIntoFile($strPathXmlCompleted, $strXml);
            $this->debugExecFile($mixResult);
            if (!$mixResult) {
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo XML com registros corretos: "' . $strPathXmlCompleted . '".', null, $intIdArquivo, $intIdConfiguracao); 
            }
            $mixResult = FileSystem::insertContentIntoFile($strPathXmlFailure, $strXml);
            $this->debugExecFile($mixResult);
            if (!$mixResult) {
                return self::getResult(ResultDto::STATUS_ERROR, 'Falha ao realizar a criação do arquivo XML com registros corretos: "' . $strPathXmlCompleted . '".', null, $intIdArquivo, $intIdConfiguracao);
            }
            $strXmlCompleted = '';
            $strXmlFailure = '';
            unset($strXml);
        }
        $arrPathXml = explode('-', $strPathXml);
        array_pop($arrPathXml);
        $strKeyCacheRequest = implode('-', $arrPathXml);
        $this->debugExecFile($strKeyCacheRequest);
        $intLineCompleted = 0;
        $intLineFailure = 0;
        $intRow = 0;
//         $domDocument = new \DOMDocument();
//         $domDocument->preserveWhiteSpace = true;
//         $domDocument->load($strPathXml);
//         $arrRegister = $domDocument->getElementsByTagName('register');
        $arrRegister = Xml::convertToArray($strPathXml);
        if (!empty($arrRegister)) {
            if ((is_array($arrRegister)) && (array_key_exists('register', $arrRegister)))
                $arrRegister = (array) $arrRegister['register'];
            foreach ($arrRegister as $intKey => $mixBindValue) {
                $arrBindValue = $mixBindValue;
                if (is_object($mixBindValue)) {
                    $arrBindValue = array();
                    foreach ($mixBindValue->childNodes as $node)
                        $arrBindValue[$node->nodeName] = $node->nodeValue;
                }
                ArrayCollection::clearEmptyParam($arrBindValue, false, true);
                if (empty($arrBindValue)) {
                    if (is_array($arrRegister))
                        unset($arrRegister[$intKey]);
                    else
                        unset($mixBindValue);
                    continue;
                }
                $strRegister = '<register>';
                foreach ($arrBindValue as $strNodeName => $mixNodeValue)
                    $strRegister .= '<' . $strNodeName . '' . (((is_null($mixNodeValue)) || ($mixNodeValue == '')) ? ' xsi:nil="true"' : '') . '>' . $mixNodeValue . '</' . $strNodeName . '>';
                $strRegister .= '</register>' . "\n";
                if ($intRow == 0) {
                    try {
                        $arrAllData = $this->getAllDataRequest($arrBindValue, $arrRegraValidacao, $strKeyCacheRequest, $intCoProjeto, $strSgUf, $arrError);
                        $arrRegraValidacaoInExistenteIlhaDado = array();
                        foreach ($arrRegraValidacao as $regraValidacao)
                            $arrRegraValidacaoInExistenteIlhaDado[$regraValidacao->getIdRegraValidacao()] = $regraValidacao->getInExistenteIlhaDado();
                    } catch (ExceptionNative $exception) {
                        $this->debugExecFile($exception);
                        break;
                    }
                    if ($booControl)
                        FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime);
                }
                try {
                    $this->hasRegisterIntoAllDataRequest($arrBindValue, $intRow, $strPathXml, $arrAllData, $arrRegraValidacaoInExistenteIlhaDado, $arrError);
                    if ($intInValidacaoImpeditiva != 1) {
                        ++ $intLineCompleted;
                        $strXmlCompleted .= $strRegister;
                        if (($intLineCompleted % 500) == 0) {
                            FileSystem::insertContentIntoFile($strPathXmlCompleted, $strXmlCompleted, 'a+');
                            $strXmlCompleted = '';
                        }
                    }
                } catch (Exception $exception) {
                    if ($intInValidacaoImpeditiva != 1) {
                        ++ $intLineFailure;
                        $strXmlFailure .= $strRegister;
                        if (($intLineFailure % 500) == 0) {
                            FileSystem::insertContentIntoFile($strPathXmlFailure, $strXmlFailure, 'a+');
                            $strXmlFailure = '';
                        }
                    } else
                        break;
                }
                ++ $intRow;
                if (($booControl) && (($intRow % 500) == 0))
                    FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime . "\n" . $intRow);
                if (is_array($arrRegister))
                    unset($arrRegister[$intKey]);
                else
                    unset($mixBindValue);
            }
            if ($booControl)
                FileSystem::insertContentIntoFile($strPathControl, microtime(true) - $intMicrotime . "\n" . $intRow);
            if ($intInValidacaoImpeditiva != 1) {
                FileSystem::insertContentIntoFile($strPathXmlCompleted, $strXmlCompleted . '</registers>', 'a+');
                FileSystem::insertContentIntoFile($strPathXmlFailure, $strXmlFailure . '</registers>', 'a+');
            }
        }
        $this->debugExecFile($arrError);
        return (empty($arrError)) ? true : $arrError;
    }
    
    private function getAllDataRequest($arrRegister = null, $arrRegraValidacao = null, $strKeyCacheRequest = null, $intCoProjeto = null, $strSgUf = null, &$arrError = array())
    {
        $arrAllData = array();
        $this->debugExecFile($arrRegister);
        $this->debugExecFile(count($arrRegraValidacao));
        $this->debugExecFile($strKeyCacheRequest);
        $this->debugExecFile($intCoProjeto);
        $this->debugExecFile($strSgUf);
        $connection = $this->getService('InepZend\Doctrine\ORM\EntityManager')->getConnection();
        FileSQLLogger::editConfiguration($connection->getConfiguration());
        $ilhaDadoService = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile');
        foreach ($arrRegraValidacao as $regraValidacao) {
            $this->debugExecFile('Regra de validacao ' . $regraValidacao->getIdRegraValidacao() . ' com uso da ilha de dados ' . $regraValidacao->getIdIlhaDado());
            $arrDataRequest = $this->getAttributeCache($strKeyCacheRequest, $regraValidacao->getIdRegraValidacao());
            if (! empty($arrDataRequest)) {
                $this->debugExecFile('Ja existe no cache o resultado da ilha de dados para a requisicao assincrona e paralela');
                $arrAllData[$regraValidacao->getIdRegraValidacao()] = $arrDataRequest;
                continue;
            }
            $this->debugExecFile('NAO existe no cache o resultado da ilha de dados para a requisicao assincrona e paralela');
            $ilhaDado = $ilhaDadoService->find((integer) $regraValidacao->getIdIlhaDado());
            if (! is_object($ilhaDado))
                continue;
            $arrInfoFromValueBind = $this->getInfoFromValueBind($ilhaDado, $regraValidacao, $arrRegister, $intCoProjeto, $strSgUf);
            $strKeyCacheIlhaDado = $arrInfoFromValueBind[0];
            $booConsult = $this->checkConsult($ilhaDado, $strKeyCacheIlhaDado, $regraValidacao, $strKeyCacheRequest, $arrAllData, $arrError);
            if ($booConsult) {
                $arrDataIlhaDado = $this->executeConsult($ilhaDado, $arrInfoFromValueBind[1], $connection, $arrError);
                if (! is_array($arrDataIlhaDado))
                    throw new Exception(end($arrError));
                $this->cacheConsult($ilhaDado, $strKeyCacheIlhaDado, $regraValidacao, $strKeyCacheRequest, $arrDataIlhaDado, $arrAllData, $arrError);
            } else
                $this->debugExecFile('NAO foi necessario realizar a consulta da ilha de dados em banco');
        }
        return $arrAllData;
    }

    private function getInfoFromValueBind($ilhaDado = null, $regraValidacao = null, $arrRegister = null, $intCoProjeto = null, $strSgUf = null)
    {
        $strKeyCacheIlhaDado = $regraValidacao->getIdIlhaDado();
        $arrBindValue = array();
        $arrBind = Sql::getBind($ilhaDado->getDsConsulta());
        sort($arrBind);
        $this->debugExecFile($arrBind);
        foreach ($arrBind as $strBind) {
            $mixValueBind = $this->getValueBindFromRegister($arrRegister, $strBind, $intCoProjeto, $strSgUf);
            if (! empty($mixValueBind)) {
                $arrBindValue[$strBind] = $mixValueBind;
                $strKeyCacheIlhaDado .= '|' . $mixValueBind;
            }
        }
        $this->debugExecFile($strKeyCacheIlhaDado);
        $this->debugExecFile($arrBindValue);
        return array(
            $strKeyCacheIlhaDado,
            $arrBindValue
        );
    }

    private function getValueBindFromRegister($arrRegister = null, $strBind = null, $intCoProjeto = null, $strSgUf = null)
    {
        $mixValueBind = @$arrRegister[$strBind];
        $this->debugExecFile($mixValueBind);
        if (is_null($mixValueBind)) {
            switch (strtolower($strBind)) {
                case 'co_projeto':
                    $mixValueBind = $intCoProjeto;
                    break;
                case 'sg_uf':
                    $mixValueBind = $strSgUf;
                    break;
            }
        }
        $this->debugExecFile($mixValueBind);
        return $mixValueBind;
    }

    private function checkConsult($ilhaDado = null, $strKeyCacheIlhaDado = null, $regraValidacao = null, $strKeyCacheRequest = null, &$arrAllData = array(), &$arrError = array())
    {
        $booConsult = true;
        if ((boolean) $ilhaDado->getInCache()) {
            $arrDataIlhaDado = $this->getAttributeCache(self::getKeyCacheIlhaDado(), $strKeyCacheIlhaDado);
            $booExistCache = (! empty($arrDataIlhaDado));
            $this->debugExecFile($booExistCache);
            if ($booExistCache) {
                $booConsult = false;
                $this->debugExecFile('Ja existe no cache o resultado estatico da ilha de dados');
                $arrAllData[$regraValidacao->getIdRegraValidacao()] = $this->getDataRequest($regraValidacao, $strKeyCacheRequest, Json::decode($arrDataIlhaDado, Json::TYPE_ARRAY), $arrError);
            } else
                $this->debugExecFile('NAO existe no cache o resultado estatico da ilha de dados');
        }
        $this->debugExecFile($booConsult);
        return $booConsult;
    }

    private function executeConsult($ilhaDado = null, $arrBindValue = null, $connection = null, &$arrError = array())
    {
        $this->debugExecFile($ilhaDado->getDsConsulta());
        $statement = $connection->prepare($ilhaDado->getDsConsulta());
        foreach ($arrBindValue as $strBind => $mixValueBind)
            $statement->bindValue($strBind, $mixValueBind);
        try {
            if ($statement->execute()) {
                $arrDataIlhaDado = $statement->fetchAll();
                if (is_array($arrDataIlhaDado)) {
                    $this->debugExecFile('Realizada com sucesso a consulta da ilha de dados em banco');
                    return $arrDataIlhaDado;
                }
            }
            $arrError[] = 'A consulta da ilha de dados em banco não foi realizada com sucesso.' . "\n";
        } catch (ExceptionNative $exception) {
            $arrError[] = $exception->getMessage() . "\n";
        }
        return false;
    }

    private function cacheConsult($ilhaDado = null, $strKeyCacheIlhaDado = null, $regraValidacao = null, $strKeyCacheRequest = null, $arrDataIlhaDado = null, &$arrAllData = array(), &$arrError = array())
    {
        $arrAllData[$regraValidacao->getIdRegraValidacao()] = $this->getDataRequest($regraValidacao, $strKeyCacheRequest, $arrDataIlhaDado, $arrError);
        if ((boolean) $ilhaDado->getInCache())
            $this->setAttributeCache(self::getKeyCacheIlhaDado(), Json::encode($arrDataIlhaDado), $strKeyCacheIlhaDado);
    }

    private function getDataRequest($regraValidacao = null, $strKeyCacheRequest = null, $arrDataIlhaDado = null, &$arrError = array(), $booValueIntoKey = true)
    {
        $arrDataRequest = array();
        $arrDsColuna = $regraValidacao->getDsColuna(true);
        foreach ($arrDataIlhaDado as $intKey => $arrInfo) {
            if ($intKey == 0) {
                foreach ($arrDsColuna as $strDsColuna) {
                    if (! array_key_exists($strDsColuna, $arrInfo)) {
                        $arrError[] = 'Não existe a coluna ' . $strDsColuna . ' no resultado da ilha de dados.' . "\n";
                        throw new Exception(end($arrError));
                    }
                }
            }
            $arrDataRequest[$intKey] = array();
            foreach ($arrDsColuna as $strDsColuna)
                $arrDataRequest[$intKey][$strDsColuna] = $arrInfo[$strDsColuna];
        }
        if ($booValueIntoKey) {
            foreach ($arrDataRequest as $intKey => $arrInfo) {
                $arrDataRequest[json_encode($arrInfo)] = $arrInfo;
                unset($arrDataRequest[$intKey]);
            }
        }
        $this->setAttributeCache($strKeyCacheRequest, $arrDataRequest, $regraValidacao->getIdRegraValidacao());
        return $arrDataRequest;
    }
    
    private function hasRegisterIntoAllDataRequest($arrRegister = null, $intRow = null, $strPathXml = null, $arrAllData = array(), $arrRegraValidacaoInExistenteIlhaDado = array(), &$arrError = array())
    {
        $arrErrorIntern = array();
        if (!is_array($arrError))
            $arrError = (empty($arrError)) ? array() : array($arrError);
        $strNameXml = end(explode('/', str_replace('\\', '/', $strPathXml)));
        foreach ($arrAllData as $intIdRegraValidacao => $arrDataRequest) {
            if (empty($arrDataRequest))
                continue;
            if (! is_array(@$this->arrDsColunaIlhaDado[$intIdRegraValidacao]))
                $this->arrDsColunaIlhaDado[$intIdRegraValidacao] = ((is_array($arrDataRequest)) && (is_array(reset($arrDataRequest)))) ? array_keys(reset($arrDataRequest)) : array();
            $arrRegisterColuna = array();
            foreach ($this->arrDsColunaIlhaDado[$intIdRegraValidacao] as $strDsColuna)
                $arrRegisterColuna[$strDsColuna] = @$arrRegister[$strDsColuna];
            $booError = (isset($arrDataRequest[json_encode($arrRegisterColuna)]));
            if ($arrRegraValidacaoInExistenteIlhaDado[$intIdRegraValidacao] == true)
                $booError = !$booError;
            if ($booError) {
                $strError = 'O registro ' . ($intRow + 1) . ', contido no arquivo ' . $strNameXml . ', não atende a regra de validação ' . $intIdRegraValidacao . '.' . "\n";
                $this->debugExecFile($strError);
                $arrErrorIntern[] = $strError;
                $arrError[] = $strError;
                if (count($arrError) >= self::MAX_ERROR)
                    break;
            }
        }
        if (! empty($arrErrorIntern))
            throw new Exception('Existe(m) registro(s) contido(s) no arquivo ' . $strNameXml . ' que não atende a alguma regra de validação.');
    }
    
    private static function getKeyCacheIlhaDado()
    {
        return 'IlhaDado';
    }
}
