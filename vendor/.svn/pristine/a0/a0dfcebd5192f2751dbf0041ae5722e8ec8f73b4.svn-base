<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Distrito
 *
 * classe com metedos para busca de distritos e seus municipios
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Distrito
{

	/**
	 * Metodo que lista informações do distrito
	 *
	 * @example $this->distritos(530010805);
	 *
	 * @param integer $intCoDistrito
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function distritos($intCoDistrito = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('distritosWithoutCache', func_get_args());
    }

	/**
	 * Metodo que lista informações do distrito sem usar o cache
	 *
	 * @example $this->distritosWithoutCache(530010805);
	 *
	 * @param integer $intCoDistrito
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function distritosWithoutCache($intCoDistrito = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(str_replace('WithoutCache', '', __FUNCTION__) . (empty($intCoDistrito) ? '' : '/' . $intCoDistrito), array('codigo' => $intCoDistrito), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

	/**
	 * Metodo que lista informacoes do distrito pelo codigo do municipio
	 *
	 * @example $this->distritosMunicipio(5300108);
	 *
	 * @param integer $intCoMunicipio
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function distritosMunicipio($intCoMunicipio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('distritosMunicipioWithoutCache', func_get_args());
    }

	/**
	 * Metodo que lista informacoes do distrito pelo codigo do municipio sem usar o cache
	 *
	 * @example $this->distritosMunicipioWithoutCache(5300108);
	 *
	 * @param integer $intCoMunicipio
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
	public function distritosMunicipioWithoutCache($intCoMunicipio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intCoMunicipio))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('distritos/municipio/' . $intCoMunicipio, array('codigoMunicipio' => $intCoMunicipio), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
