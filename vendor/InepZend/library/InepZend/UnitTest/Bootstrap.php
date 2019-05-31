<?php

namespace InepZend\UnitTest;

date_default_timezone_set('America/Sao_Paulo');

use InepZend\ModuleConfig\ModuleInit;
use InepZend\Util\PhpIni;
use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use RuntimeException;

class Bootstrap
{

    protected static $serviceManager;
    protected static $config;
    protected static $bootstrap;

    public static function init()
    {
        require_once __DIR__ . '/../Util/Functions/FileSystem.php';
        $strPath = getReplacedBasePathApplication('/../../../../../config/application.config.php');
        if (!is_readable($strPath))
            return;
        $arrApplicationConfig = include $strPath;
        $arrModulePathNew = array();
        if (isset($arrApplicationConfig['module_listener_options']['module_paths'])) {
            $arrModulePath = $arrApplicationConfig['module_listener_options']['module_paths'];
            foreach ($arrModulePath as $strModulePath) {
//                $strParentPath = static::findParentPath($strModulePath);
                $strParentPath = ((strpos($strModulePath, './vendor') !== false) ? getBasePathVendor() : getBasePathApplication()) . '/' . $strModulePath;
                if ($strParentPath)
                    $arrModulePathNew[] = $strParentPath;
            }
        }
        $strModulePathNew = implode(PATH_SEPARATOR, $arrModulePathNew) . PATH_SEPARATOR;
        $strModulePathNew .= getenv('ZF2_MODULES_TEST_PATHS') ? : (defined('ZF2_MODULES_TEST_PATHS') ? ZF2_MODULES_TEST_PATHS : '');
        static::initAutoloader();
        $arrApplicationConfigNew = array(
            'module_listener_options' => array(
                'module_paths' => explode(PATH_SEPARATOR, $strModulePathNew),
            ),
        );
        $arrApplicationConfig = ArrayUtils::merge($arrApplicationConfigNew, $arrApplicationConfig);
        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $arrApplicationConfig);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
        static::$config = $arrApplicationConfig;
        ModuleInit::setGlobalsInfoFromConfig($serviceManager->get('Config'));
        ModuleInit::setStaticServiceManagerIntoClass($serviceManager);
        PhpIni::setMaxExecutionTime(0);
        PhpIni::setMemoryLimit(-1);
//         if (!array_key_exists('SERVER_PROTOCOL', $_SERVER))
//             $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
//         if (!array_key_exists('SERVER_NAME', $_SERVER))
//             $_SERVER['SERVER_NAME'] = 'localhost';
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    public static function getService($strService)
    {
        return self::getServiceManager()->get($strService);
    }

    public static function getConfig()
    {
        return static::$config;
    }

    protected static function initAutoloader()
    {
        $strVendorPath = static::findParentPath('vendor');
        if (is_readable($strVendorPath . '/autoload.php'))
            $arrAutoload = include $strVendorPath . '/autoload.php';
        else {
            $strZf2Path = getenv('ZF2_PATH') ? : (defined('ZF2_PATH') ? ZF2_PATH : (is_dir($strVendorPath . '/ZF2/library') ? $strVendorPath . '/ZF2/library' : false));
            if (!$strZf2Path)
                throw new RuntimeException('Unable to load ZF2. Run php composer.phar install or define a ZF2_PATH environment variable.');
            include $strZf2Path . '/Zend/Loader/AutoloaderFactory.php';
        }
        $arrPath = array('library', '../fpdf', 'module', 'theme');
        foreach ($arrPath as $strPath) {
            if (is_readable($strPathClassMap = $strVendorPath . '/InepZend/' . $strPath . '/autoload_classmap.php'))
                $arrAutoload = include $strPathClassMap;
        }
        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
            ),
        ));
    }

    protected static function findParentPath($strPath)
    {
        $strDir = __DIR__;
        $strPreviousDir = '.';
        while ((!is_dir($strDir . '/' . $strPath)) || (strpos($strDir, 'InepZend') !== false)) {
            $strDir = dirname($strDir);
            if ($strPreviousDir === $strDir)
                return false;
            $strPreviousDir = $strDir;
        }
        return $strDir . '/' . $strPath;
    }

    protected function getTable($table)
    {
        $serviceManager = $this->getServiceManager();
        $dbAdapter = $serviceManager->get('DbAdapter');
        $tableGateway = new TableGateway($dbAdapter, $table, new $table);
        $tableGateway->initialize();
        return $tableGateway;
    }

}

Bootstrap::init();