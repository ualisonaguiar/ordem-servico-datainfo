<?php

namespace InepZend\Form;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\FormGenerator\FormGenerator;
use InepZend\Util\Reflection;

class FormGeneratorSpecificTest extends AbstractUnitTest
{

    const NAMESPACE_REQUEST = 'Zend\Http\PhpEnvironment\Request';
    const NAMESPACE_FORMGENERATOR = 'InepZend\FormGenerator\FormGenerator';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_FORMGENERATOR, self::getInstanceOf());
    }

    public function testInstanceOf2()
    {
        $this->getInstance('MyForm', array('format' => 'Y-m-d'));
        $this->assertEquals(array('format' => 'Y-m-d'), self::getInstanceOf()->getOptions());
    }

    public function testGenerateFormName()
    {
        $this->assertEquals('frm', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'generateFormName', null));
    }

    public function testGenerateFormName2()
    {
        $this->assertEquals('frm[MyForm]', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'generateFormName', 'MyForm'));
    }

    public function testGetRequestPhpEnvironment()
    {
        $this->assertInstanceOf(self::NAMESPACE_REQUEST, self::getInstanceOf()->getRequestPhpEnvironment());
    }

    public function testGetRequest()
    {
        $this->assertInstanceOf(self::NAMESPACE_REQUEST, self::getInstanceOf()->getRequest());
    }

    public function testGetBaseUrl()
    {
        $this->assertNotNull(self::getInstanceOf()->getBaseUrl());
    }

    public function testSetViewValidate()
    {
        $this->assertInstanceOf(self::NAMESPACE_FORMGENERATOR, self::getInstanceOf()->setViewValidate(true));
    }

    /**
     * @depends testSetViewValidate
     */
    public function testGetViewValidate()
    {
        $this->assertTrue(self::getInstanceOf()->getViewValidate());
    }

    public function testSetViewValidate2()
    {
        $this->assertInstanceOf(self::NAMESPACE_FORMGENERATOR, self::getInstanceOf()->setViewValidate(false));
    }

    /**
     * @depends testSetViewValidate2
     */
    public function testGetViewValidate2()
    {
        $this->assertFalse(self::getInstanceOf()->getViewValidate());
    }

    public function testSetViewValidate3()
    {
        $this->assertInstanceOf(self::NAMESPACE_FORMGENERATOR, self::getInstanceOf()->setViewValidate());
    }

    public function testGetDataForm()
    {
        $this->assertNull(self::getInstanceOf()->getDataForm());
    }

    public function testDisableElement()
    {
        self::getInstanceOf()->addCpf('CPF');
        self::getInstanceOf()->disableElement(array('CPF' => 'addCpf'));
        $this->assertEquals('disabled', self::getInstanceOf()->getElements()['CPF']->getAttributes()['disabled']);
    }

    private function getInstance($strName = null, $arrOptions = null)
    {
        if ((is_null($strName)) && (is_null($arrOptions))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof FormGenerator))
                self::setInstanceOf(new FormGenerator());
        } else
            self::setInstanceOf(new FormGenerator($strName, $arrOptions));
        return self::getInstanceOf();
    }

}