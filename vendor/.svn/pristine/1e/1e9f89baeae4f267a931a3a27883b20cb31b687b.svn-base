<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\stdClass;

class stdClassSpecificTest extends AbstractUnitTest
{

    public function testConstruct()
    {
        $stdClass = new stdClass();
        $stdClass->attribute_name = 'attribute_value';
        $this->assertEquals(new stdClass(array('attribute_name' => 'attribute_value')), $stdClass);
    }

    public function testConstruct2()
    {
        $this->assertObjectHasAttribute('attribute_name', new stdClass(array('attribute_name' => 'attribute_value')));
    }

    public function testSetAllAttribute()
    {
        $this->assertEquals(true, \InepZend\Util\Reflection::invokeNotAccessibleMethod((new \InepZend\Util\stdClass()), 'setAllAttribute', array('param1' => 1, 'param2' => 2)));
    }

}
