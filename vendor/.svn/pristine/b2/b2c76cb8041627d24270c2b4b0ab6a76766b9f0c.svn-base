<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\Uri;
use InepZend\Util\Environment;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class UriSpecificTest extends AbstractUnitTest
{

    const PATH = '/../../../../../data/testeUnit/';
    const HOST_BINARY_CONTENT = 'www.google.com.br';
    const STRING_BINARY_CONTENT = 'google';

    public function testExecUrl()
    {
        $this->assertRegExp('/1.1 200 OK/', Uri::execUrl(Environment::IP_TQS));
    }

    public function testExecUrl2()
    {
        $this->assertRegExp('/phpinfo()/', Uri::execUrl(Environment::IP_TQS, 'outros/info.php'));
    }

    public function testExecUrl3()
    {
        $this->assertRegExp('/1.1 200 OK/', Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php'));
    }

    public function testExecUrl4()
    {
        $this->assertRegExp('/1.1 200 OK/', Uri::execUrl('demandas.inep.gov.br', 'cadastrar_usuario.php', null, null, null, 'POST', 'usucpf=123.456.789-10&usuemail=teste@inep.gov.br'));
    }

/*    public function testGetBinaryContent()
    {
        $this->assertContains(self::STRING_BINARY_CONTENT, (string) Uri::getBinaryContent(self::HOST_BINARY_CONTENT));
    }

  public function testGetBinaryContent2()
    {
        $strPath = Server::getReplacedBasePathApplication(self::PATH);
        if (!is_dir($strPath))
            mkdir($strPath, 0777, true);
        Uri::getBinaryContent(self::HOST_BINARY_CONTENT, $strPath . 'portal.html');
        $this->assertFileExists($strPath . 'portal.html');
    }

    public function testGetBinaryContent3()
    {
        $strPath = Server::getReplacedBasePathApplication(self::PATH);
        $strContent = FileSystem::getContentFromFile($strPath . 'portal.html');
        $this->assertRegExp('/' . self::STRING_BINARY_CONTENT . '/', $strContent);
        FileSystem::undir($strPath);
    }

    public function testGetBinaryContent4()
    {
        $arrProxyConfig = $this->getService('Config')['proxy']['params'];
        $this->assertRegExp('/' . self::STRING_BINARY_CONTENT . '/', (string) Uri::getBinaryContent(self::HOST_BINARY_CONTENT, null, $arrProxyConfig['proxyHost'], $arrProxyConfig['proxyPort']));
    }*/

    public function testGetProxyConfig()
    {
        $this->assertNotEmpty(Uri::getProxyConfig());
    }

    public function testGetProxyConfig2()
    {
        $arrProxyConfig = $this->getService('Config')['proxy']['params'];
        $GLOBALS['proxyConfig'] = $arrProxyConfig;
        $this->assertEquals($arrProxyConfig, Uri::getProxyConfig());
    }

}
