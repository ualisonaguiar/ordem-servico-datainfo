<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class NacionalidadeSpecificTest extends AbstractSpecificTest
{

    public function testAddNacionalidade()
    {
        $this->assertEquals($this->getStringNacionalidade(), self::getInstanceOf()->addNacionalidade('Nacionalidade'));
    }

    public function testAddNacionalidade2()
    {
        $this->assertEquals($this->getStringNacionalidade('full'), self::getInstanceOf()->addNacionalidade('Nacionalidade', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListNacionalidade()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listNacionalidade', null));
    }

    private function getStringNacionalidade($strType = 'simple')
    {
        if ($strType == 'simple') {
            return array(
                'name' => "Nacionalidade",
                'attributes' => array(
                    'id' => "Nacionalidade",
                    'placeholder' => "Selecione",
                    'title' => "Nacionalidade",
                    'validate_message' => "fieldset_group",
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listNacionalidade', null),
                    'empty_option' => "Selecione",
                    'label' => "Nacionalidade",
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => 'Nacionalidade',
            'attributes' => array(
                'id' => 'Nacionalidade',
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
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listNacionalidade', null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
