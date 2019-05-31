<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Module\Oauth\Controller\AbstractController;
use InepZend\Exception\InvalidArgumentException;
use InepZend\Util\Server;

class SsiController extends AbstractController
{

    public function __construct()
    {
        parent::setAdapter(str_replace(array(__NAMESPACE__, 'Controller', '\\'), '', __CLASS__));
    }

    /**
     * @auth no
     * @startOAuth yes
     */
    public function ssirequesttokenAction()
    {
//        $this->setRouteIfHasAccessToken('inicial');
        $ssiService = $this->getService('InepZend\Module\Oauth\Service\SsiService');
        $ssiService->callRequestToken();
    }

    /**
     * @auth no
     */
    public function ssicallbackAction()
    {
        $ssiService = $this->getService('InepZend\Module\Oauth\Service\SsiService');
        $mixToken = $ssiService->getToken();
        if (!empty($mixToken)) {
            $strRouteIfHasAccessToken = self::getRouteIfHasAccessToken(true);
            return (!empty($strRouteIfHasAccessToken)) ? $this->redirect()->toRoute($strRouteIfHasAccessToken) : $this->getViewClearContent($mixToken);
        }
        $mixAccessToken = $ssiService->callAccessToken();
        if (($mixAccessToken !== false) && (!is_null($mixAccessToken))) {
            $ssiService->setAccessTokenIntoSession($mixAccessToken);
            $ssiService->setAccessTokenIntoOAuth($mixAccessToken);
            $strLastRoute = $ssiService->getLastRouteFromSession(true);
//            return $this->redirect()->toRoute((empty($strLastRoute)) ? str_replace('Action', '', __FUNCTION__) : $strLastRoute);
            return $this->redirect()->toUrl(Server::getHost(true, true) . (($strLastRoute == '/') ? '' : $strLastRoute));
        } elseif (is_null($mixAccessToken)) {
            $this->getServiceMessage()->addMessageError('Usuário não realizou a inscrição para realizar a operação desejada!');
            return $this->redirect()->toRoute('application');
        }
        throw new InvalidArgumentException(sprintf('accessToken não conhecido em %s', get_class($this)));
    }

}
