<?php

namespace InepZend\Controller;

/**
 * Classe abstrata responsavel pelos metodos basicos para um CRUD sem paginacao.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [+] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractController extends AbstractControllerRepository
{
    
}
