<?php

namespace InepZend\Module\Executor\Service;

use InepZend\Service\AbstractServiceFile as AbstractServiceFileInepZend;
use InepZend\Paginator\Paginator;
use InepZend\Module\Executor\Entity\Query as QueryEntity;
use InepZend\Exception\Exception;
use InepZend\Dto\ResultDto;
use InepZend\Module\Executor\Service\QueryTrait;
use InepZend\Module\Executor\Message\Message;

class Query extends AbstractServiceFileInepZend
{
    use QueryTrait, Message;

    public function __construct()
    {
        parent::__construct();
        $this->arrPk = array('idQuery');
    }

    /**
     * Metodo responsavel por listager as operacoes cadastradas.
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return Paginator
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = 'dsTitulo', $strSortOrder = 'asc', $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        if ($this->getService('InepZend\Module\Executor\Service\Usuario')->hasAdministrador()) {
            $arrDataQuery = $this->findBy(null, array('dsTitulo' => 'asc'));
        } else {
            $arrDataQuery = $this->findBy(array('inAtivo' => (string) QueryEntity::SITUACAO_ATIVO), array('dsTitulo' => 'asc'));
        }
        $arrDataResult = array();
        foreach ($arrDataQuery as $infoQuery) {
            if ($arrCriteria) {
                if (!$this->filterFindByPage($arrCriteria, $infoQuery)) {
                    continue;
                }
            }
            $arrDataResult[] = array(
                'ID_QUERY' => $infoQuery->getIdQuery(),
                'DS_TITULO' => $infoQuery->getDsTitulo(),
                'IN_ATIVO' => QueryEntity::$arrSituacao[$infoQuery->getInAtivo()],
                'DT_CADASTRO' => $infoQuery->getDtCadastro(),
                'DT_EXECUCAO' => $this->getLastExecute($infoQuery->getIdQuery())
            );
        }
        return new Paginator($arrDataResult, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel por retornar a ultima execucao.
     *
     * @param integer $intIdQuery
     * @return mix
     */
    protected function getLastExecute($intIdQuery)
    {
        $serviceHistory = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao');
        $arrDataHistory = $serviceHistory->findBy(array('idQuery' => (int) $intIdQuery), array('dtExecucao' => 'desc'), 1);
        if (!$arrDataHistory)
            return null;
        return $arrDataHistory[0]->getDtExecucao();
    }

    /**
     * Metodo responsavel por filtrar na listagem do cadastro de operacao.
     *
     * @param type $arrCriteria
     * @param type $infoQuery
     * @return boolean
     */
    protected function filterFindByPage($arrCriteria, $infoQuery)
    {
        # filtro do in_ativo
        if ($arrCriteria['inAtivo'] != '') {
            if ($infoQuery->getInAtivo() != $arrCriteria['inAtivo'])
                return false;
        }
        # filtro titulo
        if ($arrCriteria['dsTitulo']) {
            if (strpos($infoQuery->getDsTitulo(), $arrCriteria['dsTitulo']) === false)
                return false;
        }
        return true;
    }

    /**
     * Metodo responsavel por salvar operacao.
     *
     * @param array $arrData
     * @return Query
     */
    protected function saveQuery(array $arrData)
    {        
        $arrData[(empty($arrData['idQuery']) ? 'dtCadastro' : 'dtAlteracao')] = date('Y-m-d H:i:s');
        if ($arrData['idQuery'] != '') {            
            $arrData['idQuery'] = (int) $arrData['idQuery'];
            if ($this->getService('InepZend\Module\Executor\Service\Usuario')->hasProductOwner()) 
                unset($arrData['dsQuery']);
        } else {
            unset($arrData['idQuery']);
        }
        $arrData['dsUsuario'] = $this->getNameUserUpdate();
        return $this->save($arrData);
    }

    /**
     * Metodo responsavel por alterar a situacao da operacao.
     *
     * @param integer $intIdQuery
     * @return array
     * @throws Exception
     */
    protected function changeSituation($intIdQuery)
    {
        try {
            $strStatus = ResultDto::STATUS_OK;
            $mixMessage = $this->strMsgSucesso06;
            $dataQuery = $this->find((int) $intIdQuery);
            if (!$dataQuery) {
                throw new Exception($this->strMsgError06);
            }
            $arrDataQuery = $dataQuery->toArray();
            $arrDataQuery['inAtivo'] = (($arrDataQuery['inAtivo'] == QueryEntity::SITUACAO_ATIVO) ? QueryEntity::SITUACAO_INATIVO : QueryEntity::SITUACAO_ATIVO);
            $arrDataQuery['dtAlteracao'] = date('Y-m-d H:i:s');
            $arrDataQuery['idUsuarioAlteracao'] = $this->getNameUserUpdate();
            $this->save($arrDataQuery);
        } catch (Exception $exception) {
            $strStatus = ResultDto::STATUS_ERROR;
            $mixMessage = $exception->getMessage();
        }
        return self::getResult($strStatus, $mixMessage);
    }
}
