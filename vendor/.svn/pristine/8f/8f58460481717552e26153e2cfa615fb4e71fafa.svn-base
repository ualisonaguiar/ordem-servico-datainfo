<?php

namespace InepZend\WebService\Client\Corporative\Correios;

use InepZend\WebService\Client\Corporative\Correios\Dne;
use InepZend\UnitTest\AbstractUnitTest;

class DneSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_DNE = 'InepZend\WebService\Client\Corporative\Correios\Dne';

    private $arrDadosPorCep = array
    (
        'RESPOSTA' => array
        (
            'STATUS'   => 'ok',
            'NODELIST' => array
            (
                'co_logradouro'             => '',
                'co_municipio'              => '5300108',
                'sg_uf'                     => '',
                'no_bairro'                 => 'Zona Industrial',
                'tipo_logradouro'           => 'Quadra',
                'no_logradouro'             => 'SIG Quadra 4',
                'no_logradouro_abrev'       => '',
                'no_complemento_logradouro' => '',
                'nu_cep'                    => '70610440',
                'co_ibge'                   => '5300108',
                'co_uf'                     => '53',
                'no_municipio'              => 'Brasília'
            )
        )
    );

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_DNE, self::getInstanceOf());
    }

    public function testSolicitarDadosPorCep1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorCep(70610440));
    }

    public function testSolicitarDadosPorCep2()
    {
        $this->assertEquals('ok', self::getInstanceOf()->solicitarDadosPorCep(70610440)['RESPOSTA']['STATUS']);
    }

    public function testSolicitarDadosPorCep3()
    {
        $this->assertEquals('empty', self::getInstanceOf()->solicitarDadosPorCep(7061044)['RESPOSTA']['STATUS']);
    }

    public function testSolicitarDadosPorCep4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorCep());
    }

    public function testSolicitarDadosPorCep5()
    {
        $this->assertEquals($this->arrDadosPorCep, self::getInstanceOf()->solicitarDadosPorCep(70610440));
    }

    public function testSolicitarDadosPorSgUf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorSgUf('AC'));
    }

    public function testSolicitarDadosPorSgUf2()
    {
        $this->assertEmpty(self::getInstanceOf()->solicitarDadosPorSgUf('AX')['RESPOSTA']);
    }

    public function testSolicitarDadosPorSgUf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorSgUf());
    }

    public function testSolicitarDadosPorCidade1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorCidade('AC', 'Acrelandia'));
    }

    public function testSolicitarDadosPorCidade2()
    {
        $this->assertEmpty(self::getInstanceOf()->solicitarDadosPorCidade('AC', 'Acrelandiaxxxxxx')['RESPOSTA']);
    }

    public function testSolicitarDadosPorCidade3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorCidade());
    }

    public function testSolicitarDadosPorBairro1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorBairro('AC', 'Acrelandia', 'Centro'));
    }

    public function testSolicitarDadosPorBairro2()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorBairro('AC', 'Acrelandia', 'xx')['RESPOSTA']);
    }

    public function testSolicitarDadosPorBairro3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorBairro());
    }

    public function testSolicitarDadosPorLogradouro1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorLogradouro('AC', 'Acrelandia', 'Centro', 'Acrelândia'));
    }

    public function testSolicitarDadosPorLogradouro2()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPorLogradouro('AC', 'Acrelandia', 'Centro', 'xx')['RESPOSTA']);
    }

    public function testSolicitarDadosPorLogradouro3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPorLogradouro());
    }

    public function testSolicitarDadosTipoLogradouro1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosTipoLogradouro());
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Dne))
            self::setInstanceOf(new Dne());

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