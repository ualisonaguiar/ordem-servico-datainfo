<?php

namespace InepZend\WebService\Client\Corporative\Febraban;

use InepZend\WebService\Client\Corporative\Febraban\Febraban;
use InepZend\UnitTest\AbstractUnitTest;

class FebrabanSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_FEBRABAN = 'InepZend\WebService\Client\Corporative\Febraban\Febraban';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_FEBRABAN, self::getInstanceOf());
    }

    public function testRecuperarLista1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->recuperarLista());
    }

    public function testRecuperarPorId1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->recuperarPorId(1));
    }

    public function testRecuperarPorId2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->recuperarPorId());
    }

    public function testRecuperarPorNome1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->recuperarPorNome('Banco do Brasil S.A.'));
    }

    public function testRecuperarPorNome2()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->recuperarPorNome());
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Febraban))
            self::setInstanceOf(new Febraban());

        return self::getInstanceOf();
    }

    private function arrayToObject($array)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value)) $array[$key] = $this->arrayToObject($value);
        }

        return (object)$array;
    }
}