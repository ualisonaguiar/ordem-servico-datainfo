<?php

namespace InepZend\WebService\Client\Corporative\Mpog;

use InepZend\WebService\Client\Corporative\Mpog\Mpog;
use InepZend\UnitTest\AbstractUnitTest;

class MpogSpecificTest extends AbstractUnitTest
{

    const NAMESPACE_MPOG = 'InepZend\WebService\Client\Corporative\Mpog\Mpog';

    protected $arrDadosFuncionais = array(
        'dadosFuncionais' => array
        (
            'DadosFuncionais' => array
            (
                'codAtivFun'                   => '',
                'codCargo'                     => '468001',
                'codClasse'                    => 'A',
                'codFuncao'                    => '',
                'codJornada'                   => '40',
                'codNovaFuncao'                => '',
                'codOcorrAposentadoria'        => '',
                'codOcorrExclusao'             => '',
                'codOcorrIngressoOrgao'        => '01100',
                'codOcorrIngressoServPublico'  => '01001',
                'codOcorrIsencaoIR'            => '',
                'codOcorrPSS'                  => '',
                'codOrgao'                     => '26107',
                'codPadrao'                    => 'I',
                'codSitFuncional'              => '01',
                'codUorgExercicio'             => '000000173',
                'codUorgLotacao'               => '000000173',
                'codUpag'                      => '26107000000173',
                'codValeTransporte'            => '',
                'cpfChefiaImediata'            => '34276890187',
                'dataFimOcorrIsencaoIR'        => '',
                'dataFimOcorrPSS'              => '',
                'dataFimValeAR'                => '',
                'dataIngressoFuncao'           => '',
                'dataIngressoNovaFuncao'       => '',
                'dataIniOcorrIsencaoIR'        => '',
                'dataIniOcorrPSS'              => '',
                'dataIniValeAR'                => '23092014',
                'dataOcorrAposentadoria'       => '',
                'dataOcorrExclusao'            => '',
                'dataOcorrIngressoOrgao'       => '23092014',
                'dataOcorrIngressoServPublico' => '17092014',
                'emailChefiaImediata'          => 'ANTONIO.SANTOS@INEP.GOV.BR',
                'emailServidor'                => 'VALDEVINO@GMAIL.COM',
                'identUnica'                   => '015525181',
                'matriculaSiape'               => '1552518',
                'nomeAtivFun'                  => '',
                'nomeCargo'                    => 'PESQ TECNOLOGISTA EM INFORMACOES',
                'nomeChefeUorg'                => 'ANTONIO DE MELO SANTOS',
                'nomeClasse'                   => 'CLASSE A/UNICA',
                'nomeFuncao'                   => '',
                'nomeJornada'                  => '40 HORAS SEMANAIS',
                'nomeNovaFuncao'               => '',
                'nomeOcorrAposentadoria'       => '',
                'nomeOcorrExclusao'            => '',
                'nomeOcorrIngressoOrgao'       => 'NOMEACAO CARATER EFETIVO,ART.9,ITEM I ,LEI 8112/90',
                'nomeOcorrIngressoServPublico' => 'ADMISSAO POR CONCURSO PUBLICO',
                'nomeOcorrIsencaoIR'           => '',
                'nomeOcorrPSS'                 => '',
                'nomeOrgao'                    => 'INST.NACIONAL DE EST.E PESQ.EDUCACIONAIS',
                'nomeRegimeJuridico'           => 'ESTATUTARIO',
                'nomeSitFuncional'             => 'ATIVO PERMANENTE',
                'nomeUorgExercicio'            => 'COORDENACAO-GERAL DE RECURSOS LOGISTICOS',
                'nomeUorgLotacao'              => 'COORDENACAO-GERAL DE RECURSOS LOGISTICOS',
                'nomeUpag'                     => 'COORDENACAO-GERAL DE RECURSOS LOGISTICOS',
                'percentualTS'                 => '0,00',
                'pontuacaoDesempenho'          => '',
                'siglaOrgao'                   => 'INEP',
                'siglaRegimeJuridico'          => 'EST',
                'siglaUorgExercicio'           => 'CGRL',
                'siglaUorgLotacao'             => 'CGRL',
                'siglaUpag'                    => 'CGRL',
                'tipoValeAR'                   => '',
                'valorValeTransporte'          => ''
            )
        )
    );
    protected $arrDadosPessoais = array(
        'codCor'            => '1',
        'codDefFisica'      => '',
        'codEstadoCivil'    => '2',
        'codNacionalidade'  => '1',
        'codSexo'           => 'M',
        'dataChegBrasil'    => '',
        'dataNascimento'    => '23041977',
        'grupoSanguineo'    => 'A+',
        'nome'              => 'VALDEVINO SIQUEIRA CAMPOS NETO',
        'nomeCor'           => 'BRANCA',
        'nomeDefFisica'     => '',
        'nomeEstadoCivil'   => 'CASADO',
        'nomeMae'           => 'MARIA BENEDITA CAMPOS',
        'nomeMunicipNasc'   => 'PARAISOPOLIS',
        'nomeNacionalidade' => 'BRASILEIRO NATO',
        'nomePai'           => 'ANTONIO SIQUEIRA CAMPOS',
        'nomePais'          => '',
        'nomeSexo'          => 'MASCULINO',
        'numPisPasep'       => '18000644423',
        'ufNascimento'      => 'MG'
    );
    protected $arrDadosDocumentacao = array(
        'categoriaCarteiraMotorista'     => '',
        'dataCarteiraIdentidade'         => '19051992',
        'dataComprovanteMilitar'         => '',
        'dataExpedicaoCarteiraMotorista' => '',
        'dataPrimExpedCarteiraMotorista' => '',
        'dataTituloEleitor'              => '24051994',
        'dataValidadeCarteiraMotorista'  => '',
        'numCPF'                         => '94865353615',
        'numPisPasep'                    => '18000644423',
        'numeroCarteiraIdentidade'       => '286289209',
        'numeroCarteiraMotorista'        => '0',
        'numeroCarteiraTrabalho'         => '00000000000',
        'numeroComprovanteMilitar'       => '',
        'numeroTituloEleitor'            => '113917210205',
        'orgaoCarteiraIdentidade'        => 'SSP',
        'orgaoComprovanteMilitar'        => 'MEX',
        'passaporte'                     => '',
        'registroCarteiraMotorista'      => '0',
        'secaoTituloEleitor'             => '0051',
        'serieCarteiraTrabalho'          => '',
        'serieComprovanteMilitar'        => '13',
        'ufCarteiraIdentidade'           => 'SP',
        'ufCarteiraMotorista'            => '',
        'ufCarteiraTrabalho'             => '',
        'ufTituloEleitor'                => 'MG',
        'zonaTituloEleitor'              => '205'
    );
    protected $arrDadosEscolares = array(
        'arrayCursos'      => array(
            'DadosCurso' => array(
                'codCurso'  => '0086',
                'nomeCurso' => 'CIENCIA DA COMPUTACAO'
            )
        ),
        'arrayTitulacao'   => null,
        'codEscolaridade'  => '10',
        'nomeEscolaridade' => 'ENSINO SUPERIOR'
    );
    protected $arrDadosUorg = array(
        'uorgs' => array
        (
            'DadosUorg' => array
            (
                'bairroUorg'        => 'SIG',
                'cepUorg'           => '70610908',
                'codMatricula'      => '1552518',
                'codMunicipioUorg'  => '9701',
                'codOrgao'          => '26107',
                'codOrgaoUorg'      => '26107000000173',
                'complementoUorg'   => 'EDIFICIO VILLA LOBOS',
                'emailUorg'         => 'JOSE.SOARES@INEP.GOV.BR',
                'endUorg'           => 'ENDERECO PRINCIPAL',
                'logradouroUorg'    => 'SIG QUADRA 4',
                'nomeMunicipioUorg' => 'BRASILIA',
                'nomeUorg'          => 'COORDENACAO-GERAL DE RECURSOS LOGISTICOS',
                'numFaxUorg'        => '0061 20223601',
                'numTelefoneUorg'   => '0061 20223601 3601',
                'numeroUorg'        => '327',
                'siglaUorg'         => 'CGRL',
                'ufUorg'            => 'DF'
            )
        )
    );
    protected $arrDadosEnderecoResidencial = array(
        'bairro'        => 'SUDOESTE',
        'cep'           => '70680500',
        'codMunicipio'  => '9701',
        'complemento'   => 'APT. ED. MONT SERRAT',
        'dddTelefone'   => '61',
        'logradouro'    => 'QMSW 05 LOTE 03 BLOCO G',
        'nomeMunicipio' => 'BRASILIA',
        'numTelefone'   => '951267089',
        'numero'        => '221',
        'uf'            => 'DF'
    );
    protected $arrDadosDependentes = array(
        'dadosDependentes' => array
        (
            'DadosDependentes' => array
            (
                'arrayBeneficios'    => array
                (
                    'Beneficio' => null //$arrBeneficios
                ),
                'codCondicao'        => '32',
                'codGrauParentesco'  => '005',
                'codOrgao'           => '26107',
                'cpf'                => '02859186646',
                'matricula'          => '1552518',
                'nome'               => 'SUELY REGINA DE SOUSA',
                'nomeCondicao'       => null,
                'nomeGrauParentesco' => 'CONJUGE'
            )
        )
    );
    protected $arrBeneficios = array(
        array
        (
            'codBeneficio'  => '11',
            'dataFim'       => '00000000',
            'dataInicio'    => '23092014',
            'nomeBeneficio' => 'ACOMPANHAM PESSOA DA FAMILIA'
        ),
        array
        (
            'codBeneficio'  => '05',
            'dataFim'       => '00000000',
            'dataInicio'    => '23092014',
            'nomeBeneficio' => 'ASSIST A SAUDE SUPLEMENTAR'
        )
    );
    protected $arrDadosBancarios = array(
        'dadosBancarios' => array
        (
            'DadosBancarios' => array
            (
                'agencia'       => '035971',
                'banco'         => '001',
                'codOrgao'      => '26107',
                'contaCorrente' => '0000000359270',
                'matricula'     => '1552518'
            )
        )
    );
    protected $arrDadosFinanceiros = array(
        'dadosFinanceiros' => array
        (
            'DadosFinanceiros' => null //$arrDadosFin
        ),
        'mesAnoPagamento'  => 'DEZ2014'
    );
    protected $arrDadosFin = array(
        array
        (
            'codRubrica'        => '00001',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => 'G',
            'indicadorRD'       => 'R',
            'nomeRubrica'       => 'VENCIMENTO BASICO             ',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '3.941,15      '
        ),
        array
        (
            'codRubrica'        => '00136',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'R',
            'nomeRubrica'       => 'AUXILIO-ALIMENTACAO           ',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '373,00        '
        ),
        array
        (
            'codRubrica'        => '82518',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'R',
            'nomeRubrica'       => 'GDIAE-ART. 62 MP 304/2006 AT  ',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '2.213,60      '
        ),
        array
        (
            'codRubrica'        => '82606',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'R',
            'nomeRubrica'       => 'RT - RETRIB. POR TITULACAO AT ',
            'numeroSeq'         => '1',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '944,00        '
        ),
        array
        (
            'codRubrica'        => '82737',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'R',
            'nomeRubrica'       => 'PER CAPITA - SAUDE SUPLEMENTAR',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '189,82        '
        ),
        array
        (
            'codRubrica'        => '98002',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'D',
            'nomeRubrica'       => 'CONT. PLANO SEGURIDADE SOCIAL ',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '482,92        '
        ),
        array
        (
            'codRubrica'        => '99001',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => 'D',
            'nomeRubrica'       => 'IMPOSTO DE RENDA RETIDO FONTE ',
            'numeroSeq'         => '0',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '993,20        ',
        ),
        array
        (
            'codRubrica'        => '99997',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => ' ',
            'nomeRubrica'       => 'BRUTO :                       ',
            'numeroSeq'         => ' ',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '7.661,57      '
        ),
        array
        (
            'codRubrica'        => '99998',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => ' ',
            'nomeRubrica'       => 'DESCONTO :                    ',
            'numeroSeq'         => ' ',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => '1.476,12      '
        ),
        array
        (
            'codRubrica'        => '99999',
            'dataAnoMesRubrica' => '',
            'indicadorMovSupl'  => '',
            'indicadorRD'       => ' ',
            'nomeRubrica'       => '',
            'numeroSeq'         => ' ',
            'peRubrica'         => '0    ',
            'pzRubrica'         => '000',
            'valorRubrica'      => ''
        )
    );

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_MPOG, self::getInstanceOf());
    }

    public function testConsultaDadosFuncionais1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosFuncionais('94865353615', 'LO9JROC5'));
    }

