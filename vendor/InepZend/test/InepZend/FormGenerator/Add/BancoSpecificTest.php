<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;
use InepZend\Util\Reflection;

class BancoSpecificTest extends AbstractSpecificTest
{

    public function testAddBanco()
    {
        $this->assertEquals($this->getString('simple', 'listBanco', 'Selecione', 'Banco', 'Banco'), self::getInstanceOf()->addBanco('Banco'));
    }

    public function testAddBanco2()
    {
        $this->assertEquals($this->getString('full', 'listBanco', 'Selecione', 'Banco', 'Banco'), self::getInstanceOf()->addBanco('Banco', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', false, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'strGroupClass', 'strGroupStyle', 'strEmptyOption', 'strOnChange()'));
    }

    public function testListBanco()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'listBanco', null));
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
