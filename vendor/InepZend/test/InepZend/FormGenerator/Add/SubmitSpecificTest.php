<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class SubmitSpecificTest extends AbstractSpecificTest
{

    public function testAddSubmit()
    {
        $this->assertEquals($this->getStringSubmit(), self::getInstanceOf()->addSubmit('Submit'));
    }

    public function testAddSubmit2()
    {
        $this->assertEquals($this->getStringSubmit('full'), self::getInstanceOf()->addSubmit('Submit', 'strValue', 'strId', 'strTitle', 'strClass', 'strStyle', 'strResource', 'strActionToResourceNotAllowed', 10, array()));
    }

    private function getStringSubmit($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Submit',
                'attributes' => array(
                    'id' => 'Submit',
                    'validate_message' => 'fieldset_group'
                ),
                'type' => 'InepZend\FormGenerator\Element\Submit',
            );
        return array(
            'name' => 'Submit',
            'attributes' => array(
                'id' => 'Submit',
                'validate_message' => 'fieldset_group',
                'value' => 'strValue',
                'placeholder' => 'strClass',
                'title' => 'strResource',
                'class' => 'strActionToResourceNotAllowed',
                'style' => 10,
            ),
            'options' => array(
                'label' => 'strTitle'
            ),
            'type' => 'InepZend\FormGenerator\Element\Submit'
        );
    }

}
