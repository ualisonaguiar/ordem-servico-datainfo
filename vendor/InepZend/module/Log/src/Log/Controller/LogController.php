<?php

namespace InepZend\Module\Log\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\Module\Application\Controller\ReadmeController;
use InepZend\Paginator\Paginator;
use InepZend\Grid\Flexigrid\Flexigrid;
use InepZend\View\View;
use InepZend\Module\Log\Service\LogModule as LogModuleService;
use InepZend\Module\Application\Service\AutoloadConfig;
use InepZend\Util\String;
use InepZend\View\RenderTemplate;

/**
 * Classe responsavel pelas requisicoes para as funcionalides de listagem, visualizacao e download dos
 * arquivos de log gerado pela aplicacao.
 *
 * @package Log
 */
class LogController extends AbstractCrudController
{

    use RenderTemplate;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->arrMethodPk = array('ds_path');
        $this->arrMethodPaging = array(
            'no_file',
            array(
                'ds_path',
                Paginator::TYPE_LINK_DATA
            ),
            'ds_size',
            array(
                'dt_create',
                Paginator::TYPE_ROUTE,
                array(
                    'route' => 'log/merge',
                )
            ),
            'tp_level'
        );
    }

    /**
     * Action de inicio da tela de pesquisa do arquivo de log.
     *
     * @resource RSRC_LOG_INDEX
     * @return \InepZend\View\View
     */
    public function indexAction()
    {
        $this->clearInfoAjaxPaginator(true);
        $this->getService('InepZend\Module\Log\Service\LogModule')
                ->clearInformationLog($this->getParamsFromRoute('ds_path'));
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('form' => $this->getFormFilter(), 'formDownload' => $this->getFormDownload())));
    }

    /**
     * Metodo responsavel pela alimentacao da grid nas pesquisas feita via ajax na tela de pesquisa.
     *
     * @return object
     */
    public function ajaxPaginatorAction()
    {
        $strService = 'InepZend\Module\Log\Service\LogModule';
        $arrFilter = $this->getInfoAjaxFilter('filter');
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria', $strService);
        if (!empty($arrFilter))
            $arrCriteria = $arrFilter;
        return ((empty($arrFilter)) && (empty($arrCriteria))) ?
                $this->getViewClearContent((new Flexigrid())->getXml()) :
                parent::ajaxPaginatorAction(null, $strService, null, null, 10, true, $arrCriteria);
    }

    /**
     * Action responsavel para mostrar informacoes do arquivo de log.
     *
     * @resource RSRC_LOG_SHOW
     * @return \InepZend\View\View
     */
    public function showAction()
    {
        $strDsPath = $this->getParamsFromRoute('ds_path');
        if (empty($strDsPath))
            return $this->redirect()->toRoute('log');
        $logModuleService = $this->getService('InepZend\Module\Log\Service\LogModule');
        $strPathFile = base64_decode($strDsPath);
        $arrInfoFile = $logModuleService->getInformationFile($strPathFile);
        $arrInfoLogFile = $logModuleService->getApplicationLogInformation($strPathFile);
        $logModuleService->setInformationLogSession($arrInfoLogFile, $arrInfoFile['noFile']);
        $arrInfoLogFile = $this->ordinationInfoLog($arrInfoLogFile);
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('strDsPath' => $strDsPath, 'arrInfoLogFile' => $arrInfoLogFile)));
    }

    /**
     * Action responsavel pelo download dos arquivos de log selecionados.
     *
     * @return \InepZend\View\View
     */
    public function downloadFileAction()
    {
        $strServiceLogFile = 'InepZend\Module\Log\Service\LogFile';
        if ($this->isPost()) {
            $arrPathFilePost = $this->getPost('fileDownload');
            if (!String::isNullEmpty($arrPathFilePost))
                $this->getService($strServiceLogFile)->generateZipFile($arrPathFilePost);
        } else
            $this->getService($strServiceLogFile)->downloadFile($this->getParamsFromRoute('ds_path'));
        return $this->getViewClearContent();
    }

    /**
     * Action responsavel pelo merge entre os arquivos de log (info, critical e error).
     *
     * @return \InepZend\View\View
     */
    public function mergeAction()
    {
        $arrParamsRoute = $this->getParamsFromRoute();
        $strDateFile = $arrParamsRoute['ano'] . $arrParamsRoute['mes'] . $arrParamsRoute['dia'];
        $arrInfoLogFile = $this->getService('InepZend\Module\Log\Service\LogModule')
                ->mergeTypeLvelFileLog($strDateFile);
        $this->getService('InepZend\Module\Log\Service\LogModule')
                ->setInformationLogSession($arrInfoLogFile, $strDateFile);
        $arrInfoLogFile = $this->ordinationInfoLog($arrInfoLogFile);
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('strDateFile' => $strDateFile, 'arrInfoLogFile' => $arrInfoLogFile)));
    }

    /**
     * Metodo responsavel pelo retorno das informacoes referente ao log.
     *
     * @return \InepZend\View\View
     */
    public function ajaxInformationLogAction()
    {
        $strHtmlInformation = '';
        if ($this->isPost()) {
            $arrIdentificationLog = explode('|', $this->getPost('strIdentificationLog'));
            $arrInformationLogSession = $this->getService('InepZend\Module\Log\Service\LogModule')
                    ->getInformationLog($arrIdentificationLog[0]);
            $arrDataLog = $arrInformationLogSession[$arrIdentificationLog[1]]['log'][$arrIdentificationLog[2]];
            $strHtmlInformation = $this->renderTemplate('inep-zend/log/ajax-information-log', array('arrInfoLog' => $arrDataLog));
        }
        return $this->getViewClearContent($strHtmlInformation);
    }

    /**
     * Action de configuracao das opcoes de auditoria do log.
     *
     * @resource RSRC_LOG_CONFIG
     * @return \InepZend\View\View
     */
    public function configAction()
    {
        $form = $this->getFormConfig();
        if ($this->isPost())
            return $this->controlAfterSubmit($form, (array) $this->getDataToForm(), 'saveConfig', 'InepZend\Module\Log\Service\LogModule', false);
        $form->setData($this->getService('InepZend\Module\Log\Service\LogModule')->convertConfigToData(AutoloadConfig::getAutoloadConfig()));
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('form' => $form)));
    }
    
    public function ajaxHistoryPaginatorAction()
    {
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\Application\Service\AutoloadConfig', array('no_autor', 'no_file', 'dt_ocorrencia'), array('no_file'), 10, true, array('tp_file' => AutoloadConfig::TYPE_FILE_HISTORY));
    }

    /**
     * Metodo responsavel pelo retorno do formulario da tela de pesquisa.
     *
     * @return FormGenerator
     */
    protected function getFormFilter()
    {
        $form = $this->getForm('InepZend\Module\Log\Form\Log');
        $form->prepareElementsFilter();
        return $form;
    }

    /**
     * Metodo responsavel pelo retorno do formulario da tela de selecionar arquivos
     * de log para download.
     *
     * @return FormGenerator
     */
    protected function getFormDownload()
    {
        $form = $this->getForm('InepZend\Module\Log\Form\DownloadFile');
        $form->prepareElementsFilter();
        return $form;
    }

    /**
     * Metodo responsavel pelo retorno do formulario da funcionalidade de configuracao.
     *
     * @return FormGenerator
     */
    protected function getFormConfig()
    {
        $form = $this->getForm('InepZend\Module\Log\Form\Log');
        $form->prepareElementsConfig();
        return $form;
    }

    /**
     * Metodo responsavel pela ordenacao das informacoes contidas no arquivo de log.
     *
     * @param array $arrInfoLogFile
     * @return string
     */
    protected function ordinationInfoLog($arrInfoLogFile)
    {
        $arrInformacaoLogArquivo = array();
        foreach ($arrInfoLogFile as $arrValueLog) {
            $strUserSystem = $arrValueLog[LogModuleService::TYPE_KEY_DATA]['name'] . ' - ' . $arrValueLog[LogModuleService::TYPE_KEY_DATA]['usersystem'];
            $arrInformacaoLogArquivo[$strUserSystem] = $arrValueLog;
        }
        unset($arrInfoLogFile);
        ksort($arrInformacaoLogArquivo, SORT_ASC);
        $strChave = LogModuleService::ANONYMOUS_USER . ' - ' . LogModuleService::CO_ANONYMOUS_USER;
        if (array_key_exists($strChave, $arrInformacaoLogArquivo)) {
            $arrUsuarioAnonimo = $arrInformacaoLogArquivo[$strChave];
            if ($arrUsuarioAnonimo) {
                unset($arrInformacaoLogArquivo[$strChave]);
                array_push($arrInformacaoLogArquivo, $arrUsuarioAnonimo);
            }
        }
        return $arrInformacaoLogArquivo;
    }

}
