<?php

namespace InepZend\ModuleConfig;

trait ModuleTrait
{

    private static $arrClassExists = array();

    public static function getController($event)
    {
        if (!is_object($event))
            return false;
        $strController = $event->getRouteMatch()->getParam('controller');
        if (strpos(end($arrExplode = explode('\\Controller\\', $strController)), 'Controller') === false)
            $strController .= 'Controller';
        if (!array_key_exists($strController, self::$arrClassExists))
            self::$arrClassExists[$strController] = class_exists($strController);
        if (!self::$arrClassExists[$strController]) {
            $strTarget = get_class($event->getTarget());
            if (strpos($strTarget, 'Controller') !== false)
                $strController = $strTarget;
        }
        return $strController;
    }

    public static function getAction($event)
    {
        if (!is_object($event))
            return false;
        $strAction = $event->getRouteMatch()->getParam('action');
        if (strpos($strAction, 'Action') === false)
            $strAction .= 'Action';
        return $strAction;
    }

    private static function checkEvent($event, $booCheckApplication = false)
    {
        $booResult = is_object($event);
        if (($booResult) && ($booCheckApplication))
            $booResult = is_object($event->getApplication());
        return $booResult;
    }

}
