<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractRouteUnitTest;
use InepZend\Util\Request;
use InepZend\Util\Reflection;

class RequestSpecificTest extends AbstractRouteUnitTest
{

    public function __construct()
    {
        $this->setLogin('09723347776');
        $this->setPassword('Vctr0005@');
        parent::__construct('ConsultaPublica\Controller\IndexController');
    }

    protected function createAllDataProvider()
    {
        return array();
    }

    public function setEventTestUnit()
    {
        $this->setUpRoute(new Request());
        $this->request->setEventOriginal($this->event);
        $this->checkActionCanBeAccessed($this->getControllerNamespace(), 'result', array(), array(), null, false, false);
    }

    public function testIsPost()
    {
        $_POST['test'] = array('key' => 'value');
        $request = new Request();
        $request->setMethod('POST');
        $this->assertEquals($request->isPost(), true);
    }

    public function testGetParamsFromRoute()
    {
        $this->setEventTestUnit();
        $this->assertEquals($this->request->getParamsFromRoute('action'), 'result');
    }

    public function testGetParamsFromQuery()
    {
        $this->setEventTestUnit();
        $this->assertInternalType('array', $this->request->getParamsFromQuery());
    }

    public function testGetSetFiles()
    {
        $this->setEventTestUnit();
        Reflection::invokeNotAccessibleMethod(new Request(), 'setFiles', array('./vendor/InepZend/test/InepZend/Util/test.txt'));
        $this->assertEquals(array('./vendor/InepZend/test/InepZend/Util/test.txt'), $this->request->getFiles());
    }

    public function testGetHeader()
    {
        $this->setEventTestUnit();
        $this->assertInstanceOf('Zend\Http\Headers', $this->request->getHeader());
    }

    public function testSetIsPost()
    {
        $this->setEventTestUnit();
        Reflection::invokeNotAccessibleMethod(new Request(), 'setPost', array('key', 'value'));
        $this->assertTrue($this->request->isPost());
    }

    public function testGetRequestUri()
    {
        $this->setEventTestUnit();
        $this->assertEquals($this->request->getRequestUri(), '/');
    }

    public function testGetBaseUrl()
    {
        $this->setEventTestUnit();
        $this->assertInternalType('string', $this->request->getBaseUrl());
    }

    public function testGetBasePath()
    {
        $this->setEventTestUnit();
        $this->assertInternalType('string', $this->request->getBasePath());
    }

    public function testSetGetMethod()
    {
        $this->setEventTestUnit();
        $this->assertNotNull($this->request->setMethod('POST'));
        $this->assertSame($this->request->getMethod(), 'POST');
    }

    public function testGetRoute()
    {
        $this->setEventTestUnit();
        $GLOBALS['route'] = 'UnitTest';
        $this->assertSame('UnitTest', $this->request->getRoute());
    }

    public function testGetSingleRequest()
    {
        $this->setEventTestUnit();
        $this->assertNotNull(Reflection::invokeNotAccessibleMethod(new Request(), 'getSingleRequest'));
    }

}
