<?php

namespace InepZend\Module\Corporative\Controller;

use InepZend\Controller\AbstractController;
use InepZend\Util\String;
use Zend\Json\Encoder;

class MunicipioController extends AbstractController
{

    /**
     * @auth no
     */
    public function ajaxFetchPairsAction()
    {
        $arrPost = $this->getPost();
        $strAttributeValue = (!@empty($arrPost['attribute_value'])) ? $arrPost['attribute_value'] : 'coUf';
        $strAttributeText = (!@empty($arrPost['attribute_text'])) ? $arrPost['attribute_text'] : 'noMunicipio';
        $mixUf = null;
        foreach ($arrPost as $strKey => $mixValue) {
            $strAttributeValueDasherize = String::dasherize($strAttributeValue);
            if ((strpos($strKey, $strAttributeValue) !== false) || (strpos($strKey, $strAttributeValueDasherize) !== false) || (strpos($strKey, str_replace('-', '_', $strAttributeValueDasherize)) !== false)) {
                $mixUf = $mixValue;
                break;
            }
        }
        if (empty($mixUf))
            return $this->getViewClearContent();
        return parent::ajaxFetchPairsAction($this->getService('InepZend\Module\Corporative\Service\VwMunicipio')->fetchPairsToXmlJson(array($strAttributeValue => $mixUf), null, null, array($strAttributeText => 'ASC')));
    }

    /**
     * @auth no
     */
    public function ajaxFindByAction()
    {
        $mixResult = $this->getService('InepZend\Module\Corporative\Service\VwMunicipio')->suggestion(array('noMunicipio' => $this->getPost('term')), $this->getPost('limit'));
        if (is_array($mixResult))
            $mixResult = Encoder::encode($mixResult);
        return $this->getViewClearContent($mixResult);
    }

}
