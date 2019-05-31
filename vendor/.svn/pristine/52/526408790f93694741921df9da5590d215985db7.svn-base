<?php

namespace InepZend\Module\UnitTest;

return array(
    'router' => array(
        'routes' => array(
            'unittest_controller' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/unittest_controller[/:action][/:co_subcategoria]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'co_subcategoria' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\UnitTest\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'unittest_restful' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/unittest_restful[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\UnitTest\Controller\IndexRestful',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Module\UnitTest\Controller\Index' => 'InepZend\Module\UnitTest\Controller\IndexController',
            'InepZend\Module\UnitTest\Controller\IndexRestful' => 'InepZend\Module\UnitTest\Controller\IndexRestfulController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'unittest' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            end(explode('\\', __NAMESPACE__)) . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'memcache',
                'paths' => array(
                    __DIR__ . '/../src/' . end(explode('\\', __NAMESPACE__)) . '/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                ),
            ),
        ),
    ),
);
