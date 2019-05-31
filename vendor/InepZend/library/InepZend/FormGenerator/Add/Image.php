<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\Html as HtmlUtil;

/**
 * Trait responsavel em manipular o Element do tipo Html para Imagem.
 */
trait Image
{

    /**
     * Metodo responsavel em inserir o Element Html para Imagens.
     * 
     * @example $this->addImage($strName, $strId, $strTitle, $strClass, $strStyle, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strSource, $strOnClick);
     * 
     * @param string $strName
     * @param string $strId
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strSource
     * @param string $strOnClick
     * @return mix
     */
    public function addImage($strName = null, $strId = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strSource = null, $strOnClick = null)
    {
        $arrParamExtra = array(
            array('src', 'strSource'),
            array('onclick', 'strOnClick'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 3, 4, 5, 9, 10, 11, 12, 13, 18, 19)));
        $strSource = @$arrParam['src'];
        $strStyle = @$arrParam['style'];
        if ((empty($strSource)) && (stripos($strStyle, 'display') === false))
            return;
        $strName = @$arrParam['name'];
        $strId = @$arrParam['id'];
        $strTitle = @$arrParam['title'];
        $strClass = @$arrParam['class'];
        $strOnClick = @$arrParam['onclick'];
        $strHtml = '<img src="' . $strSource . '"' .
                ((!empty($strName)) ? ' name="' . $strName . '"' : '') .
                ((!empty($strId)) ? ' id="' . $strId . '"' : '') .
                ((!empty($strTitle)) ? ' title="' . $strTitle . '"' : '') .
                ((!empty($strClass)) ? ' class="' . $strClass . '"' : '') .
                ((!empty($strStyle)) ? ' style="' . $strStyle . '"' : '') .
                ((!empty($strOnClick)) ? ' onclick="' . $strOnClick . '"' : '') .
                HtmlUtil::getHtmlAttributeData(@$arrParam['attr_data']) . ' />';
        return $this->addHtml($strHtml, null, false);
    }

}
