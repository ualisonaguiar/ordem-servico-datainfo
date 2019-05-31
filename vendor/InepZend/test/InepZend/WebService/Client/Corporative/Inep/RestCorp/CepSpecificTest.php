<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class CepSpecificTest extends AbstractRestCorpTest
{
    const NU_CEP = 70340909;

    public function testCep1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cep(self::NU_CEP));
    }

    public function testCep2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cep());
    }

    public function testCepWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cepWithoutCache(self::NU_CEP));
    }

    public function testCepWithoutCache2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cepWithoutCache());
    }

    public function testSolicitarDadosPorCep1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorCep(self::NU_CEP));
    }

    public function testSolicitarDadosPorCep2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorCep());
    }

    public function testSolicitarDadosPorCepWithoutCache1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorCepWithoutCache(self::NU_CEP));
    }

    public function testSolicitarDadosPorCepWithoutCache2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorCepWithoutCache());
    }
}