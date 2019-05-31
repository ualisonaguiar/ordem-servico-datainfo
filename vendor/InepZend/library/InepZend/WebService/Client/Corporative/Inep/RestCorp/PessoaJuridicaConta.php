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
trait PessoaJuridicaConta
{
    /**
     * Metodo por listar os contas vinculados na pessoa juridica
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
    public function consultarPorId($intIdPessoaJuridicaConta = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intIdPessoaJuridicaConta)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/conta/' . $intIdPessoaJuridicaConta, new stdClass(array('id' => $intIdPessoaJuridicaConta)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os contas vinculados na pessoa juridica atraves do cnpj
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
    public function consultarPorCnpj($strCnpj = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCnpj)))
            return self::MSG_PARAM_NOT_FOUND;
        $strCnpj = Format::clearCpfCnpj($strCnpj);
        return $this->runService('inep/pessoa/juridica/conta/cnpj/' . $strCnpj, new stdClass(array('cnpj' => $strCnpj)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os contas vinculados na pessoa juridica atraves do cnpj
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
    public function salvar($arrDados = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrFieldRequired = ['idPessoaJuridica', 'idAgenciaBancaria', 'nuContaCorrente', 'idUsuarioOperacao'];
        foreach ($arrFieldRequired as $strKey) {
            if (!array_key_exists($strKey, $arrDados)) {
                return self::MSG_PARAM_NOT_FOUND . ' - ' . $strKey;
            }
        }
        return $this->runService('inep/pessoa/juridica/conta/salvar/', new stdClass($arrDados), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
}