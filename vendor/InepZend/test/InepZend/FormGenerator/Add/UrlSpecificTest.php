<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class UrlSpecificTest extends AbstractSpecificTest
{

    public function testAddUrl()
    {
        $this->assertEquals($this->getStringUrl(), self::getInstanceOf()->addUrl('Url'));
    }

    public function testAddUrl2()
    {
        $this->assertEquals($this->getStringUrl('full'), self::getInstanceOf()->addUrl('Url', 'strValue', 'strId', 'strLabel', 'strPlaceHolder', true, 'strTitle', 'strClass', 'strStyle', 'strLabelClass', 'strLabelStyle', 'strHelpText', 'strTypeValidateMessage', 'strDisabled', 'strResource', 'strActionToResourceNotAllowed', 10, array(), 'strGroupClass', 'strGroupStyle', 10, 'strReadonly'));
    }

    private function getStringUrl($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Url',
                'attributes' => array(
                    'id' => 'Url',
                    'placeholder' => 'Entre com a URL',
                    'title' => 'URL',
                    'validate_message' => 'fieldset_group'
                ),
                'options' => array(
                    'label' => 'URL',
                    'type' => 'text',
                ),
                'type' => 'InepZend\FormGenerator\Element\Url',
            );
        return array(
            'name' => 'Url',
            'attributes' => array(
                'id' => 'Url',
                'validate_message' => 'strTypeValidateMessage',
                'placeholder' => 'strPlaceHolder',
                'title' => 'strTitle',
                'class' => 'strClass',
                'style' => 'strStyle',
                'required' => 'required',
                'label_class' => 'strLabelClass',
                'label_style' => 'strLabelStyle',
                'help_text' => 'strHelpText',
                'disabled' => 'strDisabled',
                'tabindex' => 10,
                'group_class' => 'strGroupClass',
                'group_style' => 'strGroupStyle',
                'maxlength' => 10,
                'readonly' => 'strReadonly',
                'value' => 'strValue'
            ),
            'options' => array(
                'type' => 'text',
                'label' => 'strLabel'
            ),
            'type' => 'InepZend\FormGenerator\Element\Url'
        );
    }

}
