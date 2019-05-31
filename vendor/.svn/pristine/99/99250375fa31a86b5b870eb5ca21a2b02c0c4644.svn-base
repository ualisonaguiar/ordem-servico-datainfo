<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCcp;

/**
 * Class Projeto
 *
 * classe com metodos que retornam dados do Projeto
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Projeto
{

    /**
     * Metodo que retorna informacoes dos Projetos
     *
     * @example $this->projeto();
     *
     * @param integer $intCodigoProjeto
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function projeto($intCodigoProjeto = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('projeto' . ((!empty($intCodigoProjeto)) ? '/' . $intCodigoProjeto : ''), ((!empty($intCodigoProjeto)) ? ['projeto' => $intCodigoProjeto] : []), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

}
