<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class CheckboxSpecificTest extends AbstractSpecificTest
{

    public function testAddCheckbox()
    {
        $this->assertEquals($this->getStringCheckbox(), self::getInstanceOf()->addCheckbox('Checkbox'));
    }

    public function testAddCheckbox2()
    {
        $this->assertEquals($this->getStringCheckbox('full'), self::getInstanceOf()->addCheckbox('Checkbox', 'strValue', 'strId', 'strLabel', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 'intTabindex', array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strCheckedValue', 'strUncheckedValue', true));
    }

    private function getStringCheckbox($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Checkbox',
                'attributes' => array(
                    'id' => 'Checkbox',
                    'validate_message' => 'fieldset_group'),
                'type' => 'InepZend\FormGenerator\Element\Checkbox',
                'options' => array(
                    'use_hidden_element' => true)
            );
        return array(
            'name' => 'strUncheckedValue',
            'attributes' => array(
                'id' => 'strUncheckedValue',
                'validate_message' => 'fieldset_group',
                'value' => true,
                'placeholder' => true),
            'options' => array(
                'checked_value' => 'strUncheckedValue',
                'unchecked_value' => true,
                'use_hidden_element' => true
            ),
            'type' => 'InepZend\FormGenerator\Element\Checkbox'
        );
    }

}
