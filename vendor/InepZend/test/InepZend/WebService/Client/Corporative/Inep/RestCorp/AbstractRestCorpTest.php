<?php
namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\WebService\Client\Corporative\Inep\RestCorp;
use InepZend\UnitTest\AbstractUnitTest;

class AbstractRestCorpTest extends AbstractUnitTest
{

    const NAMESPACE_TEST = 'InepZend\WebService\Client\Corporative\Inep\RestCorp';

    protected function setUp()
    {
        parent::setUp();
        $this->getInstance();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(self::NAMESPACE_TEST, self::getInstanceOf());
    }

    private function getInstance()
    {
        if ((is_null(self::getInstanceOf())) || (!self::getInstanceOf() instanceof RestCorp))
            self::setInstanceOf(new RestCorp());

        return self::getInstanceOf();
    }

    public function arrayToObject($array)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
                $array[$key] = $this->arrayToObject($value);
        }

        return (object)$array;
    }

}