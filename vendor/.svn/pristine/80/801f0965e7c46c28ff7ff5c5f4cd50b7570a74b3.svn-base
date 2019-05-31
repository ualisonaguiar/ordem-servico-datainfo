<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class UfSpecificTest extends AbstractRestCorpTest
{
    const CO_UF_CERTO = 53;
    const CO_UF_ERRADO = 5300;

    public function testUf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->uf());
    }

    public function testUf2()
    {
        $this->assertObjectHasAttribute('listaUf', self::getInstanceOf()->uf());
    }

    public function testUf3()
    {
        $this->assertNotEmpty(self::getInstanceOf()->uf(self::CO_UF_CERTO));
    }

    public function testUf4()
    {
        $this->assertNotEmpty(self::getInstanceOf()->uf(self::CO_UF_CERTO));
    }

    public function testUf5()
    {
        $this->assertObjectHasAttribute('nomeRegiao', self::getInstanceOf()->uf(self::CO_UF_CERTO));
    }

    public function testUf6()
    {
        $this->assertEmpty(self::getInstanceOf()->uf(self::CO_UF_ERRADO));
    }

    public function testUfWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->ufWithoutCache());
    }

    public function testUfWithoutCache2()
    {
        $this->assertObjectHasAttribute('listaUf', self::getInstanceOf()->ufWithoutCache());
    }

    public function testUfWithoutCache3()
    {
        $this->assertNotEmpty(self::getInstanceOf()->ufWithoutCache(self::CO_UF_CERTO));
    }

    public function testUfWithoutCache4()
    {
        $this->assertNotEmpty(self::getInstanceOf()->ufWithoutCache(self::CO_UF_CERTO));
    }

    public function testUfWithoutCache5()
    {
        $this->assertObjectHasAttribute('nomeRegiao', self::getInstanceOf()->ufWithoutCache(self::CO_UF_CERTO));
    }

    public function testUfWithoutCache6()
    {
        $this->assertEmpty(self::getInstanceOf()->ufWithoutCache(self::CO_UF_ERRADO));
    }

}