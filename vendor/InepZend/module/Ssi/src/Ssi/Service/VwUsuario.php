<?php

namespace InepZend\Module\Ssi\Service;

use InepZend\Service\AbstractService;

class VwUsuario extends AbstractService
{

    public static function getNameFromIdUsuarioSistema($intIdUsuarioSistema = null)
    {
        if (empty($intIdUsuarioSistema))
            return false;
        $arrVwUsuario = self::getServiceManager()->get('InepZend\Module\Ssi\Service\VwUsuario')->findBy(array('idUsuarioSistema' => $intIdUsuarioSistema));
        if ((!is_array($arrVwUsuario)) || (empty($arrVwUsuario)))
            return $intIdUsuarioSistema;
        $vwUsuario = reset($arrVwUsuario);
        return $vwUsuario->getNoUsuario();
    }

}
