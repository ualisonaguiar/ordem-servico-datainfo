<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class TextareaSpecificTest extends AbstractSpecificTest
{

    public function testAddTextarea()
    {
        $this->assertEquals($this->getStringTextarea(), self::getInstanceOf()->addTextarea('Textarea'));
    }

    public function testAddTextarea2()
    {
        $this->assertEquals($this->getStringTextarea('full'), self::getInstanceOf()->addTextarea('Textarea', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, true));
    }

    private function getStringTextarea($strType = 'simple')
    {

        if ($strType == 'simple')
            return array(
                'name' => 'Textarea',
                'attributes' => array(
                    'id' => 'Textarea',
                    'validate_message' => 'fieldset_group',
                ),
                'type' => 'InepZend\FormGenerator\Element\Textarea',
                'options' => array(
                    'is_editor' => false)
            );
        return array(
            'name' => 'Textarea',
            'attributes' => array(
                'id' => 'Textarea',
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
                'maxlength' => 10),
            'options' => array(
                'label' => 'strLabel',
                'is_editor' => false,
                'show_counter' => true
            ),
            'type' => 'InepZend\FormGenerator\Element\Textarea'
        );
    }

}
