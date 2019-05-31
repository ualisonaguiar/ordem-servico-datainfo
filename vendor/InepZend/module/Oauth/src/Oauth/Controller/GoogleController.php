<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Exception\InvalidArgumentException;
use InepZend\Util\ApplicationProperties;

class GoogleController extends AbstractController
{
    
    public function __construct()
    {
        parent::setAdapter(str_replace(array(__NAMESPACE__, 'Controller', '\\'), '', __CLASS__));
    }

    /**
     * @auth no
     * @startOAuth yes
     */
    public function googlecodeAction()
    {
//        $this->setRouteIfHasAccessToken('inicial');
        $googleService = $this->getService('InepZend\Module\Oauth\Service\GoogleService');
        $googleService->callCode();
    }

    /**
     * @auth no
     */
    public function googlecallbackAction()
    {
        $this->headerHost();
        $googleService = $this->getService('InepZend\Module\Oauth\Service\GoogleService');
        $mixToken = $googleService->getToken();
        if (!empty($mixToken)) {
            $strRouteIfHasAccessToken = self::getRouteIfHasAccessToken(true);
            return (!empty($strRouteIfHasAccessToken)) ? $this->redirect()->toRoute($strRouteIfHasAccessToken) : $this->getViewClearContent($mixToken);
        }
        if (!empty($_GET['code'])) {
            $mixAccessToken = $googleService->callAccessToken($_GET['code']);
            if (($mixAccessToken !== false) && (!is_null($mixAccessToken))) {
                $strLastRoute = $googleService->getLastRouteFromSession(true);
                $googleService->setAccessTokenIntoOAuth($mixAccessToken, null, (empty($strLastRoute)));
                return $this->redirect()->toRoute($strLastRoute);
            } elseif (is_null($mixAccessToken)) {
                $this->getServiceMessage()->addMessageError('Usuário não realizou a inscrição para realizar a operação desejada!');
                return $this->redirect()->toRoute('application');
            }
            throw new InvalidArgumentException(sprintf('accessToken não conhecido em %s', get_class($this)));
        }
        throw new InvalidArgumentException(sprintf('Google code não informado em %s', get_class($this)));
    }
    
    private function headerHost()
    {
        if (stripos($_SERVER['PHP_SELF'], 'public/index.php') !== false) {
            $strHost = ApplicationProperties::getAutoloadConfigHost();
            if (!empty($strHost)) {
                header('Location: http://' . $strHost . '/googlecallback?' . $_SERVER['QUERY_STRING']);
                exit();
            }
        }
    }

}
