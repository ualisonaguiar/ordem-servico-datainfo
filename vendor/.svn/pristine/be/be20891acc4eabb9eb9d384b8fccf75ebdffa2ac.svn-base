<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

/**
 * Class Pessoa
 *
 * classe com metodos para listagem de informacoes de pessoa
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Pessoa
{

    /**
     * Metodo para listagem de dados de pessoa pelo codigo
     *
     * @example $this->pessoaFisica(100);
     *
     * @param integer $intCoPessoaFisica
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisica($intCoPessoaFisica = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('pessoa/fisica' . (empty($intCoPessoaFisica) ? '' : '/' . $intCoPessoaFisica), array('codigo' => $intCoPessoaFisica), $strUrl, $arrHeader, (empty($intCoPessoaFisica) ? 'POST' : 'GET'), $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados de pessoa pelo CPF juntamente com os
     * dados da VW_PESSOA_FISICA
     *
     * @example $this->pessoaFisicaJson('XXXXXXXXXXX', 4100);
     *
     * @param string $strCpf
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaJson($strCpf = null, $intIdUsuarioAlteracao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCpf)) || (empty($intIdUsuarioAlteracao)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/fisica', new stdClass(array('cpf' => $strCpf, 'idUsuarioAlteracao' => $intIdUsuarioAlteracao)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
    
    /**
     * Metodo para listagem de dados de pessoa pelo CPF direto na receita atraves
     * dos dados da VW_PESSOA_FISICA
     *
     * @example $this->pessoaFisicaJson('XXXXXXXXXXX', 4100);
     *
     * @param string $strCpf
     * @param integer $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaReceitaJson($strCpf = null, $intIdUsuarioAlteracao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strCpf)) || (empty($intIdUsuarioAlteracao)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/fisica/receita', new stdClass(array('cpf' => $strCpf, 'idUsuarioAlteracao' => $intIdUsuarioAlteracao)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados de pessoa pelo CPF e codigo do usuario de sistema
     *
     * @example $this->pessoaFisicaCpf('94865353615');
     *
     * @param string $strCpf
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @param bool $booSituacaoCadastral
     * @return mixed
     */
    public function pessoaFisicaCpf($strCpf = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null, $booSituacaoCadastral = true)
    {
        if ($booSituacaoCadastral)
            return $this->pessoaFisicaSituacaoCadastralCpf($strCpf, $intCoUsuarioSistema, $arrHeader, $strUrl, $booDebug, $arrConfig);
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array('cpf' => $strCpf);
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        if (!empty($intCoUsuarioSistema))
            $arrParam['responsavel'] = $intCoUsuarioSistema;
        return $this->runService('pessoa/fisica/cpf/' . $strCpf . (empty($intCoUsuarioSistema) ? '' : '/responsavel/' . $intCoUsuarioSistema), $arrParam, $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }
    
    /**
     * Metodo para listagem de dados de pessoa pelo CPF
     *
     * @example $this->pessoaFisicaCpf('94865353615');
     *
     * @param string $strCpf
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaCpfJson($strCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/pessoa/fisica/cpf', new stdClass(array('cpf' => $strCpf)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de pessoa pelo codigo de municipio
     *
     * @example $this->pessoaFisicaMunicipio(5300108);
     *
     * @param integer $intCoMunicipio
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaMunicipio($intCoMunicipio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intCoMunicipio))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('pessoa/fisica/municipio/' . $intCoMunicipio, array('codigo' => $intCoMunicipio), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados da Receita Federal de pessoa via GET
     *
     * @example $this->pessoaFisicaReceitaCpf('94865353615');
     *
     * @param string $strCpf
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaReceitaCpf($strCpf = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array('cpf' => $strCpf);
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        if (!empty($intCoUsuarioSistema))
            $arrParam['responsavel'] = $intCoUsuarioSistema;
        return $this->runService('pessoa/fisica/receita/cpf/' . $strCpf . (empty($intCoUsuarioSistema) ? '' : '/responsavel/' . $intCoUsuarioSistema), $arrParam, $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados da Receita Federal de pessoa via POST
     *
     * @example $this->pessoaFisicaReceitaCpfPost('94865353615');
     *
     * @param string $strCpf
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaReceitaCpfPost($strCpf = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        return $this->runService('inep/pessoa/fisica/receita/', (new stdClass(array('cpf' => $strCpf, 'idUsuarioAlteracao' => $intCoUsuarioSistema))), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados da Situacao Cadastral de pessoa via GET
     *
     * @example $this->pessoaFisicaSituacaoCadastralCpf('94865353615');
     *
     * @param string $strCpf
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaSituacaoCadastralCpf($strCpf = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array('cpf' => $strCpf);
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        if (!empty($intCoUsuarioSistema))
            $arrParam['responsavel'] = $intCoUsuarioSistema;
        return $this->runService('pessoa/fisica/situacaoCadastral/cpf/' . $strCpf . (empty($intCoUsuarioSistema) ? '' : '/responsavel/' . $intCoUsuarioSistema), $arrParam, $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo para listagem de dados da Receita Federal de pessoa via POST
     *
     * @example $this->pessoaFisicaPost('94865353615');
     *
     * @param string $strCpf
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function pessoaFisicaPost($strCpf = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($strCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        return $this->runService('inep/pessoa/fisica/', (new stdClass(array('cpf' => $strCpf, 'idUsuarioAlteracao' => $intCoUsuarioSistema))), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }
}
