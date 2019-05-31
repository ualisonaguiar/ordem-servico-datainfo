<?php

namespace InepZend\Repository;

use InepZend\Repository\AbstractRepositoryEntityManager;
use InepZend\Paginator\Adapter\StatementPaginator;
use Doctrine\DBAL\Statement;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\NativeQuery;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Classe abstrata responsavel por metodos relacionados a instancias de Query.
 * 
 * [-] AbstractRepositoryCore
 *      [-] AbstractRepositoryEntityManager
 *          [+] AbstractRepositoryQuery
 *              [-] AbstractRepositoryCommand
 *                  [-] AbstractRepository
 *
 * @package InepZend
 * @subpackage Repository
 */
abstract class AbstractRepositoryQuery extends AbstractRepositoryEntityManager
{

    /**
     * Metodo responsavel em preparar querys do tipo Doctrine\ORM\Query para serem
     * executadas. Caso seja necessario, realiza a execucao da query e retorna seu
     * resultado.
     * 
     * @example $this->executeQuery($query, $arrParameter, $booExecute);
     * 
     * @param object $query
     * @param array $arrParameter
     * @param boolean $booExecute
     * @return mix
     */
    public function executeQuery($query = null, array $arrParameter = null, $booExecute = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (!is_object($query))
            return null;
//        if ($query instanceof Query) {
//            $strSQL = $query->getSQL();
//            if (stripos($strSQL, 'GROUP BY') !== false)
//                return $this->executeSQL($strSQL, $arrParameter, $booExecute);
//        }
        $query = $this->queryFactory($query, null, null, null, $arrParameter);
        return ($booExecute === true) ? $query->getResult() : $query;
    }

