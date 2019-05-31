<?php
namespace InepZend\Module\TrocaArquivo\Cliente\Controller;

use InepZend\Controller\AbstractControllerPaginator;
use InepZend\Module\TrocaArquivo\Common\Service\FileFlow;
use InepZend\Paginator\Paginator;

class ClienteController extends AbstractControllerPaginator
{

    /**
     * @auth no
     */
    public function indexAction()
    {
        return $this->controlAfterSubmit($this->getForm()
            ->prepareElementsPreprocessamento(), $this->prepareRequest(false, array_merge($this->getPost(), $this->getFiles())), FileFlow::UPLOAD, null, 'preprocessamento');
    }

    /**
     * @auth no
     */
    public function ajaxArquivoPaginatorAction()
    {
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria', $strService);
        if (! array_key_exists('ds_path', $arrCriteria))
            $arrCriteria['ds_path'] = null;
        $strService = 'InepZend\Module\TrocaArquivo\Cliente\Service\Cliente';
        return parent::ajaxPaginatorAction(null, $strService, array(
            array(
                'ds_path',
                Paginator::TYPE_LINK_DATA
            ),
            'ds_flow',
            'ds_size',
            'dt_create'
        ), array(
            'ds_path'
        ), 10, true, $arrCriteria, 'findByPagedArquivo');
    }

    /**
     * @auth no
     */
    public function ajaxErroPaginatorAction()
    {
        $strService = 'InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile';
        $arrCriteria = array_merge($this->getInfoAjaxPaginator('arrCriteria', $strService), array(
            'id_arquivo' => null
        ));
        return parent::ajaxPaginatorAction(null, $strService, array(
            'getIdErro',
            'getDtOcorrencia'
        ), array(
            'getIdErro'
        ), 10, true, $arrCriteria, 'findByPaged');
    }

    /**
     * @auth no
     */
    public function ajaxErroAccordionAction()
    {
        return $this->getViewClearContent($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\ErroFile')
            ->find((integer) $this->getPost('id_erro'))
            ->getDsResultadoHtml('width: 1060px; height: 300px; overflow: scroll;'));
    }
}
