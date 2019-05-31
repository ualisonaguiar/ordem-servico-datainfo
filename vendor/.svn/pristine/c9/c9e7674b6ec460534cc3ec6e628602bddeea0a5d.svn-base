<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCcp;

/**
 * Class Requisito
 *
 * classe com metodos que retornam dados do Requisito
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Requisito
{

    /**
     * Metodo que retorna informacoes do Requisito de uma OS
     *
     * @example $this->requisito(792);
     *
     * @param integer $intNuOrdemServico
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function requisito($intNuOrdemServico = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('requisito/ordemservico/' . $intNuOrdemServico, ['nuOrdemServico' => $intNuOrdemServico], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

}
