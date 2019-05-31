<?php

namespace InepZend\Theme\Administrative\View\Helper;

use InepZend\View\Helper\AbstractMenuHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\Navigation\Navigation;
use Zend\View\Helper\Navigation\Menu;

/**
 * Helper Menu
 *
 * @package View
 * @subpackage Helper
 */
class MenuHelper extends AbstractMenuHelper
{

    const MENU_TYPE_VERTICAL = 'Vertical';
    const MENU_TYPE_HORIZONTAL = 'Horizontal';
    const MENU_DDSMOOTH = 'ddsmooth';
    const MENU_BOOTSTRAP = 'menu-boostrap';

    protected $menuVeritical;
    protected $arrClassCss;
    private static $strMenuName;
    private static $strMenuVersion;
    private static $strMenuOrientation;

    /**
     *
     * @param mix $mixMenu
     * @param mix $mixBreadCrumbs
     * @return array
     */
    public function renderMenu($mixMenu, $mixBreadCrumbs = null)
    {
        $strNameMenu = @$GLOBALS['view_variable']['strNameMenu'];
        if (empty($strNameMenu))
            $strNameMenu = Navigation::NAME_MENU_AUTHENTICATED;
        $this->debugExec($this->getSessionToRender());
        $strIdDivMenu = $this->setPrependFileMenu();
        if ($this->getSessionToRender()) {
            $strMenuHtml = $this->getMenuSession($this->getKeyNameMenuSession());
            if (!empty($strMenuHtml))
                return $strMenuHtml . $this->getHtmlBreadCrumbs($mixBreadCrumbs, $strIdDivMenu, $strNameMenu);
        }
        $this->editPageMenuApplicationInfo($mixMenu);
        $mixMenuHtml = '';
        $mixMenu = $this->ordinationPresentationMenu($mixMenu);
        switch (self::getMenuOrientation()) {
            case self::MENU_TYPE_HORIZONTAL:
                $mixMenuHtml = $this->formatMenuHorizontal($strIdDivMenu, $mixMenu);
                break;
            case self::MENU_TYPE_VERTICAL:
                $mixMenuHtml = $this->formatMenuVertical($strIdDivMenu);
                break;
            default:
                $strMenuHorizontal = $this->formatMenuHorizontal($strIdDivMenu, $mixMenu);
                $strMenuVertical = $this->formatMenuVertical($strIdDivMenu, true);
                $mixMenuHtml = array(
                    self::MENU_TYPE_HORIZONTAL => $strMenuHorizontal,
                    self::MENU_TYPE_VERTICAL => $strMenuVertical
                );
                break;
        }
        if ($this->getSessionToRender())
            $this->setMenuSession($this->getKeyNameMenuSession(), $mixMenuHtml);
        return $mixMenuHtml . $this->getHtmlBreadCrumbs($mixBreadCrumbs, $strIdDivMenu, $strNameMenu);
    }

    /**
     *
     * @param string $strMenuHtml
     * @param string $strIdDivMenu
     * @return string
     */
    public function getHtmlMenu($strMenuHtml, $strIdDivMenu = 'inepZend')
    {
        return '<div id="' . $strIdDivMenu . 'Menu" class="no-print" style="display: block; min-height: ' . ((self::getMenuName() == self::MENU_BOOTSTRAP) ? '38' : '20') . 'px;">
            ' . html_entity_decode($strMenuHtml) . '
        </div>';
    }

    /**
     *
     * @param string $strIdDivMenu
     * @param boolean $booRemoveMenuPrincipal
     * @return string
     */
    protected function formatMenuVertical($strIdDivMenu, $booRemoveMenuPrincipal = false)
    {
        if ($booRemoveMenuPrincipal)
            $this->menuVeritical = $this->removeMenuPrincipal($this->menuVeritical);
        $this->arrClassCss['ulClass'] = $this->arrClassCss['ulClass'] . ' position-verticial';
        return $this->getHtmlMenu(Menu::renderMenu($this->menuVeritical, $this->arrClassCss), $strIdDivMenu);
    }

    /**
     *
     * @param string $strIdDivMenu
     * @param mix $mixMenuSsi
     * @return string
     */
    protected function formatMenuHorizontal($strIdDivMenu, $mixMenuSsi)
    {
        return $this->getHtmlMenu(Menu::renderMenu($mixMenuSsi, $this->arrClassCss), $strIdDivMenu);
    }

