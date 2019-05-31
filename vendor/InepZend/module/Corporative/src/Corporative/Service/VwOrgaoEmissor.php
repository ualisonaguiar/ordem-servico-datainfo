<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractServiceCache;

class VwOrgaoEmissor extends AbstractServiceCache
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coOrgaoEmissor');
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
            $intLimit = 7;
        return $this->getRepositoryEntity()->suggestion($arrCriteria, $intLimit);
    }

}
