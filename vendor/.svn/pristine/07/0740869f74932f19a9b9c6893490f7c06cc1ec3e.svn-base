<?php

namespace InepZend\WebService\Client\Corporative\Febraban;

use InepZend\WebService\Client\Soap;

/**
 * Class Febraban
 *
 * classe para consulta de codigos de bancos
 *
 * @package InepZend\WebService\Client\Corporative\Febraban
 */
class Febraban extends Soap
{

    const URL_WSDL = 'http://ws.mec.gov.br/Febraban/wsdl';

    /**
     * Metodo para retorno de lista de bancos
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->recuperarLista();
     *
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function recuperarLista($strUrlWsdl = null, $booDebug = null)
    {
        return parent::runService(__CLASS__, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para retorno de lista de bancos por codigo ($intNuBanco)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->recuperarLista(1);
     *
     * @param integer $intNuBanco
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function recuperarPorId($intNuBanco = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($intNuBanco, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para retorno de lista de bancos por nome ($strNoBanco)
     *
     * Pode se enviar a url do wsdl ($strUrlWsdl), caso nao seja enviado, sera usada a default (URL_WSDL)
     * Pode se ativar o modo debug para verificacao do metodo ($booDebug)
     *
     * @example $this->recuperarLista('Banco do Brasil S.A.');
     *
     * @param string $strNoBanco
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function recuperarPorNome($strNoBanco = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService($strNoBanco, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    /**
     * Metodo para execucao do servico
     *
     * As execucoes da chamada ao servico com parametros ($mixParam)
     * e metodo a ser executado no servico ($strMethod)
     *
     * @param mix $mixParam
     * @param string $strMethod
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function runService($mixParam = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (empty($mixParam))
            return self::MSG_PARAM_NOT_FOUND;
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, $mixParam);
    }

}
