<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Municipio
 *
 * classe com metodos para retorno de informacoes de municipios
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Municipio
{

	/**
	 * Metodo para obter dados do municipio
	 *
	 * @example $this->municipio(5300108);
	 *
	 * @param integer $intCoMunicipio
	 * @param integer $intCoUf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function municipio($intCoMunicipio = null, $intCoUf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('municipioWithoutCache', func_get_args());
    }

	/**
	 * Metodo para obter dados do municipio sem uso de cache
	 *
	 * @example $this->municipioWithoutCache(5300108);
	 *
	 * @param integer $intCoMunicipio
	 * @param integer $intCoUf
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function municipioWithoutCache($intCoMunicipio = null, $intCoUf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $strMethod = str_replace('WithoutCache', '', __FUNCTION__);
        $arrParam = array();
        if (!empty($intCoMunicipio)) {
            $strMethod .= '/' . $intCoMunicipio;
            $arrParam['codigoMunicipio'] = $intCoMunicipio;
//            $arrParam['codigo'] = $intCoMunicipio;
        } elseif (!empty($intCoUf)) {
            $strMethod .= '/uf/' . $intCoUf;
            $arrParam['codigoUf'] = $intCoUf;
        }
        return $this->runService($strMethod, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

	/**
	 * Metodo para obter listagem de municipios correspondentes a um DDD
	 *
	 * @example $this->municipioDdd(61);
	 *
	 * @param integer $intNuDdd
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function municipioDdd($intNuDdd = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('municipioDddWithoutCache', func_get_args());
    }

	/**
	 * Metodo para obter listagem de municipios correspondentes a um DDD sem uso de cache
	 *
	 * @example $this->municipioDdd(61);
	 *
	 * @param integer $intNuDdd
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function municipioDddWithoutCache($intNuDdd = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/municipio/ddd' . (empty($intNuDdd) ? '' : '/' . $intNuDdd), array('numeroDdd' => $intNuDdd), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
