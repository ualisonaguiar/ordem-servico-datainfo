<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;

class AtividadeFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_atividade');
    }

}
