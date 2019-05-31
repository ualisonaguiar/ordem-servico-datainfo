<?php

namespace InepZend\Controller;

use Zend\Mvc\Controller\AbstractRestfulController as ZendAbstractRestfulController;
use InepZend\WebService\Client\AbstractWebService;
use InepZend\Controller\ControllerCoreTrait;
use InepZend\Controller\ControllerServiceManagerTrait;
use InepZend\Util\DebugExec;

/**
 * Classe abstrata responsavel pelas actions utilizadas em webservices Restful.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [+] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractRestfulController extends ZendAbstractRestfulController
{

    use ControllerCoreTrait,
        ControllerServiceManagerTrait,
        DebugExec;

    const DEBUG = AbstractWebService::DEBUG;

}
