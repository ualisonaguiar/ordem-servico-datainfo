<?php

namespace InepZend\Theme\Administrative\View\Helper;

use InepZend\View\Helper\AbstractHtmlBodyHelper;

class HtmlBodyHelper extends AbstractHtmlBodyHelper
{

    public function renderNavBar($booContainer = true, $booEchoResult = true)
    {
        $strContent = '<div id="headerInepBackground"' . (($booContainer) ? ' class="container"' : '') . '>
            <div id="headerInepLogo" onclick="popup(\'http://portal.inep.gov.br\', \'popupPortal\');" class="no-print"></div>
            ' . $this->getRenderer()->fontSize()->render() . '
            <h1 class="company-title no-screen">
                ' . $this->renderInepBar(false) . '
            </h1>
        </div>';
        return parent::renderNavBar($strContent, null, null, $booEchoResult);
    }

}
