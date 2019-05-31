<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class SubDistrito
 *
 * classe com metodos para listagem de subdistritos
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait SubDistrito
{

    /**
     * Metodo para listar dados do subdistrito
     *
     * @example $this->subDistrito(32052002507);
     *
     * @param integer $intCoSubDistrito
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function subDistrito($intCoSubDistrito = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('subDistritoWithoutCache', func_get_args());
    }

    /**
     * Metodo para listar dados do subdistrito sem o uso de cache
     *
     * @example $this->subDistritoWithoutCache(32052002507);
     *
     * @param integer $intCoSubDistrito
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function subDistritoWithoutCache($intCoSubDistrito = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/' . strtolower(str_replace('WithoutCache', '', __FUNCTION__)) . (empty($intCoSubDistrito) ? '' : '/' . $intCoSubDistrito), array('codigo' => $intCoSubDistrito), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
