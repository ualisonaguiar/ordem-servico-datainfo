<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\Service\AbstractServiceFile;

class CategoriaFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('co_categoria');
    }

}
