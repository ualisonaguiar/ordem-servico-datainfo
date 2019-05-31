<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp\AbstractRestCorpTest;

class CpfSpecificTest extends AbstractRestCorpTest
{

    const CPF = 94865353615;

    public function testCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cpf(self::CPF));
    }

    public function testCpf2()
    {
        $this->assertObjectHasAttribute('cpf', self::getInstanceOf()->cpf(self::CPF));
    }

    public function testCpf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cpf());
    }

    public function testCpfInterno1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cpfInterno(self::CPF));
    }

    public function testCpfInterno3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cpfInterno());
    }

    public function testCpfReceita1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->cpfReceita(self::CPF));
    }

    public function testCpfReceita2()
    {
        $this->assertObjectHasAttribute('cpf', self::getInstanceOf()->cpfReceita(self::CPF));
    }

    public function testCpfReceita3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->cpfReceita());
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf(self::CPF));
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf2()
    {
        $this->assertArrayHasKey('RESPOSTA', self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf(self::CPF));
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf());
    }

}
