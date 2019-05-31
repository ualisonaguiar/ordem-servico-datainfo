<?php

namespace InepZend\Filter\Add;

trait Filter
{

    public function addFilter(
            $strName, 
            $booRequired = false, 
            $arrFilters = array(), 
            $arrValidators = array(), 
            $strMessageRequired = null)
    {
        $arrFilter = $this->addDefault(func_get_args());
        if (!is_array($arrFilter))
            return false;
        $this->setFilter($arrFilter);
        return $arrFilter;
    }

}
