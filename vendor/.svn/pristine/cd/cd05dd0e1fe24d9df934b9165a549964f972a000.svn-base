<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\Reflection;

/**
 * @TODO Criar os metodos de teste ainda nao implementados.
 */
class IndexFileTest extends AbstractServiceUnitTest
{

    const CO_SUBCATEGORIA = 6;

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\IndexFile');
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\IndexFile', self::getServiceInstance());
    }

    public function testFind()
    {
        if (($this->assertNotNull('InepZend\Module\UnitTest\Entity\Subcategoria', self::getServiceInstance()->find(self::CO_SUBCATEGORIA))))
            $this->assertInstanceOf('InepZend\Module\UnitTest\Entity\Subcategoria', self::getServiceInstance()->find(self::CO_SUBCATEGORIA));
    }

    /**
     * @depends testFind
     */
    public function testFindBy()
    {
        $this->assertInternalType('array', self::getServiceInstance()->findBy(array('co_subcategoria' => self::CO_SUBCATEGORIA), null, 1));
    }

    /**
     * @depends testFindBy
     */
    public function testFetchPairs()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairs(null, 'getNoSubcategoria', 'getCoSubcategoria'));
    }

    /**
     * @depends testFetchPairs
     */
    public function testFetchPairsToXmlJson()
    {
        $this->assertInternalType('array', self::getServiceInstance()->fetchPairsToXmlJson(null, 'getNoSubcategoria', 'getCoSubcategoria'));
    }

    public function testGetInstanceEntity()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Entity\Subcategoria', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getInstanceEntity', null));
    }

}
