<?php

namespace InepZend\Form;

use InepZend\Form\AbstractSpecificTest;

class GroupSpecificTest extends AbstractSpecificTest
{

    public function testAddGroup()
    {
        $this->assertInstanceOf('InepZend\FormGenerator\FormGenerator', self::getInstanceOf()->addGroup());
    }
    
    public function testAddGroup2()
    {
        $this->assertNotEquals('<div class="well" style="overflow: hidden;"><h3></h3>', reset(self::getInstanceOf()->addGroup(array('type' => 'DadoBancario'))->getIterator()->getIterator()->toArray())->getValue());
    }

}
