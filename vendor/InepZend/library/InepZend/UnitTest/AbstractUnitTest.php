<?php

namespace InepZend\UnitTest;

require_once(__DIR__ . '/../Util/Functions/FileSystem.php');

use PHPUnit_Framework_TestCase;
use InepZend\Authentication\AuthService;
use InepZend\Authentication\AuthTrait;
use InepZend\UnitTest\Bootstrap;
use InepZend\Service\AbstractServiceRepository;
use InepZend\Service\ServiceManagerTrait;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\DebugExec;
use InepZend\Util\FileSystem;
use InepZend\Util\Reflection;
use InepZend\Util\PhpIni;
use InepZend\Util\Server;
use InepZend\Exception\RuntimeException;

/**
 * Classe abstrata responsavel pelos metodos basicos para a implementacao de qualquer
 * tipo de metodo de teste unitario.
 * Eh a classe nucleo (core) e estende a classe nativa de TestCase do PHPUnit.
 * 
 * [+] AbstractUnitTest
 *     [-] AbstractServiceCrudUnitTest
 *          [-] AbstractServiceUnitTest
 *     [-] AbstractRouteUnitTest
 *          [-] AbstractCrudUnitTest
 *              [-] AbstractCrudControllerUnitTest
 *
 * @package InepZend
 * @subpackage UnitTest
 */
abstract class AbstractUnitTest extends PHPUnit_Framework_TestCase
{

    use AuthTrait,
        ServiceManagerTrait,
        AttributeStaticTrait,
        DebugExec;

    const DEBUG = false;
    const REGEX_ERROR_ORACLE = '/.*ORA-/';
    const RETURN_REGEX_ERROR = 1;

    protected $login;
    protected $password;
    protected static $instanceOf;

