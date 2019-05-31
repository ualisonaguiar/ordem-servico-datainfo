<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class InputImageSpecificTest extends AbstractSpecificTest
{

   public function testAddInputImage()
    {
        $this->assertEquals($this->getStringInputImage(), self::getInstanceOf()->addInputImage('InputImage'));
    }

    public function testAddInputImage2()
    {
        $this->assertEquals($this->getStringInputImage('full'), self::getInstanceOf()->addInputImage('InputImage', 'strValue', 'strId', array()));
    }

    private function getStringInputImage($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'InputImage',
                'attributes' => array(
                    'id' => 'InputImage',
                    'validate_message' => 'fieldset_group',
                ),
                'type' => 'InepZend\FormGenerator\Element\Image'
            );
        return array(
            'name' => 'InputImage',
            'attributes' => array(
                'id' => 'InputImage',
                'validate_message' => 'fieldset_group',
                'value' => 'strValue'
            ),
            'type' => 'InepZend\FormGenerator\Element\Image'
        );
    }

}
