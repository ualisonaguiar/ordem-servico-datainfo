<?php

namespace InepZend\Module\Oauth\Service\Ssi;

trait AppService
{
    
    public function cacheServicosClear($arrParam = null)
    {
        return $this->makeCall('public/app/cacheServicosClear', (array) $arrParam, 'POST');
    }
    
    public function appInfo($arrParam = null)
    {
        return $this->makeCall('public/app/info', (array) $arrParam);
    }
    
    public function ejbInfo($arrParam = null)
    {
        return $this->makeCall('public/app/infoEJB', (array) $arrParam);
    }
    
    public function servicosVinculados($strNoSistema = null, $intIdTipoAmbiente = null, $arrParam = null)
    {
        if (((integer) $intIdTipoAmbiente >= 1) && ((integer) $intIdTipoAmbiente <= 6))
            $intIdTipoAmbiente = 6;
        return $this->makeCall('public/app/servicosVinculados/' . $strNoSistema . '/' . $intIdTipoAmbiente, array_merge(array('nomeSistema' => $strNoSistema, 'idTipoAmbiente' => $intIdTipoAmbiente), (array) $arrParam));
    }

}
