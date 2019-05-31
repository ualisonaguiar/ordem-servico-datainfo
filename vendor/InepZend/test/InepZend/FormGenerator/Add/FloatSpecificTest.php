<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class FloatSpecificTest extends AbstractSpecificTest
{

    public function testAddFloat()
    {
        $this->assertEquals($this->getStringFloat(), self::getInstanceOf()->addFloat('Float'));
    }

    public function testAddFloat2()
    {
        $this->assertEquals($this->getStringFloat('full'), self::getInstanceOf()->addFloat('Float', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, true));
    }

    private function getStringFloat($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Float',
                'attributes' => array(
                    'id' => 'Float',
                    'placeholder' => 'Entre com o Valor',
                    'title' => 'Valor',
                    'validate_message' => 'fieldset_group',
                    'data-maskmoney' => 'true'),
                'options' => array(
                    'label' => 'Valor',
                    'precision' => 2,
                    'type' => 'float',
                    'allow_zero' => true)
            );
        return array(
            'name' => 'Float',
            'attributes' => array(
                'id' => 'Float',
                'validate_message' => 'strTypeValidateMessage',
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
                'readonly' => true,
                'maxlength' => 10,
                'data-maskmoney' => 'true'),
            'options' => array(
                'precision' => 2,
                'label' => 'strLabel',
                'type' => 'float',
                'allow_zero' => true)
        );
    }

}
