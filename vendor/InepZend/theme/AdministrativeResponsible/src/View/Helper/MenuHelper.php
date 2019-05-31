<?php

namespace InepZend\Theme\AdministrativeResponsible\View\Helper;

use InepZend\View\Helper\AbstractMenuHelper;
use Zend\View\Helper\Navigation\Menu;
use InepZend\Navigation\Navigation;
use InepZend\View\Helper\ApplicationInfoHelper;

/**
 * Helper Menu
 *
 * @package View
 * @subpackage Helper
 */
class MenuHelper extends AbstractMenuHelper
{

    const PREFIX_ICON = 'icon-';
    const PREFIX_FONT_AWESOME = 'fa fa-';

    protected $booSessionToRender = false;
    protected static $arrFromTo = array(
        'from' => array(
            '-off',
            '-info-sign',
        ),
        'to' => array(
            '-sign-out',
            '-exclamation-circle',
        ),
    );
    private static $strHtmlBreadCrumbsResult = '';

    public function renderMenu($mixMenu, $mixBreadCrumbs = null, $strNameModule = null)
    {
        $strNameMenu = @$GLOBALS['view_variable']['strNameMenu'];
        if (empty($strNameMenu))
            $strNameMenu = Navigation::NAME_MENU_AUTHENTICATED;
        $this->debugExec($this->getSessionToRender());
        if ($this->getSessionToRender()) {
            $strMenuHtml = $this->getMenuSession($this->getKeyNameMenuSession($strNameModule));
            if (!empty($strMenuHtml)) {
                self::setHtmlBreadCrumbsResult($this->getHtmlBreadCrumbs($mixBreadCrumbs, null, $strNameMenu));
                return $strMenuHtml;
            }
        }
        $menuSearch = $mixMenu->findBy('uri', substr($_SERVER['REQUEST_URI'], 1));
        if ($menuSearch)
            $menuSearch->setActive(true);
        $this->editPageMenuApplicationInfo($mixMenu);
        $this->setDefaultIcon($mixMenu);
        $strMenuHtml = html_entity_decode(Menu::renderMenu($mixMenu, array('ulClass' => 'nav nav-sidebar ul-print')));
        self::replaceIcon($strMenuHtml);
        self::replaceNotSpa($strMenuHtml);
        $strMenuHtml = str_replace(' href=', ' style="cursor: pointer;" data-ng-href=', $strMenuHtml);
        $this->debugExec($strMenuHtml);
        if ($this->getSessionToRender())
            $this->setMenuSession($this->getKeyNameMenuSession($strNameModule), $strMenuHtml);
        self::setHtmlBreadCrumbsResult($this->getHtmlBreadCrumbs($mixBreadCrumbs, null, $strNameMenu));
        $strMenuHtml .= '<script type="text/javascript">editMenu();</script>';
        return $strMenuHtml;
    }

    private function setDefaultIcon($menu = null, $strClass = null)
    {
        if (!is_object($menu))
            return false;
        if (empty($strClass))
            $strClass = 'fa fa-arrow-circle-right';
        if ($menu->getPages()) {
            foreach ($menu->getPages() as $page) {
                if (strpos($page->getLabel(), '<i') === false)
                    $page->setLabel('<i class="' . $strClass . '"></i>' . $page->getLabel());
                if ($page->getPages())
                    $this->setDefaultIcon($page, 'fa fa-arrow-circle-o-right');
            }
        }
        return true;
    }

    public function getHtmlBreadCrumbsResult()
    {
        return self::$strHtmlBreadCrumbsResult;
    }

    private static function setHtmlBreadCrumbsResult($strHtmlBreadCrumbsResult = null)
    {
        self::replaceIcon($strHtmlBreadCrumbsResult);
        return (self::$strHtmlBreadCrumbsResult = $strHtmlBreadCrumbsResult);
    }

    private static function replaceIcon(&$strMenuHtml = null)
    {
        $strMenuHtml = str_replace(self::$arrFromTo['from'], self::$arrFromTo['to'], $strMenuHtml);
        $strMenuHtml = str_replace(self::PREFIX_ICON, self::PREFIX_FONT_AWESOME, $strMenuHtml);
        return true;
    }

    private static function replaceNotSpa(&$strMenuHtml = null)
    {
        $arrRouteNotSpa = (new ApplicationInfoHelper())->getAutoloadApplicationInfoRoutesNotSpa();
        if ((is_array($arrRouteNotSpa)) && (!empty($arrRouteNotSpa)))
            foreach ($arrRouteNotSpa as $strRoute)
                $strMenuHtml = str_replace('href="' . $strRoute . '"', 'href="' . $strRoute . '" data-spa="false"', $strMenuHtml);
        return true;
    }

}
