<?php

namespace InepZend\UnitTest;

use InepZend\UnitTest\AbstractUnitTest;

/**
 * Classe abstrata responsavel pelos metodos especificos para aplicacao de testes
 * unitarios em metodos de uma classe de servico.
 * 
 * [-] AbstractUnitTest
 *     [+] AbstractServiceCrudUnitTest
 *          [-] AbstractServiceUnitTest
 *     [-] AbstractRouteUnitTest
 *          [-] AbstractCrudUnitTest
 *              [-] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
class AbstractServiceCrudUnitTest extends AbstractUnitTest
{

    protected static $serviceInstance;

    /**
     * Metodo responsavel em iniciar a transacao com o banco de dados e setar o
     * namespace e a instancia do servico a ter os metodos testados unitariamente
     * caso haja a necessidade.
     * Realiza a invocacao e sobrescrita do metodo setUp() da classe AbstractUnitTest.
     * Eh acionado sempre antes da invocacao de um metodo de teste unitario.
     * 
     * @param string $strService
     * @return void
     */
    protected function setUp($strService = null)
    {
        parent::setUp();
        $this->checkSetServiceInstance($strService);
        $this->init();
    }

    /**
     * Metodo responsavel em finalizar a transacao com o banco de dados aplicando
     * um comando rollback.
     * Realiza a invocacao e sobrescrita do metodo tearDown() da classe AbstractUnitTest.
     * Eh acionado sempre depois da invocacao de um metodo de teste unitario.
     * 
     * @return void
     */
    protected function tearDown()
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Metodo responsavel em setar estaticamente a instancia do servico a ter os
     * metodos testados unitariamente.
     * 
     * @param object $serviceInstance
     * @return boolean
     */
    protected static function setServiceInstance($serviceInstance = null)
    {
        return (self::$serviceInstance = $serviceInstance);
    }

    /**
     * Metodo responsavel em retornar a instancia estatica do servico a ter os metodos 
     * testados unitariamente.
     * 
     * @return object
     */
    protected static function getServiceInstance()
    {
        return self::$serviceInstance;
    }

    /**
     * Metodo responsavel em iniciar o teste unitario de um metodo com a abertura 
     * de uma transacao realizando a invocacao do metodo begin() da classe AbstractUnitTest.
     * 
     * @return void
     */
    private function init()
    {
        $this->begin();
    }

    /**
     * Metodo responsavel em finalizar o teste unitario de um metodo com a revercao
     * dos dados manipulados e encerramento da transacao realizando a invocacao
     * do metodo rollback() da classe AbstractUnitTest.
     * 
     * @return void
     */
    private function finish()
    {
        $this->rollback();
    }

    /**
     * Metodo responsavel em setar estaticamente a instancia do servico parametrizado.
     * 
     * @param string $strService
     * @return boolean
     */
    private function setAttributeFromService($strService = null)
    {
        if (!empty($strService)) {
            self::setServiceInstance($this->getService($strService));
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em realizar verificacoes e caso seja necessario seta a
     * instancia do servico.
     * 
     * @param string $strService
     * @return boolean
     */
    private function checkSetServiceInstance($strService = null)
    {
        if (!empty($strService)) {
            if (!is_object(self::getServiceInstance()))
                return $this->setAttributeFromService($strService);
            if ((is_object(self::getServiceInstance())) && (get_class(self::getServiceInstance()) != $strService))
                return $this->setAttributeFromService($strService);
        }
        return false;
    }

}
