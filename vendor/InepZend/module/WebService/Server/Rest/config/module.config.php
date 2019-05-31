<?php

namespace InepZend\Module\WebService\Server\Rest;

return array(
    'router' => array(
        'routes' => array(
            'rest' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/rest',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\WebService\Server\Rest\Controller\Rest',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\WebService\Server\Rest\Controller\Rest' => 'InepZend\Module\WebService\Server\Rest\Controller\RestController',
            'InepZend\Module\WebService\Server\Rest\Controller\Rest' => 'InepZend\Module\WebService\Server\Rest\Controller\RestController',
        ),
    ),
);