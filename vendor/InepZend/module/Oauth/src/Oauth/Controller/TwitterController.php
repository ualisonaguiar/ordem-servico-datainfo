<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Exception\InvalidArgumentException;

class TwitterController extends AbstractController
{

    public function __construct()
    {
        parent::setAdapter(str_replace(array(__NAMESPACE__, 'Controller', '\\'), '', __CLASS__));
    }

    /**
     * @auth no
     * @startOAuth yes
     */
    public function twitterrequesttokenAction()
    {
//        $this->setRouteIfHasAccessToken('inicial');
        $twitterService = $this->getService('InepZend\Module\Oauth\Service\TwitterService');
        $twitterService->callRequestToken();
    }

    /**
     * @auth no
     */
    public function twittercallbackAction()
    {
        $twitterService = $this->getService('InepZend\Module\Oauth\Service\TwitterService');
        $mixToken = $twitterService->getToken();
        if (!empty($mixToken)) {
            $strRouteIfHasAccessToken = self::getRouteIfHasAccessToken(true);
            return (!empty($strRouteIfHasAccessToken)) ? $this->redirect()->toRoute($strRouteIfHasAccessToken) : $this->getViewClearContent($mixToken);
        }
        $mixAccessToken = $twitterService->callAccessToken();
        if (($mixAccessToken !== false) && (!is_null($mixAccessToken))) {
            $twitterService->setAccessTokenIntoSession($mixAccessToken);
            $twitterService->setAccessTokenIntoOAuth($mixAccessToken);
            $strLastRoute = $twitterService->getLastRouteFromSession(true);
            return $this->redirect()->toRoute((empty($strLastRoute)) ? str_replace('Action', '', __FUNCTION__) : $strLastRoute);
        } elseif (is_null($mixAccessToken)) {
            $this->getServiceMessage()->addMessageError('Usuário não realizou a inscrição para realizar a operação desejada!');
            return $this->redirect()->toRoute('application');
        }
        throw new InvalidArgumentException(sprintf('accessToken não conhecido em %s', get_class($this)));
    }

}
