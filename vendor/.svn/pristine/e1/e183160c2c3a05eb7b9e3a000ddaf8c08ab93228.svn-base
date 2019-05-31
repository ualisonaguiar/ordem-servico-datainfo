<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class CorRacaSpecificTest extends AbstractSpecificTest
{

    public function testAddCorRaca()
    {
        $this->assertEquals($this->getStringCorRaca(), self::getInstanceOf()->addCorRaca('CorRaca'));
    }

    public function testAddCorRaca2()
    {
        $this->assertEquals($this->getStringCorRaca('full'), self::getInstanceOf()->addCorRaca('CorRaca', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListCorRaca()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listCorRaca', null));
    }

    private function getStringCorRaca($strType = 'simple')
    {
        if ($strType == 'simple') {
            return array(
                'name' => "CorRaca",
                'attributes' => array(
                    'id' => "CorRaca",
                    'placeholder' => "Selecione",
                    'title' => "Cor/Raça",
                    'validate_message' => "fieldset_group",
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listCorRaca', null),
                    'empty_option' => "Selecione",
                    'label' => "Cor/Raça",
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => 'CorRaca',
            'attributes' => array(
                'id' => 'CorRaca',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'strStyle',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
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
                'onchange' => 'strOnChange()'),
            'options' => array(
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listCorRaca', null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
