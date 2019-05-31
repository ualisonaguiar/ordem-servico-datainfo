<?php

namespace InepZend\Module\Cache\Controller;

use InepZend\Controller\AbstractControllerServiceManager;
use InepZend\Module\Application\Controller\ReadmeController;
use InepZend\View\View;
use InepZend\View\Renderer\Renderer;

class OPCacheController extends AbstractControllerServiceManager
{

    /**
     * @resource RSRC_OPCACHE_INDEX
     */
    public function indexAction()
    {
        Renderer::setExecuteFilter(false);
        $this->layout('layout/layout-clean');
        return new View(ReadmeController::getParamMenu());
    }

    public function ajaxClearCacheAction()
    {
        $booResult = false;
        if ($this->isPost()) {
            $arrPost = $this->getPost();
            if (($arrPost['opcache']) && (function_exists('opcache_reset')))
                $booResult = (boolean) $this->getService('InepZend\Cache\Service\OPCacheModule')->clearCache();
        }
        return $this->getViewClearContent($booResult);
    }

}
