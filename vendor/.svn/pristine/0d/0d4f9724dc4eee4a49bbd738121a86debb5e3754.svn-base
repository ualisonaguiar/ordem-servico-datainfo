<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Service\AbstractServiceManager;
use InepZend\Util\Reflection;

class IndexManagerTest extends AbstractServiceUnitTest
{


    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\Index');
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\Index', self::getServiceInstance());
    }

    public function testGetServiceManager()
    {
        $this->assertNotEmpty(AbstractServiceManager::getServiceManager());
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', AbstractServiceManager::getServiceManager());
    }

    public function testHasServiceManager()
    {
        $this->assertInternalType('boolean', AbstractServiceManager::hasServiceManager());
    }

    public function testGetService()
    {
        $this->assertInternalType('object', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getService', null));
        $this->assertNotEmpty(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getService', 'InepZend\Module\UnitTest\Service\Index'));
    }

    public function testSetServiceManager()
    {
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', AbstractServiceManager::getServiceManager());
    }

}
