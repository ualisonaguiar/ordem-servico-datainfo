<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class CartorioSpecificTest extends AbstractRestCorpTest
{
    const ID_CARTORIO = 1;
    const ID_MUNICIPIO = 2916302;

    public function testCartorios1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cartorios(self::ID_CARTORIO));
    }

    public function testCartorios2()
    {
        $this->assertObjectHasAttribute('cartorios', self::getInstanceOf()->cartorios(self::ID_CARTORIO));
    }

    public function testCartorios3()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Read timed out after 10 seconds', self::getInstanceOf()->cartorios());
    }

    public function testCartoriosWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cartoriosWithoutCache(self::ID_CARTORIO));
    }

    public function testCartoriosWithoutCache2()
    {
        $this->assertObjectHasAttribute('cartorios', self::getInstanceOf()->cartoriosWithoutCache(self::ID_CARTORIO));
    }

//     public function testCartoriosWithoutCache3()
//     {
//         $this->assertEquals('Falha ao acionar o serviço do WS! Read timed out after 10 seconds', self::getInstanceOf()->cartoriosWithoutCache());
//     }

    public function testCartoriosMunicipio1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cartoriosMunicipio(self::ID_MUNICIPIO));
    }

    public function testCartoriosMunicipio2()
    {
        $this->assertObjectHasAttribute('cartorios', self::getInstanceOf()->cartoriosMunicipio(self::ID_MUNICIPIO));
    }

    public function testCartoriosMunicipio3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cartoriosMunicipio());
    }

    public function testCartoriosMunicipioWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cartoriosMunicipioWithoutCache(self::ID_MUNICIPIO));
    }

    public function testCartoriosMunicipioWithoutCache2()
    {
        $this->assertObjectHasAttribute('cartorios', self::getInstanceOf()->cartoriosMunicipioWithoutCache(self::ID_MUNICIPIO));
    }

    public function testCartoriosMunicipioWithoutCache3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cartoriosMunicipioWithoutCache());
    }

}