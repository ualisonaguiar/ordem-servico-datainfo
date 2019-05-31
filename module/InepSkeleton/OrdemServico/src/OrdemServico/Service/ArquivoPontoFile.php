<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;

class ArquivoPontoFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_arquivo_ponto');
    }

    protected function getRegistroPontoNaoVinculado()
    {
        return $this->getRepositoryEntity()->getRegistroPontoNaoVinculado();
    }
}
