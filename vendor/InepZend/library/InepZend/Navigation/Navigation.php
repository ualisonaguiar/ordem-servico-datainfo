<?php

namespace InepZend\Navigation;

use InepZend\Navigation\Service\AbstractNavigation;
use InepZend\Ssi\Entity\PerfilAcao as PerfilAcaoEnity;
use InepZend\Theme\Administrative\View\Helper\MenuHelper;
use InepZend\Module\Authentication\Service\Authentication as AuthenticationService;
use Doctrine\DBAL\Platforms\OraclePlatform;
use InepZend\Util\Environment;

class Navigation extends AbstractNavigation
{

    const NAME_MENU_START = '<i class="icon-home"></i> Inicial';
    const NAME_MENU_LOGOFF = '<i class="icon-off"></i> Sair';
    const NAME_MENU_EDIT_MY_INFO = '<i class="icon-user"></i> Atualizar Meus Dados';
    const NAME_MENU_CHANGE_PASS = '<i class="icon-lock"></i> Trocar Senha';
    const NAME_MENU_README = '<i class="icon-info-sign"></i> Readme';
    const NAME_MENU_AUTHENTICATED = 'authenticated';
    const NAME_MENU_PUBLIC = 'public';
    const NOME_MENU_PUBLICO = self::NAME_MENU_PUBLIC;
    const KEY_SESSION_ORIENTATION_CONTAINER = 'orientationContainer';

    protected function getPages($serviceManager)
    {
        $session = self::getSessionInstance(self::KEY_SESSION_INSTANCE);
        if (($session->offsetExists(self::KEY_SESSION_NAVIGATION_CONTAINER)) && (array_key_exists(get_class($this), $session->offsetGet(self::KEY_SESSION_NAVIGATION_CONTAINER)))) {
            $this->debugExec('COM session');
            MenuHelper::setMenuOrientation($session->offsetGet(self::KEY_SESSION_ORIENTATION_CONTAINER));
        } else {
            $this->debugExec('SEM session');
            $session->offsetSet(self::KEY_SESSION_ORIENTATION_CONTAINER, MenuHelper::getMenuOrientation());
        }
        return parent::getPages($serviceManager, array_merge($this->addMenuContainer($this->getPagesSSI(), self::NAME_MENU_AUTHENTICATED), $this->addMenuContainer($this->getPagesPublic(), self::NAME_MENU_PUBLIC)));
    }

    protected function getPagesPublic()
    {
        return $this->getPagesPublico();
    }

    protected function getPagesPublico()
    {
        return array();
    }

    protected function getPagesAuthenticated()
    {
        return $this->getPagesSSI();
    }

