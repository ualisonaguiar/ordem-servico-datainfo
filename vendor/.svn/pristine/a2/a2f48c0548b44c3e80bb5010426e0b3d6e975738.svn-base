<?php

namespace InepZend\Module\Executor\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\Module\Executor\Entity\Query as QueryEntity;
use InepZend\View\View;
use InepZend\Module\Executor\Message\Message;
use Zend\Mvc\MvcEvent;

class ExecutorController extends AbstractCrudController
{
    use SecurityAcl, Message;

    public function onDispatch(MvcEvent $event)
    {
        return $this->hasUserAccessSystem($event);
    }

    public function __construct()
    {
        parent::__construct(__CLASS__);
        $this->strService = 'InepZend\Module\Executor\Service\Query';
        $this->arrMethodPaging = array('ID_QUERY', 'DS_TITULO', 'IN_ATIVO', 'DT_CADASTRO', 'DT_EXECUCAO');
        $this->arrMethodPk = array('ID_QUERY');
        $this->strForm = 'InepZend\Module\Executor\Form\Executor';
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function indexAction()
    {
        $form = $this->getForm();
        $form->prepareElementsSearch();
        return $this->controlAfterSubmit($form, array(), null, null, null, self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function addAction()
    {
        $this->accessFunctionalityAdministrador();
        $form = $this->getForm();
        $form->prepareElementsQuery('Adicionar Operação');
        return $this->controlAfterSubmit($form, $this->getPost(), 'saveQuery', $this->strService, 'query', self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function editAction()
    {
        $this->accessFunctionalityAdministrador();
        $inProductOwner = $this->getService('InepZend\Module\Executor\Service\Usuario')->hasProductOwner();
        $form = $this->getForm();
        $form->prepareElementsQuery('Editar Operação', $inProductOwner);
        $strRoute = 'query';
        if ($this->isPost()) {
            $arrDataQuery = $this->getPost();
            $this->controlAfterSubmit($form, $arrDataQuery, 'saveQuery', $this->strService, $strRoute, self::getParamMenu());
            return $this->redirect()->toRoute('query', ['action' => 'execute-query', 'idQuery' => base64_encode($arrDataQuery['idQuery'])]);
        } else {
            $arrDataQuery = $this->getService()->find((int)$this->getParamsFromRoute('idQuery'))->toArray();
        }
        return $this->controlAfterSubmit($form, $arrDataQuery, 'saveQuery', $this->strService, $strRoute, self::getParamMenu());
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function ajaxChangeSituationAction()
    {
        $this->accessFunctionalityAdministrador();
        $arrResult = $this->getService()->changeSituation($this->getPost()['idQuery']);
        return $this->getViewClearContent(json_encode($arrResult));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxHistoryExecuteAction()
    {
        $intIdQuery = (int)$this->getParamsFromRoute('idQuery');
        $this->strService = 'InepZend\Module\Executor\Service\HistoricoExecucao';
        $this->arrMethodPaging = array('ID_HISTORICO_EXECUCAO', 'DS_USUARIO', 'DT_EXECUCAO', 'TP_SITUACAO');
        $this->arrMethodPk = array('ID_HISTORICO_EXECUCAO');
        return parent::ajaxPaginatorAction(null, null, null, null, null, null, array('idQuery' => (int)$intIdQuery));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxHistoryParamAction()
    {
        $strHtml = '';
        if ($this->isPost()) {
            $arrDataPost = $this->getPost();
            $arrData = $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao')
                ->getDataHistoryExecute($arrDataPost['idHistoricoParametro']);
            $arrData['result']['idHistoricoExecucao'] = $arrDataPost['idHistoricoParametro'] . '_hist';
            $form = $this->getForm();
            $form->getTableResult($arrData['result']);
            $form->setData(array('data_result_' . $arrDataPost['idHistoricoParametro'] . '_hist' => $arrData['result']['data']));
            $arrData['form'] = $form;
            $strHtml = $this->renderTemplate('inep-zend/executor/_history-execute-result', $arrData);
        }
        return $this->getViewClearContent($strHtml);
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function executeQueryAction()
    {
        $intIdQuery = (int)base64_decode($this->getParamsFromRoute('idQuery'));
        $dataQuery = $this->getService('InepZend\Module\Executor\Service\Query')->find($intIdQuery);
        if ($dataQuery->getInAtivo() == QueryEntity::SITUACAO_INATIVO) {
            $this->getServiceMessage()->addMessageWarning($this->strMsgError03);
            return $this->redirect()->toRoute('query');
        }
        $arrDataResult = array('data');
        if ($this->isPost()) {
            $arrPost = $this->getPost();
            $intIdQuery = $arrPost['idQuery'];
            $arrValueParameter = $arrPost['parameter'];
//             $arrValueParameter = array();
//             if ($arrPost['parameter']) {
//                  $arrValueParameter = array_values($arrPost['parameter']);
//             }
            $arrDataResult = $this->getService('InepZend\Module\Executor\Service\Executor')->run($intIdQuery, $arrValueParameter);
        }
        $form = $this->getForm('InepZend\Module\Executor\Form\Executor');
        $form->prepareElementExecute($intIdQuery, $arrDataResult);
        $form->setData(
            array(
                'idQuery' => $intIdQuery,
                'data_result_' . $arrDataResult['idHistoricoExecucao'] => $arrDataResult['data']
            )
        );
        return new View(array_merge(array('form' => $form), self::getParamMenu()));
    }

    /**
     * @resource RSRC_EXECUTOR_ADMIN
     */
    public function ajaxInsereQueryEmailAction()
    {
        $this->accessFunctionalityAdministrador();
        $arrResult = array();
        if ($this->isPost()) {
            $arrData = $this->getPost();
            $arrResult = $this->getService('InepZend\Module\Executor\Service\EmailHistoricoQuery')->registrarEmailHistorico($arrData['idHistoricoParametro']);
        }
        return $this->getViewClearContent(json_encode($arrResult));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function exportarAction()
    {
        $this->getService('InepZend\Module\Executor\Service\HistoricoExecucao')->exportarExecucao($this->getParamsFromRoute('idQuery'));
        return $this->getViewClearContent();
    }
}
