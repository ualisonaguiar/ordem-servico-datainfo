<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCcp;

/**
 * Class OrdemServico
 *
 * classe com metodos que retornam dados das Ordens de Servico
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCcp
 */
trait OrdemServico
{

    /**
     *  Metodo que retorna informacoes das Ordens de Servico por Codigo Projeto / ID
     *
     * @example $this->ordemServicoPorProjeto(CODIGO_PROJETO);
     *
     * @param integer $intCodigoProjeto
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function ordemServicoPorProjeto($intCodigoProjeto = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('ordemservico/projeto/' . $intCodigoProjeto, array('projeto' => $intCodigoProjeto), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     *  Metodo que retorna informacoes das Ordens de Servico por Codigo / ID da Ordem
     *
     * @example $this->ordemServico(CODIGO_ORDEM_SERVICO);
     *
     * @param integer $intCodigoOrdem
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function ordemServico($intCodigoOrdem = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('ordemservico/' . $intCodigoOrdem, array('projeto' => $intCodigoOrdem), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

}
