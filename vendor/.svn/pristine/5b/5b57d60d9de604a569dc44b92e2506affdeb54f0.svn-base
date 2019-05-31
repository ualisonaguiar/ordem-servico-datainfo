<?php

namespace InepZend\View\Model;

use Zend\View\Model\ViewModel;
use InepZend\ModuleConfig\ModuleConfig;

class View extends ViewModel
{

    public function __construct($mixVariable = null, $mixOption = null)
    {
        self::setGlobalsInfo($mixVariable, $mixOption);
        return parent::__construct($mixVariable, $mixOption);
    }

    private static function setGlobalsInfo($mixVariable = null, $mixOption = null)
    {
        $GLOBALS['module'] = ModuleConfig::getModuleFromTrace(true);
        $GLOBALS['view_variable'] = $mixVariable;
        $GLOBALS['view_option'] = $mixOption;
        return true;
    }

}
