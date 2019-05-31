<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;

class ProgressBarHelper extends AbstractHelper
{

    const CSS_CLASS_CONTAINER_PROGRESS = 'progressBarContainer';
    const CSS_CLASS_PROGRESS = 'progressBar';
    const CSS_CLASS_PERCENT = 'progressBarPercent';
    const SUFIX_ID_PERCENT = 'Percent';

    public function render($intValue = 0, $booInitial = true, $strIdProgressBar = null)
    {
        return $this->renderStyle() . $this->renderScript() . $this->renderProgressBar($intValue, $booInitial, $strIdProgressBar) . (($booInitial) ? '' : $this->renderSetValueProgressBar($intValue, $strIdProgressBar));
    }

    private function renderStyle()
    {
        return '<style type="text/css">
            .' . self::CSS_CLASS_CONTAINER_PROGRESS . ' {
                width: 200px;
                float: left;
                background-color: #F3F3F3;
                border: 1px solid #000000;
                height: 22px;
            }
            .' . self::CSS_CLASS_PROGRESS . ' {
                color: gray;
                border: 0px;
                width: 100%;
                height: 100%;
            }
            progress.' . self::CSS_CLASS_PROGRESS . '::-webkit-progress-bar {
                background: #F3F3F3; /*Chrome*/
            }
            progress.' . self::CSS_CLASS_PROGRESS . '::-webkit-progress-value {
                background: gray; /*Chrome*/
            }
            progress.' . self::CSS_CLASS_PROGRESS . '::-moz-progress-bar {
                background: gray; /*FF*/
            }
            .' . self::CSS_CLASS_PERCENT . ' {
                padding-left: 3px;
                width: 40px;
                overflow: hidden;
            }
        </style>';
    }

    private function renderScript()
    {
        return '<script type="text/javascript">
    function getProgressBar(mixProgressBar)
    {
        var progressBar = getObject(mixProgressBar);
        if (progressBar == undefined) {
            var arrProgress = document.getElementsByTagName("PROGRESS");
            if ((document.all) && (arrProgress.length == 0))
                arrProgress = getElementsFromAttribute(document.body, "DIV", "class", "' . self::CSS_CLASS_PROGRESS . '");
            if (arrProgress.length == 0)
                return false;
            progressBar = arrProgress[0];
        }
        return progressBar;
    }
    
    function setValueProgressBar(intValue, mixProgressBar)
    {
        var progressBar = getProgressBar(mixProgressBar);
        var progressBarJquery = $(progressBar);
        var progressBarPercent = getObject(progressBarJquery.attr("id") + "' . self::SUFIX_ID_PERCENT . '");
        var intMax = progressBarJquery.attr("max");
        var intValueCurrent = (!document.all) ? progressBarJquery.val() : progressBar.getAttribute("value");
        if (!isNumeric(intValueCurrent))
            intValueCurrent = 0;
        else
            intValueCurrent = parseInt(intValueCurrent);
        if (intValue == undefined) {
            if (progressBarPercent != undefined)
                $(progressBarPercent).html(intValueCurrent + "%");
            return false;
        }
        var intTimeLimit = (1000 / intMax) * 5;
        var loadProgressBar = function() {
            if (intValue == intValueCurrent)
                clearInterval(animateProgressBar);
            var booIncrement = (intValue > intValueCurrent);
            if (booIncrement)
                intValueCurrent += 1;
            else
                intValueCurrent -= 1;
            if (!document.all)
                progressBarJquery.val(intValueCurrent);
            else {
                progressBar.setAttribute("value", intValueCurrent);
                progressBar.style.backgroundColor = "gray";
                progressBar.style.width = intValueCurrent + "%";
            }
            if (progressBarPercent != undefined)
                $(progressBarPercent).html(intValueCurrent + "%");
            if (((booIncrement) && (intValueCurrent >= intValue)) || ((!booIncrement) && (intValueCurrent <= intValue)) || (intValueCurrent >= intMax))
                clearInterval(animateProgressBar);
        };
        var animateProgressBar = setInterval(function(){
            loadProgressBar();
        }, intTimeLimit);
        return true;
    }
    
    function renderProgressBar(mixProgressBar)
    {
        var progressBar = getProgressBar(mixProgressBar);
        if ((progressBar == undefined) || (!document.all))
            return false;
        progressBar.style.backgroundColor = "gray";
        progressBar.style.width = progressBar.getAttribute("value") + "%";
        var strDiv = replaceAll(replaceAll(progressBar.outerHTML, "<progress", "<div"), "progress>", "div>");
        progressBar.parentNode.innerHTML = strDiv;
        return true;
    }
</script>';
    }

    private function renderProgressBar($intValue = 0, $booInitial = true, $strIdProgressBar = null)
    {
        if (empty($strIdProgressBar))
            $strIdProgressBar = 'progressBar';
        if (!$booInitial)
            $intValue = 0;
        return '<div class="' . self::CSS_CLASS_CONTAINER_PROGRESS . '">
                <progress class="' . self::CSS_CLASS_PROGRESS . '" id="' . $strIdProgressBar . '" value="' . (integer) $intValue . '" max="100"></progress>
            </div>
            <div class="' . self::CSS_CLASS_PERCENT . '" id="' . $strIdProgressBar . self::SUFIX_ID_PERCENT . '">
                ' . (integer) $intValue . '%
            </div>
            <script type="text/javascript">renderProgressBar("' . $strIdProgressBar . '");</script>';
    }

    private function renderSetValueProgressBar($intValue = 0, $strIdProgressBar = null)
    {
        return '<script type="text/javascript">setValueProgressBar(' . (integer) $intValue . ', ' . ((empty($strIdProgressBar)) ? 'undefined' : '"' . $strIdProgressBar . '"') . ');</script>';
    }

}
