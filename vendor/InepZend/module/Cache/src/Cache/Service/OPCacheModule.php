<?php

namespace InepZend\Module\Cache\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Util\DebugExec;

class OPCacheModule extends AbstractServiceManager
{

    use DebugExec;

    const DEBUG = false;

    protected function clearCache()
    {
        return (function_exists('opcache_reset')) ? opcache_reset() : false;
    }

}