    protected function getPagesSSI()
    {
        if ((!self::getSessionUseNavigationContainer()) || (is_null($arrMenu = $this->getAttributeSession('arrPageSsi')))) {
            $arrMenu = $this->addMenuItem(self::NAME_MENU_START, 'inicial', 'Página inicial do sistema.');
            if (
                (AuthenticationService::isLdap()) ||
                (AuthenticationService::isFacebook()) ||
                (AuthenticationService::isGoogle()) ||
                (AuthenticationService::isAuthBasic())
            ) {

            } else {
                $arrActionProfile = (($this->checkServiceManager()) && ($this->getService('InepZend\Doctrine\ORM\EntityManager')->getConnection()->getDatabasePlatform() instanceof OraclePlatform)) ? $this->getService('InepZend\Ssi\Service\PerfilAcao')->getPerfilAcaoUsuario() : null;
                if (is_array($arrActionProfile)) {
                    $this->debugExec($arrActionProfile);
                    $arrTypePosition = array(
                        self::PREFIX_POSITION_VERTICAL => MenuHelper::MENU_TYPE_VERTICAL,
                        self::PREFIX_POSITION_HORIZONTAL => MenuHelper::MENU_TYPE_HORIZONTAL
                    );
                    $arrMenuOrientation = array();
                    foreach ($arrActionProfile as $profileAction) {
                        if (!$this->booTypeMenuUnknown($profileAction->getSgAcao()))
                            continue;
                        $strSgAcao = $profileAction->getSgAcao();
                        $strPosition = MenuHelper::MENU_TYPE_HORIZONTAL;
                        $strTypePositionAction = substr($strSgAcao, 0, 2);
                        $arrMenuOrientation[] = $strPosition;
                        if (array_key_exists($strTypePositionAction, $arrTypePosition)) {
                            $strPosition = $arrTypePosition[$strTypePositionAction];
                            $profileAction->setSgAcao(substr($strSgAcao, 2));
                        }
                        $arrMenuOrientation[] = $strPosition;
                        $this->makeMenuHierarchy($profileAction, $this->getBaseUrl(), $strPosition);
                    }
                    MenuHelper::setMenuOrientation(implode(array_unique($arrMenuOrientation), '|'));
                    $this->debugExec($this->arrMenu);
                    if (is_array($this->arrMenu)) {
                        foreach ($this->arrMenu as $mixKey => $mixValue) {
                            $arrMenu[$mixKey] = $mixValue;
                            $arrMenu[$mixKey][self::KEY_POSITION] = $mixValue[self::KEY_POSITION];
                        }
                    }
                }
                $arrMenu = array_merge($arrMenu, $this->addMenuItem(self::NAME_MENU_EDIT_MY_INFO, 'ssi-personal-info', 'Atualizar meus dados.'));
                $arrMenu = array_merge($arrMenu, $this->addMenuItem(self::NAME_MENU_CHANGE_PASS, 'change_pass', 'Trocar senha.'));
            }
            if (!Environment::isProduction())
                $arrMenu = array_merge($arrMenu, $this->addMenuItem(self::NAME_MENU_README, 'readme', 'Visualizar informações da revisão da aplicação.'));
            $arrMenu = array_merge($arrMenu, $this->addMenuItem(self::NAME_MENU_LOGOFF, 'logoff', 'Finalizar acesso no sistema.'));
            if (self::getSessionUseNavigationContainer())
                $this->setAttributeSession('arrPageSsi', $arrMenu);
        }
        $this->arrMenu = $arrMenu;
        $this->debugExec($this->arrMenu);
        return $this->arrMenu;
    }

    /**
     * Metodo responsavel pela construcao da estrutura de itens e subitens do array
     * que sera renderizada pela classe navigation.
     *
     * @param mix $mixMenu = Referencia do array de menu que sera renderizado
     * @param array $arrHierarchy = lista de itens que define a profundidade do submenu
     * @param \InepZend\Ssi\Entity\Perfil $actionProfile = tupla do item de menu a ser adicionado
     * @param string $strContext = contexto para a uri do link
     * @param int $intLimit = limite de profundidade da tupla
     * @param int $intLevel = nivel de atual de profundidade da tupla
     */
    protected function addPages(&$mixMenu, $arrHierarchy, PerfilAcaoEnity $actionProfile, $strContext, $intLimit, $intLevel = 0)
    {
        $intNextLevel = $intLevel + 1;
        if (!is_array($mixMenu))
            $mixMenu = array();
        if ($intLevel < $intLimit) {
            $arrDestination = $this->prepareArrDestination($arrHierarchy[$intNextLevel]);
            $this->debugExec($arrDestination);
            if (!array_key_exists(self::KEY_PAGES, $mixMenu)) {
                $mixMenu = array_merge($mixMenu, array(self::KEY_PAGES => array()), array(self::KEY_URI => self::KEY_URI_DEFAULT));
                if (!array_key_exists(self::KEY_LABEL, $mixMenu))
                    $mixMenu = array_merge($mixMenu, array(self::KEY_LABEL => $actionProfile->getNoAcao()));
                if (!array_key_exists(self::KEY_TITLE, $mixMenu))
                    $mixMenu = array_merge($mixMenu, array(self::KEY_TITLE => $actionProfile->getDsAcao()));
                $this->debugExec($mixMenu);
                $this->addPages($mixMenu[self::KEY_PAGES], $arrHierarchy, $actionProfile, $strContext, $intLimit, $intNextLevel);
            } else {
                if (!array_key_exists($arrDestination[0], $mixMenu[self::KEY_PAGES])) {
                    $mixMenu[self::KEY_PAGES] = array_merge($mixMenu[self::KEY_PAGES], array($arrDestination[0] => array()));
                    $this->addPages($mixMenu[self::KEY_PAGES], $arrHierarchy, $actionProfile, $strContext, $intLimit, $intNextLevel);
                    $this->debugExec($mixMenu[self::KEY_PAGES]);
                } else
                    $this->addPages($mixMenu[self::KEY_PAGES][$arrDestination[0]], $arrHierarchy, $actionProfile, $strContext, $intLimit, $intNextLevel);
            }
        } elseif (($intLevel == $intLimit) && ($intLevel > 0)) {
            $arrDestination = $this->prepareArrDestination($arrHierarchy[$intLevel]);
            if (!array_key_exists($arrDestination[0], $mixMenu))
                $mixMenu[$arrDestination[0]] = array();
            if (sizeof($arrDestination) == 1)
                $mixMenu[$arrDestination[0]] = array_merge($mixMenu[$arrDestination[0]], array(self::KEY_LABEL => $actionProfile->getNoAcao()), array(self::KEY_URI => $strContext . self::KEY_URI_DEFAULT), array(self::KEY_TITLE => $actionProfile->getDsAcao()));
            else {
                $mixMenu[$arrDestination[0]] = array_merge($mixMenu[$arrDestination[0]], array(self::KEY_LABEL => $actionProfile->getNoAcao()), array(self::KEY_TITLE => $actionProfile->getDsAcao()));
                if (sizeof($arrDestination) == 1)
                    $mixMenu[$arrDestination[0]] = array_merge($mixMenu[$arrDestination[0]], array(self::KEY_URI => $strContext . $arrDestination[0]));
                else {
                    if (strpos($arrDestination[1], '/')) {
                        $arrAction = explode('/', $arrDestination[1]);
                        $mixMenu[$arrDestination[0]] = array_merge($mixMenu[$arrDestination[0]], array(self::KEY_URI => $strContext . $arrAction[0] . '/' . $arrAction[1]));
                    } else
                        $mixMenu[$arrDestination[0]] = array_merge($mixMenu[$arrDestination[0]], array(self::KEY_URI => $strContext . $arrDestination[1]));
                }
            }
        }
    }

