<?php

namespace InepZend\Grid\Flexigrid\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Util\String;

class GridHelper extends AbstractHelper
{

    const TYPE_TEXT = 'text';
    const TYPE_LINK = 'link';
    const TYPE_LINK_DATA = 'link_data';
    const TYPE_IMG = 'img';
    const TYPE_IMG_DATA = 'img_data';
    const TYPE_INPUT_HIDDEN = 'input_hidden';
    const TYPE_INPUT_HIDDEN_TEXT = 'input_hidden_text';
    const TYPE_INPUT_TEXT = 'input_text';
    const TYPE_INPUT_RADIO = 'input_radio';
    const TYPE_INPUT_CHECKBOX = 'input_checkbox';
    const TYPE_INPUT_SELECT = 'select';
    const TYPE_ROUTE = 'route';
    const ATTRIBUTE_TYPE_ID = 'id';
    const ATTRIBUTE_TYPE_NAME = 'name';
    const ATTRIBUTE_TYPE_CLASS = 'class';
    const ATTRIBUTE_TYPE_HEIGHT = 'height';
    const ATTRIBUTE_TYPE_STYLE = 'style';
    const ATTRIBUTE_TYPE_HIDE_TEXT = 'hide_text';
    const ATTRIBUTE_TYPE_VALUE_OPTIONS = 'value_options';
    const ATTRIBUTE_TYPE_ROUTE = 'route';
    const ATTRIBUTE_TYPE_PARAM = 'param';
    const ATTRIBUTE_TYPE_TEXT = 'text';
    const ATTRIBUTE_TYPE_REPLACE = '##strAttributeTypeReplace##';
    const IMG_HEIGHT_DEFAULT = '50px';

    /**
     * Metodo responsavel em converter os registros para a formatacao exigida pela
     * Grid, apos a paginacao ser realizada.
     * 
     * @param array $arrRegister
     * @param mix $mixMethodCol
     * @param mix $mixMethodPk
     * @return array
     */
    public function convertRegisterToGrid($arrRegister = null, $mixMethodCol = null, $mixMethodPk = null)
    {
        if ((!empty($mixMethodCol)) && (!is_array($mixMethodCol)))
            $mixMethodCol = array($mixMethodCol);
        if ((!empty($mixMethodPk)) && (!is_array($mixMethodPk)))
            $mixMethodPk = array($mixMethodPk);
        return (array) $this->registerToGrid($arrRegister, $mixMethodCol, $mixMethodPk);
    }

    /**
     * Metodo responsavel em converter os registros para a formatacao exigida pela
     * Grid.
     * 
     * @param array $arrRegister
     * @param mix $mixMethodCol
     * @param mix $mixMethodPk
     * @return array
     */
    private function registerToGrid($arrRegister = null, $mixMethodCol = null, $mixMethodPk = null)
    {
        $arrRegisterToGrid = array();
        foreach ($arrRegister as $intRow => $mixRegister) {
            if (is_array($mixMethodCol)) {
                foreach ($mixMethodCol as $mixMethodColIntern) {
                    $mixValueCol = $this->getValueCol($mixRegister, $mixMethodColIntern, $intRow);
                    if ($mixValueCol === false)
                        continue;
                    $arrRegisterToGrid[$intRow]['col'][] = $mixValueCol;
                }
            }
            if (is_array($mixMethodPk)) {
                foreach ($mixMethodPk as $strMethodPk)
                    $arrRegisterToGrid[$intRow]['pk'][] = $this->getValueFromColRegister($mixRegister, $strMethodPk);
            }
        }
        return $arrRegisterToGrid;
    }

