<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Regiao
 *
 * classe com metodos de listagem de informacoes de regiao do territorio nacional
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Regiao
{

    /**
     * Metodo para listar dados da regiao
     *
     * @example $this->regiao(3);
     *
     * @param integer $intCoRegiao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function regiao($intCoRegiao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('regiaoWithoutCache', func_get_args());
    }

    /**
     * Metodo para listar dados da regiao sem uso de cache
     *
     * @example $this->regiaoWithoutCache(3);
     *
     * @param integer $intCoRegiao
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function regiaoWithoutCache($intCoRegiao = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/' . str_replace('WithoutCache', '', __FUNCTION__) . (empty($intCoRegiao) ? '' : '/' . $intCoRegiao), array('codigo' => $intCoRegiao), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
