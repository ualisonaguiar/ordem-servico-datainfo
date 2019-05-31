<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class ProgramaSpecificTest extends AbstractRestCorpTest
{
    const CO_PROGRAMA = 4;

    public function testPrograma1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->programa());
    }

    public function testPrograma2()
    {
        $this->assertObjectHasAttribute('listaPrograma', self::getInstanceOf()->programa());
    }

    public function testPrograma3()
    {
        $this->assertNotEmpty(self::getInstanceOf()->programa(self::CO_PROGRAMA));
    }

    public function testPrograma4()
    {
        $this->assertObjectHasAttribute('nomePrograma', self::getInstanceOf()->programa(self::CO_PROGRAMA));
    }

}