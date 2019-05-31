<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Server;

class ServerSpecificTest extends AbstractUnitTest
{

    protected function setUp()
    {
        Server::setAttributeStatic('arrInfoBrowser', null);
        Server::setAttributeStatic('strIpUser', null);
        Server::setAttributeStatic('strServerProtocol', null);
        Server::setAttributeStatic('intPort', null);
        Server::setAttributeStatic('strHost', null);
        parent::setUp();
    }

    /**
     * @dataProvider listBrowser
     */
    public function testGetBrowser($strNameAgentBrowser, $strNameBrowser, $strVersion)
    {
        $_SERVER['HTTP_USER_AGENT'] = $strNameAgentBrowser;
        $this->assertSame(array('browser' => $strNameBrowser, 'version' => $strVersion), Server::getBrowser());
    }

    /**
     * @dataProvider listIp
     */
    public function testGetIp($strIp)
    {
        $_SERVER['HTTP_NS_CLIENT_IP'] = $strIp;
        $this->assertSame($strIp, Server::getIp());
        unset($_SERVER['HTTP_NS_CLIENT_IP']);
    }

    /**
     * @dataProvider listIp
     */
    public function testGetIp2($strIp)
    {
        $_SERVER['REMOTE_ADDR'] = $strIp;
        $this->assertSame($strIp, Server::getIp());
        unset($_SERVER['REMOTE_ADDR']);
    }

    /**
     * @dataProvider listIp
     */
    public function testGetIp3($strIp)
    {
        $_SERVER['REMOTE_ADDR'] = str_replace('.', '-', $strIp);
        $this->assertSame(str_replace(array('.', '-'), '', $strIp), Server::getIp(true));
        unset($_SERVER['REMOTE_ADDR']);
    }

    public function testGetServerProtocol()
    {
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $this->assertSame('http://', Server::getServerProtocol());
    }

    /**
     * @dataProvider listPortServer
     */
    public function testGetPort($intPort)
    {
        $_SERVER['SERVER_PORT'] = $intPort;
        $this->assertSame($intPort, Server::getPort(true));
    }

    /**
     * @dataProvider listHostPortServer
     */
    public function testGetPort1($strHostPort)
    {
        $_SERVER['HTTP_HOST'] = $strHostPort;
        $this->assertSame(end($arrExplode = explode(':', $strHostPort)), Server::getPort(false));
        unset($_SERVER['HTTP_HOST']);
    }

    /**
     * @depends testGetServerProtocol
     * @depends testGetPort
     * @dataProvider listServerName
     */
    public function testGetHost($strNameServer)
    {
        $_SERVER['SERVER_NAME'] = $strNameServer;
        $this->assertSame('http://' . $strNameServer . ':8081/', Server::getHost());
    }

    public function listServerName()
    {
        return array(
            array('localhost'),
            array('desenvphp.inep.gov.br'),
            array('tqsphp.inep.gov.br'),
            array('homologaphp.inep.gov.br'),
        );
    }

    public function listHostPortServer()
    {
        return array(
            array('localhost:' . 80),
            array('desenvphp.inep.gov.br:' . 81),
            array('tqsphp.inep.gov.br:' . 8080),
            array('homologaphp.inep.gov.br:' . 8081),
        );
    }

    public function listPortServer()
    {
        return array(
            array(80),
            array(81),
            array(8080),
            array(8081),
        );
    }

    public function listIp()
    {
        return array(
            array('127.0.0.1'),
            array('1.9.3.18'),
            array('191.253.1.5'),
            array('193.5.58.16'),
            array('127-0-0-1'),
            array('1-9-3-18'),
            array('191-253-1-5'),
            array('193-5-58-16'),
        );
    }

    public function listBrowser()
    {
        return array(
            array(
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36',
                'Chrome',
                '36.0.1985.125'
            ),
            array(
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)',
                'Msie',
                '9.0'
            ),
            array(
                'Mozilla/5.0 (X11; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Firefox',
                '31.0'
            ),
            array(
                'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2',
                'Safari',
                '5.1.7'
            ),
            array(
                'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36 OPR/23.0.1522.72',
                'Opera',
                '23.0.1522.72'
            ),
        );
    }

}
