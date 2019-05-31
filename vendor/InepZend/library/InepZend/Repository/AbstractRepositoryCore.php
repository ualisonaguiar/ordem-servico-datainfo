<?php

namespace InepZend\Repository;

use Doctrine\ORM\EntityRepository;
use InepZend\Authentication\AuthTrait;
use InepZend\Dto\ResultTrait;
use InepZend\Log\LogCall;
use InepZend\Util\Date;

/**
 * Classe abstrata responsavel por metodos considerados essenciais a manipulacao
 * de dados dos repositorios via Doctrine.
 * 
 * [+] AbstractRepositoryCore
 *      [-] AbstractRepositoryEntityManager
 *          [-] AbstractRepositoryQuery
 *              [-] AbstractRepositoryCommand
 *                  [-] AbstractRepository
 *
 * @package InepZend
 * @subpackage Repository
 */
abstract class AbstractRepositoryCore extends EntityRepository
{

    use AuthTrait,
        ResultTrait,
        LogCall;

    const KEY_WHERE = 'arrWhere';
    const KEY_PARAMETER = 'arrParameter';

    /**
     * 
     * @param array $arrCriteria
     * @param array $arrLogicalOperator
     * @param array $arrTranslate
     * @param array $arrIn
     * @param array $arrNotIn
     * @param array $arrNotInclude
     * @param string $strAlias
     * @param array $arrTranslatePercent
     * @return array
     */
    protected function constructWhere($arrCriteria = null, $arrLogicalOperator = null, $arrTranslate = null, $arrIn = null, $arrNotIn = null, $arrNotInclude = null, $strAlias = null, $arrTranslatePercent = null)
    {
        $strSQLDQL = '';
        $arrWhereParameter = (array) $this->constructWhereParameter($strAlias, $arrCriteria, $arrTranslate, $arrIn, $arrNotInclude, $arrNotIn, $strSQLDQL, null, $arrLogicalOperator, $arrTranslatePercent);
        $arrWhereParameter[] = $strSQLDQL;
        return $arrWhereParameter;
    }

    /**
     * Metodo responsavel em construir as clausulas condicionais where (com bind)
     * e seus respectivos valores, para serem utilizados em uma consulta/execucao
     * de query DQL/SQL.
     * 
     * @example $this->constructWhereParameter('subcategoria', array('co_subcategoria' => 'valor'), array('no_subcategoria'), array('co_subcategoria'), array('co_categoria'), array(1), $strSQLDQL, ' WHERE ');
     * 
     * @param string $strAlias
     * @param array $arrCriteria
     * @param array $arrTranslate
     * @param array $arrIn
     * @param array $arrNotInclude
     * @param array $arrNotIn
     * @param string $strSQLDQL
     * @param string $strConcat
     * @param array $arrLogicalOperator
     * @param array $arrTranslatePercent
     * @return array
     */
    protected function constructWhereParameter($strAlias = null, array $arrCriteria = null, array $arrTranslate = null, array $arrIn = null, array $arrNotInclude = null, array $arrNotIn = null, &$strSQLDQL = null, $strConcat = null, $arrLogicalOperator = null, $arrTranslatePercent = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (is_null($strAlias))
            $strAlias = $this->getAlias();
        $arrWhere = array();
        $arrParameter = array();
        foreach ((array) $arrCriteria as $strKey => $mixValue) {
            if ((is_numeric($strKey)) || (in_array($strKey, (array) $arrNotInclude)))
                continue;
            $strAttribute = ((empty($strAlias)) || (strpos($strKey, '.') !== false)) ? $strKey : $strAlias . '.' . $strKey;
            $arrWhereParameter = $this->getWhereParameter($strKey, $mixValue, $strAttribute, $arrIn, $arrNotIn, $arrTranslate, $arrTranslatePercent);
            $arrWhere = array_merge($arrWhere, $arrWhereParameter[self::KEY_WHERE]);
            $arrParameter = array_merge($arrParameter, $arrWhereParameter[self::KEY_PARAMETER]);
        }
        if ((!is_null($strSQLDQL)) && (count($arrWhere) > 0))
            $strSQLDQL .= ' ' . trim((string) $strConcat) . ' ' . $this->getWhereLogicalOperator($arrWhere, $arrCriteria, $arrLogicalOperator);
        return array($arrWhere, $arrParameter);
    }

    /**
     * Metodo que retorna o alias da entidade a partir do namespace da Entity.
     * 
     * @example $this->getAlias();
     *
     * @return string
     */
    protected function getAlias()
    {
        $arrExplode = explode('\\', str_replace('/', '\\', $this->getEntityName()));
        return strtolower(end($arrExplode));
    }

