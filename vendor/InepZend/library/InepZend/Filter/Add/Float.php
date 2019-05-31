<?php

namespace InepZend\Filter\Add;

trait Float
{

    public function addFilterFloat(
            $strName, 
            $booRequired = false, 
            $arrFilters = array(), 
            $arrValidators = array(), 
            $strMessageRequired = null)
    {
        $arrFilter = $this->addFilter($strName, $booRequired, $arrFilters, $arrValidators, $strMessageRequired);
        if (!is_array($arrFilter))
            return false;
        $this->delFilters($arrFilter, 'StripTags');
        $this->setFilter($arrFilter);
        return $arrFilter;
    }

}
