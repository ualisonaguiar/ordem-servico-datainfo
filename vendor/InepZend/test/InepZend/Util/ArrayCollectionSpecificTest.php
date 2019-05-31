<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\ArrayCollection;

class ArrayCollectionSpecificTest extends AbstractUnitTest
{

    public function testCreateEmptyParam()
    {
        $arrEmpty = array('key1', 'key2', 5);
        $arrParam = array('key0' => 'value0', 1 => 'number');
        ArrayCollection::createEmptyParam($arrEmpty, $arrParam);
        $this->assertSame($arrParam, array('key0' => 'value0', 1 => 'number', 'key1' => '', 'key2' => '', 5 => ''));
    }

    public function testClearEmptyParam()
    {
        $arrParam = array('key0' => 'value0', 'key1' => 'value1', 'key2' => '');
        ArrayCollection::clearEmptyParam($arrParam);
        $this->assertSame($arrParam, array('key0' => 'value0', 'key1' => 'value1'));
    }

    public function testUnsetParam()
    {
        $mixUnset = array('key2', 'key3');
        $arrParam = array('key0' => 'value0', 'key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3');
        ArrayCollection::unsetParam($mixUnset, $arrParam);
        $this->assertSame($arrParam, array('key0' => 'value0', 'key1' => 'value1'));
    }

    public function testUnsetParam2()
    {
        $mixUnset = 'key2';
        $arrParam = array('key0' => 'value0', 'key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3');
        ArrayCollection::unsetParam($mixUnset, $arrParam);
        $this->assertSame($arrParam, array('key0' => 'value0', 'key1' => 'value1', 'key3' => 'value3'));
    }

    public function testArrayWalkRecursiveUtf8Decode()
    {
        $arrTest = array(1 => 'Ã©Ã¡ÃºÃ±gÅ.');
        array_walk_recursive($arrTest, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveUtf8Decode');
        $this->assertEquals(array(1 => 'éáúñgœ.'), $arrTest);
    }

    public function testArrayWalkRecursiveUtf8Encode()
    {
        $arrTest = array(1 => 'éáú.');
        array_walk_recursive($arrTest, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveUtf8Encode');
        $this->assertEquals(array(1 => 'Ã©Ã¡Ãº.'), $arrTest);
    }

    public function testAWalkRecursiveAddSingleQuotes()
    {
        $arrTest = array(1 => "alter", "alterTwo", 3, 4);
        array_walk_recursive($arrTest, '\InepZend\Util\ArrayCollection::arrayWalkRecursiveAddSingleQuotes');
        $this->assertEquals(array(1 => '\'alter\'', '\'alterTwo\'', 3, 4), $arrTest);
    }

}
