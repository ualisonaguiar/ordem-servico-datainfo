<?php

namespace InepZend\Module\Crontab;

return array(
    'router' => array(
        'routes' => array(
            'admincron' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admincron[/:action][/:id_cron]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_cron' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Crontab\AdminCron\Controller\AdminCron',
                        'action' => 'index',
                    ),
                ),
            ),
            'varreduracron' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/cron[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Crontab\VarreduraCron\Controller\VarreduraCron',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Module\Crontab\AdminCron\Controller\AdminCron' => 'InepZend\Module\Crontab\AdminCron\Controller\AdminCronController',
            'InepZend\Module\Crontab\VarreduraCron\Controller\VarreduraCron' => 'InepZend\Module\Crontab\VarreduraCron\Controller\VarreduraCronController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/admin-cron/index' => __DIR__ . '/../view/crontab/admin-cron/index.phtml',
            'inep-zend/admin-cron/add' => __DIR__ . '/../view/crontab/admin-cron/add.phtml',
            'inep-zend/admin-cron/edit' => __DIR__ . '/../view/crontab/admin-cron/edit.phtml',
        ),
    ),
);
