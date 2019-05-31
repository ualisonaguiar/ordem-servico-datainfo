<?php

namespace InepZend\Module\Executor\Entity;

use InepZend\Repository\Repository;
use InepZend\Module\Executor\Entity\HistoricoExecucao as HistoricoExecucaoEntity;
use InepZend\Module\Executor\Service\QueryTrait;
use InepZend\Util\Debug;
use InepZend\Module\Executor\Message\Message;

class ExecutorRepository extends Repository
{
    use QueryTrait, Message;

    public function runExecuteQuery($strQuery, $arrParameter)
    {
        $arrResult = array('status' => HistoricoExecucaoEntity::SITUACAO_EXECUCAO_SUCESSO);
        $strQuery = trim($strQuery);
        Debug::startCount();
        try {
            if (strpos(strtoupper($strQuery), 'SELECT') === 0) {
                $strQuery = str_replace('@@', ':', $strQuery);
                $arrResult['data'] = $this->prepareResultSelect($strQuery, $arrParameter);
            } else {
                    $arrQuery = explode(';', $strQuery);
                    foreach ($arrQuery as $strQueryIntern) {
                        $strQueryIntern = trim($strQueryIntern);
                        if (empty($strQueryIntern)) {
                            continue;
                        }                        
                        $arrParameterFinal = array();
                        $arrParameterIntern = $this->getBindFromSql($strQueryIntern);
                        foreach ($arrParameterIntern as $strParameterIntern) {
                            $arrParameterFinal[$strParameterIntern] = $arrParameter[$strParameterIntern];
                        }
                        $strQueryIntern = str_replace('@@', ':', $strQueryIntern);
                        $queryStatement = $this->executeSQL($strQueryIntern, $arrParameterFinal);
                        $mixResult = $this->preparaResultExecute($strQueryIntern, $queryStatement);
                        if (is_array($mixResult)) {
                            $arrResult['data'] = $mixResult;
                        } else {
                            $arrResult['data'] .= $mixResult . "\n";
                        }
                    }
            }
            if (!$arrResult['data']) {
                $arrResult['data'] = array(array('result' => $this->strMsgError04));
            }
        } catch (\Exception $exception) {
            $arrResult['status'] = HistoricoExecucaoEntity::SITUACAO_EXECUCAO_ERROR;
            $arrResult['data'] = array('error' => $exception->getMessage());
        }
        $arrResult['time'] = $this->strMsgSucesso03 . Debug::finishCount(false, false);
        return $arrResult;
    }

    protected function prepareResultSelect($strQuery, $arrParameter)
    {
        return $this->executeSQL($strQuery, $arrParameter)->fetchAll();
    }

    protected function preparaResultExecute($strQueryIntern, $queryStatement)
    {
        return (strpos(strtoupper($strQueryIntern), 'SELECT') !== false) ? $queryStatement->fetchAll() : $this->strMsgSucesso02;
    }
}