//     public function testConsultaDadosFuncionais2()
//     {
//         $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosFuncionais('05922176633', 'LO9JROC5'));
//     }

    public function testConsultaDadosFuncionais3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosFuncionais('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosFuncionais4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosFuncionais('94865353615', ''));
    }

//     public function testConsultaDadosFuncionais5()
//     {
//         $this->assertObjectHasAttribute('dadosFuncionais', self::getInstanceOf()->consultaDadosFuncionais('94865353615', 'LO9JROC5'));
//     }

    public function testConsultaDadosPessoais1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosPessoais('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosPessoais2()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosPessoais('05922176633', 'LO9JROC5'));
    }

    public function testConsultaDadosPessoais3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosPessoais('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosPessoais4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosPessoais('94865353615', ''));
    }

    public function testConsultaDadosDocumentacao1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosDocumentacao('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosDocumentacao2()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosDocumentacao('05922176633', 'LO9JROC5'));
    }

    public function testConsultaDadosDocumentacao3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosDocumentacao('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosDocumentacao4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosDocumentacao('94865353615', ''));
    }

    public function testConsultaDadosEscolares1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosEscolares('94865353615', 'LO9JROC5'));
    }

//     public function testConsultaDadosEscolares2()
//     {
//         $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosEscolares('05922176633', 'LO9JROC5'));
//     }

    public function testConsultaDadosEscolares3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosEscolares('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosEscolares4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosEscolares('94865353615', ''));
    }

    public function testConsultaDadosUorg1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosUorg('94865353615', 'LO9JROC5'));
    }

