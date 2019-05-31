<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class NascimentoSpecificTest extends AbstractSpecificTest
{

    public function testAddNascimento()
    {
        $this->assertEquals($this->getStringNascimento(), self::getInstanceOf()->addNascimento('Nascimento'));
    }

    public function testAddNascimento2()
    {
        $this->assertEquals($this->getStringNascimento('full'), self::getInstanceOf()->addNascimento('Nascimento', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'readonly'));
    }

    private function getStringNascimento($strType = 'simple')
    {

        if ($strType == 'simple')
            return array(
                'name' => 'Nascimento',
                'attributes' => array(
                    'id' => 'Nascimento',
                    'validate_message' => 'fieldset_group',
                    'placeholder' => 'Data de nascimento',
                    'title' => 'Nascimento',
                    'style' => 'width: 140px; '),
                'options' => array(
                    'type' => 'text',
                    'label' => 'Nascimento',
                    'mask' => '99/99/9999')
            );
        return array(
            'name' => 'Nascimento',
            'attributes' => array(
                'id' => 'Nascimento',
                'validate_message' => 'strTypeValidateMessage',
                'placeholder' => 'Data de nascimento',
                'style' => 'width: 140px; strStyle',
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
                'readonly' => 'readonly'),
            'options' => array(
                'type' => 'text',
                'label' => 'strLabel',
                'mask' => '99/99/9999')
        );
    }

}
