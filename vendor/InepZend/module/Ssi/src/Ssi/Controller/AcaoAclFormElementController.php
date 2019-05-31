<?php

namespace InepZend\Module\Ssi\Controller;

use InepZend\Module\Ssi\Controller\AbstractController;

class AcaoAclFormElementController extends AbstractController
{

    public function ajaxFetchPairsAction()
    {
        $arrData = $this->getPost();
        $strMethod = 'fetchPairsToXmlJson';
        if (array_key_exists('ds_module', $arrData))
            $strMethod = 'fetchPairsFormToXmlJson';
        elseif (array_key_exists('ds_form', $arrData))
            $strMethod = 'fetchPairsPrepareElementsToXmlJson';
        return parent::ajaxFetchPairsAction(array(), null, $strMethod, $arrData);
    }

}
