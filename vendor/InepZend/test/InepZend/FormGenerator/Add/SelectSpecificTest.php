<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class SelectSpecificTest extends AbstractSpecificTest
{

    public function testAddSelect()
    {
        $this->assertEquals($this->getStringSelect(), self::getInstanceOf()->addSelect('Select'));
    }

    public function testAddSelect2()
    {
        $this->assertEquals($this->getStringSelect('full'), self::getInstanceOf()->addSelect('Select', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array(), 'strGroupClass', 'strGroupStyle', array('key' => 'value'), 'Selecione algum valor', 'strOnChange()'));
    }

    private function getStringSelect($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Select',
                'attributes' => array(
                    'id' => 'Select',
                    'validate_message' => 'fieldset_group'),
                'type' => 'InepZend\FormGenerator\Element\Select',
                'options' => array(
                    'value_options' => array())
            );
        return array(
            'name' => 'Select',
            'attributes' => array(
                'id' => 'Select',
                'validate_message' => 'strTypeValidateMessage',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'title' => 'strTitle',
                'class' => 'strClass',
                'style' => 'strStyle',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 10,
                'group_class' => 'strGroupClass',
                'group_style' => 'strGroupStyle',
                'onchange' => 'strOnChange()',
                'required' => 'required'),
            'options' => array(
                'value_options' => array('key' => 'value'),
                'label' => 'strLabel',
                'empty_option' => 'Selecione algum valor',
            ),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
