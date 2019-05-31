<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Module\UnitTest\Controller\AbstractControllerTest;

class IndexManagerControllerTest extends AbstractControllerTest
{

    public function testGetService()
    {
        $this->evalCheckAssert('is_object($this->getService())', true);
    }

    /**
     * @depends testGetService
     */
    public function testGetService2()
    {
        $this->evalCheckAssert('get_class($this->getService())', 'InepZend\Module\UnitTest\Service\Subcategoria');
    }

    /**
     * @depends testGetService
     */
    public function testGetService3()
    {
        $this->evalCheckAssert('is_object($this->getService(\'InepZend\Module\UnitTest\Service\Subcategoria\'))', true);
    }

    /**
     * @depends testGetService
     */
    public function testGetService4()
    {
        $this->evalCheckAssert('get_class($this->getService(\'InepZend\Module\UnitTest\Service\Index\'))', 'InepZend\Module\UnitTest\Service\Index');
    }

    public function testGetServiceMessage()
    {
        $this->evalCheckAssert('is_object($this->getServiceMessage())', true);
    }

    /**
     * @depends testGetServiceMessage
     */
    public function testGetServiceMessage2()
    {
        $this->evalCheckAssert('get_class($this->getServiceMessage())', 'InepZend\Message\Message');
    }

    public function testGetForm()
    {
        $this->evalCheckAssert('is_object($this->getForm(\'\ConsultaPublica\Form\SearchSchool\'))', true);
    }

    /**
     * @depends testGetForm
     */
    public function testGetForm2()
    {
        $this->evalCheckAssert('get_class($this->getForm(\'\ConsultaPublica\Form\SearchSchool\'))', 'ConsultaPublica\Form\SearchSchool');
    }

    /**
     * @depends testGetForm
     */
    public function testGetForm3()
    {
        $this->evalCheckAssert('is_object($this->getForm())', true);
    }

    /**
     * @depends testGetForm
     */
    public function testGetForm4()
    {
        $this->evalCheckAssert('get_class($this->getForm())', 'InepZend\Module\UnitTest\Form\SubcategoriaForm');
    }

}
