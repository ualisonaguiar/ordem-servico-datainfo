<?php

namespace InepZend\Module\Crontab\AdminCron\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\Grid\Flexigrid\Flexigrid;

class AdminCronController extends AbstractCrudController
{

    public function __construct()
    {
        $this->arrMethodPk = array('getIdCron');
        $this->arrMethodPaging = array('getNoCron', 'getDsUrl', array('getInAtivo', 'text', array(), array('\InepZend\Util\Format::convertToStatus')), 'getDtCadastro');
    }

    public function indexAction()
    {
//        */1 * * * * root wget -O - -q http://<url da aplicacao>/cron > /var/log/crontab/info-cron.txt 2>> /var/log/crontab/erro-cront.txt
//        d($this->getService('InepZend\Module\Crontab\Common\Service\File\CronFile')->findBy());
//        d($this->getService('InepZend\Module\Crontab\Common\Service\File\PeriodoFile')->findBy());
//        d($this->getService('InepZend\Module\Crontab\Common\Service\File\AndamentoFile')->findBy(), 1);
        return parent::indexAction($this->getForm()->prepareElementsFilter());
    }

    public function addAction()
    {
        return parent::addAction($this->getForm()->prepareElements(), null, null, 'admincron');
    }

    public function editAction()
    {
        $arrDataMerge = (array) $this->getPost();
        if ((!empty($arrDataMerge)) && (@empty($arrDataMerge['periodicidade'])))
            $arrDataMerge['periodicidade'] = array();
        return parent::editAction($this->getForm()->prepareElements(), array_merge($this->getService()->getDataToSave($this->getParamsFromRoute('id_cron')), $arrDataMerge), null, 'admincron');
    }

    public function ajaxPaginatorAction()
    {
        return parent::ajaxPaginatorAction(null, 'InepZend\Module\Crontab\Common\Service\File\CronFile', null, null, 10, true, $this->getInfoAjaxPaginator('arrCriteria'));
    }

    public function ajaxPaginatorAndamentoAction()
    {
        $arrCriteria = $this->getInfoAjaxPaginator('arrCriteria');
        return (empty($arrCriteria)) ? $this->getViewClearContent((new Flexigrid())->getXml()) : parent::ajaxPaginatorAction(null, 'InepZend\Module\Crontab\Common\Service\File\AndamentoFile', array(array('getIdPeriodo', 'text', array(), array('\InepZend\Module\Crontab\Common\Service\File\PeriodoFile::getNameFromIdPeriodo')), 'getTpAndamentoHtml', 'getDtAndamento'), array('getIdAndamento'), 10, true, $arrCriteria, 'findByPagedCron');
    }

}
