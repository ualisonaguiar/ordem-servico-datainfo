<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;
use InepZend\Util\Date;
use InepZend\Paginator\Paginator;
use OrdemServico\Entity\Demanda as DemandaEntity;

class DemandaRepository extends Repository
{

    protected function getListDemandaSemOrdemServico($arrData = array())
    {
        if (!is_array($arrData)) {
            $arrData = [];
        }
        try {
            $queryBuilder = $this->getEntityManager()->createQueryBuilder();
            $strOrdemServicoDemanda = $queryBuilder->select('ordemServicoDemanda.id_demanda')
                    ->from('OrdemServico\Entity\OrdemServicoDemanda', 'ordemServicoDemanda')
                    ->getDQL();

            $queryBuilder = $this->getEntityManager()->createQueryBuilder();
            $strAlias = $this->getAlias();
            $queryBuilder->select($strAlias)
                    ->from($this->getEntityName(), $strAlias)
                    ->where($queryBuilder->expr()->notIn($strAlias . '.id_demanda', $strOrdemServicoDemanda))
                    ->andWhere($strAlias . '.tp_situacao = :tp_situacao')
                    ->orderBy($strAlias . '.dt_abertura', 'desc')
                    ->orderBy($strAlias . '.id_demanda', 'asc');

            $arrParameter = array(
                'tp_situacao' => DemandaEntity::SITUACAO_ATIVO
            );
            if ($arrData['no_executor']) {
                $queryBuilder->andWhere($strAlias . '.no_executor = :no_executor');
                $arrParameter['no_executor'] = $arrData['no_executor'];
            }
            if ($arrData['tipo_atividade']) {
                $queryBuilder->andWhere($strAlias . '.id_atividade = :tipo_atividade');
                $arrParameter['tipo_atividade'] = $arrData['tipo_atividade'];
            }
            if ($arrData['dt_abertura_inicio'] && $arrData['dt_abertura_fim']) {
                $queryBuilder->andWhere($strAlias . '.dt_abertura BETWEEN :dt_abertura_inicio and :dt_abertura_fim');
                $arrParameter['dt_abertura_inicio'] = Date::convertDateTemplate($arrData['dt_abertura_inicio']);
                $arrParameter['dt_abertura_fim'] = Date::convertDateTemplate($arrData['dt_abertura_fim']);
            }
            return $this->executeQuery($queryBuilder->getQuery(), $arrParameter, true);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQLQuery = null)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $strAlias = $this->getAlias();
        $queryBuilder->select(
            array(
                $strAlias . '.id_demanda',
                $strAlias . '.no_demanda',
                'catalogo.no_catalogo_servico ',
                'catalogo.area_assessoria',
                $strAlias . '.no_executor',
                $strAlias . '.dt_abertura',
                $strAlias . '.tp_situacao',
                'ordemServico.nu_ordem_servico',
            )
        )
            ->from($this->getEntityName(), $strAlias)
            ->innerJoin(
                    'OrdemServico\Entity\DemandaServico',
                    'demanda_servico',
                    'with',
                    'demanda_servico.id_demanda = ' . $strAlias . '.id_demanda'
            )
            ->innerJoin(
                    'OrdemServico\Entity\CatalogoServicoAtividade',
                    'servico_atividade',
                    'with',
                    'servico_atividade.id_catalogo_servico_atividade = demanda_servico.id_catalogo_servico_atividade'
            )
            ->innerJoin(
                'OrdemServico\Entity\CatalogoServico',
                'catalogo',
                'with',
                'catalogo.id_catalogo_servico = servico_atividade.id_catalogo_servico'
            )
            ->leftJoin(
                'OrdemServico\Entity\OrdemServicoDemanda',
                'OrdemServicoDemanda',
                'with',
                'OrdemServicoDemanda.id_demanda = ' . $strAlias .'.id_demanda'
            )
            ->leftJoin(
                'OrdemServico\Entity\OrdemServico',
                'ordemServico',
                'with',
                'ordemServico.id_ordem_servico = OrdemServicoDemanda.id_ordem_servico'
            )
//            ->orderBy($strAlias . '.dt_abertura', 'desc')
            ->orderBy($strAlias . '.dt_abertura', 'desc');
        if (!empty($arrCriteria)) {
            if (array_key_exists('id_usuario', $arrCriteria))
                $queryBuilder->andWhere($strAlias . '.id_usuario = :id_usuario');
            if (array_key_exists('tp_situacao', $arrCriteria))
                $queryBuilder->andWhere($strAlias . '.tp_situacao = :tp_situacao');
            if (array_key_exists('id_catalogo_servico', $arrCriteria))
                $queryBuilder->andWhere('catalogo.id_catalogo_servico = :id_catalogo_servico');
            if (array_key_exists('dt_abertura_inicio', $arrCriteria)) {
                $queryBuilder->andWhere($strAlias . '.dt_abertura >= :dt_abertura_inicio');
                $arrCriteria['dt_abertura_inicio'] = Date::convertDate($arrCriteria['dt_abertura_inicio']);
            }
            if (array_key_exists('dt_abertura_fim', $arrCriteria)) {
                $queryBuilder->andWhere($strAlias . '.dt_abertura <= :dt_abertura_fim');
                $arrCriteria['dt_abertura_fim'] = Date::convertDate($arrCriteria['dt_abertura_fim']);
            }
            if (array_key_exists('no_demanda', $arrCriteria)) {
                $arrCriteria['no_demanda'] = '%' . $arrCriteria['no_demanda'] . '%';
                $queryBuilder->andWhere($queryBuilder->expr()->like($strAlias . '.no_demanda', ':no_demanda'));
            }
        }
        $query = $queryBuilder->getQuery();
        $booRelatorio = array_key_exists('relatorio', $arrCriteria);
        unset($arrCriteria['relatorio']);
        $arrResult = $this->prepareResult($this->executeQuery($query, $arrCriteria, true));
        if ($booRelatorio) {
            return $arrResult;
        }
        return new Paginator($arrResult, $intPage, $intItemPerPage);
    }

    protected function prepareResult($arrResult)
    {
        $arrNew = [];
        if ($arrResult) {
            $strIdDemanda = null;
            foreach ($arrResult as $strField => $arrValue) {
                if ($arrValue["id_demanda"] !== $strIdDemanda) {
                    $arrResult[$strField]['dt_abertura'] = (Date::isDateBase($arrValue['dt_abertura'])) ? Date::convertDateBase($arrValue['dt_abertura']) : $arrValue['dt_abertura'];
                    $arrResult[$strField]['tp_situacao'] = DemandaEntity::$arrSituacao[$arrValue['tp_situacao']];
                    $arrNew[] = $arrResult[$strField];
                }
                $strIdDemanda = $arrValue["id_demanda"];
            }
        }
        return $arrNew;
    }
}
