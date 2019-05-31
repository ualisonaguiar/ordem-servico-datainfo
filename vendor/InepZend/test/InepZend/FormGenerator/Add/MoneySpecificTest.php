<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class MoneySpecificTest extends AbstractSpecificTest
{

    public function testAddMoney()
    {
        $this->assertEquals($this->getStringMoney(), self::getInstanceOf()->addMoney('Money'));
    }

    public function testAddMoney2()
    {
        $this->assertEquals($this->getStringMoney('full'), self::getInstanceOf()->addMoney('Money', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, true));
    }

    private function getStringMoney($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Money',
                'attributes' => array(
                    'id' => 'Money',
                    'placeholder' => 'Entre com o Valor',
                    'title' => 'Valor',
                    'validate_message' => 'fieldset_group',
                    'data-maskmoney' => 'true',
                    'data-money' => 'true'),
                'options' => array(
                    'label' => 'Valor',
                    'type' => 'money')
            );
        return array(
            'name' => 'Money',
            'attributes' => array(
                'id' => 'Money',
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
                'data-maskmoney' => 'true',
                'data-money' => 'true'),
            'options' => array(
                'type' => 'money',
                'label' => 'strLabel')
        );
    }

}
