<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\UnitTest\AbstractServiceUnitTest;
use InepZend\Util\Reflection;

class IndexCoreCacheTest extends AbstractServiceUnitTest
{

    protected function setUp()
    {
        parent::setUp('InepZend\Module\UnitTest\Service\Index');
    }

    public function testInstanceObject()
    {
        $this->assertInstanceOf('InepZend\Module\UnitTest\Service\Index', self::getServiceInstance());
    }

    public function testSetItemCache()
    {
        $this->assertInternalType('boolean', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'setItemCache', 'chaveTest', 'valorTeste'));
    }

    /**
     * @depends testSetItemCache
     */
    public function testGetItemCache()
    {
        $this->assertSame('valorTeste', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getItemCache', 'chaveTest'));
    }

    public function testGetNamespaceCache()
    {
        $this->assertSame('InepSkeleton_Cache', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getNamespaceCache', null));
    }

    public function testGetAllKeyClass()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllKeyClass', null));
    }

    public function testGetAllItemCache()
    {
        $this->assertInternalType('array', Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null));
    }

    /**
     * @depends testSetItemCache
     */
    public function testHasItemCache()
    {
        $this->assertSame(true, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'hasItemCache', "chaveTest"));
    }

    public function testGetCache()
    {
        $this->assertNotNull(Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getCache', null));
    }

    public function testSetKeyClass()
    {
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'setKeyClass', 'chaveTest2');
        $this->assertSame(true, in_array("chaveTest2", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllKeyClass', null)));
    }

    public function testSetAllItemCache()
    {
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'setAllItemCache', array('insertItenOne' => 0, 'insertItenTwo' => 1));
        $this->assertSame(true, in_array("insertItenOne", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null)));
        $this->assertSame(true, in_array("insertItenTwo", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null)));
    }

    /**
     * @depends testSetAllItemCache
     */
    public function testRemoveItemCache()
    {
        $this->assertSame(true, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeItemCache', 'insertItenOne'));
        $this->assertSame(true, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeItemCache', 'insertItenTwo'));
        $this->assertSame(false, in_array("insertItenOne", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null)));
        $this->assertSame(false, in_array("insertItenTwo", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null)));
    }

    public function testGenerateKey()
    {
        $this->assertSame("e55bdd51b345091f81749b53c9ab569f", Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'generateKey', 'method', 'paramiters'));
    }

    /**
     * @depends testGenerateKey
     * @TODO Criar cenario na classe onde possa utilizar a execucao de um metodo herdado.
     *       Ex.: Existe um metodo no escopo proprio ou pai (this | parent::) e que esteja em cache, e executar o mesmo
     *            verificando o retorno.
     */
    public function testControlCache()
    {
        $this->assertSame(true, Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'controlCache', 'method', 'paramiters'));
    }

    public function testRemoveAllItemCache()
    {
        Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'removeAllItemCache', null);
        $this->assertSame(array(), Reflection::invokeNotAccessibleMethod(self::getServiceInstance(), 'getAllItemCache', null));
    }

}
