<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaFisica;
use InepZend\UnitTest\AbstractUnitTest;

class PessoaFisicaSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_PESSOAFISICA = 'InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaFisica';

    private $arrDadosResumidoPessoaFisica = array(
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'no_pessoa_rf'                    => 'VALDEVINO SIQUEIRA CAMPOS NETO',
                'nu_cpf_rf'                       => '94865353615',
                'no_mae_rf'                       => 'MARIA BENEDITA CAMPOS',
                'dt_nascimento_rf'                => '19770423',
                'sg_sexo_rf'                      => 'M',
//                 'sg_sexo_rf'                      => 'M',
//                'nu_titulo_eleitor_rf' => '0113917210205',
//                'st_indicador_estrangeiro_rf' => '0',
//                'co_pais_residente_exterior_rf' => '000 ',
//                'st_indicador_residente_ext_rf' => '2',
//                'no_pais_residente_exterior_rf' => '',
//                'st_cadastro_rf' => '0',
//                'nu_ano_obito_rf' => '',
//                'co_natureza_ocupacao_rf' => '',
//                'co_ocupacao_principal_rf' => '212',
//                'co_unidade_administrativa_rf' => '0110100',
//                'nu_ano_exercicio_ocupacao_rf' => '2017',
//                'dt_inscricao_atualizacao_cpf_rf' => '20160419',
//                'nu_rg' => '',
//                'dt_emissao_rg' => '',
//                'ds_orgao_expedidor_rg' => '',
//                'dt_cadastro' => '20130618193320',
                'nu_titulo_eleitor_rf'            => null,
                'st_indicador_estrangeiro_rf'     => null,
                'co_pais_residente_exterior_rf'   => null,
                'st_indicador_residente_ext_rf'   => null,
                'no_pais_residente_exterior_rf'   => null,
                'st_cadastro_rf'                  => null,
                'nu_ano_obito_rf'                 => null,
                'co_natureza_ocupacao_rf'         => null,
                'co_ocupacao_principal_rf'        => null,
                'co_unidade_administrativa_rf'    => null,
                'nu_ano_exercicio_ocupacao_rf'    => null,
                'dt_inscricao_atualizacao_cpf_rf' => null,
                'nu_rg'                           => null,
                'dt_emissao_rg'                   => null,
                'ds_orgao_expedidor_rg'           => null,
                'dt_cadastro'                     => null,
            )
        )
    );

    private $arrDadosReceitaPorCpf = array(
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'no_pessoa_rf'                    => 'VALDEVINO SIQUEIRA CAMPOS NETO',
                'nu_cpf_rf'                       => '94865353615',
                'no_mae_rf'                       => 'MARIA BENEDITA CAMPOS',
                'dt_nascimento_rf'                => '19770423',
                'sg_sexo_rf'                      => 'M',
                'nu_titulo_eleitor_rf'            => '0113917210205',
                'st_indicador_estrangeiro_rf'     => '0',
                'co_pais_residente_exterior_rf'   => '000',
                'st_indicador_residente_ext_rf'   => '2',
                'no_pais_residente_exterior_rf'   => '',
                'st_cadastro_rf'                  => '0',
                'nu_ano_obito_rf'                 => '',
                'co_natureza_ocupacao_rf'         => '',
                'co_ocupacao_principal_rf'        => '212',
                'co_unidade_administrativa_rf'    => '0110100',
                'nu_ano_exercicio_ocupacao_rf'    => '2017',
                'dt_inscricao_atualizacao_cpf_rf' => '20160419',
                'nu_rg'                           => '',
                'dt_emissao_rg'                   => '',
                'ds_orgao_expedidor_rg'           => '',
                'dt_cadastro'                     => '',
                'ENDERECOS'                       => array
                (
                    'ENDERECO' => array
                    (
                        'nu_cpf_rf'               => '94865353615',
                        'co_cidade'               => '000000005300108',
                        'co_tipo_endereco_pessoa' => '1',
                        'sg_uf'                   => 'DF',
                        'ds_localidade'           => 'BRASILIA',
                        'ds_bairro'               => 'SUDOESTE',
                        'ds_logradouro'           => 'QMSW 5 LT 3 B',
                        'ds_logradouro_comp'      => 'APARTAMENTO',
                        'ds_numero'               => '121',
                        'nu_cep'                  => '70680511',
                        'ds_ponto_referencia'     => '',
                        'ds_tipo_logradouro'      => 'RUA'
                    )
                ),
                'CONTATOS'                        => array
                (
                    'CONTATO' => array
                    (
                        'nu_cpf_rf'              => '94865353615',
                        'co_tipo_contato_pessoa' => '1',
                        'ds_contato_pessoa'      => '0061-83702404'
                    )
                )
            )
        )
    );

    private $arrDadosPessoaFisicaPorCpf = array(
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'no_pessoa_rf'                    => 'VALDEVINO SIQUEIRA CAMPOS NETO',
                'nu_cpf_rf'                       => '94865353615',
                'no_mae_rf'                       => 'MARIA BENEDITA CAMPOS',
                'dt_nascimento_rf'                => '19770423',
                'sg_sexo_rf'                      => 'M',
                'nu_titulo_eleitor_rf'            => '0113917210205',
                'st_indicador_estrangeiro_rf'     => '0',
                'co_pais_residente_exterior_rf'   => '000 ',
                'st_indicador_residente_ext_rf'   => '2',
                'no_pais_residente_exterior_rf'   => '',
                'st_cadastro_rf'                  => '0',
                'nu_ano_obito_rf'                 => '',
                'co_natureza_ocupacao_rf'         => '',
                'co_ocupacao_principal_rf'        => '212',
                'co_unidade_administrativa_rf'    => '0110100',
                'nu_ano_exercicio_ocupacao_rf'    => '2017',
                'dt_inscricao_atualizacao_cpf_rf' => '20160419',
                'nu_rg'                           => '',
                'dt_emissao_rg'                   => '',
                'ds_orgao_expedidor_rg'           => '',
                'dt_cadastro'                     => '20130618193320',
                'ENDERECOS'                       => array
                (
                    'ENDERECO' => array
                    (
                        'nu_cpf_rf'               => '94865353615',
                        'co_cidade'               => '000000005300108',
                        'co_tipo_endereco_pessoa' => '1',
                        'sg_uf'                   => 'DF',
                        'ds_localidade'           => 'BRASILIA',
                        'ds_bairro'               => 'SUDOESTE',
                        'ds_logradouro'           => 'QMSW 5 LT 3 B',
                        'ds_logradouro_comp'      => 'APARTAMENTO',
                        'ds_numero'               => '121',
                        'nu_cep'                  => '70680511',
                        'ds_ponto_referencia'     => '',
                        'ds_tipo_logradouro'      => 'RUA'
                    )

                ),
                'CONTATOS'                        => array
                (
                    'CONTATO' => array
                    (
                        'nu_cpf_rf'              => '94865353615',
                        'co_tipo_contato_pessoa' => '1',
                        'ds_contato_pessoa'      => '0061-83702404'
                    )
                )
            )
        )
    );

    private $arrDadosEnderecoPessoaFisicaPorCpf = array(
        'RESPOSTA' => array
        (
            'ENDERECO' => array
            (
                'ENDERECO' => array
                (
                    'nu_cpf_rf'               => '94865353615',
                    'co_cidade'               => '000000005300108',
                    'co_tipo_endereco_pessoa' => '1',
                    'sg_uf'                   => 'DF',
                    'ds_localidade'           => 'BRASILIA',
                    'ds_bairro'               => 'SUDOESTE',
                    'ds_logradouro'           => 'QMSW 5 LT 3 B',
                    'ds_logradouro_comp'      => 'APARTAMENTO',
                    'ds_numero'               => '121',
                    'nu_cep'                  => '70680511',
                    'ds_ponto_referencia'     => '',
                    'ds_tipo_logradouro'      => 'RUA'
                )
            )
        )
    );

    private $arrDadosContatoPessoaFisicaPorCpf = array(
        'RESPOSTA' => array
        (
            'CONTATO' => array
            (
                'CONTATO' => array
                (
                    'nu_cpf_rf'              => '94865353615',
                    'co_tipo_contato_pessoa' => '1',
                    'ds_contato_pessoa'      => '0061-83702404'
                )
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
        $this->assertInstanceOf(self::NAMESPACE_PESSOAFISICA, self::getInstanceOf());
    }

//----------

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf2()
    {
        $this->assertEquals($this->arrDadosResumidoPessoaFisica, self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosResumidoPessoaFisicaPorCpf4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosResumidoPessoaFisicaPorCpf(''));
    }

//----------

    public function testSolicitarDadosReceitaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosReceitaPorCpf('94865353615'));
    }

    public function testSolicitarDadosReceitaPorCpf2()
    {
        $this->assertEquals($this->arrDadosReceitaPorCpf, self::getInstanceOf()->solicitarDadosReceitaPorCpf('94865353615'));
    }

    public function testSolicitarDadosReceitaPorCpf3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosReceitaPorCpf('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosReceitaPorCpf4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosReceitaPorCpf(''));
    }

