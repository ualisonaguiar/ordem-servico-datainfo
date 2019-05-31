<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;


class CatalogoServicoRepository extends Repository
{

    public function listagem($arrCriteria, $strField = 'no_catalogo_servico', $strTypeOrder = 'asc')
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $strAlias = $this->getAlias();
        $queryBuilder->select($strAlias)
            ->from($this->getEntityName(), $strAlias)
            ->orderBy($strAlias . '.' . $strField, $strTypeOrder);
        if (isset($arrCriteria['no_catalogo_servico'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->like('LOWER(' . $strAlias . '.no_catalogo_servico)', 'LOWER(:no_catalogo_servico)'));
            $arrCriteria['no_catalogo_servico'] = '%' . $arrCriteria['no_catalogo_servico'] . '%';
        }
        return $this->executeQuery($queryBuilder->getQuery(), $arrCriteria, true);
    }
}