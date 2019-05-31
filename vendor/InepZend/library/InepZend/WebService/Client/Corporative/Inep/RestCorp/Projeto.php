<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Projeto
 *
 * classe com metodos para listagem de projetos
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Projeto
{

	/**
	 * Metodo para listagem de informacoes do projeto
	 *
	 * @example $this->projetoEvento(1510401, 20);
	 *
	 * @param integer $intCoProjeto
	 * @param integer $intCoEvento
	 * @param array $arrHeader
	 * @param string $strUrl
	 * @param bool $booDebug
	 * @param array $arrConfig
	 * @return mixed
	 */
    public function projetoEvento($intCoProjeto = null, $intCoEvento = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intCoProjeto)) || (empty($intCoEvento)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/projeto/' . $intCoProjeto . '/evento/' . $intCoEvento, array('codigoProjeto' => $intCoProjeto, 'codigoEvento' => $intCoEvento), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

}