    /**
     * Metodo responsavel em retornar valor(es) de coluna(s).
     * 
     * @param mix $mixRegister
     * @param mix $mixMethodColIntern
     * @param integer $intRow
     * @return mix
     */
    private function getValueCol($mixRegister = null, $mixMethodColIntern = null, $intRow = null)
    {
        $strType = null;
        $arrAttributeType = array();
        $arrMethodValueCol = array();
        if (is_array($mixMethodColIntern)) {
            $strMethodCol = (array_key_exists(0, $mixMethodColIntern)) ? $mixMethodColIntern[0] : null;
            if (array_key_exists(1, $mixMethodColIntern))
                $strType = $mixMethodColIntern[1];
            if (array_key_exists(2, $mixMethodColIntern))
                $arrAttributeType = (array) $mixMethodColIntern[2];
            if (array_key_exists(3, $mixMethodColIntern))
                $arrMethodValueCol = (array) $mixMethodColIntern[3];
        } else
            $strMethodCol = $mixMethodColIntern;
        if (empty($strMethodCol))
            return false;
        if (empty($strType))
            $strType = self::TYPE_TEXT;
        $strType = strtolower($strType);
        $strTypeCamelize = strtolower(end($arrExplode = explode('\\', __NAMESPACE__))) . ucfirst(String::camelize($strType));
        if (!array_key_exists(self::ATTRIBUTE_TYPE_ID, $arrAttributeType))
            $arrAttributeType[self::ATTRIBUTE_TYPE_ID] = $strTypeCamelize . '[' . (string) $intRow . ']';
        if (!array_key_exists(self::ATTRIBUTE_TYPE_NAME, $arrAttributeType))
            $arrAttributeType[self::ATTRIBUTE_TYPE_NAME] = $arrAttributeType[self::ATTRIBUTE_TYPE_ID];
        if (!array_key_exists(self::ATTRIBUTE_TYPE_CLASS, $arrAttributeType))
            $arrAttributeType[self::ATTRIBUTE_TYPE_CLASS] = '';
        $arrAttributeType[self::ATTRIBUTE_TYPE_CLASS] = trim($strTypeCamelize . ' ' . $arrAttributeType[self::ATTRIBUTE_TYPE_CLASS]);
        $mixValueCol = $this->getValueFromColRegister($mixRegister, $strMethodCol);
        if (!empty($arrMethodValueCol)) {
            $strMethodValueCol = $arrMethodValueCol[0];
            $arrParamMethodValueCol = (array_key_exists(1, $arrMethodValueCol)) ? (array) $arrMethodValueCol[1] : array();
            $arrArgument = array();
            foreach ((array) $arrParamMethodValueCol as $intKey => $strParam)
                $arrArgument[] = '$arrParamMethodValueCol[' . $intKey . ']';
            eval('$mixValueCol = ' . $strMethodValueCol . '($mixValueCol' . ((!empty($arrArgument)) ? ', ' . implode(', ', $arrArgument) : '') . ');');
        }
        $strResultType = $this->resultTypeToGrid($strType, $mixValueCol, $arrAttributeType, $mixRegister);
        if (!empty($strResultType)) {
            $strAttributeTypeReplace = '';
            $arrAttributeTypeNotUse = array(self::ATTRIBUTE_TYPE_VALUE_OPTIONS);
            foreach ($arrAttributeType as $strAttributeType => $strAttributeTypeValue) {
                if (in_array($strAttributeType, $arrAttributeTypeNotUse))
                    continue;
                $strAttributeTypeReplace .= ' ' . $strAttributeType . '="' . $strAttributeTypeValue . '"';
            }
            $mixValueCol = str_replace(self::ATTRIBUTE_TYPE_REPLACE, $strAttributeTypeReplace, $strResultType);
        }
        return $mixValueCol;
    }

