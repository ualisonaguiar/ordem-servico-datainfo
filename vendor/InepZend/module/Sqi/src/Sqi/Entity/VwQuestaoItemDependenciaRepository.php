<?php

namespace InepZend\Module\Sqi\Entity;

use InepZend\Repository\Repository;

class VwQuestaoItemDependenciaRepository extends Repository
{

    public function getQuestaoItemDependencia($intIdQuestaoItem, $intCoProjeto, $intCoEvento)
    {
        $arrCriteria = array(
            'idQuestaoItemConfigPai' => $intIdQuestaoItem,
            'coProjeto' => $intCoProjeto,
            'coEvento' => $intCoEvento,
        );
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('QID')
                ->from('InepZend\Module\Sqi\Entity\VwQuestaoItemDependencia', 'QID')
                ->leftJoin('InepZend\Module\Sqi\Entity\VwQuestionarioProjeto', 'QP', 'WITH', 'QP.idQuestaoItemConfiguracao = QID.idQuestaoItemConfiguracao ')
                ->where('QID.idQuestaoItemConfigPai = :idQuestaoItemConfigPai')
                ->andWhere('QID.coProjeto = :coProjeto')
                ->andWhere('QID.coEvento = :coEvento')
                ->orderBy('QP.idQuestionarioProjeto, QP.nuOrdemGrupo, QP.nuOrdemSubgrupo, QP.nuOrdemQuestao, QP.nuOrdemItem')
                ->getQuery()
                ->setParameters($arrCriteria);
        return $this->executeQuery($query)->getResult();
    }

    public function getQuestaoItemConfiguracao($intIdQuestaoItemConfiguracao, $intCoProjeto, $intCoEvento)
    {
        $arrCriteria = array(
            'idQuestaoItemConfiguracao' => $intIdQuestaoItemConfiguracao,
            'coProjeto' => $intCoProjeto,
            'coEvento' => $intCoEvento
        );
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder->select('QP')
                ->from('InepZend\Module\Sqi\Entity\VwQuestaoItemDependencia', 'QID')
                ->leftJoin('InepZend\Module\Sqi\Entity\VwQuestionarioProjeto', 'QP', 'WITH', 'QP.idQuestaoItemConfiguracao = QID.idQuestaoItemConfiguracao ')
                ->where('QID.idQuestaoItemConfiguracao = :idQuestaoItemConfiguracao')
                ->andWhere('QID.coProjeto = :coProjeto')
                ->andWhere('QID.coEvento = :coEvento')
                ->orderBy('QP.idQuestionarioProjeto, QP.nuOrdemGrupo, QP.nuOrdemSubgrupo, QP.nuOrdemQuestao, QP.nuOrdemItem')
                ->getQuery()
                ->setParameters($arrCriteria);
        return $this->executeQuery($query)->getResult();
    }

}
