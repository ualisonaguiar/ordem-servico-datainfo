<?php

namespace InepZend\Module\Log;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Log\Form\DownloadFile;
use InepZend\Module\Log\Form\Log;
use InepZend\Module\Log\Service\LogCron;
use InepZend\Module\Log\Service\LogInfo;
use InepZend\Module\Log\Service\LogModule;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Log\Module\Form\DownloadFile' => function() {
                    return new DownloadFile();
                },
                'InepZend\Module\Log\Form\DownloadFile' => function() {
                    return new DownloadFile();
                },
                'InepZend\Log\Module\Form\Log' => function() {
                    return new Log('frmLog');
                },
                'InepZend\Module\Log\Form\Log' => function() {
                    return new Log('frmLog');
                },
                'InepZend\Log\Module\Service\LogCron' => function() {
                    return new LogCron();
                },
                'InepZend\Module\Log\Service\LogCron' => function() {
                    return new LogCron();
                },
                'InepZend\Log\Module\Service\LogInfo' => function() {
                    return new LogInfo();
                },
                'InepZend\Module\Log\Service\LogInfo' => function() {
                    return new LogInfo();
                },
                'InepZend\Log\Module\Service\LogModule' => function() {
                    return new LogModule();
                },
                'InepZend\Module\Log\Service\LogModule' => function() {
                    return new LogModule();
                },
            ),
        );
    }

}
