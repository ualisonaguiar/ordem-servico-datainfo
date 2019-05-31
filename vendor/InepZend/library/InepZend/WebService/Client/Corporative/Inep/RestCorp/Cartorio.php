<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Cartorio
 *
 * classe com metodos que retornam dados de cartorios
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Cartorio
{

    /**
	 * Metodo que retorna informacoes do cartorio pelo seu codigo identificador
	 *
	 * @example $this->cartorios(ID_CARTORIO);
	 *
     * @param integer $intCoCartorio
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function cartorios($intCoCartorio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('cartoriosWithoutCache', func_get_args());
    }

    /**
	 * Metodo que retorna informacoes do cartorio pelo seu codigo identificador porem sem utilizar dados de cache
	 *
	 * @example $this->cartoriosWithoutCache(ID_CARTORIO);
	 *
     * @param integer $intCoCartorio
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
     */
    public function cartoriosWithoutCache($intCoCartorio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(str_replace('WithoutCache', '', __FUNCTION__) . (empty($intCoCartorio) ? '' : '/' . $intCoCartorio), array('codigo' => $intCoCartorio), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
	 * Metodo que retorna informacoes dos cartorios do municipio passado como parametro
	 *
	 * @example $this->cartoriosMunicipio(ID_MUNICIPIO);
	 *
     * @param integer $intCoMunicipio
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
     */
    public function cartoriosMunicipio($intCoMunicipio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('cartoriosMunicipioWithoutCache', func_get_args());
    }

    /**
	 * Metodo que retorna informacoes dos cartorios do municipio passado como parametro porem sem utilizar dados de cache
	 *
	 * @example $this->cartoriosMunicipioWithoutCache(ID_MUNICIPIO);
	 *
     * @param integer $intCoMunicipio
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
     */
    public function cartoriosMunicipioWithoutCache($intCoMunicipio = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (empty($intCoMunicipio))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('cartorios/municipio/' . $intCoMunicipio, array('codigoMunicipio' => $intCoMunicipio), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
