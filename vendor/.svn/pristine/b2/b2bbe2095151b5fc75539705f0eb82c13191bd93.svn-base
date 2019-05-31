<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractServiceCache;

class VwMunicipio extends AbstractServiceCache
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coMunicipio');
    }

    /**
     * @param array $arrCriteria
     * @param integer $intLimit
     * @return mix
     * 
     * @cache true
     */
    protected function suggestion($arrCriteria = null, $intLimit = null)
    {
        if (!is_numeric($intLimit))
            $intLimit = 5;
        return $this->getRepositoryEntity()->suggestion($arrCriteria, $intLimit);
    }

}
