<?php

namespace InepZend\Module\Corporative\Entity;

use InepZend\Repository\Repository;

class BancoRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getCoBanco', 'getDsBanco');

    protected function suggestion($arrCriteria = null, $intLimit = null)
    {
        $strAlias = $this->getAlias();
        $strDQL = 'SELECT ' . $strAlias . ' FROM ' . $this->getEntityName() . ' ' . $strAlias . '';
        $arrWhereParameter = $this->constructWhereParameter($strAlias, $arrCriteria, array('dsBanco'));
        $arrWhere = $arrWhereParameter[0];
        $arrParameter = $arrWhereParameter[1];
        if (count($arrWhere) > 0)
            $strDQL .= ' WHERE ' . implode(' AND ', $arrWhere);
        if ((count($arrParameter) > 0) && ($arrParameter['dsBanco']{0} == '%'))
            $arrParameter['dsBanco'] = substr($arrParameter['dsBanco'], 1);
        if (is_null($intLimit))
            $arrBanco = $this->executeDQL($strDQL, $arrParameter, true);
        else
            $arrBanco = $this->findByPaged(array(), null, null, 1, $intLimit, $this->executeDQL($strDQL, $arrParameter))->getRegister();
        if (!is_array($arrBanco))
            return $arrBanco;
        $arrResult = array();
        foreach ($arrBanco as $banco) {
            $intCoBanco = str_pad($banco->getCoBanco(), 3, '0', STR_PAD_LEFT);
            $strDsBanco = $banco->getDsBanco();
            $arrResult[$intCoBanco . ' - ' . $strDsBanco] = array('id' => $intCoBanco, 'value' => $strDsBanco, 'label' => $intCoBanco . ' - ' . $strDsBanco);
        }
        ksort($arrResult);
        return array_values($arrResult);
    }

}
