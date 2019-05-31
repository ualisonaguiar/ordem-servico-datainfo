<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_ordemservico' => array(
                'params' => array(
                    'path' => getBasePathApplication() . '/database/ordem_servico-prod.db',
                ),
            ),
        ),
        'debug' => array(
            'sql' => false,
        ),
    ),
);
