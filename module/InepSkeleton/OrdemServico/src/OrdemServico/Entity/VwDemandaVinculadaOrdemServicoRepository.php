<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;
use InepZend\Util\Date;
use OrdemServico\Entity\OrdemServico as OrdemServicoEntity;

class VwDemandaVinculadaOrdemServicoRepository extends Repository
{
    protected function gerarRelatorioDesempenho($arrDataPost)
    {
        $strAlias = $this->getAlias();
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select($this->getAlias())
            ->from($this->getEntityName(), $this->getAlias())
            ->where($strAlias . '.dt_emissao >= :dt_abertura_inicio')
            ->andWhere($strAlias . '.dt_prazo <= :dt_abertura_fim')
            ->andwhere($strAlias . '.tp_situacao = :tp_situacao');
        $arrDataPost['dt_abertura_inicio'] = Date::convertDate($arrDataPost['dt_abertura_inicio']) . ' 00:00:00';
        $arrDataPost['dt_abertura_fim'] = Date::convertDate($arrDataPost['dt_abertura_fim']) . ' 23:59:59';
        $arrDataPost['tp_situacao'] = OrdemServicoEntity::CO_SITUACAO_FINALIZADA;
        if (array_key_exists('no_executor', $arrDataPost)) {
            $queryBuilder->andWhere($strAlias . '.no_executor = :no_executor');
        }
        return $this->executeQuery($queryBuilder->getQuery(), $arrDataPost, true);
    }

    protected function gerarRelatorioPessoalDesempenho($arrDataPost)
    {
        $strSql = "
            select
              strftime('%m/%Y', vw_demanda.dt_abertura) periodo,
              sum(vw_demanda.vl_qma) soma,
              vw_demanda.no_executor
            from
              vw_demanda_vinculada_ordem_servico vw_demanda
            where
              vw_demanda.dt_abertura between :dt_abertura_inicio and :dt_abertura_fim";
        if (array_key_exists('no_executor', $arrDataPost)) {
            $arrCriteria = ['no_executor' => $arrDataPost['no_executor']];
            $arrWhere = $this->constructWhereParameter('vw_demanda', $arrCriteria, null, ['no_executor']);
            $strSql .= ' and ' . reset($arrWhere[0]);
            unset ($arrDataPost['no_executor']);
            $arrDataPost = array_merge($arrDataPost, $arrWhere[1]);
        }
        $strSql .= " group by strftime('%m/%Y', vw_demanda.dt_abertura), vw_demanda.no_executor order by vw_demanda.dt_abertura asc";
        $arrDataPost['dt_abertura_inicio'] = Date::convertDate($arrDataPost['dt_abertura_inicio']) . ' 00:00:00';
        $arrDataPost['dt_abertura_fim'] = Date::convertDate($arrDataPost['dt_abertura_fim']) . ' 23:59:59';
        return $this->executeSQL($strSql, $arrDataPost, true);
    }

    protected function relatorioOrdemServicoAcetei($arrDataPost)
    {
        $strAlias = $this->getAlias();
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select([
            $strAlias.'.id_ordem_servico',
            $strAlias.'.nu_ordem_servico',
            $strAlias.'.descricao_os',
        ])
            ->from($this->getEntityName(), $this->getAlias())
            ->where($strAlias . '.dt_emissao >= :dt_abertura_inicio')
            ->andWhere($strAlias . '.dt_prazo <= :dt_abertura_fim')
            ->andwhere($queryBuilder->expr()->in($strAlias . '.tp_situacao', ':tp_situacao'))
            ->groupBy($strAlias.'.nu_ordem_servico');

        $arrDataPost['dt_abertura_inicio'] = Date::convertDate($arrDataPost['dt_abertura_inicio']) . ' 00:00:00';
        $arrDataPost['dt_abertura_fim'] = Date::convertDate($arrDataPost['dt_abertura_fim']) . ' 23:59:59';
        $arrDataPost['tp_situacao'] = [OrdemServicoEntity::CO_SITUACAO_ABERTA, OrdemServicoEntity::CO_SITUACAO_ANALISE];
        return $this->executeQuery($queryBuilder->getQuery(), $arrDataPost, true);
    }
}