//----------

    public function testSolicitarDadosPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosPessoaFisicaPorCpf2()
    {
        $this->assertEquals($this->arrDadosPessoaFisicaPorCpf, self::getInstanceOf()->solicitarDadosPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosPessoaFisicaPorCpf3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosPessoaFisicaPorCpf('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosPessoaFisicaPorCpf4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPessoaFisicaPorCpf(''));
    }

//----------

    public function testSolicitarDadosEnderecoPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosEnderecoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosEnderecoPessoaFisicaPorCpf2()
    {
        $this->assertEquals($this->arrDadosEnderecoPessoaFisicaPorCpf, self::getInstanceOf()->solicitarDadosEnderecoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosEnderecoPessoaFisicaPorCpf3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosEnderecoPessoaFisicaPorCpf('xxxx')['RESPOSTA']['ENDERECO']);
    }

    public function testSolicitarDadosEnderecoPessoaFisicaPorCpf4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosEnderecoPessoaFisicaPorCpf(''));
    }

//----------

    public function testSolicitarDadosContatoPessoaFisicaPorCpf1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosContatoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosContatoPessoaFisicaPorCpf2()
    {
        $this->assertEquals($this->arrDadosContatoPessoaFisicaPorCpf, self::getInstanceOf()->solicitarDadosContatoPessoaFisicaPorCpf('94865353615'));
    }

    public function testSolicitarDadosContatoPessoaFisicaPorCpf3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosContatoPessoaFisicaPorCpf('xxxx')['RESPOSTA']['CONTATO']);
    }

    public function testSolicitarDadosContatoPessoaFisicaPorCpf4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosContatoPessoaFisicaPorCpf(''));
    }

//----------

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof PessoaFisica))
            self::setInstanceOf(new PessoaFisica());

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