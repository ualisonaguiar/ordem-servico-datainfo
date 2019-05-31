<?php

namespace InepZend\View;

use InepZend\Util\ApplicationInfo;

trait ThemeTrait
{

    private static $strTheme;

    public static function getTheme($strType = null, $strLayout = null)
    {
        if (!empty($strType))
            return ApplicationInfo::getTheme($strType);
        $booGlobal = false;
        if (empty($strLayout)) {
            $strLayout = self::getThemeLayout();
            $booGlobal = true;
        }
        if ($booGlobal) {
            if (empty(self::$strTheme)) {
                $strTheme = ApplicationInfo::getThemeFromLayout($strLayout);
                self::$strTheme = $strTheme;
            } else
                $strTheme = self::$strTheme;
        } else
            $strTheme = ApplicationInfo::getThemeFromLayout($strLayout);
        return $strTheme;
    }

    public static function getThemeLayout()
    {
        return @$GLOBALS['module_theme_layout'];
    }

    public static function getThemeColor()
    {
        return @$GLOBALS['module_theme_color'];
    }

    public static function getThemeOption($strOption = null)
    {
        $arrOption = @$GLOBALS['module_theme_option'];
        if ((!empty($strOption)) && (is_array($arrOption)))
            return (array_key_exists($strOption, $arrOption)) ? $arrOption[$strOption] : null;
        return $arrOption;
    }
    
    public static function isThemeAdministrativeResponsible()
    {
        return (self::getTheme() == 'AdministrativeResponsible');
    }

}
