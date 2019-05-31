<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;
use InepZend\Module\TrocaArquivo\Common\Form\CommonTrait as CommonTraitForm;
use InepZend\Util\Xml;

class MassaTesteController extends AbstractCrudController
{

    use CommonTraitForm;

    public function __construct()
    {
        parent::__construct();
        $this->arrMethodPk = array('ID_MASSA_TESTE');
        $this->arrMethodPaging = array('NO_PROJETO', 'NO_EVENTO', 'NO_LAYOUT', 'NO_STATUS', 'DT_CRIACAO', 'NU_QUANTIDADE_LINHA');
        $this->strService = 'InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile';
        $this->arrPk = array('ID_MASSA_TESTE');
    }

    /**
     * 
     * @return View
     */
    public function indexAction()
    {
        $form = $this->getForm();
        $form->prepareElementsSearch();
        return new View(array('form' => $form));
    }

    /**
     * 
     * @return View
     */
    public function addAction()
    {
        $form = $this->getForm();
        $form->prepareElementsAdd();
        return parent::addAction($form, null, null, 'massateste');
    }

    /**
     * 
     * @return ViewClearContent
     */
    public function downloadAction()
    {
        $this->getService('InepZend\Module\TrocaArquivo\MassaTeste\Service\ArquivoTeste')->download($this->getParamsFromRoute('id_massa_teste'));
        return $this->getViewClearContent();
    }

    /**
     * 
     * @return ViewClearContent
     */
    public function forwardAction()
    {
        $arrStatus = $this->getService('InepZend\Module\TrocaArquivo\MassaTeste\Service\ArquivoTeste')->forwardFile($this->getPost()['idMassaTest']);
        return $this->getViewClearContent(json_encode(array('data' => $arrStatus)));
    }

    /**
     * 
     * @return ajaxFetchPairsAction
     */
    public function ajaxListEventoProjetoAction()
    {
        return parent::ajaxFetchPairsAction($this->getService('InepZend\Module\Corporative\Service\VwProjetoEvento')->fetchPairsToXmlJson($this->getPost(), 'getCoEvento', 'getNomeEventoDataInicioFim'));
    }

    /**
     * Metodo/Action responsavel em gerar os arquivos/layouts.
     * 
     * @return View
     */
    public function generateAction()
    {
        if ($this->isPost()) {
            try {
                $this->generateFile();
                $this->getServiceMessage()->addMessageSuccess(self::MESSAGE_SUCCESS);
                return $this->redirect()->toRoute('massateste', array('action' => 'generate'));
            } catch (Exception $exception) {
                echo $exception->getTraceAsString();
            }
        }

        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy();
        $configuracaoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile')->findBy();
        $configuracaoContatoFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoContatoFile')->findBy();
        $interdependenciaFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\InterdependenciaFile')->findBy();
        $responsavelFile = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ResponsavelFile')->findBy();
        $tipo = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy();

        $form = $this->getForm();
        $form->prepareCreateDefault($layout, $configuracaoFile, $configuracaoContatoFile, $interdependenciaFile, $responsavelFile, $tipo);
        return new View(array('form' => $form));
    }
    

    /**
     * Executa a chamada dos metodos responsavel pela cricacao dos layouts
     * 
     */
    private function generateFile()
    {
        $service = $this->getService();
        $service->deleteGenerate();
        $service->createFileDefault($service->layoutNameDefault());
        $service->interDependencia();
        $service->responsavel();
        $service->createType();
        $service->generateLayoutsEstructures();
    }

}
