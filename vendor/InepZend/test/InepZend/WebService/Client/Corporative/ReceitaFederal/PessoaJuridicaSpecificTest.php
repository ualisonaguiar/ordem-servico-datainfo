<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaJuridica;
use InepZend\UnitTest\AbstractUnitTest;

class PessoaJuridicaSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_PESSOAJURIDICA = 'InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaJuridica';

    private $arrDadosResumidoPessoaJuridicaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'nu_cnpj_rf'                          => '01678363000143',
                'tp_estabelecimento_rf'               => '1',
                'no_empresarial_rf'                   => 'INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANISIO TEIXEIRA',
                'no_fantasia_rf'                      => 'INEP',
                'st_cadastral_rf'                     => '02',
                'dt_st_cadastral_rf'                  => '19980728',
                'no_cidade_exterior_rf'               => '',
                'co_codigo_pais_rf'                   => '   ',
                'no_pais_rf'                          => '',
                'co_natureza_juridica_rf'             => '1104',
                'dt_abertura_rf'                      => '19970214',
                'co_cnae_principal_rf'                => '8411600',
                'nu_cpf_responsavel_rf'               => '37474758849',
                'no_responsavel_rf'                   => 'MARIA INES FINI',
                'nu_capital_social_rf'                => '0',
                'tp_crc_contador_pj_rf'               => '',
                'nu_classificacao_crc_contador_pj_rf' => '',
                'nu_crc_contador_pj_rf'               => '000000',
                'sg_uf_crc_contador_pj_rf'            => '',
                'nu_cnpj_contador_rf'                 => '00000000000000',
                'tp_crc_contador_pf_rf'               => '',
                'nu_classificacao_crc_contador_pf_rf' => '',
                'nu_crc_contador_pf_rf'               => '000000',
                'sg_uf_crc_contador_pf_rf'            => '',
                'nu_cpf_contador_rf'                  => '00000000000',
                'ds_porte_rf'                         => '05',
                'ds_opcao_simples_rf'                 => 'N',
                'dt_opcao_simples_rf'                 => '00021130',
                'dt_exclusao_simples_rf'              => '00021130',
                'nu_cnpj_sucedida_rf'                 => '00000000000000',
                'dt_cadastro'                         => '20100715000000',
                'CNAESecundario'                      => '',
                'CNPJSucessora'                       => ''
            )
        )
    );

    private $arrDadosReceitaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'nu_cnpj_rf'                          => '01678363000143',
                'tp_estabelecimento_rf'               => '1',
                'no_empresarial_rf'                   => 'INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANISIO TEIXEIRA',
                'no_fantasia_rf'                      => 'INEP',
                'st_cadastral_rf'                     => '02',
                'dt_st_cadastral_rf'                  => '19980728',
                'no_cidade_exterior_rf'               => '',
                'co_codigo_pais_rf'                   => '',
                'no_pais_rf'                          => '',
                'co_natureza_juridica_rf'             => '1104',
                'dt_abertura_rf'                      => '19970214',
                'co_cnae_principal_rf'                => '8411600',
                'nu_cpf_responsavel_rf'               => '37474758849',
                'no_responsavel_rf'                   => 'MARIA INES FINI',
                'nu_capital_social_rf'                => '0',
                'tp_crc_contador_pj_rf'               => '',
                'nu_classificacao_crc_contador_pj_rf' => '',
                'nu_crc_contador_pj_rf'               => '000000',
                'sg_uf_crc_contador_pj_rf'            => '',
                'nu_cnpj_contador_rf'                 => '00000000000000',
                'tp_crc_contador_pf_rf'               => '',
                'nu_classificacao_crc_contador_pf_rf' => '',
                'nu_crc_contador_pf_rf'               => '000000',
                'sg_uf_crc_contador_pf_rf'            => '',
                'nu_cpf_contador_rf'                  => '00000000000',
                'ds_porte_rf'                         => '05',
                'ds_opcao_simples_rf'                 => 'N',
                'dt_opcao_simples_rf'                 => '00021130',
                'dt_exclusao_simples_rf'              => '00021130',
                'nu_cnpj_sucedida_rf'                 => '00000000000000',
                'dt_cadastro'                         => '',
                'CNAESecundario'                      => array
                (
                    'nu_cnae_secundario_rf' => ''
                ),
                'CNPJSucessora'                       => array
                (
                    'nu_cnpj_sucessora_rf' => ''
                ),
                'ENDERECOS'                           => array
                (
                    'ENDERECO' => array
                    (
                        'nu_cnpj_rf'              => '01678363000143',
                        'co_cidade'               => '000000005300108',
                        'co_tipo_endereco_pessoa' => '1',
                        'sg_uf'                   => 'DF',
                        'ds_localidade'           => 'BRASILIA',
                        'ds_bairro'               => 'SETOR DE INDUSTRIAS GRAFICAS',
                        'ds_logradouro'           => 'SIG QUADRA 4 LOTE 327',
                        'ds_logradouro_comp'      => 'EDIF  VILLA LOBOS',
                        'ds_numero'               => '327',
                        'nu_cep'                  => '70610440',
                        'ds_ponto_referencia'     => '',
                        'ds_tipo_logradouro'      => 'SETOR'
                    )
                ),
                'CONTATOS'                            => array
                (
                    'CONTATO' => array
                    (
                        '0' => array
                        (
                            'nu_cnpj_rf'             => '01678363000143',
                            'co_tipo_contato_pessoa' => '4',
                            'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                        ),
                        '1' => array
                        (
                            'nu_cnpj_rf'             => '01678363000143',
                            'co_tipo_contato_pessoa' => '1',
                            'ds_contato_pessoa'      => '61-20223256'
                        )
                    )
                ),
                'SOCIOS'                              => array
                (
                    'SOCIO' => array
                    (
                        '0' => array
                        (
                            'nu_socio_rf'                   => '00005923746883',
                            'tp_socio_rf'                   => '2',
                            'no_socio_rf'                   => 'MARIA HELENA GUIMARAES DE CASTRO',
                            'nu_percentual_participacao_rf' => '000.00',
                            'co_pais_origem_rf'             => '',
                            'no_pais_origem_rf'             => ''
                        ),
                        '1' => array
                        (
                            'nu_socio_rf'                   => '00394445000101',
                            'tp_socio_rf'                   => '1',
                            'no_socio_rf'                   => 'MINISTERIO DA EDUCACAO',
                            'nu_percentual_participacao_rf' => '000.00',
                            'co_pais_origem_rf'             => '',
                            'no_pais_origem_rf'             => ''
                        )
                    )
                )
            )
        )
    );

    private $arrDadosPessoaJuridicaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'PESSOA' => array
            (
                'nu_cnpj_rf'                          => '01678363000143',
                'tp_estabelecimento_rf'               => '1',
                'no_empresarial_rf'                   => 'INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANISIO TEIXEIRA',
                'no_fantasia_rf'                      => 'INEP',
                'st_cadastral_rf'                     => '02',
                'dt_st_cadastral_rf'                  => '19980728',
                'no_cidade_exterior_rf'               => '',
                'co_codigo_pais_rf'                   => '   ',
                'no_pais_rf'                          => '',
                'co_natureza_juridica_rf'             => '1104',
                'dt_abertura_rf'                      => '19970214',
                'co_cnae_principal_rf'                => '8411600',
                'nu_cpf_responsavel_rf'               => '37474758849',
                'no_responsavel_rf'                   => 'MARIA INES FINI',
                'nu_capital_social_rf'                => '0',
                'tp_crc_contador_pj_rf'               => '',
                'nu_classificacao_crc_contador_pj_rf' => '',
                'nu_crc_contador_pj_rf'               => '000000',
                'sg_uf_crc_contador_pj_rf'            => '',
                'nu_cnpj_contador_rf'                 => '00000000000000',
                'tp_crc_contador_pf_rf'               => '',
                'nu_classificacao_crc_contador_pf_rf' => '',
                'nu_crc_contador_pf_rf'               => '000000',
                'sg_uf_crc_contador_pf_rf'            => '',
                'nu_cpf_contador_rf'                  => '00000000000',
                'ds_porte_rf'                         => '05',
                'ds_opcao_simples_rf'                 => 'N',
                'dt_opcao_simples_rf'                 => '00021130',
                'dt_exclusao_simples_rf'              => '00021130',
                'nu_cnpj_sucedida_rf'                 => '00000000000000',
                'dt_cadastro'                         => '20100715000000',
                'CNAESecundario'                      => '',
                'CNPJSucessora'                       => '',
                'ENDERECOS'                           => array
                (
                    'ENDERECO' => array
                    (
                        'nu_cnpj_rf'              => '01678363000143',
                        'co_cidade'               => '000000005300108',
                        'co_tipo_endereco_pessoa' => '1',
                        'sg_uf'                   => 'DF',
                        'ds_localidade'           => 'SIG QUADRA 4 LOTE 327',
                        'ds_bairro'               => 'SETOR DE INDUSTRIAS GRAFICAS',
                        'ds_logradouro'           => 'SIG QUADRA 4 LOTE 327',
                        'ds_logradouro_comp'      => 'EDIF  VILLA LOBOS',
                        'ds_numero'               => '327',
                        'nu_cep'                  => '70610440',
                        'ds_ponto_referencia'     => '',
                        'ds_tipo_logradouro'      => 'SETOR'
                    )
                ),
                'CONTATOS'                            => array
                (
                    'CONTATO' => array
                    (
                        'nu_cnpj_rf'             => '01678363000143',
                        'co_tipo_contato_pessoa' => '4',
                        'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                    )

                ),
                'SOCIOS'                              => array
                (
                    'SOCIO' => array
                    (
                        'nu_socio_rf'                   => '00394445000101',
                        'tp_socio_rf'                   => '1',
                        'no_socio_rf'                   => 'MINISTERIO DA EDUCACAO',
                        'nu_percentual_participacao_rf' => '0.00',
                        'co_pais_origem_rf'             => '',
                        'no_pais_origem_rf'             => ''
                    )
                )
            )
        )
    );

    private $arrDadosEnderecoPessoaJuridicaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'ENDERECOS' => array
            (
                'ENDERECO' => array
                (
                    'nu_cnpj_rf'              => '01678363000143',
                    'co_cidade'               => '000000005300108',
                    'co_tipo_endereco_pessoa' => '1',
                    'sg_uf'                   => 'DF',
                    'ds_localidade'           => 'SIG QUADRA 4 LOTE 327',
                    'ds_bairro'               => 'SETOR DE INDUSTRIAS GRAFICAS',
                    'ds_logradouro'           => 'SIG QUADRA 4 LOTE 327',
                    'ds_logradouro_comp'      => 'EDIF  VILLA LOBOS',
                    'ds_numero'               => '327',
                    'nu_cep'                  => '70610440',
                    'ds_ponto_referencia'     => '',
                    'ds_tipo_logradouro'      => 'SETOR'
                )
            )
        )
    );

    private $arrDadosContatoPessoaJuridicaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'CONTATOS' => array
            (
                'CONTATO' => array
                (
                    '0' => array
                    (
                        'nu_cnpj_rf'             => '01678363000143',
                        'co_tipo_contato_pessoa' => '4',
                        'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                    ),
                    '1' => array
                    (
                        'nu_cnpj_rf'             => '01678363000143',
                        'co_tipo_contato_pessoa' => '4',
                        'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                    ),
                    '2' => array
                    (
                        'nu_cnpj_rf'             => '01678363000143',
                        'co_tipo_contato_pessoa' => '4',
                        'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                    ),
                    '3' => array
                    (
                        'nu_cnpj_rf'             => '01678363000143',
                        'co_tipo_contato_pessoa' => '4',
                        'ds_contato_pessoa'      => 'renato.cruz@inep.gov.br'
                    )
                )
            )
        )
    );

    private $arrDadosSocioPessoaJuridicaPorCnpj = array
    (
        'RESPOSTA' => array
        (
            'SOCIOS' => array
            (
                'SOCIO' => array
                (
                    '0' => array
                    (
                        'nu_socio_rf'                   => '00394445000101',
                        'tp_socio_rf'                   => '1',
                        'no_socio_rf'                   => 'MINISTERIO DA EDUCACAO',
                        'nu_percentual_participacao_rf' => '0.00',
                        'co_pais_origem_rf'             => '',
                        'no_pais_origem_rf'             => ''
                    ),
                    '1' => array
                    (
                        'nu_socio_rf'                   => '00394445000101',
                        'tp_socio_rf'                   => '1',
                        'no_socio_rf'                   => 'MINISTERIO DA EDUCACAO',
                        'nu_percentual_participacao_rf' => '0.00',
                        'co_pais_origem_rf'             => '',
                        'no_pais_origem_rf'             => ''
                    )
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
        $this->assertInstanceOf(self::NAMESPACE_PESSOAJURIDICA, self::getInstanceOf());
    }

//----------

    public function testSolicitarDadosResumidoPessoaJuridicaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosResumidoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosResumidoPessoaJuridicaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosResumidoPessoaJuridicaPorCnpj, self::getInstanceOf()->solicitarDadosResumidoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosResumidoPessoaJuridicaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosResumidoPessoaJuridicaPorCnpj('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosResumidoPessoaJuridicaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosResumidoPessoaJuridicaPorCnpj(''));
    }

//----------

    public function testSolicitarDadosReceitaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosReceitaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosReceitaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosReceitaPorCnpj, self::getInstanceOf()->solicitarDadosReceitaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosReceitaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosReceitaPorCnpj('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosReceitaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosReceitaPorCnpj(''));
    }

//----------

    public function testSolicitarDadosPessoaJuridicaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosPessoaJuridicaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosPessoaJuridicaPorCnpj, self::getInstanceOf()->solicitarDadosPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosPessoaJuridicaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosPessoaJuridicaPorCnpj('xxxx')['RESPOSTA']['PESSOA']);
    }

    public function testSolicitarDadosPessoaJuridicaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosPessoaJuridicaPorCnpj(''));
    }

