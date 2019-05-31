<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractServiceCache;

class Municipio extends AbstractServiceCache
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coMunicipio');
    }

}
