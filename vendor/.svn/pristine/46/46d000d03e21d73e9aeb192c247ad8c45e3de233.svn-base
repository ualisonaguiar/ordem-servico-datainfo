<?php

namespace InepZend\Module\Cache\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\DebugExec;

class MemcacheModule extends AbstractServiceManager
{

    use DebugExec;

    const DEBUG = false;

    protected function getExtendedStats()
    {
        return $this->getCache()->getExtendedStats();
    }

    protected function getAllCache()
    {
        $arrKeyClass = $this->getAllKeyClass();
        $arrAllCache = array();
        if ($arrKeyClass) {
            foreach ($arrKeyClass as $strKeyClass) {
                $arrCache = parent::getAllItemCache($strKeyClass);
                if ($arrCache)
                    $arrAllCache[$strKeyClass] = $arrCache;
            }
        }
        return $arrAllCache;
    }

    protected function clearItemCache($strKey, $strKeyClass)
    {
        return $this->removeItemCache($strKey, $strKeyClass);
    }

}