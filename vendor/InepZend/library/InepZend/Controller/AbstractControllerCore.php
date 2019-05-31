<?php

namespace InepZend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use InepZend\Controller\ControllerCoreTrait;
use InepZend\Util\DebugExec;

/**
 * Classe abstrata responsavel pelos metodos considerados essenciais aos controllers.
 *
 * [+] AbstractControllerCore
 *      [-] AbstractControllerServiceManager
 *          [-] AbstractControllerForm
 *              [-] AbstractControllerRepository
 *                  [-] AbstractController
 *                      [-] AbstractControllerPaginator
 *                          [-] AbstractCrudController
 *                              [-] AbstractControllerAngular
 * [-] AbstractRestfulController
 *
 * @package InepZend
 * @subpackage Controller
 */
abstract class AbstractControllerCore extends AbstractActionController
{

    use ControllerCoreTrait,
        DebugExec;

    const DEBUG = false;
    const MESSAGE_SUCCESS = 'Operação realizada com sucesso!';
    const MESSAGE_ERROR = 'Operação não realizada por existir algum erro!';
    const MESSAGE_WARNING = 'Operação não realizada por existir algum aviso!';
    const MESSAGE_NOTICE = 'Operação não realizada por existir alguma nota!';
    const MESSAGE_VALIDATE = 'Operação não realizada por existir alguma validação!';

    protected function layout($strTemplate = null)
    {
        $strGlobalModuleThemeLayout = self::getThemeLayout();
        if ((in_array($strTemplate, array('layout/layout', 'layout/layout-administrative', 'layout/layout-clean'))) && (!empty($strGlobalModuleThemeLayout)) && ($strTemplate != $strGlobalModuleThemeLayout))
            $strTemplate = $strGlobalModuleThemeLayout;
        return parent::layout($strTemplate);
    }

}
