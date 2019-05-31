<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class SexoSpecificTest extends AbstractSpecificTest
{

    public function testAddSexo()
    {
        $this->assertEquals($this->getStringSexo(), self::getInstanceOf()->addSexo('Sexo'));
    }

    public function testAddSexo2()
    {
        $this->assertEquals($this->getStringSexo('full'), self::getInstanceOf()->addSexo('Sexo', 'strValue', 'strId', 'strLabel', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'Mensagem', 'strResource', 'strActionToResourceNotAllowed', 10, array('value'), 'strGroupClass', 'strGroupStyle', array('value')));
    }

    public function testAListSexo()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listSexo', null));
    }

    private function getStringSexo($strType = 'simple')
    {
        if ($strType == 'simple') {
            return array(
                'name' => "Sexo",
                'attributes' => array(
                    'id' => "Sexo",
                    'validate_message' => "fieldset_group",
                    'title' => "Sexo",
                    'value' => 'M'
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listSexo', null),
                    'label' => "Sexo",
                ),
                'type' => "InepZend\FormGenerator\Element\Radio"
            );
        }
        return array(
            'name' => 'Sexo',
            'attributes' => array(
                'id' => 'Sexo',
                'value' => 'strValue',
                'title' => 'strClass',
                'validate_message' => 'Mensagem',
                'placeholder' => true,
                'class' => 'strStyle',
                'style' => 'strLabelClass',
                'label_class' => 'strLabelStyle',
                'label_style' => 'strHelpText',
                'help_text' => 'strTypeValidateMessage',
                'disabled' => 'strResource',
                'tabindex' => array('value'),
                'group_class' => 'strGroupStyle',
                'group_style' => array('value'),
            ),
            'options' => array(
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listSexo', null),
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Radio'
        );
    }

}
