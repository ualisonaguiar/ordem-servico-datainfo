<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Cep
 *
 * classe com metodos que retornam dados de codigo de enderecamento postal
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Cep
{

    /**
     * Metodo que retorna informacoes sobre o cep informado
     *
     * @example $this->cep(NU_CEP);
     *
     * @param integer $intNuCep
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function cep($intNuCep = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('cepWithoutCache', func_get_args());
    }

    /**
     * Metodo que retorna informacoes sobre o cep informado porem sem utilizar dados de cache
     *
     * @example $this->cepWithoutCache(NU_CEP);
     *
     * @param integer $intNuCep
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function cepWithoutCache($intNuCep = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intNuCep))
            return self::MSG_PARAM_NOT_FOUND;
        $intNuCep = str_replace('-', '', $intNuCep);

        return $this->runService(str_replace('WithoutCache', '', __FUNCTION__) . '/' . $intNuCep, array('codigoCep' => $intNuCep), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo que retorna dados completos do cep informado
     *
     * @example $this->solicitarDadosPorCep(NU_CEP);
     *
     * @param integer $intNuCep
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function solicitarDadosPorCep($intNuCep = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('solicitarDadosPorCepWithoutCache', func_get_args());
    }

    /**
     * Metodo que retorna dados completos do cep informado porem sem utilizar dados de cache
     *
     * @example $this->solicitarDadosPorCepWithoutCache(NU_CEP);
     *
     * @param integer $intNuCep
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function solicitarDadosPorCepWithoutCache($intNuCep = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $mixResult = $this->cep($intNuCep, $arrHeader, $strUrl, $booDebug, $arrConfig);
        $booInexistente = ((is_string($mixResult)) && (stripos($mixResult, 'CEP inexistente') !== false));
        if ((!is_object($mixResult)) && (!$booInexistente))
            return $mixResult;
        $arrResult = array(
            'RESPOSTA' => array(
                'STATUS' => ($booInexistente) ? 'empty' : 'ok',
                'NODELIST' => array(
                    'co_logradouro' => '',
                    'co_municipio' => ($booInexistente) ? '' : (string) @$mixResult->codigoMunicipio,
                    'sg_uf' => '',
                    'no_bairro' => ($booInexistente) ? '' : @$mixResult->nomeBairro,
                    'tipo_logradouro' => ($booInexistente) ? '' : @$mixResult->descricaoTipo,
                    'no_logradouro' => ($booInexistente) ? '' : @$mixResult->nomeLogradouro,
                    'no_logradouro_abrev' => '',
                    'no_complemento_logradouro' => '',
                    'nu_cep' => ($booInexistente) ? '' : @$mixResult->codigoCep,
                    'co_ibge' => ($booInexistente) ? '' : (string) @$mixResult->codigoMunicipio,
                    'co_uf' => ($booInexistente) ? '' : @$mixResult->codigoUf,
                    'no_municipio' => ($booInexistente) ? '' : @$mixResult->nomeCidade,
                ),
            ),
        );
        return $arrResult;
    }

}
