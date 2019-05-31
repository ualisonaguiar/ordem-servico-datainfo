<?php

namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\Model\Json;
use InepZend\View\View;
use InepZend\Util\DebugExec;

class LayoutEstruturalController extends AbstractCrudController
{

    use DebugExec;

    const DEBUG = true;

    public function __construct()
    {
        $this->arrPk = array('id_estrutura');
        $this->arrMethodPk = array('getIdEstrutura');
        $this->strService = 'InepZend\Module\TrocaArquivo\Common\Service\File\EstruturaFile';
    }

    public function indexAction()
    {
        $arrEstrutura = $this->getService()->findBy(array('id_layout' => (int) $this->getParamsFromRoute()['id_layout']), array('nu_ordem' => 'asc'));
        return new View(['form' => $this->getForm()->prepareElementsEnvio($arrEstrutura, $this->getParamsFromRoute()['id_layout'])]);
    }

    public function ajaxConfiguracaoAction()
    {
        try {
            $this->getService()->save($this->getPost());
            return (new Json(array('status' => true, 'message' => 'Dados cadastrado com sucesso.')));
        } catch (Exception $exception) {
            return (new Json(array('status' => false, 'message' => $exception . getMessage())));
        }
    }

    public function ajaxConfiguracaoDeleteAction()
    {
        try {
            $arrEstrutura = $this->getService()->getEstrutura($this->getPost());
            $this->getService()->delete($arrEstrutura);
            return (new Json(array('status' => true, 'message' => 'Dados excluído com sucesso.')));
        } catch (Exception $exception) {
            return (new Json(array('status' => false, 'message' => $exception . getMessage())));
        }
    }

    public function gerarXsdAction()
    {
        if ($this->isPost()) {
            $arrPost = $this->getPost();
            try {
                $this->getServiceMessage()->addMessageSuccess(self::MESSAGE_SUCCESS);
                $this->getService()->updateEstrutura($arrPost);
                $this->getService()->gerarXslEstrutura((int) $this->getParamsFromRoute()['id_layout']);
                return $this->redirect()->toRoute('layoutfile');
            } catch (Exception $exception) {
                $this->getServiceMessage()->addMessageError(self::MESSAGE_ERROR);
                return $this->redirect()->toRoute('layoutestrutural', array('action' => 'gerar-xsd', 'id_layout' => $this->getParamsFromRoute()['id_layout']));
            }
        }
        $arrEstrutura = $this->getService()->findBy(array("id_layout" => (int) $this->getParamsFromRoute()['id_layout']));
        return new View(['form' => $this->getForm()->gerarXsd($arrEstrutura, $this->getParamsFromRoute()['id_layout'])]);
    }

}
