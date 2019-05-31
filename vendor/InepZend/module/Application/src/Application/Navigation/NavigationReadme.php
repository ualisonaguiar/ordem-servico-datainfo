<?php

namespace InepZend\Module\Application\Navigation;

use InepZend\Navigation\Service\AbstractNavigation;
use InepZend\Theme\Administrative\View\Helper\MenuHelper;
use InepZend\Navigation\Navigation;

class NavigationReadme extends AbstractNavigation
{

    const NAME_MENU = 'Readme';
    const NAME_MENU_ADMINISTRATIVE = '<i class="icon-wrench"></i> Administrativo';
    const NAME_MENU_LOGS = 'Logs';
    const NAME_MENU_LOGS_ARQUIVOS = 'Arquivos de Logs';
    const NAME_MENU_LOGS_CONFIG = 'Configuração';
    const NAME_MENU_SSI = 'SSI';
    const NAME_MENU_SSI_MENU = 'Árvore(s) de Menu';
    const NAME_MENU_SSI_ACL = 'Controle de Acesso';
    const NAME_MENU_SSI_ACL_ROUTE = 'Rotas';
    const NAME_MENU_SSI_ACL_FORM_ELEMENT = 'Elementos de Formulário';
    const NAME_MENU_CACHE = 'Cache';
    const NAME_MENU_CACHE_MEMCACHE = 'Memcache';
    const NAME_MENU_CACHE_OPCACHE = 'OPCache';
    const NAME_MENU_EXECUTOR = 'Executor';
    const NAME_MENU_EXECUTOR_OPERACAO = 'Operações';
    const NAME_MENU_EXECUTOR_HISTORICO_ENVIO = 'Histórico de Envio';
    const NAME_MENU_EXECUTOR_USUARIO = 'Usuário';
    const NAME_MENU_FILE_CONFIG = 'Arquivos de Configuração';
    const NAME_MENU_EMAIL_LOG = '(cron) E-mail com log';
    const NAME_MENU_DEVELOPMENT = '<i class="icon-fire"></i> Desenvolvimento';
    const NAME_MENU_COMPONENT_PHP = 'Componentes PHP';
    const NAME_MENU_COMPONENT_JS = 'Componentes JS';
    const NAME_MENU_COMPONENT_CSS = 'Componentes CSS';
    const NAME_MENU_COMPONENT_IMAGE = 'Componentes de Imagens';
    const NAME_MENU_MANUAL = 'Manuais';
    const NAME_MENU_DOCUMENTATION = '<i class="icon-book"></i> Documentação';
    const NAME_MENU_GUIDE = 'Guia de Arquitetura PHP';
    const NAME_MENU_DAP = 'DAP';
    const NAME_MENU_DIS = 'DIS';
    const NAME_MENU_DCA = 'DCA';
    const NAME_MENU_DCAT = 'DCAT';
    const URL_SVN_DOC = 'http://svn.inep.gov.br/svn/DESENV/INEP/ARQUITETURA_PHP/ARTEFATOS/trunk/Docs/Analise/';

    protected function getName()
    {
        return self::NAME_MENU;
    }

    protected function getPages($serviceManager)
    {
        return parent::getPages($serviceManager, $this->addMenuContainer($this->getPagesReadme()));
    }

