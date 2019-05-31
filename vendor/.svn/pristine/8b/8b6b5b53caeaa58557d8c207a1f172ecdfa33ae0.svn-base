<?php

namespace InepZend\ModuleConfig;

use InepZend\Util\Reflection;
use InepZend\Theme\Administrative\View\Helper\MenuHelper;

class ModuleMenu
{

    use ModuleTrait;

    public function preDispatch($event)
    {
        if ((is_array($arrAnnotation = Reflection::listAnnotationsFromMethod(self::getController($event), self::getAction($event)))) && (array_key_exists('MENU_NAME', $arrAnnotation))) {
            MenuHelper::setMenuName($arrAnnotation['MENU_NAME']);
            if (array_key_exists('MENU_VERSION', $arrAnnotation))
                MenuHelper::setMenuVersion($arrAnnotation['MENU_VERSION']);
        }
    }

}
