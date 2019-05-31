<?php

namespace OrdemServico\Controller;

use InepZend\Controller\AbstractController;

class BackupController extends AbstractController
{
    /**
     * @auth no
     */
    public function indexAction()
    {
        $arrUserPassword = explode('||', base64_decode($this->getParamsFromRoute('usernamePassword')));
        $this->getService()->initDataBase($arrUserPassword[0], $arrUserPassword[1]);
        return $this->getViewClearContent();
    }

}