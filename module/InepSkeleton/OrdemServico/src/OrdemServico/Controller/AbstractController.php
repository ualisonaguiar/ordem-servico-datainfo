<?php

namespace OrdemServico\Controller;

use InepZend\Controller\AbstractControllerAngular;
use OrdemServico\Navigation\NavigationOrdemServico;
use OrdemServico\Message\Message;
use InepZend\Exception\Exception;

abstract class AbstractController extends AbstractControllerAngular
{
    use Message;

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, array_merge(
                array('strNameMenu' => NavigationOrdemServico::NAME_MENU, 'strClassNavigation' => 'OrdemServico\Navigation\NavigationOrdemServico'),
                (!empty($arrVariableMerge)) ? $arrVariableMerge : array())
        );
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $event)
    {
        try {
            $this->getService('OrdemServico\Service\UsuarioFile')->hasUserBanco();
            $this->getService('OrdemServico\Service\UsuarioFile')->hasUserAtivo();
            return parent::onDispatch($event);
        } catch (Exception $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute('logoff');
        }
    }
}
