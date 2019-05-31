<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class TransferSpecificTest extends AbstractSpecificTest
{

    public function testAddTransfer()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addTransfer(array('name' => 'Transfer', 'value_options' => array('value', 'value2'))));
    }

    public function testAddTransfer2()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addTransfer('Transfer2', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 'intTabindex', 'arrAttributeData', 'strGroupClass', 'strGroupStyle', array('value', 'value2'), 'strCallbackJsTransferOptions'));
    }

    public function testAddTransfer3()
    {
        try {
            self::getInstanceOf()->addTransfer(array());
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Não foi possível identificar o nome do elemento no formulário.', $runtimeException->getMessage());
        }
    }

    public function testListNameTransfer()
    {
        $this->assertEquals(array("Transfer", "Transfer[NotSelectable]", "[NotSelectable]"), Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listNameTransfer', array(array('name' => 'Transfer'))));
    }

    public function testListNameTransfer2()
    {
        try {
            Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listNameTransfer', array());
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Não foi possível identificar o nome do elemento no formulário.', $runtimeException->getMessage());
        }
    }

    public function testMakeTransferNotSelectable()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferNotSelectable', array(array('name' => 'Transfer'))));
    }

    public function testMakeTransferNotSelectable2()
    {
        try {
            $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferNotSelectable', null));
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Não foi possível identificar o nome do elemento no formulário.', $runtimeException->getMessage());
        }
    }

    public function testMakeTransferSelectable()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferSelectable', array(array('name' => 'Transfer'))));
    }

    public function testMakeTransferSelectable2()
    {
        try {
            $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferSelectable', null));
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Não foi possível identificar o nome do elemento no formulário.', $runtimeException->getMessage());
        }
    }

    public function testMakeTransferSelect()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferSelect', array(array('name' => 'Transfer')), 'makeTransferSelectable'));
    }

    public function testMakeTransferSelect2()
    {
        try {
            $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferSelect', null));
        } catch (\RuntimeException $runtimeException) {
            $this->assertEquals('Não foi possível identificar o nome do elemento no formulário.', $runtimeException->getMessage());
        }
    }

    public function testMakeTransferButton()
    {
        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'makeTransferButton', array(array("name" => "Transfer", "value_options" => array("value", "value2")))));
    }

    public function testSetHeightTransfer()
    {
        $intHeight = self::getInstanceOf();
        $this->assertEquals(1, $intHeight::setHeightTransfer(1));
    }
    
    public function testGetHeightTransfer()
    {
        $intHeight = self::getInstanceOf();
        $this->assertEquals(1, $intHeight::getHeightTransfer(1));
    }

    public function testSetSufixTransferNotSelectable()
    {
        $intHeight = self::getInstanceOf();
        $this->assertEquals('sufix', $intHeight::setSufixTransferNotSelectable('sufix'));
    }
    
    public function testGetSufixTransferNotSelectable()
    {
        $intHeight = self::getInstanceOf();
        $this->assertEquals('sufix', $intHeight::getSufixTransferNotSelectable('sufix'));
    }
}
