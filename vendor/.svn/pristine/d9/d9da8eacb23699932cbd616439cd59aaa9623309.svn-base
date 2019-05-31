<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Module\UnitTest\Controller\AbstractControllerTest;

class IndexRepositoryControllerTest extends AbstractControllerTest
{

    const CO_CATEGORIA = 6;
    const CO_SUBCATEGORIA = 6;
    const LIMIT = 1;
    const OFFSET = 2;
    const VALUE_TEST = 441;

    public function testAjaxFetchPairsAction()
    {
        $this->evalCheckAssert('is_object($this->ajaxFetchPairsAction(array(\'categoria\' => ' . self::CO_CATEGORIA . '), \'InepZend\Module\UnitTest\Service\Index\'))', true);
    }

    /**
     * @depends testAjaxFetchPairsAction
     */
    public function testAjaxFetchPairsAction2()
    {
        $this->evalCheckAssert('is_object($this->ajaxFetchPairsAction(array(), \'InepZend\Module\UnitTest\Service\Categoria\'))', true);
    }

    /**
     * @depends testAjaxFetchPairsAction
     */
    public function testAjaxFetchPairsAction3()
    {
        $this->evalCheckAssert('get_class($this->ajaxFetchPairsAction(array(), \'InepZend\Module\UnitTest\Service\Categoria\'))', 'InepZend\View\Model\View');
    }

    public function testGetEntityManager()
    {
        $this->evalCheckAssert('get_class($this->getEntityManager())', 'Doctrine\ORM\EntityManager');
    }

    public function testGetRepositoryEntity()
    {
        $this->evalCheckAssert('get_class(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getRepositoryEntity\', \'InepZend\Module\UnitTest\Entity\Subcategoria\'))', 'InepZend\Module\UnitTest\Entity\SubcategoriaRepository');
    }

    public function testGetPkFromRoute()
    {
        $this->evalCheckAssert('$this->getPkFromRoute()', self::CO_SUBCATEGORIA, null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
    }

    public function testGetPkFromRoute2()
    {
        $this->evalCheckAssert('$this->getPkFromRoute(array(\'co_categoria\'))', self::CO_CATEGORIA, null, null, array('co_categoria' => self::CO_CATEGORIA));
    }

}
