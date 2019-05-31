<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Soap;
use InepZend\WebService\Client\Corporative\Inep\RestCorp\RestCorpTrait;
use InepZend\Util\Format;
use InepZend\Exception\RuntimeException;
use \Exception as ExceptionNative;

/**
 * Class PessoaFisica
 *
 * Definicao da classe para consumo de servicos disponibilizados pelo MEC
 * para consultas a dados do cadastro de pessoa fisica
 *
 * @package InepZend\WebService\Client\Corporative\ReceitaFederal
 */
class PessoaFisica extends Soap
{

    use RestCorpTrait;

    const URL_WSDL = 'http://ws.mec.gov.br/PessoaFisica/wsdl';

    /**
     * Metodo de consulta de dados resumidos de uma pessoa fisica
     * Utiliza como parametro da busca o cpf ($intNuCpf)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosResumidoPessoaFisicaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosResumidoPessoaFisicaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        try {
            if (self::getRestCorp()) {
                $mixResult = self::getInstanceRestCorp()->solicitarDadosResumidoPessoaFisicaPorCpf($intNuCpf, array(), null, $booDebug);
                if (is_string($mixResult))
                    throw new RuntimeException($mixResult);
                return $mixResult;
            }
        } catch (ExceptionNative $exception) {
            return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
        }
    }

    /**
     * Metodo de consulta de dados enviados na declaração do imposto de renda de uma pessoa fisica
     * Utiliza como parametro da busca o cpf ($intNuCpf)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosReceitaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosReceitaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo de consulta de dados enviados na declaração do imposto de renda de uma pessoa fisica
     * Utiliza como parametro da busca o cpf ($intNuCpf)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPessoaFisicaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosPessoaFisicaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo de consulta de dados do endereco de uma pessoa fisica
     * Utiliza como parametro da busca o cpf ($intNuCpf)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosEnderecoPessoaFisicaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosEnderecoPessoaFisicaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo de consulta de dados de contato de uma pessoa fisica
     * Utiliza como parametro da busca o cpf ($intNuCpf)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosContatoPessoaFisicaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosContatoPessoaFisicaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para execucao do servico
     *
     * As execucoes da chamada ao servico sao feitas atraves do cpf ($intNuCpf)
     * e metodo a ser executado no servico ($strMethod)
     *
     * @param integer $intNuCpf
     * @param string $strMethod
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function runService($intNuCpf = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, Format::clearCpfCnpj($intNuCpf));
    }

}
