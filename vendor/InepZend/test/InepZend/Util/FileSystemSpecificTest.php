<?php

namespace InepZend\Util;

use InepZend\UnitTest\AbstractUnitTest;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class FileSystemSpecificTest extends AbstractUnitTest
{
    
    const PATH_DATA = '/../../../../../data/';

    public function testGetMimeContentStructure()
    {
        $this->assertEquals(FileSystem::getMimeContentStructure()['html'], array('text/html', 'text/plain'));
        $this->assertEquals(array_key_exists('notExist', FileSystem::getMimeContentStructure()), false);
    }

    public function testUndir()
    {
        $this->assertEquals(mkdir($this->getPathData() . 'pathForTestOfFunctionUndirTDD', 0777, true), true);
        $this->assertEquals(FileSystem::undir($this->getPathData() . 'pathForTestOfFunctionUndirTDD'), null);
    }

    public function testGlobRecursive()
    {
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/', '', array('Util'), false, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/', '', array('Util'), true, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/', '', array('Util'), true, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/', '', array('Util'), false, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/Util/', '', array(), false, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/Util/', '', array(), true, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/Util/', '', array(), true, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::globRecursive('./vendor/InepZend/test/InepZend/Util/', '', array(), false, false, array())), false);
    }

    public function testScandirRecursive()
    {
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array('UtilTest'), false, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array('UtilTest'), true, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array('UtilTest'), true, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array('UtilTest'), false, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array(), false, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array(), true, true, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array(), true, false, array())), false);
        $this->assertEquals(in_array('./vendor/InepZend/test/InepZend/Util', FileSystem::scandirRecursive('./vendor/InepZend/library/InepZend/Util/', '', array(), false, false, array())), false);
    }

    public function testGetChmod()
    {
        $this->assertEquals(substr(FileSystem::getChmod($this->getPathData()), 0, 2), '07');
    }

    public function testGetPermission()
    {
        $this->assertEquals(substr(FileSystem::getPermission($this->getPathData()), 0, 4), 'drwx');
    }

    public function testGetPermissionMeaning()
    {
        $this->assertEquals(in_array('directory', FileSystem::getPermissionMeaning($this->getPathData())), true);
        $this->assertEquals((FileSystem::getPermissionMeaning($this->getPathData())['owner'][0]), 'read');
        $this->assertEquals((FileSystem::getPermissionMeaning($this->getPathData())['owner'][1]), 'write');
        $this->assertEquals((FileSystem::getPermissionMeaning($this->getPathData())['owner'][2]), 'execute');
    }
    
    private function getPathData()
    {
        return Server::getReplacedBasePathApplication(self::PATH_DATA);
    }

}