    protected function getPagesReadme()
    {
        if ((!self::getSessionUseNavigationContainer()) || (is_null($arrMenu = $this->getAttributeSession('arrPageReadme')))) {
            $arrMenu = array(
                Navigation::NAME_MENU_START => array(
                    'inicial',
                    'Página inicial do sistema (sair do Readme).',
                ),
                Navigation::NAME_MENU_README => array(
                    'readme',
                    'Página inicial do Readme.',
                ),
                self::NAME_MENU_ADMINISTRATIVE => array(
                    array(
                        self::NAME_MENU_LOGS => array(
                            array(
                                self::NAME_MENU_LOGS_ARQUIVOS => array(
                                    'log',
                                    'Funcionalidade de visualização de logs gerados pelo InepZend.',
                                ),
                                self::NAME_MENU_LOGS_CONFIG => array(
                                    'log-config',
                                    'Funcionalidade de configuração das opções de auditoria de logs gerados pelo InepZend.',
                                ),
                            ),
                            'Módulo com funcionalidades relacionadas aos logs gerados pelo InepZend.',
                        ),
                        self::NAME_MENU_SSI => array(
                            array(
                                self::NAME_MENU_SSI_MENU => array(
                                    'ssi-menu',
                                    'Funcionalidade de administração das ações do SSI de menu.',
                                ),
                                self::NAME_MENU_SSI_ACL => array(
                                    array(
                                        self::NAME_MENU_SSI_ACL_ROUTE => array(
                                            'ssi-acl-route',
                                            'Funcionalidade de administração das ações do SSI de controle de acesso das rotas de navegação.',
                                        ),
                                        self::NAME_MENU_SSI_ACL_FORM_ELEMENT => array(
                                            'ssi-acl-form-element',
                                            'Funcionalidade de administração das ações do SSI de controle de acesso dos elementos de formulário.',
                                        ),
                                    ),
                                    'Funcionalidade de administração das ações do SSI de controle de acesso.',
                                ),
                            ),
                            'Módulo com funcionalidades relacionadas às informações do Sistema de Segurança do Inep (SSI).',
                        ),
                        self::NAME_MENU_CACHE => array(
                            array(
                                self::NAME_MENU_CACHE_MEMCACHE => array(
                                    'memcache',
                                    'Funcionalidade de administração das informações e dados no servidores de memcache.',
                                ),
                                self::NAME_MENU_CACHE_OPCACHE => array(
                                    'opcache',
                                    'Funcionalidade de administração das informações e dados no cache da extensão OPCache.',
                                ),
                            ),
                            'Módulo de visualização das informações dos servidores de memcache.',
                        ),
                        self::NAME_MENU_EXECUTOR => array(
                            array(
                                self::NAME_MENU_EXECUTOR_OPERACAO => array(
                                    'query',
                                    'Funcionalidade de administração das operações de banco de dados e suas execuções.',
                                ),
                                self::NAME_MENU_EXECUTOR_HISTORICO_ENVIO => array(
                                    'historico-envio-operacao',
                                    'Funcionalidade de visualização das informações de históricos dos envios dos e-mails.',
                                ),
                                self::NAME_MENU_EXECUTOR_USUARIO => array(
                                    'usuario',
                                    'Funcionalidade de administração dos usuários/perfis internos do Executor.',
                                ),
                            ),
                            'Módulo com funcionalidades relacionadas às operações de banco de dados e suas execuções controladas.',
                        ),
                        self::NAME_MENU_FILE_CONFIG => array(
                            'application/autoload-config',
                            'Funcionalidade de visualização/edição das informações contidas em arquivos de configuração do sistema.',
                        ),
                        self::NAME_MENU_EMAIL_LOG => array(
                            'cron-send-email-log-application',
                            'Cron que envia e-mail para os responsáveis do sistema com links para os logs gerados pelo InepZend.',
                        ),
                    ),
                    'Funcionalidades administrativas do InepZend.',
                ),
                self::NAME_MENU_DEVELOPMENT => array(
                    array(
                        self::NAME_MENU_COMPONENT_PHP => array(
                            array(),
                            'Visualização de informações dos componentes PHP.',
                        ),
                        self::NAME_MENU_COMPONENT_JS => array(
                            array(),
                            'Visualização de informações dos componentes javascript.',
                        ),
                        self::NAME_MENU_COMPONENT_CSS => array(
                            array(),
                            'Visualização de informações dos componentes CSS.',
                        ),
                        self::NAME_MENU_COMPONENT_IMAGE => array(
                            array(),
                            'Visualização de informações dos componentes de imagens.',
                        ),
                        self::NAME_MENU_MANUAL => array(
                            $this->alertConstruction(),
                            'Visualização de manuais/tutoriais/ajudas de assuntos gerais.',
                        ),
                    ),
                    'Funcionalidades para desenvolvimento no InepZend.',
                ),
                self::NAME_MENU_DOCUMENTATION => array(
                    array(
                        self::NAME_MENU_GUIDE => array(
                            $this->linkSvnDoc('Guia_Arquitetura_PHP.odt'),
                            'Definição da metodologia, o que deve ser seguido em relação à processos e padrões para o desenvolvimento de sistemas PHP no Inep.',
                        ),
                        self::NAME_MENU_DAP => array(
                            $this->linkSvnDoc('DAP_Documento_Arquitetura_Projeto.odt'),
                            'Documento de Arquitetura do Projeto - Informações tecnólogicas de um determinado projeto, inclusive com a descrição de alguns padrões aplicados ao sistema.',
                        ),
                        self::NAME_MENU_DIS => array(
                            $this->linkSvnDoc('DIS_Documento_Implatacao_Sistema.odt'),
                            'Documento de Implantação do Sistema - Informações/procedimentos para a realização da implantação de um determinado sistema, por ambiente (Local, Desenvolvimento, TQS, Homologação, Treinamento, Clone, Produção).',
                        ),
                        self::NAME_MENU_DCA => array(
                            $this->linkSvnDoc('Avaliacao/DCA_Documento_Criterios_Avaliativos_2.odt'),
                            'Documento de Critérios Avaliativos - Itens a serem analisados de acordo com as conformidades de qualidade de desenvolvimento definidas pela Arquitetura do Inep, por ciclo avaliativo de um determinado sistema.',
                        ),
                        self::NAME_MENU_DCAT => array(
                            $this->linkSvnDoc('Avaliacao/DCAT_Documento_Criterios_Avaliativos_Teste'),
                            'Documento de Critérios Avaliativos para Teste - Itens específicos para uma equipe de Teste e Qualidade de Software (de FSW ou do Inep) e verificados no ciclo avaliativo pela equipe de Arquitetura do Inep.',
                        ),
                    ),
                    'Documentos de domínio da Arquitetura PHP do Inep.',
                ),
                Navigation::NAME_MENU_LOGOFF => array(
                    'logoff',
                    'Finalizar acesso no sistema.',
                ),
            );
            if ($this->checkServiceManager()) {
                foreach ($arrMenu[self::NAME_MENU_DEVELOPMENT][0] as $strItemName => &$arrItemInfo) {
                    if (!in_array($strItemName, array(self::NAME_MENU_COMPONENT_PHP, self::NAME_MENU_COMPONENT_JS, self::NAME_MENU_COMPONENT_CSS, self::NAME_MENU_COMPONENT_IMAGE)))
                        continue;
                    $strMethod = 'listMarkdown' . ucfirst(strtolower(end($arrExplode = explode(' ', $strItemName))));
                    $arrFile = $this->getService('InepZend\Module\Application\Service\Readme')->$strMethod();
                    if (count($arrFile) > 0)
                        foreach ($arrFile as $strFile) {
                            $arrItemInfo[0] = array_merge($arrItemInfo[0], array(
                                $strLabel = $this->editFileToLabel($strFile) => array(
                                    'javascript:if(existFunction(\'getContentFromReadme\')){getContentFromReadme(\'' . $strFile . '\');}else{window.location.href=\'' . $this->getBasePath() . '/readme\';}void(0);',
                                    'Informações sobre o componente: \'' . $strLabel . '\'.',
                                )
                            ));
                        } elseif ((is_array($arrItemInfo[0])) && (count($arrItemInfo[0]) == 0))
                        $arrItemInfo[0] = $this->alertConstruction();
                }
            }
            $arrMenu = $this->constructPages($arrMenu, MenuHelper::MENU_TYPE_VERTICAL);
            if (self::getSessionUseNavigationContainer())
                $this->setAttributeSession('arrPageReadme', $arrMenu);
        }
        MenuHelper::setMenuOrientation(MenuHelper::MENU_TYPE_VERTICAL);
        $this->arrMenu = $arrMenu;
        $this->debugExec($this->arrMenu);
        return $this->arrMenu;
    }

    private function editFileToLabel($strFile = null)
    {
        $strLabel = str_replace('/_README.md', '', $strFile);
        if (strpos($strLabel, 'public/vendor') === false)
            $strLabel = str_replace('vendor/InepZend/library/InepZend/', '', $strLabel);
        return $strLabel;
    }

    private function alertConstruction()
    {
        return 'javascript:alertDialog(\'Em desenvolvimento...\',\'Aviso\');void(0);';
    }

    private function linkSvnDoc($strDoc = null)
    {
        return (empty($strDoc)) ? false : 'javascript:window.open(\'' . self::URL_SVN_DOC . $strDoc . '\');void(0);';
    }

}
