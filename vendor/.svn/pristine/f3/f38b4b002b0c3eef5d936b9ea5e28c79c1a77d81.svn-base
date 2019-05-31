<?php

namespace InepZend\Module\Corporative\Controller;

use InepZend\Controller\AbstractController;
use Zend\Json\Encoder;

class OrgaoEmissorController extends AbstractController
{

    /**
     * @auth no
     */
    public function ajaxFindByAction()
    {
        $mixResult = $this->getService('InepZend\Module\Corporative\Service\VwOrgaoEmissor')->suggestion(array('noOrgaoEmissor' => $this->getPost('term')), $this->getPost('limit'));
        if (is_array($mixResult))
            $mixResult = Encoder::encode($mixResult);
        return $this->getViewClearContent($mixResult);
    }

}
