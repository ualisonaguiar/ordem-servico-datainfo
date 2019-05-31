<?php

namespace InepZend\Module\Executor\Controller;

use Zend\Mvc\MvcEvent;
use InepZend\Module\Executor\Navigation\Navigation;
use InepZend\Module\Application\Controller\ReadmeController;

trait SecurityAcl
{
    /**
     * Verifica se o usuario e administrador.
     *
     * @param MvcEvent $event
     * @return mix
     */
    protected function hasAccessAdministrador(MvcEvent $event)
    {
        if (!$this->getService('InepZend\Module\Executor\Service\Usuario')->hasAdministrador()) {
            $this->getServiceMessage()->addMessageError($this->strMsgError01);
            return $this->redirect()->toRoute('logoff');
        }
        return parent::onDispatch($event);
    }

    /**
     * Verificar se o usuario possui cadastro no sistema.
     *
     * @param MvcEvent $event
     * @return mix
     */
    protected function hasUserAccessSystem(MvcEvent $event)
    {
        if (!$this->getService('InepZend\Module\Executor\Service\Usuario')->hasAccessSystem()) {
            $this->getServiceMessage()->addMessageError($this->strMsgError01);
            return $this->redirect()->toRoute('logoff');
        }
        return parent::onDispatch($event);
    }

    /**
     * Verificar se o usuario logado tem perfil de administrador.
     *
     * @return mix
     */
    protected function accessFunctionalityAdministrador()
    {
        if (!$this->getService('InepZend\Module\Executor\Service\Usuario')->hasAdministrador())
            return $this->redirect()->toRoute('inicial');
    }

    /**
     * Funcionalidade responsavel por montar o navigation.
     *
     * @return array
     */
    public static function getParamMenu()
    {
        return ReadmeController::getParamMenu();
    }
}
