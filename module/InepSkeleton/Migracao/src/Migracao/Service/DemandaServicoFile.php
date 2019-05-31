<?php

namespace Migracao\Service;

use Migracao\Service\AbstractServiceFile;

class DemandaServicoFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_demanda', 'id_catalogo_servico_atividade');
    }
}
