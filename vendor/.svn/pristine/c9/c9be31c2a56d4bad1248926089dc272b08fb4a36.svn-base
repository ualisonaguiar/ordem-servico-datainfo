<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\Reflection;

class IndexControlCacheTest extends AbstractServiceUnitTest
{

    const CO_SUBCATEGORIA = 6;

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\Index');
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\Index', self::getServiceInstance());
    }

    /**
     * Metodo 'findBySubcategoriaCache' implementado na classe InepZend\Module\UnitTest\Service\Index.
     */
    public function testControlCache()
    {
        self::getServiceInstance()->findBySubcategoriaCache(self::CO_SUBCATEGORIA);
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', 'W2e4d9a644e8f26315d88c5626a904099'));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '2e4d9a644e8f26315d88c5626a904099'));
    }

    /**
     * Metodo 'findBySubcategoriaCache' implementado na classe InepZend\Module\UnitTest\Service\Index.
     */
    public function testClearCacheAfterExec()
    {
        $this->assertNotNull(self::getServiceInstance()->findBySubcategoriaCacheExec(self::CO_SUBCATEGORIA));
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '441bb2f3caa2b8e0479b748c39f8fcd8'));
    }

    /**
     * Metodo 'findBySubcategoriaAnnotationCache' implementado na classe InepZend\Module\UnitTest\Service\Index.
     */
    public function testCall()
    {
        self::getServiceInstance()->findBySubcategoriaAnnotationCache(self::CO_SUBCATEGORIA);
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '53E24007aacea957212cdf8e62a013820'));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', '9df8ccfa79d43f684792a1db6a16f03f'));
    }

    public function testRemoveCache()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeAllItemCache', null));
    }

}