    /**
     * Metodo responsavel em preparar DQLs em objetos query do tipo Doctrine\ORM\Query
     * para serem executadas. Caso seja necessario, realiza a execucao da query
     * e retorna seu resultado.
     * 
     * @example $this->executeDQL($strDQL, $arrParameter, $booExecute);
     * 
     * @param string $strDQL
     * @param array $arrParameter
     * @param boolean $booExecute
     * @return mix
     */
    public function executeDQL($strDQL = null, array $arrParameter = null, $booExecute = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($strDQL))
            return null;
        $query = $this->queryFactory(null, $strDQL, null, null, $arrParameter);
        return ($booExecute === true) ? $query->getResult() : $query;
    }

    /**
     * Metodo responsavel em preparar SQLs em objetos query do tipo Doctrine\DBAL\Statement
     * para serem executadas. Caso seja necessario, realiza a execucao da query
     * e retorna seu resultado.
     * 
     * @example $this->executeSQL($strSQL, $arrParameter, $booExecute);
     * 
     * @param string $strSQL
     * @param array $arrParameter
     * @param boolean $booExecute
     * @param boolean $booExecuteQueryFactory
     * @param array $arrType
     * @param boolean $booConnectionExecuteQuery
     * @return mix
     */
    public function executeSQL($strSQL = null, array $arrParameter = null, $booExecute = null, $booExecuteQueryFactory = true, $arrType = [], $booConnectionExecuteQuery = false)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($strSQL))
            return null;
        if (is_object($strSQL)) {
            $strSQL = $this->getQuerySQL($strSQL);
            if (!is_string($strSQL))
                return false;
        }
        if ($booConnectionExecuteQuery !== true)
            $query = $this->queryFactory(null, null, $strSQL, null, $arrParameter, null, null, [], null, $booExecuteQueryFactory, $arrType);
        else
            $query = $this->getEntityManager()->getConnection()->executeQuery($strSQL, $arrParameter, $arrType);
        return ($booExecute === true) ? $query->fetchAll() : $query;
    }

    /**
     * Metodo responsavel em preparar SQLs, com mapeamento de entidades, em objetos
     * query do tipo NativeQuery para serem executadas. Caso seja necessario, realiza
     * a execucao da query e retorna seu resultado.
     * 
     * @example $this->executeSQLMapping($strSQL, $arrParameter, $resultSetMapping);
     * 
     * @param string $strSQL
     * @param array $arrParameter
     * @param ResultSetMapping $resultSetMapping
     * @param boolean $booExecute
     * @return mix
     */
    public function executeSQLMapping($strSQL = null, array $arrParameter = null, ResultSetMapping $resultSetMapping = null, $booExecute = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if ((empty($strSQL)) || (!is_object($resultSetMapping)))
            return null;
        $query = $this->queryFactory(null, null, $strSQL, $resultSetMapping, $arrParameter);
        return ($booExecute === true) ? $query->getResult() : $query;
    }

    /**
     * Metodo responsavel em preparar os parametros em objetos query para serem
     * executadas.
     * 
     * @param object $query
     * @param string $strDQL
     * @param string $strSQL
     * @param object $resultSetMapping
     * @param array $arrParameter
     * @param string $strSortName
     * @param string $strSortOrder
     * @param array $arrCriteria
     * @param string $strAlias
     * @param boolean $booExecute
     * @param array $arrType
     * @return object
     */
    protected function queryFactory($query = null, $strDQL = null, $strSQL = null, $resultSetMapping = null, array $arrParameter = null, $strSortName = null, $strSortOrder = null, array $arrCriteria = null, $strAlias = null, $booExecute = true, $arrType = [])
    {
        $this->trace(__FUNCTION__, func_get_args());
        $this->defineSortNameOrder($strSortName, $strSortOrder, $strSQL, $strAlias);
        if (is_object($query))
            $this->clearParameterToQuery($arrParameter, $query);
        else
            $query = $this->createQueryFromDqlSql($strDQL, $strSQL, $strSortName, $strSortOrder, $resultSetMapping, $strAlias);
        $this->setParamaterIntoQuery($query, $arrParameter, $arrType);
        $this->setCriteriaIntoQuery($query, $arrCriteria);
        $this->setOrderByIntoQuery($query, $strSortName, $strSortOrder);
        if ($booExecute)
            $this->readyQuery($query, $arrParameter, $arrType);
        return $query;
    }

    /**
     * Metodo responsavel em retornar algumas informacoes para o metodo queryFactory
     * de acordo com os parametros.
     * 
     * @param array $arrCriteria
     * @param mix $mixDQLQuery
     * @return array
     */
    protected function getQueryFactoryParam($arrCriteria = null, $mixDQLQuery = null)
    {
        $query = null;
        $strDQL = null;
        $arrParameter = array();
        switch ($mixDQLQuery) {
            case (is_object($mixDQLQuery)):
                $query = $mixDQLQuery;
                if ($query instanceof Statement) {
                    if (!empty($arrCriteria))
                        $arrParameter = $arrCriteria;
                    if (!empty($arrParameter))
                        $this->clearParameterToQuery($arrParameter, $query);
                }
                break;
            case (is_array($mixDQLQuery)):
                $strDQL = $mixDQLQuery[0];
                if (array_key_exists(1, $mixDQLQuery))
                    $arrParameter = $mixDQLQuery[1];
                break;
            case (!empty($mixDQLQuery)):
                $strDQL = $mixDQLQuery;
                break;
            default:
                break;
        }
        return array('query' => $query, 'strDQL' => $strDQL, 'arrParameter' => $arrParameter);
    }

    /**
     * Metodo responsavel em construir um Doctrine\ORM\Query\ResultSetMapping referente
     * ao mapeamento das informacoes de uma Entity.
     * 
     * @example $this->constructMapping($arrMapping);
     * 
     * @param array $arrMapping
     * @return object
     */
    protected function constructMapping(array $arrMapping = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        $resultSetMapping = new ResultSetMapping();
        foreach ((array) $arrMapping as $strAlias => $arrMappingAlias) {
            $arrFrom = (array_key_exists('from', $arrMappingAlias)) ? (array) $arrMappingAlias['from'] : array();
            $arrJoin = (array_key_exists('join', $arrMappingAlias)) ? (array) $arrMappingAlias['join'] : array();
            $arrField = (array_key_exists('field', $arrMappingAlias)) ? (array) $arrMappingAlias['field'] : array();
            if (array_key_exists('entity', $arrFrom))
                $resultSetMapping->addEntityResult($arrFrom['entity'], $strAlias);
            if ((array_key_exists('entity', $arrJoin)) && (array_key_exists('parent_alias', $arrJoin)) && (array_key_exists('parent_attribute', $arrJoin)))
                $resultSetMapping->addJoinedEntityResult($arrJoin['entity'], $strAlias, $arrJoin['parent_alias'], $arrJoin['parent_attribute']);
            foreach ((array) $arrField as $mixField) {
                $strColumnName = strtoupper((is_array($mixField)) ? $mixField[0] : $mixField);
                $strFieldName = (is_array($mixField)) ? $mixField[1] : $mixField;
                $resultSetMapping->addFieldResult($strAlias, $strColumnName, $strFieldName);
            }
        }
        return $resultSetMapping;
    }

    /**
     * Metodo responsavel em retornar a SQL de uma instancia Query.
     * 
     * @param string $query
     * @return mix
     */
    protected function getQuerySQL($query = null)
    {
        if (is_object($query)) {
            if (method_exists($query, 'getQuery'))
                $query = $query->getQuery();
            if (method_exists($query, 'getSQL'))
                return $query->getSQL();
        }
        return false;
    }

    /**
     * Metodo responsabel em definir o nome e a ordenacao para ser usada em clausulas
     * order by nos parametros referenciados.
     * 
     * @param string $strSortName
     * @param string $strSortOrder
     * @param string $strDqlSql
     * @param string $strAlias
     * @return boolean
     */
    private function defineSortNameOrder(&$strSortName = null, &$strSortOrder = null, $strDqlSql = null, $strAlias = null)
    {
        if (!empty($strSortName)) {
            if (empty($strAlias))
                $strAlias = $this->getAlias();
            if (!empty($strSortOrder))
                $strSortOrder = strtoupper($strSortOrder);
            $strSortName = (strpos($strSortName, '.') === false) ? $strAlias . '.' . $strSortName : $strSortName;
            if ((!empty($strDqlSql)) && (stripos($strDqlSql, 'union') !== false) && (strpos($strSortName, '.') !== false))
                $strSortName = end($arrExplode = explode('.', $strSortName));
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em criar uma instancia de Query a partir de uma string
     * DQL ou SQL ou do alias da entidade.
     * 
     * @param string $strDQL
     * @param string $strSQL
     * @param string $strSortName
     * @param string $strSortOrder
     * @param string $resultSetMapping
     * @param string $strAlias
     * @return object
     */
    private function createQueryFromDqlSql($strDQL = null, $strSQL = null, $strSortName = null, $strSortOrder = null, $resultSetMapping = null, $strAlias = null)
    {
        if (!empty($strDQL))
            $query = $this->getEntityManager()->createQuery($strDQL);
        elseif (!empty($strSQL)) {
            $strOrderBy = $this->defineOrderBy($strSortName, $strSortOrder, $strSQL, $resultSetMapping);
            $query = (!is_object($resultSetMapping)) ? $this->getEntityManager()->getConnection()->prepare($strSQL . $strOrderBy) : $this->getEntityManager()->createNativeQuery($strSQL, $resultSetMapping);
        } else {
            if (empty($strAlias))
                $strAlias = $this->getAlias();
            $query = $this->createQueryBuilder($strAlias);
        }
        return $query;
    }

    /**
     * Metodo responsavel em limpar parametros a serem usados em uma instancia de
     * Query.
     * 
     * @param array $arrParameter
     * @param object $query
     * @return array
     */
    private function clearParameterToQuery(&$arrParameter = null, $query = null)
    {
        if ($query instanceof Statement) {
            $statementPaginator = new StatementPaginator($query);
            $arrQuery = $statementPaginator->convertQueryToArray($query);
            if (!empty($arrParameter)) {
                foreach ((array) $arrQuery['params'] as $strAttribute => $mixValue)
                    foreach ((array) $arrParameter as $strParameter => $mixValueParameter)
                        if (strtolower($strAttribute) == strtolower($strParameter))
                            $arrParameter[$strAttribute] = $mixValue;
            } else
                $arrParameter = (array) $arrQuery['params'];
        }
        return $arrParameter;
    }

    /**
     * Metodo responsavel em setar os parametros na instancia de Query.
     * 
     * @param object $query
     * @param array $arrParameter
     * @param array $arrType
     * @return boolean
     */
    private function setParamaterIntoQuery($query = null, $arrParameter = null, $arrType = [])
    {
        if ((is_array($arrParameter)) && (count($arrParameter) > 0)) {
            $arrParameter = $this->clearParameterToQuery($arrParameter);
            if ($query instanceof Statement) {
                foreach ((array) $arrParameter as $strAttribute => $mixValue) {
                    $mixType = (array_key_exists($strAttribute, $arrType)) ? $arrType[$strAttribute] : null;
                    $query->bindValue($strAttribute, $mixValue, $mixType);
                }
            } else
                $query->setParameters($arrParameter, $arrType);
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em setar os criterios na instancia de Query.
     * 
     * @param object $query
     * @param array $arrCriteria
     * @return boolean
     */
    private function setCriteriaIntoQuery($query = null, $arrCriteria = null)
    {
        if ((is_array($arrCriteria)) && (count($arrCriteria) > 0) && ($query instanceof QueryBuilder)) {
            $criteria = Criteria::create();
            foreach ($arrCriteria as $strSearchField => $strSearchValue) {
                if (strpos($strSearchField, '.') !== false)
                    $strSearchField = end($arrExplode = explode('.', $strSearchField));
                $criteria->where(Criteria::expr()->eq($strSearchField, $strSearchValue));
                $query->addCriteria($criteria);
            }
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em setar a clausula order by na instancia de Query.
     * 
     * @param object $query
     * @param string $strSortName
     * @param string $strSortOrder
     * @return boolean
     */
    private function setOrderByIntoQuery($query = null, $strSortName = null, $strSortOrder = null)
    {
        if (!empty($strSortName)) {
            switch ($query) {
                case ($query instanceof Query):
                case ($query instanceof NativeQuery):
                    $strSufix = ($query instanceof NativeQuery) ? 'SQL' : 'DQL';
                    $strMethodGet = 'get' . $strSufix;
                    $strMethodSet = 'set' . $strSufix;
                    $strDqlSql = $query->$strMethodGet();
                    $strOrderBy = $this->defineOrderBy($strSortName, $strSortOrder, $strDqlSql);
                    if (!empty($strOrderBy))
                        $query->$strMethodSet($strDqlSql . $strOrderBy);
                    break;
                case ($query instanceof QueryBuilder):
                    $query->addOrderBy($strSortName, (string) $strSortOrder);
                    break;
            }
            return true;
        }
        return false;
    }

    /**
     * Metodo responsabel em definir a clausula order by.
     * 
     * @param string $strSortName
     * @param string $strSortOrder
     * @param string $strDqlSql
     * @param object $resultSetMapping
     * @return string
     */
    private function defineOrderBy($strSortName = null, $strSortOrder = null, $strDqlSql = null, $resultSetMapping = null)
    {
        if ((!empty($strSortName)) && (!is_object($resultSetMapping))) {
            if ((stripos($strDqlSql, 'union') !== false) && (strpos($strSortName, '.') !== false))
                $strSortName = end($arrExplode = explode('.', $strSortName));
            return ' ORDER BY ' . $strSortName . ' ' . $strSortOrder;
        }
        return '';
    }

    /**
     * Metodo responsavel em finalizar as devidas operacoes e preparar a instancia
     * de Query para uso.
     * 
     * @param object $query
     * @param array $arrParameter
     * @param array $arrType
     * @return boolean
     */
    private function readyQuery($query = null, $arrParameter = null, $arrType = [])
    {
        if ($query instanceof Statement) {
            $query->execute();
            $this->setParamaterIntoQuery($query, $arrParameter, $arrType);
        }
        return true;
    }

}
