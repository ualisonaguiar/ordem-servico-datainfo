<?php

namespace InepZend\Filter\Add;

trait Group
{
    
    public function addFilterGroup(
            $arrParam = null,
            $arrElement = null)
    {
        foreach ((array) $arrElement as $strNameElement => $arrParamSpecific) {
            if (!$this->getParamValue($arrParam, 'not_show', $strNameElement)) {
                $strMethod = 'addFilter' . $arrParamSpecific['type'];
                if (!method_exists($this, $strMethod))
                    $strMethod = 'addFilter';
                $arrFilters = array();
                $arrValidators = array();
                if (stripos($strNameElement, 'confirmacao') !== false)
                    $arrValidators = array(
                        'Identical' => array(
                            'token' => str_ireplace(array('_confirmacao', 'Confirmacao'), '', $strNameElement),
                            'messages' => array('notSame' => 'Valor não confere com o original'),
                        )
                    );
                $this->$strMethod(array_merge(array('name' => $strNameElement), array(
                    'required' => $this->getParamValue($arrParam, 'required', $strNameElement),
                    'filters' => $arrFilters,
                    'validators' => $arrValidators,
                    'message_required' => $this->getParamValue($arrParam, 'message_required', $strNameElement),
                )));
            }
        }
        return true;
    }

}
