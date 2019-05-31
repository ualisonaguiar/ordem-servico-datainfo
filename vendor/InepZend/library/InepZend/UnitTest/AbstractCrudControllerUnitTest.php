<?php

namespace InepZend\UnitTest;

use InepZend\UnitTest\AbstractCrudUnitTest;

/**
 * Classe abstrata responsavel pelos metodos especificos para aplicacao de testes
 * unitarios em metodos de uma classe de controller que herda a 
 * InepZend\Controller\AbstractCrudController, enviando requisicoes para rotas e
 * verificando o status das respostas caso seja necessario.
 * Todas as actions das classes InepZend\Controller\AbstractCrudController e 
 * InepZend\Controller\AbstractControllerPaginator possuem algum teste unitario
 * implementado.
 * 
 * [-] AbstractUnitTest
 *     [-] AbstractServiceCrudUnitTest
 *          [-] AbstractServiceUnitTest
 *     [-] AbstractRouteUnitTest
 *          [-] AbstractCrudUnitTest
 *              [+] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
abstract class AbstractCrudControllerUnitTest extends AbstractCrudUnitTest
{

    /**
     * Metodo responsavel em verificar a rota da action indexAction().
     * 
     * @return void
     */
    public function testIndexAction()
    {
        return $this->testIndexActionCanBeAccessed();
    }

    /**
     * Metodo responsavel em verificar a rota da action addAction().
     * 
     * @return void
     */
    public function testAddAction()
    {
        return $this->testAddActionCanBeAccessed();
    }

    /**
     * Metodo responsavel em verificar a rota da action editAction().
     * 
     * @return void
     */
    public function testEditAction()
    {
        return $this->testEditActionCanBeAccessed();
    }

    /**
     * @TODO implementar os testes unitarios de TODAS as actions da InepZend\Controller\AbstractCrudController e InepZend\Controller\AbstractControllerPaginator, utilizando ou nao o construct
     */

    /**
     * Metodo responsavel em criar todos os data provider para execucao de casos
     * de teste.
     * 
     * @return array
     */
    protected function createAllDataProvider()
    {
        return array();
    }

}
