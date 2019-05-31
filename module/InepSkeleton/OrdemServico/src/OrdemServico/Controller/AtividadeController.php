<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;
use InepZend\WebService\Client\Corporative\Inep\RestCorp;

class AtividadeController extends AbstractController
{

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
        $this->arrPk = array('id_atividade');
        $this->arrMethodPk = array('getIdAtividade');
        $this->arrMethodPaging = array('getCoAtividade', 'getNoAtividade', 'getNuBaixoDefinido');
    }
}
