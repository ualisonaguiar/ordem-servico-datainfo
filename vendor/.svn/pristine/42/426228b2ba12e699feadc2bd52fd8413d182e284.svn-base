<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class PhoneSpecificTest extends AbstractSpecificTest
{

    public function testAddPhone()
    {
        $this->assertEquals($this->getStringPhone(), self::getInstanceOf()->addPhone('Phone'));
    }

    public function testAddPhone2()
    {
        $this->assertEquals($this->getStringPhone('full', false), self::getInstanceOf()->addPhone('Phone', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, false, '061', 'readonly'));
    }

    public function testAddPhone3()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addPhone('Phone', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, true, '061', 'readonly'));
    }

    public function testListDdd()
    {
        $form = self::getInstanceOf();
        $this->assertInternalType('string', $form::listDdd(true));
    }

    public function testListDdd2()
    {
        $form = self::getInstanceOf();
        $this->assertInternalType('string', $form::listDdd(false));
    }

    public function testSetPrefixDdd()
    {
        $form = self::getInstanceOf();
        $this->assertEquals('777', $form::setPrefixDdd('777'));
    }

    public function testGetPrefixDdd()
    {
        $form = self::getInstanceOf();
        $this->assertEquals('777', $form::getPrefixDdd());
    }

    public function testSetDddPhone()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setDddPhone', 'PhoneUnitTest', '777'));
    }

    public function testGetDddPhone()
    {
        $form = self::getInstanceOf();
        $this->assertInternalType('array', $form::getDddPhone());
    }

    private function getStringPhone($strType = 'simple', $booDdd = false)
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Phone',
                'attributes' => array(
                    'id' => 'Phone',
                    'placeholder' => 'Entre com o Telefone',
                    'title' => 'Telefone',
                    'validate_message' => 'fieldset_group',
                    'style' => 'width: 200px; '),
                'options' => array(
                    'label' => 'Telefone',
                    'type' => 'text',
//                    'mask' => '9999-9999',
                    'mask' => '9999-9999?9',
                    'phone' => true,
                    'ddd' => $booDdd)
            );
        return array(
            'name' => 'Phone',
            'attributes' => array(
                'id' => 'Phone',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'width: 200px; ',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'required' => 'required',
                'title' => 'strTitle',
                'class' => 'strClass',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 10,
                'data-0' => 'strName',
                'data-1' => 'strId',
                'group_class' => 'strGroupClass',
                'group_style' => 'strGroupStyle',
                'readonly' => 'readonly'),
            'options' => array(
                'type' => 'text',
//                'mask' => '9999-999999',
                'mask' => '9999-9999?9',
                'label' => 'strLabel',
                'phone' => true,
                'ddd' => $booDdd)
        );
    }

}
