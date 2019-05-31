<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Module\UnitTest\Controller\AbstractControllerTest;

class IndexCrudControllerTest extends AbstractControllerTest
{

    const CO_CATEGORIA = 6;
    const CO_SUBCATEGORIA = 6;
    const CO_SUBCATEGORIA_TESTE = 999;

    public $strController = '//strController//test';

    public function testIndexAction()
    {
        $this->evalCheckAssert('is_object(\InepZend\Controller\AbstractCrudController::indexAction())', true);
    }

    /**
     * @depends testIndexAction
     */
    public function testIndexAction2()
    {
        $this->evalCheckAssert('get_class(\InepZend\Controller\AbstractCrudController::indexAction())', 'InepZend\View\View');
    }

    public function testAddAction()
    {
        $this->evalCheckAssert('!is_null($this->addAction($this->dataFormPopulate(' . self::CO_SUBCATEGORIA_TESTE . '), \'\InepZend\Module\UnitTest\Entity\Subcategoria\', \'unittest_controller\', \'InepZend\Module\UnitTest\Service\Subcategoria\'))', true);
    }

    /**
     * @depends testAddAction
     */
    public function testAddAction2()
    {
        $this->evalCheckAssert('get_class($this->addAction($this->dataFormPopulate(' . self::CO_SUBCATEGORIA_TESTE . '), $this->dataSubcategoriaToArray(' . self::CO_SUBCATEGORIA_TESTE . '), \'InepZend\Module\UnitTest\Entity\Subcategoria\', \'unittest_controller\', \'InepZend\Module\UnitTest\Service\Subcategoria\'))', 'InepZend\View\View');
    }

    public function testEditAction()
    {
        $this->evalCheckAssert('is_object($this->editAction($this->dataFormPopulate(), $this->dataSubcategoriaToArray(), \'\InepZend\Module\UnitTest\Entity\Subcategoria\', \'unittest_controller\', \'InepZend\Module\UnitTest\Service\Subcategoria\', array(\'co_subcategoria\')))', true, null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
    }

    /**
     * @depends testEditAction
     */
    public function testEditAction2()
    {
        $this->evalCheckAssert('get_class($this->editAction($this->dataFormPopulate(), $this->dataSubcategoriaToArray(), \'\InepZend\Module\UnitTest\Entity\Subcategoria\', \'unittest_controller\', \'InepZend\Module\UnitTest\Service\Subcategoria\', array(\'co_subcategoria\')))', 'Zend\Http\PhpEnvironment\Response', null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
    }

    public function testGetDataToForm()
    {
        $this->evalCheckAssert('is_array($this->getDataToForm($this->dataFormPopulate(), $this->dataSubcategoriaToArray()))', true);
    }

    public function testGetEntityToForm()
    {
        $this->evalCheckAssert('get_class(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getEntityToForm\', array(\'co_subcategoria\' => self::CO_SUBCATEGORIA), \'InepZend\Module\UnitTest\Service\Subcategoria\', \'unittest_controller\'))', 'Zend\Http\PhpEnvironment\Response', null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
    }

    public function testAddEditAction()
    {
        $this->evalCheckAssert('get_class(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'addEditAction\', \'insert\', $this->dataFormPopulate(self::CO_SUBCATEGORIA_TESTE), $this->dataSubcategoriaToArray(self::CO_SUBCATEGORIA_TESTE), \'InepZend\Module\UnitTest\Entity\Subcategoria\', \'unittest_controller\', \'InepZend\Module\UnitTest\Service\Subcategoria\'))', 'InepZend\View\View');
    }

    public function testGetFormEdited()
    {
        $this->evalCheckAssert('get_class(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getFormEdited\', $this->dataFormPopulate(self::CO_SUBCATEGORIA_TESTE), \'InepZend\Module\UnitTest\Entity\Subcategoria\'))', 'InepZend\Module\UnitTest\Form\SubcategoriaForm');
    }

    public function testExistsFieldset()
    {
        $this->evalCheckAssert('is_bool(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'existsFieldset\', $this->dataFormPopulate(self::CO_SUBCATEGORIA)))', true);
    }

    public function testGetBar()
    {
        $this->evalCheckAssert('(\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getBar\', $this->strController))', '\\');
    }

    public function testGetNamespaceClass()
    {
        $this->evalCheckAssert('\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getNamespaceClass\', \'Service\', \'InepZend\Module\UnitTest\Controller\IndexController\')', 'InepZend\Module\UnitTest\Service\Index');
    }

    public function testGetRouteClass()
    {
        $this->evalCheckAssert('\InepZend\Util\Reflection::invokeNotAccessibleMethod($this, \'getRouteClass\', \'InepZend\Module\UnitTest\Controller\IndexController\')', 'index');
    }

    /**
     * 
     * @TODO Ao executar o teste nao continua.
     */
    public function testDeleteAction()
    {
        #$this->evalCheckAssert('is_object($this->deleteAction(array(\'co_subcategoria\')))', false, null, null, array('co_subcategoria' => self::CO_SUBCATEGORIA));
    }

    /**
     * @TODO Ao executar o teste nao continua.
     */
    public function testControlAfterSubmit()
    {
        #$this->evalCheckAssert('!is_null($this->controlAfterSubmit($this->dataFormPopulate(), $this->dataSubcategoriaToArray(), \'insert\', \'InepZend\Module\UnitTest\Service\Subcategoria\', \'unittest_controller\'))', true);
    }

}
