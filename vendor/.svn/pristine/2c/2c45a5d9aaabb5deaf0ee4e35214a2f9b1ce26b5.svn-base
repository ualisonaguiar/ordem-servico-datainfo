<?php

namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\Exception\Exception;
use InepZend\View\Model\Json;
use InepZend\View\View;

class LayoutFileController extends AbstractCrudController
{
    public function __construct()
    {
        $this->arrMethodPk = array('ID_LAYOUT');
        $this->arrMethodPaging = array('NO_LAYOUT', 'NO_EVENTO', array('IN_STATUS_LAYOUT', 'text', array(), 'InepZend\Util\Format::convertToStatus'));
        $this->strService = 'InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile';
    }    

    public function indexAction()
    {

        $form = $this->getForm();
        $form->prepareElementsFindLayout();
        return new View(array('form' => $form));
    }

    public function addAction()
    {
        try {            
            return $this->controlAfterSubmit($this->getForm()->prepareElementsLayoutAdd(), $this->prepareRequest(false, $this->getPost()), 'add', 'InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile', 'layoutfile');
        } catch (Exception $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute('layoutfile');
        }        
    }
    
    public function ajaxPaginatorAction()
    {
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
        if (is_numeric(@$arrCriteria['id_layout']))
            $arrCriteria['id_layout'] = (integer) $arrCriteria['id_layout'];
        if (is_numeric(@$arrCriteria['co_evento']))
            $arrCriteria['co_evento'] = (integer) $arrCriteria['co_evento'];
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile', null, null, 10, true, $arrCriteria);
    }

    public function ajaxStatusAction()
    {
        try {
            $arrLayoutFile = $this->getService()->getLayoutFile($this->getPost());
            $this->getService()->status($arrLayoutFile);
            return (new Json(array('status' => true, 'message' => 'Layout alterado com sucesso.')));
        } catch (Exception $exception) {
            return (new Json(array('status' => false, 'message' => $exception . getMessage())));
        }
    }
}
