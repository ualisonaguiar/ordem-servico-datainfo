<?php

namespace InepZend\Cache\Service;

use InepZend\Cache\Service\CoreCacheTrait;

/**
 * Trait responsavel pelos metodos set/get/clear de chaves => valores no
 * cache (ex.: memcache).
 *
 * [-] CoreCacheTrait
 *      [+] CacheTrait
 *          [-] ControlCacheTrait
 *
 * @package InepZend
 * @subpackage Cache
 */
trait CacheTrait
{

    use CoreCacheTrait;
    
    public static $booUseNamespaceCache = false;

    /**
     * Metodo responsavel em setar valor no cache.
     *
     * @param string $strAttribute
     * @param mix $mixValue
     * @param string $strKey
     * @return boolean
     */
    protected function setAttributeCache($strAttribute = null, $mixValue = null, $strKey = null)
    {
        if ((empty($strAttribute)) || (!$this->getCache()->hasActiveMemcache()))
            return false;
        if (!empty($strKey)) {
            $arrData = $this->getAttributeCache($strAttribute);
            if (!is_array($arrData))
                $arrData = array();
            $arrData[$strKey] = $mixValue;
            $mixValue = $arrData;
        }
        $mixResult = (!self::$booUseNamespaceCache) ? $this->getCache()->setItem($strAttribute, $mixValue) : $this->setItemCache($strAttribute, $mixValue);
        return true;
    }

    /**
     * Metodo responsavel em retornar o valor no cache.
     *
     * @param string $strAttribute
     * @param string $strKey
     * @return mix
     */
    protected function getAttributeCache($strAttribute = null, $strKey = null)
    {
        if ((empty($strAttribute)) || (!$this->getCache()->hasActiveMemcache()))
            return false;
        $mixValue = (!self::$booUseNamespaceCache) ? $this->getCache()->getItem($strAttribute) : $this->getItemCache($strAttribute);
        if ((!empty($strKey)) && (is_array($mixValue)))
            $mixValue = @$mixValue[$strKey];
        return $mixValue;
    }

    /**
     * Metodo responsavel em limpar o valor no cache.
     *
     * @param string $strAttribute
     * @param string $strKey
     * @return mix
     */
    protected function clearAttributeCache($strAttribute = null, $strKey = null)
    {
        if ((empty($strAttribute)) || (!$this->getCache()->hasActiveMemcache()))
            return false;
        if (empty($strKey))
            $mixResult = (!self::$booUseNamespaceCache) ? $this->getCache()->removeItem($strAttribute) : $this->removeItemCache($strAttribute);
        else
            $this->setAttributeCache($strAttribute, null, $strKey);
        return true;
    }

}