    /**
     * Metodo responsavel em retornar um array com as clausulas condicionais where
     * com bind e outro array com os valores dos parametros destas condicionais.
     * Ainda ha opcoes de uso do in, not in, translate, is null, is not null, etc.
     * 
     * @param string $strKey
     * @param mix $mixValue
     * @param string $strAttribute
     * @param array $arrIn
     * @param array $arrNotIn
     * @param array $arrTranslate
     * @param array $arrTranslatePercent
     * @return array
     */
    private function getWhereParameter($strKey = null, $mixValue = null, $strAttribute = null, $arrIn = null, $arrNotIn = null, $arrTranslate = null, $arrTranslatePercent = null)
    {
        if ((!in_array($strKey, (array) $arrIn)) && (is_array($mixValue))) {
            if (!is_array($arrIn))
                $arrIn = array();
            $arrIn[] = $strKey;
        }
        $arrWhere = array();
        $arrParameter = array();
        $strBind = (is_string($strKey)) ? str_replace('.', '_', $strKey) : $strKey;
        if ((is_null($mixValue)) || ((!is_array($mixValue)) && (in_array(trim(strtoupper((string) $mixValue)), array('IS NULL', 'ISNULL')))))
            $arrWhere[] = $strAttribute . ' IS NULL';
        elseif ((!is_array($mixValue)) && (in_array(trim(strtoupper((string) $mixValue)), array('IS NOT NULL', 'ISNOTNULL'))))
            $arrWhere[] = $strAttribute . ' IS NOT NULL';
        elseif (in_array($strKey, (array) $arrTranslate)) {
            $arrWhere[] = 'TRANSLATE(LOWER(' . $strAttribute . '),\'âàãáéêíóôõüúç\',\'aaaaeeiooouuc\') LIKE TRANSLATE(LOWER(:' . $strBind . '),\'âàãáéêíóôõüúç\',\'aaaaeeiooouuc\')';
            if (!is_array($arrTranslatePercent))
                $arrTranslatePercent = array();
            if ((!array_key_exists(0, $arrTranslatePercent)) || (is_null($arrTranslatePercent[0])))
                $arrTranslatePercent[0] = '%';
            if ((!array_key_exists(1, $arrTranslatePercent)) || (is_null($arrTranslatePercent[1])))
                $arrTranslatePercent[1] = '%';
            $arrParameter[$strBind] = $arrTranslatePercent[0] . $mixValue . $arrTranslatePercent[1];
        } elseif (((in_array($strKey, (array) $arrIn)) || (in_array($strKey, (array) $arrNotIn))) && (is_array($mixValue))) {
            $strOperator = (in_array($strKey, (array) $arrIn)) ? '' : 'NOT ';
            $arrWhere[] = $strAttribute . ' ' . $strOperator . 'IN (:' . $strBind . implode(', :' . $strBind, array_keys($mixValue)) . ')';
            foreach ($mixValue as $intKey => $mixValueIntern)
                $arrParameter[$strBind . $intKey] = $mixValueIntern;
        } elseif ((!is_array($mixValue)) && (($booIsTemplate = Date::isDateTemplate($mixValue)) || (Date::isDateBase($mixValue)))) {
            $arrWhere[] = 'TO_CHAR(' . $strAttribute . ', \'' . (($booIsTemplate) ? 'DD/MM/YYYY' : 'YYYY-MM-DD') . '\') = :' . $strBind;
            $arrParameter[$strBind] = $mixValue;
        } else {
            $arrWhere[] = $strAttribute . ' = :' . $strBind;
            $arrParameter[$strBind] = $mixValue;
        }
        return array(self::KEY_WHERE => $arrWhere, self::KEY_PARAMETER => $arrParameter);
    }

    /**
     * Metodo responsavel em retornar a string de clausulas condicionais WHERE.
     * 
     * @param array $arrWhere
     * @param array $arrCriteria
     * @param array $arrLogicalOperator
     * @return string
     */
    private function getWhereLogicalOperator($arrWhere = null, $arrCriteria = null, $arrLogicalOperator = null)
    {
        if ((!is_array($arrLogicalOperator)) || (empty($arrLogicalOperator)) || (count($arrWhere) <= 1))
            return implode(' AND ', $arrWhere);
        $strWhere = '';
        $arrCriteriaKey = array_keys($arrCriteria);
        $arrAttributeNext = array();
        foreach ($arrLogicalOperator as $strAttribute => $arrCondition) {
            if ((!is_string($strAttribute)) || (!is_array($arrCondition)))
                continue;
            $strAttributeNext = @$arrCondition[0];
            if (empty($strAttributeNext))
                continue;
            $strLogicalOperator = @$arrCondition[1];
            if (empty($strLogicalOperator))
                $strLogicalOperator = 'AND';
            $intKey = array_search($strAttribute, $arrCriteriaKey);
            $intKeyNext = array_search($strAttributeNext, $arrCriteriaKey);
            if ((is_bool($intKey)) || (is_bool($intKeyNext)))
                continue;
            $strWhere .= ((in_array($strAttribute, $arrAttributeNext)) ? '' : '(' . $arrWhere[$intKey] . ')') . ' ' . trim($strLogicalOperator) . ' (' . $arrWhere[$intKeyNext] . ')';
            $arrAttributeNext[] = $strAttributeNext;
        }
        return $strWhere;
    }

}
