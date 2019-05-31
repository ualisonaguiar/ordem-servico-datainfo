<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Exception\InvalidArgumentException;

class InstagramController extends AbstractController
{
    
    public function __construct()
    {
        parent::setAdapter(str_replace(array(__NAMESPACE__, 'Controller', '\\'), '', __CLASS__));
    }

    /**
     * @auth no
     * @startOAuth yes
     */
    public function instagramcodeAction()
    {
//        $this->setRouteIfHasAccessToken('inicial');
        $instagramService = $this->getService('InepZend\Module\Oauth\Service\InstagramService');
        $instagramService->callCode();
    }

    /**
     * @auth no
     */
    public function instagramcallbackAction()
    {
        $instagramService = $this->getService('InepZend\Module\Oauth\Service\InstagramService');
        $mixToken = $instagramService->getToken();
        if (!empty($mixToken)) {
            $strRouteIfHasAccessToken = self::getRouteIfHasAccessToken(true);
            return (!empty($strRouteIfHasAccessToken)) ? $this->redirect()->toRoute($strRouteIfHasAccessToken) : $this->getViewClearContent($mixToken);
        }
        if (!empty($_GET['code'])) {
            $mixAccessToken = $instagramService->callAccessToken($_GET['code']);
            if (($mixAccessToken !== false) && (!is_null($mixAccessToken))) {
                $strLastRoute = $instagramService->getLastRouteFromSession(true);
                $instagramService->setAccessTokenIntoOAuth($mixAccessToken, null, (empty($strLastRoute)));
                return $this->redirect()->toRoute($strLastRoute);
            } elseif (is_null($mixAccessToken)) {
                $this->getServiceMessage()->addMessageError('Usuário não realizou a inscrição para realizar a operação desejada!');
                return $this->redirect()->toRoute('application');
            }
            throw new InvalidArgumentException(sprintf('accessToken não conhecido em %s', get_class($this)));
        }
        throw new InvalidArgumentException(sprintf('Instagram code não informado em %s', get_class($this)));
    }

}
