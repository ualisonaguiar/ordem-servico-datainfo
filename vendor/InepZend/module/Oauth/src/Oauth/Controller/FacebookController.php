<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Exception\InvalidArgumentException;

class FacebookController extends AbstractController
{
    
    public function __construct()
    {
        parent::setAdapter(str_replace(array(__NAMESPACE__, 'Controller', '\\'), '', __CLASS__));
    }

    /**
     * @auth no
     * @startOAuth yes
     */
    public function facebookcodeAction()
    {
//        $this->setRouteIfHasAccessToken('inicial');
        $facebookService = $this->getService('InepZend\Module\Oauth\Service\FacebookService');
        $facebookService->callCode();
    }

    /**
     * @auth no
     */
    public function facebookcallbackAction()
    {
        $facebookService = $this->getService('InepZend\Module\Oauth\Service\FacebookService');
        $mixToken = $facebookService->getToken();
        if (!empty($mixToken)) {
            $strRouteIfHasAccessToken = self::getRouteIfHasAccessToken(true);
            return (!empty($strRouteIfHasAccessToken)) ? $this->redirect()->toRoute($strRouteIfHasAccessToken) : $this->getViewClearContent($mixToken);
        }
        if (!empty($_GET['code'])) {
            $mixAccessToken = $facebookService->callAccessToken($_GET['code']);
            if (($mixAccessToken !== false) && (!is_null($mixAccessToken))) {
                $strLastRoute = $facebookService->getLastRouteFromSession(true);
                $facebookService->setAccessTokenIntoOAuth($mixAccessToken, null, (empty($strLastRoute)));
                return $this->redirect()->toRoute($strLastRoute);
            } elseif (is_null($mixAccessToken)) {
                $this->getServiceMessage()->addMessageError('Usuário não realizou a inscrição para realizar a operação desejada!');
                return $this->redirect()->toRoute('application');
            }
            throw new InvalidArgumentException(sprintf('accessToken não conhecido em %s', get_class($this)));
        }
        throw new InvalidArgumentException(sprintf('Facebook code não informado em %s', get_class($this)));
    }

}
