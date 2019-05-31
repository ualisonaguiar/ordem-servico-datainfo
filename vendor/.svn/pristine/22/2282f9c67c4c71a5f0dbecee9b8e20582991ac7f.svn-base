<?php

namespace InepZend\UnitTest;

use InepZend\UnitTest\AbstractServiceCrudUnitTest;

/**
 * Classe abstrata responsavel pelos metodos especificos para aplicacao de testes
 * unitarios em metodos de uma classe de servico.
 * 
 * [-] AbstractUnitTest
 *     [-] AbstractServiceCrudUnitTest
 *          [+] AbstractServiceUnitTest
 *     [-] AbstractRouteUnitTest
 *          [-] AbstractCrudUnitTest
 *              [-] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
class AbstractServiceUnitTest extends AbstractServiceCrudUnitTest
{

    private $strService;

    /**
     * Metodo construtor responsavel em setar o namespace do servico a ter os metodos
     * testados unitariamente.
     * 
     * @param string $strService
     * @return void
     */
    public function __construct($strService = null)
    {
        $strClass = get_class($this);
        if ((empty($strService)) && (strpos($strClass, 'Test') !== false))
            $strService = str_replace('Test', '', $strClass);
        if (!empty($strService))
            $this->setServiceNamespace($strService);
    }

    /**
     * Metodo responsavel em verificar se a instancia da classe de servico eh realmente
     * a da classe a ser utilizada pelos demais testes unitarios.
     * 
     * @return void
     */
//    public abstract function testInstanceObject();

    /**
     * Metodo responsavel em setar o namespace do servico a ter os metodos testados
     * unitariamente.
     * Realiza a invocacao e sobrescrita do metodo setUp() da classe AbstractServiceCrudUnitTest.
     * Eh acionado sempre antes da invocacao de um metodo de teste unitario.
     * 
     * @param string $strService
     * @return void
     */
    protected function setUp($strService = null)
    {
        if (empty($strService))
            $strService = $this->getServiceNamespace();
        else
            $this->setServiceNamespace($strService);
        parent::setUp($strService);
    }

    /**
     * Metodo responsavel em setar o namespace do servico no respectivo atributo.
     * 
     * @param string $strService
     * @return object
     */
    protected function setServiceNamespace($strService = null)
    {
        $this->strService = $strService;
        return $this;
    }

    /**
     * Metodo responsavel em setar o namespace do servico no respectivo atributo.
     * 
     * @return string
     */
    protected function getServiceNamespace()
    {
        return $this->strService;
    }

}
