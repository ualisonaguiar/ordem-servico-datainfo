<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class CnpjSpecificTest extends AbstractSpecificTest
{

    public function testAddCnpj()
    {
        $this->assertEquals($this->getStringCnpj(), self::getInstanceOf()->addCnpj('Cnpj'));
    }

    public function testAddCnpj2()
    {
        $this->assertEquals($this->getStringCnpj('full'), self::getInstanceOf()->addCnpj('Cnpj', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', true, 'readonly'));
    }

    private function getStringCnpj($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Cnpj',
                'attributes' => array(
                    'id' => 'Cnpj',
                    'placeholder' => 'Entre com o CNPJ',
                    'title' => 'CNPJ',
                    'validate_message' => 'fieldset_group',
                    'data-cnpj' => 'true',
                    'style' => 'width: 180px; '),
                'options' => array(
                    'label' => 'CNPJ',
                    'type' => 'text',
                    'mask' => '99.999.999/9999-99')
            );
        return array(
            'name' => 'Cnpj',
            'attributes' => array(
                'id' => 'Cnpj',
                'placeholder' => 'strPlaceHolder',
                'title' => 'strTitle',
                'validate_message' => 'strTypeValidateMessage',
                'data-cnpj' => 'true',
                'style' => 'width: 180px; strStyle',
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
                'mask' => '99.999.999/9999-99',
                'show_validate' => true)
        );
    }

}
