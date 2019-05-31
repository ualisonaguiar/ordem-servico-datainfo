<?php

namespace InepZend\Module\TrocaArquivo\ResponsavelEnvio\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;

class ResponsavelEnvioController extends AbstractCrudController
{

    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->arrPk = array('id_responsavel');
        $this->arrMethodPk = array('getIdResponsavel');
        $this->arrMethodPaging = array(array('getIdUsuarioSistema', 'text', array(), array('\InepZend\Module\Ssi\Service\VwUsuario::getNameFromIdUsuarioSistema')), array('getCoProjeto', 'text', array(), array('\InepZend\Module\Corporative\Service\VwProjeto::getNameFromCoProjeto')), 'getSgUf');
    }

    public function indexAction()
    {
        return new View(array('form' => $this->getFormPreprared('prepareElementsFilter')));
    }

    public function ajaxPaginatorAction()
    {
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile', null, null, 10, true, $this->getInfoAjaxPaginator('arrCriteria'));
    }

    public function addAction()
    {
        return parent::addAction($this->getFormPreprared(), null, 'InepZend\Module\TrocaArquivo\Common\Entity\Responsavel', null, 'InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile');
    }

    public function editAction()
    {
        return parent::editAction($this->getFormPreprared(), null, 'InepZend\Module\TrocaArquivo\Common\Entity\Responsavel', null, 'InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile');
    }

    public function deleteAction()
    {
        return parent::deleteAction(null, null, null, array(), 'InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile');
    }

}
