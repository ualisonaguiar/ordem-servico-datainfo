<?php

namespace InepZend\Module\Corporative;

return array(
    'router' => array(
        'routes' => array(
            'municipio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/municipio[/:action][/:coUf]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'coUf' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Municipio',
                        'action' => 'index',
                    ),
                ),
            ),
            'corp_municipio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/corp_municipio[/:action][/:coUf]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'coUf' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Municipio',
                        'action' => 'index',
                    ),
                ),
            ),
            'corp_orgaoemissor' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/corp_orgaoemissor[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\OrgaoEmissor',
                        'action' => 'index',
                    ),
                ),
            ),
            'corp_pais' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/corp_pais[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Pais',
                        'action' => 'index',
                    ),
                ),
            ),
            'corp_banco' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/corp_banco[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Banco',
                        'action' => 'index',
                    ),
                ),
            ),
            'ajaxgetcouffromsigla' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/ajaxgetcouffromsigla',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Uf',
                        'action' => 'ajaxGetCoUfFromSigla',
                    ),
                ),
            ),
            'corp_ajaxgetcouffromsigla' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/corp_ajaxgetcouffromsigla',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\Uf',
                        'action' => 'ajaxGetCoUfFromSigla',
                    ),
                ),
            ),
            'corp_projetoevento' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/corp_projetoevento[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Corporative\Controller\ProjetoEvento',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Corporative\Controller\Municipio' => 'InepZend\Module\Corporative\Controller\MunicipioController',
            'InepZend\Module\Corporative\Controller\Municipio' => 'InepZend\Module\Corporative\Controller\MunicipioController',
            'InepZend\Corporative\Controller\Uf' => 'InepZend\Module\Corporative\Controller\UfController',
            'InepZend\Module\Corporative\Controller\Uf' => 'InepZend\Module\Corporative\Controller\UfController',
            'InepZend\Module\Corporative\Controller\OrgaoEmissor' => 'InepZend\Module\Corporative\Controller\OrgaoEmissorController',
            'InepZend\Module\Corporative\Controller\Pais' => 'InepZend\Module\Corporative\Controller\PaisController',
            'InepZend\Module\Corporative\Controller\Banco' => 'InepZend\Module\Corporative\Controller\BancoController',
            'InepZend\Module\Corporative\Controller\ProjetoEvento' => 'InepZend\Module\Corporative\Controller\ProjetoEventoController',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            end(explode('\\', __NAMESPACE__)) . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'memcache',
                'paths' => array(
                    __DIR__ . '/../src/' . end(explode('\\', __NAMESPACE__)) . '/Entity',
                    __DIR__ . '/../../../library/InepZend/Corporative/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                    'InepZend\Corporative\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                ),
            ),
        ),
    ),
);
