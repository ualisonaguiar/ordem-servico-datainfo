<?php

namespace InepZend\Service;

use InepZend\Exception\RuntimeException;

/**
 * Trait responsavel em manipular o ServiceManager.
 * 
 * @package InepZend
 * @subpackage Service
 */
trait ServiceManagerTrait
{

    private static $serviceManager;
    private static $arrService = array();

    /**
     * Metodo responsavel em retorna o serviceManager.
     * 
     * @example \InepZend\Service\AbstractServiceManager::getServiceManager();
     * 
     * @return object
     */
    public static function getServiceManager()
    {
        return self::$serviceManager;
    }

    /**
     * Metodo responsavel em setar o serviceManager a ser utilizado.
     * 
     * @example \InepZend\Service\AbstractServiceManager::setServiceManager($serviceManager);
     * 
     * @return mix
     */
    public static function setServiceManager($serviceManager)
    {
        return (self::$serviceManager = $serviceManager);
    }

    /**
     * Metodo responsavel em verificar se existe o serviceManager.
     * 
     * @example \InepZend\Service\AbstractServiceManager::hasServiceManager();
     * 
     * @return boolean
     */
    public static function hasServiceManager()
    {
        return is_object(self::getServiceManager());
    }

    /**
     * Metodo responsavel em retornar o(s) servico(s) ja setado(s).
     * 
     * @example $this->getService(); <br /> $this->getService($strService);
     * 
     * @param string $strService
     * @return mix
     */
    protected function getService($strService = null)
    {
        $serviceManager = self::getServiceManager();
        if (!is_object($serviceManager))
            return false;
        if (empty($strService))
            return $serviceManager;
        if (array_key_exists($strService, self::$arrService))
            return self::$arrService[$strService];
        if ($serviceManager->has($strService)) {
            try {
                $service = $serviceManager->get($strService);
            } catch (\Exception $exception) {
                throw RuntimeException::cloneException($exception);
            }
            self::$arrService[$strService] = $service;
            return $service;
        }
        return (class_exists($strService)) ? new $strService() : false;
    }

}
