<?php

namespace InepZend\Form;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\FormGenerator\FormGenerator;
use InepZend\Util\Reflection;

class InputElementSpecificTest extends AbstractUnitTest
{

    const CO_CATEGORIA = 6;
    const SERVICE = 'Publicacao\Service\Subcategoria';
    const NAME_ELEMENT = 'NewCPF';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf());
    }

    public function testAddDefault()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addDefault', null));
    }

    public function testAddDefault2()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addDefault', array('Element')));
    }

    public function testSetValidateMessage()
    {
        $this->assertEquals(true, self::getInstanceOf()->setValidateMessage());
    }

    /**
     * @depends testSetValidateMessage
     */
    public function testGetValidateMessage()
    {
        $this->assertEquals('fieldset_group', self::getInstanceOf()->getValidateMessage());
    }

    public function testSetValidateMessage2()
    {
        $this->assertEquals(true, self::getInstanceOf()->setValidateMessage('fieldset_single'));
    }

    /**
     * @depends testSetValidateMessage2
     */
    public function testGetValidateMessage2()
    {
        $this->assertEquals('fieldset_single', self::getInstanceOf()->getValidateMessage());
    }

    public function testSetValidateMessage3()
    {
        $this->assertEquals(true, self::getInstanceOf()->setValidateMessage('field'));
    }

    /**
     * @depends testSetValidateMessage3
     */
    public function testGetValidateMessage3()
    {
        $this->assertEquals('field', self::getInstanceOf()->getValidateMessage());
    }

    /**
     * Teste por referencia.
     */
    public function testAddAttribute()
    {
        $arrElement = $this->getElementTest();
        self::getInstanceOf()->addAttribute($arrElement, 'placeholder', 'PHPUnit Test NewCPF.');
        $this->assertEquals('PHPUnit Test NewCPF.', $arrElement['attributes']['placeholder']);
    }

    /**
     * Teste por referencia.
     */
    public function testAddOption()
    {
        $arrElement = $this->getElementTest();
        self::getInstanceOf()->addOption($arrElement, 'name_original', 'PHPUnit.');
        $this->assertEquals('PHPUnit.', $arrElement['options']['name_original']);
    }

    /**
     * @depends testAddAttribute
     */
    public function testDelAttribute()
    {
        $arrElement = $this->getElementTest();
        self::getInstanceOf()->delAttribute($arrElement, 'placeholder');
        $this->assertNotEquals('placeholder', $arrElement);
    }

    /**
     * @depends testAddOption
     */
    public function testDelOption()
    {
        $arrElement = $this->getElementTest();
        self::getInstanceOf()->delOption($arrElement, 'name_original');
        $this->assertNotContains('name_original', $arrElement);
    }

    public function testSetElement()
    {
        $this->assertNull(self::getInstanceOf()->setElement($this->getElementTest()));
    }

    /**
     * @depends testSetElement
     */
    public function testGetElement()
    {
        $this->assertInternalType('array', self::getInstanceOf()->getElement(self::NAME_ELEMENT));
    }

    /**
     * @depends testAddDefault2
     */
    public function testGetElement2()
    {
        $this->assertInternalType('array', self::getInstanceOf()->getElement('Element'));
    }

    public function testGetElement3()
    {
        $this->assertInternalType('array', self::getInstanceOf()->getElement());
    }

    public function testDelElement()
    {
        $this->assertTrue(self::getInstanceOf()->delElement($this->getElementTest()));
    }

    /**
     * @depends testDelElement
     */
    public function testGetElement4()
    {
        $this->assertNull(self::getInstanceOf()->getElement(self::NAME_ELEMENT));
    }

    public function testDelElementAll()
    {
        $this->assertTrue(self::getInstanceOf()->delElementAll());
    }

    /**
     * @depends testDelElementAll
     */
    public function testGetElement5()
    {
        $this->assertCount(0, self::getInstanceOf()->getElement());
    }

    public function testListEntity()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listEntity', self::SERVICE, array('categoria' => self::CO_CATEGORIA), null, null, array(), null, null, 'fetchPairs'));
        # @TODO
    }

    public function testAddGeneric()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addGeneric', $this->getElementTest(), 'attributes', 'placeholder', 'Value Test.'));
    }

    /**
     * @depends testAddGeneric
     */
    public function testDelGeneric()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'delGeneric', $this->getElementTest(), 'attributes', 'placeholder'));
    }

    public function testGetCountName()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getCountName', null));
    }

    public function testGetCountName2()
    {
        $this->assertInternalType('int', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getCountName', self::NAME_ELEMENT));
        # @TODO
    }

    public function testSetCountName()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setCountName', self::NAME_ELEMENT));
    }

    /**
     * @depends testSetCountName
     */
    public function testGetCountName3()
    {
        $this->assertInternalType('int', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getCountName', self::NAME_ELEMENT, true));
    }

    public function testGetElementValue()
    {
        $this->setValueElement(self::NAME_ELEMENT, 'XXX.XXX.XXX-XX');
        $this->assertEquals('XXX.XXX.XXX-XX', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementValue', self::NAME_ELEMENT));
    }

    public function testGetElementConfigured()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementConfigured', null));
    }

    public function testGetElementConfigured2()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementConfigured', $this->getValueConfigured()[0], $this->getValueConfigured()[1], $this->getValueConfigured()[2], $this->getValueConfigured()[3]));
        # @TODO
    }

    public function testGetElementConfiguredExtended()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementConfiguredExtended', array('mask' => '99.999.999/9999-99'), $this->getValueConfigured()[2], $this->getValueConfigured()[3]));
        # @TODO
    }

    /**
     * @depends testGetElementConfigured2
     */
    public function testGetElementConfiguredExtended2()
    {
        $element = ((Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementConfigured', $this->getValueConfigured()[0], $this->getValueConfigured()[1], $this->getValueConfigured()[2], $this->getValueConfigured()[3])));
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'getElementConfiguredExtended', array_merge($element, array('mask' => '99.999.999/9999-99')), $this->getValueConfigured()[2], $this->getValueConfigured()[3]));
        # @TODO
    }

    public function testSetStyleWidth()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setStyleWidth', self::getInstanceOf()->addText('NewElement'), '30%'));
        # @TODO
    }

    public function testSetStyleFloat()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setStyleFloat', self::getInstanceOf()->addText('NewElement'), 'left'));
        # @TODO
    }

    public function testSetStyleAttribute()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setStyleAttribute', self::getInstanceOf()->addText('NewElement'), 'width', 'left'));
        # @TODO
    }

    public function testSetStyleAttribute2()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setStyleAttribute', self::getInstanceOf()->addText('NewElement'), 'float', 'left'));
        # @TODO
    }

    private function getValueConfigured()
    {
        $arrParam = array('name', 'value');
        $intArgumentTotal = 2;
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
        );
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Textarea'),
            'maxlength' => array('addAttribute'),
            'show_counter' => array('addOption'),
        );
        return array($arrParam, $intArgumentTotal, $arrParamExtra, $arrAttribute);
    }

    private function setValueElement($element, $value)
    {
        return self::getInstanceOf()->get($element)->setValue($value);
    }

    private function addElementTest()
    {
        return self::getInstanceOf()->addCpf(self::NAME_ELEMENT);
    }

    private function getElementTest()
    {
        $this->addElementTest();
        return self::getInstanceOf()->getElement(self::NAME_ELEMENT);
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
