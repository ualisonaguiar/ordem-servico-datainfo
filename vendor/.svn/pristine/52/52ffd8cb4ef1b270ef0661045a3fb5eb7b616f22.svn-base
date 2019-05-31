<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class CepSpecificTest extends AbstractSpecificTest
{

    public function testAddCep()
    {
        $this->assertEquals($this->getStringCep(), self::getInstanceOf()->addCep('Cep'));
    }

    public function testAddCep2()
    {
        $this->assertEquals($this->getStringCep('full'), self::getInstanceOf()->addCep('Cep', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'readonly', true, true, 'strJsConvertMap'));
    }

    private function getStringCep($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Cep',
                'attributes' => array(
                    'id' => 'Cep',
                    'placeholder' => 'Entre com o CEP',
                    'title' => 'CEP',
                    'validate_message' => 'fieldset_group',
                    'style' => 'width: 130px; '),
                'options' => array(
                    'label' => 'CEP',
                    'type' => 'text',
                    'mask' => '99999-999')
            );
        return array(
            'name' => 'Cep',
            'attributes' => array(
                'id' => 'Cep',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'float: left; width: 130px; strStyle',
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
                'mask' => '99999-999',
                'label' => 'strLabel')
        );
    }

}
