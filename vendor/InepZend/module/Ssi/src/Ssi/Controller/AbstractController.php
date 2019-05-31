<?php

namespace InepZend\Module\Ssi\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;
use InepZend\View\Renderer\Renderer;
use InepZend\Module\Application\Controller\ReadmeController;
use InepZend\Paginator\Paginator;
use \Exception as ExceptionNative;
use InepZend\Util\FileSystem;

abstract class AbstractController extends AbstractCrudController
{

    /**
     * 
     * @param string $strForm
     * @param string $strMethodService
     * @param boolean $booExecuteFilterRenderer
     * @param boolean $booDsTree
     * @param boolean $booFormModal
     * @return object
     * @throws ExceptionNative
     * 
     * @resource RSRC_SSI_MENU_ACL
     */
    public function indexAction($strForm = null, $strMethodService = null, $booExecuteFilterRenderer = null, $booDsTree = null, $booFormModal = null)
    {
        $arrData = (array) $this->getDataToForm();
        if (!$this->isPost())
            $arrTree = $this->getService()->getTree();
        else
            $arrTree = $this->getService()->convertPostToTree($arrData);
        if (empty($strForm))
            $strForm = $this->getAttributeValue($strService, 'strForm');
        $form = $this->getForm($strForm);
        if (!is_bool($booFormModal))
            $booFormModal = false;
        if ($booFormModal) {
            $formModal = clone $form;
            $form->prepareElements($arrTree);
            $formModal->prepareElementsModal();
        } else
            $form->prepareElements($arrTree);
        if (!is_bool($booDsTree))
            $booDsTree = true;
        if ($booDsTree)
            $arrData['ds_tree'] = $this->getService()->convertTreeToFormat($arrTree, $this->getPost());
        unset($arrData['ds_module']);
        if (count($arrData) != 0)
            $form->setData($arrData);
        if ($this->isPost()) {
            if ($form->isValid()) {
                try {
                    if (empty($strMethodService))
                        $strMethodService = 'saveData';
                    $this->getService()->$strMethodService($form->getData());
                    $this->getServiceMessage()->addMessageSuccess(self::CONST_MESSAGE_SUCCESS);
                } catch (ExceptionNative $exception) {
                    throw $exception;
                }
            } else
                $this->getServiceMessage()->addMessageValidate(self::CONST_MESSAGE_VALIDATE, $form);
        }
        $arrViewParam = array('form' => $form);
        if (isset($formModal))
            $arrViewParam['formModal'] = $formModal;
        return $this->returnView($arrViewParam, $booExecuteFilterRenderer);
    }

    /**
     * 
     * @return object
     * 
     * @resource RSRC_SSI_MENU_ACL
     */
    public function showAction()
    {
        return $this->returnView(array('form' => $this->getForm($this->strForm)->prepareElementsShow()));
    }

    public function ajaxRenderTreeAction()
    {
        return $this->getViewClearContent($this->getService()->renderTree($this->getService()->getTree($this->getPost()), $this->getPost(), 0, false));
    }

    public function ajaxHistoryPaginatorAction($strService = null)
    {
        return parent::ajaxPaginatorAction(null, $this->getAttributeValue($strService, 'strService'), array('no_file', array('ds_path', Paginator::TYPE_LINK_DATA), 'ds_size', 'dt_create'), array('ds_path'), null, true, null, 'findByPagedHistory');
    }

    public function ajaxRenderFormAction()
    {
        return $this->getViewClearContent($this->getService()->renderForm($this->getService()->getTree($this->getPost()), $this->getPost()));
    }

    protected function returnView($arrViewParam = null, $booExecuteFilterRenderer = null)
    {
        if (!is_bool($booExecuteFilterRenderer))
            $booExecuteFilterRenderer = true;
        if ($booExecuteFilterRenderer)
            Renderer::setExecuteFilter(false);
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), (array) $arrViewParam));
    }

    protected function downloadXmlInformationSsi($strTypeFile)
    {
        FileSystem::downloadContent('importacao_' . $strTypeFile . '_' . date('d_m_Y') . '.xml', $this->getService()->exportInformationSsi(base64_decode($this->getParamsFromRoute('path')), $strTypeFile), 'application/xml');
    }

}
