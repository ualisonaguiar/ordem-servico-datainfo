<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;

class LogVerificacaoDadosFile extends AbstractService
{
    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_log_verificacao_dados');
    }

}
