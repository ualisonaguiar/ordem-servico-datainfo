<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class PisPasepSpecificTest extends AbstractSpecificTest
{

    public function testAddPisPasep()
    {
        $this->assertEquals($this->getStringPisPasep(), self::getInstanceOf()->addPisPasep('PisPasep'));
    }

    public function testAddPisPasep2()
    {
        $this->assertEquals($this->getStringPisPasep('full'), self::getInstanceOf()->addPisPasep('PisPasep', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', true, true, 'strJsConvertMap'));
    }

    private function getStringPisPasep($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'PisPasep',
                'attributes' => array(
                    'id' => 'PisPasep',
                    'placeholder' => 'Entre com o PIS/PASEP',
                    'title' => 'PIS/PASEP',
                    'validate_message' => 'fieldset_group',
                    'style' => 'width: 180px; '),
                'options' => array(
                    'label' => 'PIS/PASEP',
                    'type' => 'text',
                    'mask' => '999.99999.99-9')
            );
        return array(
            'name' => 'PisPasep',
            'attributes' => array(
                'id' => 'PisPasep',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'width: 180px; strStyle',
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
                'readonly' => true),
            'options' => array(
                'type' => 'text',
                'mask' => '999.99999.99-9',
                'label' => 'strLabel',
                'show_validate' => true)
        );
    }

}
