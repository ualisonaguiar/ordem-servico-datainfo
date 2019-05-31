<?php

namespace InepZend\Module\Crontab\Common\Service\File;

use InepZend\Module\Crontab\Common\Service\File\AbstractServiceFile;
use InepZend\Paginator\Paginator;

class AndamentoFile extends AbstractServiceFile
{

    const RUNNING = 'running';
    const FAILURE = 'failure';
    const COMPLETED = 'completed';

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_andamento');
    }

    protected function findByPagedCron(array $arrCriteria = array(), $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT)
    {
        if (@empty($arrCriteria['id_cron']))
            return array();
        $arrCriteria['id_cron'] = (integer) $arrCriteria['id_cron'];
        $arrPeriodo = $this->getService('InepZend\Module\Crontab\Common\Service\File\PeriodoFile')->findBy($arrCriteria);
        if (!is_array($arrPeriodo))
            return array();
        $arrRegister = array();
        $andamentoService = $this->getService('InepZend\Module\Crontab\Common\Service\File\AndamentoFile');
        foreach ($arrPeriodo as $periodo) {
            $arrAndamento = $andamentoService->findBy(array('id_periodo' => $periodo->getIdPeriodo()));
            if (is_array($arrAndamento))
                foreach ($arrAndamento as $andamento)
                    $arrRegister[$andamento->getIdAndamento()] = $andamento;
        }
        krsort($arrRegister);
        return $this->findByPaged(array(), $strSortName, $strSortOrder, $intPage, $intItemPerPage, array_values($arrRegister));
    }

}
