<?php

namespace InepZend\Module\TrocaArquivo\MonitoramentoEnvio\Controller;

use InepZend\Controller\AbstractControllerPaginator;
use InepZend\View\View;
use InepZend\Util\ArrayCollection;
use InepZend\Dto\ResultDto;
use Exception as ExceptionNative;

class MonitoramentoEnvioController extends AbstractControllerPaginator
{

    public function __construct()
    {
        $this->arrMethodPk = array('getIdArquivo');
        $this->arrMethodPaging = array('getNoArquivo', 'getDsCaminho', array('getIdConfiguracao', 'text', array(), array('\InepZend\Module\TrocaArquivo\Common\Service\File\ConfiguracaoFile::getNameFromIdConfiguracao')), 'getDtEnvio');
    }

    public function indexAction()
    {
        try {
            $form = $this->getForm()->prepareElementsFilter();
        } catch (ExceptionNative $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
        return new View(array('form' => $form));
    }

    public function ajaxPaginatorAction($arrCriteriaMerge = null)
    {
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
        if (is_numeric(@$arrCriteria['id_configuracao']))
            $arrCriteria['id_configuracao'] = (integer) $arrCriteria['id_configuracao'];
        elseif (is_array($arrCriteriaMerge))
            $arrCriteria = ArrayCollection::merge($arrCriteria, $arrCriteriaMerge);
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\TrocaArquivo\Common\Service\File\ArquivoFile', null, null, 10, true, $arrCriteria);
    }

    public function showAction()
    {
        try {
            $intIdArquivo = $this->getParamsFromRoute('id_arquivo');
            $arrData = $this->getService()->getDataToShow($intIdArquivo);
            $form = $this->getForm()->prepareElementsShow($intIdArquivo, $arrData);
            $form->setData($arrData);
        } catch (ExceptionNative $exception) {
            $this->getServiceMessage()->addMessageError($exception->getMessage());
            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
        return new View(array('form' => $form));
    }

    public function ajaxFileFlowAction()
    {
        $strMethod = (stripos($this->getPost('tp_validacao'), 'sem') == 0) ? 'process' : 'preprocess';
        $this->getService('InepZend\Module\TrocaArquivo\Common\Service\FileFlow')->$strMethod($this->getPost('id_configuracao'), $this->getPost('ds_caminho'));
        return $this->getViewClearContent(ResultDto::STATUS_OK);
    }

}
