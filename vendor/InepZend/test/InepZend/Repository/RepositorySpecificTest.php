<?php

namespace InepZend\Repository;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Repository\Repository;
use InepZend\Util\Reflection;

class RepositorySpecificTest extends AbstractUnitTest
{

    const CO_SUBCATEGORIA = 6;
    const CO_CATEGORIA = 6;
    const SERVICE = 'Publicacao\Service\Subcategoria';
    const ENTITY = 'Publicacao\Entity\Subcategoria';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('InepZend\Repository\Repository', self::getInstanceOf());
    }

    /**
     * @depends testInstanceOf
     */
    public function testFetchPairs()
    {
        $this->assertInternalType('array', self::getInstanceOf()->fetchPairs('getNoSubcategoria', 'getCoSubcategoria', array('categoria' => self::CO_CATEGORIA)));
    }

    /**
     * @depends testFetchPairs
     */
    public function testFetchPairs2()
    {
        $this->assertNull(self::getInstanceOf()->fetchPairs(null, null, array('categoria' => self::CO_CATEGORIA)));
    }

    /**
     * @depends testFetchPairs
     */
    public function testFetchPairsToXmlJson()
    {
        $this->assertInternalType('array', self::getInstanceOf()->fetchPairsToXmlJson('getNoSubcategoria', 'getCoSubcategoria', array('categoria' => self::CO_CATEGORIA)));
    }

    /**
     * @depends testFetchPairsToXmlJson
     */
    public function testFindByPaged()
    {
        $query = Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getEntityManager', null)->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5);
        $this->assertTrue(is_object(self::getInstanceOf()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1, 10, $query)));
    }

    /**
     * @depends testFindByPaged
     * Testa o retorno dos dados armazenados no banco
     */
    public function testFindByPaged2()
    {
        $query = Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getEntityManager', null)->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5);
        $this->assertInstanceOf('InepZend\Paginator\Paginator', self::getInstanceOf()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1, 10, $query));
    }

    /**
     * @depends testFindByPaged
     */
    public function testDeleteBy()
    {
        try {
            $this->setFlush(false);
            $this->assertNotNull(self::getInstanceOf()->deleteBy(array('co_subcategoria' => self::CO_SUBCATEGORIA), array()));
        } catch (\Exception $exception) {
            $this->assertEquals(self::RETURN_REGEX_ERROR, preg_match(self::REGEX_ERROR_ORACLE, $exception->getMessage()));
        }
        $this->setFlush(true);
    }

    /**
     * @depends testDeleteBy
     */
    public function testUpdateBy()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getInstanceOf()->updateBy(array('co_subcategoria' => self::CO_CATEGORIA), array('co_subcategoria' => 9999), array()));
        $this->setFlush(true);
    }

    /**
     * @depends testUpdateBy
     */
    public function testFetchPairsGeneric()
    {
        $this->assertInternalType('array', self::getInstanceOf()->fetchPairsGeneric('fetchPairsToXmlJson', 'getNoSubcategoria', 'getCoSubcategoria', array('categoria' => self::CO_CATEGORIA)));
    }

    /**
     * @depends testFetchPairsGeneric
     */
    public function testExecuteQuery()
    {        
        $this->assertInstanceOf('Doctrine\ORM\Query', self::getInstanceOf()->executeQuery($this->queryBuilder()));
    }

    /**
     * @depends testExecuteQuery
     * Testa o retorno dos dados armazenados no banco
     */
    public function testExecuteQuery2()
    {
        $this->assertInternalType('array', self::getInstanceOf()->executeQuery($this->queryBuilder())->getResult());
    }

    /**
     * @depends testExecuteQuery
     */
    public function testExecuteDQL()
    {
        $this->assertInstanceOf('Doctrine\ORM\Query', self::getInstanceOf()->executeDQL($this->queryDQL(), array('co_subcategoria' => self::CO_CATEGORIA)));
    }

    /**
     * @depends testExecuteDQL
     */
    public function testExecuteSQL()
    {
        $this->assertInstanceOf('Doctrine\DBAL\Statement', self::getInstanceOf()->executeSQL($this->queryDQL()->getQuery()->getSQL()));
    }

    /**
     * @depends testExecuteSQL
     */
    public function testConstructMapping()
    {
        $this->assertInstanceOf('Doctrine\ORM\Query\ResultSetMapping', self::getInstanceOf()->constructMapping($this->getMapping()));
    }

    /**
     * @depends testConstructMapping
     */
    public function testExecuteSQLMapping()
    {
        $this->assertInstanceOf('Doctrine\ORM\NativeQuery', self::getInstanceOf()->executeSQLMapping($this->getSql(), array(), self::getInstanceOf()->constructMapping($this->getMapping())));
    }

    /**
     * @depends testExecuteSQLMapping
     */
    public function testSetUserSystemDb()
    {
        $this->assertFalse(self::getInstanceOf()->setUserSystemDb());
    }

    /**
     * @depends testSetUserSystemDb
     */
    public function testSetUserSystemDb2()
    {
        # O metodo gera excessao
        try {
            $this->assertInstanceOf('Doctrine\DBAL\Statement', self::getInstanceOf()->setUserSystemDb(406852, '127.0.0.1'));
        } catch (\Exception $exception) {
            $this->assertEquals(self::RETURN_REGEX_ERROR, preg_match(self::REGEX_ERROR_ORACLE, $exception->getMessage()));
        }
    }

    /**
     * @depends testSetUserSystemDb2
     */
    public function testConstructWhereParameter()
    {
        $strAlias = 'subcategoria';
        $arrCriteria = array('co_subcategoria' => self::CO_CATEGORIA);
        $arrTranslate = array('no_subcategoria');
        $arrIn = array('co_subcategoria');
        $arrNotInclude = array('co_categoria');
        $arrNotIn = array(self::CO_SUBCATEGORIA);
        $strSQLDQL = $this->getSql();
        $strConcat = 'WHERE';
        $this->assertInternalType('array', self::getInstanceOf()->constructWhereParameter($strAlias, $arrCriteria, $arrTranslate, $arrIn, $arrNotInclude, $arrNotIn, $strSQLDQL, $strConcat));
    }

    /**
     * @depends testConstructWhereParameter
     */
    public function testConfigEntityManager()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', self::getInstanceOf()->configEntityManager($this->getService(self::SERVICE)->getEntityManager()));
    }

    /**
     * @depends testConfigEntityManager
     */
    public function testConfigEntityManager2()
    {
        $this->assertFalse(self::getInstanceOf()->configEntityManager(''));
    }

    /**
     * @depends testConfigEntityManager2
     */
    public function testSetConfigEntityManager()
    {
        $this->assertFalse(self::getInstanceOf()->setConfigEntityManager());
    }

    /**
     * @depends testSetConfigEntityManager
     */
    public function testSetConfigEntityManager2()
    {
        $this->assertFalse(self::getInstanceOf()->setConfigEntityManager(''));
    }

    /**
     * @depends testSetConfigEntityManager2
     */
    public function testSetConfigEntityManager3()
    {
        $this->assertTrue(self::getInstanceOf()->setConfigEntityManager($this->getService(self::SERVICE)->getEntityManager()));
    }

    /**
     * @depends testSetConfigEntityManager3
     */
    public function testGetConfigEntityManager()
    {
        $this->assertTrue(self::getInstanceOf()->getConfigEntityManager($this->getService(self::SERVICE)->getEntityManager()));
    }

    /**
     * @depends testGetConfigEntityManager
     */
    public function testGetConfigEntityManager2()
    {
        $this->assertFalse(self::getInstanceOf()->getConfigEntityManager());
    }

    /**
     * @depends testGetConfigEntityManager2
     */
    public function testGetKeyEntityManager()
    {
        $this->assertInternalType('string', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getKeyEntityManager', $this->getService(self::SERVICE)->getEntityManager()));
    }

    /**
     * @depends testGetKeyEntityManager
     */
    public function testGetKeyEntityManager2()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getKeyEntityManager', null));
    }

    /**
     * @depends testGetKeyEntityManager2
     */
    public function testGetAlias()
    {
        $this->assertEquals('subcategoria', self::getInstanceOf()->getAlias());
    }

    public function testQueryFactory()
    {
        $this->assertInstanceOf('Doctrine\ORM\QueryBuilder', self::getInstanceOf()->queryFactory());
    }

    public function testQueryFactory2()
    {
        $this->assertInstanceOf('Doctrine\ORM\Query', self::getInstanceOf()->queryFactory($this->queryBuilder()));
    }

    public function testQueryFactory3()
    {
        $this->assertInstanceOf('Doctrine\ORM\Query', self::getInstanceOf()->queryFactory(null, $this->queryDQL()));
    }

    public function testQueryFactory4()
    {
        $this->assertInstanceOf('Doctrine\DBAL\Statement', self::getInstanceOf()->queryFactory(null, null, $this->queryDQL()->getQuery()->getSQL()));
    }

    public function testQueryFactory5()
    {
        $this->assertInstanceOf('Doctrine\ORM\NativeQuery', self::getInstanceOf()->queryFactory(null, null, $this->queryDQL()->getQuery()->getSQL(), self::getInstanceOf()->constructMapping($this->getMapping())));
    }

    public function testQueryFactory6()
    {
        $this->assertInstanceOf('Doctrine\ORM\QueryBuilder', self::getInstanceOf()->queryFactory(null, null, null, null, array('co_subcategoria' => self::CO_CATEGORIA)));
    }

    /**
     * Teste com retorno do tipo Doctrine\ORM\Query
     */
    public function testQueryFactory7()
    {
        $query = self::getInstanceOf()->queryFactory(null, null, null, null, null, null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA))->getQuery();
        $this->assertInstanceOf('Doctrine\ORM\Query', $query);
        # getSQL()
        $this->assertSame(
                'SELECT '
                . 't0_.co_subcategoria AS CO_SUBCATEGORIA0, '
                . 't0_.no_subcategoria AS NO_SUBCATEGORIA1, '
                . 't0_.co_categoria AS CO_CATEGORIA2 '
                . 'FROM inep_skeleton.tb_subcategoria t0_ '
                . 'WHERE t0_.co_subcategoria = ?', $query->getSQL());
        # getDQL()
        $this->assertSame(
                'SELECT subcategoria '
                . 'FROM Publicacao\Entity\Subcategoria subcategoria '
                . 'WHERE subcategoria.co_subcategoria = :co_subcategoria', $query->getDQL());
        # execute()
        $this->assertInstanceOf('Publicacao\Entity\Subcategoria', $query->execute()[0]);
        $this->assertInternalType('array', $query->execute());
        # getResult()
        $this->assertInstanceOf('Publicacao\Entity\Subcategoria', $query->getResult()[0]);
        $this->assertInternalType('array', $query->getResult());
    }

    /**
     * Teste com retorno do tipo Doctrine\ORM\QueryBuilder
     */
    public function testQueryFactory8()
    {
        $queryBuilder = self::getInstanceOf()->queryFactory(null, null, null, null, null, null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
        $this->assertInstanceOf('Doctrine\ORM\QueryBuilder', $queryBuilder);
        # Retornando Doctrine\ORM\Query a partir de um Doctrine\ORM\QueryBuilder
        $this->assertInstanceOf('Doctrine\ORM\Query', $queryBuilder->getQuery());
        # getDQL()
        $this->assertSame(
                'SELECT '
                . 'subcategoria '
                . 'FROM Publicacao\Entity\Subcategoria subcategoria '
                . 'WHERE subcategoria.co_subcategoria = :co_subcategoria', $queryBuilder->getDQL());
        # Utilizando anotacoes de QueryBuilder
        $this->assertInstanceOf('Doctrine\ORM\QueryBuilder', $queryBuilder
                        ->select()
                        ->from('Publicacao\Entity\Subcategoria', 'subcategoria')
                        ->where($queryBuilder->expr()->orX(
                                        $queryBuilder->expr()->eq('subcategoria.co_subcategoria', '?' . self::CO_SUBCATEGORIA), $queryBuilder->expr()->like('subcategoria.no_subcategoria', '?' . 'teste')
                                )
                        )
        );
    }

    private function queryBuilder()
    {
        $queryBuilder = self::getInstanceOf()->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select(self::ENTITY . '.no_subcategoria')
                ->from(self::ENTITY, self::ENTITY)
                ->where(self::ENTITY . '.co_subcategoria = :co_subcategoria')
                ->getQuery()
                ->setParameter('co_subcategoria', self::CO_SUBCATEGORIA);
        return $query;
    }

    private function queryDQL()
    {
        $queryBuilder = self::getInstanceOf()->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select(self::ENTITY . '.no_subcategoria')
                ->from(self::ENTITY, self::ENTITY);
        return $query;
    }

    private function getMapping()
    {
        $arrMapping = array(
            'categoria' => array(
                'from' => array(
                    'entity' => 'Publicacao\Entity\Categoria',
                ),
                'field' => array('co_categoria', 'no_categoria'),
            ),
            'subcategoria' => array(
                'join' => array(
                    'entity' => self::ENTITY,
                    'parent_alias' => 'categoria',
                    'parent_attribute' => 'subcategoria',
                ),
                'field' => array('co_subcategoria', 'no_subcategoria'),
            )
        );
        return $arrMapping;
    }

    private function getSql()
    {
        return $strSQL = 'SELECT 
                                subcategoria.co_subcategoria,
                                subcategoria.no_subcategoria,
                                categoria.co_categoria
                            FROM inep_skeleton.tb_subcategoria subcategoria
                            INNER JOIN inep_skeleton.tb_categoria categoria ON
                                categoria.co_categoria = subcategoria.co_categoria';
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Repository)) {
            $entityManager = $this->getService(self::SERVICE)->getEntityManager();
            self::setInstanceOf(new Repository($entityManager, $entityManager->getClassMetadata(self::ENTITY)));
        }
        return self::getInstanceOf();
    }

}
