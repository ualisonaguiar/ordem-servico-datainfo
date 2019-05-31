<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class FontSizeHelper extends AbstractHelper
{

    private $strResult = '';
    private static $booInclude = false;

    public function __invoke()
    {
        $this->strResult = (!self::$booInclude) ? '<link href="' . $this->getBaseUrl() . '/vendor/InepZend/css/style-icon-fontsize' . AbstractHtmlHeadHelper::getSufixCss() . '" media="screen" rel="stylesheet" type="text/css">' : '';
        self::$booInclude = true;
        return $this;
    }

    public function render()
    {
        $strContent = $this->strResult . '<div id="buttonControlFontSize">
                    <a href="javascript:controlFontSize(\'0\', 140, 60); void(0);">
                        <div title="Fonte normal" class="icoFontSize icoFontSizeNormal"></div>
                    </a>
                    <a href="javascript:controlFontSize(\'+\', 140, 60); void(0);">
                        <div title="Aumentar fonte" class="icoFontSize icoFontSizePlus"></div>
                    </a>
                    <a href="javascript:controlFontSize(\'-\', 140, 60); void(0);">
                        <div title="Diminuir fonte" class="icoFontSize icoFontSizeMinus"></div>
                    </a>
                </div>';
        $this->strResult = '';
        return $strContent;
    }

    public function renderPortal()
    {
        $strContent = $this->strResult . '<div class="botoes_acessibilidade borda_arredondada">
                                <ul>
                                    <li>
                                        <a href="#" id="aumentarFonte">
                                            <div class="icoFontSize icoFontSizePlus" title="aumentar fonte"></div>
                                            &nbsp;
                                            aumentar fonte
                                        </a>
                                    </li>                                
                                    <li>
                                        <a href="#" id="diminuirFonte">
                                            <div class="icoFontSize icoFontSizeMinus" title="diminuir fonte"></div>
                                            &nbsp;
                                            diminuir fonte
                                        </a>
                                    </li>
                                </ul>
                            </div>';
        $this->strResult = '';
        return $strContent;
    }

}
