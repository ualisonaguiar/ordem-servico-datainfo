<?php
namespace InepZend\Module\TrocaArquivo\IlhaDado\Service;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractService;

class IlhaDado extends AbstractService
{

    public static function getNameFromIdIlhaDado($intIdIlhaDado = null)
    {
        if (empty($intIdIlhaDado))
            return false;
        $ilhaDado = self::getServiceManager()->get('InepZend\Module\TrocaArquivo\Common\Service\File\IlhaDadoFile')->find((integer) $intIdIlhaDado);
        return (! is_object($ilhaDado)) ? $ilhaDado : $ilhaDado->getNoIlhaDado();
    }
}
