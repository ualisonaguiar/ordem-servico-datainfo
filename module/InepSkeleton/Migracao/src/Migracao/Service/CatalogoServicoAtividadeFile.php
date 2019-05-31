<?php

namespace Migracao\Service;

use InepZend\Service\AbstractService;

class CatalogoServicoAtividadeFile extends AbstractService
{
    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_catalogo_servico_atividade');
    }
}
