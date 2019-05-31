<?php

namespace InepZend\Repository;

use InepZend\Repository\AbstractRepositoryCommand;
use InepZend\Paginator\Paginator;
use InepZend\Util\Server;

/**
 * Classe abstrata responsavel por metodos finais ou de grande uso pelos servicos.
 * 
 * [-] AbstractRepositoryCore
 *      [-] AbstractRepositoryEntityManager
 *          [-] AbstractRepositoryQuery
 *              [-] AbstractRepositoryCommand
 *                  [+] AbstractRepository
 *
 * @package InepZend
 * @subpackage Repository
 */
abstract class AbstractRepository extends AbstractRepositoryCommand
{

    protected $arrMethodFetchPairs = array();
    protected static $booUserSystemDb = false;

    /**
     * Metodo responsavel em retornar os dados em array contendo o valor parametrizado
     * na chave do array e o texto parametrizado no conteudo.
     * 
     * @example $this->fetchPairs('name_column_to_value', 'name_column_to_text', array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return array
     */
    public function fetchPairs($strMethodValue = null, $strMethodText = null, array $arrCriteria = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        $this->getMethodFetchPairs($strMethodValue, $strMethodText);
        if ((empty($strMethodValue)) || (empty($strMethodText)))
            return null;
        return $this->constructFetchPairs($this->findBy((array) $arrCriteria, $arrOrderBy, $intLimit, $intOffset), $strMethodValue, $strMethodText);
    }

