<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element do tipo Image.
 */
trait InputImage
{

    /**
     * Metodo responsavel em adicionar o Element do tipo Image.
     * 
     * @example $this->addInputImage($strName, $strId, $strTitle, $strClass, $strStyle, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strAccessKey, $strSource, $strOnClick);
     * 
     * @param type $strName
     * @param type $strId
     * @param type $strTitle
     * @param type $strClass
     * @param type $strStyle
     * @param type $strResource
     * @param type $strActionToResourceNotAllowed
     * @param type $intTabindex
     * @param type $arrAttributeData
     * @param type $strAccessKey
     * @param type $strSource
     * @param type $strOnClick
     * @return type
     */
    public function addInputImage($strName, $strId = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strAccessKey = null, $strSource = null, $strOnClick = null)
    {
        $arrParamExtra = array(
            array('accesskey', 'strAccessKey'),
            array('src', 'strSource'),
            array('onclick', 'strOnClick'),
        );
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Image'),
            'src' => array('addAttribute'),
            'accesskey' => array('addAttribute'),
            'onclick' => array('addAttribute'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(array(1, 3, 4, 5, 9, 10, 11, 12, 13, 18, 19))));
    }

}
