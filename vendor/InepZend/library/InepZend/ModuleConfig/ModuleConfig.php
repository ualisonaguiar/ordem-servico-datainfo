<?php

namespace InepZend\ModuleConfig;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use InepZend\ModuleConfig\ModuleMenu;
use InepZend\Loader\FunctionAutoloader;
use InepZend\Util\Reflection;

class ModuleConfig
{

    protected $strNamespace;
    protected $arrNamespace;
    protected $strDir;
    private static $arrNamespaceLoaded = array();

    public function __construct()
    {
        if (empty($this->strNamespace))
            $this->strNamespace = Reflection::getNamespace($this);
        if (empty($this->strDir))
            $this->strDir = Reflection::getFileNameFromClass($this);
    }

    public function init(ModuleManager $moduleManager)
    {
        $mixNamespace = null;
        if (!empty($this->strNamespace))
            $mixNamespace = $this->strNamespace;
        elseif (!empty($this->arrNamespace))
            $mixNamespace = $this->arrNamespace;
        else
            $mixNamespace = __NAMESPACE__;
        if (!is_array($mixNamespace))
            $mixNamespace = array($mixNamespace);
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        foreach ($mixNamespace as $strNamespace) {
            self::setNamespaceLoaded($strNamespace);
            $sharedEvents->attach($strNamespace, MvcEvent::EVENT_DISPATCH, array($this, 'preDispatchModule'), 98);
        }
    }

    public function preDispatchModule($event)
    {
        $moduleSecurity = new ModuleSecurity();
        $mixResult = $moduleSecurity->preDispatch($event);
        if (is_object($mixResult))
            return $mixResult;
        $moduleMenu = new ModuleMenu();
        $moduleMenu->preDispatch($event);
        return;
    }

    public function onBootstrap($event)
    {
        ModuleInit::onBootstrap($event);
        FunctionAutoloader::onBootstrap();
    }

    public function getConfig()
    {
        return include (empty($this->strDir) ? __DIR__ : $this->strDir) . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        $strNamespace = (empty($this->strNamespace)) ? get_class($this) : $this->strNamespace;
        if (strpos($strNamespace, 'InepZend\\') === 0)
            return;
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    $strNamespace => (empty($this->strDir) ? __DIR__ : $this->strDir) . '/src/' . $this->getSource($strNamespace),
                ),
            ),
        );
    }

    public static function getModuleFromTrace($booAcceptInepZend = false)
    {
        $strInepZendModule = 'InepZend\Module\\';
        foreach (debug_backtrace() as $arrTrace) {
            if ((!array_key_exists('class', $arrTrace)) || (!array_key_exists('object', $arrTrace)))
                continue;
            $strClass = $arrTrace['class'];
            if (
                    (strpos($strClass, 'Zend\\') !== 0) &&
                    (strpos($strClass, 'Doctrine\\') !== 0) &&
                    (array_key_exists('object', $arrTrace))
            ) {
                $object = $arrTrace['object'];
                if ($object instanceof AbstractActionController)
                    $strClass = get_class($arrTrace['object']);
                if ((($booAcceptInepZend) && (strpos($strClass, 'InepZend\Module\\') === 0)) || (strpos($strClass, 'InepZend\\') !== 0))
                    return ((strpos($strClass, $strInepZendModule) === 0) ? $strInepZendModule : '') . reset($arrExplode = explode('\\', str_replace($strInepZendModule, '', $strClass)));
            }
        }
        return false;
    }

    private static function setNamespaceLoaded($strNamespace)
    {
        if (!in_array($strNamespace, self::$arrNamespaceLoaded))
            self::$arrNamespaceLoaded[] = $strNamespace;
    }

    public static function getNamespaceLoaded()
    {
        return self::$arrNamespaceLoaded;
    }

    public function getEntityManagerPublic($serviceManager = null, $strServiceEntityManager = null)
    {
        return $this->getEntityManager($serviceManager, $strServiceEntityManager);
    }

    protected function getEntityManager($serviceManager = null, $strServiceEntityManager = null)
    {
        if (!is_object($serviceManager))
            return;
        if (empty($strServiceEntityManager)) {
            $arrNamespace = ((is_array($this->arrNamespace)) && (count($this->arrNamespace) > 0)) ? $this->arrNamespace : array($this->strNamespace);
            foreach ($arrNamespace as $strNamespace) {
                $strServiceEntityManagerHas = 'doctrine.entitymanager.orm_' . strtolower(end(explode('\\', $strNamespace)));
                if ($serviceManager->has($strServiceEntityManagerHas)) {
                    $strServiceEntityManager = $strServiceEntityManagerHas;
                    break;
                }
            }
            if (empty($strServiceEntityManager))
                $strServiceEntityManager = 'InepZend\Doctrine\ORM\EntityManager';
        }
        return $serviceManager->get($strServiceEntityManager);
    }

    private function getSource($strNamespace)
    {
        if (strstr($strNamespace, '\\'))
            $strNamespace = substr($strNamespace, strripos($strNamespace, '\\') + 1, strlen($strNamespace));
        return $strNamespace;
    }

}
