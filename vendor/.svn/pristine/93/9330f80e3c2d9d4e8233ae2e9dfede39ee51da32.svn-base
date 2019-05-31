<?php

namespace InepZend\Module\Crontab\Common\Service\File;

use InepZend\Module\Crontab\Common\Service\File\AbstractServiceFile;

class PeriodoFile extends AbstractServiceFile
{

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_periodo');
    }

    public static function getNameFromIdPeriodo($intIdPeriodo = null)
    {
        if (empty($intIdPeriodo))
            return false;
        $periodoService = self::getServiceManager()->get('InepZend\Module\Crontab\Common\Service\File\PeriodoFile');
        $periodo = $periodoService->find(array('id_periodo' => $intIdPeriodo));
        if (!is_object($periodo))
            return $intIdPeriodo;
        return $periodo->getNoPeriodo();
    }

}
