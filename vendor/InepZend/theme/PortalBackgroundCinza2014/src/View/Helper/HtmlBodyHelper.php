<?php

namespace InepZend\Theme\PortalBackgroundCinza2014\View\Helper;

use InepZend\View\Helper\AbstractHtmlBodyHelper;

class HtmlBodyHelper extends AbstractHtmlBodyHelper
{

    public function renderHeader($booEchoResult = true)
    {
        return $this->renderHeaderPortal($booEchoResult);
    }

    public function renderContent($arrHtmlHeadInfo = null, $booEchoResult = true)
    {
        return parent::renderContent('container borda_arredondada', $arrHtmlHeadInfo, $booEchoResult);
    }

}
