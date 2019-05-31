<?php

namespace InepZend\Module\UnitTest\Service;

use InepZend\Service\AbstractServiceCache;

class IndexCache extends AbstractServiceCache
{

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, (($strService == null) ? __CLASS__ : $strService));
        $this->arrPk = array('co_subcategoria');
        $this->strEntity = 'InepZend\Module\UnitTest\Entity\Subcategoria';
    }

}
