<?php

namespace Migracao\Service;

use Migracao\Service\AbstractServiceFile;

class OrdemServicoDemandaFile extends AbstractServiceFile
{
    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_ordem_servico_demanda');
    }
}
