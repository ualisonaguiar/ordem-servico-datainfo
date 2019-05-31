<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class SocialNetworkHelper extends AbstractHelper
{

    private $strResult = '';
    private static $booInclude = false;

    public function __invoke()
    {
        $this->strResult = (!self::$booInclude) ? '<link href="' . $this->getBaseUrl() . '/vendor/InepZend/css/style-icon-socialnetwork' . AbstractHtmlHeadHelper::getSufixCss() . '" media="screen" rel="stylesheet" type="text/css">' : '';
        self::$booInclude = true;
        return $this;
    }

    public function renderTwitter()
    {
        $strContent = $this->strResult . '<a href="http://twitter.com/#!/Inep_Imprensa" target="_blank" title="Twitter">
                        <div class="icoSocialNetwork icoTwitter"></div>
                    </a>';
        $this->strResult = '';
        return $strContent;
    }

    public function renderRss()
    {
        $strContent = $this->strResult . '<a href="http://portal.inep.gov.br/lista-de-rss" target="_blank" title="RSS">
                    <div class="icoSocialNetwork icoRss"></div>
                </a>';
        $this->strResult = '';
        return $strContent;
    }

}
