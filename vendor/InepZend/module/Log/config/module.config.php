<?php

namespace InepZend\Module\Log;

return array(
    'router' => array(
        'routes' => array(
            'log' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/log[/:action][/:ds_path]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Log\Controller\Log',
                        'action' => 'index',
                    ),
                ),
            ),
            'log-index' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/log/index[/:ds_path]',
                    'constraints' => array(
                        'ds_path' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Log\Controller\Log',
                        'action' => 'index',
                    ),
                ),
            ),
            'log-merge' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/log/merge[[/:dia][/:mes][/:ano]]',
                    'constraints' => array(
                        'dia' => '[0-9]+',
                        'mes' => '[0-9]+',
                        'ano' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Log\Controller\Log',
                        'action' => 'merge',
                    ),
                ),
            ),
            'log-cron' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/cron-send-email-log-application',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Log\Controller\LogCron',
                        'action'     => 'checkLog'
                    ),
                ),
            ),
            'log-config' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/log-config[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Log\Controller\Log',
                        'action'     => 'config'
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Log\Module\Controller\Log' => 'InepZend\Module\Log\Controller\LogController',
            'InepZend\Module\Log\Controller\Log' => 'InepZend\Module\Log\Controller\LogController',
            'InepZend\Log\Module\Controller\LogCron' => 'InepZend\Module\Log\Controller\LogCronController',
            'InepZend\Module\Log\Controller\LogCron' => 'InepZend\Module\Log\Controller\LogCronController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/log/index' => __DIR__ . '/../view/log/log/index.phtml',
            'inep-zend/log/show' => __DIR__ . '/../view/log/log/show.phtml',
            'inep-zend/log/merge' => __DIR__ . '/../view/log/log/merge.phtml',
            'inep-zend/log/tree-info-log' => __DIR__ . '/../view/log/log/_tree-info-log.phtml',
            'inep-zend/log/show-log' => __DIR__ . '/../view/log/log/_show-log.phtml',
            'inep-zend/log/ajax-information-log' => __DIR__ . '/../view/log/log/ajax-information-log.phtml',
            'inep-zend/log/partial-detalhe-log' => __DIR__ . '/../view/log/log/_detalhe-log.phtml',
            'inep-zend/log/config' => __DIR__ . '/../view/log/log/config.phtml',
            'inep-zend/log-cron/email-responsible' => __DIR__ . '/../view/log/log-cron/_email-responsible.phtml',
        ),
    ),
);
