<?php

namespace InepZend\Theme\PortalBackgroundCinza2014\View\Helper;

use InepZend\View\Helper\AbstractHtmlHeadHelper;

class HtmlHeadHelper extends AbstractHtmlHeadHelper
{

    public function link()
    {
        $arrPrependStylesheet = array();
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-button.css';
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-flexigrid.css';
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-form.css';
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-footer.css';
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style-menu.css';
        $arrPrependStylesheet[] = '/vendor/InepZend/theme/portal-background-cinza-2014/css/style.css';
        $arrPrependStylesheet[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css';
        return parent::link($arrPrependStylesheet);
    }

    public function script()
    {
        $arrPrependFile = array();
        $arrPrependFile[] = '/vendor/InepZend/theme/portal-background-cinza-2014/js/library.js';
        $arrPrependFile[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js';
        $arrPrependFile[] = '/vendor/jquery-fancybox/jquery-fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js';
        return parent::script($arrPrependFile);
    }

}
