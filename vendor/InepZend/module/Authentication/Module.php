<?php

namespace InepZend\Module\Authentication;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Permission\Permission;
use InepZend\Module\Authentication\Service\Authentication;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Permission\Permission' => function($serviceManager) {
                    return new Permission($this->getEntityManager($serviceManager));
                },
                'InepZend\Authentication\Module\Service\Authentication' => function() {
                    return new Authentication();
                },
                'InepZend\Module\Authentication\Service\Authentication' => function() {
                    return new Authentication();
                },
            ),
        );
    }

}
