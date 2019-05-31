<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class HiddenSpecificTest extends AbstractSpecificTest
{

    public function testAddHidden()
    {
        $this->assertEquals($this->getStringHidden(), self::getInstanceOf()->addHidden('Hidden'));
    }

    public function testAddHidden2()
    {
        $this->assertEquals($this->getStringHidden('full'), self::getInstanceOf()->addHidden('Hidden', 'strValue', 'strId', array()));
    }

    private function getStringHidden($strType = 'simple')
    {
        if ($strType == 'simple')
            return array(
                'name' => 'Hidden',
                'attributes' => array(
                    'id' => 'Hidden',
                    'validate_message' => 'fieldset_group',
                    'type' => 'hidden'
                ),
            );
        return array(
            'name' => 'Hidden',
            'attributes' => array(
                'id' => 'Hidden',
                'validate_message' => 'fieldset_group',
                'type' => 'hidden',
                'value' => 'strValue'
            ),
        );
    }

}
