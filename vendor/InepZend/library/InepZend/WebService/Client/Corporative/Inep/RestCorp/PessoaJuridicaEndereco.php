<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\Format;
use InepZend\Util\stdClass;

/**
 * Class PessoaJuridicaEndereco
 *
 * classe com metodos para listagem de informacoes de pessoa juridica endereco
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait PessoaJuridicaEndereco
{
    /**
     * Metodo por listar os enderecos vinculados na pessoa juridica
     *
     * @example $this->consultarPorId('XXXXXXXXXXXXXX');
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaEnderecoConsultarPorId($intIdPessoaJuridicaEndereco = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intIdPessoaJuridicaEndereco)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/endereco/' . $intIdPessoaJuridicaEndereco, new stdClass(array('id' => $intIdPessoaJuridicaEndereco)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os enderecos vinculados na pessoa juridica por cnpj
     *
     * @example $this->consultarPorCnpj('XXXXXXXXXXXXXX');
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaEnderecoConsultarPorCnpj($strCNPJ = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCNPJ)))
            return self::MSG_PARAM_NOT_FOUND;
        $strCNPJ = Format::clearCpfCnpj($strCNPJ);
        return $this->runService('inep/pessoa/juridica/endereco/cnpj/' . $strCNPJ, new stdClass(array('cnpj' => $strCNPJ)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os enderecos vinculados na pessoa juridica por cnpj
     *
     * @example $this->pessoaJuridicaEnderecoSalvar([
        'id' => 3, //quando for alterar
        'idPessoaJuridica' => 289,
        'logradouro' => 'SIG Quadra 4 Lote 327 Edifício Villa Lobos',
        'numeroEndereco' => 'Lote 327',
        'idUsuarioOperacao' => 1,
        'cep' => '70610-908,
        'complemento' => 'Brasília/DF',
        'bairro' => 'Zona Industrial',
        'coMunicipio' => 3302452,
        'coUf' => 33
     * ]);
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaEnderecoSalvar($arrDados, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrFieldRequired = ['idPessoaJuridica', 'logradouro', 'numeroEndereco', 'idUsuarioOperacao', 'cep'];
        foreach ($arrFieldRequired as $strKey) {
            if (!array_key_exists($strKey, $arrDados)) {
                return self::MSG_PARAM_NOT_FOUND . ' - ' . $strKey;
            }
        }
        $arrDados['cep'] = Format::clearMask($arrDados['cep']);
        return $this->runService('inep/pessoa/juridica/endereco/salvar', new stdClass($arrDados), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
}