<?php

namespace Migracao\Controller;

use InepZend\Controller\AbstractCrudController;

class IndexController extends AbstractCrudController
{

    public function indexAction()
    {
        $this->getService('Migracao\Service\Migracao')->iniciarMigracao();
        return $this->getViewClearContent('Migracao Ocorrida com sucesso.');
    }
}
