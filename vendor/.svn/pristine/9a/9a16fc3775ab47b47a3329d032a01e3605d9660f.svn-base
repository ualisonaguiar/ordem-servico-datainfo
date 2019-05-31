<?php

namespace InepZend\View\Helper;

use Zend\View\Helper\Navigation\Menu;
use InepZend\Navigation\Service\AbstractNavigation;
use InepZend\Navigation\Navigation;
use InepZend\Session\SessionTrait;
use InepZend\View\Helper\ApplicationInfoHelper;
use InepZend\Util\Server;
use InepZend\Util\DebugExec;

abstract class AbstractMenuHelper extends Menu
{

    use SessionTrait,
        DebugExec;

    const DEBUG = AbstractNavigation::DEBUG;
    
    protected $booSessionToRender = true;

    public function renderMenu($mixMenu, $mixBreadCrumbs = null, $strNameModule = null)
    {
        $this->debugExec($this->getSessionToRender());
        if ($this->getSessionToRender()) {
            $strMenuHtml = $this->getMenuSession($this->getKeyNameMenuSession($strNameModule));
            if (!empty($strMenuHtml))
                return $this->getHtmlBreadCrumbs($mixBreadCrumbs) . $strMenuHtml;
        }
        $strMenuHtml = $this->formatMenuVertical($this->getHtmlMenu(parent::renderMenu($mixMenu, array('ulClass' => 'menuList')), 'inepZendMenuColapse'));
        $this->debugExec($strMenuHtml);
        if ($this->getSessionToRender())
            $this->setMenuSession($this->getKeyNameMenuSession($strNameModule), $strMenuHtml);
        return $this->getHtmlBreadCrumbs($mixBreadCrumbs) . $strMenuHtml;
    }

    public function getHtmlMenu($strMenuHtml, $strIdDivMenu = 'inepZend')
    {
        return '<div id="' . $strIdDivMenu . '" class="no-print" style="display: none;">' . $strMenuHtml . ' </div>';
    }

    protected function formatMenuVertical($strHtmlMenu)
    {
        return '<div class="menuVerticalSize no-print">' . $strHtmlMenu . '</div>';
    }

    protected function getHtmlBreadCrumbs($breadCrumbs = null, $strIdDivMenu = 'inepZend', $strNameMenu = Navigation::NAME_MENU_PUBLIC)
    {
        $strHtml = '<div>' . html_entity_decode(str_replace('&gt; <a href="&#x23;">' . $strNameMenu . '</a>', '', $this->getHtmlBreadCrumbsFromFindBy($breadCrumbs, $strIdDivMenu))) . '</div>';
        if ($strHtml == '<div></div>')
            $strHtml = str_replace('</div>', '<div id="Breadcrumbs" class="breadcrumb" style="display: none;"></div></div>', $strHtml);
        return $strHtml;
    }

    protected function getMenuSession($strTypeMenu)
    {
        $session = self::getSessionInstance('menuRenderizado');
        return ($session->offsetExists($strTypeMenu)) ? $session->offsetGet($strTypeMenu) : null;
    }

    protected function setMenuSession($strTypeMenu, $strHtmlMenuRender)
    {
        $session = self::getSessionInstance('menuRenderizado');
        return $session->offsetSet($strTypeMenu, $strHtmlMenuRender);
    }

    protected function getKeyNameMenuSession($strNameModule)
    {
        return get_class($this) . '_' . $strNameModule;
    }

    protected function getSessionToRender()
    {
        $booSessionToRender = AbstractNavigation::getSessionUseNavigationContainer();
        if ($booSessionToRender === true)
            $booSessionToRender = $this->booSessionToRender;
        return $booSessionToRender;
    }

    protected function editPageMenuApplicationInfo($menu = null)
    {
        if ((is_object($menu)) && ($menu->getPages())) {
            if ((new ApplicationInfoHelper())->getAutoloadApplicationInfoParamsEditMyInfoActive() === true)
                return true;
            $arrPage = array();
            foreach ($menu->getPages() as $mixKey => $page) {
                if (strpos($page->getUri(), 'ssi-personal-info') !== false)
                    continue;
                $arrPage[$mixKey] = $page;
            }
            $menu->setPages($arrPage);
            return true;
        }
        return false;
    }

    private function getHtmlBreadCrumbsFromFindBy($breadCrumbs, $strIdDivMenu = 'inepZend')
    {
        $breadCrumbsSearch = $breadCrumbs->findBy('uri', substr($_SERVER['REQUEST_URI'], 1));
        if ($breadCrumbsSearch) {
            if ($breadCrumbsSearchActive = $breadCrumbs->findBy('active', true))
                $breadCrumbsSearchActive->setActive(false);
            $breadCrumbsSearch->setActive(true);
        }
        $strBreadCrumbs = $breadCrumbs->render();
        $strHtmlBreadCrumbs = '';
        if ($strBreadCrumbs)
            $strHtmlBreadCrumbs = '<div id="' . $strIdDivMenu . 'Breadcrumbs" class="breadcrumb">' . $strBreadCrumbs . ' </div>';
        return $strHtmlBreadCrumbs;
    }

}
