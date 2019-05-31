<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Submit.
 */
trait Submit
{

    /**
     * Metodo responsavel em inserir o Element Subimt de forma customizada.
     * 
     * @example $this->addSubmit($strName, $strValue, $strId, $strTitle, $strClass, $strStyle, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData);
     * 
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @return mix
     */
    public function addSubmit($strName, $strValue = null, $strId = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null)
    {
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Submit'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), null, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(array(3, 4, 5, 9, 10, 11, 12, 13, 18, 19))));
    }

}
