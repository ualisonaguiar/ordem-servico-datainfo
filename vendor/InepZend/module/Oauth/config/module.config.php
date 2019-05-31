<?php

namespace InepZend\Module\Oauth;

return array(
    'router' => array(
        'routes' => array(
            'twitterrequesttoken' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/twitterrequesttoken',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Twitter',
                        'action' => 'twitterrequesttoken',
                    ),
                ),
            ),
            'twittercallback' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/twittercallback',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Twitter',
                        'action' => 'twittercallback',
                    ),
                ),
            ),
            'instagramcode' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/instagramcode',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Instagram',
                        'action' => 'instagramcode',
                    ),
                ),
            ),
            'instagramcallback' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/instagramcallback',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Instagram',
                        'action' => 'instagramcallback',
                    ),
                ),
            ),
            'ssirequesttoken' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/ssirequesttoken',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Ssi',
                        'action' => 'ssirequesttoken',
                    ),
                ),
            ),
            'ssicallback' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ssicallback[/:params]',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Ssi',
                        'action' => 'ssicallback',
                    ),
                ),
            ),
            'facebookcode' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/facebookcode',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Facebook',
                        'action' => 'facebookcode',
                    ),
                ),
            ),
            'facebookcallback' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/facebookcallback',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Facebook',
                        'action' => 'facebookcallback',
                    ),
                ),
            ),
            'googlecode' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/googlecode',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Google',
                        'action' => 'googlecode',
                    ),
                ),
            ),
            'googlecallback' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/googlecallback',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Oauth\Controller\Google',
                        'action' => 'googlecallback',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Oauth\Controller\Twitter' => 'InepZend\Module\Oauth\Controller\TwitterController',
            'InepZend\Module\Oauth\Controller\Twitter' => 'InepZend\Module\Oauth\Controller\TwitterController',
            'InepZend\Oauth\Controller\Instagram' => 'InepZend\Module\Oauth\Controller\InstagramController',
            'InepZend\Module\Oauth\Controller\Instagram' => 'InepZend\Module\Oauth\Controller\InstagramController',
            'InepZend\Module\Oauth\Controller\Ssi' => 'InepZend\Module\Oauth\Controller\SsiController',
            'InepZend\Module\Oauth\Controller\Facebook' => 'InepZend\Module\Oauth\Controller\FacebookController',
            'InepZend\Module\Oauth\Controller\Google' => 'InepZend\Module\Oauth\Controller\GoogleController',
        ),
    ),
);