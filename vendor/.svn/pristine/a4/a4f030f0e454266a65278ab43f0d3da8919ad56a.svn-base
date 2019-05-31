<?php

namespace InepZend\Module\Corporative\Entity;

use InepZend\Repository\Repository;

class VwOrgaoEmissorRepository extends Repository
{

    protected $arrMethodFetchPairs = array('getCoOrgaoEmissor', 'getNoOrgaoEmissor');

    protected function suggestion($arrCriteria = null, $intLimit = null)
    {
        $strAlias = $this->getAlias();
        $strDQL = 'SELECT ' . $strAlias . ' FROM ' . $this->getEntityName() . ' ' . $strAlias . '';
        $arrWhereParameter = $this->constructWhereParameter($strAlias, $arrCriteria, array('noOrgaoEmissor'));
        $arrWhere = $arrWhereParameter[0];
        $arrParameter = $arrWhereParameter[1];
        if (count($arrWhere) > 0)
            $strDQL .= ' WHERE ' . implode(' AND ', $arrWhere);
        if ((count($arrParameter) > 0) && ($arrParameter['noOrgaoEmissor']{0} == '%'))
            $arrParameter['noOrgaoEmissor'] = substr($arrParameter['noOrgaoEmissor'], 1);
        if (is_null($intLimit))
            $arrOrgaoEmissor = $this->executeDQL($strDQL, $arrParameter, true);
        else
            $arrOrgaoEmissor = $this->findByPaged(array(), null, null, 1, $intLimit, $this->executeDQL($strDQL, $arrParameter))->getRegister();
        if (!is_array($arrOrgaoEmissor))
            return $arrOrgaoEmissor;
        $arrResult = array();
        foreach ($arrOrgaoEmissor as $orgaoEmissor)
            $arrResult[$orgaoEmissor->getNoSgOrgaoEmissor()] = array('id' => $orgaoEmissor->getCoOrgaoEmissor(), 'value' => $orgaoEmissor->getNoSgOrgaoEmissor(), 'label' => $orgaoEmissor->getNoSgOrgaoEmissor());
        ksort($arrResult);
        return array_values($arrResult);
    }

}
