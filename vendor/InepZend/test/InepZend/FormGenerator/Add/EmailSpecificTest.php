<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class EmailSpecificTest extends AbstractSpecificTest
{

    public function testAddEmail()
    {
        $this->assertEquals($this->getStringEmail(), self::getInstanceOf()->addEmail('Email'));
    }

    public function testAddEmail2()
    {
        $this->assertEquals($this->getStringEmail('full'), self::getInstanceOf()->addEmail('Email', 'strId', 'strTitle', 'strClass', 'strStyle', 'strResource', 'strActionToResourceNotAllowed', 10, array('strName', 'strId'), 'labelClass', 'strSource', 'HelpText'));
    }

    private function getStringEmail($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Email',
                'attributes' => array(
                    'id' => 'Email',
                    'placeholder' => 'Entre com o E-mail',
                    'title' => 'E-mail',
                    'validate_message' => 'fieldset_group',
                ),
                'type' => 'InepZend\FormGenerator\Element\Email',
                'options' => array(
                    'label' => 'E-mail',
                    'type' => 'text',
                    'show_validate' => false)
            );
        return array(
            'name' => 'Email',
            'attributes' => array(
                'id' => 'Email',
                'validate_message' => 'fieldset_group',
                'style' => array('strName', 'strId'),
                'value' => 'strId',
                'placeholder' => 'strStyle',
                'title' => 'strActionToResourceNotAllowed',
                'class' => 10,
                'label_class' => 'labelClass',
                'label_style' => 'strSource',
                'help_text' => 'HelpText',
            ),
            'options' => array(
                'type' => 'text',
                'label' => 'strClass',
                'show_validate' => false
            ),
            'type' => 'InepZend\FormGenerator\Element\Email'
        );
    }

}
