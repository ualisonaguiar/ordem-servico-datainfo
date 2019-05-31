<?php

namespace InepZend\Util;

use InepZend\Exception\RuntimeException;

/**
 * Trait responsavel em trabalhar com parametros utilizados em requisicoes.
 *
 * @package InepZend
 * @subpackage Util
 */
trait ArrayParamTrait
{

    /**
     * Metodo responsavel em retornar parametros editados com nome e valores respectivamente.
     *
     * @param array $arrParam
     * @param integer $intArgumentTotal
     * @param array $arrParamExtra
     * @param boolean $booCheckName
     * @param array $arrParamDefault
     * @return mix
     */
    private function getParamEdited($arrParam = null, $intArgumentTotal = null, $arrParamExtra = null, $booCheckName = true, $arrParamDefault = null)
    {
        if (is_null($arrParamDefault))
            $arrParamDefault = (isset($this->arrParamDefault)) ? $this->arrParamDefault : array();
        $arrParam = $this->getParam($arrParam, $intArgumentTotal, array_merge($arrParamDefault, (array) $arrParamExtra));
        if ($booCheckName !== false)
            $this->checkNameParam($arrParam);
        return ((is_array($arrParam)) && (empty($arrParam))) ? $arrParam : $this->editGetParam($arrParam);
    }

    /**
     * Metodo responsavel em retornar o(s) argumento(s) do(s) parametro(s).
     *
     * @param array $arrParam
     * @param string $strVar
     * @param integer $intArgument
     * @return mix
     */
    private function getArgumentParam(array $arrParam, &$strVar, $intArgument)
    {
        $strVar = ((!is_array(@$arrParam[0])) && (array_key_exists($intArgument, $arrParam))) ? $arrParam[$intArgument] : null;
    }

    /**
     * Metodo responsavel em retornar o(s) arqumento(s) de um array do parametro.
     *
     * @param array $arrParam
     * @param string $strVar
     * @param string $strArgument
     * @return mix
     */
    private function getArgumentArray(array $arrParam, &$strVar, $strArgument)
    {
        $strVar = ((is_array(@$arrParam[0])) && (array_key_exists($strArgument, $arrParam[0]))) ? $arrParam[0][$strArgument] : null;
    }

    /**
     * Metodo responsavel em retornar merge de arrays.
     *
     * @param array $arrParamDefault
     * @param array $arrParam
     * @param booleano $booClear
     * @return array
     */
    private function mergeParam($arrParamDefault = null, $arrParam = null, $booClear = false)
    {
        if ((empty($arrParam)) || (!is_array($arrParam)))
            $arrParam = array();
        foreach ((array) $arrParamDefault as $intArgument => $arrArgument) {
            $$arrArgument[1] = null;
            $this->getArgumentParam($arrParam, $$arrArgument[1], $intArgument);
            if (empty($$arrArgument[1]))
                $this->getArgumentArray($arrParam, $$arrArgument[1], $arrArgument[0]);
        }
        $arrMergeParamDefault = array();
        foreach ((array) $arrParamDefault as $arrArgument) {
            if (($booClear) && (is_null($$arrArgument[1])))
                continue;
            $arrMergeParamDefault[] = array($arrArgument[0], $arrArgument[1], $$arrArgument[1]);
        }
        return $arrMergeParamDefault;
    }

    /**
     * Metodo responsavel em retornar os parametros.
     *
     * @param array $arrParam
     * @param integer $intArgumentTotal
     * @param array $arrParamDefault
     * @return array
     */
    private function getParam($arrParam = null, $intArgumentTotal = null, $arrParamDefault = null)
    {
        if (!is_array($arrParam))
            $arrParam = array();
        if (empty($intArgumentTotal))
            $intArgumentTotal = 1;
        if ($intArgumentTotal > 1) {
            $arrParamNew = array();
            foreach ($this->mergeParam((array) $arrParamDefault, $arrParam, true) as $arrArgument)
                $arrParamNew[0][$arrArgument[0]] = $arrArgument[2];
            $arrParam = $arrParamNew;
        }
        return $arrParam;
    }

    /**
     * Metodo responsavel em checar os nomes dos parametros.
     *
     * @param array $arrParam
     * @return mix
     */
    private function checkNameParam($arrParam = null)
    {
        if ((!is_array($arrParam)) || (!array_key_exists(0, $arrParam)) || ((is_array($arrParam[0])) && (!array_key_exists('name', $arrParam[0]))))
            throw new RuntimeException('Não foi possível identificar o nome do elemento no formulário.');
        return true;
    }
    
    /**
     * Metodo responsavel em checar o formato dos parametros.
     *
     * @param array $arrParam
     * @return mix
     */
    private function checkFormatParam($arrParam = null)
    {
        if ((!is_array($arrParam)) || (!array_key_exists(0, $arrParam)))
            throw new RuntimeException('Os parâmetros não estão no formato esperado.');
        return true;
    }

    /**
     * Metodo responsavel em retorna o pametro formatado, o mesmo retorna com a key name.
     *
     * @param array $arrParam
     * @return mix
     */
    private function editGetParam($arrParam = null)
    {
        $this->checkFormatParam($arrParam);
        $arrParamResult = @$arrParam[0];
        if ((!empty($arrParamResult)) && (!is_array($arrParamResult)))
            $arrParamResult = array('name' => $arrParamResult);
        return $arrParamResult;
    }

    /**
     * Metodo responsavel em remover parametros.
     *
     * @param mix $mixParam
     * @param array $arrParamDefault
     * @return array
     */
    private function removeParamDefault($mixParam = null, $arrParamDefault = null)
    {
        if (empty($mixParam))
            return array();
        if (!is_array($mixParam))
            $mixParam = array($mixParam);
        $arrResult = array();
        if (empty($arrParamDefault))
            $arrParamDefault = (isset($this->arrParamDefault)) ? (array) $this->arrParamDefault : array();
        foreach ($arrParamDefault as $intArgument => $arrArgument)
            if (!in_array($intArgument, $mixParam))
                $arrResult[] = $arrArgument;
        return $arrResult;
    }

    private function setValueIntoEmptyParam(&$arrParam = null, $arrParamValue = null)
    {
        if ((!is_array($arrParam)) || (!is_array($arrParamValue)))
            return false;
        foreach ($arrParamValue as $strParam => $mixValue)
            if ((!array_key_exists($strParam, $arrParam)) || ((array_key_exists($strParam, $arrParam)) && (is_null($arrParam[$strParam]))))
                $arrParam[$strParam] = $mixValue;
        return true;
    }

    private function getParamValue($arrParam = null, $strParam = null, $strIndex = null)
    {
        if ((empty($arrParam)) || (empty($strParam)))
            return;
        return (empty($strIndex)) ? @$arrParam[$strParam] : @$arrParam[$strParam][$strIndex];
    }

}
