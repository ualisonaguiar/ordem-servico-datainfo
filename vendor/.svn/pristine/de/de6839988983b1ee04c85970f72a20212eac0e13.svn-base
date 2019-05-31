<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\ReceitaFederal\PessoaFisica;
use InepZend\Util\Format;
use InepZend\Util\stdClass;

/**
 * Class Cpf
 *
 * classe com metodos para informacoes de cadastro de pessoa fisica
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Cpf
{

	/**
	 * Metodo para listar dados do cadastro de pessoa fisica
	 *
	 * @example $this->cpf(94865353615);
	 *
	 * @param integer $intNuCpf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return array|null
	 */
	public function cpf($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        $intNuCpf = Format::clearCpfCnpj($intNuCpf);
        $mixResult = $this->pessoaFisicaCpf($intNuCpf, null, $arrHeader, $strUrl, $booDebug, $arrConfig);
        if (is_object($mixResult))
            return $mixResult;
        return $this->editSexo($this->runService(__FUNCTION__, array('cpf' => $intNuCpf), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig));
    }

	/**
	 * Metodo para listar dados do cadastro interno de pessoa fisica
	 *
	 * @example $this->cpf(94865353615);
	 *
	 * @param integer $intNuCpf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function cpfInterno($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('cpf/interno', new stdClass(array('cpf' => Format::clearCpfCnpj($intNuCpf))), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

	/**
	 * Metodo para listar dados do cadastro de pessoa fisica com base da Receita Federal
	 *
	 * @example $this->cpfReceita(94865353615);
	 *
	 * @param integer $intNuCpf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @param bool $booSituacaoCadastral
	 * @return mixed
	 */
	public function cpfReceita($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null, $booSituacaoCadastral = true)
    {
        if ($booSituacaoCadastral)
            return $this->cpfReceitaSituacaoCadastral($intNuCpf, $arrHeader, $strUrl, $booDebug, $arrConfig);
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('cpf/receita', new stdClass(array('cpf' => Format::clearCpfCnpj($intNuCpf))), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

	/**
	 * Metodo para listar dados da situacao cadastral de pessoa fisica com base da Receita Federal
	 *
	 * @example $this->cpfReceitaSituacaoCadastral(94865353615);
	 *
	 * @param integer $intNuCpf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function cpfReceitaSituacaoCadastral($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('cpf/receita/situacaoCadastral', new stdClass(array('cpf' => Format::clearCpfCnpj($intNuCpf))), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

	/**
	 * Metodo para listar dados resumidos do cadastro de pessoa fisica
	 *
	 * @example $this->solicitarDadosResumidoPessoaFisicaPorCpf(94865353615);
	 *
	 * @param integer $intNuCpf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return array|null
	 */
	public function solicitarDadosResumidoPessoaFisicaPorCpf($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $mixResult = $this->cpf($intNuCpf, $arrHeader, $strUrl, $booDebug, $arrConfig);
        if (!is_object($mixResult))
            return $mixResult;
        if (!empty($mixResult->dataNascimento))
            $arrResult = array(
                'RESPOSTA' => array(
                    'PESSOA' => array(
                        'no_pessoa_rf' => $mixResult->nome,
                        'nu_cpf_rf' => $mixResult->cpf,
                        'no_mae_rf' => $mixResult->nomeMae,
                        'dt_nascimento_rf' => str_replace('-', '', $mixResult->dataNascimento),
                        'sg_sexo_rf' => $mixResult->tipoSexo,
                        'nu_titulo_eleitor_rf' => null,
                        'st_indicador_estrangeiro_rf' => null,
                        'co_pais_residente_exterior_rf' => null,
                        'st_indicador_residente_ext_rf' => null,
                        'no_pais_residente_exterior_rf' => null,
                        'st_cadastro_rf' => null,
                        'nu_ano_obito_rf' => null,
                        'co_natureza_ocupacao_rf' => null,
                        'co_ocupacao_principal_rf' => null,
                        'co_unidade_administrativa_rf' => null,
                        'nu_ano_exercicio_ocupacao_rf' => null,
                        'dt_inscricao_atualizacao_cpf_rf' => null,
                        'nu_rg' => null,
                        'dt_emissao_rg' => null,
                        'ds_orgao_expedidor_rg' => null,
                        'dt_cadastro' => null,
                    ),
                ),
            );
        else {
            $booRestCorp = PessoaFisica::getRestCorp();
            PessoaFisica::setRestCorp(false);
            $arrResult = self::getInstancePessoaFisica()->solicitarDadosResumidoPessoaFisicaPorCpf($intNuCpf, null, $booDebug);
            PessoaFisica::setRestCorp($booRestCorp);
        }
        return $this->editSexo($arrResult);
    }

    /**
     * Metodo para listar dados resumidos do cadastro de pessoa fisica atraves do restCorp
     *
     * @example $this->solicitarDadosResumidoPessoaFisicaPorCpfRestCorp(94865353615, 1);
     *
     * @param null $intNuCpf
     * @param null $intIdUsuarioAlteracao
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     * @return array
     */
    public function solicitarDadosResumidoPessoaFisicaPorCpfRestCorp($intNuCpf = null, $intIdUsuarioAlteracao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $mixResult = $this->pessoaFisicaPost($intNuCpf, $intIdUsuarioAlteracao, $arrHeader, $strUrl, $booDebug, $arrConfig);
        if (!is_object($mixResult))
            return $mixResult;
        return [
            'RESPOSTA' => [
                'PESSOA' => [
                    'codigo' => $mixResult->codigo,
                    'no_pessoa_rf' => $mixResult->nome,
                    'nu_cpf_rf' => $mixResult->cpf,
                    'no_mae_rf' => $mixResult->nomeMae,
                    'dt_nascimento_rf' => str_replace('-', '', $mixResult->dataNascimento),
                    'sg_sexo_rf' => $mixResult->tipoSexo,
                    'nu_titulo_eleitor_rf' => null,
                    'st_indicador_estrangeiro_rf' => null,
                    'co_pais_residente_exterior_rf' => null,
                    'st_indicador_residente_ext_rf' => null,
                    'no_pais_residente_exterior_rf' => null,
                    'st_cadastro_rf' => null,
                    'nu_ano_obito_rf' => null,
                    'co_natureza_ocupacao_rf' => null,
                    'co_ocupacao_principal_rf' => null,
                    'co_unidade_administrativa_rf' => null,
                    'nu_ano_exercicio_ocupacao_rf' => null,
                    'dt_inscricao_atualizacao_cpf_rf' => null,
                    'nu_rg' => null,
                    'dt_emissao_rg' => null,
                    'ds_orgao_expedidor_rg' => null,
                    'dt_cadastro' => null,
                ]
            ]
        ];
    }

	/**
	 * Metodo privado para modificacao do retorno do sexo
	 *
	 * @example $this->editSexo(self::getInstancePessoaFisica()->solicitarDadosResumidoPessoaFisicaPorCpf($intNuCpf, null, $booDebug););
	 *
	 * @param mixed $mixResult
	 * @return array|null
	 */
	private function editSexo($mixResult = null)
    {
        $arrSexo = array('M', 'F', 'X', '1', '2', '9');
        if (is_object($mixResult)) {
            $strSexo = strtoupper((string) @$mixResult->tipoSexo);
            if (!empty($strSexo)) {
                if (!in_array($strSexo, $arrSexo))
                    $mixResult->tipoSexo = null;
                elseif ($strSexo == '1')
                    $mixResult->tipoSexo = 'M';
                elseif ($strSexo == '2')
                    $mixResult->tipoSexo = 'F';
                elseif ($strSexo == 'X')
                    $mixResult->tipoSexo = '9';
            }
        } elseif (is_array($mixResult)) {
            $strSexo = strtoupper((string) @$mixResult['RESPOSTA']['PESSOA']['sg_sexo_rf']);
            if (!empty($strSexo)) {
                if (!in_array($strSexo, $arrSexo))
                    $mixResult['RESPOSTA']['PESSOA']['sg_sexo_rf'] = null;
                elseif ($strSexo == '1')
                    $mixResult['RESPOSTA']['PESSOA']['sg_sexo_rf'] = 'M';
                elseif ($strSexo == '2')
                    $mixResult['RESPOSTA']['PESSOA']['sg_sexo_rf'] = 'F';
                elseif ($strSexo == 'X')
                    $mixResult['RESPOSTA']['PESSOA']['sg_sexo_rf'] = '9';
            }
        }
        return $mixResult;
    }
}
