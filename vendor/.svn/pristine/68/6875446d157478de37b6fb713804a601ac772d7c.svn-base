<?php

namespace InepZend\Session;

use Zend\Session\Container;
use Zend\Session\ManagerInterface as Manager;
use InepZend\Util\ApplicationInfo;

class Session extends Container
{

    public function __construct($strName = null, Manager $manager = null)
    {
        parent::__construct(self::getSessionName($strName), $manager);
    }

    public function destroyFromName($strName = null)
    {
        return self::unsetSessionKey($strName);
    }

    public static function unsetSessionKey($strName = null)
    {
        if (empty($strName))
            $strName = ApplicationInfo::getNameEdited();
        foreach ((array) $_SESSION as $strKey => $mixValue) {
            if (strpos($strKey, $strName) === 0)
                unset($_SESSION[$strKey]);
        }
        return true;
    }

    public static function getSessionName($strName = null, $booConcatNameEdited = true)
    {
        return (($booConcatNameEdited) ? ApplicationInfo::getNameEdited() : '') . ((empty($strName)) ? 'Default' : $strName);
    }

}
