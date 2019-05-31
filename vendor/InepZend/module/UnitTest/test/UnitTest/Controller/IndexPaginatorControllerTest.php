<?php

namespace InepZend\Module\UnitTest\Controller;

use InepZend\Module\UnitTest\Controller\AbstractControllerTest;

class IndexPaginatorControllerTest extends AbstractControllerTest
{

    const CO_SUBCATEGORIA = 6;

    public function testIndexPaginator()
    {
        $this->evalCheckAssert('is_object($this->indexPaginatorAction(array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ') , \'no_subcategoria\', \'ASC\', 10, \'InepZend\Module\UnitTest\Service\Subcategoria\'))', true);
    }

    public function testIndexPaginator2()
    {
        $this->evalCheckAssert('$this->indexPaginatorAction(array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ') , \'no_subcategoria\', \'ASC\', 10, \'InepZend\Module\UnitTest\Service\Subcategoria\')', 'InepZend\View\View', 'assertInstanceOf', array('value', 'result'));
    }

    public function testAjaxPaginatorAction()
    {
        $this->evalCheckAssert('is_object($this->ajaxPaginatorAction($this->getService(\'InepZend\Module\UnitTest\Service\Subcategoria\')->findBy(array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ')), \'InepZend\Module\UnitTest\Service\Subcategoria\', null, null, 10, array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ')))', true);
    }

    /**
     * @depends testAjaxPaginatorAction
     */
    public function testAjaxPaginatorAction2()
    {
        $this->evalCheckAssert('get_class($this->ajaxPaginatorAction($this->getService(\'InepZend\Module\UnitTest\Service\Subcategoria\')->findBy(array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ')), \'InepZend\Module\UnitTest\Service\Subcategoria\', null, null, 10, array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ')))', 'InepZend\View\Model\View');
    }

    public function testAjaxFilterAction()
    {
        $this->evalCheckAssert('get_class($this->ajaxFilterAction($this->getService(\'InepZend\Module\UnitTest\Service\Subcategoria\')->findBy(array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . ')), true, $this->getForm(\'\ConsultaPublica\Form\SearchSchool\')))', 'InepZend\View\Model\View');
    }

    public function testSetInfoAjaxFilter()
    {
        $this->evalCheckAssert('$this->setInfoAjaxFilter(null, $this->getEntityManager()->createQuery(\'select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ' . self::CO_SUBCATEGORIA . '\'))', true);
    }

    /**
     * @depends testSetInfoAjaxFilter
     */
    public function testGetInfoAjaxFilter()
    {
        $this->evalCheckAssert('get_class($this->getInfoAjaxFilter())', 'InepZend\Session\Session');
    }

    public function testClearInfoAjaxFilter()
    {
        $this->evalCheckAssert('$this->clearInfoAjaxFilter()', true);
    }

    public function testSetInfoAjaxPaginator()
    {
        $this->evalCheckAssert('$this->setInfoAjaxPaginator(1, 10, \'no_subcategoria\', \'ASC\', $arrCriteria = array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . '), \'InepZend\Module\UnitTest\Entity\Subcategoria\', \'InepZend\Module\UnitTest\Service\Subcategoria\')', true);
    }

    /**
     * @depends testSetInfoAjaxPaginator
     */
    public function testGetInfoAjaxPaginator()
    {
        $this->evalCheckAssert('is_array($this->getInfoAjaxPaginator())', false);
    }

    public function testClearInfoAjaxPaginator()
    {
        $this->evalCheckAssert('$this->clearInfoAjaxPaginator()', true);
    }

    /**
     * Os 'depends' sao necessarios por haver dados na sessao que precisam ser limpos
     * antes da execucao do metodo 'getPaginator', visto que internamente faz
     * referencia ao metodo 'ajaxFilterAction' testado nessa mesma classe.
     * 
     * @depends testClearInfoAjaxFilter
     * @depends testClearInfoAjaxPaginator
     */
    public function testGetPaginator()
    {
        $this->evalCheckAssert('get_class($this->getPaginator($this->getEntityManager()->createQuery(\'select subcategoria from InepZend\Module\UnitTest\Entity\Subcategoria subcategoria where subcategoria = ' . self::CO_SUBCATEGORIA . '\'), 1, 10, \'no_subcategoria\', \'ASC\', array(\'co_subcategoria\' => ' . self::CO_SUBCATEGORIA . '), \'InepZend\Module\UnitTest\Service\Subcategoria\'))', 'InepZend\Paginator\Paginator');
    }

}