    private function prepareArrDestination($strDestination)
    {
        return (preg_match("/[a-zA-Z0-9]:[a-zA-Z0-9]/", $strDestination)) ? explode(':', $strDestination) : array($strDestination);
    }

    private function booTypeMenuUnknown($strAcronymAction)
    {
        $booTypeMenuUnknown = true;
        $this->debugExec($strAcronymAction);
        if ($strAcronymAction == PerfilAcaoEnity::ACAO_DEFAUT_SSI)
            $booTypeMenuUnknown = false;
        if (preg_match('/(RSRC)/', $strAcronymAction))
            $booTypeMenuUnknown = false;
        return $booTypeMenuUnknown;
    }

    private function makeMenuHierarchy(PerfilAcaoEnity $actionProfile, $strContext, $strPosition)
    {
        $arrAcronym = explode(':', str_replace('__', ':', strtolower($actionProfile->getSgAcao())));
        $strAcronym = $arrAcronym[0];
        if (sizeof($arrAcronym) > 1)
            $strAcronym .= ':' . str_replace('_', '/', $arrAcronym[1]);
        $this->debugExec($strAcronym);
        unset($arrAcronym);
        $arrHierarchy = explode('_', $strAcronym);
        $intLimit = sizeof($arrHierarchy);
        $this->debugExec($arrHierarchy);
        foreach ($arrHierarchy as $intItem => $strDestination) {
            $arrDestination = $this->prepareArrDestination($strDestination);
            if (empty($this->arrMenu))
                $this->arrMenu[$arrDestination[0]] = array();
            if ((sizeof($arrDestination) == 1) && ($intItem == 0) && ($intLimit > 1))
                $this->addPages($this->arrMenu[$arrDestination[0]], $arrHierarchy, $actionProfile, $strContext, $intLimit - 1, $intItem);
            elseif ($intLimit == 1) {
                $this->arrMenu[$arrDestination[0]][self::KEY_LABEL] = $actionProfile->getNoAcao();
                $this->arrMenu[$arrDestination[0]][self::KEY_TITLE] = $actionProfile->getDsAcao();
                $this->arrMenu[$arrDestination[0]][self::KEY_POSITION] = $strPosition;
                if (sizeof($arrDestination) == 1)
                    $strContext .= ($arrDestination[0] == strtolower($actionProfile->getSgAcao())) ? self::KEY_URI_DEFAULT : $strContext . $arrDestination[0];
                else {
                    if (strpos($arrDestination[1], '/')) {
                        $arrAction = explode('/', $arrDestination[1]);
                        $strContext .= $arrAction[0] . '/' . $arrAction[1];
                    } else
                        $strContext .= $arrDestination[1];
                }
                $this->arrMenu[$arrDestination[0]][self::KEY_URI] = $strContext;
            }
        }
    }

}
