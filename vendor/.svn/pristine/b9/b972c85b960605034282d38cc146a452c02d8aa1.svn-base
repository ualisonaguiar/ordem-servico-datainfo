<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class TextSpecificTest extends AbstractSpecificTest
{

    public function testAddText()
    {
        $this->assertEquals($this->getStringText(), self::getInstanceOf()->addText('Text'));
    }

    public function testAddText2()
    {
        $this->assertEquals($this->getStringText('full'), self::getInstanceOf()->addText('Text', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', '9.9.9.9.9.9.9.9', 10, 'onKeyUp()', 'readonly', '[A-Za-z]{3}', array('Sugestion', 'Sugestion2')));
    }

    private function getStringText($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Text',
                'attributes' => array(
                    'id' => 'Text',
                    'validate_message' => 'fieldset_group',
                ),
                'options' => array(
                    'type' => 'text')
            );
        return array(
            'name' => 'Text',
            'attributes' => array(
                'id' => 'Text',
                'validate_message' => 'strTypeValidateMessage',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'required' => 'required',
                'title' => 'strTitle',
                'class' => 'strClass',
                'style' => 'strStyle',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 10,
                'data-0' => 'strName',
                'data-1' => 'strId',
                'group_class' => 'strGroupClass',
                'group_style' => 'strGroupStyle',
                'maxlength' => 10,
                'onkeyup' => 'onKeyUp()',
                'readonly' => 'readonly',
                'pattern' => '[A-Za-z]{3}',
            ),
            'options' => array(
                'type' => 'text',
                'mask' => '9.9.9.9.9.9.9.9',
                'suggestion' => array('Sugestion', 'Sugestion2'),
                'label' => 'strLabel'
            ),
        );
    }

}
