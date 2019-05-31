<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class LabelSpecificTest extends AbstractSpecificTest
{

    public function testAddLabel()
    {
        $this->assertEquals('<label id="idLabel">newLabel</label><div id="idLabelDivRequired" class="divRequired" style="display: ;"></div>', self::getInstanceOf()->addLabel('idLabel', 'newLabel')->getValue());
    }

    public function testAddLabel2()
    {
        $this->assertEquals('<label class="strLabelClass" style="strLabelStyle" id="idLabelTwo">newLabelTwo</label><div id="idLabelTwoDivRequired" class="divRequired" style="display: ;">*</div>', self::getInstanceOf()->addLabel('idLabelTwo', 'newLabelTwo', true, 'strLabelClass', 'strLabelStyle', array('name' => 'strName'), 'strFor')->getValue());
    }

}
