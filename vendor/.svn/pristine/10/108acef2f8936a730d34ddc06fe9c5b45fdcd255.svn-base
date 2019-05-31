<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractService;

class VwProjeto extends AbstractService
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coProjeto');
    }

    public static function getNameFromCoProjeto($intCoProjeto = null)
    {
        if (empty($intCoProjeto))
            return false;
        $arrVwProjeto = self::getServiceManager()->get('InepZend\Module\Corporative\Service\VwProjeto')->findBy(array('coProjeto' => $intCoProjeto));
        if ((!is_array($arrVwProjeto)) || (empty($arrVwProjeto)))
            return $intCoProjeto;
        $vwProjeto = reset($arrVwProjeto);
        return $vwProjeto->getNoProjeto();
    }

}
