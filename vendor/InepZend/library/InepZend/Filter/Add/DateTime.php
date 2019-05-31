<?php

namespace InepZend\Filter\Add;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Util\Date;
use InepZend\Exception\RuntimeException;

trait DateTime
{

    public function addFilterDate($strName, $booRequired = false, $arrFilters = array(), $arrValidators = array(), $strMessageRequired = null, $strFormat = null)
    {
        $arrFilter = $this->addFilter($strName, $booRequired, $arrFilters, $arrValidators, $strMessageRequired);
        if (!is_array($arrFilter))
            return false;
        $arrParam = func_get_args();
        if ((func_num_args() == 1) && (is_array($arrParam[0])))
            $this->getArgumentArray($arrParam, $strFormat, 'format');
        if (is_null($strFormat))
            $strFormat = 'Y-m-d';
        if (!array_key_exists('Date', $arrValidators)) {
            $arrOption = array(
                'messages' => array(
                    'dateInvalidDate' => 'A data deve ser válida',
                    'dateFalseFormat' => 'A data deve estar no formato dd/mm/aaaa' . ((strpos($strFormat, ':') !== false) ? ' hh:mm' : ''),
                ),
                'format' => $strFormat,
            );
            $this->addValidators($arrFilter, 'Date', $arrOption);
        }
        $this->setFilter($arrFilter);
        return $arrFilter;
    }

    public function addFilterDateTime($strName, $booRequired = false, $arrFilters = array(), $arrValidators = array(), $strMessageRequired = null, $strFormat = null)
    {
        $arrParam = func_get_args();
        if ((func_num_args() == 1) && (is_array($arrParam[0])))
            $this->getArgumentArray($arrParam, $strFormat, 'format');
        if (is_null($strFormat))
            $strFormat = 'Y-m-d H:i';
        $arrFilter = $this->addFilterDate($strName, $booRequired, $arrFilters, $arrValidators, $strMessageRequired, $strFormat);
        if (!is_array($arrFilter))
            return false;
        $this->setFilter($arrFilter);
        return $arrFilter;
    }

    public function addFilterDateRange($strName, $booRequired = false, $arrFilters = array(), $arrValidators = array(), $strMessageRequired = null, $intMaxDiff = null)
    {
        return $this->addFilterRange(func_get_args(), func_num_args());
    }

    public function addFilterTimeRange($strName, $booRequired = false, $arrFilters = array(), $arrValidators = array(), $strMessageRequired = null, $intMaxDiff = null)
    {
        return $this->addFilterRange(func_get_args(), func_num_args(), 'Time');
    }

    private function addFilterRange($arrParamRange = null, $intArgumentTotal = null, $strType = null)
    {
        if (empty($strType))
            $strType = 'Date';
        $arrParamExtra = array(
            array('max_diff', 'intMaxDiff'),
        );
        $arrParam = $this->getParamEdited($arrParamRange, $intArgumentTotal, $arrParamExtra);
        $arrNameRange = FormGenerator::getNameRange($arrParam['name']);
        if ((empty($arrNameRange)) || ((is_array($arrNameRange)) && (count($arrNameRange) != 2)))
            return false;
        $strMessageException = 'Não foi possível filtrar os campos de período no formulário.';
        $arrOption = null;
        if (!array_key_exists('Callback', (array) @$arrParam['validators'])) {
            $strCallbackValue = 'O período inicial não pode ser maior que o final';
            if ((array_key_exists('max_diff', $arrParam)) && (!is_null($arrParam['max_diff'])))
                $strCallbackValue .= ' ou não pode ultrapassar <b>' . $arrParam['max_diff'] . ' ' . (($strType == 'Time') ? 'minuto' : 'dia') . '(s)</b> de diferença';
            $arrOption = array(
                'messages' => array(
                    'callbackValue' => $strCallbackValue . '.',
                ),
                'callback' => function($mixValue, $arrContext = array(), $arrOptionCallback) {
//                    $strStart = $mixValue;
                    $strStart = $arrContext[$arrOptionCallback[0]];
                    $strEnd = $arrContext[$arrOptionCallback[1]];
                    if ((empty($strStart)) || (empty($strEnd)))
                        return true;
                    $strType = $arrOptionCallback['type'];
                    if ($strType == 'Time') {
                        $booCheckRange = ($strStart <= $strEnd);
                        if (($booCheckRange) && (array_key_exists('max_diff', $arrOptionCallback)) && (!is_null($arrOptionCallback['max_diff']))) {
                            $strDateCurrent = date('Y-m-d') . ' ';
                            $booCheckRange = ((Date::dateDiff($strDateCurrent . $strStart, $strDateCurrent . $strEnd, false, false) / 60) <= (integer) $arrOptionCallback['max_diff']);
                        }
                    } else {
                        $booCheckRange = (Date::convertDate($strStart, 'Y-m-d') <= Date::convertDate($strEnd, 'Y-m-d'));
                        if (($booCheckRange) && (array_key_exists('max_diff', $arrOptionCallback)) && (!is_null($arrOptionCallback['max_diff'])))
                            $booCheckRange = (Date::dateDiff($strStart, $strEnd) <= (integer) $arrOptionCallback['max_diff']);
                    }
                    return $booCheckRange;
                },
                'callbackOptions' => array(
                    array_merge($arrNameRange, array('max_diff' => ((array_key_exists('max_diff', $arrParam)) ? $arrParam['max_diff'] : null), 'type' => $strType)),
                ),
            );
        }
        $strMethod = 'addFilter' . (($strType != 'Time') ? $strType : '');
        foreach ($arrNameRange as $intKey => $strNameIntern) {
            $arrParam['name'] = $strNameIntern;
            $arrFilter = $this->$strMethod($arrParam);
            if (!is_array($arrFilter))
                throw new RuntimeException($strMessageException);
            if (($intKey == 0) && (!empty($arrOption))) {
                $this->addValidators($arrFilter, 'Callback', $arrOption);
                $this->setFilter($arrFilter);
            }
        }
        return true;
    }

}
