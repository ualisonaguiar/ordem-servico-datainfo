<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class CpfSpecificTest extends AbstractSpecificTest
{

    public function testAddCpf()
    {
        $this->assertEquals($this->getStringCpf(), self::getInstanceOf()->addCpf('Cpf'));
    }

    public function testAddCpf2()
    {
        $this->assertEquals($this->getStringCpf('full'), self::getInstanceOf()->addCpf('Cpf', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', true, 'readonly'));
    }

    private function getStringCpf($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Cpf',
                'attributes' => array(
                    'id' => 'Cpf',
                    'placeholder' => 'Entre com o CPF',
                    'title' => 'CPF',
                    'validate_message' => 'fieldset_group',
                    'data-cpf' => 'true',
                    'style' => 'width: 170px; '),
                'options' => array(
                    'label' => 'CPF',
                    'type' => 'text',
                    'mask' => '999.999.999-99')
            );
        return array(
            'name' => 'Cpf',
            'attributes' => array(
                'id' => 'Cpf',
                'placeholder' => 'strPlaceHolder',
                'title' => 'strTitle',
                'validate_message' => 'strTypeValidateMessage',
                'data-cpf' => 'true',
                'style' => 'width: 170px; strStyle',
                'value' => 'strValue',
                'required' => 'required',
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
                'label' => 'strLabel',
                'type' => 'text',
                'mask' => '999.999.999-99',
                'show_validate' => true)
        );
    }

}
