<?php

namespace InepZend\Module\Corporative\Controller;

use InepZend\Controller\AbstractController;

class ProjetoEventoController extends AbstractController
{

    public function indexAction()
    {
        
    }
    
    public function ajaxGetListEventAction()
    {
        return parent::ajaxFetchPairsAction($this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairsToXmlJson(array('coProjeto' => $this->params()->fromPost('co_projeto', 0)), 'getCoEvento', 'getNoEvento'));
    }
    
    public function ajaxGetListEventDataAction()
    {
        return parent::ajaxFetchPairsAction($this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairsToXmlJson(array('coProjeto' => $this->params()->fromPost('co_projeto', 0)), 'getCoEvento', 'getNomeEventoDataInicioFim'));
    }

}
