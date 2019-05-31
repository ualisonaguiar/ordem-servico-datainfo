<?php

namespace InepZend\Service;

use InepZend\Log\LogCall;
use InepZend\Service\ServiceManagerTrait;

/**
 * Classe abstrata responsavel pelos metodos invocadores do ServiceManager
 * sobretudo para acionar outros servicos.
 * 
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [+] AbstractServiceManager
 *              [-] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [-] AbstractServiceControlCache
 *                          [-] AbstractServiceCache
 *                              [-] AbstractServiceCacheAngular
 *                          [-] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceManager extends AbstractServiceCoreCache
{

    use LogCall,
        ServiceManagerTrait;
}
