<?php

namespace InepZend\WebService\Client\Corporative\Correios;

use InepZend\WebService\Client\Soap;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\RestCorpTrait;
use InepZend\Exception\RuntimeException;
use \Exception as ExceptionNative;

/**
 * Class Dne
 *
 * Classe para consulta a dados referentes a enderecos, logradouros e ceps
 *
 * @package InepZend\WebService\Client\Corporative\Correios
 */
class Dne extends Soap
{

    use RestCorpTrait;

    const URL_WSDL = 'http://ws.mec.gov.br/Dne/wsdl';

    /**
     * Metodo para retorno de dados do endereco cadastrado nos correios para o cep informado
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPorCep(70610440);
     *
     * @param integer $intNuCep
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosPorCep($intNuCep = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($intNuCep))
            return self::MSG_PARAM_NOT_FOUND;
        try {
            if (self::getRestCorp()) {
                $mixResult = self::getInstanceRestCorp()->solicitarDadosPorCep($intNuCep, array(), null, $booDebug);
                if (is_string($mixResult))
                    throw new RuntimeException($mixResult);
                return $mixResult;
            }
        } catch (ExceptionNative $exception) {
            $mixResult = $this->runService(__CLASS__, 'lerDne', $strUrlWsdl, $booDebug, null, null, null, null, str_replace('-', '', $intNuCep));
            if (is_array($mixResult)) {
                $mixResposta = @$mixResult['RESPOSTA'];
                if ($mixResposta === '')
                    $mixResult['RESPOSTA'] = 'CEP inválido.';
                elseif ((is_array($mixResposta)) && (is_array(@$mixResult['RESPOSTA']['NODELIST'])))
                    $mixResult['RESPOSTA']['NODELIST'] = array_merge($mixResult['RESPOSTA']['NODELIST'], array('co_uf' => null, 'no_municipio' => $mixResult['RESPOSTA']['NODELIST']['co_municipio'], 'co_municipio' => $mixResult['RESPOSTA']['NODELIST']['co_ibge']));
            }
            return $mixResult;
        }
    }

    /**
     * Metodo para retorno de dados de cep dos municipios da UF informada
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPorSgUf('AC');
     *
     * @param string $strSgUf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosPorSgUf($strSgUf = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($strSgUf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(__CLASS__, 'lerDne', $strUrlWsdl, $booDebug, $strSgUf, null, null, null, null);
    }

    /**
     * Metodo para retorno de dados de cep dos logradouros da UF e cidade informada
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPorCidade('AC', 'Acrelandia');
     *
     * @param string $strSgUf
     * @param string $strCidade
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosPorCidade($strSgUf = null, $strCidade = null, $strUrlWsdl = null, $booDebug = null)
    {
        if ((empty($strSgUf)) || (empty($strCidade)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(__CLASS__, 'lerDne', $strUrlWsdl, $booDebug, $strSgUf, $strCidade, null, null, null);
    }

    /**
     * Metodo para retorno de dados de cep dos logradouros da UF e cidade informada
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPorBairro('AC', 'Acrelandia', 'Centro');
     *
     * @param string $strSgUf
     * @param string $strCidade
     * @param string $strBairro
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosPorBairro($strSgUf = null, $strCidade = null, $strBairro = null, $strUrlWsdl = null, $booDebug = null)
    {
        if ((empty($strSgUf)) || (empty($strCidade)) || (empty($strBairro)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(__CLASS__, 'lerDne', $strUrlWsdl, $booDebug, $strSgUf, $strCidade, $strBairro, null, null);
    }

    /**
     * Metodo para retorno de dados de cep dos logradouros da UF e cidade informada
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPorLogradouro('AC', 'Acrelandia', 'Centro', 'Acrelândia');
     *
     * @param string $strSgUf
     * @param string $strCidade
     * @param string $strBairro
     * @param string $strLogradouro
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosPorLogradouro($strSgUf = null, $strCidade = null, $strBairro = null, $strLogradouro = null, $strUrlWsdl = null, $booDebug = null)
    {
        if ((empty($strSgUf)) || (empty($strCidade)) || (empty($strBairro)) || (empty($strLogradouro)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(__CLASS__, 'lerDne', $strUrlWsdl, $booDebug, $strSgUf, $strCidade, $strBairro, $strLogradouro, null);
    }

    /**
     * Metodo para consultar tipos de logradouros existentes
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosTipoLogradouro();
     *
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return mix
     */
    public function solicitarDadosTipoLogradouro($strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService(__CLASS__, 'pegarTiposLogradouro', $strUrlWsdl, $booDebug);
    }
    
}
