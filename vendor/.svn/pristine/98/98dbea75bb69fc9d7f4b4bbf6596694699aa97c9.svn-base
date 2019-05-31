<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;
use InepZend\Exception\RuntimeException;
use InepZend\Util\Date;

/**
 * Trait responsavel em manipular Element Text para Datas/DataTime.
 */
trait DateTime
{

    private static $arrNameRange = array();

    /**
     * Metodo responsavel em adicionar o Element Text customizado para o tipo
     * Date contendo suas validacoes.
     *
     * @example $this->addDate($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strReadonly);
     *
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
     * @param string $strPlaceHolder
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strReadonly
     * @param string $strMinDate
     * @param string $strMaxDate
     * @return mix
     */
    public function addDate($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strReadonly = null, $strMinDate = null, $strMaxDate = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('min_date', 'strMinDate'),
            array('max_date', 'strMaxDate'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'dtDate',
            'placeholder' => 'Entre com a Data',
            'mask' => '99/99/9999',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra);
        $this->addOptionRange($arrElement, @$arrParam['min_date'], @$arrParam['max_date']);
        return $this->setStyleWidth($arrElement, '140px');
    }

    /**
     * Metodo responsavel em adicionar o Element Text customizado para o tipo
     * DateTime contendo suas validacoes.
     *
     * @example $this->addDateTime($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strReadonly);
     *
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
     * @param string $strPlaceHolder
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strReadonly
     * @param string $strMinDate
     * @param string $strMaxDate
     * @return mix
     */
    public function addDateTime($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strReadonly = null, $strMinDate = null, $strMaxDate = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('min_date', 'strMinDate'),
            array('max_date', 'strMaxDate'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'dtDateTime',
            'label' => 'Data/Hora',
            'placeholder' => 'Entre com a Data/Hora',
            'mask' => '99/99/9999 99:99',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra);
        $this->addOptionRange($arrElement, @$arrParam['min_date'], @$arrParam['max_date']);
        return $this->setStyleWidth($arrElement, '220px');
    }

    /**
     * Metodo responsavel em adicionar o Element Text customizado para o tipo
     * Time contendo suas validacoes.
     *
     * @example $this->addTime($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strReadonly);
     *
     *
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
     * @param string $strPlaceHolder
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param string $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strReadonly
     * @param string $strMinTime
     * @param string $strMaxTime
     * @return mix
     */
    public function addTime($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strReadonly = null, $strMinTime = null, $strMaxTime = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('min_time', 'strMinTime'),
            array('max_time', 'strMaxTime'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'dtTime',
            'placeholder' => 'Entre com a Hora',
            'mask' => '99:99',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra);
        $this->addOptionRange($arrElement, @$arrParam['min_time'], @$arrParam['max_time']);
        return $this->setStyleWidth($arrElement, '140px');
    }

    /**
     * Metodo responsavel em adicionar o Element Text customizado para o tipo
     * DateRanger contendo suas validacoes.
     *
     * @example $this->addDateRange($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strValueStart, $strValueEnd, $strSufixStart, $strSufixEnd, $strBetweenText, $strReadonly)
     *
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
     * @param string $strPlaceHolder
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strValueStart
     * @param string $strValueEnd
     * @param string $strSufixStart
     * @param string $strSufixEnd
     * @param string $strBetweenText
     * @param string $strReadonly
     * @param string $strMinDate
     * @param string $strMaxDate
     * @return mix
     */
    public function addDateRange($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strValueStart = null, $strValueEnd = null, $strSufixStart = null, $strSufixEnd = null, $strBetweenText = null, $strReadonly = null, $strMinDate = null, $strMaxDate = null)
    {
        return $this->addRange(func_get_args(), func_num_args());
    }

    public function addTimeRange($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strValueStart = null, $strValueEnd = null, $strSufixStart = null, $strSufixEnd = null, $strBetweenText = null, $strReadonly = null, $strMinDate = null, $strMaxDate = null)
    {
        return $this->addRange(func_get_args(), func_num_args(), 'Time');
    }

