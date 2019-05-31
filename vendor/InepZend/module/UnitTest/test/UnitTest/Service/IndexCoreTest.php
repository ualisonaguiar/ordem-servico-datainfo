<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\Reflection;

class IndexCoreTest extends AbstractServiceUnitTest
{

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\IndexCore');
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\IndexCore', self::getServiceInstance());
    }

    public function testGetIdentity()
    {
        $this->assertSame(true, is_object(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getIdentity')));
    }

    public function testGetEvalString()
    {
        $this->assertSame('$mixResult = \InepZend\Service\AbstractServiceCore::method($mixArgument[0], $mixArgument[1]);', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', '\InepZend\Service\AbstractServiceCore::', 'method', array(0 => 'param1', 1 => 'param2')));
    }

    public function testGetEvalString2()
    {
        $this->assertSame(false, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', null, 'method', array(0 => 'param1', 1 => 'param2')));
    }

    public function testGetEvalString3()
    {
        $this->assertSame('$mixResult = \InepZend\Service\AbstractServiceCore::method($mixArgument[0], $mixArgument[1]);', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', '\InepZend\Service\AbstractServiceCore::', 'method', array(0 => 'param1', 1 => 'param2')));
    }

    public function testGetEvalString4()
    {
        $this->assertSame(false, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', null, null, array(0 => 'param1', 1 => 'param2')));
    }

    public function testGetEvalString5()
    {
        $this->assertSame('$mixResult = \InepZend\Service\AbstractServiceCore::method();', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', '\InepZend\Service\AbstractServiceCore::', 'method', null));
    }

    public function testGetEvalString6()
    {
        $this->assertSame('$mixResult = parent::method($mixArgument[param1], $mixArgument[param2]);', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', 'parent::', 'method', array('param1' => 1, 'param2' => 2)));
    }

    public function testGetEvalString7()
    {
        $this->assertSame('$mixResult = self::method($mixArgument[param1], $mixArgument[param2]);', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', 'self::', 'method', array('param1' => 1, 'param2' => 2)));
    }

    public function testGetEvalString8()
    {
        $this->assertSame('$mixResult = $this->method($mixArgument[param1], $mixArgument[param2]);', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getEvalString', '$this->', 'method', array('param1' => 1, 'param2' => 2)));
    }

}
