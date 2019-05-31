<?php

namespace InepZend\Module\Log\Controller;

use InepZend\Controller\AbstractControllerServiceManager;

/**
 * Classe responsavel pelo envio de e-mail contendo informacao de log de erro gerado
 * pela aplicacao
 *
 * @package Log
 */
class LogCronController extends AbstractControllerServiceManager
{

    /**
     * @auth no
     */
    public function checkLogAction()
    {
        $this->getService('InepZend\Module\Log\Service\LogCron')->checkLogExistingDateYesterday();
        return $this->getViewClearContent();
    }
}
