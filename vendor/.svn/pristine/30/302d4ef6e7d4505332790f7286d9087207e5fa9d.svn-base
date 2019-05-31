<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class RegiaoUfMunicipioSpecificTest extends AbstractSpecificTest
{

    public function testAddRegiao()
    {
        $this->assertEquals($this->getString('simple', 'listRegiao', 'Selecione', 'Região', 'Regiao'), self::getInstanceOf()->addRegiao('Regiao'));
    }

    public function testAddRegiao2()
    {
        $this->assertEquals($this->getString('full', 'listRegiao', 'Selecione', 'Região', 'Regiao'), self::getInstanceOf()->addRegiao('Regiao', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListRegiao()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listRegiao', null));
    }

    public function testAddUf()
    {
        $this->assertEquals($this->getString('simple', 'listUf', 'Selecione', 'UF', 'UF'), self::getInstanceOf()->addUf('UF'));
    }

    public function testAddUf2()
    {
        $this->assertEquals($this->getString('full', 'listUf', 'Selecione', 'UF', 'UF'), self::getInstanceOf()->addUf('UF', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testAListUf()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listUf', null));
    }

    public function testAddMunicipio()
    {
        $this->assertEquals($this->getString('simple', 'listUf', 'Selecione', 'UF', 'Municipio'), self::getInstanceOf()->addUf('Municipio'));
    }

    public function testAddMunicipio2()
    {
        $this->assertEquals($this->getString('full', 'listUf', 'Selecione', 'UF', 'Municipio'), self::getInstanceOf()->addUf('Municipio', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    private function getString($strType = 'simple', $strList, $strSelecione, $strTitle, $strLabel)
    {
        if ($strType == 'simple') {
            return array(
                'name' => $strLabel,
                'attributes' => array(
                    'id' => $strLabel,
                    'placeholder' => $strSelecione,
                    'validate_message' => "fieldset_group",
                    'title' => $strTitle,
                ),
                'options' => array(
                    'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), $strList, null),
                    'empty_option' => $strSelecione,
                    'label' => $strTitle,
                ),
                'type' => "InepZend\FormGenerator\Element\Select"
            );
        }
        return array(
            'name' => $strLabel,
            'attributes' => array(
                'id' => $strLabel,
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
                'value_options' => Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), $strList, null),
                'empty_option' => 'strEmptyOption',
                'label' => 'strLabel'),
            'type' => 'InepZend\FormGenerator\Element\Select'
        );
    }

}
