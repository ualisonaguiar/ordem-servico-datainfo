<?php

namespace InepZend\Module\Sqi\Service;

use InepZend\Service\AbstractService;

class VwSituacaoQuestionario extends AbstractService
{

    public function getSituacaoQuestionario($intCoProjeto, $intCoEvento)
    {
        $arrVwSituacaoQuestionario = $this->findBy(array('coProjeto' => $intCoProjeto, 'coEvento' => $intCoEvento));
        return ($arrVwSituacaoQuestionario) ? $arrVwSituacaoQuestionario[0] : $arrVwSituacaoQuestionario;
    }

}
