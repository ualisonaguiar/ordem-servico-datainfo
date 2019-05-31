<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Rest;
use InepZend\Paginator\Paginator;
use InepZend\Exception\InvalidArgumentException;
use Firebase\JWT\JWT;

class DemandasRest extends Rest
{
    
    const URL_DESENV = 'http://inepslimskeleton.local/';
//     const URL_DESENV = 'http://desenv.inep.gov.br/demandasrest/'; //@TODO
    const URL_ENTREGA = 'http://entrega.inep.gov.br/demandasrest/';
    const URL_TQS = 'http://tqs.inep.gov.br/demandasrest/';
    const URL_HOMOLOGA = 'http://homologa.inep.gov.br/demandasrest/';
    const URL_TREINAMENTO = 'http://treinamento.inep.gov.br/demandasrest/';
    const URL_CLONE_D1 = 'http://clone.inep.gov.br/demandasrest/';
    const URL = 'http://demandasrest.inep.gov.br/';
    
    private $strLdapLogin;
    private $strLdapPass;
    
    public function __construct($strLdapLogin = null, $strLdapPass = null)
    {
        $this->strLdapLogin = $strLdapLogin;
        $this->strLdapPass = $strLdapPass;
    }
    
    public function paginar($arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $intTotal = 0, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strSortName))
            $strSortName = 'dmdid';
        if (empty($strSortOrder))
            $strSortOrder = 'DESC';
        return $this->runService('demanda/' . __FUNCTION__ . '/' . $intPage . '/' . $intItemPerPage . '/' . base64_encode(json_encode((array) $arrCriteria)) . '/' . $intTotal . '/' . $strSortName . '/' . $strSortOrder, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function find($mixPk = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('demanda/find/' . $mixPk, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function save(array $arrData, array $arrSetterFk = array())
    {
        return $this->runService('demanda/salvar', $arrData, $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
    
    public function findByUsuario($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('usuario/findBy/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function findByHistoricodocumento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('historicodocumento/findBy/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsDescricaoLocalandaratendimento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('localandaratendimento/fetchPairsDescricao/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsMotivador($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('motivador/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsNivelAtendimento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('nivelatendimento/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsPrioridade($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('prioridade/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsSistemaDetalhe($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('sistemadetalhe/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsTipoServico($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('tiposervico/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsTipoAtendimento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('tipoatendimento/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsTipoDocumento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('tipodocumento/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsUnidadeAtendimento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('unidadeatendimento/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsGrupoDemanda($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('grupodemanda/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsOrigemDemanda($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('origemdemanda/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsOrigemGrupoDemanda($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('origemgrupodemanda/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsDescricaoOrigemGrupoDemanda($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('origemgrupodemanda/fetchPairsDescricao/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsCelula($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('celula/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsDescricaoCelula($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('celula/fetchPairsDescricao/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsSistemaCelula($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('sistemacelula/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsDescricaoSistemaCelula($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('sistemacelula/fetchPairsDescricao/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsUsuarioResponsabilidade($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('usuarioresponsabilidade/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsUsuario($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('usuario/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    public function findByDocumento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('documento/findBy/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    public function fetchPairsEstadodocumento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('estadodocumento/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    public function findByEstadoDocumento($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('estadodocumento/findBy/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    public function alterarSituacaoDemanda(array $arrData, $booDebug = null)
    {
        return $this->runService('documento/alterarSituacaoDemanda', $arrData, null, null, 'POST', $booDebug, null);
    }

    public function fetchPairsAcaoEstadodoc($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('acaoestadodoc/fetchPairs/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    public function findByAcaoEstadodoc($arrCriteria = null, $arrOrderBy = null, $intLimit = 'null', $intOffset = 'null', array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('acaoestadodoc/findBy/' . json_encode((array) $arrCriteria) . '/' . json_encode((array) $arrOrderBy) . '/' . $intLimit . '/' . $intOffset, [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    public function runService($strMethod = null, $mixParam = [], $strUrl = null, array $arrHeader = [], $strDataMethod = 'POST', $booDebug = null, $arrConfig = null)
    {
        if ((empty($this->strLdapLogin)) || (empty($this->strLdapPass)))
            throw new InvalidArgumentException(self::MSG_PARAM_NOT_FOUND);
        $arrToken = array(
            "iat" => time(),
            "adapter" => "inepdemandas",
            "user" => $this->strLdapLogin,
            "pass" => $this->strLdapPass,
        );
        $strJwt = JWT::encode($arrToken, 'InepSlimSkeleton', 'HS256');
        if (empty($mixParam))
            $mixParam = [];
        if ((is_object($mixParam)) && ($mixParam instanceof \stdClass)) {
            $mixParam = json_encode($mixParam);
            $arrHeader['Content-Type'] = 'application/json';
        }
        $arrHeader['Authorization'] = 'Bearer ' . $strJwt;
        $strMethod = str_replace('//', '/', $strMethod);
        return parent::runService(get_class($this) . '::' . $strMethod, $strMethod, $mixParam, $strUrl, $arrHeader, $strDataMethod, $booDebug, null, array_merge((array) $arrConfig, ['timeout' => 30]));
    }

}
