<?php

namespace InepZend\Form;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\FormGenerator\FormGenerator;

class AbstractSpecificTest extends AbstractUnitTest
{
    const NAMESPACE_FORMGENERATOR = 'InepZend\FormGenerator\FormGenerator';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }
    
    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_FORMGENERATOR, self::getInstanceOf());
    }
    
    private function getInstance($strName = null, $arrOptions = null)
    {
        if ((is_null($strName)) && (is_null($arrOptions))) {
            if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof FormGenerator))
                self::setInstanceOf(new FormGenerator());
        } else
            self::setInstanceOf(new FormGenerator($strName, $arrOptions));
        return self::getInstanceOf();
    }
}