<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class RegiaoSpecificTest extends AbstractRestCorpTest
{
    const CO_REGIAO_CORRETA = 3;
    const CO_REGIAO_INCORRETA = 10;

    public function testRegiao1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->regiao());
    }

    public function testRegiao2()
    {
        $this->assertNotEmpty(self::getInstanceOf()->regiao(self::CO_REGIAO_CORRETA));
    }

    public function testRegiao3()
    {
        $this->assertEmpty(self::getInstanceOf()->regiao(self::CO_REGIAO_INCORRETA));
    }

    public function testRegiao4()
    {
        $this->assertObjectHasAttribute('listaRegiao', self::getInstanceOf()->regiao());
    }

    public function testRegiao5()
    {
        $this->assertObjectHasAttribute('nomeRegiao', self::getInstanceOf()->regiao(self::CO_REGIAO_CORRETA));
    }

    public function testRegiaoWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->regiaoWithoutCache());
    }

    public function testRegiaoWithoutCache2()
    {
        $this->assertNotEmpty(self::getInstanceOf()->regiaoWithoutCache(self::CO_REGIAO_CORRETA));
    }

    public function testRegiaoWithoutCache3()
    {
        $this->assertEmpty(self::getInstanceOf()->regiaoWithoutCache(self::CO_REGIAO_INCORRETA));
    }

    public function testRegiaoWithoutCache4()
    {
        $this->assertObjectHasAttribute('listaRegiao', self::getInstanceOf()->regiaoWithoutCache());
    }

    public function testRegiaoWithoutCache5()
    {
        $this->assertObjectHasAttribute('nomeRegiao', self::getInstanceOf()->regiaoWithoutCache(self::CO_REGIAO_CORRETA));
    }

}