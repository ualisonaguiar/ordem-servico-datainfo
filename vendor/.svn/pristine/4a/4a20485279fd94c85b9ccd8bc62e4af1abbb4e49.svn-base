<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class EtniaSpecificTest extends AbstractRestCorpTest
{
    const ETNIA_EXISTENTE = 1;
    const ETNIA_INEXISTENTE = 7;

    public function testCorRaca1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->corRaca());
    }

    public function testCorRaca2()
    {
        $this->assertEquals('Etnia inexistente.', self::getInstanceOf()->corRaca(self::ETNIA_INEXISTENTE));
    }

    public function testCorRaca3()
    {
        $this->assertObjectHasAttribute('codigoEtnia', self::getInstanceOf()->corRaca(self::ETNIA_EXISTENTE));
    }

    public function testCorRacaWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->corRacaWithoutCache());
    }

    public function testCorRacaWithoutCache2()
    {
        $this->assertEquals('Etnia inexistente.', self::getInstanceOf()->corRacaWithoutCache(self::ETNIA_INEXISTENTE));
    }

    public function testCorRacaWithoutCache3()
    {
        $this->assertObjectHasAttribute('codigoEtnia', self::getInstanceOf()->corRacaWithoutCache(self::ETNIA_EXISTENTE));
    }

    public function testEtnia1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->etnia());
    }

    public function testEtnia2()
    {
        $this->assertEquals('Etnia inexistente.', self::getInstanceOf()->etnia(self::ETNIA_INEXISTENTE));
    }

    public function testEtnia3()
    {
        $this->assertObjectHasAttribute('codigoEtnia', self::getInstanceOf()->etnia(self::ETNIA_EXISTENTE));
    }

    public function testEtniaWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->etniaWithoutCache());
    }

    public function testEtniaWithoutCache2()
    {
        $this->assertEquals('Etnia inexistente.', self::getInstanceOf()->etniaWithoutCache(self::ETNIA_INEXISTENTE));
    }

    public function testEtniaWithoutCache3()
    {
        $this->assertObjectHasAttribute('codigoEtnia', self::getInstanceOf()->etniaWithoutCache(self::ETNIA_EXISTENTE));
    }

}