<?php

namespace Migracao\Service;

use InepZend\Service\AbstractService;

class AtividadeFile extends AbstractService
{

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_atividade');
    }

}
