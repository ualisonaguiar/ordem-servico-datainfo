<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Service\AbstractServiceRepository;
use InepZend\Util\Reflection;

class IndexRepositoryTest extends AbstractServiceUnitTest
{

    const CO_CATEGORIA = 6;
    const CO_SUBCATEGORIA = 6;
    const LIMIT = 1;
    const OFFSET = 2;
    const VALUE_TEST = 441;

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\Index');
        self::getServiceInstance()->createEntityManager();
        $this->begin();
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\Index', self::getServiceInstance());
    }

    public function testGetEntityManager()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEntityManager', null));
    }

    public function testGetRepositoryEntity()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Entity\SubcategoriaRepository', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getRepositoryEntity', 'InepZend\Module\UnitTest\Entity\Subcategoria'));
    }

    public function testFind()
    {
        $this->assertInternalType('object', self::getServiceInstance()->find(self::CO_SUBCATEGORIA));
    }

    /**
     * @depends testFind
     */
    public function testFind2()
    {
        $this->assertInternalType('array', self::getServiceInstance()->find(self::CO_SUBCATEGORIA)->toArray());
    }

    public function testFindBy()
    {
        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
    }

    /**
     * @depends testFindBy
     */
    public function testFindBy2()
    {

        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA), array('co_subcategoria' => 'ASC')));
    }

    /**
     * @depends testFindBy
     */
    public function testFindBy3()
    {
        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA), array('co_subcategoria' => 'ASC'), self::LIMIT));
    }

    /**
     * @depends testFindBy
     */
    public function testFindBy4()
    {
        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA), array('co_subcategoria' => 'ASC'), self::LIMIT, self::OFFSET));
    }

    public function testInsert()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->insert($this->getDataSubcategoriaToArray(true)));
        $this->setFlush(true);
    }

    /**
     * @depends testInsert
     */
    public function testInsert2()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->insert($this->getDataSubcategoriaToArray(), array(array('setCategoria', 'InepZend\Module\UnitTest\Entity\Categoria', self::CO_CATEGORIA))));
        $this->setFlush(true);
    }

    public function testUpdate()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->update($this->getDataSubcategoriaToArray(true, self::CO_SUBCATEGORIA)));
        $this->setFlush(true);
    }

    /**
     * @depends testUpdate
     */
    public function testUpdate2()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->update($this->getDataSubcategoriaToArray(false, self::CO_SUBCATEGORIA), array(array('setCategoria', 'InepZend\Module\UnitTest\Entity\Categoria', self::CO_CATEGORIA))));
        $this->setFlush(true);
    }

    public function testDelete()
    {
        try {
            $this->setFlush(false);
            self::getServiceInstance()->delete($this->getDataSubcategoriaToArray(true, self::CO_SUBCATEGORIA));
        } catch (\Exception $exception) {
            $this->assertEquals(self::RETURN_REGEX_ERROR, preg_match(self::REGEX_ERROR_ORACLE, $exception->getMessage()));
        }
        $this->setFlush(true);
    }

    public function testDeleteBy()
    {
        try {
            $this->setFlush(false);
            $this->assertNotNull(self::getServiceInstance()->deleteBy(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
        } catch (\Exception $exception) {
            $this->assertEquals(self::RETURN_REGEX_ERROR, preg_match(self::REGEX_ERROR_ORACLE, $exception->getMessage()));
        }
        $this->setFlush(true);
    }

    public function testFetchPairs()
    {
        if ($this->assertNotNull(self::getServiceInstance()->fetchPairs(array('categoria' => self::CO_CATEGORIA))))
            $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(array('categoria' => self::CO_CATEGORIA)));
    }

    public function testFetchPairs2()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(null, 'getNoSubcategoria', 'getCoSubcategoria'));
    }

    public function testFetchPairs3()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC')));
    }

    public function testFetchPairs4()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC'), self::LIMIT));
    }

    public function testFetchPairs5()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC'), self::LIMIT, self::OFFSET));
    }

    public function testFetchPairsToXmlJson()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson());
    }

    public function testFetchPairsToXmlJson2()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson(null, 'getNoSubcategoria', 'getCoSubcategoria'));
    }

    public function testFetchPairsToXmlJson3()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC')));
    }

    public function testFetchPairsToXmlJson4()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC'), self::LIMIT));
    }

    public function testFetchPairsToXmlJson5()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson(null, 'getNoSubcategoria', 'getCoSubcategoria', array('no_subcategoria' => 'ASC'), self::LIMIT, self::OFFSET));
    }

    public function testGetReferenceEntity()
    {
        $this->assertInternalType('object', self::getServiceInstance()->getReferenceEntity(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
        $this->assertInstanceOf('InepZend\Module\UnitTest\Entity\Subcategoria', self::getServiceInstance()->getReferenceEntity(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
    }

    public function testGetReferenceEntity2()
    {
        $this->assertInternalType('object', self::getServiceInstance()->getReferenceEntity(array('co_subcategoria' => self::CO_SUBCATEGORIA), self::getServiceInstance()->getEntityName()));
        $this->assertInstanceOf('InepZend\Module\UnitTest\Entity\Subcategoria', self::getServiceInstance()->getReferenceEntity(array('co_subcategoria' => self::CO_SUBCATEGORIA), self::getServiceInstance()->getEntityName()));
    }

    public function testFindByPaged()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged());
    }

    public function testFindByPaged1()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
    }

    public function testFindByPaged2()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria'));
    }

    public function testFindByPaged3()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC'));
    }

    public function testFindByPaged4()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1));
    }

    public function testFindByPaged5()
    {
        $this->assertInternalType('object', self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1, 10));
    }

    public function testFindByPaged6()
    {
        $query = Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEntityManager', null)->createQuery('select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ?1')->setParameter(1, 5);
        $this->assertTrue(is_object(self::getServiceInstance()->findByPaged(array('co_subcategoria' => self::CO_SUBCATEGORIA), 'no_subcategoria', 'ASC', 1, 10, $query)));
    }

    public function testSetFlush()
    {
        AbstractServiceRepository::setFlush(false);
        $this->assertFalse(AbstractServiceRepository::getFlush());
    }

    public function testSetFlush2()
    {
        AbstractServiceRepository::setFlush(true);
        $this->assertTrue(AbstractServiceRepository::getFlush());
    }

    /**
     * @depends testSetFlush2
     */
    public function testGetFlush()
    {
        $this->assertInternalType('boolean', AbstractServiceRepository::getFlush());
        $this->assertTrue(AbstractServiceRepository::getFlush());
    }

    public function testSetFk()
    {
        $strEntity = self::getServiceInstance()->getEntityName();
        $entity = new $strEntity();
        self::getServiceInstance()->setFk($entity, array(array('setCategoria', 'InepZend\Module\UnitTest\Entity\Categoria', self::CO_CATEGORIA)));
        $this->assertInternalType('object', $entity);
    }

    public function testGetEntityName()
    {
        $this->assertEquals('InepZend\Module\UnitTest\Entity\Subcategoria', self::getServiceInstance()->getEntityName());
    }

    public function testCreateEntityManager()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', self::getServiceInstance()->createEntityManager());
    }

    public function testCreateEntityManager2()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', self::getServiceInstance()->createEntityManager(true, 'Doctrine\ORM\EntityManager'));
    }

    public function testCreateEntityManager3()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', self::getServiceInstance()->createEntityManager(false, 'Doctrine\ORM\EntityManager'));
    }

    public function testSetEntityManager()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\Index', self::getServiceInstance()->setEntityManager(self::getServiceInstance()->getEntityManager()));
    }

    private function getDataSubcategoriaToArray($booReference = false, $intValue = self::VALUE_TEST)
    {
        $strEntity = self::getServiceInstance()->getEntityName();
        $subcategoria = (new $strEntity())
                ->setCategoria(self::CO_CATEGORIA)
                ->setNoSubcategoria('UnitTest')
                ->setCoSubcategoria($intValue);
        $arrSubCategoria = $subcategoria->toArray();
        if ($booReference)
            $arrSubCategoria['categoria'] = self::getServiceInstance()->getReferenceEntity(array('co_categoria' => self::CO_CATEGORIA), 'InepZend\Module\UnitTest\Entity\Categoria');
        return $arrSubCategoria;
    }

}
