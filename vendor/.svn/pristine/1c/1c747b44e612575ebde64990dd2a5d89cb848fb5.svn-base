<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Programa
 *
 * classe com metodos de listagem de programas cadastrados
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Programa
{

	/**
	 * Metodo para listar programa cadastrado
	 *
	 * @example $this->programa(4)
	 *
	 * @param integer $intCoPrograma
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function programa($intCoPrograma = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/' . __FUNCTION__ . (empty($intCoPrograma) ? '' : '/' . $intCoPrograma), array('codigo' => $intCoPrograma), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