    /**
     * Metodo responsavel em retornar os dados em array de registros com chaves
     * value e text contendo o valor e texto parametrizados.
     * 
     * @example $this->fetchPairsToXmlJson('name_column_to_value', 'name_column_to_text', array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function fetchPairsToXmlJson($strMethodValue = null, $strMethodText = null, array $arrCriteria = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->constructFetchPairsToXmlJson($this->fetchPairs($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset));
    }

    /**
     * Metodo responsavel em executar outros metodos 'fetchPairs' da Repository.
     * 
     * @example $this->fetchPairsGeneric('fetchPairsToXmlJson', 'name_column_to_value', 'name_column_to_text', array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param string $strMethodFetchPairs
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param int $intLimit
     * @param int $intOffset
     * @return mix
     */
    public function fetchPairsGeneric($strMethodFetchPairs = null, $strMethodValue = null, $strMethodText = null, array $arrCriteria = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        if (empty($strMethodFetchPairs))
            return null;
        return self::$strMethodFetchPairs($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    /**
     * Metodo responsavel em realizar uma selecao parametrizada de elementos de uma entidade.
     * 
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param string $intLimit
     * @param string $intOffset
     * @return mix
     */
    public function findBy(array $arrCriteria = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $booFindByLazy = false;
        $arrAlias = $this->getAllAliasToJoin($arrCriteria, $arrOrderBy);
        if (!empty($arrAlias))
            $booFindByLazy = true;
        elseif (is_array($arrCriteria)) {
            foreach ($arrCriteria as $strAttribute => $mixValue) {
                if ((is_array($mixValue)) && (count($mixValue) > 1)) {
                    $booFindByLazy = true;
                    break;
                }
            }
        }
        return (!$booFindByLazy) ? parent::findBy($arrCriteria, $arrOrderBy, $intLimit, $intOffset) : $this->findByLazy($arrCriteria, $arrOrderBy, $intLimit, $intOffset)->getResult();
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, o mesmo
     * eh utilizado em paginacao, podendo ser tambem utilizado para pesquisas
     * mais refinadas.
     * 
     * @example $this->findByPaged(array('name_column' => 'value'), 'name_column_sort_name', 'ASC | DESC', $intPage, $intItemPerPage, $objectEntity->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5))));
     * 
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQLQuery
     * @return mix
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQLQuery = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($mixDQLQuery)) {
            $arrOrderBy = array();
            if (!empty($strSortName))
                $arrOrderBy[$strSortName] = (empty($strSortOrder)) ? 'ASC' : $strSortOrder;
            $queryArray = $this->findByLazy($arrCriteria, $arrOrderBy);
        } else {
            $arrQueryFactoryParam = $this->getQueryFactoryParam($arrCriteria, $mixDQLQuery);
            $queryArray = $this->queryFactory($arrQueryFactoryParam['query'], $arrQueryFactoryParam['strDQL'], null, null, $arrQueryFactoryParam['arrParameter'], $strSortName, $strSortOrder, $arrCriteria);
        }
        return new Paginator($queryArray, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel em executar o pacote corp.pkg_utilitario.prc_set_usuario_sistema.
     * 
     * @example $this->setUserSystemDb('value_id_user_system', 'value_ip_user');
     * 
     * @param int $intIdUserSystem
     * @param string $strIpUser
     * @return mix
     */
    public function setUserSystemDb($intIdUserSystem = null, $strIpUser = null)
    {
        if (self::$booUserSystemDb)
            return true;
        $this->trace(__FUNCTION__, func_get_args());
        if (empty($intIdUserSystem))
            return false;
        self::$booUserSystemDb = true;
        if (empty($strIpUser))
            $strIpUser = Server::getIp();
        return $this->executeSQL('begin corp.pkg_utilitario.prc_set_usuario_sistema(:id_usuario_sistema, :ds_ip_user); end;', array('id_usuario_sistema' => $intIdUserSystem, 'ds_ip_user' => $strIpUser));
    }

    /**
     * Metodo responsavel em realizar um findBy com criterias em elementos carregados via lazy (ORM).
     * 
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return object
     */
    protected function findByLazy(array $arrCriteria = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $strAlias = $this->getAlias();
        $strEntity = str_replace('Repository', '', get_class($this));
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select($strAlias)->from($strEntity, $strAlias);
        $arrJoin = array();
        $arrTargetEntity = array();
        $arrAlias = $this->getAllAliasToJoin($arrCriteria, $arrOrderBy);
        foreach ($arrAlias as $strAliasIntern) {
            $arrAliasIntern = explode('.', $strAliasIntern);
            foreach ($arrAliasIntern as $intKey => $strAliasAttribute) {
                if (!@empty($arrJoin[$strAliasAttribute]))
                    continue;
                $strParentAlias = ($intKey == 0) ? $strAlias : $arrAliasIntern[$intKey - 1];
                $strCurrentEntity = ($intKey == 0) ? $strEntity : end($arrTargetEntity);
                $arrMap = $this->getAssociationMappings($strCurrentEntity);
                $arrMapAttribute = @$arrMap[$strAliasAttribute];
                if (!@empty($arrMapAttribute)) {
                    if (@empty($arrMapAttribute['joinColumns']))
                        continue;
                    $arrFieldName = $this->getFieldNames($arrMapAttribute['targetEntity']);
                    foreach ($arrMapAttribute['joinColumns'] as $arrJoinColumn) {
                        $strReferencedColumnName = $arrJoinColumn['referencedColumnName'];
                        if (array_key_exists($strReferencedColumnName, $arrFieldName))
                            $strReferencedColumnName = $arrFieldName[$strReferencedColumnName];
                        $arrJoin[$strAliasAttribute] = array('leftJoin', $arrMapAttribute['targetEntity'], $arrMapAttribute['fieldName'], 'WITH', $strParentAlias . '.' . $arrMapAttribute['fieldName'] . ' = ' . $arrMapAttribute['fieldName'] . '.' . $strReferencedColumnName);
                    }
                    $arrTargetEntity[$strAliasAttribute] = $arrMapAttribute['targetEntity'];
                }
            }
        }
        foreach ($arrJoin as $arrJoinParam)
            $queryBuilder->$arrJoinParam[0]($arrJoinParam[1], $arrJoinParam[2], $arrJoinParam[3], $arrJoinParam[4]);
        $arrWhere = array();
        $arrParameter = array();
        $strWhereParameter = null;
        if ((is_array($arrCriteria)) && (!empty($arrCriteria))) {
            $arrCriteriaNew = array();
            $arrLogicalOperator = array();
            $arrTranslate = array();
            $arrTranslatePercent = array();
            $arrIn = array();
            $arrNotIn = array();
            foreach ($arrCriteria as $strAttribute => $mixValue) {
                if (strpos($strAttribute, '.') === false)
                    $strAttribute = $strAlias . '.' . $strAttribute;
                else {
                    $arrAttribute = explode('.', $strAttribute);
                    $strAttribute = $arrAttribute[count($arrAttribute) - 2] . '.' . end($arrAttribute);
                }
                if ((!is_array($mixValue)) || (count($mixValue) <= 1))
                    $mixValueAttribute = $mixValue;
                else {
                    $booSpecial = false;
                    if ((!@empty($mixValue['condition'])) && (is_array($mixValue['condition']))) {
                        $arrLogicalOperator[$strAttribute] = $mixValue['condition'];
                        $booSpecial = true;
                    }
                    if ((!@empty($mixValue['translate'])) && (($mixValue['translate'] == true) || (is_array($mixValue['translate'])))) {
                        $arrTranslate[] = $strAttribute;
                        if (is_array($mixValue['translate']))
                            $arrTranslatePercent = $mixValue['translate'];
                        $booSpecial = true;
                    }
                    if ((!@empty($mixValue['in'])) && ($mixValue['in'] == true)) {
                        $arrIn[] = $strAttribute;
                        $booSpecial = true;
                    }
                    if ((!@empty($mixValue['not_in'])) && ($mixValue['not_in'] == true)) {
                        $arrNotIn[] = $strAttribute;
                        $booSpecial = true;
                    }
                    $mixValueAttribute = ($booSpecial) ? reset($mixValue) : $mixValue;
                }
                $arrCriteriaNew[$strAttribute] = $mixValueAttribute;
            }
            $arrWhereParameter = $this->constructWhere($arrCriteriaNew, $arrLogicalOperator, $arrTranslate, $arrIn, $arrNotIn, null, null, $arrTranslatePercent);
            $arrWhere = $arrWhereParameter[0];
            $arrParameter = $arrWhereParameter[1];
            $strWhereParameter = $arrWhereParameter[2];
        }
        if (!empty($strWhereParameter))
            $queryBuilder->where($strWhereParameter);
        if ((is_array($arrOrderBy)) && (!empty($arrOrderBy))) {
            foreach ($arrOrderBy as $strAttribute => $strSortOrder) {
                if (strpos($strAttribute, '.') === false)
                    $strAttribute = $strAlias . '.' . $strAttribute;
                else {
                    $arrAttribute = explode('.', $strAttribute);
                    $strAttribute = $arrAttribute[count($arrAttribute) - 2] . '.' . end($arrAttribute);
                }
                $queryBuilder->addOrderBy($strAttribute, $strSortOrder);
            }
        }
        if (!is_null($intOffset))
            $queryBuilder->setFirstResult($intOffset);
        if (!is_null($intLimit))
            $queryBuilder->setMaxResults($intLimit);
        $query = $queryBuilder->getQuery();
        if (!empty($arrParameter))
            $query->setParameters($arrParameter);
        return $query;
    }

    /**
     * Metodo responsavel em construir a devida estrutura para o padrao do metodo
     * fetchPairs.
     * array(
     *      valor1 => texto1,
     *      valor2 => texto2,
     * );
     * 
     * @param array $arrEntity
     * @param string $strMethodValue
     * @param string $strMethodText
     * @return array
     */
    protected function constructFetchPairs($arrEntity = null, $strMethodValue = null, $strMethodText = null)
    {
        $arrResult = array();
        if ((is_array($arrEntity)) && (!empty($strMethodValue)) && (!empty($strMethodText)))
            foreach ($arrEntity as $entity) {
                if ((!is_object($entity)) || (!method_exists($entity, $strMethodValue)) || (!method_exists($entity, $strMethodText)))
                    continue;
                $arrResult[$entity->$strMethodValue()] = $entity->$strMethodText();
            }
        return $arrResult;
    }

    /**
     * Metodo responsavel em construir a devida estrutura para o padrao do metodo
     * fetchPairsToXmlJson.
     * array(
     *      0 => array('value' => 'valor1', 'text' => 'texto1'),
     *      1 => array('value' => 'valor2', 'text' => 'texto2'),
     * );
     * 
     * @param array $arrFetchPairs
     * @return array
     */
    protected function constructFetchPairsToXmlJson($arrFetchPairs = null)
    {
        $arrResult = array();
        if (is_array($arrFetchPairs))
            foreach ($arrFetchPairs as $mixValue => $mixText)
                $arrResult[] = array('value' => $mixValue, 'text' => $mixText);
        return $arrResult;
    }

    /**
     * Metodo responsavel em atribuir valores de atributos da classe aos referenciados
     * parametros, caso seja necessario.
     * 
     * @param string $strMethodValue
     * @param string $strMethodText
     * @return void
     */
    private function getMethodFetchPairs(&$strMethodValue = null, &$strMethodText = null)
    {
        if (is_array($this->arrMethodFetchPairs)) {
            if ((empty($strMethodValue)) && (array_key_exists(0, $this->arrMethodFetchPairs)))
                $strMethodValue = $this->arrMethodFetchPairs[0];
            if ((empty($strMethodText)) && (array_key_exists(1, $this->arrMethodFetchPairs)))
                $strMethodText = $this->arrMethodFetchPairs[1];
        }
    }

    /**
     * Metodo responsavel em retornar todos os alias do criteria e order by.
     * 
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @return array
     */
    private function getAllAliasToJoin(array $arrCriteria = null, array $arrOrderBy = null)
    {
        $arrAlias = array();
        $strAlias = $this->getAlias();
        foreach (array_merge((array) $arrCriteria, (array) $arrOrderBy) as $strAttribute => $mixValue) {
            if (strpos($strAttribute, '.') === false)
                $strAttribute = $strAlias . '.' . $strAttribute;
            $arrAttribute = explode('.', $strAttribute);
            unset($arrAttribute[count($arrAttribute) - 1]);
            $strAliasIntern = implode('.', $arrAttribute);
            if ((!in_array($strAliasIntern, $arrAlias)) && ($strAliasIntern != $strAlias))
                $arrAlias[] = $strAliasIntern;
        }
        return $arrAlias;
    }

}
