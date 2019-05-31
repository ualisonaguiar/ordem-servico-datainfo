<?php
namespace InepZend\Authentication;

use InepZend\Authentication\AuthService;

trait AuthTrait
{

    public $authService;

    public function getAuthService()
    {
        if (! is_object($this->authService))
            $this->authService = AuthService::getConsultInstance();
        return $this->authService;
    }

    public function getIdentity()
    {
        return ($this->hasIdentity()) ? $this->getAuthService()->getIdentity() : null;
    }

    public function hasIdentity()
    {
        return $this->getAuthService()->hasIdentity();
    }

    public function clearIdentity()
    {
        return $this->getAuthService()->clearIdentity();
    }

    public function getUserSystem()
    {
        return $this->getAuthService()->getUserSystem();
    }

    public function getSystem()
    {
        return $this->getAuthService()->getSystem();
    }

    public function getProfile()
    {
        return $this->getAuthService()->getProfile();
    }

    public function getUser()
    {
        return $this->getAuthService()->getUser();
    }
}
