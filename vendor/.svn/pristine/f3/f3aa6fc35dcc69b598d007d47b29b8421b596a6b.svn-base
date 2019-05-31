<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

/**
 * Class PessoaJuridica
 *
 * classe com metodos para listagem de informacoes de pessoa
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait PessoaJuridica
{
    /**
     * Metodo para listagem de dados de pessoa pelo CNPJ interno juntamente com os
     * dados da VW_PESSOA_JURIDICA
     *
     * @example $this->pessoaJuridicaInterno('XXXXXXXXXXXXXX');
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaInterno($strCnpj = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCnpj)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/interno', new stdClass(array('cnpj' => $strCnpj)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem consulta na base do MEC/Receita
     *
     * @example $this->pessoaJuridicaMEC('XXXXXXXXXXXXXX', 1);
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaMEC($strCnpj = null, $intIdUsuarioAlteracao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCnpj)) || (empty($intIdUsuarioAlteracao)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/externo', new stdClass(array('cnpj' => $strCnpj, 'idUsuarioAlteracao' => $intIdUsuarioAlteracao)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem consulta na base interna, e caso não encontre, no MEC/Receita
     *
     * @example $this->pessoaJuridica('XXXXXXXXXXXXXX', 1);
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridica($strCnpj = null, $intIdUsuarioAlteracao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCnpj)) || (empty($intIdUsuarioAlteracao)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica', new stdClass(array('cnpj' => $strCnpj, 'idUsuarioAlteracao' => $intIdUsuarioAlteracao)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
}
