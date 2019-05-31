<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class PasswordSpecificTest extends AbstractSpecificTest
{

    public function testAddPassword()
    {
        $this->assertEquals($this->getStringPassword(), self::getInstanceOf()->addPassword('Password'));
    }

    public function testAddPassword2()
    {
        $this->assertEquals($this->getStringPassword('full'), self::getInstanceOf()->addPassword('Password', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 10, 'strOnKeyUpFunction()'));
    }

    private function getStringPassword($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Password',
                'attributes' => array(
                    'id' => 'Password',
                    'placeholder' => 'Entre com a Senha',
                    'required' => 'required',
                    'title' => 'Senha',
                    'validate_message' => 'fieldset_group',
                    'maxlength' => 20,
                    'style' => 'width: 220px; '),
                'options' => array(
                    'label' => 'Senha',
                ),
                'type' => 'InepZend\FormGenerator\Element\Password'
            );
        return array(
            'name' => 'Password',
            'attributes' => array(
                'id' => 'Password',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'width: 220px; strStyle',
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
                'onkeyup' => 'strOnKeyUpFunction()',
                'maxlength' => 10),
            'options' => array(
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Password'
        );
    }

}
