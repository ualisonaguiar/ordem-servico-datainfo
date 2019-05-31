<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

/**
 * Class PessoaContato
 *
 * classe com metodos de listagem de programas cadastrados
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */

trait PessoaContato
{
    /**
     * Metodo para listagem de dados do contato da pessoa fisica pelo codigo
     *
     * @example $this->consultarPessoaContato(100);
     *
     * @param integer $intCoPessoaFisica
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function consultarPessoaContato($intCoPessoaFisica = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/pessoa/contato/' . $intCoPessoaFisica, ['codigoPessoa' => $intCoPessoaFisica], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     * Metodo para salvar os dados do contato da pessoa fisica.
     *
     * @example $this->consultarPessoaContato(100);
     * 'codigoPessoa' => 122940993113,
     * 'contato' => 'arquitetura.sistema@inep.gov.br',
     * 'idUsuarioAlteracao' => 1,
     * 'tipoContato' => [
     *   'id' => 1,
     *   'tipo' => 'Telefone'
     * ],
     * 'id' => 336 (quando for para alterar)
     *
     * @param $arrDadosContato
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     * @return array
     */
    public function salvarPessoaContato($arrDadosContato, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrFiledRequired = ['codigoPessoa', 'contato', 'idUsuarioAlteracao'];
        $arrMsgError = $this->validateFieldRequired($arrFiledRequired, $arrDadosContato);
        if ($arrMsgError) {
            return $arrMsgError;
        }
        return $this->runService('inep/pessoa/contato', (new stdClass($arrDadosContato)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig, true);
    }

    /**
     * Metodo para excluir de dado do contato da pessoa fisica pelo codigo
     *
     * @example $this->consultarPessoaContato(100);
     *
     * @param null $intCoPessoaFisica
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     */
    public function excluirPessoaContato($intIdPessoaContato, $intCodigoPessoaFisica, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intIdPessoaContato)) || (empty($intCodigoPessoaFisica)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(
            'inep/pessoa/contato/' . $intIdPessoaContato . '/pessoa/' . $intCodigoPessoaFisica,
            [
                'id' => $intIdPessoaContato,
                'codigoPessoa' => $intCodigoPessoaFisica
            ],
            $strUrl,
            $arrHeader,
            'DELETE',
            $booDebug,
            $arrConfig, true
        );
    }

    /**
     * @example $this->getListagemTipoContato();
     *
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     * @return mixed
     */
    public function getListagemTipoContato(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/pessoa/contato/tipo-contato', [], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     * @example $this->getListagemTipoContato();
     */
    public function getCategoriaContato()
    {
        return [
            1 => 'Telefone',
            2 => 'Telefone',
            3 => 'E-mail',
            4 => 'E-mail',
            5 => 'Telefone',
        ];
    }

    /**
     * Metodo responsavel por validar os campos obrigatorios
     *
     * @param $arrFieldRequired
     * @param $arrDadosContato
     * @return array
     */
    protected function validateFieldRequired($arrFieldRequired, $arrDadosContato)
    {
        $arrMsgError = [];
        foreach ($arrFieldRequired as $strIndice) {
            if (!array_key_exists($strIndice, $arrDadosContato)) {
                $arrMsgError[] = self::MSG_PARAM_NOT_FOUND . ' - ' . $strIndice;
                continue;
            }
            if (empty($arrDadosContato[$strIndice])) {
                $arrMsgError[] = self::MSG_PARAM_NOT_FOUND . ' - ' . $strIndice;
            }
        }
        if ($arrMsgError) {
            return $arrMsgError;
        }
    }
}