<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\Service\AbstractService;

class Categoria extends AbstractService
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('co_categoria');
    }

}
