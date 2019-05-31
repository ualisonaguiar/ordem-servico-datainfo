<?php

namespace InepZend\Module\Executor\Controller;

use InepZend\Controller\AbstractControllerPaginator;
use Zend\Mvc\MvcEvent;
use InepZend\Module\Executor\Form\EnvioEmail as EnvioEmailForm;
use InepZend\View\View;
use InepZend\Util\FileSystem;
use InepZend\Module\Executor\Message\Message;

class EmailHistoricoController extends AbstractControllerPaginator
{
    use Message, SecurityAcl;

    public function onDispatch(MvcEvent $event)
    {
        return $this->hasAccessAdministrador($event);
    }

    public function __construct()
    {
        $this->arrMethodPaging = array('DS_USUARIO', 'DT_EXECUCAO', 'TP_SITUACAO');
        $this->arrMethodPk = array('ID_HISTORICO_EXECUCAO');
        $this->strService = 'InepZend\Module\Executor\Service\EmailHistoricoQuery';
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function indexAction()
    {
        $intIdEmail = $this->getParamsFromRoute('idEmail');
        $arrConfigEmail = $this->getService()->getInformation(($intIdEmail) ? $intIdEmail : null);
        $email = $arrConfigEmail['info'];
        if (!$email) {
            $this->getServiceMessage()->addMessageError($this->strMsgError02);
            return $this->redirect()->toRoute('inicial');
        }
        $form = new EnvioEmailForm();
        $form->prepareElemenTelaEnvio($intIdEmail);
        $arrData = ($this->isPost()) ? $this->getPost() : $this->getService('config')['executor']['configuracao-envio-email'];
        $arrData['dsSituacao'] = $email->getInAtivo();
        $arrData['idEmail'] = $email->getIdEmail();
        return $this->controlAfterSubmit(
            $form,
            $arrData,
            'saveEmail',
            $this->strService,
            'historico-envio-operacao',
            self::getParamMenu(),
            $this->strMsgSucesso01
        );
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxRemoverAction()
    {
        $arrStatus = array();
        if ($this->isPost()) {
            $arrPost = $this->getPost();
            $arrStatus = $this->getService()->removeItemListaEnvio($arrPost['idHistoricoParametro']);
        }
        return $this->getViewClearContent(json_encode($arrStatus));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function historicoAction()
    {
        $form = new EnvioEmailForm();
        $form->prepareElemenTelaHistoricoEnvio();
        return new View(array_merge(array('form' => $form), self::getParamMenu()));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxListagemAction()
    {
        $this->arrMethodPaging = array('DS_DESTINATARIO', 'DS_ASSUNTO', 'DT_ENVIO', 'TP_SITUACAO', 'ID_EMAIL');
        $this->arrMethodPk = array('ID_EMAIL');
        return $this->ajaxPaginatorAction(null, null, null, null, null, null, null, 'getListagemHistoricoEnvio');
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxListagemHistoricoAction()
    {
        return parent::ajaxPaginatorAction(
            null,
            null,
            null,
            null,
            null,
            null,
            array('idEmail' => $this->getParamsFromRoute('idEmail')),
            null
        );
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function downloadAction()
    {
        $dataEmail = $this->getService('InepZend\Module\Executor\Service\Email')->find((int) $this->getParamsFromRoute('idEmail'));
        $strBasePath = $dataEmail->getDsPathAnexo();
        FileSystem::downloadContent(
            end(explode('/', $strBasePath)),
            FileSystem::getContentFromFile($strBasePath),
            'txt'
        );
        return $this->getViewClearContent();
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function reenviarEmailAction()
    {
        $arrStatus = $this->getService()->reenviarEmail($this->getPost()['idEmail']);
        return $this->getViewClearContent(json_encode($arrStatus));
    }

    /**
     * @resource RSRC_EXECUTOR_GUEST
     */
    public function ajaxOperacaoVinculadaAction()
    {
        $strHtml = $this->getService()
            ->getListagemOperacaoVinculada($this->getParamsFromRoute('idEmail'));
        return $this->getViewClearContent($strHtml);
    }
}
