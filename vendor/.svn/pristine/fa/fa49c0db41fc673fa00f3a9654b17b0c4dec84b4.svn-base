<?php

namespace InepZend\Module\Sqi;

return array(
    'router' => array(
        'routes' => array(
            'questionario_exemplo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/questionario/exemplo[/:coProjeto][/:coEvento][/:idQuestionarioProjeto][/:coQuestionario]',
                    'constraints' => array(
                        'coProjeto' => '[0-9]+',
                        'coEvento' => '[0-9]+',
                        'idQuestionarioProjeto' => '[0-9]+',
                        'coQuestionario' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Sqi\Controller\Exemplo',
                        'action' => 'index',
                    ),
                ),
            ),
            'rest-questionario' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/questionario/rest-questionario[/:coProjeto][/:coEvento][/:idQuestionarioProjeto][/:coQuestionario]',
                    'constraints' => array(
                        'coProjeto' => '[0-9]+',
                        'coEvento' => '[0-9]+',
                        'idQuestionarioProjeto' => '[0-9]+',
                        'coQuestionario' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Sqi\Controller\RestQuestionario',
                        'action' => 'index',
                    ),
                ),
            ),
            'rest-questionario-projeto-evento' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/questionario/rest-questionario-projeto-evento[/:coQuestionario][/:coEvento][/:coProjeto]',
                    'constraints' => array(
                        'coQuestionario' => '[0-9]+',
                        'coEvento' => '[0-9]+',
                        'coProjeto' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Sqi\Controller\RestQuestionario',
                        'action' => 'questionario',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Questionario\Controller\Exemplo' => 'InepZend\Module\Sqi\Controller\ExemploController',
            'InepZend\Module\Sqi\Controller\Exemplo' => 'InepZend\Module\Sqi\Controller\ExemploController',
            'InepZend\Module\Sqi\Controller\RestQuestionario' => 'InepZend\Module\Sqi\Controller\RestQuestionarioController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array_merge(require __DIR__ . '/../template_map.php', array(
            'inep-zend/exemplo/index' => __DIR__ . '/../view/sqi/exemplo/index.phtml',
            'inep-zend-questionario/exemplo/index' => __DIR__ . '/../view/sqi/exemplo/index.phtml',
            'inep-zend-questionario/form-answer' => __DIR__ . '/../view/sqi/form-answer.phtml',
            'inep-zend-questionario/form' => __DIR__ . '/../view/sqi/form.phtml',
        )),
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