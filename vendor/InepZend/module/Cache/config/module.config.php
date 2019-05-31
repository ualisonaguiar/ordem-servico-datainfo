<?php

namespace InepZend\Module\Cache;

return array(
    'router' => array(
        'routes' => array(
            'memcache' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/memcache[/:action][/:host][/:port]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'port' => '[0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Cache\Controller\Memcache',
                        'action' => 'index',
                    ),
                ),
            ),
            'opcache' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/opcache[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Cache\Controller\OPCache',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Cache\Module\Controller\Memcache' => 'InepZend\Module\Cache\Controller\MemcacheController',
            'InepZend\Module\Cache\Controller\Memcache' => 'InepZend\Module\Cache\Controller\MemcacheController',
            'InepZend\Module\Cache\Controller\OPCache' => 'InepZend\Module\Cache\Controller\OPCacheController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/memcache/index' => __DIR__ . '/../view/cache/memcache/memcache-index.phtml',
            'inep-zend/memcache/detail-cache' => __DIR__ . '/../view/cache/memcache/memcache-detail.phtml',
            'inep-zend/op-cache/index' => __DIR__ . '/../view/cache/opcache/opcache-index.phtml',
        ),
    ),
);