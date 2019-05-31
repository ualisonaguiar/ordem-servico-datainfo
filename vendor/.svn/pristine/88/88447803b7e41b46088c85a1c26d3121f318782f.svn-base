<?php

namespace InepZend\Module\Authentication;

return array(
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'index',
//                         'controller' => 'InepZend\Module\TrocaArquivo\Cliente\Controller\Cliente',
//                         'action' => 'index',
                    ),
                ),
            ),
            'logoff' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/logoff',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'logoff',
                    ),
                ),
            ),
            'change_pass' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/change_pass',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'changePass',
                    ),
                ),
            ),
            'change_temp_pass' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/change_temp_pass',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'changeTempPass',
                    ),
                ),
            ),
            'recover_pass' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/recover_pass',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'recoverPass',
                    ),
                ),
            ),
            'login_external' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login_external',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Authentication\Controller\Index',
                        'action' => 'loginExternal',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Authentication\Module\Controller\Index' => 'InepZend\Module\Authentication\Controller\IndexController',
            'InepZend\Module\Authentication\Controller\Index' => 'InepZend\Module\Authentication\Controller\IndexController',
//             'InepZend\Module\TrocaArquivo\Cliente\Controller\Cliente' => 'InepZend\Module\TrocaArquivo\Cliente\Controller\ClienteController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'autenticacao/index/index' => __DIR__ . '/../view/authentication/index/index.phtml',
            'inep-zend/index/index' => __DIR__ . '/../view/authentication/index/index.phtml',
            'inep-zend/index/logoff' => __DIR__ . '/../view/authentication/index/index.phtml',
            'inep-zend/index/change-pass' => __DIR__ . '/../view/authentication/index/change-pass.phtml',
            'inep-zend/index/change-temp-pass' => __DIR__ . '/../view/authentication/index/change-pass.phtml',
            'inep-zend/index/change-pass.js' => __DIR__ . '/../view/authentication/index/change-pass.js.phtml',
            'inep-zend/index/recover-pass' => __DIR__ . '/../view/authentication/index/recover-pass.phtml',
        ),
    ),
//    'module_theme_type' => array(
//        __NAMESPACE__ => 'administrative',
//    ),
);