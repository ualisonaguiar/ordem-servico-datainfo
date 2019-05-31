<?php

namespace InepZend\Util;

trait MethodArgumentTrait
{

    /**
     * Metodo responsavel em retornar a execucao de um metodo no formato de string.
     *
     * @example $this->getEvalString('\InepZend\Service\AbstractServiceCore::', 'method', array('param1', 'param2')) <br /> $this->getEvalString('parent::', 'method', array('param1', 'param2')) <br /> $this->getEvalString('self::', 'method', array('param1', 'param2')) <br /> $this->getEvalString('$this->', 'method', array('param1', 'param2'))
     *
     * @param string $strScope
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function getEvalString($strScope = null, $strMethod = null, $mixArgument = null)
    {
        if ((empty($strScope)) || (empty($strMethod)))
            return false;
        $arrArgument = array();
        foreach ((array) $mixArgument as $intKey => $strParam)
            $arrArgument[] = '$mixArgument[' . $intKey . ']';
        $strEval = '$mixResult = ' . $strScope . $strMethod . '(' . implode(', ', $arrArgument) . ');';
        return $strEval;
    }

    /**
     * Metodo responsavel em retornar a execucao de um metodo/atributo utilizando 
     * a palavra reservada 'parent'.
     *
     * @example $this->execParentMethod('method', array('param1', 'param2'))
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function execParentMethod($strMethod = null, $mixArgument = null)
    {
        return $this->execMethod('parent::', $strMethod, $mixArgument);
    }

    /**
     * Metodo responsavel em retornar a execucao de um metodo/atributo utilizando 
     * a palavra reservada 'self'.
     *
     * @example $this->execSelfMethod('method', array('param1', 'param2'))
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function execSelfMethod($strMethod = null, $mixArgument = null)
    {
        return $this->execMethod('self::', $strMethod, $mixArgument);
    }

    /**
     * Metodo responsavel em retornar a execucao de um metodo/atributo utilizando 
     * a palavra reservada '$this'.
     *
     * @example $this->execThisMethod('method', array('param1', 'param2'))
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function execThisMethod($strMethod = null, $mixArgument = null)
    {
        return $this->execMethod('$this->', $strMethod, $mixArgument);
    }

    /**
     * Metodo responsavel em retornar a execucao de um metodo/atributo utilizando 
     * a palavra reservada 'eval'.
     *
     * @example $this->execMethod('parent || self || $this->::', 'nameMethod', array('key' => 'value'))
     * 
     * @param string $strScope
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function execMethod($strScope = null, $strMethod = null, $mixArgument = null)
    {
        $strEval = $this->getEvalString($strScope, $strMethod, $mixArgument);
        if (empty($strEval))
            return false;
        eval($strEval);
//        if (!isset($mixResult))
//            return true;
        return $mixResult;
    }

}
