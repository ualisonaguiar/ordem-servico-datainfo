<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;
use InepZend\Paginator\Paginator;
use InepZend\Util\Format;

class UsuarioRepository extends Repository
{
    public function findByPaged(
        array $arrCriteria = null,
        $strSortName = null,
        $strSortOrder = null,
        $intPage = 1,
        $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT,
        $mixDQLQuery = null
    )
    {
        $strAlias = $this->getAlias();
        if (!$strSortName) {
            $strSortName = $strAlias . '.no_usuario';
            $strSortOrder = 'asc';
        }
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select($strAlias)
            ->from($this->getEntityName(), $strAlias)
            ->addOrderBy($strSortName, $strSortOrder);

        if (array_key_exists('no_usuario', $arrCriteria)) {
            $queryBuilder->andWhere($queryBuilder->expr()->like($strSortName, ':no_usuario'));
            $arrCriteria['no_usuario'] = '%' . $arrCriteria['no_usuario'] . '%';
        }
        if (array_key_exists('nu_pis', $arrCriteria)) {
            $queryBuilder->andWhere($strAlias . '.nu_pis = :nu_pis');
            $arrCriteria['nu_pis'] = Format::clearMask($arrCriteria['nu_pis']);
        }
        if (array_key_exists('tp_vinculo', $arrCriteria)) {
            $queryBuilder->andWhere($strAlias . '.tp_vinculo = :tp_vinculo');
            $arrCriteria['tp_vinculo'] = Format::clearMask($arrCriteria['tp_vinculo']);
        }
        return new Paginator(
            $this->executeQuery($queryBuilder->getQuery(), $arrCriteria, true),
            $intPage,
            $intItemPerPage
        );
    }
}
