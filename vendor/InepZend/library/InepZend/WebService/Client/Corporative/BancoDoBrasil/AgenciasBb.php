<?php

namespace InepZend\WebService\Client\Corporative\BancoDoBrasil;

use InepZend\WebService\Client\Soap;

/**
 * Class AgenciasBb
 *
 * @package InepZend\WebService\Client\Corporative\BancoDoBrasil
 */
class AgenciasBb extends Soap
{

    const URL_WSDL = 'http://ws.mec.gov.br/AgenciasBb/wsdl';

    /**
     * Metodo que retorna lista de agencias do Banco do Brasil
     * em um raio de distancia ($intRaioKm) do municipio ($intCoIbge)
     *
     * @example $this->getMunicipio(5300108, 10);
     *
     * @param integer $intCoIbge
     * @param integer $intRaioKm
     * @param string $strUrlWsdl
     * @param bool $booDebug
     * @return array
     */
    public function getMunicipio($intCoIbge = null, $intRaioKm = null, $strUrlWsdl = null, $booDebug = null)
    {
        return $this->runService(array('codIbge' => $intCoIbge, 'nuRaioKm' => $intRaioKm), __FUNCTION__, $strUrlWsdl, $booDebug);
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
