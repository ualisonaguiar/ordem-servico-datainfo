<?php

namespace OrdemServico;

return array(
    'router' => array(
        'routes' => array(
            'atividade' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/atividade[/:action][/:id_atividade]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_atividade' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\Atividade',
                        'action' => 'index',
                    ),
                ),
            ),
            'demanda' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/demanda[/:action][/:id_demanda]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_demanda' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\Demanda',
                        'action' => 'index',
                    ),
                ),
            ),
            'ordemdeservico' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ordemdeservico[/:action][/:id_ordem_servico]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_ordem_servico' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\OrdemServico',
                        'action' => 'index',
                    ),
                ),
            ),
            'backup-database' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/backup-database[/:action][/:usernamePassword]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'username' => '[a-z^.]*'
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\Backup',
                        'action' => 'index',
                    ),
                ),
            ),
            'relatoriofaturamento' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/relatoriofaturamento[/:action][/:id_ordem_servico]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_ordem_servico' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\RelatorioFaturamento',
                        'action' => 'index',
                    ),
                ),
            ),
            'relatoriodesempenho' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/relatoriodesempenho[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\RelatorioDesempenho',
                        'action' => 'index',
                    ),
                ),
            ),
            'catologoservico' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/catologoservico[/:action][/:id_catalogo_servico]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_catalogo_servico' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\CatalogoServico',
                        'action' => 'index',
                    ),
                ),
            ),
            'relatorioponto' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/relatorioponto[/:action][/:idUsuario][/:dtInicial][/:dtFinal]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\RelatorioPonto',
                        'action' => 'index',
                    ),
                ),
            ),
            'relatorio-pessoal' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/relatorio-pessoal[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\RelatorioPessoal',
                        'action' => 'index',
                    ),
                ),
            ),
            'usuario' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/usuario[/:action][/:id_usuario]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id_usuario' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\Usuario',
                        'action' => 'index',
                    ),
                ),
            ),
            'aceite' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/aceite[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'OrdemServico\Controller\Aceite',
                        'action' => 'index',
                    ),
                ),
            ),
            'relatoriogestorprojeto' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/relatoriogestorprojeto[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'OrdemServico\Controller\RelatorioGestorProjeto',
                        'action' => 'index',
                    ],
                ],
            ],
            'lancamento-manual' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/lancamento-manual',
                    'defaults' => [
                        'controller' => 'OrdemServico\Controller\RelatorioPonto',
                        'action' => 'lancamentoManual',
                    ],
                ],
            ],
            'obter-ponto' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/obter-ponto',
                    'defaults' => [
                        'controller' => 'OrdemServico\Controller\RelatorioPonto',
                        'action' => 'obterPonto',
                    ],
                ],
            ],
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'OrdemServico\Controller\Atividade' => 'OrdemServico\Controller\AtividadeController',
            'OrdemServico\Controller\Demanda' => 'OrdemServico\Controller\DemandaController',
            'OrdemServico\Controller\OrdemServico' => 'OrdemServico\Controller\OrdemServicoController',
            'OrdemServico\Controller\Backup' => 'OrdemServico\Controller\BackupController',
            'OrdemServico\Controller\RelatorioFaturamento' => 'OrdemServico\Controller\RelatorioFaturamentoController',
            'OrdemServico\Controller\CatalogoServico' => 'OrdemServico\Controller\CatalogoServicoController',
            'OrdemServico\Controller\RelatorioDesempenho' => 'OrdemServico\Controller\RelatorioDesempenhoController',
            'OrdemServico\Controller\RelatorioPonto' => 'OrdemServico\Controller\RelatorioPontoController',
            'OrdemServico\Controller\RelatorioPessoal' => 'OrdemServico\Controller\RelatorioPessoalController',
            'OrdemServico\Controller\Usuario' => 'OrdemServico\Controller\UsuarioController',
            'OrdemServico\Controller\Aceite' => 'OrdemServico\Controller\AceiteController',
            'OrdemServico\Controller\RelatorioGestorProjeto' => 'OrdemServico\Controller\RelatorioGestorProjetoController',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'ordem-servico/atividade/index' => __DIR__ . '/../view/ordem-servico/atividade/index.phtml',
            'ordem-servico/atividade/add' => __DIR__ . '/../view/ordem-servico/atividade/add.phtml',
            'ordem-servico/atividade/edit' => __DIR__ . '/../view/ordem-servico/atividade/edit.phtml',
            'ordem-servico/demanda/index' => __DIR__ . '/../view/ordem-servico/demanda/index.phtml',
            'ordem-servico/demanda/add' => __DIR__ . '/../view/ordem-servico/demanda/add.phtml',
            'ordem-servico/demanda/edit' => __DIR__ . '/../view/ordem-servico/demanda/edit.phtml',
            'ordem-servico/ordem-servico/index' => __DIR__ . '/../view/ordem-servico/ordem-servico/index.phtml',
            'ordem-servico/ordem-servico/add' => __DIR__ . '/../view/ordem-servico/ordem-servico/add.phtml',
            'ordem-servico/ordem-servico/edit' => __DIR__ . '/../view/ordem-servico/ordem-servico/edit.phtml',
            'ordem-servico/ordem-servico/_ordem-servico' => __DIR__ . '/../view/ordem-servico/ordem-servico/_partial/_ordem-servico.phtml',
            'ordem-servico/ordem-servico/_relatorio-execucao' => __DIR__ . '/../view/ordem-servico/ordem-servico/_partial/_relatorio-execucao.phtml',
            'ordem-servico/ordem-servico/_relatorio-tecnico' => __DIR__ . '/../view/ordem-servico/ordem-servico/_partial/_relatorio-tecnico.phtml',
            'ordem-servico/ordem-servico/_relatorio-tecnico-fiscal' => __DIR__ . '/../view/ordem-servico/ordem-servico/_partial/_relatorio-tecnico-fiscal.phtml',
            'ordem-servico/relatorio-faturamento/index' => __DIR__ . '/../view/ordem-servico/relatorio-faturamento/index.phtml',
            'ordem-servico/relatorio-faturamento/_partial/_relatorio-tecnico' => __DIR__ . '/../view/ordem-servico/relatorio-faturamento/_partial/_relatorio-tecnico.phtml',
            'ordem-servico/catalogo-servico/index' => __DIR__ . '/../view/ordem-servico/catalogo-servico/index.phtml',
            'ordem-servico/catalogo-servico/add' => __DIR__ . '/../view/ordem-servico/catalogo-servico/add.phtml',
            'ordem-servico/catalogo-servico/edit' => __DIR__ . '/../view/ordem-servico/catalogo-servico/edit.phtml',
            'ordem-servico/catalogo-servico/_atividade-vinculada' => __DIR__ . '/../view/ordem-servico/catalogo-servico/_atividade-vinculada.phtml',
            'ordem-servico/relatorio-desempenho/index' => __DIR__ . '/../view/ordem-servico/relatorio-desempenho/index.phtml',
            'ordem-servico/relatorio-ponto/index' => __DIR__ . '/../view/ordem-servico/relatorio-ponto/index.phtml',
            'ordem-servico/relatorio-pessoal/index' => __DIR__ . '/../view/ordem-servico/relatorio-pessoal/index.phtml',
            'ordem-servico/relatorio-pessoal/_resultado' => __DIR__ . '/../view/ordem-servico/relatorio-pessoal/_resultado.phtml',
            'ordem-servico/usuario/index' => __DIR__ . '/../view/ordem-servico/usuario/index.phtml',
            'ordem-servico/usuario/vinculo' => __DIR__ . '/../view/ordem-servico/usuario/vinculo.phtml',
            'ordem-servico/usuario/edit' => __DIR__ . '/../view/ordem-servico/usuario/edit.phtml',
            'ordem-servico/usuario/add' => __DIR__ . '/../view/ordem-servico/usuario/add.phtml',
            'ordem-servico/aceite/index' => __DIR__ . '/../view/ordem-servico/aceite/index.phtml',
            'ordem-servico/ordem-servico/_partial/_aceite-lote' => __DIR__ . '/../view/ordem-servico/ordem-servico/_partial/_aceite-lote.phtml',
            'ordem-servico/relatorio-ponto/_partial/_email-erro' => __DIR__ . '/../view/ordem-servico/relatorio-ponto/_partial/_email-erro.phtml',
            'ordem-servico/relatorio-gestor-projeto/index' => __DIR__ . '/../view/ordem-servico/relatorio-gestor-projeto/index.phtml',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'renderDescricaoDemandaHelper' => 'OrdemServico\View\Helper\RenderDescricaoDemandaHelper',
            'renderGoogleHelper' => 'OrdemServico\View\Helper\RenderGoogleHelper',
        ),
    ),
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