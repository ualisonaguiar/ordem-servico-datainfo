<?php

namespace InepZend\Theme\PortalBackgroundVermelho2013\View\Helper;

use InepZend\View\Helper\AbstractHtmlBodyHelper;

class HtmlBodyHelper extends AbstractHtmlBodyHelper
{

    public function renderNavBar($booEchoResult = true)
    {
        return parent::renderNavBar($this->getRenderer()->barraBrasil()->getHtmlV3(), null, null, $booEchoResult);
    }

    public function renderHeader($booEchoResult = true)
    {
        return $this->renderHeaderPortal($booEchoResult);
    }

    public function renderContent($arrHtmlHeadInfo = null, $booEchoResult = true)
    {
        return parent::renderContent('container', $arrHtmlHeadInfo, $booEchoResult);
    }

}
