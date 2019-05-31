<?php

namespace InepZend\Module\Application\Controller;

use InepZend\Controller\AbstractControllerServiceManager;
use InepZend\WebService\Client\Soap;

class ObieeController extends AbstractControllerServiceManager
{

    /**
     * @auth no
     */
    public function bridgeObieeAction()
    {
        $strRedirectUrl = $this->getParamsFromQuery('RedirectURL');
        if (strpos($strRedirectUrl, '://') === false) {
            $strRedirectUrlNew = Soap::getUrlWsdl('InepZend\WebService\Client\Corporative\Inep\Obiee');
            if (strpos($strRedirectUrlNew, $strNeedle = '://') !== false) {
                $arrRedirectUrlNew = explode($strNeedle, $strRedirectUrlNew);
                $strRedirectUrlNew = $arrRedirectUrlNew[0];
                if (count($arrRedirectUrlNew) > 1)
                    $strRedirectUrlNew .= $strNeedle . reset($arrExplode = explode('/', $arrRedirectUrlNew[1]));
            }
            if (strpos($strRedirectUrl, 'res/') === 0)
                $strRedirectUrlNew .= '/analytics';
            $strRedirectUrlNew .= str_replace('//', '/', '/' . $strRedirectUrl);
            $strRedirectUrl = $strRedirectUrlNew;
        }
        exit($this->forwardRequest($strRedirectUrl));
        return $this->getViewClearContent();
    }

}