    /**
     * Metodo responsavel em setar o login a ser utilizado em classes de teste que
     * requerem usuario autenticado.
     * 
     * @example $this->setLogin('123456789');
     * 
     * @param string $strLogin
     * @return object
     */
    public function setLogin($strLogin)
    {
        $this->login = $strLogin;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o login a ser utilizado em classes de teste
     * que requerem usuario autenticado.
     * 
     * @example $this->getLogin();
     * 
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Metodo responsavel em setar a senha a ser utilizada em classes de teste que
     * requerem usuario autenticado.
     * 
     * @example $this->setPassword('*******');
     * 
     * @param string $strPassword
     * @return object
     */
    public function setPassword($strPassword)
    {
        $this->password = $strPassword;
        return $this;
    }

    /**
     * Metodo responsavel em retornar a senha a ser utilizada em classes de teste
     * que requerem usuario autenticado.
     * 
     * @example $this->getPassword();
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Metodo responsavel em verificar a existencia de testes unitarios implementados
     * para cada metodo contido nas classes dos paths parametrizados.
     * 
     * @example InepZend\UnitTest\AbstractUnitTest::checkCoverage(true | false, array('path_class', 'path_class_test'))
     * 
     * @param boolean $booOnlyWithout
     * @param array $arrPath
     * @return array
     */
    public static function checkCoverage($booOnlyWithout = false, array $arrPath = null)
    {
        PhpIni::setMaxExecutionTime(0);
        PhpIni::setMemoryLimit(-1);
        $arrResult = array();
        if (empty($arrPath))
            $arrPath = array(
                'vendor/InepZend/library/InepZend/Http' => array('vendor/InepZend/test/InepZend/Util', false),
                'vendor/InepZend/library/InepZend/Util' => 'vendor/InepZend/test/InepZend/Util',
                'vendor/InepZend/library/InepZend/Service' => 'vendor/InepZend/module/UnitTest/test/UnitTest/Service',
                'vendor/InepZend/library/InepZend/FormGenerator/' => 'vendor/InepZend/test/InepZend/FormGenerator/',
            );
        self::debugExec($arrPath);
        $strBasePath = Server::getReplacedBasePathApplication('/../../../../../');
        foreach ($arrPath as $strPath => $mixPathTest) {
            $strPathTest = $mixPathTest;
            if (is_array($mixPathTest)) {
                $strPathTest = $mixPathTest[0];
                $booRemoveMethodsFromTrait = $mixPathTest[1];
            } else
                $booRemoveMethodsFromTrait = true;
            self::debugExec($strPathTest);
            self::debugExec($booRemoveMethodsFromTrait);
            $arrFile = FileSystem::scandirRecursive($strBasePath . $strPath, 'php');
            foreach ($arrFile as $strFile) {
                self::debugExec($strFile);
                $strClassName = Reflection::getClassFromFileName($strFile);
                self::debugExec($strClassName);
                if (!is_bool($strClassName)) {
                    if (in_array($strClassName, array('InepZend\Util\Library')))
                        continue;
                    $arrResult[$strClassName] = array();
                    $strClass = end($arrExplode = explode('\\', $strClassName));
                    $arrMethod = Reflection::listMethodsFromClass($strClassName, true, null, $booRemoveMethodsFromTrait, true);
                    foreach ($arrMethod as $strMethod) {
                        self::debugExec($strMethod);
                        $arrResult[$strClassName][$strMethod] = array();
                        $strMethodTestPart = 'test' . ucfirst($strMethod);
                        if (strpos($strPathTest, 'vendor/InepZend/test/InepZend/') === 0) {
                            $arrSufix = array('Test', 'SpecificTest');
                            foreach ($arrSufix as $strSufix)
                                if (file_exists($strPathClassTest = $strBasePath . $strPathTest . '/' . $strClass . $strSufix . '.php'))
                                    self::setMethodTestIntoResult($strPathClassTest, $strMethodTestPart, $arrResult[$strClassName][$strMethod]);
                        } else
                            foreach (FileSystem::scandirRecursive($strPathTest, 'php') as $strPathClassTest)
                                self::setMethodTestIntoResult($strPathClassTest, $strMethodTestPart, $arrResult[$strClassName][$strMethod]);
                    }
                }
            }
        }
        if ($booOnlyWithout)
            foreach ($arrResult as $strClassName => $arrMethod)
                foreach ($arrMethod as $strMethod => $arrMethodTest)
                    if (count($arrMethodTest) != 0)
                        unset($arrResult[$strClassName][$strMethod]);
        return $arrResult;
    }

    /**
     * Metodo responsavel em setar o ServiceManager estaticamente.
     * Eh acionado sempre antes da invocacao de um metodo de teste unitario.
     * 
     * @example $this->setUp();
     * 
     * @return object
     */
    protected function setUp()
    {
        if (is_object(self::getServiceManager()))
            return;
        self::setServiceManager(Bootstrap::getServiceManager());
    }

    /**
     * Metodo responsavel em setar estaticamente a instancia do objeto a ter os
     * metodos testados unitariamente.
     * 
     * @param object $instanceOf
     * @return boolean
     */
    protected static function setInstanceOf($instanceOf = null)
    {
        return (self::$instanceOf = $instanceOf);
    }

    /**
     * Metodo responsavel em retornar a instancia estatica do objeto a ter os metodos 
     * testados unitariamente.
     * 
     * @return object
     */
    protected static function getInstanceOf()
    {
        return self::$instanceOf;
    }

    /**
     * Metodo responsavel em limpar os dados referente a autenticacao (login e senha).
     * Eh acionado sempre depois da invocacao de um metodo de teste unitario.
     * 
     * @example $this->tearDown();
     * 
     * @return void
     */
    protected function tearDown()
    {
        unset($this->login, $this->password);
    }

    /**
     * Metodo responsavel em realizar a autenticacao em testes unitarios.
     * 
     * @example $this->authenticate();
     * 
     * @return void
     */
    protected function authenticate()
    {
        if ((!$this->hasIdentity()) && (is_object(self::getServiceManager()))) {
            $arrConfig = (array) @$this->getService('Config')['authServiceAdapter'];
            $authServices = new AuthService($arrConfig, null, true, true, self::getServiceManager());
            $authServices->getAdapter()->setLogin($this->getLogin());
            $authServices->getAdapter()->setPass($this->getPassword());
            $authServices->authenticate()->isValid();
        }
    }

    /**
     * Metodo responsavel em iniciar uma transacao com o banco de dados.
     * 
     * @example $this->begin();
     * 
     * @return object
     */
    protected function begin()
    {
        return $this->execMethodFromServiceApplication('begin');
    }

    /**
     * Metodo responsavel em reverter os dados manipulados no banco de dados durante
     * a execucao, desde que haja uma abertura de transacao, e tambem por encerrar
     * esta transacao.
     * 
     * @example $this->rollback();
     * 
     * @return object
     */
    protected function rollback()
    {
        return $this->execMethodFromServiceApplication('rollback');
    }

    /**
     * Metodo responsavel em definir o uso ou nao do metodo flush da EntityManager.
     * O flush efetiva a persistencia no banco de dados e sincroniza com a EntityManager.
     * 
     * @example $this->setFlush(true | false);
     * 
     * @param boolean $booFlush
     * @return boolean
     */
    protected function setFlush($booFlush = true)
    {
        return AbstractServiceRepository::setFlush($booFlush);
    }

    /**
     * Metodo responsavel em retornar a definicao do uso ou nao do metodo flush
     * da EntityManager.
     * O flush efetiva a persistencia no banco de dados e sincroniza com a EntityManager.
     * 
     * @example $this->getFlush();
     * 
     * @return boolean
     */
    protected function getFlush()
    {
        return AbstractServiceRepository::getFlush();
    }

    /**
     * Metodo responsavel em converter o encode de um valor para determinado padrao.
     * 
     * @example $this->convertEncoding('value');
     * 
     * @param mix $mixValue
     * @return mix
     */
    protected function convertEncoding($mixValue)
    {
        if (is_string($mixValue))
            $mixValue = mb_convert_encoding(utf8_decode($mixValue), 'CP850');
        return $mixValue;
    }

    /**
     * Metodo responsavel em inserir os metodos dos testes unitarios no array de
     * informacoes do resultado.
     * 
     * @example InepZend\UnitTest\AbstractUnitTest::setMethodTestIntoResult($strPathClassTest, $strMethodTestPart, $arrResultClassNameMethod);
     * 
     * @param string $strPathClassTest
     * @param string $strMethodTestPart
     * @param array $arrResultClassNameMethod
     * @return void
     */
    private static function setMethodTestIntoResult($strPathClassTest = null, $strMethodTestPart = null, &$arrResultClassNameMethod = null)
    {
        self::debugExec($strPathClassTest);
        self::debugExec($strMethodTestPart);
        self::debugExec($arrResultClassNameMethod);
        $strClassNameTest = Reflection::getClassFromFileName($strPathClassTest);
        self::debugExec($strClassNameTest);
        if (!is_bool($strClassNameTest)) {
            require_once $strPathClassTest;
            $arrMethodTest = Reflection::listMethodsFromClass($strClassNameTest, true, null, true);
            self::debugExec($arrMethodTest);
            foreach ($arrMethodTest as $strMethodTest)
                if (strpos($strMethodTest, $strMethodTestPart) === 0)
                    $arrResultClassNameMethod[] = $strClassNameTest . '::' . $strMethodTest;
            self::debugExec($arrResultClassNameMethod);
        }
    }

    /**
     * Metodo responsavel em executar algum outro metodo da service InepZend\Module\Application\Service\Application.
     * 
     * @example $this->execMethodFromServiceApplication('name_method');
     * 
     * @param string $strMethod
     * @return mix
     */
    private function execMethodFromServiceApplication($strMethod = null)
    {
        if (empty($strMethod))
            throw new RuntimeException('É necessário definir o método para realizar a operação.');
        if (!self::hasServiceManager())
            throw new RuntimeException('É necessário existir a instância do serviceManager para realizar a operação.');
        return (self::getServiceManager()->has('InepZend\Module\Application\Service\Application')) ? $this->getService('InepZend\Module\Application\Service\Application')->$strMethod() : false;
    }

}
