<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Uf
 *
 * classe com metodos para listagem de UFs
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Uf
{

    /**
     * Metodo para listar informacoes de UF
     *
     * @example $this->uf(53);
     *
     * @param integer $intCoUf
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function uf($intCoUf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('ufWithoutCache', func_get_args());
    }

    /**
     * Metodo para listar informacoes de UF sem o uso de cache
     *
     * @example $this->ufWithoutCache(53);
     *
     * @param integer $intCoUf
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function ufWithoutCache($intCoUf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/' . str_replace('WithoutCache', '', __FUNCTION__) . (empty($intCoUf) ? '' : '/' . $intCoUf), array('codigo' => $intCoUf), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
