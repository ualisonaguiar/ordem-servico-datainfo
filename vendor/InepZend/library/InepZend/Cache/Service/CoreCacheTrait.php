<?php

namespace InepZend\Cache\Service;

/**
 * Trait responsavel pelos metodos de manipulacao de chaves => valores
 * de cada classe no cache (ex.: memcache).
 *
 * [+] CoreCacheTrait
 *      [-] CacheTrait
 *          [-] ControlCacheTrait
 *
 * @package InepZend
 * @subpackage Cache
 */
trait CoreCacheTrait
{

    private static $intItemCacheTimeLife;

    /**
     * Metodo responsavel em remover todos os itens que estejam no cache.
     * 
     * @example $this->removeAllItemCache();
     * 
     * @return boolean
     */
    protected function removeAllItemCache()
    {
        if (!is_object(($cache = $this->getCache())))
            return false;
        $strKeyClass = get_class($this);
        if (!$cache->hasItem($strKeyClass))
            return true;
        return $cache->removeItem($strKeyClass);
    }

    /**
     * Metodo responsavel em verificar se existe a chave no cache.
     * 
     * @example $this->hasItemCache($key);
     * 
     * @param string $strKey
     * @return boolean
     */
    private function hasItemCache($strKey = null)
    {
        if (empty($strKey))
            return false;
        $arrItem = $this->getAllItemCache();
        if (!is_array($arrItem))
            return false;
        $booHas = array_key_exists($strKey, $arrItem);
        if ($booHas) {
            $intItemCacheTimeLife = self::getItemCacheTimeLife();
            if ((!is_null($intItemCacheTimeLife)) && ((time() - $arrItem[$strKey][1]['create_time']) > $intItemCacheTimeLife))
                $booHas = false;
        }
        return $booHas;
    }

    /**
     * Metodo responsavel em setar valores no cache/memcached.
     * 
     * @example $this->setItemCache($key, $value);
     * 
     * @param string $strKey
     * @param mix $mixValue
     * @return mix
     */
    private function setItemCache($strKey = null, $mixValue = null)
    {
        if (empty($strKey))
            return false;
        $arrItem = $this->getAllItemCache();
        if (!is_array($arrItem))
            $arrItem = [];
        $arrItem[$strKey] = array($mixValue, ['create_time' => time()]);
        return $this->setAllItemCache($arrItem);
    }

    /**
     * Metodo responsavel em retornar os itens do cache.
     * 
     * @example $this->getItemCache($strKey);
     * 
     * @param string $strKey
     * @return mix
     */
    private function getItemCache($strKey = null)
    {
        if (empty($strKey))
            return false;
        $arrItem = $this->getAllItemCache();
        return (array_key_exists($strKey, $arrItem)) ? reset($arrItem[$strKey]) : null;
    }

    /**
     * Metodo responsavel em remover do cache uma chave especifica.
     * 
     * @example $this->removeItemCache($strKey, $strKeyClass);
     * 
     * @param string $strKey
     * @param string $strKeyClass
     * @return boolean
     */
    protected function removeItemCache($strKey = null, $strKeyClass = null)
    {
        if (empty($strKey))
            return false;
        $arrItem = $this->getAllItemCache($strKeyClass);
        if (array_key_exists($strKey, $arrItem))
            unset($arrItem[$strKey]);
        return $this->setAllItemCache($arrItem, $strKeyClass);
    }

    /**
     * Metodo responsavel em inserir item(ns) em um valor (chave) no cache.
     * 
     * @example $this->setAllItemCache($arrItem, $strKeyClass);
     * 
     * @param array $arrItem
     * @param string $strKeyClass
     * @return mix
     */
    private function setAllItemCache($arrItem = null, $strKeyClass = null)
    {
        if (!is_object(($cache = $this->getCache())))
            return false;
        if (!$strKeyClass)
            $strKeyClass = get_class($this);
        return $cache->setItem($strKeyClass, (array) $arrItem);
    }

    /**
     * Metodo responsavel em retornar todas as chaves que estejam no cache.
     * 
     * @example $this->getAllItemCache($strKeyClass);
     * 
     * @param string $strKeyClass
     * @return mix
     */
    protected function getAllItemCache($strKeyClass = null)
    {
        if (!is_object(($cache = $this->getCache())))
            return false;
        if (!$strKeyClass)
            $strKeyClass = get_class($this);
        if (!$cache->hasItem($strKeyClass)) {
            $cache->setItem($strKeyClass, array());
            $this->setKeyClass($strKeyClass);
        }
        return $cache->getItem($strKeyClass);
    }

    /**
     * Metodo responsavel em retornar o servico (objeto) do Memcache.
     * 
     * @example $this->getCache();
     * 
     * @return object
     */
    protected function getCache()
    {
        return $this->getService('InepZend\Cache\Service\Memcache');
    }

    /**
     * Metodo responsavel em inserir chaves no nameSpace do cache.
     * 
     * @example $this->setKeyClass($strKeyClass);
     * 
     * @param string $strKeyClass
     * @return void
     */
    protected function setKeyClass($strKeyClass = null)
    {
        $cache = $this->getCache();
        $strNamespace = $this->getNamespaceCache($cache);
        if (!$cache->hasItem($strNamespace))
            $cache->setItem($strNamespace, array());
        $arrCacheNamespace = $cache->getItem($strNamespace);
        $arrCacheNamespace[] = $strKeyClass;
        $cache->setItem($strNamespace, $arrCacheNamespace);
    }

    /**
     * Metodo responsavel em retornar as chaves que estejam no cache.
     * 
     * @example $this->getAllKeyClass();
     * 
     * @return array
     */
    protected function getAllKeyClass()
    {
        $cache = $this->getCache();
        $strNamespace = $this->getNamespaceCache($cache);
        if (!$cache->hasItem($strNamespace))
            $cache->setItem($strNamespace, array());
        return $cache->getItem($strNamespace);
    }

    /**
     * Metodo responsavel em retornar o nameSpace referente ao cache.
     * 
     * @example $this->getNamespaceCache($objectCache);
     * 
     * @param object $cache
     * @return string
     */
    private function getNamespaceCache($cache = null)
    {
        if (!is_object($cache))
            $cache = $this->getCache();
        return $cache->getOptions()->getNamespace() . 'Cache';
    }

    protected static function setItemCacheTimeLife($intItemCacheTimeLife = null)
    {
        return (self::$intItemCacheTimeLife = $intItemCacheTimeLife);
    }

    protected static function getItemCacheTimeLife()
    {
        return self::$intItemCacheTimeLife;
    }

}
