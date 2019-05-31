<?php

namespace InepZend\Module\UnitTest\Controller;

trait ControllerTrait
{

    public static $strDispatchResult;

    public function indexAction()
    {
        $mixResult = '';
        $strEval = $this->getPost('eval');
        if (!empty($strEval)) {
            ob_start();
            eval($strEval);
            $mixResult = ob_get_clean();
        }
        self::setDispatchResult($mixResult);
        return $this->getViewClearContent();
    }

    public static function getDispatchResult()
    {
        return self::$strDispatchResult;
    }

    private static function setDispatchResult($strResult = null)
    {
        return (self::$strDispatchResult = $strResult);
    }

}
