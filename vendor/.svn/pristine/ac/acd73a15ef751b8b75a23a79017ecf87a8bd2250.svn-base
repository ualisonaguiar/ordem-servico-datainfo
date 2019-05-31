<?php

namespace InepZend\Module\WebService\Server\Rest;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\WebService\Server\Rest\Service\RestClient;
use InepZend\Module\WebService\Server\Rest\Service\RestServer;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\WebService\Server\Rest\Service\RestClient' => function() {
                    return new RestClient();
                },
                'InepZend\Module\WebService\Server\Rest\Service\RestClient' => function() {
                    return new RestClient();
                },
                'InepZend\WebService\Server\Rest\Service\RestServer' => function() {
                    return new RestServer();
                },
                'InepZend\Module\WebService\Server\Rest\Service\RestServer' => function() {
                    return new RestServer();
                },
            ),
        );
    }

}
