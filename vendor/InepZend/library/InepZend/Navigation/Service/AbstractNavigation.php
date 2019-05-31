<?php

namespace InepZend\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;
use InepZend\Http\RequestTrait;
use InepZend\Session\SessionTrait;
use InepZend\Service\ServiceManagerTrait;
use InepZend\Util\DebugExec;
use InepZend\Util\Server;
use InepZend\Util\ApplicationInfo;
use InepZend\Exception\Exception;
use InepZend\Exception\InvalidArgumentException;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractNavigation extends DefaultNavigationFactory
{

    use RequestTrait,
        SessionTrait,
        ServiceManagerTrait,
        DebugExec;

    const NAME_MENU_START = 'Inicial';
    const NAME_MENU_LOGOFF = 'Sair';
    const NAME_MENU_CHANGE_PASS = 'Trocar Senha';
    const NAME_MENU_README = 'Reame';
    const KEY_CONFIG_NAVIGATION = 'navigation';
    const KEY_SESSION_INSTANCE = 'navigation';
    const KEY_SESSION_NAVIGATION_CONTAINER = 'navigationContainer';
    const KEY_PAGES = 'pages';
    const KEY_LABEL = 'label';
    const KEY_URI = 'uri';
    const KEY_TITLE = 'title';
    const KEY_CLASS = 'class';
    const KEY_ACTIVE = 'active';
    const KEY_POSITION = 'position';
    const KEY_URI_DEFAULT = '#';
    const PREFIX_POSITION_VERTICAL = 'v_';
    const PREFIX_POSITION_HORIZONTAL = 'h_';
    const DEBUG = false;

    protected $arrConfiguration = array(self::KEY_CONFIG_NAVIGATION => array());
    protected $arrMenu;
    protected $strContext;
    protected $serviceLocator;
    protected static $booSessionUseNavigationContainer = true;

    public function createService(ServiceLocatorInterface $serviceManager)
    {
        if (!is_object($serviceManager))
            return;
        $this->setEssentialInfo($serviceManager);
        return parent::createService($serviceManager);
    }

    public static function getSessionUseNavigationContainer()
    {
        return self::$booSessionUseNavigationContainer;
    }

    public static function setSessionUseNavigationContainer($booSessionUseNavigationContainer = true)
    {
        self::$booSessionUseNavigationContainer = $booSessionUseNavigationContainer;
    }

    protected function getPages(ServiceLocatorInterface $serviceManager, $arrMenuContainer = null)
    {
        $this->setEssentialInfo($serviceManager);
        if (self::getSessionUseNavigationContainer()) {
            $session = self::getSessionInstance(self::KEY_SESSION_INSTANCE);
            if (($session->offsetExists(self::KEY_SESSION_NAVIGATION_CONTAINER)) && (array_key_exists(get_class($this), $arrNavigationContainer = $session->offsetGet(self::KEY_SESSION_NAVIGATION_CONTAINER)))) {
                $this->debugExec('COM session');
                return $this->setActive($arrNavigationContainer[get_class($this)]);
            }
        }
        $this->addMenuConfiguration($arrMenuContainer);
        if (self::getSessionUseNavigationContainer())
            $session->offsetSet(self::KEY_SESSION_NAVIGATION_CONTAINER, array_merge(($session->offsetExists(self::KEY_SESSION_NAVIGATION_CONTAINER)) ? $session->offsetGet(self::KEY_SESSION_NAVIGATION_CONTAINER) : array(), array(get_class($this) => $this->pages)));
        $this->debugExec('SEM session');
        return $this->setActive($this->pages);
    }

    protected function addMenuConfiguration($arrMenuContainer = null)
    {
        $this->arrConfiguration[self::KEY_CONFIG_NAVIGATION][$this->getName()] = array(
            array(
                self::KEY_LABEL => $this->getApplicationInfoName(),
                self::KEY_URI => self::KEY_URI_DEFAULT,
                self::KEY_TITLE => 'Geral do sistema.',
                self::KEY_CLASS => 'breadcrumbNameApplication',
                self::KEY_PAGES => (!is_array($arrMenuContainer)) ? array() : $arrMenuContainer,
            )
        );
        $this->debugExec($this->arrConfiguration);
        $application = $this->getService('Application');
        $routeMatch = $application->getMvcEvent()->getRouteMatch();
        $router = $application->getMvcEvent()->getRouter();
        $arrPages = $this->getPagesFromConfig($this->arrConfiguration[self::KEY_CONFIG_NAVIGATION][$this->getName()]);
        $this->validStructurePages($arrPages);
        $this->pages = $this->injectComponents($arrPages, $routeMatch, $router);
        $this->debugExec($this->pages);
        return true;
    }

    protected function addMenuContainer($arrPage = null, $strLabel = null, $strTitle = null, $strPosition = null)
    {
        if (empty($strLabel))
            $strLabel = $this->getName();
        return array(
            $strLabel => array(
                self::KEY_LABEL => $strLabel,
                self::KEY_URI => self::KEY_URI_DEFAULT,
                self::KEY_TITLE => $strTitle,
                self::KEY_POSITION => $strPosition,
                self::KEY_PAGES => (is_array($arrPage)) ? $arrPage : array(),
        ));
    }

    protected function addMenuItem($strLabel = null, $strUri = null, $strTitle = null, $strPosition = null)
    {
        return array(
            $strLabel => array(
                self::KEY_LABEL => $strLabel,
                self::KEY_URI => ((stripos($strUri, 'javascript') === false) ? $this->getBaseUrl() : '') . $strUri,
                self::KEY_TITLE => $strTitle,
                self::KEY_POSITION => $strPosition,
        ));
    }

    protected function constructPages($arrMenu = null, $strPosition = null)
    {
        if (!is_array($arrMenu))
            return false;
        $arrPage = array();
        foreach ($arrMenu as $strLabel => $arrMenuLabel) {
            if ((!is_array($arrMenuLabel)) || (count($arrMenuLabel) == 0))
                continue;
            $strTitle = (array_key_exists(1, $arrMenuLabel)) ? $arrMenuLabel[1] : null;
            if (is_array($arrMenuLabel[0])) {
                $arrMenuIntern = $this->constructPages($arrMenuLabel[0], $strPosition);
                $arrMenuIntern = $this->addMenuContainer($arrMenuIntern, $strLabel, $strTitle, $strPosition);
            } else
                $arrMenuIntern = $this->addMenuItem($strLabel, $arrMenuLabel[0], $strTitle, $strPosition);
            $arrPage = array_merge($arrPage, $arrMenuIntern);
        }
        return $arrPage;
    }

    protected function setActive($arrPage = null, $mixKeyParent = null, $strHost = null, $intDeep = 0)
    {
        if (!is_array($arrPage))
            return $arrPage;
        ++$intDeep;
        if (empty($strHost))
            $strHost = Server::getHost(null, false, true);
        foreach ($arrPage as $mixKey => &$mixValue) {
            if (($mixKeyParent !== 0) && ($mixKey === self::KEY_URI) && (is_string($mixValue)) && (strpos($strHost, $mixValue) === 0)) {
                $arrPage[self::KEY_ACTIVE] = true;
                break;
            }
            if (is_array($mixValue))
                $mixValue = $this->setActive($mixValue, $mixKey, $strHost, $intDeep);
        }
        if ($intDeep == 1)
            $this->debugExecSimple($arrPage);
        return $arrPage;
    }

    protected function validStructurePages(array $arrPages)
    {
        foreach ($arrPages as $arrPage) {
            if (!array_key_exists(self::KEY_URI, $arrPage))
                throw new InvalidArgumentException('O item de menu "' . utf8_decode(end($arrPage)['label']) . '" encontra-se com a sigla incorreta no SSI Web.');
            if (isset($arrPage['pages']))
                $this->validStructurePages($arrPage['pages']);
        }
    }

    protected function setBaseUrl($strBaseUrl = null)
    {
//        if (empty($strBaseUrl))
//            $strBaseUrl = Server::getHost(null, false);
        $this->setContext($strBaseUrl);
        return $this;
    }

    protected function getBaseUrl()
    {
        $strBaseUrl = $this->getContext();
        if (empty($strBaseUrl))
            $this->setBaseUrl();
        return $this->getContext();
    }

    protected function setContext($strContext = null)
    {
        $this->strContext = $strContext;
        return $this;
    }

    protected function getContext()
    {
        return $this->strContext;
    }

    protected function setServiceLocator($serviceLocator = null)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    protected function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    protected function checkServiceManager($booThrow = false)
    {
        if (!is_object($this->getServiceManager())) {
            if ($booThrow === true)
                throw new Exception('Deve-se possuir o ServiceManager na classe ' . get_class($this) . '.');
            return false;
        }
        return true;
    }

    protected function setEssentialInfo(ServiceLocatorInterface $serviceManager)
    {
        self::setServiceManager($serviceManager);
        $this->setServiceLocator($serviceManager);
        $this->setBaseUrl();
        return true;
    }

    protected function getApplicationInfoName()
    {
        return utf8_encode(ApplicationInfo::getApplicationInfo()['NAME']);
    }

}