    /**
     *
     * @return string
     */
    protected function getKeyNameMenuSession()
    {
        return self::getMenuName() . '-' . self::getMenuVersion() . '-' . self::getMenuOrientation();
    }

    /**
     *
     * @param string $strMenuName
     * @return string
     */
    public static function setMenuName($strMenuName)
    {
        self::$strMenuName = $strMenuName;
    }

    /**
     *
     * @return string
     */
    public static function getMenuName()
    {
        if (empty(self::$strMenuName))
            self::setMenuName(self::MENU_BOOTSTRAP);
        return self::$strMenuName;
    }

    /**
     *
     * @param string $strMenuVersion
     * @return string
     */
    public static function setMenuVersion($strMenuVersion)
    {
        self::$strMenuVersion = $strMenuVersion;
    }

    /**
     *
     * @return string
     */
    public static function getMenuVersion()
    {
        return self::$strMenuVersion;
    }

    /**
     *
     * @return string
     */
    public static function getMenuOrientation()
    {
        if (!self::$strMenuOrientation)
            self::$strMenuOrientation = self::MENU_TYPE_HORIZONTAL;
        return self::$strMenuOrientation;
    }

    /**
     *
     * @param string $strMenuOrientation
     */
    public static function setMenuOrientation($strMenuOrientation)
    {
        self::$strMenuOrientation = $strMenuOrientation;
    }

    /**
     *
     * @return string
     */
    protected function setPrependFileMenu()
    {
        $renderer = $this->getView();
        $arrIncludeFileMenu = array();
        switch (self::getMenuName()) {
            case self::MENU_DDSMOOTH:
                $arrIncludeFileMenu['css'][] = '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/css/ddsmoothmenu.css';
                $arrIncludeFileMenu['css'][] = '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/css/ddsmoothmenu-v.css';
                $arrIncludeFileMenu['css'][] = '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/css/inep-zend.css';
                $arrIncludeFileMenu['js'][] = '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/js/ddsmoothmenu.js';
                $arrIncludeFileMenu['js'][] = '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/js/inep-zend.js';
                $this->arrClassCss = array(
                    'ulClass' => 'menuList'
                );
                $strIdDivMenu = 'inepZend';
                break;
            default:
                $arrIncludeFileMenu['css'][] = '/vendor/InepZend/menu/menu-bootstrap/css/style.css';
                $arrIncludeFileMenu['js'][] = '/vendor/InepZend/menu/menu-bootstrap/js/script.js';
                $this->arrClassCss = array(
                    'ulClass' => 'nav nav-pills menu-personalizado hide'
                );
                $strIdDivMenu = 'inepZendMenuBootstrap';
                break;
        }
        AbstractHtmlHeadHelper::prependIncludeFile($arrIncludeFileMenu, $renderer->headScript(), $renderer->headLink(), $renderer->basePath());
        return $strIdDivMenu;
    }

    /**
     *
     * @param mix $mixMenuSsi
     * @return mix
     */
    protected function ordinationPresentationMenu($mixMenuSsi)
    {
        foreach ($mixMenuSsi as $menuSsi) {
            $arrMenuSystem = $menuSsi->toArray();
            if (array_key_exists('position', $arrMenuSystem)) {
                if ($arrMenuSystem['position'] == self::MENU_TYPE_VERTICAL) {
                    if (!isset($this->menuVeritical))
                        $this->menuVeritical = clone $mixMenuSsi;
                    $mixMenuSsi->removePage($menuSsi);
                } else
                if (isset($this->menuVeritical))
                    $this->menuVeritical->removePage($menuSsi);
            }
        }
        return $mixMenuSsi;
    }

    /**
     *
     * @param object $menuNavigation
     * @return object
     */
    private function removeMenuPrincipal($menuNavigation)
    {
        $arrLabelMenuRemove = array(
            Navigation::NAME_MENU_START,
            Navigation::NAME_MENU_CHANGE_PASS,
            Navigation::NAME_MENU_LOGOFF,
            Navigation::NAME_MENU_README,
        );
        if ($menuNavigation) {
            foreach ($arrLabelMenuRemove as $strLabelMenu) {
                $pageRemove = $menuNavigation->findOneByLabel($strLabelMenu);
                $menuNavigation->removePage($pageRemove);
            }
        }
        return $menuNavigation;
    }

}
