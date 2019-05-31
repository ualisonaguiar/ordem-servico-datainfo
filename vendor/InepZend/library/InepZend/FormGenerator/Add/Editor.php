<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element TextArea para Editor de Texto.
 */
trait Editor
{

    /**
     * Metodo responsavel em inserir o Element TextArea para Editor de Texto.
     * 
     * @example $this->addEditor($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $booShowCounter, $arrPlugin, $arrToolbar);
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
     * @param integer $intMaxlength
     * @param boolean $booShowCounter
     * @param array $arrPlugin
     * @param array $arrToolbar
     * @return mix
     */
    public function addEditor($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $booShowCounter = null, $arrPlugin = null, $arrToolbar = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('show_counter', 'booShowCounter'),
            array('plugins', 'arrPlugin'),
            array('toolbar', 'arrToolbar'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'txEditor',
            'label' => 'Conteúdo',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $strClass = @$arrParam['class'];
        if (empty($strClass))
            $strClass = 'editorFormElement';
        else
            $strClass .= ' editorFormElement';
        $arrParam['class'] = $strClass;
        $arrAttribute = array(
            'is_editor' => array('addOption', true),
            'class' => array('addAttribute'),
            'plugins' => array('addOption'),
            'toolbar' => array('addOption'),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addTextarea');
    }

}
