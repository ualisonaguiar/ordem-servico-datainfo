<?php

namespace InepZend\Module\TrocaArquivo\ConfigEnvio\Controller;

use InepZend\Controller\AbstractControllerForm;
use InepZend\View\Model\Json;
use InepZend\View\View;

class ConfigEnvioController extends AbstractControllerForm
{

    public function __construct()
    {
        $this->arrPk = array('id_configuracao');
        $this->arrMethodPk = array('getIdConfiguracao');
    }
    
    public function indexAction()
    {
        return new View();
    }

    public function addAction()
    {
        return new View(['form' => $this->getForm()->prepareElementsConfigEnvio($this->getParamsFromRoute()['id_layout'])]);
    }

    public function ajaxAddAction()
    {
        try {
            $this->getService('InepZend\Module\TrocaArquivo\ConfigEnvio\Service\ConfigEnvio')->save($this->getParamsFromRoute()['id_layout'], $this->getPost());
            return (new Json(array('status' => true, 'message' => 'Dados cadastrados com sucesso.')));
        } catch (Exception $exception) {
            return (new Json(array('status' => false, 'message' => $exception . getMessage())));
        }
    }

    public function ajaxDeleteAction()
    {
        try {
            $arrConfigEnvio = $this->getService('InepZend\Module\TrocaArquivo\ConfigEnvio\Service\ConfigEnvio')->getConfigEnvio($this->getPost());
            $this->getService('InepZend\Module\TrocaArquivo\ConfigEnvio\Service\ConfigEnvio')->delete($arrConfigEnvio);
            return (new Json(array('status' => true, 'message' => 'Dados excluídos com sucesso.')));
        } catch (Exception $exception) {
            return (new Json(array('status' => false, 'message' => $exception . getMessage())));
        }
    }

}
