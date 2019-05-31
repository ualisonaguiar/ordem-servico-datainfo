<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class MunicipioSpecificTest extends AbstractRestCorpTest
{
    const CO_MUNICIPIO_EXISTENTE = 5300108;
    const CO_MUNICIPIO_INEXISTENTE = 5300;

    const CO_DDD_EXISTENTE = 61;
    const CO_DDD_INEXISTENTE = 60;

    public function testMunicipio1()
    {
        $this->assertObjectHasAttribute('nomeMunicipio', self::getInstanceOf()->municipio(self::CO_MUNICIPIO_EXISTENTE));
    }

    public function testMunicipio2()
    {
        $this->assertEquals('Municipio inexistente.', self::getInstanceOf()->municipio(self::CO_MUNICIPIO_INEXISTENTE));
    }

    public function testMunicipio3()
    {
        $this->assertObjectHasAttribute('listaMunicipio', self::getInstanceOf()->municipio());
    }

    public function testMunicipioWithoutCache1()
    {
        $this->assertObjectHasAttribute('nomeMunicipio', self::getInstanceOf()->municipioWithoutCache(self::CO_MUNICIPIO_EXISTENTE));
    }

    public function testMunicipioWithoutCache2()
    {
        $this->assertEquals('Municipio inexistente.', self::getInstanceOf()->municipioWithoutCache(self::CO_MUNICIPIO_INEXISTENTE));
    }

    public function testMunicipioWithoutCache3()
    {
        $this->assertObjectHasAttribute('listaMunicipio', self::getInstanceOf()->municipioWithoutCache());
    }

    public function testMunicipioDdd1()
    {
        $this->assertObjectHasAttribute('listaMunicipioDdd', self::getInstanceOf()->municipioDdd(self::CO_DDD_EXISTENTE));
    }

    public function testMunicipioDdd2()
    {
        $this->assertObjectHasAttribute('listaMunicipioDdd', self::getInstanceOf()->municipioDdd(self::CO_DDD_INEXISTENTE));
    }

    public function testMunicipioDdd21()
    {
        $this->assertEmpty(self::getInstanceOf()->municipioDdd(self::CO_DDD_INEXISTENTE)->listaMunicipioDdd);
    }

    public function testMunicipioDddWithoutCache1()
    {
        $this->assertObjectHasAttribute('listaMunicipioDdd', self::getInstanceOf()->municipioDddWithoutCache(self::CO_DDD_EXISTENTE));
    }

    public function testMunicipioDddWithoutCache2()
    {
        $this->assertObjectHasAttribute('listaMunicipioDdd', self::getInstanceOf()->municipioDddWithoutCache(self::CO_DDD_INEXISTENTE));
    }

    public function testMunicipioDddWithoutCache21()
    {
        $this->assertEmpty(self::getInstanceOf()->municipioDddWithoutCache(self::CO_DDD_INEXISTENTE)->listaMunicipioDdd);
    }

}