<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Pais
 *
 * classe com metodos para listagem de paises, nacionalidades, codigo DDI e relacao diplomatica
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Pais
{

	/**
	 * Metodo para listagem de paises
	 *
	 * @example $this->pais();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function pais(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('paisWithoutCache', func_get_args());
    }

	/**
	 * Metodo para listagem de paises sem o uso de cache
	 *
	 * @example $this->pais();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function paisWithoutCache(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(str_replace('WithoutCache', '', __FUNCTION__), array(), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
