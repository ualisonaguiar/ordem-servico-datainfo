<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class PaisSpecificTest extends AbstractRestCorpTest
{
    public function testPais1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->pais());
    }

    public function testPais2()
    {
        $this->assertObjectHasAttribute('listaPais', self::getInstanceOf()->pais());
    }

    public function testPaisWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->paisWithoutCache());
    }

    public function testPaisWithoutCache2()
    {
        $this->assertObjectHasAttribute('listaPais', self::getInstanceOf()->paisWithoutCache());
    }

}