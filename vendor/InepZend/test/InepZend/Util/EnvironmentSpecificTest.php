<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Environment;
use InepZend\Util\Server;

class EnvironmentSpecificTest extends AbstractUnitTest
{

    public function testGetEnvironmentFromIpServer()
    {
        (Server::getIpServer() === Environment::IP_LOCALHOST) ? $this->assertSame(Environment::LOCAL, Environment::getEnvironmentFromIpServer(false)) : $this->assertSame(Environment::DESENVOLVIMENTO, Environment::getEnvironmentFromIpServer(false));
    }

    public function testGetSufix()
    {
        $this->assertSame('_DESENV', Environment::getSufix());
    }

}
