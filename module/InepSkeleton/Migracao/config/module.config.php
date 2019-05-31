<?php

namespace Migracao;

return array(
    'router' => array(
        'routes' => array(
            'migracao' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/migracao',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_atividade' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Migracao\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Migracao\Controller\Index' => 'Migracao\Controller\IndexController',
        ),
    ),
    'view_manager' => array(),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),
            ($strNamespace = 'orm_' . strtolower(__NAMESPACE__)) => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
        'connection' => array(
            $strNamespace => array(
                'configuration' => $strNamespace,
                'eventmanager' => $strNamespace,
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
            ),
        ),
        'configuration' => array(
            $strNamespace => array(
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'driver' => $strNamespace,
                'generate_proxies' => true,
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
                'filters' => array(),
                'datetime_functions' => array(),
                'string_functions' => array(),
                'numeric_functions' => array(),
            ),
        ),
        'entitymanager' => array(
            $strNamespace => array(
                'connection' => $strNamespace,
                'configuration' => $strNamespace,
            ),
        ),
        'eventmanager' => array(
            $strNamespace => array(),
        ),
        'sql_logger_collector' => array(
            $strNamespace => array(),
        ),
        'mapping_collector' => array(
            $strNamespace => array(),
        ),
        'entity_resolver' => array(
            $strNamespace => array(),
        ),
        'authentication' => array(
            $strNamespace => array(
                'objectManager' => 'doctrine.entitymanager.' . $strNamespace,
            ),
        ),
        'migrations_configuration' => array(
            $strNamespace => array(
                'directory' => 'data/DoctrineORMModule/Migrations',
                'namespace' => 'DoctrineORMModule\Migrations',
                'table' => 'migrations',
            ),
        ),
    ),
);
