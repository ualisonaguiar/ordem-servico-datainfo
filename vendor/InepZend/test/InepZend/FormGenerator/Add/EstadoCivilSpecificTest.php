<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class EstadoCivilSpecificTest extends AbstractSpecificTest
{

    public function testAddEstadoCivil()
    {
        $this->assertEquals($this->getStringEstadoCivil(), self::getInstanceOf()->addEstadoCivil('EstadoCivil'));
    }

    public function testAddEstadoCivil2()
    {
        $this->assertEquals($this->getStringEstadoCivil('full'), self::getInstanceOf()->addEstadoCivil('EstadoCivil', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListEstadoCivil()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listEstadoCivil', null));
    }

    private function getStringEstadoCivil($strType = 'simple')
    {

        if ($strType == 'simple') {
            return array(
                'name' => "EstadoCivil",
                'attributes' => array(
                    'id' => "EstadoCivil",
                    'placeholder' => "Selecione",
                    'title' => "Estado Civil",
                    'validate_message' => "fieldset_group",
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listEstadoCivil', null),
                    'empty_option' => "Selecione",
                    'label' => "Estado Civil",
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => 'EstadoCivil',
            'attributes' => array(
                'id' => 'EstadoCivil',
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
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listEstadoCivil', null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
