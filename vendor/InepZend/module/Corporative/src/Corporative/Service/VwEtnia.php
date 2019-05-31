<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractService as AbstractServiceCache;

class VwEtnia extends AbstractServiceCache
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coEtnia');
    }

}
