<?php

namespace InepZend\UnitTest;

use InepZend\UnitTest\AbstractUnitTest;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Zend\Http\Request;

/**
 * Classe abstrata responsavel pelos metodos especificos para aplicacao de testes
 * unitarios em metodos de uma classe de controller, enviando requisicoes para
 * rotas/actions e verificando o status das respostas caso seja necessario.
 * 
 * [-] AbstractUnitTest
 *     [-] AbstractServiceCrudUnitTest
 *          [-] AbstractServiceUnitTest
 *     [+] AbstractRouteUnitTest
 *          [-] AbstractCrudUnitTest
 *              [-] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
abstract class AbstractRouteUnitTest extends AbstractUnitTest
{

    const RESPONSE_STATUS_CODE_OK = 200;
    const RESPONSE_STATUS_CODE_FOUND = 302;
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_GET = 'GET';

    private $strController;
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    /**
     * Metodo construtor responsavel em setar o namespace do servico a ter os metodos
     * testados unitariamente.
     * 
     * @param string $strController
     * @param array $arrAllDataProvider
     * @return void
     */
    public function __construct($strController = null, $arrAllDataProvider = null)
    {
        $strClass = get_class($this);
        if ((empty($strController)) && (strpos($strClass, 'Test') !== false))
            $strController = str_replace('Test', '', $strClass);
        if (!empty($strController)) {
            $this->setControllerNamespace($strController);
            $this->setControllerInstance(new $strController());
        }
        if (!is_array($arrAllDataProvider))
            $arrAllDataProvider = $this->createAllDataProviderStatic();
        else
            $this->setAllDataProvider($arrAllDataProvider);
    }

    /**
     * Metodo responsavel em executar todos os data provider para os casos de teste.
     * 
     * @return void
     */
    public function testAllDataProvider()
    {
        $arrAllDataProvider = $this->getDataProvider();
        if (!empty($arrAllDataProvider)) {
            $strController = $this->getControllerNamespace();
            foreach ($arrAllDataProvider as $strAction => $arrDataProvider)
                foreach ($arrDataProvider as $intKey => $arrInfo) {
                    $this->setUp();
                    $arrParam = (array) @$arrInfo[0];
                    $strMethod = @$arrInfo[1];
                    $booAuth = @$arrInfo[2];
                    $arrParamRoute = array();
                    $arrParamPost = array();
                    if (count($arrParam) > 0) {
                        if (empty($strMethod))
                            $strMethod = self::REQUEST_METHOD_GET;
                        if (strtoupper($strMethod) == self::REQUEST_METHOD_GET)
                            $arrParamRoute = $arrParam;
                        else
                            $arrParamPost = $arrParam;
                    }
                    if (!is_bool($booAuth))
                        $booAuth = true;
                    echo "\n\t" . 'Starting test \'' . $strController . '::' . $strAction . ( ++$intKey) . '\'';
                    try {
                        $this->checkActionCanBeAccessed($strController, $strAction, $arrParamRoute, $arrParamPost, $booAuth);
                        echo "\n\t" . '.';
                    } catch (\Exception $exception) {
                        echo "\n\t" . 'E';
                        throw $exception;
                    }
                    $this->tearDown(false);
                }
        }
    }

    /**
     * Metodo responsavel em setar os objetos da requisicao, rota e evento a serem
     * utilizados na invocacao de cada metodo de teste unitario.
     * Realiza a invocacao e sobrescrita do metodo setUp() da classe AbstractUnitTest.
     * Eh acionado sempre antes da invocacao de um metodo de teste unitario.
     * 
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->setUpRoute();
    }

    /**
     * Metodo responsavel em limpar os objetos da controller, requisicao, resposta,
     * rota e evento.
     * Realiza a invocacao e sobrescrita do metodo tearDown() da classe AbstractUnitTest.
     * Eh acionado sempre depois da invocacao de um metodo de teste unitario.
     * 
     * @param boolean $booUnsetController
     * @return void
     */
    protected function tearDown($booUnsetController = true)
    {
        parent::tearDown();
        if ($booUnsetController !== false)
            unset($this->controller);
        unset($this->request, $this->response, $this->routeMatch, $this->event);
    }

    /**
     * Metodo responsavel em setar os objetos da requisicao, rota e evento nos
     * devidos atributos da instancia.
     * 
     * @param object $request
     * @return void
     */
    protected function setUpRoute($request = null)
    {
        $this->setRequest((is_object($request)) ? $request : new Request());
        $this->setRouteMatch($routeMatch = new RouteMatch(array()));
        $event = new MvcEvent();
        $arrRouterConfig = array();
        if (self::hasServiceManager()) {
            $arrConfig = $this->getService('Config');
            $arrRouterConfig = isset($arrConfig['router']) ? $arrConfig['router'] : array();
        }
        $event->setRouter($router = HttpRouter::factory($arrRouterConfig));
        $event->setRouteMatch($routeMatch);
        $this->setEvent($event);
        if (is_object($this->getControllerInstance())) {
            $this->getControllerInstance()->setEvent($event);
            if (self::hasServiceManager())
                $this->getControllerInstance()->setServiceLocator(self::getServiceManager());
        }
    }

    /**
     * Metodo responsavel em executar os testes das rotas, ou seja, em verificar
     * se a action implementada na controller esta realizando de forma esperada
     * o fluxo completo de uma parametrizada requisicao.
     * 
     * @param string $strController Namespace da classe de controller a ser testada 
     * @param string $strAction Action da controller a ser testada
     * @param array $arrParamRoute Parametros a serem enviados via GET
     * @param array $arrParamPost Parametros a serem enviados via POST
     * @param boolean $booAuth Necessita ou nao de usuario autenticado
     * @param boolean $booDispatch Realiza ou nao o envio da requisicao parametrizada
     * @param boolean $booAssert Realiza ou nao a verificacao do status das respostas
     * @return mix
     */
    protected function checkActionCanBeAccessed($strController = null, $strAction = null, $arrParamRoute = array(), $arrParamPost = array(), $booAuth = null, $booDispatch = null, $booAssert = null)
    {
        if (!is_bool($booAuth))
            $booAuth = false;
        if ($booAuth)
            $this->authenticate();
        $this->begin();
        $this->getRouteMatch()->setParam('controller', $strController);
        $this->getRouteMatch()->setParam('action', $strAction);
        foreach ((array) $arrParamRoute as $strKey => $mixValue)
            $this->getRouteMatch()->setParam($strKey, $mixValue);
        if ((is_array($arrParamPost)) && (count($arrParamPost) > 0)) {
            $this->getRequest()->setMethod(self::REQUEST_METHOD_POST);
            foreach ((array) $arrParamPost as $strKey => $mixValue)
                $this->getRequest()->getPost()->set($strKey, $mixValue);
        }
        if ($booDispatch !== false)
            $this->getControllerInstance()->dispatch($this->request);
        $this->rollback();
        $response = $this->getControllerInstance()->getResponse();
        if ($booAssert !== false)
            $this->assertContains($response->getStatusCode(), array(self::RESPONSE_STATUS_CODE_OK, self::RESPONSE_STATUS_CODE_FOUND));
    }

    /**
     * Metodo responsavel em setar o namespace da controller no respectivo atributo.
     * 
     * @param string $strController
     * @return object
     */
    protected function setControllerNamespace($strController = null)
    {
        $this->strController = $strController;
        return $this;
    }

    /**
     * Metodo responsavel em setar o namespace da controller no respectivo atributo.
     * 
     * @return string
     */
    protected function getControllerNamespace()
    {
        return $this->strController;
    }

    /**
     * Metodo responsavel em retornar o namespace da classe de controller a ser
     * testada.
     * 
     * @return string
     */
    protected function getControllerName()
    {
        return $this->getControllerNamespace();
    }

    /**
     * Metodo responsavel em setar a instancia da classe de controller a ser testada.
     * 
     * @param object $controller
     * @return object
     */
    protected function setControllerInstance($controller = null)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * Metodo responsavel em retornar instancia da classe de controller a ser testada.
     * 
     * @return object
     */
    protected function getControllerInstance()
    {
        return (property_exists($this, 'controller')) ? $this->controller : null;
    }

    /**
     * Metodo responsavel em setar a instancia da requisicao.
     * 
     * @param object $request
     * @return object
     */
    protected function setRequest($request = null)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Metodo responsavel em retornar instancia da requisicao.
     * 
     * @return object
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Metodo responsavel em setar a instancia da resposta.
     * 
     * @param object $request
     * @return object
     */
    protected function setResponse($response = null)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Metodo responsavel em retornar instancia da resposta.
     * 
     * @return object
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * Metodo responsavel em setar a instancia da rota.
     * 
     * @param object $routeMatch
     * @return object
     */
    protected function setRouteMatch($routeMatch = null)
    {
        $this->routeMatch = $routeMatch;
        return $this;
    }

    /**
     * Metodo responsavel em retornar instancia da rota.
     * 
     * @return object
     */
    protected function getRouteMatch()
    {
        return $this->routeMatch;
    }

    /**
     * Metodo responsavel em setar a instancia do evento.
     * 
     * @param object $event
     * @return object
     */
    protected function setEvent($event = null)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Metodo responsavel em retornar instancia da evento.
     * 
     * @return object
     */
    protected function getEvent()
    {
        return $this->event;
    }

    /**
     * Metodo responsavel em controlar estaticamente a criacao de todos os data
     * provider para execucao de casos de teste.
     * 
     * @return array
     */
    protected function createAllDataProviderStatic()
    {
        $arrAllDataProvider = $this->getDataProvider();
        if (!empty($arrAllDataProvider))
            return $arrAllDataProvider;
        $arrAllDataProvider = $this->createAllDataProvider();
        $this->setAllDataProvider($arrAllDataProvider);
        return $arrAllDataProvider;
    }

    /**
     * Metodo responsavel em criar todos os data provider para execucao de casos
     * de teste.
     * 
     * @return array
     */
    protected abstract function createAllDataProvider();

    /**
     * Metodo responsavel em setar todos os data provider no atributo estatico.
     * 
     * @param array $arrAllDataProvider
     * @return boolean
     */
    protected function setAllDataProvider($arrAllDataProvider = null)
    {
        if (is_null($arrAllDataProvider))
            return false;
        self::setAttributeStatic('arrAllDataProvider[' . get_class($this) . ']', $arrAllDataProvider);
        return true;
    }

    /**
     * Metodo responsavel em retornar todos os data provider de uma controller 
     * (ou somente de uma action) do atributo estatico.
     * 
     * @param string $strAction
     * @return boolean
     */
    protected function getDataProvider($strAction = null)
    {
        $arrAllDataProvider = (array) self::getAttributeStatic('arrAllDataProvider[' . get_class($this) . ']');
        return (empty($strAction)) ? $arrAllDataProvider : (array) @$arrAllDataProvider[$strAction];
    }

    /**
     * Metodo responsabel em setar todas as informacoes de um caso de teste de uma
     * action no atributo estatico que armazena todos os data provider.
     * 
     * @param string $strAction
     * @param array $arrParam
     * @param string $strMethod
     * @param boolean $booAuth
     * @return boolean
     */
    protected function setDataProvider($strAction = null, $arrParam = array(), $strMethod = null, $booAuth = null)
    {
        if (empty($strAction))
            return false;
        $arrAllDataProvider = $this->getDataProvider();
        if (!array_key_exists($strAction, $arrAllDataProvider))
            $arrAllDataProvider[$strAction] = array();
        $arrAllDataProvider[$strAction][] = array($arrParam, $strMethod, $booAuth);
        $this->setAllDataProvider($arrAllDataProvider);
        return true;
    }

}
