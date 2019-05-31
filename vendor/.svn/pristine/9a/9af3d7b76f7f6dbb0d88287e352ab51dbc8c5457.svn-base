<?php

namespace InepZend\Service;

use InepZend\Paginator\Paginator;

/**
 * Classe abstrata responsavel pelos metodos invocadores do Repository (incluindo
 * o EntityManager) para acionar interacoes com o banco de dados, com uso
 * controlado de cache (ex.: memcache) nos seus resultados.
 * Todos os metodos são manipulacoes no cache. Caso a chamada do metodo nao esteja
 * cacheado, o mesmo sera cacheado e ficara disponivel para uma outra chamada, 
 * evitando assim o custo da utilzacao do banco de dados;
 * 
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
 *              [-] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [-] AbstractServiceControlCache
 *                          [+] AbstractServiceCache
 *                              [-] AbstractServiceCacheAngular
 *                          [-] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceCache extends AbstractServiceControlCache
{

    /**
     * Metodo responsavel em retornar os dados da entidade, seu retorno eh uma
     * chamada do metodo controlCache da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->find('value_pk');
     * 
     * @param mix $mixPk
     * @return mix
     */
    public function find($mixPk)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->controlCache(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, seu 
     * retorno eh uma chamada do metodo controlCache da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->findBy(array('name_column' => 'value'), array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param array $arrCriteria
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function findBy(array $arrCriteria = array(), array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->controlCache(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em salvar (inserindo ou alterando) ps dadps da entidade, seu 
     * retorno eh uma chamada do metodo controlCache da AbstractServiceControlCache.
     *
     * @param array $arrData
     * @param array $arrSetterFk
     * @return mix
     */
    public function save(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->clearCacheAfterExec(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em persistir os dados da entidade, seu retorno eh uma
     * chamada do metodo clearCacheAfterExec da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->insert($entityObject()->toArray(), array(array('method', '\Path\To\Entity', 'value')));
     * 
     * @param array $arrCriteria
     * @param array $arrSetterFk
     * @return mix
     */
    public function insert(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->clearCacheAfterExec(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em alterar os dados da entidade, seu retorno eh uma
     * chamada do metodo clearCacheAfterExec da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->update($entityObject()->toArray(), array(array('method', '\Path\To\Entity', 'value')));
     * 
     * @param array $arrCriteria
     * @param array $arrSetterFk
     * @return mix
     */
    public function update(array $arrData, array $arrSetterFk = array())
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->clearCacheAfterExec(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em deletar os dados da entidade, seu retorno eh uma
     * chamada do metodo clearCacheAfterExec da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->delete($entityObject()->toArray());
     * 
     * @param array $arrData
     * @param object $entity
     * @return mix
     */
    public function delete(array $arrData, $entity = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->clearCacheAfterExec(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor, 
     * podendo ser esses Id e Campo consecutivamente, seu retorno eh uma
     * chamada do metodo controlCache da AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->fetchPairs(array('name_column' => 'value'), 'name_column_to_value', 'name_column_to_text', array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param array $arrCriteria
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function fetchPairs(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->controlCache(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em retornar os dados em array contendo chave e valor, 
     * podendo ser esses Id e Campo consecutivamente. O formato de retorno he em 
     * matriz de array, seu retorno eh uma chamada do metodo controlCache da 
     * AbstractServiceControlCache.
     * 
     * @example $this->getService('Path\To\Service')->fetchPairsToXmlJson(array('name_column' => 'value'), 'name_column_to_value', 'name_column_to_text', array('name_column' => 'ASC | DESC'), 10, 0);
     * 
     * @param array $arrCriteria
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrOrderBy
     * @param integer $intLimit
     * @param integer $intOffset
     * @return mix
     */
    public function fetchPairsToXmlJson(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->controlCache(__FUNCTION__, func_get_args());
    }

    /**
     * Metodo responsavel em retornar os dados da entidade parametrizada, o mesmo
     * eh utilizado em paginacao, podendo ser tambem utilizado para pesquisas
     * mais refinadas, seu retorno eh uma chamada do metodo controlCache da 
     * AbstractServiceControlCache.
     * 
     * @example $this->findByPaged(array('name_column' => 'value'), 'name_column_sort_name', 'ASC | DESC', $intPage, $intItemPerPage, $objectEntity->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5))));
     * 
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return mix
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $this->trace(__FUNCTION__, func_get_args());
        return $this->controlCache(__FUNCTION__, func_get_args());
    }

}
