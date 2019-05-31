<?php

namespace InepZend\Module\Executor\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Util\Server;

class Email extends AbstractHelper
{
    public function renderHeaderMail()
    {
        if (!$this->getService('InepZend\Module\Executor\Service\Usuario')->hasAdministrador())
            return '';
        $strUrl = Server::getHost(true). 'envio-operacao';
        $intCount = $this->getService('InepZend\Module\Executor\Service\EmailHistoricoQuery')->getCountQueryEmail();
        return '
            <div class="breadcrumb pull-right send-email-query">
                <a href="' . $strUrl .'"><i class="fa fa-envelope-o fa-2x" style="color: ' . (($intCount) ? '#d64931' : '#888') .'"></i></a>
                <span class="label btnDefault btn btn-info badge" title="Quantidade de Operação a ser envida.">' . $intCount .'</span>
            </div>';
    }
}
