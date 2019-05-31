<?php

namespace InepZend\Module\Sqi\Entity;

use InepZend\Repository\Repository;

class VwQuestionarioProjetoRepository extends Repository
{

    public function getQuestionario($intCoProjeto, $intCoEvento, $intIdQuestionario = null, $intCoQuestionario = null)
    {
        $arrCriteria = array(
            'coProjeto' => $intCoProjeto,
            'coEvento' => $intCoEvento,
        );
        if ($intIdQuestionario != null)
            $arrCriteria['idQuestionarioProjeto'] = $intIdQuestionario;
        if ($intCoQuestionario != null)
            $arrCriteria['coQuestionario'] = $intCoQuestionario;
        $arrOrderBy = array(
            'idQuestionarioProjeto' => 'asc',
            'nuOrdemGrupo' => 'asc',
            'nuOrdemSubgrupo' => 'asc',
            'nuOrdemQuestao' => 'asc',
            'nuOrdemItem' => 'asc',
        );
        return $this->findBy($arrCriteria, $arrOrderBy);
    }

    public function getQuestionarioProjeto($intCoProjeto, $intCoEvento, $intIdQuestionario = null, $intCoQuestionario = null)
    {
        $arrCriteria = array(
            'coProjeto' => (int) $intCoProjeto,
            'coEvento' => (int) $intCoEvento,
        );
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('QP')
                ->from('InepZend\Module\Sqi\Entity\VwQuestionarioProjeto', 'QP')
                ->where('QP.coProjeto = :coProjeto')
                ->andWhere('QP.coEvento = :coEvento');
        if ($intIdQuestionario != null) {
            $arrCriteria['idQuestionarioProjeto'] = (int) $intIdQuestionario;
            $queryBuilder->andWhere('QP.idQuestionarioProjeto = :idQuestionarioProjeto');
        }
        if ($intCoQuestionario != null) {
            $arrCriteria['coQuestionario'] = (int) $intCoQuestionario;
            $queryBuilder->andWhere('QP.coQuestionario = :coQuestionario');
        }
        $query = $queryBuilder->orderBy('QP.idQuestionarioProjeto, QP.nuOrdemGrupo, QP.nuOrdemSubgrupo, QP.nuOrdemQuestao, QP.nuOrdemItem')
                ->getQuery()
                ->setParameters($arrCriteria);

        return $this->executeQuery($query)->getResult();
    }

    public function getQuestoesDependencia($intCoProjeto, $intCoEvento)
    {
        $arrCriteria = array(
            'coProjeto' => $intCoProjeto,
            'coEvento' => $intCoEvento,
        );
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select("QID.idQuestaoItemConfiguracao")
                ->distinct(true)
                ->from('InepZend\Module\Sqi\Entity\VwQuestaoItemDependencia', 'QID')
                ->where('QID.coProjeto = :coProjeto')
                ->andWhere('QID.coEvento = :coEvento')
                ->getQuery()
                ->setParameters($arrCriteria);
        $questoesDependencia = $this->executeQuery($query)->getResult();
        foreach ($questoesDependencia as $questao)
            $arrQuestoesDependencia[] = $questao['idQuestaoItemConfiguracao'];
        # Indice adicional para nao dar erro quando o array estiver vazio
        $arrQuestoesDependencia[] = '9999999';
        return $arrQuestoesDependencia;
    }

}
