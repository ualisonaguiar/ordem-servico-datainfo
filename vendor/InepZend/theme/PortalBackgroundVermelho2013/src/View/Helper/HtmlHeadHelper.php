<?php

namespace InepZend\Theme\PortalBackgroundVermelho2013\View\Helper;

use InepZend\View\Helper\AbstractHtmlHeadHelper;

class HtmlHeadHelper extends AbstractHtmlHeadHelper
{

    public function link()
    {
        $arrPrependStylesheet = array();
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-vermelho-2013/css/style.css';
        $arrPrependStylesheet[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css';
        $arrPrependStylesheet[] = '/vendor/MECdefault/screen.css';
        return parent::link($arrPrependStylesheet);
    }

    public function script()
    {
        $arrPrependFile = array();
        $arrPrependFile[] = '/vendor/InepZend/theme/portal-background-vermelho-2013/js/library.js';
        $arrPrependFile[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js';
        $arrPrependFile[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js';
        return parent::script($arrPrependFile);
    }

}
