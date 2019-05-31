<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceCache;
use InepZend\Service\ServiceAngularTrait;

class LogLancamentoFile extends AbstractServiceCache
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_log_lancamento');
    }
}
