<?php

namespace InepZend;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\ModuleManager,
    Zend\ModuleManager\ModuleEvent;
use Zend\Mvc\MvcEvent;
use InepZend\ModuleConfig\ModuleSecurity;
use InepZend\ModuleConfig\ModuleInit;
use InepZend\Module\Application\Service\AutoloadConfig;
use InepZend\Util\ApplicationProperties;
use InepZend\Util\Server;
use InepZend\Util\ArrayCollection;

class Module implements AutoloaderProviderInterface
{

    private static $arrModuleInepZend = array();
    private static $moduleManager;

    public function init(ModuleManager $moduleManager)
    {
        $this->setModuleManager($moduleManager);
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, array($this, 'preDispatchModule'), 98);
        $moduleManager->getEventManager()->attach(ModuleEvent::EVENT_LOAD_MODULE_RESOLVE, array($this, 'moduleResolve'), 100);
        $moduleManager->getEventManager()->attach(ModuleEvent::EVENT_MERGE_CONFIG, array($this, 'mergeConfig'), 99);
        $this->onLoadModulesInepZend();
    }

    public function moduleResolve(ModuleEvent $event)
    {
        $moduleManager = $this->getModuleManager();
        $arrModulePath = @$GLOBALS['module_listener_options']['module_paths'];
        if (empty($arrModulePath))
            $GLOBALS['module_listener_options']['module_paths'] = $event->getConfigListener()->getOptions()->getModulePaths();
        $arrModules = @$GLOBALS['modules'];
        if (empty($arrModules)) {
            $arrConfig = (file_exists($strPath = Server::getReplacedBasePathApplication('/../../config/application.config.php')) ? require $strPath : array());
            if (array_key_exists('modules', $arrConfig))
                $GLOBALS['modules'] = $arrConfig['modules'];
        }
        if (array_key_exists($event->getModuleName(), self::$arrModuleInepZend)) {
            if (!$module = $moduleManager->getModule(self::$arrModuleInepZend[$event->getModuleName()]))
                $module = $moduleManager->loadModule(self::$arrModuleInepZend[$event->getModuleName()]);
            return $moduleManager->loadModule(array($event->getModuleName() => $module));
        }
    }

    public function mergeConfig(ModuleEvent $event)
    {
        $arrAutoloadConfig = ArrayCollection::merge(ApplicationProperties::getAutoloadConfig(), AutoloadConfig::getAutoloadConfig(), true);
        if ((!empty($arrAutoloadConfig)) && (is_array($arrAutoloadConfig))) {
            $event->getConfigListener()->setMergedConfig(ArrayCollection::merge($event->getConfigListener()->getMergedConfig()->toArray(), $arrAutoloadConfig, true));
            if (array_key_exists('phpini', $arrAutoloadConfig))
                foreach ($arrAutoloadConfig['phpini'] as $strConfigVarName => $mixConfigValue)
                    ini_set($strConfigVarName, $mixConfigValue);
        }
    }

    public function preDispatchModule($event)
    {
        $moduleSecurity = new ModuleSecurity();
        return $moduleSecurity->preDispatch($event);
    }

    public function onBootstrap(MvcEvent $event)
    {
        ModuleInit::onBootstrap($event);
    }

    public function onLoadModulesInepZend()
    {
        $moduleManager = $this->getModuleManager();
        $arrConfig = (file_exists(__DIR__ . '/config/application.config.php') ? require __DIR__ . '/config/application.config.php' : array());
        $arrModuleNotLoad = (file_exists($strPath = Server::getReplacedBasePathApplication('/../../config/complement/module.php')) ? require $strPath : array());
        if (array_key_exists('modules', $arrConfig) && !empty($arrConfig['modules'])) {
            $this->setModuleInepZend($arrConfig['modules']);
            if (array_key_exists('modules_not_load', $arrModuleNotLoad) && !empty($arrModuleNotLoad['modules_not_load'])) {
                $arrConfig['modules'] = array_diff($arrConfig['modules'], $arrModuleNotLoad['modules_not_load']);
                $arrConfig['modules'] = array_diff_key($arrConfig['modules'], array_fill_keys($arrModuleNotLoad['modules_not_load'], 'modules_not_load'));
            }
            $moduleManager->setModules(array_values($arrConfig['modules']));
            $moduleManager->onLoadModules();
        }
    }

    public function getConfig()
    {
        return array();
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/library/autoload_classmap.php',
                __DIR__ . '/../fpdf/autoload_classmap.php',
                __DIR__ . '/module/autoload_classmap.php',
                __DIR__ . '/theme/autoload_classmap.php',
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Navigation\Navigation' => 'InepZend\Navigation\Navigation',
            ),
        );
    }

    public function setModuleManager(ModuleManager $moduleManager)
    {
        self::$moduleManager = $moduleManager;
    }

    public function getModuleManager()
    {
        return self::$moduleManager;
    }

    public function setModuleInepZend($arrModuleInepZend)
    {
        self::$arrModuleInepZend = $arrModuleInepZend;
    }

    public function getModuleInepZend()
    {
        return self::$arrModuleInepZend;
    }

}
