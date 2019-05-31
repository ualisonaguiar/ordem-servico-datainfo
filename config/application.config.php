<?php

return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'InepZend',
        'OrdemServico',
//        'Migracao',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
            './module/InepSkeleton',
        ),
        'config_glob_paths' => array(
            __DIR__ . '/autoload/{,*.}{global,local}.php',
        ),
        'config_cache_enabled' => false,
        'config_cache_key' => 'final',
        'module_map_cache_enabled' => false,
        'module_map_cache_key' => 'final',
        'cache_dir' => './data/cache',
//        'check_dependencies' => true,
    ),
);
