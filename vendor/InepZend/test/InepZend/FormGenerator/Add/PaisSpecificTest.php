<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class PaisSpecificTest extends AbstractSpecificTest
{

    public function testAddPais()
    {
        $this->assertEquals($this->getStringPais(), self::getInstanceOf()->addPais('Pais'));
    }

    public function testAddPais2()
    {
        $this->assertEquals($this->getStringPais('full'), self::getInstanceOf()->addPais('Pais', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange'));
    }

    public function testAListPais()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listPais', null));
    }

    private function getStringPais($strType = 'simple')
    {

        if ($strType == 'simple') {
            return array(
                'name' => "Pais",
                'attributes' => array(
                    'id' => "Pais",
                    'placeholder' => "Selecione",
                    'validate_message' => "fieldset_group",
                    'title' => "País",
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listPais', null),
                    'empty_option' => "Selecione",
                    'label' => "País",
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => 'Pais',
            'attributes' => array(
                'id' => 'Pais',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'strStyle',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'title' => "strTitle",
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
                'onchange' => 'strOnChange'),
            'options' => array(
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listPais', null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