    /**
     * Metodo responsavel em definir o resultado HTML especifico para cada tipo
     * de coluna da Grid.
     * 
     * @param string $strType
     * @param mix $mixValueCol
     * @param array $arrAttributeType
     * @param mix $mixRegister
     * @return string
     */
    private function resultTypeToGrid($strType = null, $mixValueCol = null, &$arrAttributeType = null, $mixRegister = null)
    {
        $strResultType = null;
        switch ($strType) {
            case self::TYPE_LINK:
            case self::TYPE_LINK_DATA:
                $strResultType = '<a target="_self" href="' . $this->getPathFromValueColType($mixValueCol, $strType) . '"' . self::ATTRIBUTE_TYPE_REPLACE . '>' . $mixValueCol . '</a>';
                break;
            case self::TYPE_IMG:
            case self::TYPE_IMG_DATA:
                $strResultType = '<img src="' . $this->getPathFromValueColType($mixValueCol, $strType) . '"' . self::ATTRIBUTE_TYPE_REPLACE . ' />';
                if ((!array_key_exists(self::ATTRIBUTE_TYPE_HEIGHT, $arrAttributeType)) && (!is_null(self::IMG_HEIGHT_DEFAULT)))
                    $arrAttributeType[self::ATTRIBUTE_TYPE_HEIGHT] = self::IMG_HEIGHT_DEFAULT;
                break;
            case self::TYPE_INPUT_HIDDEN:
            case self::TYPE_INPUT_HIDDEN_TEXT:
            case self::TYPE_INPUT_TEXT:
            case self::TYPE_INPUT_RADIO:
            case self::TYPE_INPUT_CHECKBOX:
                $strResultType = '<input type="' . str_replace(array('hidden_text', 'input_'), array('hidden', ''), $strType) . '" value="' . $mixValueCol . '"' . self::ATTRIBUTE_TYPE_REPLACE . ' />';
                if (in_array($strType, array(self::TYPE_INPUT_HIDDEN_TEXT)))
                    $strResultType .= $mixValueCol;
                elseif (in_array($strType, array(self::TYPE_INPUT_RADIO, self::TYPE_INPUT_CHECKBOX))) {
                    if (!array_key_exists(self::ATTRIBUTE_TYPE_STYLE, $arrAttributeType))
                        $arrAttributeType[self::ATTRIBUTE_TYPE_STYLE] = '';
                    $arrAttributeType[self::ATTRIBUTE_TYPE_STYLE] = trim('margin-top: -2px; ' . $arrAttributeType[self::ATTRIBUTE_TYPE_STYLE]);
                    $strResultType = '<div class="paginatorValueCol" style="text-align: right; padding: 0px; padding-right: 2px;">' . $strResultType . '</div>';
                    $strResultType .= '<div class="paginatorValueCol" style="text-align: left; padding-left: 2px; padding-top: 0px; padding-bottom: 0px;' . ((array_key_exists(self::ATTRIBUTE_TYPE_HIDE_TEXT, $arrAttributeType)) ? ' display: none;' : '') . '"><label class="paginatorLabel" for="' . $arrAttributeType[self::ATTRIBUTE_TYPE_ID] . '" title="' . $mixValueCol . '">' . $mixValueCol . '</label></div>';
                }
                break;
            case self::TYPE_INPUT_SELECT:
                if (!array_key_exists(self::ATTRIBUTE_TYPE_VALUE_OPTIONS, $arrAttributeType))
                    $arrAttributeType[self::ATTRIBUTE_TYPE_VALUE_OPTIONS] = array();
                $strResultType = '<select ' . self::ATTRIBUTE_TYPE_REPLACE . '>';
                foreach ((array) $arrAttributeType[self::ATTRIBUTE_TYPE_VALUE_OPTIONS] as $mixValueOption => $mixTextOption) {
                    $strResultType .= '<option value="' . $mixValueOption . '"';
                    if ($mixValueOption == $mixValueCol)
                        $strResultType .= ' selected="selected"';
                    $strResultType .= '>' . $mixTextOption . '</option>';
                }
                $strResultType .= '</select>';
                break;
            case self::TYPE_ROUTE:
                $strRoute = (array_key_exists(self::ATTRIBUTE_TYPE_ROUTE, $arrAttributeType)) ? str_replace('//', '/', '/' . $arrAttributeType[self::ATTRIBUTE_TYPE_ROUTE] . '/') : '';
                $arrParam = array();
                if (array_key_exists(self::ATTRIBUTE_TYPE_PARAM, $arrAttributeType)) {
                    foreach ((array) $arrAttributeType[self::ATTRIBUTE_TYPE_PARAM] as $strParam)
                        $arrParam[] = $this->getValueFromColRegister($mixRegister, $strParam);
                }
                $strParam = (count($arrParam) > 0) ? implode('/', $arrParam) : $mixValueCol;
                $strResultType = '<a target="_self" href="' . $this->getBaseUrl() . $strRoute . $strParam . '"' . self::ATTRIBUTE_TYPE_REPLACE . '>' . (array_key_exists(self::ATTRIBUTE_TYPE_TEXT, $arrAttributeType) ? $arrAttributeType[self::ATTRIBUTE_TYPE_TEXT] : $mixValueCol) . '</a>';
                break;
        }
        return $strResultType;
    }

    private function getValueFromColRegister($mixRegister = null, $strParam = null)
    {
        if ((empty($mixRegister)) || (empty($strParam)))
            return;
        if (is_object($mixRegister))
            return (method_exists($mixRegister, $strParam)) ? $mixRegister->$strParam() : $strParam;
        return (array_key_exists(strtoupper($strParam), $mixRegister)) ? $mixRegister[strtoupper($strParam)] : $strParam;
    }

    /**
     * Metodo responsavel em retornar o caminho do arquivo para o valor da coluna.
     * 
     * @param mix $mixValueCol
     * @param string $strType
     * @return string
     */
    private function getPathFromValueColType($mixValueCol = null, $strType = null)
    {
        $strPath = $mixValueCol;
        if (stripos($strType, '_data') !== false)
            $strPath = $this->getBaseUrl() . getShowFileUrl($mixValueCol);
        return $strPath;
    }

}
