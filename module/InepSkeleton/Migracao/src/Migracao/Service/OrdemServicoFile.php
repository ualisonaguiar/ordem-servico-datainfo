<?php

namespace Migracao\Service;

use InepZend\Service\AbstractService;

class OrdemServicoFile extends AbstractService
{
    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_ordem_servico');
    }
}
