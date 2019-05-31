<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class EditorSpecificTest extends AbstractSpecificTest
{

    public function testAddEditor()
    {
        $this->assertEquals($this->getStringEditor(), self::getInstanceOf()->addEditor('Editor'));
    }

    public function testAddEditor2()
    {
        $this->assertEquals($this->getStringEditor('full'), self::getInstanceOf()->addEditor('Editor', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, true, array('ArrayPlugin'), array('ArrayToolbar')));
    }

    private function getStringEditor($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Editor',
                'attributes' => array(
                    'id' => 'Editor',
                    'title' => 'Conteúdo',
                    'class' => 'editorFormElement',
                    'validate_message' => 'fieldset_group',
                ),
                'type' => 'InepZend\FormGenerator\Element\Textarea',
                'options' => array(
                    'label' => 'Conteúdo',
                    'is_editor' => true)
            );
        return array(
            'name' => 'Editor',
            'attributes' => array(
                'id' => 'Editor',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'strStyle',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'required' => 'required',
                'title' => 'strTitle',
                'class' => 'strClass editorFormElement',
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
                'is_editor' => true,
                'show_counter' => true,
                'plugins' => array('ArrayPlugin'),
                'toolbar' =>  array('ArrayToolbar')
            ),
            'type' => 'InepZend\FormGenerator\Element\Textarea'
        );
    }

}
