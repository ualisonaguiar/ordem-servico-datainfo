<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractRouteUnitTest;
use InepZend\Util\Curl;
use Zend\Http\Client as HttpClient;

class CurlSpecificTest extends AbstractRouteUnitTest
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

    public function testGetCurl()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/'));
    }

    public function testGetCurl2()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value')));
    }

    public function testGetCurl3()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST'));
    }

    public function testGetCurl4()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST', array(CURLOPT_RETURNTRANSFER => 1)));
    }

    public function testGetCurl5()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST', array(CURLOPT_RETURNTRANSFER => 1), true));
    }

    public function testGetCurl6()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST', array(CURLOPT_RETURNTRANSFER => 1), true, 'browser/internal'));
    }

    public function testGetCurl7()
    {
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST', array(CURLOPT_RETURNTRANSFER => 1), true, 'browser/internal', 'proxyAuth'));
    }

    public function testGetCurl8()
    {
        $this->setEventTestUnit();
        $this->assertInternalType('array', Curl::getCurl('http://inepskeleton.local/consulta-publica/index', array('key' => 'value'), 'POST', array(CURLOPT_RETURNTRANSFER => 1), true, 'browser/internal', 'proxyHost', $this->request->getHeader()));
    }

    public function testSetAdapter()
    {
        $this->assertTrue(Curl::setAdapter(new HttpClient()));
    }

    public function testSetAdapter2()
    {
        $this->assertTrue(Curl::setAdapter(new HttpClient(), array('timeout')));
    }

    public function testSetAdapter3()
    {
        $this->assertFalse(Curl::setAdapter());
    }

    public function testSetAdapter4()
    {
        $this->assertFalse(Curl::setAdapter(array('key' => 'value')));
    }

    public function testGetOptionToHttpClient()
    {
        $this->assertInternalType('array', Curl::getOptionToHttpClient());
    }

    public function testGetOptionToHttpClient2()
    {
        $this->assertInternalType('array', Curl::getOptionToHttpClient(array('proxyHost', 'proxyPort', 'proxyAuth')));
    }

    public function testGetOptionToHttpClient3()
    {
        $this->assertInternalType('array', Curl::getOptionToHttpClient(null, array('timeout')));
    }

    public function testGetOptionToHttpClient4()
    {
        $this->assertInternalType('array', Curl::getOptionToHttpClient(array('proxyHost', 'proxyPort', 'proxyAuth'), array('timeout')));
    }

}
