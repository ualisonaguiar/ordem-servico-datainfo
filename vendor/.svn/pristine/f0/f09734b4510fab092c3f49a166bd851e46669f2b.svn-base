<?php

namespace InepZend\Module\Executor;

return array(
    'router' => array(
        'routes' => array(
//             'inicial' => array(
//                 'type' => 'segment',
//                 'options' => array(
//                     'route' => '/inicial[/:action][/:idQuery]',
//                     'defaults' => array(
//                         'controller' => 'InepZend\Module\Executor\Controller\Executor',
//                         'action' => 'index',
//                     ),
//                 ),
//             ),
            'query' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/query[/:action][/:idQuery]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Executor\Controller\Executor',
                        'action' => 'index',
                    ),
                ),
            ),
            'usuario' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/usuario[/:action][/:idUsuario]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Executor\Controller\Usuario',
                        'action' => 'index',
                    ),
                ),
            ),
            'envio-operacao' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/envio-operacao[/:action][/:idEmail]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Executor\Controller\EmailHistorico',
                        'action' => 'index',
                    ),
                ),
            ),
            'historico-envio-operacao' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/historico-envio-operacao[/:action][/:idEmail]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Executor\Controller\EmailHistorico',
                        'action' => 'historico',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Module\Executor\Controller\Executor' => 'InepZend\Module\Executor\Controller\ExecutorController',
            'InepZend\Module\Executor\Controller\Usuario' => 'InepZend\Module\Executor\Controller\UsuarioController',
            'InepZend\Module\Executor\Controller\EmailHistorico' => 'InepZend\Module\Executor\Controller\EmailHistoricoController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/executor/index' => __DIR__ . '/../view/executor/executor/index.phtml',
            'inep-zend/executor/add' => __DIR__ . '/../view/executor/executor/add.phtml',
            'inep-zend/executor/edit' => __DIR__ . '/../view/executor/executor/edit.phtml',
            'inep-zend/executor/execute-query' => __DIR__ . '/../view/executor/executor/execute-query.phtml',
            'inep-zend/executor/_history-execute-result' => __DIR__ . '/../view/executor/executor/_history-execute-result.phtml',
            'inep-zend/usuario/index' => __DIR__ . '/../view/executor/usuario/index.phtml',
            'inep-zend/usuario/add' => __DIR__ . '/../view/executor/usuario/add.phtml',
            'inep-zend/usuario/edit' => __DIR__ . '/../view/executor/usuario/edit.phtml',
            'inep-zend/email-historico/index' => __DIR__ . '/../view/executor/email-historico/index.phtml',
            'inep-zend/email-historico/historico' => __DIR__ . '/../view/executor/email-historico/historico.phtml',
            'inep-zend/email-historico/_listagem-operacao' => __DIR__ . '/../view/executor/email-historico/_listagem-operacao.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'email' => 'InepZend\Module\Executor\View\Helper\Email',
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