//----------

    public function testSolicitarDadosEnderecoPessoaJuridicaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosEnderecoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosEnderecoPessoaJuridicaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosEnderecoPessoaJuridicaPorCnpj, self::getInstanceOf()->solicitarDadosEnderecoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosEnderecoPessoaJuridicaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosEnderecoPessoaJuridicaPorCnpj('xxxx')['RESPOSTA']['ENDERECOS']);
    }

    public function testSolicitarDadosEnderecoPessoaJuridicaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosEnderecoPessoaJuridicaPorCnpj(''));
    }

//----------

    public function testSolicitarDadosContatoPessoaJuridicaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosContatoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosContatoPessoaJuridicaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosContatoPessoaJuridicaPorCnpj, self::getInstanceOf()->solicitarDadosContatoPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosContatoPessoaJuridicaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosContatoPessoaJuridicaPorCnpj('xxxx')['RESPOSTA']['CONTATOS']);
    }

    public function testSolicitarDadosContatoPessoaJuridicaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosContatoPessoaJuridicaPorCnpj(''));
    }

//----------

    public function testSolicitarDadosSocioPessoaJuridicaPorCnpj1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->solicitarDadosSocioPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosSocioPessoaJuridicaPorCnpj2()
    {
        $this->assertEquals($this->arrDadosSocioPessoaJuridicaPorCnpj, self::getInstanceOf()->solicitarDadosSocioPessoaJuridicaPorCnpj('01678363000143'));
    }

    public function testSolicitarDadosSocioPessoaJuridicaPorCnpj3()
    {
        $this->assertarrayHasKey('ERRO', self::getInstanceOf()->solicitarDadosSocioPessoaJuridicaPorCnpj('xxxx')['RESPOSTA']['SOCIOS']);
    }

    public function testSolicitarDadosSocioPessoaJuridicaPorCnpj4()
    {
        $this->assertEquals('Parâmetro(s) não informado(s)!', self::getInstanceOf()->solicitarDadosSocioPessoaJuridicaPorCnpj(''));
    }

//----------

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof PessoaJuridica))
            self::setInstanceOf(new PessoaJuridica());

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