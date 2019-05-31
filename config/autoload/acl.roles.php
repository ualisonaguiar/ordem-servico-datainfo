<?php

use OrdemServico\Entity\Usuario as UsuarioEntity;

return [
    UsuarioEntity::CO_PERFIL_SERVIDOR => [
        'allow' => [
            'aceite',
            'ordemdeservico',
            'demanda',
        ],
        'deny' => [
            'atividade',
            'relatoriofaturamento',
            'relatoriodesempenho',
            'catologoservico',
            'relatorioponto',
            'relatorio-pessoal',
            'usuario',
            'relatoriogestorprojeto',
        ]
    ],
    UsuarioEntity::CO_PERFIL_GESTOR => [
        'allow' => [
            'aceite',
            'ordemdeservico',
            'relatoriogestorprojeto',
            'demanda',
        ],
        'deny' => [
            'atividade',
            'relatoriofaturamento',
            'relatoriodesempenho',
            'catologoservico',
            'relatorioponto',
            'relatorio-pessoal',
            'usuario'
        ]
    ],
    UsuarioEntity::CO_PERFIL_FUNCIONARIO => [
        'allow' => [
            'atividade',
            'demanda',
            'ordemdeservico',
            'catologoservico',
            'relatorioponto',
            'relatorio-pessoal',
        ],
        'deny' => [
            'aceite',
            'usuario',
            'relatoriofaturamento',
            'relatoriodesempenho',
            'relatoriogestorprojeto',
        ]
    ],
    UsuarioEntity::CO_PERFIL_CE => [
        'allow' => [
            'atividade',
            'demanda',
            'ordemdeservico',
            'catologoservico',
            'relatorioponto',
            'relatorio-pessoal',
        ],
        'deny' => [
            'aceite',
            'usuario',
            'relatoriofaturamento',
            'relatoriodesempenho',
            'relatoriogestorprojeto',
        ]
    ],
    UsuarioEntity::CO_PERFIL_PREPOSTO => [
        'allow' => [
            'atividade',
            'demanda',
            'ordemdeservico',
            'catologoservico',
            'relatorioponto',
            'relatorio-pessoal',
            'aceite',
            'usuario',
            'relatoriofaturamento',
            'relatoriodesempenho',
            'relatoriogestorprojeto',
        ],
        'deny' => []
    ]
];