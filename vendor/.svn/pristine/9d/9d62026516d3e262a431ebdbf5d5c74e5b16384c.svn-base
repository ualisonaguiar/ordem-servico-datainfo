<?php

namespace InepZend\Configurator;

use InepZend\Exception\Exception;
use \Exception as ExceptionNative;
use \Traversable as TraversableNative;

/**
 * Classe responsavel por configurar um objeto executando determinado metodo para
 * incluir os atributos parametrizados no array de dados.
 * 
 * @package InepZend
 * @subpackage Configurator
 */
class Configurator
{

    /**
     * Metodo responsavel em configurar um objeto de entidade executando todos os
     * metodos setters referentes aos atributos parametrizados no array de dados.
     * 
     * @param object $entity
     * @param array $arrData
     * @param boolean $booTryCall
     * @return mix
     */
    public static function configure($entity = null, $arrData = null, $booTryCall = false)
    {
        return self::configureAction($entity, $arrData, false, $booTryCall);
    }

    /**
     * Metodo responsavel em configurar um objeto de DTO executando o metodo addData
     * para incluir os atributos parametrizados no array de dados.
     * 
     * @param object $dto
     * @param array $arrData
     * @param boolean $booTryCall
     * @return mix
     */
    public static function configureDto($dto = null, $arrData = null, $booTryCall = false)
    {
        return self::configureAction($dto, $arrData, true, $booTryCall);
    }

    /**
     * Metodo responsavel em configurar um objeto executando determinado metodo 
     * para incluir os atributos parametrizados no array de dados.
     * 
     * @param object $instance
     * @param array $arrData
     * @param boolean $booTryCall
     * @return mix
     */
    private static function configureAction($instance = null, $arrData = null, $booDto = true, $booTryCall = false)
    {
        if (!is_object($instance))
            throw new Exception('Objeto não informado.');
        if (is_null($arrData))
            return;
        if ((!($arrData instanceof TraversableNative)) && (!is_array($arrData)))
            throw new Exception('Estrutura dos dados não informada.');
        $booTryCall = (bool) (($booTryCall) && (method_exists($instance, '__call')));
        foreach ($arrData as $strName => &$mixValue) {
            $strSetter = (!$booDto) ? 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $strName))) : 'addData';
            if (($booTryCall) || (method_exists($instance, $strSetter))) {
                try {
                    if (!$booDto)
                        call_user_func(array($instance, $strSetter), $mixValue);
                    else
                        call_user_func(array($instance, $strSetter), $strName, $mixValue);
                } catch (ExceptionNative $exception) {
                    throw Exception::cloneException($exception);
                }
            } else
                continue;
        }
        return $instance;
    }

}
