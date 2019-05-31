<?php

namespace InepZend\Service;

use InepZend\Service\AbstractServiceCache;
use InepZend\Service\ServiceAngularTrait;

/**
 * Classe abstrata responsavel pelos metodos considerados essenciais aos servicos.
 *
 * [-] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
 *          [-] AbstractServiceManager
 *              [-] AbstractServiceRepository
 *                  [-] AbstractService
 *                      [-] AbstractServiceAngular
 *                      [-] AbstractServiceControlCache
 *                          [-] AbstractServiceCache
 *                              [+] AbstractServiceCacheAngular
 *                          [-] AbstractServiceFile
 *                              [-] AbstractServiceFileAngular
 *
 * @package InepZend
 * @subpackage Service
 */
abstract class AbstractServiceCacheAngular extends AbstractServiceCache
{

    use ServiceAngularTrait;

}
