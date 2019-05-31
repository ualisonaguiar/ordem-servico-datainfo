<?php
namespace InepZend\Module\TrocaArquivo\LayoutValidacao\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;
use Exception as ExceptionNative;

class RegraValidacaoController extends AbstractCrudController
{

    public function __construct()
    {
        $this->arrPk = array(
            'id_regra_validacao'
        );
        $this->arrMethodPk = array(
            'getIdRegraValidacao'
        );
        $this->arrMethodPaging = array(
            array(
                'getIdIlhaDado',
                'text',
                array(),
                array(
                    '\InepZend\Module\TrocaArquivo\IlhaDado\Service\IlhaDado::getNameFromIdIlhaDado'
                )
            ),
            'getDsColuna',
            'getInExistenteIlhaDadoText',
            'getInAtivoText'
        );
    }

    public function indexAction()
    {
        $intIdLayout = $this->getParamsFromRoute('id_layout');
        $form = $this->getForm()->prepareElementsFilter($intIdLayout);
        $this->setDataFromLayout($form, $intIdLayout);
        return new View(array(
            'form' => $form
        ));
    }

    public function ajaxPaginatorAction()
    {
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
        if (@empty($arrCriteria['id_layout']))
            $arrCriteria['id_layout'] = $this->getParamsFromRoute('id_layout');
        $arrCriteria['id_layout'] = (integer) $arrCriteria['id_layout'];
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\TrocaArquivo\Common\Service\File\RegraValidacaoFile', null, null, 10, true, $arrCriteria);
    }

    public function addAction()
    {
        return self::callAddEditAction(__FUNCTION__);
    }

    public function editAction()
    {
        return self::callAddEditAction(__FUNCTION__);
    }

    private function callAddEditAction($strMethod = 'addAction')
    {
        $intIdLayout = $this->getParamsFromRoute('id_layout');
        $form = $this->getForm()->prepareElements($intIdLayout, $this->getParamsFromRoute('id_regra_validacao'));
        $this->setDataFromLayout($form, $intIdLayout);
        return parent::addEditAction((($strMethod == 'addAction') ? 'insert' : 'update'), $form, null, 'InepZend\Module\TrocaArquivo\Common\Entity\RegraValidacao', 'regravalidacao', 'InepZend\Module\TrocaArquivo\Common\Service\File\RegraValidacaoFile', (($strMethod == 'addAction') ? null : $this->arrPk), null, array(
            'action' => 'index',
            'id_layout' => $intIdLayout
        ));
    }

    private function setDataFromLayout($form = null, $intIdLayout = null)
    {
        try {
            $form->setData($this->getService()
                ->getDataFromLayout($intIdLayout));
        } catch (ExceptionNative $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
    }
}
