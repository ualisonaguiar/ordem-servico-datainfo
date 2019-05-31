<?php

namespace InepZend\Cache\Service;

use InepZend\Cache\Service\CacheTrait;
use Zend\Json\Encoder;

/**
 * Trait responsavel pelos metodos de controle do uso do 
 * retorno de um metodo armazenado no cache (ex.: memcache).
 *
 * [-] CoreCacheTrait
 *      [-] CacheTrait
 *          [+] ControlCacheTrait
 *
 * @package InepZend
 * @subpackage Cache
 */
trait ControlCacheTrait
{

    use CacheTrait;

    private static $booActiveMemcache;

    /**
     * Metodo responsavel em controlar a execucao de metodos que estejam no cache.
     * 
     * @example $this->controlCache('method', array('argumentOne', 'argumentTwo'), 'self::'); <br /> $this->controlCache('method', array('argumentOne', 'argumentTwo'), 'parent::'); <br /> $this->controlCache('method', array('argumentOne', 'argumentTwo'), '$this->');
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @param string $strScope
     * @return mix
     */
    protected function controlCache($strMethod = null, $mixArgument = null, $strScope = null)
    {
        if (!is_bool(self::$booActiveMemcache))
            self::$booActiveMemcache = $this->getCache()->hasActiveMemcache();
        if (self::$booActiveMemcache) {
            $strKey = $this->generateKey($strMethod, $mixArgument);
            if (empty($strKey))
                return false;
            $booHas = $this->hasItemCache($strKey);
            if (method_exists($this, 'debugExec'))
                $this->debugExec($booHas);
            if ($booHas) {
                if ($this::CLEAR_MEMCACHE === true)
                    $this->removeItemCache($strKey);
                else {
                    if (method_exists($this, 'debugExec'))
                        $this->debugExec('COM cache');
                    return $this->getItemCache($strKey);
                }
            }
        }
        if (empty($strScope))
            $strScope = 'this';
        $strMethodExec = 'exec' . ucfirst($strScope) . 'Method';
        if (method_exists($this, 'debugExec')) {
            $this->debugExec('SEM cache');
            $this->debugExec($strMethodExec);
            $this->debugExec(get_class($this));
        }
        $mixResult = $this->$strMethodExec($strMethod, $mixArgument);
        if (self::$booActiveMemcache)
            $this->setItemCache($strKey, $mixResult);
        return $mixResult;
    }

    /**
     * Metodo responsavel em limpar os dados da classe service, no cache, apos a
     * execucao de determinado metodo parametrizado (ex.: insert, update, delete).
     * 
     * @example $this->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), 'self::'); <br /> $this->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), 'parent::'); <br /> $this->clearCacheAfterExec('method', array('argumentOne', 'argumentTwo'), '$this->');
     * 
     * @param string $strMethod
     * @param mix $mixArgument
     * @param string $strScope
     * @return mix
     */
    protected function clearCacheAfterExec($strMethod = null, $mixArgument = null, $strScope = null)
    {
        if (empty($strScope))
            $strScope = 'this';
        $strMethodExec = 'exec' . ucfirst($strScope) . 'Method';
        $mixResult = $this->$strMethodExec($strMethod, $mixArgument);
        $this->removeAllItemCache();
        return $mixResult;
    }

    /**
     * Metodo responsavel em gerar uma chave. O mesmo ira conter os dados da classe,
     * do metodo e dos atributos a serem colocados no cache, ou seja, a assinatura
     * do metodo.
     * 
     * @example $this->generateKey($strMethod, $mixArgument);
     * 
     * @param string $strMethod
     * @param myx $mixArgument
     * @return mix
     */
    private function generateKey($strMethod = null, $mixArgument = null)
    {
        if (empty($strMethod))
            return false;
        $arrKey = array(get_class($this) => array($strMethod => $mixArgument));
        $strEncode = md5(Encoder::encode($arrKey));
        if (method_exists($this, 'debugExec'))
            $this->debugExec([$strEncode => $arrKey]);
        return $strEncode;
    }

}
