<?php

namespace InepZend\Service;

use InepZend\Cache\Service\ControlCacheTrait;

/**
 * Classe abstrata responsavel pelos metodos considerados essenciais aos 
 * servicos que utilizam algum tipo de cache (ex.: memcache).
 * 
 * [-] AbstractServiceCore
 *      [+] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
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
abstract class AbstractServiceCoreCache extends AbstractServiceCore
{

    use ControlCacheTrait;

    const CLEAR_MEMCACHE = false;

}
