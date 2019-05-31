<?php

namespace InepZend\ModuleConfig;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent;
use Zend\View\ViewEvent;
use InepZend\Log\Log;
use InepZend\Log\LogTraceInstance;
use InepZend\Module\Log\Service\LogModule;
use InepZend\Util\PhpIni;
use InepZend\Module\WebService\Server\Rest\Service\RestServer;
use InepZend\View\Model\Json;
use InepZend\View\ViewTraitInstance;
use InepZend\View\Renderer\Renderer;
use InepZend\Http\RequestTrait;
use InepZend\Util\ApplicationInfo;

class ModuleInit
{

    use ModuleTrait;

    const MEMORY_LIMIT = -1;

    private static $sharedEvents;
    private static $booCalled = false;

    public function __construct($event)
    {
        if (is_object($event))
            self::onBootstrap($event);
    }

    public static function onBootstrap($event)
    {
        if (self::$booCalled === true)
            return true;
        if (!self::checkEvent($event, true))
            return false;
        $eventManager = $event->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $sharedEvents = $eventManager->getSharedManager();
        self::setSharedEvents($sharedEvents);
        $sharedEvents->attach('Zend\Mvc\Application', '*', function($event) {
                    switch (strtolower((string) $event->getName())) {
                        case MvcEvent::EVENT_ROUTE: {
                                self::setGlobalsInfo($event);
                                self::setStaticInfo($event);
                                self::route($event, true);
                                break;
                            }
                        case MvcEvent::EVENT_DISPATCH:
                        case MvcEvent::EVENT_RENDER:
                        case MvcEvent::EVENT_FINISH: {
                                LogTraceInstance::getInstance()->traceEvent($event);
                                break;
                            }
                        case MvcEvent::EVENT_DISPATCH_ERROR:
                        case MvcEvent::EVENT_RENDER_ERROR: {
                                self::error($event, true);
                                break;
                            }
                    }
                }
        );
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, function($event) {
                    self::dispatch($event, true);
                }, 100
        );
        $sharedEvents->attach('Zend\View\View', ViewEvent::EVENT_RENDERER_POST, function($event) {
//                    self::setVariableToLayout($event);
                    Renderer::setFilterContentIntoRenderer($event->getRenderer());
                }
        );
        self::$booCalled = true;
        return true;
    }

    public static function setGlobalsInfoFromConfig($arrConfig = null)
    {
        if (is_array($arrConfig)) {
            $arrConfigDoctrine = (array_key_exists('doctrine', $arrConfig)) ? (array) $arrConfig['doctrine'] : array();
            $GLOBALS['doctrine_debug_sql'] = (array_key_exists('debug', $arrConfigDoctrine)) ? (@$arrConfigDoctrine['debug']['sql'] === true) : false;
            $GLOBALS['doctrine_connection'] = (array_key_exists('connection', $arrConfigDoctrine)) ? @$arrConfigDoctrine['connection'] : array();
            $GLOBALS['doctrine_configuration'] = (array_key_exists('configuration', $arrConfigDoctrine)) ? @$arrConfigDoctrine['configuration'] : array();
            $GLOBALS['doctrine_proxy'] = (array_key_exists('proxy', $arrConfigDoctrine)) ? @$arrConfigDoctrine['proxy'] : array();
            $GLOBALS['proxyConfig'] = (array_key_exists('proxy', $arrConfig)) ? (array) @$arrConfig['proxy']['params'] : array();
            $arrConfigKey = array('authServiceAdapter', LogModule::KEY_ROOT, 'theme', 'module_theme_type');
            foreach ($arrConfigKey as $strConfigKey)
                if (array_key_exists($strConfigKey, $arrConfig))
                    $GLOBALS[$strConfigKey] = (is_array(@$GLOBALS[$strConfigKey])) ? array_merge($GLOBALS[$strConfigKey], $arrConfig[$strConfigKey]) : $arrConfig[$strConfigKey];
            return true;
        }
        return false;
    }

    public static function setStaticServiceManagerIntoClass($serviceManager = null, $arrClass = null)
    {
        if (!is_object($serviceManager))
            return false;
        if (is_null($arrClass))
            $arrClass = array(
                'InepZend\Service\AbstractServiceManager',
                'InepZend\View\Helper\AbstractHelper',
                'InepZend\Navigation\Service\AbstractNavigation',
                'InepZend\FormGenerator\FormGenerator',
                'InepZend\Entity\Proxy\AbstractEntityProxy',
                'InepZend\UnitTest\AbstractUnitTest',
                'InepZend\WebService\Client\AbstractWebService',
            );
        foreach ($arrClass as $strClass)
            if (!$strClass::hasServiceManager())
                $strClass::setServiceManager($serviceManager);
        return true;
    }

    private static function setSharedEvents($sharedEvents)
    {
        return self::$sharedEvents = $sharedEvents;
    }

    private static function getSharedEvents()
    {
        return self::$sharedEvents;
    }

    private static function hasSharedEvent($strIdSharedEvent, $strEvent)
    {
        $sharedEvents = self::getSharedEvents();
        if (!is_object($sharedEvents))
            return false;
        $arrEvent = $sharedEvents->getEvents($strIdSharedEvent);
        if (!is_array($arrEvent))
            $arrEvent = array();
        return in_array($strEvent, $arrEvent);
    }

    private static function setGlobalsInfo($event)
    {
        if (!self::checkEvent($event, true))
            return false;
        self::setGlobalsInfoFromConfig($event->getApplication()->getServiceManager()->get('Config'));
        if (is_object($routeMatch = $event->getRouteMatch())) {
            $GLOBALS['route'] = $routeMatch->getMatchedRouteName();
            $GLOBALS['routeMatch'] = $routeMatch;
            $GLOBALS['router'] = $event->getRouter();
        }
        return true;
    }

    private static function setStaticInfo($event)
    {
        if (!self::checkEvent($event, true))
            return false;
        RequestTrait::setEventOriginal($event);
        return true;
    }

    private static function reservedVariables($event)
    {
        if (!self::checkEvent($event))
            return false;
        if ((array_key_exists(LogModule::KEY_ROOT, $GLOBALS)) && (array_key_exists(LogModule::KEY_RESERVED_VARIABLE, $GLOBALS[LogModule::KEY_ROOT]))) {
            $arrReservedVariables = $GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_RESERVED_VARIABLE];
            if ((!is_array($arrReservedVariables)) || (count($arrReservedVariables) == 0))
                return false;
            $arrMessage = array();
            $logTrace = LogTraceInstance::getInstance();
            foreach ($arrReservedVariables as $strReservedVariables) {
                if ($strReservedVariables == 'GLOBALS')
                    continue;
                if ($strReservedVariables == '_SESSION')
                    session_start();
                eval('$mixReservedVariable = $' . $strReservedVariables . ';');
                if ((empty($mixReservedVariable)) && (array_key_exists($strReservedVariables, $GLOBALS)))
                    $mixReservedVariable = $GLOBALS[$strReservedVariables];
                if (empty($mixReservedVariable))
                    continue;
                $arrMessage[$strReservedVariables] = $mixReservedVariable;
                $logTrace->log(array($strReservedVariables => $mixReservedVariable));
            }
            return (count($arrMessage) != 0);
        }
        return true;
    }

    private static function route($event, $booTrace = false)
    {
        if (!self::checkEvent($event, true))
            return false;
        $intMemoryLimit = self::MEMORY_LIMIT;
        if (!empty($intMemoryLimit))
            PhpIni::allocatesMemory($intMemoryLimit);
        $serviceManager = $event->getApplication()->getServiceManager();
        $serviceManager->get('translator');
        $serviceManager->get('log')->registerHandler();
        $serviceManager->get('InepZend\Application\Service\Application');
        if (array_key_exists(LogModule::KEY_ROOT, $GLOBALS))
            Log::setHandler(@$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_OPTION][LogModule::KEY_OPTION_ERROR_HANDLER] === true);
        self::reservedVariables($event);
        if ($booTrace) {
            LogTraceInstance::getInstance()->traceEvent($event);
            $arrMessage = array(
                'route' => $event->getRouteMatch()->getMatchedRouteName(),
                'controller' => self::getController($event),
                'action' => self::getAction($event),
            );
            LogTraceInstance::getInstance()->traceMessage($arrMessage);
        }
        return true;
    }

    private static function dispatch($event, $booTrace = false)
    {
        if (!self::checkEvent($event, true))
            return false;
        if ($booTrace)
            LogTraceInstance::getInstance()->traceEvent($event);
        $strController = self::getController($event);
        $strModuleNamespace = reset($arrExplode = explode('\\Controller\\', $strController));
        $arrConfig = $event->getApplication()->getServiceManager()->get('Config');
        $strLayout = @$arrConfig['module_layouts'][$strModuleNamespace];
        $intStyleThemeColor = null;
        $arrOption = null;
        if (!empty($strLayout)) {
            $controller = $event->getTarget();
            $controller->layout($strLayout);
        } else {
            $strTheme = ApplicationInfo::getTheme(@$arrConfig['module_theme_type'][$strModuleNamespace], $strModuleNamespace, false);
            if (is_array($strTheme)) {
                $intStyleThemeColor = @$strTheme[1];
                $arrOption = @$strTheme[2];
                $strTheme = @$strTheme[0];
            }
            if (!empty($strTheme)) {
                $strLayout = ApplicationInfo::getThemeLayout($strTheme);
                if (!empty($strLayout)) {
                    $controller = $event->getTarget();
                    $controller->layout($strLayout);
                }
            }
        }
        $GLOBALS['module_theme_layout'] = $strLayout;
        $GLOBALS['module_theme_color'] = $intStyleThemeColor;
        $GLOBALS['module_theme_option'] = $arrOption;
        return true;
    }

    private static function error($event, $booTrace = false)
    {
        if (!self::checkEvent($event, true))
            return false;
        if ($booTrace)
            LogTraceInstance::getInstance()->traceEvent($event);
        if ($event->getParam('exception'))
            $event->getApplication()->getServiceManager()->get('log')->exceptionHandler($event->getParam('exception'));
        self::controlErrorException($event);
        return true;
    }

    private static function controlErrorException($event)
    {
        $routeMatch = $event->getRouteMatch();
        $exception = $event->getParam('exception');
        if ((is_object($routeMatch)) && ($routeMatch->getMatchedRouteName() == 'rest')) {
            $strError = $event->getError();
            $arrException = array();
            if (is_object($exception))
                $arrException = array(
                    'class' => get_class($exception),
                    'file' => end($arrExplode = explode('InepZend\library\\', $exception->getFile())),
                    'line' => $exception->getLine(),
                    'message' => $exception->getMessage(),
//                    'stacktrace' => $exception->getTraceAsString(),
                );
            $arrResult = RestServer::getResult(RestServer::RESPONSE_STATUS_ERROR, null, array('error' => $strError, 'exception' => $arrException));
            if ($strError == 'error-router-no-match')
                $arrResult['messages'] = 'Requisição incorreta.';
            $jsonModel = new Json($arrResult);
            $event->setResult($jsonModel);
            return $jsonModel;
        }
        if ((is_object($exception)) || ($event->getError() == 'error-router-no-match')) {
//            if ($exception instanceof \Zend\ServiceManager\Exception\ServiceNotCreatedException) {
//                $event->setViewModel(ViewTraitInstance::getInstance()->getViewInstance(array('exception' => $exception), 'error/exception'));
//                return;
//            }
            $arrConfig = $event->getApplication()->getServiceManager()->get('Config');
            $intStyleThemeColor = null;
            $strTheme = @$arrConfig['theme']['administrative'];
            if (is_array($strTheme)) {
                $intStyleThemeColor = $strTheme[1];
                $strTheme = $strTheme[0];
            }
            $strLayout = ApplicationInfo::getThemeLayout($strTheme);
            if (empty($strLayout))
                $strLayout = 'error/exception';
            $event->setViewModel(ViewTraitInstance::getInstance()->getViewInstance(array('exception' => $exception), $strLayout));
            $GLOBALS['module_theme_layout'] = $strLayout;
            $GLOBALS['module_theme_color'] = $intStyleThemeColor;
        }
        return;
    }

    private static function setVariableToLayout($event)
    {
        if (!self::checkEvent($event))
            return false;
        $arrChildren = $event->getModel()->getChildren();
        if (count($arrChildren) > 0) {
            $view = reset($arrChildren);
            if (is_object($view)) {
                $arrVar = $view->getVariables();
                if (array_key_exists('strModuleFromTrace', $arrVar))
                    $event->getModel()->setVariable('strModuleFromTrace', $arrVar['strModuleFromTrace']);
            }
        }
        return true;
    }

}
