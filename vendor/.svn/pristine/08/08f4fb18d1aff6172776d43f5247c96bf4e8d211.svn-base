<?php

namespace InepZend\Filter;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Filter\Filter;
use InepZend\Util\Reflection;

class InputFilterSpecificTest extends AbstractUnitTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('InepZend\Filter\Filter', self::getInstanceOf());
    }

    public function testAddDefault()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addDefault', null));
    }

    public function testAddDefault2()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addDefault', array('TestElement', 'required' => true, 'filters' => array('Word\UnderscoreToCamelCase'))));
    }

    public function testAddFilter()
    {
        $arrFilter = array("name" => "TestElementAdd", "required" => true);
        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addFilters', $arrFilter, "", array()));
    }

    public function testGetFilter()
    {
        $this->assertInternalType('array', self::getInstanceOf()->getFilter('TestElement'));
    }

    public function testAddValidators()
    {
        $arrValidators = array("name" => "TestValidatorAdd");
        $this->assertNull(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addValidators', $arrValidators, "Alnum", array()));
    }

    public function testDelFiltersGeneric()
    {
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'delGeneric', $this->setarrElement(), 'filters', 'StripTags'));
    }

    public function testDelFiltersGeneric2()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'delGeneric', $this->setArrElement(), 'filters', ''));
    }

    public function testDelFiltersGeneric3()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'delGeneric', $this->setArrElement(), '', 'StripTags'));
    }

    public function testDelFiltersGeneric4()
    {
        $this->assertFalse(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'delGeneric', $this->setArrElement(), '', ''));
    }

    public function testRemoveFilter()
    {
        $this->assertFalse(self::getInstanceOf()->removeFilter(''));
    }

    public function testRemoveFilter2()
    {
        $arrElement = self::getInstanceOf()->removeFilter('TestElement');
        if (!(empty($arrElement)))
            throw new \Exception('Erro de validação.');
        Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'addDefault', array('TestElement', 'required' => true, 'filters' => array('Word\UnderscoreToCamelCase')));
    }
    
    public function testCreateFiltersValidators()
    {
        $arrElement = array('TestElement', 'required' => true, 'filters' => array('Word\UnderscoreToCamelCase'));
        $this->assertTrue(Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'createFiltersValidators', $arrElement));
    }

    private function setArrElement()
    {
        return $arrElement = array(
            "name" => "Generic",
            "required" => (false),
            "filters" => array(
                array(
                    "name" => "StripTags"
                ),
                array("name" => "StringTrim"
                )
            )
        );
    }

//
//    private function addElementTest()
//    {
//        return self::getInstanceOf()->addFilterPhone(self::NAME_ELEMENT);
//    }
//
//    private function getFilterTest()
//    {
//        $this->addElementTest();
//        return self::getInstanceOf()->getFilter(self::NAME_ELEMENT);
//    }

    private function getInstance($strName = null)
    {
        if ((is_null($strName))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Filter))
                self::setInstanceOf(new Filter());
        } else
            self::setInstanceOf(new Filter($strName));
        return self::getInstanceOf();
    }

}
