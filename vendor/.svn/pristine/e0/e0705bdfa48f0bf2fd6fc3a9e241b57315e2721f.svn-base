<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\Reflection;

class IndexCacheTest extends AbstractServiceUnitTest
{

    const CO_CATEGORIA = 6;
    const CO_SUBCATEGORIA = 6;
    const VALUE_TEST = 442;

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\IndexCache');
        self::getServiceInstance()->createEntityManager();
        $this->begin();
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\IndexCache', self::getServiceInstance());
    }

    public function testFind()
    {
        $this->assertInternalType('object', self::getServiceInstance()->find(self::CO_SUBCATEGORIA));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '9e8553f8047fd33b8938b08a199e9079'));
    }

    /**
     * @depends testFind
     */
    public function testFindBy()
    {
        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA)));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '9e8553f8047fd33b8938b08a199e9079'));
    }

    /**
     * @depends testFindBy
     */
    public function testFetchPairs()
    {
        if ($this->assertNotNull(self::getServiceInstance()->fetchPairs(array('categoria' => self::CO_CATEGORIA))))
            $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(array('categoria' => self::CO_CATEGORIA)));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', 'e9b70d4dacb20f2adaedb2eece04002d'));
    }

    /**
     * @depends testFetchPairs
     */
    public function testFetchPairsToXmlJson()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson());
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '9c8eeed25b99d1e1f6753481c01e8444'));
    }

    public function testInsert()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->insert($this->getDataSubcategoriaToArray(true)));
        $this->assertNull($this->checksAllDataCache());
        $this->setFlush(true);
    }

    public function testUpdate()
    {
        $this->setFlush(false);
        $this->assertNotNull(self::getServiceInstance()->update($this->getDataSubcategoriaToArray(true, self::CO_SUBCATEGORIA)));
        $this->assertNull($this->checksAllDataCache());
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
        $this->assertNull($this->checksAllDataCache());
        $this->setFlush(true);
    }

    public function checksAllDataCache()
    {
        if (count(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null)) > 0)
            return false;
    }

    /**
     * Metodo de teste da AbstractServiceCore, executMethod.
     */
    public function testExecutMethod()
    {
        $this->assertInternalType('object', self::getServiceInstance()->execMethod('parent::', 'find', array(self::CO_SUBCATEGORIA)));
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeAllItemCache', null);
    }

    /**
     * Metodo de teste da AbstractServiceCore, execParentMethod.
     */
    public function testExecParentMethod()
    {
        $this->assertInternalType('object', self::getServiceInstance()->execParentMethod('find', array(self::CO_SUBCATEGORIA)));
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeAllItemCache', null);
    }

    /**
     * Metodo de teste da AbstractServiceCore, execSelfMethod.
     */
    public function testExecSelfMethod()
    {
        $this->assertInternalType('object', self::getServiceInstance()->execSelfMethod('find', array(self::CO_SUBCATEGORIA)));
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeAllItemCache', null);
    }

    /**
     * Metodo de teste da AbstractServiceCore, execThisMethod.
     */
    public function testExecThisMethod()
    {
        $this->assertInternalType('boolean', self::getServiceInstance()->execThisMethod('dataSubcategoriaToArray', array(false, self::CO_SUBCATEGORIA)));
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
