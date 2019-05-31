<?php

namespace InepZend\Module\Crontab;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Crontab\Common\Service\File\CronFile;
use InepZend\Module\Crontab\Common\Service\File\PeriodoFile;
use InepZend\Module\Crontab\Common\Service\File\AndamentoFile;
use InepZend\Module\Crontab\AdminCron\Service\AdminCron;
use InepZend\Module\Crontab\AdminCron\Form\AdminCron as AdminCronForm;
use InepZend\Module\Crontab\VarreduraCron\Service\VarreduraCron;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\Crontab\Common\Service\File\CronFile' => function() {
                    return new CronFile();
                },
                'InepZend\Module\Crontab\Common\Service\File\PeriodoFile' => function() {
                    return new PeriodoFile();
                },
                'InepZend\Module\Crontab\Common\Service\File\AndamentoFile' => function() {
                    return new AndamentoFile();
                },
                'InepZend\Module\Crontab\AdminCron\Service\AdminCron' => function() {
                    return new AdminCron();
                },
                'InepZend\Module\Crontab\AdminCron\Form\AdminCron' => function() {
                    return new AdminCronForm();
                },
                'InepZend\Module\Crontab\VarreduraCron\Service\VarreduraCron' => function() {
                    return new VarreduraCron();
                },
            ),
        );
    }

}
