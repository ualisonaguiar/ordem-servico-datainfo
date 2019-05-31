<?php
namespace InepZend\Module\TrocaArquivo\Cliente\Controller;

use InepZend\Module\TrocaArquivo\CommonTest\Controller\AbstractControllerFileTest;

class ClienteControllerTest extends AbstractControllerFileTest
{

    public function __construct()
    {
        parent::__construct('InepZend\Module\TrocaArquivo\Cliente\Controller\ClienteController');
    }

    public function testIndexAction()
    {
        $this->getFile();
        $this->checkActionCanBeAccessed($this->getControllerName(), 'index', null, array(
            "idLayout" => $this->layout->getIdLayout()
        ));
    }
    
    public function testAjaxErroPaginatorAction()
    {
        $this->checkActionCanBeAccessed($this->getControllerName(), 'ajaxErroPaginator', null, array(
            "idLayout" => $this->layout->getIdLayout()
        ));
    }
    
    /**
     * @test
     */
    public function ajaxErroPaginatorAction()
    {
        $this->checkActionCanBeAccessed($this->getControllerName(), 'ajaxErroPaginator', null, array("id_arquivo" => 1));
    }
}
