<?php

namespace InepZend\Theme\ConsultaPublica\View\Helper;

use InepZend\View\Helper\AbstractHtmlBodyHelper;

class HtmlBodyHelper extends AbstractHtmlBodyHelper
{

    public function renderNavBar($booEchoResult = true)
    {
        return parent::renderNavBar($this->getRenderer()->fontSize()->render(), null, 'navbarInep', $booEchoResult);
    }

    public function renderContent($arrHtmlHeadInfo = null, $booEchoResult = true)
    {
        return parent::renderContent(null, $arrHtmlHeadInfo, $booEchoResult);
    }

}
