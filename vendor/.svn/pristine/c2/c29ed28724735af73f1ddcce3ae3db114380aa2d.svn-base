<?php

namespace InepZend\Module\Application;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\ModuleConfig\ModuleInit;
use InepZend\Module\Application\Service\Application;
use InepZend\Cache\Service\Memcache;
use InepZend\Module\Application\Service\Readme;
use InepZend\Module\Application\Service\AutoloadConfig as AutoloadConfigService;
use InepZend\Module\Application\Form\AutoloadConfig;
use InepZend\Module\Application\Navigation\NavigationReadme;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\Application\Service\Readme' => function() {
                    return new Readme();
                },
                'InepZend\Module\Application\Service\AutoloadConfig' => function() {
                    return new AutoloadConfigService();
                },
                'InepZend\Module\Application\Form\AutoloadConfig' => function() {
                    return new AutoloadConfig();
                },
                'InepZend\Application\Service\Application' => function($serviceManager) {
                    return $this->callbackApplicationService($serviceManager);
                },
                'InepZend\Module\Application\Service\Application' => function($serviceManager) {
                    return $this->callbackApplicationService($serviceManager);
                },
                'InepZend\Cache\Service\Memcache' => function($serviceManager) {
                    return self::getMemcacheInstance($serviceManager);
                },
                'InepZend\Module\Application\Navigation\NavigationReadme' => function($serviceManager) {
                    return (new NavigationReadme())->createService($serviceManager);
                },
            )
        );
    }

    private function callbackApplicationService($serviceManager = null)
    {
        if (!is_object($serviceManager))
            return false;
        ModuleInit::setStaticServiceManagerIntoClass($serviceManager);
        return new Application($this->getEntityManager($serviceManager));
    }

    private static function getMemcacheInstance($serviceManager = null)
    {
        if (!is_object($serviceManager))
            return false;
        $arrConfig = $serviceManager->get('Config');
        return Memcache::getInstance(@$arrConfig['cache']['memcache']['options']);
    }

}
