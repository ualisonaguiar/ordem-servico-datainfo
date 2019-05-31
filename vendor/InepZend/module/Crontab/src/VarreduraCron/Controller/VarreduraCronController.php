<?php

namespace InepZend\Module\Crontab\VarreduraCron\Controller;

use InepZend\Controller\AbstractControllerServiceManager;
use InepZend\View\Model\Json;
use InepZend\Dto\ResultDto;
use Exception as ExceptionNative;

class VarreduraCronController extends AbstractControllerServiceManager
{

    /**
     * @auth no
     */
    public function indexAction()
    {
        try {
            $arrResult = $this->getService()->runCron();
        } catch (ExceptionNative $exception) {
            $arrResult = self::getResult(ResultDto::STATUS_ERROR, $exception->getMessage());
        }
        return new Json($arrResult);
    }

}
