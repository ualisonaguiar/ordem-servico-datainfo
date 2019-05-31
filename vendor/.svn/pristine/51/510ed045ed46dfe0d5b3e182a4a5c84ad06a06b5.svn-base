<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Soap;
use InepZend\Util\Format;

/**
 * Class PessoaJuridica
 * @package InepZend\WebService\Client\Corporative\ReceitaFederal
 */
class PessoaJuridica extends Soap
{

    const URL_WSDL = 'http://ws.mec.gov.br/PessoaJuridica/wsdl';

    /**
     * Metodo para busca de dados resumidos do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosResumidoPessoaJuridicaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosResumidoPessoaJuridicaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para busca de dados enviados a receita do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosReceitaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosReceitaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para busca de dados do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosPessoaJuridicaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosPessoaJuridicaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para busca de dados do endereco do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosEnderecoPessoaJuridicaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosEnderecoPessoaJuridicaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para busca de dados de contato do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosContatoPessoaJuridicaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosContatoPessoaJuridicaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para busca de dados dos socios do cnpj informado ($intNuCnpj)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->solicitarDadosSocioPessoaJuridicaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function solicitarDadosSocioPessoaJuridicaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para execucao do servico
     *
     * As execucoes da chamada ao servico sao feitas atraves do cnpj ($intNuCnpj)
     * e metodo a ser executado no servico ($strMethod)
     *
     * @param integer $intNuCnpj
     * @param string $strMethod
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function runService($intNuCnpj = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($intNuCnpj))
            return self::MSG_PARAM_NOT_FOUND;
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, Format::clearCpfCnpj($intNuCnpj));
    }

}
