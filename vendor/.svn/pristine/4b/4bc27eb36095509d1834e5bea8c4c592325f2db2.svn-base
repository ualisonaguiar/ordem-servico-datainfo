<?php

namespace InepZend\Theme\Administrative\View\Helper;

use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\Navigation\Navigation;

class HtmlHeadHelper extends AbstractHtmlHeadHelper
{

    public function link()
    {
        $arrPrependStylesheet = array(
            '/vendor/InepZend/theme/administrative/css/style.css',
            '/vendor/InepZend/css/style-form.css',
//            '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/css/ddsmoothmenu.css',
//            '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/css/ddsmoothmenu-v.css',
        );
        return parent::link($arrPrependStylesheet);
    }

//    public function script()
//    {
//        $arrPrependFile = array(
//            '/vendor/ddsmoothmenu/ddsmoothmenu-2.0/js/inep-zend.js',
//        );
//        return parent::script($arrPrependFile);
//    }

    public function render($booMenu = true, $booEchoResult = true)
    {
        $strNameMenu = @$GLOBALS['view_variable']['strNameMenu'];
        if (empty($strNameMenu))
            $strNameMenu = Navigation::NAME_MENU_AUTHENTICATED;
        $strClassNavigation = @$GLOBALS['view_variable']['strClassNavigation'];
        if (empty($strClassNavigation))
            $strClassNavigation = 'InepZend\Navigation\Navigation';
        $arrHtmlHead = parent::render($booMenu, $booEchoResult, null, $strNameMenu, $strClassNavigation);
        $mixDivMenu = (array_key_exists('mixDivMenu', $arrHtmlHead[1])) ? $arrHtmlHead[1]['mixDivMenu'] : null;
        $strMenuOrientation = null;
        $strContainerWidth = null;
        if ($booMenu) {
            $strContainerWidth = ' width: 100%; ';
            if (!empty($mixDivMenu)) {
                $strMenuOrientation = MenuHelper::getMenuOrientation();
                if (!is_array($mixDivMenu)) {
                    if ($strMenuOrientation != MenuHelper::MENU_TYPE_HORIZONTAL)
                        $strContainerWidth = ' width: 75%; ';
                } else
                    $strContainerWidth = ' width: 75%; ';
            }
        }
        if (!empty($strMenuOrientation))
            $arrHtmlHead[1]['strMenuOrientation'] = $strMenuOrientation;
        if (!empty($strContainerWidth))
            $arrHtmlHead[1]['strContainerWidth'] = $strContainerWidth;
        return $arrHtmlHead;
    }

}
