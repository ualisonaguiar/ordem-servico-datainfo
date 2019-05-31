<?php

namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;

class AndamentoFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id_andamento');
    }

}
