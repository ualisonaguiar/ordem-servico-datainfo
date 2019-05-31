<?php

namespace InepZend\Module\Application\Controller;

use InepZend\Controller\AbstractControllerServiceManager;
use InepZend\View\View;
use InepZend\View\Renderer\Renderer;
use InepZend\Module\Application\Navigation\NavigationReadme;

class ReadmeController extends AbstractControllerServiceManager
{

    public function readmeAction()
    {
        $this->layout('layout/layout-clean');
        return new View(array_merge(self::getParamMenu(), array('strHtmlGrid' => $this->getService()->getHtmlGrid())));
    }

    public function ajaxGetContentFromReadmeAction()
    {
        Renderer::setExecuteFilter(false);
        return $this->getViewClearContent($this->getService()->getContentFromMarkdown(base64_decode($this->getParamsFromRoute('ds_path', $this->getPost('strPath')))));
    }
    
    public static function getParamMenu()
    {
        $arrParam = array(
            'strNameMenu' => NavigationReadme::NAME_MENU,
            'strClassNavigation' => 'InepZend\Module\Application\Navigation\NavigationReadme',
        );
        if (!self::isThemeAdministrativeResponsible())
            $arrParam = array_merge($arrParam, array(
                'booMenu' => true,
                'strClassMenuHelper' => 'InepZend\Theme\Administrative\View\Helper\MenuHelperWithoutSession',
            ));
        return $arrParam;
    }

}
