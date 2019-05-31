<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;

class TreeHelper extends AbstractHelper
{

    /**
     * 
     * @param array $arrTree
     * @param boolean $booInputHidden
     * @param boolean $booSelectable
     * @return string
     * 
     * $arrTree = array(
     *      $arrNode1 = array(
     *          'Node 1', //Text
     *          array('span' => true, 'strong' => true, 'value' => 'Node 1 (primeiro)'), //Option
     *          array(), //Children
     *      ),
     *      $arrNode2 = array(
     *          'Node 2', //Text
     *          array('span' => true, 'strong' => true), //Option
     *          array(
     *              $arrNode21 = array(
     *                  'Node 21', //Text
     *                  array('callback' => 'loadData'), //Option
     *                  array(), //Children
     *              ),
     *          ), //Children
     *      ),
     * );
     */
    public function render($arrTree = null, $booInputHidden = null, $booSelectable = null)
    {
        return $this->renderStyle() . $this->renderScript($booInputHidden, $booSelectable) . $this->renderTree($arrTree, $booInputHidden, $booSelectable, true);
    }

    private function renderStyle()
    {
        return '<style type="text/css">
    .tree li {
        list-style-type: none;
        margin: 0px;
        padding: 10px 5px 0 5px;
        position: relative;
    }
    .tree li::before, 
    .tree li::after {
        content: "";
        left: -20px;
        position: absolute;
        right: auto;
    }
    .tree li::before {
        border-left: 1px solid #999999;
        bottom: 50px;
        height: 100%;
        top: 0px;
        width: 1px;
    }
    .tree li::after {
        border-top: 1px solid #999999;
        height: 20px;
        top: 25px;
        width: 25px;
    }
    .tree li span {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border: 1px solid #999999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none;
    }
    .tree li > span,
    .tree li > i.glyphicon {
        cursor: pointer;
    }
    .tree .glyphicon-ok {
        color: #CCCCCC;
    }
</style>';
    }

    private function renderScript($booInputHidden = null, $booSelectable = null)
    {
        return '<script type="text/javascript">
    function treeMain(booInputHidden, booSelectable)
    {
        $(".tree li").hide();
        $(".tree").children("ul").children("li").show();
        $(".tree li span, .tree i.glyphicon-plus-sign, .tree i.glyphicon-minus-sign").on("click", function () {
            if ($(this).prop("tagName") === "SPAN") {
                var ico = $(this).children("i.glyphicon-plus-sign");
                if (ico.size() == 0)
                    ico = $(this).children("i.glyphicon-minus-sign");
            } else if ($(this).prop("tagName") === "I")
                var ico = $(this);
            if (ico.size() == 0)
                return false;
            var parent = $(this).parent();
            if (parent.prop("tagName") === "SPAN")
                return true;
            var li = (parent.prop("tagName") === "LI") ? parent : undefined;
            var treeContent = parent.children(".tree-content");
            var treeLi = parent.children("ul").children("li");
            if (treeContent.size() >= 1)
                var manipulate = treeContent;
            else if (treeLi.size() >= 1)
                var manipulate = treeLi;
            else
                return false;
            if ((ico.attr("data-show") === undefined) || (ico.attr("data-show") === "false")) {
                manipulate.show("fast");
                ico.attr("data-show", "true");
                ico.addClass("glyphicon-minus-sign").removeClass("glyphicon-plus-sign");
                if ((treeContent.size() >= 1) && (ico.attr("data-load") === undefined)) {
                    var strCallback = li.attr("data-callback");
                    if ((strCallback != undefined) && (strCallback != "")) {
                        eval("var strTreeContent = " + strCallback + "(li);");
                        if (booInputHidden === true)
                            strTreeContent += "<input type=\'hidden\' name=\'hiddenTree[" + strTreeContent + "]\' class=\'hiddenTree\' value=\'" + strTreeContent + "\' />";
                        manipulate.html(strTreeContent);
                    }
                    ico.attr("data-load", "true");
                }
            } else {
                manipulate.hide("fast");
                ico.attr("data-show", "false");
                ico.addClass("glyphicon-plus-sign").removeClass("glyphicon-minus-sign");
            }
            return true;
        });
        $(".tree i.glyphicon-ok").on("click", function () {
            var input = $(this).parent().children("input");
            if (($(this).attr("data-select") === undefined) || ($(this).attr("data-select") === "false")) {
                $(this).attr("data-select", "true");
                $(this).css("color", "green");
                input.attr("disabled", false);
            } else {
                $(this).attr("data-select", "false");
                $(this).css("color", "#CCCCCC");
                input.prop("disabled", true);
            }
            return true;
        });
        return true;
    }
    $(document).ready(function () {
        treeMain(' . (($booInputHidden) ? 'true' : 'false') . ', ' . (($booSelectable) ? 'true' : 'false') . ');
    });
//    function loadData(li)
//    {
//        console.log(li);
//        return "testando 123";
//    }
</script>';
    }

    private function renderTree($arrTree = null, $booInputHidden = null, $booSelectable = null, $booDivTree = true)
    {
        if (empty($arrTree))
            return;
        $strResult = '';
        if ($booDivTree)
            $strResult .= '<div class="tree">';
        foreach ($arrTree as $intNode => $arrNode) {
            if ($intNode == 0)
                $strResult .= '<ul>';
            $strText = @$arrNode[0];
            if (empty($strText))
                continue;
            $arrOption = (array) @$arrNode[1];
            $arrChildren = (array) @$arrNode[2];
            $strSpan = (@$arrOption['span'] === true) ? 'span' : '';
            $strStrong = (@$arrOption['strong'] === true) ? 'strong' : '';
            $strValue = (!is_null(@$arrOption['value'])) ? $arrOption['value'] : $strText;
            $strCallback = (!is_null(@$arrOption['callback'])) ? ' data-callback="' . $arrOption['callback'] . '"' : '';
            $strResult .= str_replace(array('<>', '</>'), '', '<li data-value="' . $strValue . '"' . $strCallback . '>
                <' . $strSpan . '>
                    ' . (((empty($arrChildren)) && (empty($strCallback))) ? '' : '<i class="glyphicon glyphicon-plus-sign"></i>') . '
                    <' . $strStrong . '>' . $strText . '</' . $strStrong . '>
                </' . $strSpan . '>
                ' . (($booSelectable === true) ? '<i data-value="' . $strValue . '" class="glyphicon glyphicon-ok"></i>' : '') . '
                ' . ((!empty($arrChildren)) ? $this->renderTree($arrChildren, $booInputHidden, $booSelectable, false) : '') . '
                ' . ((!empty($strCallback)) ? '<div class="tree-content"></div>' : '') . '
                ' . (($booInputHidden === true) ? '<input data-value="' . $strValue . '" type="hidden" name="hiddenTree[' . $strValue . ']" class="hiddenTree" value="' . $strValue . '"' . (($booSelectable === true) ? ' disabled="disabled"' : '') . ' />' : '') . '
            </li>');
            if ($intNode == (count($arrTree) - 1))
                $strResult .= '</ul>';
        }
        if ($booDivTree)
            $strResult .= '</div>';
        return $strResult;
    }

}
