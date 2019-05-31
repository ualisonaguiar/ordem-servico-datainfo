<?php

namespace InepZend\Module\Executor\Controller;

use InepZend\Controller\AbstractCrudController;
use Zend\Mvc\MvcEvent;

class UsuarioController extends AbstractCrudController
{
    use SecurityAcl;

    public function onDispatch(MvcEvent $event)
    {
        return $this->hasAccessAdministrador($event);
    }

    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->arrMethodPaging = array('DS_LOGIN', 'IN_ATIVO', 'IN_PRODUCT_OWNER');
        $this->arrMethodPk = array('ID_USUARIO');
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function indexAction()
    {
        $form = $this->getForm();
        $form->prepareElementSearch();
        return $this->controlAfterSubmit($form, array(), null, null, null, self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function addAction()
    {
        $form = $this->getForm();
        $form->prepareElementManter('Adicionar Usuario');
        $arrDataUser = [];
        if ($this->isPost()) {
            $arrDataUser = $this->getPost(null, null, null, true);
        }
        return $this->controlAfterSubmit($form, $arrDataUser, 'insert', $this->strService, 'usuario', self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function editAction()
    {
        $form = $this->getForm();
        $form->prepareElementManter('Editar Usuario', true);
        if ($this->isPost()) {
            $arrDataUser = $this->getPost(null, null, null, true);
        } else {
            $arrDataUser = $this->getService()->find(
                (int) $this->getParamsFromRoute('idUsuario')
            )->toArray();
        }
        return $this->controlAfterSubmit($form, $arrDataUser, 'update', $this->strService, 'usuario', self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function ajaxChangeSituationAction()
    {
        $arrResult = $this->getService()->changeSituation($this->getPost()['idUsuario']);
        return $this->getViewClearContent(json_encode($arrResult));
    }
}
