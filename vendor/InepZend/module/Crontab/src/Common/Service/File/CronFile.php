<?php

namespace InepZend\Module\Crontab\Common\Service\File;

use InepZend\Module\Crontab\Common\Service\File\AbstractServiceFile;

class CronFile extends AbstractServiceFile
{

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_cron');
    }

}
