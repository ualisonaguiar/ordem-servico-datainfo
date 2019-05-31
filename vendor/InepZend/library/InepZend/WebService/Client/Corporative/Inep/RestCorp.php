<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Corporative\Inep\Rest;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\PessoaJuridicaContato;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\RestCorpTrait;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Cartorio;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Cep;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\CodigoBarra;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\CodigoSegurancaGru;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Cpf;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Distrito;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\EstadoCivil;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Etnia;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Municipio;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\OrgaoEmissor;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Pais;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Pessoa;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\PessoaContato;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\PessoaJuridica;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\PessoaJuridicaConta;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\PessoaJuridicaEndereco;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Programa;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Projeto;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Regiao;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Sms;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Email;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Sqi;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\SubDistrito;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\Uf;

class RestCorp extends Rest
{

    use RestCorpTrait,
        Cartorio, //cache
        Cep, //cache
        CodigoBarra, //cache
        CodigoSegurancaGru, //cache
        Cpf,
        Distrito, //cache
        EstadoCivil, //cache
        Etnia, //cache
        Municipio, //cache
        OrgaoEmissor, //cache
        Pais, //cache
        Pessoa,
        PessoaContato,
        PessoaJuridica,
        PessoaJuridicaConta,
        PessoaJuridicaContato,
        PessoaJuridicaEndereco,
        Programa,
        Projeto,
        Regiao, //cache
        Sms,
        Email,
        Sqi,
        SubDistrito, //cache
        Uf; //cache

    const URL_DESENV = 'http://desenvolvimento.inep.gov.br/restcorp/rest/';
    const URL_ENTREGA = 'http://entrega.inep.gov.br/restcorp/rest/';
    const URL_TQS = 'http://tqs.inep.gov.br/restcorp/rest/';
    const URL_HOMOLOGA = 'http://homologacao.inep.gov.br/restcorp/rest/';
    const URL_TREINAMENTO = 'http://200.130.24.31:9010/restcorp/rest/';
    const URL_CLONE_D1 = 'http://clone.inep.gov.br/restcorp/rest/';
    const URL = 'http://restcorp.dmzinep.gov.br/restcorp/rest/';

}
