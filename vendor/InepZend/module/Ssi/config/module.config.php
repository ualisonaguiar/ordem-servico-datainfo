<?php

namespace InepZend\Module\Ssi;

return array(
    'router' => array(
        'routes' => array(
            'ssi-menu' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ssi-menu[/:action][/:path]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Ssi\Controller\AcaoMenu',
                        'action' => 'index',
                    ),
                ),
            ),
            'ssi-acl-route' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ssi-acl-route[/:action][/:path]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Ssi\Controller\AcaoAclRoute',
                        'action' => 'index',
                    ),
                ),
            ),
            'ssi-acl-form-element' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ssi-acl-form-element[/:action]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Ssi\Controller\AcaoAclFormElement',
                        'action' => 'index',
                    ),
                ),
            ),
            'ssi-personal-info' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ssi-personal-info[/:action]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Ssi\Controller\PersonalInfo',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Module\Ssi\Controller\AcaoMenu' => 'InepZend\Module\Ssi\Controller\AcaoMenuController',
            'InepZend\Module\Ssi\Controller\AcaoAclRoute' => 'InepZend\Module\Ssi\Controller\AcaoAclRouteController',
            'InepZend\Module\Ssi\Controller\AcaoAclFormElement' => 'InepZend\Module\Ssi\Controller\AcaoAclFormElementController',
            'InepZend\Module\Ssi\Controller\PersonalInfo' => 'InepZend\Module\Ssi\Controller\PersonalInfoController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/acao-menu/index' => __DIR__ . '/../view/ssi/acao-menu/index.phtml',
            'inep-zend/acao-menu/show' => __DIR__ . '/../view/ssi/acao-menu/show.phtml',
            'inep-zend/acao-acl-route/index' => __DIR__ . '/../view/ssi/acao-acl-route/index.phtml',
            'inep-zend/acao-acl-route/show' => __DIR__ . '/../view/ssi/acao-acl-route/show.phtml',
            'inep-zend/acao-acl-form-element/index' => __DIR__ . '/../view/ssi/acao-acl-form-element/index.phtml',
            'inep-zend/acao-acl-form-element/show' => __DIR__ . '/../view/ssi/acao-acl-form-element/show.phtml',
            'inep-zend/personal-info/index' => __DIR__ . '/../view/ssi/personal-info/index.phtml',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            end(explode('\\', __NAMESPACE__)) . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'memcache',
                'paths' => array(
                    __DIR__ . '/../src/' . end(explode('\\', __NAMESPACE__)) . '/Entity',
                    __DIR__ . '/../../../library/InepZend/Ssi/src/Ssi/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                    'InepZend\Ssi\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                ),
            ),
        ),
    ),
);
