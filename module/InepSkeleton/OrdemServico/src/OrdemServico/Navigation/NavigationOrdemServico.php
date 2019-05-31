<?php

namespace OrdemServico\Navigation;

use InepZend\Navigation\Service\AbstractNavigation;
use InepZend\Theme\Administrative\View\Helper\MenuHelper;
use InepZend\Navigation\Navigation as NavigationInepZend;

class NavigationOrdemServico extends AbstractNavigation
{

    const NAME_MENU = 'OrdemServico';
    const NAME_MENU_ATIVIDADES = 'Atividades';
    const NAME_MENU_DEMANDAS = 'Demandas';
    const NAME_MENU_ORDENS_SERVICO = 'Ordens de Serviço';
    const NAME_MENU_RELATORIO_PAGAMENTO = 'Relatório Faturamento';
    const NAME_MENU_CATALOGO_SERVICO = 'Catálogo de Serviço';
    const NAME_MENU_RELATORIO_DESEMPENHO = 'Relatório Desempenho';
    const NAME_MENU_RELATORIO_PONTO = 'Relatório Ponto';
    const NAME_MENU_RELATORIO_DESEMPENHO_INDIVIDUAL = 'Relatório de Desempenho Individual';
    const NAME_MENU_USUARIO = 'Usuário';
    const NAME_MENU_ACERTO = 'Aceite de OS';

    protected function getName()
    {
        return self::NAME_MENU;
    }

    protected function getPages($serviceManager)
    {
        return parent::getPages($serviceManager, $this->addMenuContainer($this->getPagesOrdemServico()));
    }

    protected function getPagesOrdemServico()
    {
        if ((!self::getSessionUseNavigationContainer()) || (is_null($arrMenu = $this->getAttributeSession('arrPageOrdemServico')))) {
            $serviceProfile = $this->getService('OrdemServico\Service\Profile');
            $arrMenu = $this->getService('config')['menu-sistema'][$serviceProfile->getTipoVinculo()];
            $arrMenu = $this->constructPages($arrMenu, MenuHelper::MENU_TYPE_VERTICAL);
            if (self::getSessionUseNavigationContainer())
                $this->setAttributeSession('arrPageOrdemServico', $arrMenu);
        }
        MenuHelper::setMenuOrientation(MenuHelper::MENU_TYPE_VERTICAL);
        $session = self::getSessionInstance(self::KEY_SESSION_INSTANCE);
        $session->offsetSet(NavigationInepZend::KEY_SESSION_ORIENTATION_CONTAINER, MenuHelper::getMenuOrientation());
        $this->arrMenu = $arrMenu;
        $this->debugExec($this->arrMenu);
        $this->getSessionInstance('InepZend\Navigation\Navigation')->offsetSet('arrPageSsi', $arrMenu);
        return $this->arrMenu;
    }

    protected function getInformacaoUsuario()
    {
        $identitySession = $this->getService('OrdemServico\Service\Profile')->getIdentity();
        $strUserLogado = strtolower($identitySession->usuarioSistema->usuario->login);
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy(['ds_login' => $strUserLogado]);
        return reset($arrUsuario);
    }
}
