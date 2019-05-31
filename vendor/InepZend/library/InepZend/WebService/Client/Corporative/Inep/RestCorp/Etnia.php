<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Etnia
 *
 * classe com metodos para listagem de etnias
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Etnia
{

	/**
	 * Metodo para listagem de cor e raca
	 *
	 * @example $this->corRaca(1);
	 *
	 * @param integer $intCoCorRaca
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function corRaca($intCoCorRaca = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
		#entidade alterada para etnia
        #return $this->controlCache('corRacaWithoutCache', func_get_args());
		return $this->controlCache('etniaWithoutCache', func_get_args());
    }

	/**
	 * Metodo para listagem de cor e raca sem uso de cache
	 *
	 * @example $this->corRacaWithoutCache(1);
	 *
	 * @param integer $intCoCorRaca
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function corRacaWithoutCache($intCoCorRaca = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
		#entidade alterada para etnia
        #return $this->runService(str_replace('WithoutCache', '', __FUNCTION__) . '/' . $intCoCorRaca, array('codigoCorRaca' => $intCoCorRaca), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
        return $this->runService('etnia' . '/' . $intCoCorRaca, array('codigoCorRaca' => $intCoCorRaca), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

	/**
	 * Metodo para listagem de etnia
	 *
	 * @example $this->etnia(1);
	 *
	 * @param integer $intCoEtnia
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function etnia($intCoEtnia = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('etniaWithoutCache', func_get_args());
    }

	/**
	 * Metodo para listagem de etnia sem uso de cache
	 *
	 * @example $this->etnia(1);
	 *
	 * @param integer $intCoEtnia
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function etniaWithoutCache($intCoEtnia = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(str_replace('WithoutCache', '', __FUNCTION__) . (empty($intCoEtnia) ? '' : '/' . $intCoEtnia), array('codigo' => $intCoEtnia), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
