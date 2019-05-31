<?php

namespace InepZend\Module\Corporative\Entity;

use InepZend\Repository\Repository;

class VwMunicipioRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getCoMunicipio', 'getNoMunicipio');

    protected function suggestion($arrCriteria = null, $intLimit = null)
    {
        $strAlias = $this->getAlias();
        $strDQL = 'SELECT ' . $strAlias . ' FROM ' . $this->getEntityName() . ' ' . $strAlias . '';
        $arrWhereParameter = $this->constructWhereParameter($strAlias, $arrCriteria, array('noMunicipio'));
        $arrWhere = $arrWhereParameter[0];
        $arrParameter = $arrWhereParameter[1];
        if (count($arrWhere) > 0)
            $strDQL .= ' WHERE ' . implode(' AND ', $arrWhere);
        if ((count($arrParameter) > 0) && ($arrParameter['noMunicipio']{0} == '%'))
            $arrParameter['noMunicipio'] = substr($arrParameter['noMunicipio'], 1);
        if (is_null($intLimit))
            $arrMunicipio = $this->executeDQL($strDQL, $arrParameter, true);
        else
            $arrMunicipio = $this->findByPaged(array(), null, null, 1, $intLimit, $this->executeDQL($strDQL, $arrParameter))->getRegister();
        if (!is_array($arrMunicipio))
            return $arrMunicipio;
        $arrResult = array();
        foreach ($arrMunicipio as $municipio)
            $arrResult[$strNoMunicipioSgUf] = array('id' => $municipio->getCoMunicipio(), 'value' => $municipio->getNoMunicipioSgUf(), 'label' => $municipio->getNoMunicipioSgUf());
        ksort($arrResult);
        return array_values($arrResult);
    }

}
