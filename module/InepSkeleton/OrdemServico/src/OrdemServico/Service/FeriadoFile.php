<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceCache;
use InepZend\Service\ServiceAngularTrait;

class FeriadoFile extends AbstractServiceCache
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_feriado');
    }

    protected function getListaFeriadoIntervaloFetchPairs($strDataInical, $strDataFinal)
    {
        $arrDateFeriado = $this->getRepositoryEntity()->getListaFeriadoIntervalo($strDataInical, $strDataFinal);
        $arrDaraFetchPairs = [];
        foreach ($arrDateFeriado as $dateFeriado)
            $arrDaraFetchPairs[$dateFeriado->getDtFeriado()] = $dateFeriado->getNoFeriado();
        return $arrDaraFetchPairs;
    }
}
