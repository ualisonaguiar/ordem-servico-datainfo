<?php

namespace InepZend\FormGenerator\Element;

use Zend\Form\Element;
use InepZend\View\Helper\RenderTemplateGoogleHelper;
use InepZend\Util\stdClass;
use InepZend\Util\Format;
use Zend\Json\Encoder;
use Zend\Json\Decoder;

/**
 * Classe estendida da ZendFramework para que a mesma seja extendida do InepZend
 * ao Inves do ZendFramework.
 */
class Table extends Element
{

    protected $attributes = array(
        'type' => 'table',
    );

    /**
     * Metodo construtor responsavel em criar uma instancia do Element Table.
     *
     * @param array $arrData
     * @param array $arrTitle
     * @param array $arrIcon
     * @param array $arrOption
     * @param string $strName
     * @param string $strLabel
     * @param boolean $booShowNoRegister
     * @param string $strCallback
     * @param string $strSort
     */
    public function __construct($arrData = null, $arrTitle = null, $arrIcon = null, $arrOption = null, $strName = null, $strLabel = null, $booShowNoRegister = false, $strCallback = null, $strSort = null)
    {
        $arrOption = (!is_array($arrOption)) ? array() : array('option' => $arrOption);
        $arrOption['title'] = (array) $arrTitle;
        $arrOption['icon'] = (array) $arrIcon;
        $arrOption['label'] = $strLabel;
        $arrOption['show_no_register'] = (boolean) $booShowNoRegister;
        $arrOption['callback'] = $strCallback;
        $arrOption['sort'] = $strSort;
        parent::__construct($strName, $arrOption);
        if (!empty($arrData))
            $this->setValue($arrData);
    }

    /**
     * Retrieve the element value
     *
     * @return mixed
     */
    public function getValue()
    {
        $arrData = (array) parent::getValue();
        $arrTitle = $this->getOption('title');
        if (empty($arrTitle))
            return;
        $arrRegister = array();
        foreach ($arrData as $intKey => $mixData) {
            if (Format::isJson($mixData)) {
                $mixData = Decoder::decode($mixData);
                if ((is_array($mixData)) && (count($mixData) == 1))
                    $mixData = reset($mixData);
            }
            $arrRegister[$intKey] = array();
            foreach ($arrTitle as $mixInfo) {
                $arrGetter = (is_array($mixInfo)) ? @$mixInfo[0] : $mixInfo;
                if (!is_array($arrGetter))
                    $arrGetter = array($arrGetter);
                $mixGetterValue = null;
                foreach ($arrGetter as $strGetter) {
                    if (!empty($mixGetterValue))
                        break;
                    if (is_array($mixData))
                        $mixGetterValue = @$mixData[$strGetter];
                    elseif (is_object($mixData)) {
                        if (($mixData instanceof \stdClass) || ($mixData instanceof stdClass))
                            $mixGetterValue = @$mixData->$strGetter;
                        else
                            eval('$mixGetterValue = @$mixData->' . $strGetter . '();');
                    }
                }
                $arrRegister[$intKey][] = $mixGetterValue;
            }
        }
        $arrIcon = $this->getOption('icon');
        $strIcon = '';
        if (!empty($arrIcon)) {
            $arrTitle['Ações'] = array(null, 'width: 10%;');
            $strIcon = '';
            foreach ($arrIcon as $arrInfo)
                $strIcon .= '<i class="' . @$arrInfo['class'] . '" style="cursor: pointer;" title="' . @$arrInfo['title'] . '" onclick="' . @$arrInfo['onclick'] . '"></i>';
            foreach ($arrRegister as $intKey => &$arrInfo)
                $arrInfo[] = '<input type="hidden" name="' . $this->getAttribute('name') . '[]" value=\'' . Encoder::encode($arrData[$intKey]) . '\' />' . $strIcon;
        }
        $arrTitleStyle = array();
        $arrTitleData = array();
        $intCol = -1;
        foreach ($arrTitle as $strTitle => $mixInfo) {
            ++$intCol;
            $arrTitleData[] = $strTitle;
            if ((!is_array($mixInfo)) || (@empty($mixInfo[1])))
                continue;
            $arrTitleStyle[$intCol] = $mixInfo[1];
        }
        $strSort = $this->getOption('sort');
        $arrVariable = array(
            'arrOption' => array_merge(
                array(
                    array('allowHtml', true),
                    array('alternatingRowStyle', false),
                    array('cssClassNames', '{headerCell: \'google-visualization-table-th gradient google-visualization-table-sorthdr cellHeader\'}'),
                    array('titleStyle', $arrTitleStyle),
                    array('sort', (!empty($strSort)) ? $strSort : 'enable'),
                ),
                (array) $this->getOption('option')
            ),
            'arrData' => array_merge(array(0 => $arrTitleData), $arrRegister),
            'strDivId' => $this->getAttribute('name'),
            'booShowNoRegister' => $this->getOption('show_no_register'),
            'strCallbackOnLoad' => $this->getOption('callback'),
        );
        $strTable = '';
        if (!empty($arrIcon))
            $strTable .= '<input type="hidden" name="' . $this->getAttribute('name') . '[icon]" value=\'' . Encoder::encode(array($strIcon)) . '\' disabled="disabled" />';
        $strTable .= '<input type="hidden" name="' . $this->getAttribute('name') . '[titleStyle]" value=\'' . Encoder::encode($arrTitleStyle) . '\' disabled="disabled" />' . (new RenderTemplateGoogleHelper())->renderTable($arrVariable);
        $strLabel = $this->getOption('label');
        if (!empty($strLabel))
            $strTable = '<div class="well" style="overflow: hidden;"><h3>' . $strLabel . '</h3>' . $strTable . '</div>';
        return $strTable;
    }

}
