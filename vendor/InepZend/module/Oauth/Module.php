<?php

namespace InepZend\Module\Oauth;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Oauth\Service\TwitterService;
use InepZend\Module\Oauth\Service\InstagramService;
use InepZend\Module\Oauth\Service\SsiService;
use InepZend\Module\Oauth\Service\FacebookService;
use InepZend\Module\Oauth\Service\GoogleService;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Oauth\Service\TwitterService' => function($serviceManager) {
                    return new TwitterService($serviceManager);
                },
                'InepZend\Module\Oauth\Service\TwitterService' => function($serviceManager) {
                    return new TwitterService($serviceManager);
                },
                'InepZend\Oauth\Service\InstagramService' => function($serviceManager) {
                    return new InstagramService($serviceManager);
                },
                'InepZend\Module\Oauth\Service\InstagramService' => function($serviceManager) {
                    return new InstagramService($serviceManager);
                },
                'InepZend\Module\Oauth\Service\SsiService' => function($serviceManager) {
                    return new SsiService($serviceManager);
                },
                'InepZend\Module\Oauth\Service\FacebookService' => function($serviceManager) {
                    return new FacebookService($serviceManager);
                },
                'InepZend\Module\Oauth\Service\GoogleService' => function($serviceManager) {
                    return new GoogleService($serviceManager);
                },
            ),
        );
    }

}
