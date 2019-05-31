<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Corporative\ReceitaFederal\CertidaoConjunta;
use InepZend\UnitTest\AbstractUnitTest;

class CertidaoConjuntaSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_CERTIDAOCONJUNTA = 'InepZend\WebService\Client\Corporative\ReceitaFederal\CertidaoConjunta';

    private $arrEmitirCertidaoConjuntaPorCpf = array
    (
        'RESPOSTA' => array
        (
            'informa_existencia_certidao'     => 'S',
            'data_validade_certidao'          => '2016-01-02',
            'data_emissao_certidao'           => '2015-07-06 14:11:27',
            'codigo_controle_certidao'        => '6022CC490E1513C4',
            'ind_ni_certidao'                 => '2',
            'ni_certidao'                     => '00094865353615',
            'nome_contribuinte_certidao'      => 'VALDEVINO SIQUEIRA CAMPOS NETO
                                                               ',
            'ind_situacao_cadastral_certidao' => '0',
            'tipo_certidao'                   => '1',
            'obs_rfb_certidao'                => '',
            'obs_pgfn_certidao'               => '',
            'ind_observacao_certidao'         => '0',
            'cod_modelo_certidao'             => '1',
            'ind_exig_termo_arrol_certidao'   => '0',
            'ind_parc_certidao'               => '0',
            'ind_pend_prev'                   => '',
            'retorno_consulta_certidao'       => ''
        )
    );

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_CERTIDAOCONJUNTA, self::getInstanceOf());
    }

//----------

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCpf('94865353615'));
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCpf('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCpf(''));
    }

//    public function testSolicitarDadosResumidoPessoaFisicaPorCpf2()
//    {
//        $this->assertEquals($this->arrEmitirCertidaoConjuntaPorCpf, self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCpf('94865353615'));
//    }

//----------

    public function testConsultarEmitirCertidaoConjuntaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCnpj('01678363000143'));
    }

    public function testConsultarEmitirCertidaoConjuntaPorCnpj2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCnpj('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testConsultarEmitirCertidaoConjuntaPorCnpj3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCnpj(''));
    }

//----------

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultarEmitirCertidaoConjuntaReceitaPorCpf('94865353615'));
    }

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCpf2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->consultarEmitirCertidaoConjuntaReceitaPorCpf('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCpf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->consultarEmitirCertidaoConjuntaReceitaPorCpf(''));
    }

//----------

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultarEmitirCertidaoConjuntaReceitaPorCnpj('01678363000143'));
    }

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCnpj2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->consultarEmitirCertidaoConjuntaReceitaPorCnpj('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testConsultarEmitirCertidaoConjuntaReceitaPorCnpj3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->consultarEmitirCertidaoConjuntaPorCnpj(''));
    }

//----------

    public function testEmitirCertidaoConjuntaReceitaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCpf('94865353615'));
    }

    public function testEmitirCertidaoConjuntaReceitaPorCpf2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCpf('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testEmitirCertidaoConjuntaReceitaPorCpf3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCpf(''));
    }

//----------

    public function testEmitirCertidaoConjuntaReceitaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCnpj('01678363000143'));
    }

    public function testEmitirCertidaoConjuntaReceitaPorCnpj2()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCnpj('xxxx')['RESPOSTA']['CERTIDAO_CONJUNTA']);
    }

    public function testEmitirCertidaoConjuntaReceitaPorCnpj3()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->emitirCertidaoConjuntaReceitaPorCnpj(''));
    }

//----------

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof CertidaoConjunta))
            self::setInstanceOf(new CertidaoConjunta());

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