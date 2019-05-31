<?php

namespace OrdemServico\Controller;

use OrdemServico\Controller\AbstractController;

class CatalogoServicoController extends AbstractController
{

    public function __construct($strController = null, $arrVariableMerge = null)
    {
        parent::__construct($strController, $arrVariableMerge);
        $this->arrPk = array('id_catalogo_servico');
    }

    public function migrarAtividadeCatalogoAction()
    {
//        $this->getService()->migrarAtividadeCatalogo();
        return $this->getViewClearContent('Migração concluída com sucesso.');
    }
}
