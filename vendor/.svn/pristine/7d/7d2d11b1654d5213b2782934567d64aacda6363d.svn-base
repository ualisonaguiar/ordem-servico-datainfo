<?php

namespace InepZend\Module\Cache;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Cache\Service\MemcacheModule;
use InepZend\Module\Cache\Service\OPCacheModule;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Cache\Module\Service\MemcacheModule' => function() {
                    return new MemcacheModule();
                },
                'InepZend\Module\Cache\Service\MemcacheModule' => function() {
                    return new MemcacheModule();
                },
                'InepZend\Module\Cache\Service\OPCacheModule' => function() {
                    return new OPCacheModule();
                },
            ),
        );
    }

}
