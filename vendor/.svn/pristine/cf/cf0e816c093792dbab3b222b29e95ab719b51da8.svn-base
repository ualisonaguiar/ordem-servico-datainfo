<?php

namespace InepZend\Module\Corporative\Service;

use InepZend\Service\AbstractService;

class VwProjetoEvento extends AbstractService
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('coProjeto', 'coEvento');
    }
    
    public static function getNameFromCoProjetoEvento($intCoProjeto = null, $intCoEvento = null)
    {
        if ((empty($intCoProjeto)) || (empty($intCoEvento)))
            return false;
        $arrVwProjetoEvento = self::getServiceManager()->get('InepZend\Module\Corporative\Service\VwProjetoEvento')->findBy(array('coProjeto' => $intCoProjeto, 'coEvento' => $intCoEvento));
        if ((!is_array($arrVwProjetoEvento)) || (empty($arrVwProjetoEvento)))
            return false;
        $vwProjetoEvento = reset($arrVwProjetoEvento);
        return $vwProjetoEvento->getNoEvento() . ' - ' . $vwProjetoEvento->getDtInicioEvento() . ' à ' . $vwProjetoEvento->getDtFimEvento();
    }

}
