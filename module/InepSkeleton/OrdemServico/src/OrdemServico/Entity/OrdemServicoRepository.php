<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;
use InepZend\Util\Date;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;

class OrdemServicoRepository extends Repository
{
    protected function getListagemOrdemServicoRelatorio($arrData)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $strAlias = $this->getAlias();
        $queryBuilder->select($strAlias)
            ->from($this->getEntityName(), $strAlias)
            ->where($strAlias . '.tp_situacao = :tp_situacao')
            ->andWhere($strAlias . '.dt_prazo BETWEEN :dt_prazo_inicio and :dt_prazo_fim')
            ->orderBy($strAlias . '.nu_ordem_servico', 'asc');
        $arrParameter = [
            'tp_situacao' => OrdemServicoEntity::CO_SITUACAO_FINALIZADA,
            'dt_prazo_inicio' => Date::convertDate($arrData['dt_prazo_inicio'], 'Y-m-d') . ' 00:00:00',
            'dt_prazo_fim' => Date::convertDate($arrData['dt_prazo_fim'], 'Y-m-d') . ' 23:59:59',
        ];
        return $this->executeQuery($queryBuilder->getQuery(), $arrParameter, true);
    }

    protected function getListagem($arrData)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $strAlias = $this->getAlias();
        $queryBuilder->select($strAlias)
            ->distinct()
            ->from($this->getEntityName(), $strAlias)
            ->leftJoin(
                'OrdemServico\Entity\OrdemServicoAceite',
                'OrdemServicoAceite',
                'with',
                'OrdemServicoAceite.idOrdemServico = ' . $strAlias . '.id_ordem_servico'
            )
            ->orderBy($strAlias . '.nu_ordem_servico', 'desc');
        if (isset($arrData['tp_gestao'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->in('OrdemServicoAceite.inGestao', ':tp_gestao'));
            $arrData['tp_gestao'] = explode(',', $arrData['tp_gestao']);
        }
        if (isset($arrData['nu_ordem_servico'])) {
            $queryBuilder->andWhere($strAlias . '.nu_ordem_servico = :nu_ordem_servico');
        }
        if (isset($arrData['tp_situacao'])) {
            $queryBuilder->andWhere($strAlias . '.tp_situacao = :tp_situacao');
        }
        if (isset($arrData['dt_prazo_inicio']) && isset($arrData['dt_prazo_fim'])) {
            $arrData['dt_prazo_inicio'] = Date::convertDate($arrData['dt_prazo_inicio'], 'Y-m-d') . ' 00:00:00';
            $arrData['dt_prazo_fim'] = Date::convertDate($arrData['dt_prazo_fim'], 'Y-m-d') . ' 00:00:00';
            $queryBuilder->andWhere($queryBuilder->expr()->between($strAlias . '.dt_prazo', ':dt_prazo_inicio', ':dt_prazo_fim'));
        }
        $query = $queryBuilder->getQuery();
        return $this->executeQuery($query, $arrData, true);
    }
}
