<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class EstadoCivil
 *
 * classe com metodos para listar tipos de estado civil
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait EstadoCivil
{

	/**
	 * Metodo para listar os tipos de estado civil
	 *
	 * @example $this->estadoCivil();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function estadoCivil(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('estadoCivilWithoutCache', func_get_args());
    }

	/**
	 * Metodo para listar os tipos de estado civil sem o uso do cache
	 *
	 * @example $this->estadoCivil();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function estadoCivilWithoutCache(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(strtolower(str_replace('WithoutCache', '', __FUNCTION__)), null, $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
