<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class DistritoSpecificTest extends AbstractRestCorpTest
{
    const CO_DISTRITO = 530010805;
    const CO_DISTRITO_ERRADO = 530;
    const CO_MUNICIPIO = 5300108;
    const CO_MUNICIPIO_ERRADO = 530;

    public function testDistrito1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->distritos(self::CO_DISTRITO));
    }

    public function testDistrito2()
    {
        $this->assertEquals('Distrito inexistente.', self::getInstanceOf()->distritos(self::CO_DISTRITO_ERRADO));
    }

    public function testDistrito3()
    {
        $this->assertObjectHasAttribute('listaDistritos', self::getInstanceOf()->distritos());
    }

    public function testDistritosWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->distritosWithoutCache(self::CO_DISTRITO));
    }

    public function testDistritosWithoutCache2()
    {
        $this->assertEquals('Distrito inexistente.', self::getInstanceOf()->distritosWithoutCache(self::CO_DISTRITO_ERRADO));
    }

    public function testDistritosWithoutCache3()
    {
        $this->assertObjectHasAttribute('listaDistritos', self::getInstanceOf()->distritosWithoutCache());
    }

    public function testDistritosMunicipio1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->distritosMunicipio(self::CO_MUNICIPIO));
    }

    public function testDistritosMunicipio2()
    {
        $this->assertEmpty(self::getInstanceOf()->distritosMunicipio(self::CO_MUNICIPIO_ERRADO)->listaDistritos);
    }

    public function testDistritosMunicipio3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->distritosMunicipio());
    }

    public function testDistritosMunicipioWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->distritosMunicipioWithoutCache(self::CO_MUNICIPIO));
    }

    public function testDistritosMunicipioWithoutCache2()
    {
        $this->assertEmpty(self::getInstanceOf()->distritosMunicipioWithoutCache(self::CO_MUNICIPIO_ERRADO)->listaDistritos);
    }

    public function testDistritosMunicipioWithoutCache3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->distritosMunicipioWithoutCache());
    }

}