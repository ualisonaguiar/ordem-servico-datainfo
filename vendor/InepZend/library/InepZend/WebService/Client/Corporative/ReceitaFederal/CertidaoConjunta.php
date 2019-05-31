<?php

namespace InepZend\WebService\Client\Corporative\ReceitaFederal;

use InepZend\WebService\Client\Soap;
use InepZend\Util\Format;

/**
 * Class CertidaoConjunta
 * @package InepZend\WebService\Client\Corporative\ReceitaFederal
 */
class CertidaoConjunta extends Soap
{

//    const URL_WSDL_DESENV = 'http://10.1.3.109/certidaoConjunta/wsdl';
    const URL_WSDL_DESENV = 'http://wshmg.mec.gov.br/certidaoConjunta/wsdl';
    const URL_WSDL_ENTREGA = 'http://wshmg.mec.gov.br/certidaoConjunta/wsdl';
    const URL_WSDL_TQS = 'http://wshmg.mec.gov.br/certidaoConjunta/wsdl';
    const URL_WSDL_HOMOLOGA = 'http://wshmg.mec.gov.br/certidaoConjunta/wsdl';
    const URL_WSDL = 'http://ws.mec.gov.br/certidaoConjunta/wsdl';

    /**
     * Metodo para consulta de certidao conjunta por cpf
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultarEmitirCertidaoConjuntaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function consultarEmitirCertidaoConjuntaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para consulta de certidao conjunta por cnpj
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultarEmitirCertidaoConjuntaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function consultarEmitirCertidaoConjuntaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para consulta de certidao conjunta enviada a receita por cpf
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultarEmitirCertidaoConjuntaReceitaPorCpf('cpf');
     *
     * @param integer $intNuCpf
     * @param string $strUrlWsdl
     * @param string $booDebug
     * @return array
     */
    public function consultarEmitirCertidaoConjuntaReceitaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para consulta de certidao conjunta enviada a receita por cnpj
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->consultarEmitirCertidaoConjuntaReceitaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function consultarEmitirCertidaoConjuntaReceitaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para emitir de certidao conjunta por cpf
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->emitirCertidaoConjuntaReceitaPorCpf('cpf');
     *
     * @param null $intNuCpf
     * @param null $strUrlWsdl
     * @param null $booDebug
     * @return array|bool|string
     */
    public function emitirCertidaoConjuntaReceitaPorCpf($intNuCpf = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCpf, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para emitir de certidao conjunta por cnpj
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->emitirCertidaoConjuntaReceitaPorCnpj('cnpj');
     *
     * @param integer $intNuCnpj
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function emitirCertidaoConjuntaReceitaPorCnpj($intNuCnpj = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuCnpj, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para execucao do servico
     *
     * As execucoes da chamada ao servico sao feitas atraves do cnpj/cpf ($intNuCpfCnpj)
     * e metodo a ser executado no servico ($strMethod)
     *
     * @param integer $intNuCpfCnpj
     * @param string $strMethod
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function runService($intNuCpfCnpj = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($intNuCpfCnpj))
            return self::MSG_PARAM_NOT_FOUND;
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, Format::clearCpfCnpj($intNuCpfCnpj));
    }

}
