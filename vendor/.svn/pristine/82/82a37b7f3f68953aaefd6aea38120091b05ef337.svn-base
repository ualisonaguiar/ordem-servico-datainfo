<?php

namespace InepZend\Module\Ssi\Controller;

use InepZend\Module\Ssi\Controller\AbstractController;

class AcaoAclRouteController extends AbstractController
{

    public function ajaxFetchPairsAction()
    {
        $arrData = $this->getPost();
        $strMethod = 'fetchPairsToXmlJson';
        if (array_key_exists('ds_module', $arrData))
            $strMethod = 'fetchPairsControllerToXmlJson';
        elseif (array_key_exists('ds_controller', $arrData))
            $strMethod = 'fetchPairsActionToXmlJson';
        return parent::ajaxFetchPairsAction(array(), null, $strMethod, $arrData);
    }

    public function downloadAcronymProfileAction()
    {
        $this->downloadXmlInformationSsi('perfis');
        return $this->getViewClearContent();
    }

}
