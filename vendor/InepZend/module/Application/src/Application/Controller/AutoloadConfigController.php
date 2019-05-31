<?php

namespace InepZend\Module\Application\Controller;

use InepZend\Controller\AbstractControllerPaginator;
use InepZend\Controller\AbstractCrudController;
use InepZend\Module\Application\Controller\ReadmeController;
use InepZend\View\View;
use InepZend\View\Renderer\Renderer;
use InepZend\Paginator\Paginator;
use InepZend\Util\FileSystem;

class AutoloadConfigController extends AbstractControllerPaginator
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->strService = 'InepZend\Module\Application\Service\AutoloadConfig';
        $this->strForm = 'InepZend\Module\Application\Form\AutoloadConfig';
        $this->arrMethodPk = array('ds_path');
        $this->arrMethodPaging = array(
            array(
                'no_file',
                Paginator::TYPE_ROUTE,
                array(
                    'route' => 'application/autoload-config/download',
                    'param' => 'ds_path'
                )
            )
        );
    }

    /**
     *
     * @resource RSRC_AUTOLOADCONFIG_INDEX
     * @return \InepZend\View\View
     */
    public function indexAction()
    {
        $form = $this->getForm();
        $form->prepareElementsFilter();
        if ($this->isPost()) {
            $this->prepareRequest();
            $arrData = array_merge($this->getPost(), $this->getFiles());
            $form->setData($arrData);
            if ($form->isValid()) {
                $this->getService()->insertContentAutoloadConfig($form->getData());
                $this->getServiceMessage()->addMessageSuccess('Arquivo salvo com sucesso.');
            } else
                $this->getServiceMessage()->addMessageValidate(AbstractCrudController::CONST_MESSAGE_VALIDATE, $form);
        } else
            $arrData = $this->getService()->getContentAutoloadConfig(true);
        if (count($arrData) != 0)
            $form->setData($this->prepareRequest(true, $arrData));
        Renderer::setExecuteFilter(false);
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('form' => $form)));
    }

    /**
     *
     * @return type
     */
    public function downloadAction()
    {
        $strDsPath = $this->getParamsFromRoute('ds_path');
        if (empty($strDsPath))
            return $this->redirect()->toRoute('aplication-autoload-config');
        $strPathFile = base64_decode($strDsPath);
        FileSystem::downloadContent(str_replace('.php', '.txt', end($arrExplode = explode('/', $strPathFile))), FileSystem::getContentFromFile($strPathFile));
        return $this->getViewClearContent();
    }

}
