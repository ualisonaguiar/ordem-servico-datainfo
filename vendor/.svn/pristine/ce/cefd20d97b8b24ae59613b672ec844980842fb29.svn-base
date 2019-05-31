<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class OrgaoEmissor
 *
 * classe com metodos para listagem de orgaos emissores
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait OrgaoEmissor
{

	/**
	 * Metodo para listar orgaos emissores
	 *
	 * @example $this->orgaoEmissor();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function orgaoEmissor(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('orgaoEmissorWithoutCache', func_get_args());
    }

	/**
	 * Metodo para listar orgaos emissores sem o uso do cache
	 *
	 * @example $this->orgaoEmissorWithoutCache();
	 *
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function orgaoEmissorWithoutCache(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService(strtolower(str_replace('WithoutCache', '', __FUNCTION__)), array(), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
