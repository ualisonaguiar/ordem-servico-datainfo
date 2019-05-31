<?php

namespace InepZend\Util;

use InepZend\Util\Format;

/**
 * Classe responsavel no tratamento de operacoes matematicas.
 *
 * @package InepZend
 * @subpackage Util
 */
class Math
{

    /**
     * Metodo responsavel em realizar uma operacao matematica dentro de uma 
     * estrutura de repeticao.
     *
     * @example \InepZend\Util\Math::loopOperation(80, '+', 3, 2)
     *
     * @param string $strEvalInicialValue
     * @param string $strOperator
     * @param string $strEvalOperatorValue
     * @param integer $intLoop
     * @return mix
     *
     * @assert () === false
     * @assert (null, null, null, null) === false
     * @assert ('a', '+', 2, 1) === false
     * @assert (8, '+', 2, 'a') === false
     *
     * @assert (80, '+', 3, 2) === 86
     * @assert ((80 * 2), '+', (3 * 8), 2) === 208
     * @assert ('(80 * 2)', '+', '(3 * 8)', '2') === 208
     *
     * @assert (80, '-', 3, 2) === 74
     * @assert ((80 * 2), '-', (3 * 8), 2) === 112
     * @assert ('(80 * 2)', '-', '(3 * 8)', '2') === 112
     *
     * @assert (3, '-', 80, 2) === -157
     * @assert ((3 * 8), '-', (80 * 2), 2) === -296
     * @assert ('(3 * 8)', '-', '(80 * 2)', '2') === -296
     *
     * @assert (80, '*', 3, 2) === 720
     * @assert ((80 * 2), '*', (3 * 8), 2) === 92160
     * @assert ('(80 * 2)', '*', '(3 * 8)', '2') === 92160
     *
     * @assert (80, '/', 3, 2) === 8.8888888888889
     * @assert ((80 * 2), '/', (3 * 8), 2) === 0.27777777777778
     * @assert ('(80 * 2)', '/', '(3 * 8)', '2') === 0.27777777777778
     *
     * @assert (3, '/', 80, 2) === 0.00046875
     * @assert ((3 * 8), '/', (80 * 2), 2) === 0.0009375
     * @assert ('(3 * 8)', '/', '(80 * 2)', '2') === 0.0009375
     */
    public static function loopOperation($strEvalInicialValue = null, $strOperator = null, $strEvalOperatorValue = null, $intLoop = null)
    {
        if ((empty($strEvalInicialValue)) || (empty($strOperator)) || (empty($strEvalOperatorValue)) || (!is_numeric($intLoop)))
            return false;
        if (Format::hasString($strEvalInicialValue))
            $strEvalInicialValue = '"' . $strEvalInicialValue . '"';
        eval('$mixInicialValue = (' . $strEvalInicialValue . ');');
        if (!is_numeric($mixInicialValue))
            return false;
        if (Format::hasString($strEvalOperatorValue))
            $strEvalOperatorValue = '"' . $strEvalOperatorValue . '"';
        eval('$mixOperatorValue = (' . $strEvalOperatorValue . ');');
        if (!is_numeric($mixOperatorValue))
            return false;
        $mixResult = $mixInicialValue;
        for ($intCount = 0; $intCount < $intLoop; ++$intCount)
            eval('$mixResult = ($mixResult ' . $strOperator . ' $mixOperatorValue);');
        return $mixResult;
    }

    /**
     * Metodo responsavel em calcular o percentual de um determinado valor em 
     * relacao ao total.
     *
     * @example \InepZend\Util\Math::getPercent(100, 30)
     *
     * @param mix $mixValueTotal
     * @param mix $mixValue
     * @param integer $intPrecision
     * @return mix
     *
     * @assert () === false
     * @assert (null, null) === false
     * @assert (null, 30) === false
     * @assert (100, null) === false
     * @assert ('a', 30) === false
     * @assert (100, 'a') === false
     *
     * @assert (100, 30) === 30
     * @assert (30, 100) === 333.33333333333
     * @assert (100, 30, 0) === 30.0
     * @assert (30, 100, 0) === 333.0
     * @assert (100, 30, 1) === 30.0
     * @assert (30, 100, 1) === 333.3
     * @assert (100, 30, 2) === 30.00
     * @assert (30, 100, 2) === 333.33
     *
     * @assert (123.32, 12.3) === 9.9740512487837
     * @assert (12.3, 123.32) === 1002.6016260163
     * @assert (123.32, 12.3, 0) === 10.0
     * @assert (12.3, 123.32, 0) === 1003.0
     * @assert (123.32, 12.3, 1) === 10.0
     * @assert (12.3, 123.32, 1) === 1002.6
     * @assert (123.32, 12.3, 2) === 9.97
     * @assert (12.3, 123.32, 2) === 1002.60
     *
     * @assert (123.32, 11.6) === 9.406422315926
     * @assert (11.6, 123.32) === 1063.1034482759
     * @assert (123.32, 11.6, 0) === 9.0
     * @assert (11.6, 123.32, 0) === 1063.0
     * @assert (123.32, 11.6, 1) === 9.4
     * @assert (11.6, 123.32, 1) === 1063.1
     * @assert (123.32, 11.6, 2) === 9.41
     * @assert (11.6, 123.32, 2) === 1063.10
     */
    public static function getPercent($mixValueTotal = null, $mixValue = null, $intPrecision = null)
    {
        if ((!is_numeric($mixValueTotal)) || (!is_numeric($mixValue)))
            return false;
        $mixResult = ($mixValue * 100) / $mixValueTotal;
        if ((is_numeric($intPrecision)) && ($mixResult !== null))
            $mixResult = round($mixResult, $intPrecision);
        return $mixResult;
    }

}
