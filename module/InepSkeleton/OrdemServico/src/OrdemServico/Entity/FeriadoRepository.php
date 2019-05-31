<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;
use OrdemServico\Entity\Feriado as FeriadoFileEntity;

class FeriadoRepository extends Repository
{
    protected function getListaFeriadoIntervalo($strDataInical, $strDataFinal)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $strAlias = $this->getAlias();
        $query = $queryBuilder->select($strAlias)
            ->from($this->getEntityName(), $this->getAlias())
            ->where($queryBuilder->expr()->between($strAlias . '.dt_feriado', ':data_inicial', ':data_final'))
            ->andWhere($strAlias . '.tp_feriado in (:nacional, :facultativo)')
            ->andWhere($strAlias . '.no_feriado not in (:dia_servidor_publico)')
            ->getQuery();
        return $this->executeQuery(
            $query,
            [
                'data_inicial' => $strDataInical,
                'data_final' => $strDataFinal,
                'nacional' => FeriadoFileEntity::CO_TP_FERIADO_NACIONAL,
                'facultativo' => FeriadoFileEntity::CO_TP_FERIADO_FACULTATIVO,
                'dia_servidor_publico' => 'Dia do Servidor Público - art. 236 da Lei nº 8.112, de 11 de dezembro de 1990',
            ],
            true
        );
    }
}
