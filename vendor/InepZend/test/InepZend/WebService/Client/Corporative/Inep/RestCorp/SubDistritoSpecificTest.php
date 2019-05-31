<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class SubDistritoSpecificTest extends AbstractRestCorpTest
{
    const CO_SUB_DISTRITO = 32052002507;
    const CO_SUB_DISTRITO_ERRADO = 32052;

    public function testSubDistrito1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->subDistrito(self::CO_SUB_DISTRITO));
    }

    public function testSubDistrito2()
    {
        $this->assertObjectHasAttribute('nomeSubdistrito', self::getInstanceOf()->subDistrito(self::CO_SUB_DISTRITO));
    }

    public function testSubDistrito3()
    {
        $this->assertEmpty(self::getInstanceOf()->subDistrito(self::CO_SUB_DISTRITO_ERRADO));
    }

    public function testSubDistrito4()
    {
        $this->assertObjectHasAttribute('listaSubDistrito', self::getInstanceOf()->subDistrito());
    }

    public function testSubDistritoWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->subDistritoWithoutCache(self::CO_SUB_DISTRITO));
    }

    public function testSubDistritoWithoutCache2()
    {
        $this->assertObjectHasAttribute('nomeSubdistrito', self::getInstanceOf()->subDistritoWithoutCache(self::CO_SUB_DISTRITO));
    }

    public function testSubDistritoWithoutCache3()
    {
        $this->assertEmpty(self::getInstanceOf()->subDistritoWithoutCache(self::CO_SUB_DISTRITO_ERRADO));
    }

    public function testSubDistritoWithoutCache4()
    {
        $this->assertObjectHasAttribute('listaSubDistrito', self::getInstanceOf()->subDistritoWithoutCache());
    }
}