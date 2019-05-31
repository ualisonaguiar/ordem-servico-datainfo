<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Debug;
use InepZend\Util\Server;

class DebugSpecificTest extends AbstractUnitTest
{

    protected function setUp()
    {
        Debug::$booShow = false;
        return parent::setUp();
    }

    public function testSimpleDebug()
    {
        $this->assertNotRegExp('/xdebug-var-dump/', Debug::simpleDebug('PHPUnit'));
    }

    public function testSimpleDebug2()
    {
        $this->assertRegExp('/(Command.php|PHPUnitSimpleDebug)/', Debug::simpleDebug('PHPUnitSimpleDebug', false, 10));
    }

    public function testDebug()
    {
        $this->assertContains('DebugSpecificTest.php', Debug::debug('PHPUnit'));
    }

    public function testDebug2()
    {
        $this->assertContains('string(7) "PHPUnit"', Debug::debug('PHPUnit'));
    }

    public function testDebug3()
    {
        $this->assertContains('<b>line</b> ' . __LINE__, Debug::debug('PHPUnit'));
    }

    public function testDebug4()
    {
        $this->assertRegExp('/Educacionais|Teixeira/', Debug::debug('Inep - Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira '));
    }

    public function testDebug5()
    {
        $this->assertNotRegExp('/D I E/', Debug::debug('Inep - Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira '));
    }

    public function testDebugWS()
    {
        Debug::debugWS('PHPUnit');
        $this->assertFileExists($this->getDebugPathFile());
    }

    /**
     * @depends testDebugWS
     */
    public function testDebugWS2()
    {
        $this->assertRegExp('/DebugSpecificTest.php/', FileSystem::getContentFromFile($this->getDebugPathFile()));
    }

    /**
     * @depends testDebugWS
     */
    public function testDebugWs3()
    {
        $this->assertRegExp('/debugWS/', FileSystem::getContentFromFile($this->getDebugPathFile()));
    }

    public function testDebugWs4()
    {
        Debug::debugWS('PHPUnit');
        preg_match_all('/DebugSpecificTest/', FileSystem::getContentFromFile($this->getDebugPathFile()), $arrDebug);
        $this->assertCount(2, end($arrDebug));
    }

    public function testDebugWs5()
    {
        Debug::debugWS('PHPUnit', false, true);
        preg_match_all('/DebugSpecificTest/', FileSystem::getContentFromFile($this->getDebugPathFile()), $arrDebug);
        $this->assertCount(1, end($arrDebug));
        $this->removeFile($this->getDebugPathFile());
    }

    public function testDebugWs6()
    {
        Debug::debugWS('PHPUnit', false, true, true);
        Debug::debugWS('PHPUnit', false, true, false);
        $this->assertRegExp('/(Tempo Inicial|Tempo Final|Tempo Total)/', FileSystem::getContentFromFile($this->getDebugPathFile()));
        $this->removeFile($this->getDebugPathFile());
    }

    public function testDebugWs7()
    {
        Debug::debugWS('PHPUnit', false, true, true, Server::getReplacedBasePathApplication('/../../../../../data/debugWs.html'));
        Debug::debugWS('PHPUnit', false, true, false, Server::getReplacedBasePathApplication('/../../../../../data/debugWs.html'));
        $this->assertFileExists(Server::getReplacedBasePathApplication('/../../../../../data/debugWs.html'));
    }

    /**
     * @depends testDebugWs7
     */
    public function testDebugWs8()
    {
        $this->assertRegExp('/(Tempo Inicial|Tempo Final|Tempo Total)/', FileSystem::getContentFromFile(Server::getReplacedBasePathApplication('/../../../../../data/debugWs.html')));
        $this->removeFile(Server::getReplacedBasePathApplication('/../../../../../data/debugWs.html'));
    }

    public function removeFile($strPathFile)
    {
        if (file_exists($strPathFile))
            unlink($strPathFile);
    }

    private function getDebugPathFile()
    {
        return Server::getReplacedBasePathApplication('/../../../../../public/debug.htm');
    }

}
