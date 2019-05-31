<?php

namespace InepZend\Controller;

/**
 * Classe abstrata responsavel pelos metodos basicos para um CRUD completo e 
 * com paginacao.
 * 
 * [-] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [+] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractControllerAngular extends AbstractCrudController
{
    
    public function __construct($strController = null, $arrVariableMerge = null)
    {
        $this->layout('layout/layout-clean');
        parent::__construct($strController, $arrVariableMerge);
    }
    
    public function indexAction($mixForm = null)
    {
        return $this->getViewForm($mixForm, 'prepareElementsFilter');
    }
    
    protected function addEditAction($strMethod = null, $mixForm = null, $arrDataMerge = null, $strEntity = null, $strRoute = null, $strService = null, $arrPk = null, $strMessageSuccess = null, $arrRouteParam = array())
    {
        return $this->getViewForm($mixForm);
    }

}
