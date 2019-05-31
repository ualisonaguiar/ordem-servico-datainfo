<?php

namespace InepZend\Module\TrocaArquivo;

return array(
    'router' => array(
        'routes' => array(
            'layoutfile' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/layoutfile[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutFile',
                        'action' => 'index',
                    ),
                ),
            ),
            'layoutestrutural' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/layoutestrutural[/:action][/:id_layout]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_layout' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutEstrutural',
                        'action' => 'index',
                    ),
                ),
            ),
            'configenvio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/configenvio[/:action][/:id_layout]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_layout' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\ConfigEnvio\Controller\ConfigEnvio',
                        'action' => 'index',
                    ),
                ),
            ),
            'massateste' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/massateste[/:action][/:id_massa_teste]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_massa_teste' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\MassaTeste\Controller\MassaTeste',
                        'action' => 'index',
                    ),
                ),
            ),
            'cargaentidade' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/cargaentidade[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\MassaTeste\Controller\MassaTeste',
                        'action' => 'generate',
                    ),
                ),
            ),
            'responsavelenvio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/responsavelenvio[/:action][/:id_responsavel]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_responsavel' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\ResponsavelEnvio\Controller\ResponsavelEnvio',
                        'action' => 'index',
                    ),
                ),
            ),
            'monitoramentoenvio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/monitoramentoenvio[/:action][/:id_arquivo]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_arquivo' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\MonitoramentoEnvio',
                        'action' => 'index',
                    ),
                ),
            ),
            'enviodado' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/enviodado[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\EnvioDado\Controller\EnvioDado',
                        'action' => 'index',
                    ),
                ),
            ),
            'acompanhamentoenvio' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/acompanhamentoenvio[/:action][/:id_arquivo]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_arquivo' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\AcompanhamentoEnvio',
                        'action' => 'index',
                    ),
                ),
            ),
            'preprocessamento' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/preprocessamento[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\Cliente\Controller\Cliente',
                        'action' => 'index',
                    ),
                ),
            ),
            'cliente' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/cliente[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\Cliente\Controller\Cliente',
                        'action' => 'index',
                    ),
                ),
            ),
            'ilhadado' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ilhadado[/:action][/:id_ilha_dado]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_ilha_dado' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\IlhaDado\Controller\IlhaDado',
                        'action' => 'index',
                    ),
                ),
            ),
            'regravalidacao' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/regravalidacao[/:action][/:id_layout][/:id_regra_validacao]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_layout' => '[0-9]+',
                        'id_regra_validacao' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\RegraValidacao',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutFile' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutFileController',
            'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutEstrutural' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\LayoutEstruturalController',
            'InepZend\Module\TrocaArquivo\ConfigEnvio\Controller\ConfigEnvio' => 'InepZend\Module\TrocaArquivo\ConfigEnvio\Controller\ConfigEnvioController',
            'InepZend\Module\TrocaArquivo\MassaTeste\Controller\MassaTeste' => 'InepZend\Module\TrocaArquivo\MassaTeste\Controller\MassaTesteController',
            'InepZend\Module\TrocaArquivo\ResponsavelEnvio\Controller\ResponsavelEnvio' => 'InepZend\Module\TrocaArquivo\ResponsavelEnvio\Controller\ResponsavelEnvioController',
            'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\MonitoramentoEnvio' => 'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\MonitoramentoEnvioController',
            'InepZend\Module\TrocaArquivo\EnvioDado\Controller\EnvioDado' => 'InepZend\Module\TrocaArquivo\EnvioDado\Controller\EnvioDadoController',
            'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\AcompanhamentoEnvio' => 'InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller\AcompanhamentoEnvioController',
            'InepZend\Module\TrocaArquivo\Cliente\Controller\Cliente' => 'InepZend\Module\TrocaArquivo\Cliente\Controller\ClienteController',
            'InepZend\Module\TrocaArquivo\IlhaDado\Controller\IlhaDado' => 'InepZend\Module\TrocaArquivo\IlhaDado\Controller\IlhaDadoController',
            'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\RegraValidacao' => 'InepZend\Module\TrocaArquivo\LayoutValidacao\Controller\RegraValidacaoController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'inep-zend/layout-file/index' => __DIR__ . '/../view/troca-arquivo/layout-file/index.phtml',
            'inep-zend/layout-file/add' => __DIR__ . '/../view/troca-arquivo/layout-file/add.phtml',
            'inep-zend/layout-estrutural/index' => __DIR__ . '/../view/troca-arquivo/layout-estrutural/index.phtml',
            'inep-zend/layout-estrutural/gerar-xsd' => __DIR__ . '/../view/troca-arquivo/layout-estrutural/gerar-xsd.phtml',
            'inep-zend/config-envio/index' => __DIR__ . '/../view/troca-arquivo/config-envio/index.phtml',
            'inep-zend/config-envio/add' => __DIR__ . '/../view/troca-arquivo/config-envio/add.phtml',
            'inep-zend/massa-teste/index' => __DIR__ . '/../view/troca-arquivo/massa-teste/index.phtml',
            'inep-zend/massa-teste/add' => __DIR__ . '/../view/troca-arquivo/massa-teste/add.phtml',
            'inep-zend/massa-teste/generate' => __DIR__ . '/../view/troca-arquivo/massa-teste/generate.phtml',
            'inep-zend/responsavel-envio/index' => __DIR__ . '/../view/troca-arquivo/responsavel-envio/index.phtml',
            'inep-zend/responsavel-envio/add' => __DIR__ . '/../view/troca-arquivo/responsavel-envio/add.phtml',
            'inep-zend/responsavel-envio/edit' => __DIR__ . '/../view/troca-arquivo/responsavel-envio/edit.phtml',
            'inep-zend/monitoramento-envio/index' => __DIR__ . '/../view/troca-arquivo/monitoramento-envio/index.phtml',
            'inep-zend/monitoramento-envio/show' => __DIR__ . '/../view/troca-arquivo/monitoramento-envio/show.phtml',
            'inep-zend/envio-dado/index' => __DIR__ . '/../view/troca-arquivo/envio-dado/index.phtml',
            'inep-zend/acompanhamento-envio/index' => __DIR__ . '/../view/troca-arquivo/acompanhamento-envio/index.phtml',
            'inep-zend/acompanhamento-envio/show' => __DIR__ . '/../view/troca-arquivo/acompanhamento-envio/show.phtml',
            'inep-zend/cliente/index' => __DIR__ . '/../view/troca-arquivo/cliente/index.phtml',
            'inep-zend/ilha-dado/index' => __DIR__ . '/../view/troca-arquivo/ilha-dado/index.phtml',
            'inep-zend/ilha-dado/add' => __DIR__ . '/../view/troca-arquivo/ilha-dado/add.phtml',
            'inep-zend/ilha-dado/edit' => __DIR__ . '/../view/troca-arquivo/ilha-dado/edit.phtml',
            'inep-zend/regra-validacao/index' => __DIR__ . '/../view/troca-arquivo/regra-validacao/index.phtml',
            'inep-zend/regra-validacao/add' => __DIR__ . '/../view/troca-arquivo/regra-validacao/add.phtml',
            'inep-zend/regra-validacao/edit' => __DIR__ . '/../view/troca-arquivo/regra-validacao/edit.phtml',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            end(explode('\\', __NAMESPACE__)) . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Common/Entity',
//                     __DIR__ . '/../../Corporative/src/Corporative/Entity',
                ),
            ),
            ($strNamespace = 'orm_' . strtolower(end(explode('\\', __NAMESPACE__)))) => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    __NAMESPACE__ . '\Common\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
//                     'InepZend\Module\Corporative\Entity' => end(explode('\\', __NAMESPACE__)) . '_driver',
                ),
            ),
        ),
        'connection' => array(
            $strNamespace => array(
                'configuration' => $strNamespace,
                'eventmanager' => $strNamespace,
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'path' => getBasePathApplication() . '/data/TrocaArquivo/database/troca_arquivo.db',
                ),
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
