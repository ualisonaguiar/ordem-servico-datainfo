<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\Html as HtmlUtil;

/**
 * Trait responsavel em manipular o Element Html para Label.
 */
trait Link
{

    /**
     * Metodo responsavel em inserir o Element Html para Links.
     * 
     * @example addLink($strName, $strId, $strLabel, $strTitle, $strClass, $strStyle, $strResource, $strActionToResourceNotAllowed, 10, array(), $strLink, $strTarget);
     * 
     * @param string $strName
     * @param string $strId
     * @param string $strLabel
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strLink
     * @param string $strTarget
     * @return mix
     */
    public function addLink($strName, $strId = null, $strLabel = null, $strTitle = null, $strClass = null, $strStyle = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strLink = null, $strTarget = null)
    {
        $arrParamExtra = array(
            array('link', 'strLink'),
            array('target', 'strTarget'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(1, 4, 5, 9, 10, 11, 12, 13, 18, 19)));
        $strLink = @$arrParam['link'];
        if (empty($strLink))
            return;
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = $strLink;
        $strTitle = @$arrParam['title'];
        $strClass = @$arrParam['class'];
        $strStyle = @$arrParam['style'];
        $intTabindex = @$arrParam['tabindex'];
        $strName = @$arrParam['name'];
        $strId = @$arrParam['id'];
        $strTarget = @$arrParam['target'];
        if (empty($strTarget))
            $strTarget = '_self';
        $strHtml = '<a href="' . $strLink . '"' .
                ((!empty($strTitle)) ? ' title="' . $strTitle . '"' : '') .
                ((!empty($strClass)) ? ' class="' . $strClass . '"' : '') .
                ((!empty($strStyle)) ? ' style="' . $strStyle . '"' : '') .
                ((!is_null($intTabindex)) ? ' tabindex="' . $intTabindex . '"' : '') .
                ((!empty($strName)) ? ' name="' . $strName . '"' : '') .
                ((!empty($strId)) ? ' id="' . $strId . '"' : '') .
                (' target="' . $strTarget . '"') .
                HtmlUtil::getHtmlAttributeData(@$arrParam['attr_data']) . '>' . $strLabel . '</a>';
        return $this->addHtml($strHtml, null, false);
    }

}
