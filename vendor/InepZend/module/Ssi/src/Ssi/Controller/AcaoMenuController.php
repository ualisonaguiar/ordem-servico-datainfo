<?php

namespace InepZend\Module\Ssi\Controller;

use InepZend\Module\Ssi\Controller\AbstractController;

class AcaoMenuController extends AbstractController
{

    /**
     * 
     * @return object
     * 
     * @resource RSRC_SSI_MENU_ACL
     */
    public function indexAction()
    {
        return parent::indexAction(null, null, null, null, true);
    }

    /**
     * Metodo responsavel pela conversao da serializacao das siglas do SSI.
     * 
     * @return object
     */
    public function informationAcronymSsiAction()
    {
        $arrPost = $this->getPost();
        return $this->getViewClearContent(json_encode((array_key_exists('acronymSsi', $arrPost) ? unserialize($this->getPost('acronymSsi')) : array('acronymSsi' => serialize($arrPost)))));
    }

    /**
     * Metodo responsavel pela exportacao das informacoes do SSI
     * 
     * @return object
     */
    public function downloadAcronymAction()
    {
        $this->downloadXmlInformationSsi('acoes');
        return $this->getViewClearContent();
    }

}
