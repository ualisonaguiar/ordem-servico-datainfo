<?php

namespace InepZend\Service;

use InepZend\Authentication\AuthTrait;
use InepZend\Dto\ResultTrait;
use InepZend\Util\MethodArgumentTrait;
use InepZend\Util\DebugExec;

/**
 * Classe abstrata responsavel pelos metodos considerados essenciais aos servicos.
 *
 * [+] AbstractServiceCore
 *      [-] AbstractServiceCoreCache
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
abstract class AbstractServiceCore
{

    use AuthTrait,
        ResultTrait,
        MethodArgumentTrait,
        DebugExec;

    const DEBUG = false;

}
