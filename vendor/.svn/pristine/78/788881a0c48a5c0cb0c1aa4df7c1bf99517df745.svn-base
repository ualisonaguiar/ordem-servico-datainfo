<?php

namespace InepZend\WebService\Client\Corporative\BancoDoBrasil;

use InepZend\WebService\Client\Corporative\BancoDoBrasil\AgenciasBb;
use InepZend\UnitTest\AbstractUnitTest;

class AgenciasBbSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_AGENCIASBB = 'InepZend\WebService\Client\Corporative\BancoDoBrasil\AgenciasBb';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_AGENCIASBB, self::getInstanceOf());
    }

    public function testGetMunicipio1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->getMunicipio(5300108, 10));
    }

    public function testGetMunicipio2()
    {
        $this->assertEmpty(self::getInstanceOf()->getMunicipio('xxx', 10)['RESPOSTA']);
    }

    public function testGetMunicipio3()
    {
        $this->assertEmpty(self::getInstanceOf()->getMunicipio()['RESPOSTA']);
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof AgenciasBb))
            self::setInstanceOf(new AgenciasBb());

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