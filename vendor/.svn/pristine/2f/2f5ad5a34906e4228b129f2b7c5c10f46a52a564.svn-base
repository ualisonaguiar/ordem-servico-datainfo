<?php

namespace InepZend\View\Helper;

use Zend\Form\View\Helper\AbstractHelper as ZendAbstractHelper;
use InepZend\Http\RequestTrait;
use InepZend\Permission\PermissionTrait;
use InepZend\Service\ServiceManagerTrait;
use InepZend\Util\AttributeStaticTrait;
use InepZend\View\ThemeTrait;
use InepZend\Util\DebugExec;

abstract class AbstractHelper extends ZendAbstractHelper
{

    use RequestTrait,
        PermissionTrait,
        ServiceManagerTrait,
        AttributeStaticTrait,
        ThemeTrait,
        DebugExec;
    
    const DEBUG = false;

    public function __construct($serviceLocator = null)
    {
        if (is_object($serviceLocator))
            self::setServiceManager($serviceLocator);
    }

}
