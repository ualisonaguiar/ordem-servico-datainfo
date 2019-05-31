<?php

namespace InepZend\Filter;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Filter\Filter;
use InepZend\Util\Reflection;

class FilterSpecificTest extends AbstractUnitTest
{

    const NAMESPACE_REQUEST = 'Zend\Http\PhpEnvironment\Request';
    const NAMESPACE_FILTER = 'InepZend\Filter\Filter';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_FILTER, self::getInstanceOf());
    }

    public function testSetShortNameForm()
    {
        $this->assertEquals('Teste Filter', Reflection::invokeNotAccessibleMethod(self::getInstanceOf(), 'setShortNameForm','Teste Filter'));
    }
    
    public function testGetShortNameForm()
    {
        $this->assertEquals('Teste Filter', self::getInstanceOf()->getShortNameForm());
    }

    private function getInstance($strName = null, $arrOptions = null)
    {
        if ((is_null($strName)) && (is_null($arrOptions))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof Filter))
                self::setInstanceOf(new Filter());
        } else
            self::setInstanceOf(new Filter($strName, $arrOptions));
        return self::getInstanceOf();
    }

}
