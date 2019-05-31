<?php

namespace InepZend\Module\Corporative\Controller;

use InepZend\Controller\AbstractController;

class UfController extends AbstractController
{

    /**
     * @auth no
     */
    public function ajaxGetCoUfFromSiglaAction()
    {
        $strResult = '';
        $arrPost = $this->getPost();
        $strSglUf = (array_key_exists('sigla', $arrPost)) ? $arrPost['sigla'] : null;
        if (!empty($strSglUf)) {
            $arrUf = $this->getService('InepZend\Module\Corporative\Service\Uf')->findBy(array('sglUf' => $strSglUf));
            if ((is_array($arrUf)) && (count($arrUf) > 0)) {
                $uf = $arrUf[0];
                $strResult = $uf->getCoUf();
            }
        }
        return $this->getViewClearContent($strResult);
    }

}
