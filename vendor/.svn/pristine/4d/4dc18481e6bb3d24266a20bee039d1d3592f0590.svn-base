<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class OrgaoEmissorSpecificTest extends AbstractSpecificTest
{

    public function testAddOrgaoEmissor()
    {
        $this->assertEquals($this->getStringOrgaoEmissor(), self::getInstanceOf()->addOrgaoEmissor('OrgaoEmissor'));
    }

    public function testAddOrgaoEmissor2()
    {
        $this->assertEquals($this->getStringOrgaoEmissor('full'), self::getInstanceOf()->addOrgaoEmissor('OrgaoEmissor', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListOrgaoEmissor()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listOrgaoEmissor', null));
    }

    private function getStringOrgaoEmissor($strType = 'simple')
    {
        if ($strType == 'simple') {
            return array(
                'name' => "OrgaoEmissor",
                'attributes' => array(
                    'id' => "OrgaoEmissor",
                    'placeholder' => "Selecione",
                    
                    'validate_message' => "fieldset_group",
                    'title' => "Órgão expedidor",
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listOrgaoEmissor', null),
                    'empty_option' => "Selecione",
                    'label' => "Órgão expedidor",
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => 'OrgaoEmissor',
            'attributes' => array(
                'id' => 'OrgaoEmissor',
                'validate_message' => 'strTypeValidateMessage',
                'style' => 'strStyle',
                'value' => 'strValue',
                'placeholder' => 'strPlaceHolder',
                'title' => "strTitle",
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
                'onchange' => 'strOnChange()'),
            'options' => array(
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listOrgaoEmissor', null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
