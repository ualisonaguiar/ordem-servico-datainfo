<?php

namespace InepZend\Form;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\FormGenerator\FieldsetGenerator;

class FieldsetGeneratorSpecificTest extends AbstractUnitTest
{

//    protected function setUp()
//    {
//        parent::setUp();
//    }

    public function testInstanceButtonOf()
    {
        self::setInstanceOf(new FieldsetGenerator());
        $this->assertInstanceOf('InepZend\FormGenerator\FieldsetGenerator', self::getInstanceOf());
    }

}
