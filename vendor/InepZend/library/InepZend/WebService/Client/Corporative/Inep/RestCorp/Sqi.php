<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Class Sqi
 *
 * classe com metodos para obter informacoes de questionarios
 *
 * @package InepZend\WebService\Client\Corporative\Inep\RestCorp
 */
trait Sqi
{

    /**
     * Metodo para retorno de dados do questionario/projeto
     *
     * @example $this->questionariosProjeto(15, 1510701);
     *
     * @param integer $intCoQuestionario
     * @param integer $intCoProjeto
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function questionariosProjeto($intCoQuestionario = null, $intCoProjeto = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intCoQuestionario)) || (empty($intCoProjeto)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/sqi/questionarios/' . $intCoQuestionario . '/projeto/' . $intCoProjeto, array('idQuestionario' => $intCoQuestionario, 'codigoProjeto' => $intCoProjeto), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     * Metodo para listagem de situacoes permitidas para os questionario
     *
     * @example $this->situacoes();
     *
     * @param array $arrHeader
     * @param string $strUrl
     * @param bool $booDebug
     * @param array $arrConfig
     * @return mixed
     */
    public function situacoes(array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->runService('inep/sqi/' . __FUNCTION__, array(), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     * Metodo para retorno de dados do questionario/projeto
     *
     * @example $this->questionarioProjetoEvento(1510701, 18);
     *
     * @param null $intCoProjeto
     * @param null $intCoEvento
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     * @return mixed
     */
    public function questionarioProjetoEvento($intCoProjeto = null, $intCoEvento = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intCoProjeto)) || (empty($intCoEvento)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/sqi/questionario/' . $intCoProjeto . '/evento/' . $intCoEvento, ['codigoProjeto' => $intCoProjeto, 'codigoEvento' => $intCoEvento], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }

    /**
     * Metodo para retorno de dados do questionario/projeto
     *
     * @example $this->codigoQuestionarioProjetoEvento(26, 52, 1710401);
     *
     * @param null $intCoQuestionario
     * @param null $intCoEvento
     * @param null $intCoProjeto
     * @param array $arrHeader
     * @param null $strUrl
     * @param null $booDebug
     * @param null $arrConfig
     * @return mixed
     */
    public function codigoQuestionarioProjetoEvento($intCoQuestionario = null, $intCoEvento = null, $intCoProjeto = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($intCoProjeto)) || (empty($intCoEvento)) || (empty($intCoQuestionario)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/sqi/codigoQuestionario/' . $intCoQuestionario . '/evento/' . $intCoEvento . '/projeto/' . $intCoProjeto, ['codigoQuestionario' => $intCoQuestionario, 'codigoEvento' => $intCoEvento, 'codigoProjeto' => $intCoProjeto], $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig, true);
    }
}
