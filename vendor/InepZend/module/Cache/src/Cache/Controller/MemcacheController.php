<?php

namespace InepZend\Module\Cache\Controller;

use InepZend\Controller\AbstractControllerServiceManager;
use InepZend\Module\Application\Controller\ReadmeController;
use InepZend\View\View;
use InepZend\View\RenderTemplate;
use InepZend\View\RenderTemplateGoogle;
use InepZend\View\Renderer\Renderer;
use InepZend\Util\Math;

class MemcacheController extends AbstractControllerServiceManager
{

    use RenderTemplate,
        RenderTemplateGoogle;

    /**
     * @resource RSRC_MEMCACHE_INDEX
     */
    public function indexAction()
    {
        $memcacheModuleService = $this->getService('InepZend\Module\Cache\Service\MemcacheModule');
        $arrServersStats = $memcacheModuleService->getExtendedStats();
        $arrAllCache = $memcacheModuleService->getAllCache();
        $arrRenderGauge = array();
        if ($arrServersStats) {
            foreach ($arrServersStats as $strHostServer => $arrStatisticServer) {
                $arrData = array();
                if ($arrStatisticServer) {
                    $arrData[] = array(
                        'Memória',
                        Math::getPercent($arrStatisticServer['limit_maxbytes'], $arrStatisticServer['bytes'], 2),
                    );
                    $arrRenderGauge[$strHostServer] = $this->renderGauge(array('arrData' => $arrData));
                }
            }
        }
        Renderer::setExecuteFilter(false);
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('gaugeChart' => $arrRenderGauge, 'cacheAll' => $arrAllCache)));
    }

    public function detailCacheAction()
    {
        $strHost = str_replace('-', '.', $this->params()->fromRoute('host'));
        $strPort = $this->params()->fromRoute('port');
        $strHostServer = $strHost . ':' . $strPort;
        $memcacheModuleService = $this->getService('InepZend\Module\Cache\Service\MemcacheModule');
        $arrServersStats = $memcacheModuleService->getExtendedStats();
        if (array_key_exists($strHostServer, $arrServersStats)) {
            $arrData = array(
                array('Item', 'Valor'),
            );
            foreach ($arrServersStats[$strHostServer] as $strKey => $strValue) {
                $arrData[] = array(
                    $strKey,
                    $strValue,
                );
            }
            $strRenderTable = $this->renderTable(array('arrData' => $arrData));
        }
        $this->layout('layout/layout-clean');
        return new View(array_merge(ReadmeController::getParamMenu(), array('server' => $strHostServer, 'renderTable' => $strRenderTable)));
    }

    public function ajaxClearCacheAction()
    {
        $booResult = false;
        if ($this->isPost()) {
            $arrPost = $this->getPost();
            if (($arrPost['key']) && ($arrPost['keyClass']))
                $booResult = (boolean) $this->getService('InepZend\Module\Cache\Service\MemcacheModule')->clearItemCache(base64_decode($arrPost['key']), base64_decode($arrPost['keyClass']));
            else
                $booResult = (boolean) $this->getService('InepZend\Cache\Service\Memcache')->clearCache();
        }
        return $this->getViewClearContent($booResult);
    }

}
