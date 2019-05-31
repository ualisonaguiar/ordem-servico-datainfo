<?php
/**
 * Created by PhpStorm.
 * User: ualison
 * Date: 26/12/17
 * Time: 14:40
 */

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

/**
 * Class PessoaJuridicaContato
 *
 * classe com metodos para listagem de informacoes de pessoa juridica contato
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait PessoaJuridicaContato
{
    /**
     * Metodo por listar os contatos vinculados na pessoa juridica
     *
     * @example $this->obterPorId('XXXXXXXXXXXXXX');
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaContatoObterPorId($intIdPessoaJuridicaContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intIdPessoaJuridicaContato)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/contato/' . $intIdPessoaJuridicaContato, new stdClass(array('id' => $intIdPessoaJuridicaContato)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os contatos vinculados na pessoa juridica atraves do idPessoaJuridica
     *
     * @example $this->obterPorPessoaJuridica('XXXXXXXXXXXXXX');
     *
     * @param string $strCnpj
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaJuridicaContatoObterPorPessoaJuridica($intIdPessoaJuridica = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intIdPessoaJuridica)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/juridica/contato/pessoa-judica/' . $intIdPessoaJuridica, new stdClass(array('idPessoaJuridica' => $intIdPessoaJuridica)), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo por listar os enderecos vinculados na pessoa juridica por cnpj
     *
     * @example $this->pessoaJuridicaContatoSalvar([
        'id' => 32, //quando for alterar
        'idPessoaJuridica' => 289,
        'tipoContato' => 6,
        'contato' => '2022-3574',
        'idUsuarioSistema' => 1
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
    public function pessoaJuridicaContatoSalvar($arrDados, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrFieldRequired = ['idPessoaJuridica', 'tipoContato', 'contato', 'idUsuarioSistema'];
        foreach ($arrFieldRequired as $strKey) {
            if (!array_key_exists($strKey, $arrDados)) {
                return self::MSG_PARAM_NOT_FOUND . ' - ' . $strKey;
            }
        }
        return $this->runService('inep/pessoa/juridica/contato/salvar', new stdClass($arrDados), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
}