<?php

namespace InepZend\Module\Oauth\Controller;

use InepZend\Controller\AbstractController as InepZendAbstractController;

abstract class AbstractController extends InepZendAbstractController
{

    private $strAdapter;

    public function getAdapter()
    {
        return $this->strAdapter;
    }

    protected function setAdapter($strAdapter)
    {
        $this->strAdapter = $strAdapter;
        return $this;
    }

    public function getRouteIfHasAccessToken($booClear = false)
    {
        $session = $this->getSession();
        $strRouteIfHasAccessToken = $session->offsetGet('route_if_has_access_token');
        if ($booClear === true)
            $this->cleanRouteIfHasAccessToken();
        return $strRouteIfHasAccessToken;
    }

    public function setRouteIfHasAccessToken($strRouteIfHasAccessToken)
    {
        $session = $this->getSession();
        return $session->offsetSet('route_if_has_access_token', $strRouteIfHasAccessToken);
    }

    public function cleanRouteIfHasAccessToken()
    {
        $session = $this->getSession();
        return $session->offsetUnset('route_if_has_access_token');
    }

    private function getSession()
    {
        return self::getSessionInstance($this->getAdapter() . 'Controller');
    }

}
