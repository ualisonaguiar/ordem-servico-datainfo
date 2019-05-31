<?php

namespace InepZend\Module\Executor;

use InepZend\ModuleConfig\ModuleConfig;
use InepZend\Module\Executor\Service\Executor;
use InepZend\Module\Executor\Form\Executor as ExecutorForm;
use InepZend\Module\Executor\Service\Usuario;
use InepZend\Module\Executor\Form\Usuario as UsuarioForm;
use InepZend\Module\Executor\Service\HistoricoExecucao;
use InepZend\Module\Executor\Service\Query;
use InepZend\Module\Executor\Service\Email;
use InepZend\Module\Executor\Service\EmailHistoricoQuery;

class Module extends ModuleConfig
{

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InepZend\Module\Executor\Service\Executor' => function($serviceManager = null) {
                    return new Executor($this->getEntityManager($serviceManager));
                },
                'InepZend\Module\Executor\Form\Executor' => function() {
                    return new ExecutorForm();
                },
                'InepZend\Module\Executor\Service\Usuario' => function() {
                    return new Usuario();
                },
                'InepZend\Module\Executor\Form\Usuario' => function() {
                    return new UsuarioForm();
                },
                'InepZend\Module\Executor\Service\HistoricoExecucao' => function() {
                    return new HistoricoExecucao();
                },
                'InepZend\Module\Executor\Service\Query' => function() {
                    return new Query();
                },
                'InepZend\Module\Executor\Service\Email' => function() {
                    return new Email();
                },
                'InepZend\Module\Executor\Service\EmailHistoricoQuery' => function() {
                    return new EmailHistoricoQuery();
                },
            ),
        );
    }

}
