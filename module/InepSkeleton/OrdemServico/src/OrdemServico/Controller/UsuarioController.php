<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;
use InepZend\WebService\Client\Corporative\Inep\RestCorp;

class UsuarioController extends AbstractController
{

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
        $this->arrPk = array('id_usuario');
        $this->arrMethodPk = array('getIdUsuario');
        $this->arrMethodPaging = array('getIdUsuario', 'getNoUsuario');
    }
}