//     public function testConsultaDadosUorg2()
//     {
//         $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosUorg('05922176633', 'LO9JROC5'));
//     }

    public function testConsultaDadosUorg3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosUorg('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosUorg4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosUorg('94865353615', ''));
    }

//     public function testConsultaDadosUorg5()
//     {
//         $this->assertObjectHasAttribute('uorgs', self::getInstanceOf()->consultaDadosUorg('94865353615', 'LO9JROC5'));
//     }

    public function testConsultaDadosEnderecoResidencial1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosEnderecoResidencial('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosEnderecoResidencial2()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosEnderecoResidencial('05922176633', 'LO9JROC5'));
    }

    public function testConsultaDadosEnderecoResidencial3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosEnderecoResidencial('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosEnderecoResidencial4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosEnderecoResidencial('94865353615', ''));
    }

    public function testConsultaDadosDependentes1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosDependentes('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosDependentes2()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Servidor não localizado', self::getInstanceOf()->consultaDadosDependentes('05922176633', 'LO9JROC5'));
    }

    public function testConsultaDadosDependentes3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosDependentes('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosDependentes4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosDependentes('94865353615', ''));
    }

//     public function testConsultaDadosDependentes5()
//     {
//         $this->assertObjectHasAttribute('dadosDependentes', self::getInstanceOf()->consultaDadosDependentes('94865353615', 'LO9JROC5'));
//     }

    public function testConsultaDadosBancarios1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosBancarios('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosBancarios2()
    {
        $this->assertEquals('Falha ao acionar o serviço do WS! Não existem dados para consulta', self::getInstanceOf()->consultaDadosBancarios('05922176633', 'LO9JROC5'));
    }

    public function testConsultaDadosBancarios3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosBancarios('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosBancarios4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosBancarios('94865353615', ''));
    }

    public function testConsultaDadosBancarios5()
    {
        $this->assertObjectHasAttribute('dadosBancarios', self::getInstanceOf()->consultaDadosBancarios('94865353615', 'LO9JROC5'));
    }

    public function testConsultaDadosFinanceiros1()
    {
        $this->assertNotEmpty(self::getInstanceOf()->consultaDadosFinanceiros('94865353615', 'LO9JROC5'));
    }

//     public function testConsultaDadosFinanceiros2()
//     {
//         $this->assertEquals('Falha ao acionar o serviço do WS! Não existem dados para consulta', self::getInstanceOf()->consultaDadosFinanceiros('05922176633', 'LO9JROC5'));
//     }

    public function testConsultaDadosFinanceiros3()
    {
        $this->assertEquals('CPF inválido.', self::getInstanceOf()->consultaDadosFinanceiros('xxxx', 'LO9JROC5'));
    }

    public function testConsultaDadosFinanceiros4()
    {
        $this->assertEquals('Informar a senha da aplicação do MPOG.', self::getInstanceOf()->consultaDadosFinanceiros('94865353615', ''));
    }

    public function testConsultaDadosFinanceiros5()
    {
        $this->assertObjectHasAttribute('dadosFinanceiros', self::getInstanceOf()->consultaDadosFinanceiros('94865353615', 'LO9JROC5'));
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Mpog))
        {
            Mpog::setSystemName('Rede Nacional de Certificadores');
            Mpog::setSystemAcronym('RNC');
            self::setInstanceOf(new Mpog());
        }

        return self::getInstanceOf();
    }

}
