<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractService;

class VwPrograma extends AbstractService
{
    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coPrograma');
    }
}
