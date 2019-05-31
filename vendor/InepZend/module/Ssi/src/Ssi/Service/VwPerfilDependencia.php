<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Service\AbstractService;

class VwPerfilDependencia extends AbstractService
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('idPerfilDependencia');
    }

}
