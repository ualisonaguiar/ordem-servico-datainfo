<?php

use OrdemServico\Entity\Usuario as UsuarioEntity;
use InepZend\Navigation\Navigation;
use InepZend\Util\ApplicationProperties;

const NAME_MENU_ATIVIDADES = 'Atividades';
const NAME_MENU_DEMANDAS = 'Demandas';
const NAME_MENU_ORDENS_SERVICO = 'Ordens de Serviço';
const NAME_MENU_RELATORIO_PAGAMENTO = 'Relatório Faturamento';
const NAME_MENU_CATALOGO_SERVICO = 'Catálogo de Serviço';
const NAME_MENU_RELATORIO_DESEMPENHO = 'Relatório Desempenho';
const NAME_MENU_RELATORIO_PONTO = 'Relatório Ponto';
const NAME_MENU_RELATORIO_DESEMPENHO_INDIVIDUAL = 'Relatório de Desempenho Individual';
const NAME_MENU_USUARIO = 'Usuário';
const NAME_MENU_RELATORIO_GESTOR_PROJETO = 'Relatório Gestor Preposto';
const NAME_MENU_ALTERAR_SENHA = 'Alteração de senha';

$arrPadrao = [
    NAME_MENU_ATIVIDADES => [
        'atividade',
        'Funcionalidade de administração das atividades.',
    ],
    NAME_MENU_CATALOGO_SERVICO => [
        'catologoservico',
        'Funcionalidade de administração de cadastro de Catálogo de Serviços.',
    ],
    NAME_MENU_DEMANDAS => [
        'demanda',
        'Funcionalidade de administração das demandas.',
    ],
    NAME_MENU_ORDENS_SERVICO => [
        'ordemdeservico',
        'Funcionalidade de administração das ordens de serviço.',
    ],
    NAME_MENU_RELATORIO_PONTO => [
        'relatorioponto',
        'Funcionalidade responsável por lista os pontos de entrada e saída dos funcionários.',
    ],
    NAME_MENU_RELATORIO_DESEMPENHO_INDIVIDUAL => [
        'relatorio-pessoal',
        'Funcionalidade responsável por exibir o relatório de desempenho pessoal.',
    ]
];

$arrDemandante = [
    NAME_MENU_ORDENS_SERVICO => [
        'ordemdeservico',
        'Funcionalidade de administração das ordens de serviço.',
    ],
];

$arrPreposto = [
    NAME_MENU_RELATORIO_PAGAMENTO => [
        'relatoriofaturamento',
        'Funcionalidade de emissão do relatório.',
    ],
    NAME_MENU_RELATORIO_DESEMPENHO => [
        'relatoriodesempenho',
        'Funcionalidade de emissão do relatório de desempenho.',
    ],
    NAME_MENU_USUARIO => [
        'usuario',
        'Funcionalidade responsável pela edição do usuário.',
    ],
];

$arrPrepostoGestor = [
    NAME_MENU_RELATORIO_GESTOR_PROJETO => [
        'relatoriogestorprojeto',
        'Funcionalidade responsável pela.',
    ],
];

$arrSistema = [
    Navigation::NAME_MENU_LOGOFF => [
        'logoff',
        'Finalizar acesso no sistema.',
    ]
];

$strClinet = ApplicationProperties::get('application.client');

/**
 * INEP
 */
if ($strClinet == 'inep') {
    return [
        'menu-sistema' => [
            UsuarioEntity::CO_PERFIL_FUNCIONARIO => array_merge($arrPadrao, $arrSistema),
            UsuarioEntity::CO_PERFIL_PREPOSTO => array_merge($arrPadrao, $arrPreposto, $arrPrepostoGestor, $arrDemandante, $arrSistema),
            UsuarioEntity::CO_PERFIL_SERVIDOR => array_merge($arrDemandante, $arrSistema),
            UsuarioEntity::CO_PERFIL_GESTOR => array_merge($arrDemandante, $arrPrepostoGestor, $arrSistema),
            UsuarioEntity::CO_PERFIL_CE => array_merge($arrPadrao, $arrSistema),
        ]
    ];
} else {
$arrMenuIbama = [
    NAME_MENU_ALTERAR_SENHA => [
        'change_pass',
        'Alteração de senha'
    ],
    NAME_MENU_RELATORIO_PONTO => [
        'relatorioponto',
        'Funcionalidade responsável por lista os pontos de entrada e saída dos funcionários.',
    ]
];

    return [
        'menu-sistema' => [
            UsuarioEntity::CO_PERFIL_FUNCIONARIO => array_merge($arrMenuIbama, $arrSistema),
            UsuarioEntity::CO_PERFIL_PREPOSTO => array_merge($arrPadrao, $arrPreposto, $arrPrepostoGestor, $arrDemandante, $arrMenuIbama, $arrSistema),
            UsuarioEntity::CO_PERFIL_CE => array_merge($arrSistema),
        ]
    ];
}