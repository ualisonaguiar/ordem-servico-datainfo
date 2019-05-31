<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;

/**
 * Trait responsavel em manipular Elemens para Group.
 */
trait Group
{

    /**
     * Metodo responsavel em inserir Grupo de Elements.
     * 
     * @param array $arrParam
     * @param array $arrElement
     * @param string $strLabel
     * @param string $strClass
     * @param string $strStyle
     * @return boolean
     */
    public function addGroup($arrParam = null, $arrElement = null, $strLabel = null, $strClass = 'well', $strStyle = '')
    {
        $this->addHtml('<div class="' . $strClass . '" style="overflow: hidden;' . $strStyle . '"><h3>' . $strLabel . '</h3>');
        $strTypeValidateMessage = @$arrParam['validate_message'];
        $strActionToResourceNotAllowed = @$arrParam['action_to_resource_not_allowed'];
        $this->editGroupContato($arrParam, $arrElement);
        $this->editGroupDadoPessoal($arrParam, $arrElement);
        $this->editGroupDadoBancario($arrParam, $arrElement);
        foreach ((array) $arrElement as $strNameElement => $arrParamSpecific) {
            if (!$this->getParamValue($arrParam, 'not_show', $strNameElement)) {
                $strMethod = 'add' . $arrParamSpecific['type'];
                $arrParamMethod = array_merge(array('name' => $strNameElement), $arrParamSpecific);
                unset($arrParamMethod['type']);
                ArrayCollection::clearEmptyParam($arrParamMethod);
                $arrParamValue = array(
                    'required' => $this->getParamValue($arrParam, 'required', $strNameElement),
                    'validate_message' => $strTypeValidateMessage,
                    'disabled' => $this->getParamValue($arrParam, 'disabled', $strNameElement),
                    'resource' => $this->getParamValue($arrParam, 'resource', $strNameElement),
                    'action_to_resource_not_allowed' => $strActionToResourceNotAllowed,
                    'readonly' => $this->getParamValue($arrParam, 'readonly', $strNameElement),
                    'attr_data' => $this->getParamValue($arrParam, 'attr_data', $strNameElement),
                );
                ArrayCollection::clearEmptyParam($arrParamValue);
                $arrParamMethod = array_merge($arrParamMethod, $arrParamValue);
                $strPlaceHolder = $this->getParamValue($arrParam, 'placeholder', $strNameElement);
                if (!empty($strPlaceHolder)) {
                    $arrParamMethod['placeholder'] = $strPlaceHolder;
                    if (array_key_exists('empty_option', $arrParamMethod))
                        $arrParamMethod['empty_option'] = $strPlaceHolder;
                }
                $this->$strMethod($arrParamMethod);
            }
        }
        $this->addHtml('</div>');
        return $this;
    }

}
