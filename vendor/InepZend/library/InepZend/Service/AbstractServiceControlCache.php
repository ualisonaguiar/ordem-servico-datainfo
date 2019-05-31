<?php

namespace InepZend\Service;

use InepZend\Util\Reflection;

/**
 * Classe abstrata responsavel pelos metodos controladores do uso de 
 * cache (ex.: memcache) nos resultados dos demais metodos da classe.
 * 
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
 *              [-] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [+] AbstractServiceControlCache
 *                          [-] AbstractServiceCache
 *                              [-] AbstractServiceCacheAngular
 *                          [-] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceControlCache extends AbstractService
{

    private static $strMethodLastCall;
    private static $mixArgumentLastCall;

    /**
     * Metodo responsavel em controlar a execucao de metodos que estejam no cache.
     * Caso o metodo nao esteja no cache, o controlCache o coloca, ficando assim
     * disponivel no cache.
     * Polimorfismo do metodo controlCache da classe abstrata AbstractServiceCoreCache.
     * 
     * @example $this->getService('Path\To\Service')->controlCache('method', array('argumentOne', 'argumentTwo'), 'self::'); <br /> $this->getService('Path\To\Service')->controlCache('method', array('argumentOne', 'argumentTwo'), 'parent::'); <br /> $this->getService('Path\To\Service')->controlCache('method', array('argumentOne', 'argumentTwo'), '$this->');
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @param string $strScope
     * @return mix
     */
    protected function controlCache($strMethod, $mixArgument, $strScope = null)
    {
        return parent::controlCache($strMethod, $mixArgument, (empty($strScope)) ? 'parent' : $strScope);
    }

    /**
     * Metodo responsavel em limpar os dados da classe service no cache, apos a
     * execucao de determinado metodo parametrizado (ex.: insert, update, delete).
     * Polimorfismo do metodo clearCacheAfterExec da classe abstrata AbstractServiceCoreCache.
     * 
     * @example $this->getService('Path\To\Service')->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), 'self::'); <br /> $this->getService('Path\To\Service')->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), 'parent::'); <br /> $this->getService('Path\To\Service')->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), '$this->');
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @param string $strScope
     * @return mix
     */
    protected function clearCacheAfterExec($strMethod, $mixArgument, $strScope = null)
    {
        return parent::clearCacheAfterExec($strMethod, $mixArgument, (empty($strScope)) ? 'parent' : $strScope);
    }

    /**
     * Metodo responsavel em retornar a execucao de um metodo/atributo utilizando
     * o funcao nativa eval.
     * Polimorfismo do metodo execMethod da classe abstrata AbstractServiceCore.
     * 
     * @example $this->getService('Path\To\Service')->execMethod('parent || self || $this->::', 'nameMethod', array('key' => 'value'))
     * 
     * @param string $strScope
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    protected function execMethod($strScope, $strMethod, $mixArgument)
    {
        $strEval = $this->getEvalString($strScope, $strMethod, $mixArgument);
        if (empty($strEval))
            return;
        $this->debugExec($strEval);
        eval($strEval);
        if (isset($mixResult)) {
            $this->debugExec($mixResult);
            return $mixResult;
        }
        return true;
    }

    /**
     * Metodo responsavel em cachear metodos via annotation e utilizando o controlCache.
     * Para realizar a operacao, eh necessario que a visibilidade do metodo seja
     * protegido (protected) e que possua a annotation @cache true.
     * 
     * @example $this->getService('Path\To\Service')->__call('method', array('key' => 'value'));
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @return mix
     */
    public function __call($strMethod, $mixArgument)
    {
        if (!method_exists($this, $strMethod))
            return;
        if ((self::$strMethodLastCall != $strMethod) || (self::$mixArgumentLastCall != $mixArgument)) {
            self::$strMethodLastCall = $strMethod;
            self::$mixArgumentLastCall = $mixArgument;
            $arrAnnotation = Reflection::listAnnotationsFromMethod($this, $strMethod);
            if ((is_array($arrAnnotation)) && (array_key_exists('CACHE', $arrAnnotation)) && (in_array(strtolower($arrAnnotation['CACHE']), array('1', 'true', 'yes', 'sim'))))
                return $this->controlCache($strMethod, $mixArgument);
        }
        return parent::__call($strMethod, $mixArgument);
    }

}
