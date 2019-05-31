<?php

namespace InepZend\Cache\Service;

use Zend\Cache\Storage\Adapter\Memcache as MemcacheAdapter;
use Zend\Cache\Storage\Adapter\MemcacheResourceManager;
use Zend\Cache\Storage\Adapter\MemcacheOptions;
use InepZend\Util\ApplicationInfo;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Exception\RuntimeException;
use \Exception as ExceptionNative;

class Memcache extends MemcacheAdapter
{

    use AttributeStaticTrait;

    const HOST_DEFAULT = 'localhost';
    const PORT_DEFAULT = 11211;
    const RESOURCE_ID = 'InepZend';

    public static function getInstance($arrOption = null)
    {
        if (is_object($mixAttributeStaticValue = self::getAttributeStatic('singleInstance')))
            return $mixAttributeStaticValue;
        if (!is_array($arrOption))
            $arrOption = array();
        $arrServer = array_key_exists('servers', $arrOption) ? $arrOption['servers'] : array(array(self::HOST_DEFAULT, self::PORT_DEFAULT));
        $memcacheResourceManager = new MemcacheResourceManager();
        $memcacheResourceManager->addServers(self::RESOURCE_ID, $arrServer);
//        if (array_key_exists('auto_compress_threshold', $arrOption))
//            $memcacheResourceManager->setAutoCompressThreshold($strResourceId, $arrOption['auto_compress_threshold']);
        if (array_key_exists('auto_compress_min_savings', $arrOption))
            $memcacheResourceManager->setAutoCompressMinSavings(self::RESOURCE_ID, $arrOption['auto_compress_min_savings']);
        if (array_key_exists('server_defaults', $arrOption))
            $memcacheResourceManager->setServerDefaults(self::RESOURCE_ID, $arrOption['server_defaults']);
        $memcacheAdapterOptions = new MemcacheOptions(array(
//            'adapter' => strtolower(end($arrExplode = explode('\\', __CLASS__))),
            'resource_manager' => $memcacheResourceManager,
            'resource_id' => self::RESOURCE_ID,
            'namespace' => ApplicationInfo::getNameEdited(),
            'compression' => array_key_exists('compression', $arrOption) ? $arrOption['compression'] : false,
            'ttl' => array_key_exists('ttl', $arrOption) ? $arrOption['ttl'] : (24 * 60 * 60),
            'readable' => array_key_exists('readable', $arrOption) ? $arrOption['readable'] : true,
            'writable' => array_key_exists('writable', $arrOption) ? $arrOption['writable'] : true,
        ));
        self::setAttributeStatic('memcacheResourceManager', $memcacheResourceManager);
        $singleInstance = new Memcache($memcacheAdapterOptions);
        self::setAttributeStatic('singleInstance', $singleInstance);
        return $singleInstance;
    }

    public function getMemcacheManager()
    {
        return $this->getMemcacheResourceManager();
    }

    public function getMemcacheResourceManager()
    {
        if (is_object($mixAttributeStaticValue = self::getAttributeStatic('memcacheResourceManager')))
            return $mixAttributeStaticValue;
        return false;
    }

    public function getMemcache($booCheck = null)
    {
        return $this->getMemcacheResource($booCheck);
    }

    public function getMemcacheResource($booCheck = null)
    {
        $memcacheResource = parent::getMemcacheResource();
        if (($booCheck === true) && (!$memcacheResource) && (!is_object($memcacheResource)))
            throw new RuntimeException('Memcache inexistente.');
        return $memcacheResource;
    }

    public function hasActiveMemcache()
    {
        if (is_bool($mixAttributeStaticValue = self::getAttributeStatic('booActiveMemcache')))
            return $mixAttributeStaticValue;
        $booActiveMemcache = false;
        $arrStats = $this->getExtendedStats();
        if (is_array($arrStats))
            foreach ($arrStats as $mixValue)
                if ($mixValue) {
                    $booActiveMemcache = true;
                    break;
                }
        self::setAttributeStatic('booActiveMemcache', $booActiveMemcache);
        return $booActiveMemcache;
    }

    public function getExtendedStats()
    {
        try {
            return @$this->getMemcache(true)->getExtendedStats();
        } catch (ExceptionNative $exception) {
            return;
        }
    }

    public function clearCache()
    {
        try {
            $memcache = $this->getMemcache(true);
            foreach ($this->findBy() as $strKey => $mixValue)
                $memcache->delete($strKey);
            return $memcache->flush();
        } catch (ExceptionNative $exception) {
            return;
        }
    }

    public function findBy($arrCriteria = null)
    {
        $arrRegister = array();
        $arrAllSlabs = $this->getMemcache()->getExtendedStats('slabs');
        if (is_array($arrAllSlabs)) {
            foreach ($arrAllSlabs as $strServer => $arrSlabs) {
                foreach ($arrSlabs AS $intIdSlabs => $arrInfo) {
                    if (!is_numeric($intIdSlabs))
                        continue;
                    $arrCacheDump = $this->getMemcache()->getExtendedStats('cachedump', (int) $intIdSlabs);
                    foreach ($arrCacheDump AS $strServer => $arrValue) {
                        if (!is_array($arrValue))
                            continue;
                        foreach ($arrValue AS $strKey => $arrCacheDumpValue) {
                            if (is_array($arrCriteria)) {
                                if ((array_key_exists('ds_key', $arrCriteria)) && (!empty($arrCriteria['ds_key'])) && (strpos($strKey, $arrCriteria['ds_key']) !== 0))
                                    continue;
                            }
                            $arrRegister[$strKey] = $this->getMemcache()->get($strKey);
                        }
                    }
                }
            }
        }
        return $arrRegister;
    }

}
