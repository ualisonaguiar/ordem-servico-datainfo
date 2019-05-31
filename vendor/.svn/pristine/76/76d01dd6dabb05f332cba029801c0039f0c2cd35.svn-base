<?php

namespace InepZend\UnitTest;

use InepZend\UnitTest\AbstractRouteUnitTest;

/**
 * Classe abstrata responsavel pelos metodos especificos para aplicacao de testes
 * unitarios em metodos de uma classe de controller que herda a 
 * InepZend\Controller\AbstractCrudController, enviando requisicoes para rotas e
 * verificando o status das respostas caso seja necessario.
 * Nessa classe sao mapeados os testes de alguns metodos utilizados nas classes 
 * que herdam da AbstractCrudController.
 * 
 * [+] AbstractUnitTest
 *     [-] AbstractServiceCrudUnitTest
 *          [-] AbstractServiceUnitTest
 *     [-] AbstractRouteUnitTest
 *          [+] AbstractCrudUnitTest
 *              [-] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
abstract class AbstractCrudUnitTest extends AbstractRouteUnitTest
{

    protected $arrParamToEdit;

    /**
     * Metodo responsavel em verificar a rota da action indexAction().
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->checkActionCanBeAccessed($this->getControllerNamespace(), 'index', null, null, true);
    }

    /**
     * Metodo responsavel em verificar a rota da action addAction().
     * 
     * @return void
     */
    public function testAddActionCanBeAccessed()
    {
        $this->checkActionCanBeAccessed($this->getControllerNamespace(), 'add', null, null, true);
    }

    /**
     * Metodo responsavel em verificar a rota da action editAction().
     * 
     * @return void
     */
    public function testEditActionCanBeAccessed()
    {
        if (is_null($this->arrParamToEdit))
            return;
        $this->checkActionCanBeAccessed($this->getControllerNamespace(), 'edit', $this->arrParamToEdit, null, true);
    }

}
