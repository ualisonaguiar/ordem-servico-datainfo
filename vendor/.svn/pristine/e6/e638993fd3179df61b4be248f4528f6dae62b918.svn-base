<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class NumberSpecificTest extends AbstractSpecificTest
{

    public function testAddNumber()
    {
        $this->assertEquals($this->getStringNumber(), self::getInstanceOf()->addNumber('Number'));
    }

    public function testAddNumber2()
    {
        $this->assertEquals($this->getStringNumber('full'), self::getInstanceOf()->addNumber('Number', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, 10, 10, 'readonly'));
    }

    private function getStringNumber($strType = 'simple')
    {

        if ($strType == 'simple')
            return array(
                'name' => 'Number',
                'attributes' => array(
                    'id' => 'Number',
                    'validate_message' => 'fieldset_group'),
                'options' => array(
                    'type' => 'text',
                    'number' => true)
            );
        return array(
            'name' => 'Number',
            'attributes' => array(
                'id' => 'Number',
                'validate_message' => 'strTypeValidateMessage',
                'placeholder' => 'Entre com a data de nascimento',
                'style' => 'strStyle',
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
                'readonly' => 'readonly',
                'max' => 10,
                'min' => 10,
                'maxlength' => 10),
            'options' => array(
                'label' => 'strLabel',
                'number' => true,
                'maxlength' => 10),
            'type' => 'InepZend\FormGenerator\Element\Number'
        );
    }

}