    private function addRange($arrParamRange = null, $intArgumentTotal = null, $strType = null)
    {
        if (empty($strType))
            $strType = 'Date';
        $arrParamExtra = array(
            array('value_start', 'strValueStart'),
            array('value_end', 'strValueEnd'),
            array('sufix_start', 'strSufixStart'),
            array('sufix_end', 'strSufixEnd'),
            array('between_text', 'strBetweenText'),
            array('readonly', 'strReadonly'),
            array('min_' . strtolower($strType), 'strMin' . $strType),
            array('max_' . strtolower($strType), 'strMax' . $strType),
        );
        $arrParam = $this->getParamEdited($arrParamRange, $intArgumentTotal, $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'dtRange',
            'label' => 'Período',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        ArrayCollection::createEmptyParam(array('style', 'value_start', 'value_end', 'sufix_start', 'sufix_end', 'between_text'), $arrParam);
        if (empty($arrParam['sufix_start']))
            $arrParam['sufix_start'] = '_inicio';
        if (empty($arrParam['sufix_end']))
            $arrParam['sufix_end'] = '_fim';
        if (empty($arrParam['between_text']))
            $arrParam['between_text'] = 'a';
        $strBetweenText = $arrParam['between_text'];
        $strName = @$arrParam['name'];
        $strLabel = @$arrParam['label'];
        $booRequired = (boolean) @$arrParam['required'];
        if (!empty($strLabel)) {
            $this->addLabel(array('label' => $strLabel, 'required' => $booRequired, 'label_class' => 'block', 'for' => $strName . $arrParam['sufix_start']));
            $this->addLabel(array('label' => $strLabel, 'required' => $booRequired, 'label_class' => 'hidden', 'for' => $strName . $arrParam['sufix_end']));
        }
        $arrParamStart = $this->getRangeParam($arrParam, 'start');
        $arrParamEnd = $this->getRangeParam($arrParam, 'end');
        $strMethod = 'add' . $strType;
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('<div class="form-group" style="min-height: 55px; width: 155px; float: left !important;">');
        $arrElement = $this->$strMethod($arrParamStart);
        if (!is_array($arrElement))
            throw new RuntimeException('Não foi possível construir os campos de período no formulário.');
        $this->addOption($arrElement, 'rangeStart', true);
        $this->addOption($arrElement, 'rangeOther', $arrParamEnd['name']);
        $this->setElement($arrElement);
        if (!self::isThemeAdministrativeResponsible())
            $this->addHtml('<span style="float: left; height: 23px; padding-top: 5px; padding-left: 5px; padding-right: 5px;">' . $strBetweenText . '</span>');
        else
            $this->addHtml('</div><div class="divBetweenText" style="padding-top: 8px; height: 32px;">' . $strBetweenText . '</div><div class="form-group" style="min-height: 55px;">');
        $arrElement = $this->$strMethod($arrParamEnd);
        if (!is_array($arrElement))
            throw new RuntimeException('Não foi possível construir os campos de período no formulário.');
        $this->addOption($arrElement, 'rangeEnd', true);
        $this->addOption($arrElement, 'rangeOther', $arrParamStart['name']);
        $this->setElement($arrElement);
        self::setNameRange($strName, $arrParamStart['name'], $arrParamEnd['name']);
        $this->refreshInputFilter();
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('</div>');
        return $this;
    }

    /**
     * Metodo responsavel em retornar o nome referente ao Element Text referente
     * ao DateRange ou TimeRange.
     *
     * @example self::getNameRange($strName);
     *
     * @param string $strName
     * @return mix
     */
    public static function getNameRange($strName = null)
    {
        return (empty($strName)) ? self::$arrNameRange : @self::$arrNameRange[$strName];
    }

    /**
     * Metodo responsavel em montar o array para ser inserido no Element Text
     * para o tipo DateRange/TimeRange, Data/Hora Inicial e Data/Hora Final.
     *
     * @example $this->getRangeParam($arrParam, 'start|end');
     *
     * @param array $arrParam
     * @param string $strType
     * @return mix
     */
    private function getRangeParam($arrParam = null, $strType = null)
    {
        if (!in_array($strType, array('start', 'end')))
            $strType = 'start';
        $strType = trim(strtolower($strType));
        if ((!is_array($arrParam)) || (!array_key_exists('name', $arrParam)) || (!array_key_exists('value_' . $strType, $arrParam)) || (!array_key_exists('sufix_' . $strType, $arrParam)))
            throw new RuntimeException('Os parâmetros editados não estão no formato esperado.');
        $arrRangeParam = array(
            'name' => $arrParam['name'] . $arrParam['sufix_' . $strType],
            'value' => $arrParam['value_' . $strType],
        );
        if ((array_key_exists('attr_data', $arrParam)) && (is_array($arrParam['attr_data'])) && (array_key_exists('ng-model', $arrParam['attr_data'])))
            $arrParam['attr_data']['ng-model'] .= $arrParam['sufix_' . $strType];
        if (empty($arrRangeParam['value'])) {
            if ((array_key_exists('value', $arrParam)) && (!empty($arrParam['value'])))
                $arrRangeParam['value'] = $arrParam['value'];
            else
                unset($arrRangeParam['value']);
        }
        $arrUnset = array('name', 'value', 'value_start', 'value_end', 'sufix_start', 'sufix_end', 'between_text');
        if ($strType == 'start')
            $arrParam['style'] = 'float: left; ' . $arrParam['style'];
        $arrUnset[] = 'label';
        ArrayCollection::unsetParam($arrUnset, $arrParam);
        return array_merge($arrRangeParam, $arrParam);
    }

    /**
     * Metodo responsavel em inserir no atributo arrNameRange os nomes referente
     * aos Element Text do DateRange ou TimeRange contendo o Inicial, o Final e
     * o Principal.
     *
     * @example self::setNameRange($strName, $strNameStart, $strNameEnd);
     *
     * @param string $strName
     * @param string $strNameStart
     * @param string $strNameEnd
     * @return mix
     */
    private static function setNameRange($strName = null, $strNameStart = null, $strNameEnd = null)
    {
        if ((empty($strName)) || (empty($strNameStart)) || (empty($strNameEnd)))
            return false;
        return (self::$arrNameRange[$strName] = array($strNameStart, $strNameEnd));
    }

    /**
     * Metodo responsavel em inserir no option a data/hora inicial e final
     *
     * @example $this->addOptionRange($arrElement, $strMin, $strMax);
     *
     * @param array $arrElement
     * @param string $strMin
     * @param string $strMax
     */
    private function addOptionRange(&$arrElement, $strMin = null, $strMax = null)
    {
        $strMask = @$arrElement['options']['mask'];
        if (strpos($strMask, '99:') === 0) {
            $this->addOption($arrElement, 'min_time', (empty($strMin)) ? null : $strMin);
            $this->addOption($arrElement, 'max_time', (empty($strMax)) ? null : $strMax);
        } else {
            $this->addOption($arrElement, 'min_date', (empty($strMin)) ? null : Date::convertDateTemplate($strMin, 'Y-m-d H:i:s'));
            $this->addOption($arrElement, 'max_date', (empty($strMax)) ? null : Date::convertDateTemplate($strMax, 'Y-m-d H:i:s'));
        }
    }

}
