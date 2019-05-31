<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Corporative\Inep\Rest;
use InepZend\WebService\Client\Corporative\Inep\RestCcp\RestCcpTrait;
use InepZend\WebService\Client\Corporative\Inep\RestCcp\OrdemServico;
use InepZend\WebService\Client\Corporative\Inep\RestCcp\Projeto;
use InepZend\WebService\Client\Corporative\Inep\RestCcp\Requisito;
use InepZend\WebService\Client\Corporative\Inep\RestCcp\Iteracao;

class RestCcp extends Rest
{

    use RestCcpTrait,
        OrdemServico,
        Projeto,
        Requisito,
        Iteracao;

    const URL_DESENV = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL_ENTREGA = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL_TQS = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL_HOMOLOGA = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL_TREINAMENTO = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL_CLONE_D1 = 'http://sistemasccp.inep.gov.br/CCP/rest/';
    const URL = 'http://sistemasccp.inep.gov.br/CCP/rest/';

}
