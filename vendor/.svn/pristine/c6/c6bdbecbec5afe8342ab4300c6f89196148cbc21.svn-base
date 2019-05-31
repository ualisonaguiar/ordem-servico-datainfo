<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCcp;

/**
 * Class Iteracao
 *
 * classe com metodos que retornam dados do Iteracao
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Iteracao
{

    /**
     * Metodo que retorna informacoes da Iteracao de uma OS
     *
     * @example $this->iteracao(792);
     *
     * @param integer $intNuOrdemServico
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function iteracao($intNuOrdemServico = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('iteracao/ordemservico/' . $intNuOrdemServico, ['nuOrdemServico' => $intNuOrdemServico], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

}
