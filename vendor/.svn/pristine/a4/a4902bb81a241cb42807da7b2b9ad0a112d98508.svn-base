<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Module\UnitTest\Controller\AbstractControllerTest;

class IndexCoreControllerTest extends AbstractControllerTest
{

    public function testPrepareRequest()
    {
        $this->evalCheckAssert('is_array($this->prepareRequest(false, array(\'key\' => \'value\')))', true);
    }

    public function testPrepareRequest1()
    {
        $this->evalCheckAssert('is_array($this->prepareRequest(true, array(\'key\' => \'value\')))', true);
    }

    public function testPrepareRequest2()
    {
        $this->evalCheckAssert('is_array($this->prepareRequest(false))', true);
    }

    public function testPrepareRequest3()
    {
        $this->evalCheckAssert('is_array($this->prepareRequest(true))', true);
    }

    public function testGetIdentity()
    {
        $this->evalCheckAssert('is_object($this->getIdentity())', true);
    }

    public function testGetAttributeValue()
    {
        $this->evalCheckAssert('is_string($this->getAttributeValue())', false);
    }

    public function testGetAttributeValue2()
    {
        $this->evalCheckAssert('is_string($this->getAttributeValue())', false);
    }

    /**
     * Eh necessario passar dentro da chamada o atributo como referencia, pois
     * o metodo getAttributeValue recebe no primeiro parametro uma variavel por
     * referencia.
     * Na classe de teste (IndexRestfullController) foi criado o atributo 
     * $strAtributteTest e o mesmo eh passado na chamada como referencia.
     * 
     * protected $strAtributteTest;
     */
    public function testGetAttributeValue3()
    {
        $this->evalCheckAssert('is_string($this->getAttributeValue($strAtributteTest,\'strAtributteTest\'))', true);
    }

}
