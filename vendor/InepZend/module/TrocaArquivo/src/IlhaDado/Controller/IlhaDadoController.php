<?php
namespace InepZend\Module\TrocaArquivo\IlhaDado\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;

class IlhaDadoController extends AbstractCrudController
{

    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->arrPk = array(
            'id_ilha_dado'
        );
        $this->arrMethodPk = array(
            'getIdIlhaDado'
        );
        $this->arrMethodPaging = array(
            'getNoIlhaDado',
            'getInCacheText'
        );
    }

    public function indexAction()
    {
        return new View(array(
            'form' => $this->getForm()->prepareElementsFilter()
        ));
    }

    public function ajaxPaginatorAction()
    {
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile', null, null, 10, true, $this->getInfoAjaxPaginator('arrCriteria'));
    }

    public function addAction()
    {
        return parent::addAction($this->getForm()->prepareElements(), null, 'InepZend\Module\TrocaArquivo\Common\Entity\IlhaDado', null, 'InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile');
    }

    public function editAction()
    {
        return parent::editAction($this->getForm()->prepareElements(), null, 'InepZend\Module\TrocaArquivo\Common\Entity\IlhaDado', null, 'InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile');
    }
}
