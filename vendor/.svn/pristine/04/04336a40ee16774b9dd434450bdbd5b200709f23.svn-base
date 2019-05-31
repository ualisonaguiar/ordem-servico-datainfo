<?php

namespace InepZend\Module\Corporative\Entity;

use InepZend\Repository\Repository;

class VwPaisRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getCoPais', 'getNoPais');

    protected function suggestion($arrCriteria = null, $intLimit = null)
    {
        $strAlias = $this->getAlias();
        $strDQL = 'SELECT ' . $strAlias . ' FROM ' . $this->getEntityName() . ' ' . $strAlias . '';
        $arrWhereParameter = $this->constructWhereParameter($strAlias, $arrCriteria, array('noPais'));
        $arrWhere = $arrWhereParameter[0];
        $arrParameter = $arrWhereParameter[1];
        if (count($arrWhere) > 0)
            $strDQL .= ' WHERE ' . implode(' AND ', $arrWhere);
        if ((count($arrParameter) > 0) && ($arrParameter['noPais']{0} == '%'))
            $arrParameter['noPais'] = substr($arrParameter['noPais'], 1);
        if (is_null($intLimit))
            $arrPais = $this->executeDQL($strDQL, $arrParameter, true);
        else
            $arrPais = $this->findByPaged(array(), null, null, 1, $intLimit, $this->executeDQL($strDQL, $arrParameter))->getRegister();
        if (!is_array($arrPais))
            return $arrPais;
        $arrResult = array();
        foreach ($arrPais as $pais)
            $arrResult[$pais->getNoPais()] = array('id' => $pais->getCoPais(), 'value' => $pais->getNoPais(), 'label' => $pais->getNoPais());
        ksort($arrResult);
        return array_values($arrResult);
    }

}
