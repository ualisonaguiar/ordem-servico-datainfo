<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;


class ArquivoPontoRepository extends Repository
{

    protected function getRegistroPontoNaoVinculado()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilderNotIn = $this->getEntityManager()->createQueryBuilder();
        $queryNot = $queryBuilderNotIn->select('ArquivoPontoUsuario')
            ->from('OrdemServico\Entity\ArquivoPontoUsuario', 'ArquivoPontoUsuario');
        $query = $queryBuilder->select($this->getAlias())
            ->from($this->getEntityName(), $this->getAlias())
            ->where($queryBuilder->expr()->notIn($this->getAlias() . '.id_arquivo_ponto', $queryNot->getDQL()))
            ->andWhere($this->getAlias() . '.tp_migracao = :tp_migracao')
            ->getQuery();
        return $this->executeQuery($query, ['tp_migracao' => ArquivoPonto::TP_MIGRACAO_PENDENTE], true);
    }
}
