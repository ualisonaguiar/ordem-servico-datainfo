<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class RadioSpecificTest extends AbstractSpecificTest
{

    public function testAddRadio()
    {
        $this->assertEquals($this->getStringRadio(), self::getInstanceOf()->addRadio('Radio'));
    }

    public function testAddRadio2()
    {
        $this->assertEquals($this->getStringRadio('full'), self::getInstanceOf()->addRadio('Radio', 'strValue', 'strId', 'strLabel', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array(), 'strGroupClass', 'strGroupStyle', array('S' => 'Sim', 'N' => 'Não'), array()));
    }

    private function getStringRadio($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Radio',
                'attributes' => array(
                    'id' => 'Radio',
                    'validate_message' => 'fieldset_group',
                ),
                'type' => 'InepZend\FormGenerator\Element\Radio'
            );
        return array(
            'name' => 'Radio',
            'attributes' => array(
                'id' => 'Radio',
                'validate_message' => 'strDisabled',
                'value' => 'strValue',
                'placeholder' => true,
                'title' => 'strClass',
                'class' => 'strStyle',
                'style' => 'strLabelClass',
                'label_class' => 'strLabelStyle',
                'label_style' => 'strHelpText',
                'help_text' => 'strTypeValidateMessage',
                'disabled' => 'strResource',
                'group_class' => 'strGroupStyle',
                'group_style' => array('S' => 'Sim', 'N' => 'Não')
            ),
            'type' => 'InepZend\FormGenerator\Element\Radio',
            'options' => array(
                'label' => 'strLabel'
            )
        );
    }

}
