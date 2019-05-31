<?php

namespace InepZend\Module\Application;

return array(
    'router' => array(
        'routes' => array(
            'inicial' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/inicial',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'inicial',
                    ),
                ),
            ),
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'InepZend\Module\Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'showfile' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/showfile[/:path][/:force_download]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'showfile',
                    ),
                ),
            ),
            'barcode' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/barcode[/:param]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'barcode',
                    ),
                ),
            ),
            'inputfile' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/inputfile[/:path]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'inputfile',
                    ),
                ),
            ),
            'message' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/message',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'message',
                    ),
                ),
            ),
            'ajaxwebservice' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/ajaxwebservice',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'ajaxWebService',
                    ),
                ),
            ),
            'ajaxuploadfile' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ajaxuploadfile[/:param]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'ajaxUploadFile',
                    ),
                ),
            ),
            'ajaxremovefile' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/ajaxremovefile',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'ajaxRemoveFile',
                    ),
                ),
            ),
            'ajaxuploadfilecrop' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/ajaxuploadfilecrop',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'ajaxUploadFileCrop',
                    ),
                ),
            ),
            'renderscript' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/renderscript/:module/:type/:filename',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'type' => 'js||css',
                        'filename' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'filename' => '[a-zA-Z0-9-_\.]+\.(js|css)$',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'renderscript',
                    ),
                ),
            ),
            'renderscript_alternative1' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/renderscript/:module/:sub_module/:type/:filename',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'sub_module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'type' => 'js||css',
                        'filename' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'filename' => '[a-zA-Z0-9-_\.]+\.(js|css)$',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'renderscript',
                    ),
                ),
            ),
            'js_entityconst' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/js_entityconst/:module/:entity',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'entity' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'jsentityconst',
                    ),
                ),
            ),
            'js_entityattribute' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/js_entityattribute/:module/:entity',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'entity' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'jsentityattribute',
                    ),
                ),
            ),
            'js_message' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/js_message/:module',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'jsmessage',
                    ),
                ),
            ),
            'bridgeobiee' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/bridgeobiee[/:url]',
                    'constraints' => array(
                        'url' => '.*',
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Obiee',
                        'action' => 'bridgeObiee',
                    ),
                ),
            ),
            'aplication-autoload-config' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/application/autoload-config[/:action][/:ds_path]',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\AutoloadConfig',
                        'action' => 'index',
                    ),
                ),
            ),
            'readme' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/readme[/:action][/:ds_path]',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Readme',
                        'action' => 'readme',
                    ),
                ),
            ),
            'ws-app-info' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/rest/app/info',
                    'defaults' => array(
                        'controller' => 'InepZend\Module\Application\Controller\Index',
                        'action' => 'appInfo',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
        'invokables' => array(
            'log' => 'InepZend\Log\Log',
        ),
        'aliases' => array(
            'InepZend\Doctrine\ORM\EntityManager' => 'Doctrine\ORM\EntityManager',
        ),
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'InepZend\Application\Controller\Index' => 'InepZend\Module\Application\Controller\IndexController',
            'InepZend\Module\Application\Controller\AutoloadConfig' => 'InepZend\Module\Application\Controller\AutoloadConfigController',
            'InepZend\Module\Application\Controller\Index' => 'InepZend\Module\Application\Controller\IndexController',
            'InepZend\Module\Application\Controller\Obiee' => 'InepZend\Module\Application\Controller\ObieeController',
            'InepZend\Module\Application\Controller\Readme' => 'InepZend\Module\Application\Controller\ReadmeController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array_merge(require __DIR__ . '/../template_map.php', require __DIR__ . '/../../../theme/template_map.php', array(
            'inep-zend/index/showfile' => __DIR__ . '/../view/application/index/clear-content.phtml',
            'inep-zend/controller/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'inep-zend/controller/index/ideb' => __DIR__ . '/../view/application/index/clear-content.phtml',
            'inep-zend/controller/index/maps' => __DIR__ . '/../view/application/index/clear-content.phtml',
            'inep-zend/index/inicial' => __DIR__ . '/../view/application/index/inicial.phtml',
            'inep-zend/index/geo-chart' => __DIR__ . '/../view/google/visualization/basics/geo-chart.phtml',
            'inep-zend/autoload-config/index' => __DIR__ . '/../view/application/autoload-config/index.phtml',
            'inep-zend/readme/readme' => __DIR__ . '/../view/application/readme/readme.phtml',
            'paginator/paginator' => __DIR__ . '/../../Paginator/View/_paginator.phtml',
            'paginator/flexigrid-footer' => __DIR__ . '/../../Paginator/View/_flexigrid-footer.phtml',
            'container' => __DIR__ . '/../../../theme/Administrative/view/theme/administrative/partial/_container.phtml',
            'layout/breadcrumbs' => __DIR__ . '/../../../theme/PortalBackgroundCinza2014/view/theme/portal-background-cinza-2014/partial/_breadcrumbs.phtml',
            'layout/layout' => __DIR__ . '/../../../theme/Administrative/view/theme/administrative/layout/layout.phtml',
            'layout/layout-administrative' => __DIR__ . '/../../../theme/Administrative/view/theme/administrative/layout/layout.phtml',
            'layout/layout-clean' => __DIR__ . '/../../../theme/Administrative/view/theme/administrative/layout/layout-clean.phtml',
            'layout/layout-administrative-responsible' => __DIR__ . '/../../../theme/AdministrativeResponsible/view/theme/administrative-responsible/layout/layout.phtml',
            'layout/layout-administrative-responsible/navigation' => __DIR__ . '/../../../theme/AdministrativeResponsible/view/theme/administrative-responsible/partial/_navigation.phtml',            
            'layout/layout-portal-background-cinza2014' => __DIR__ . '/../../../theme/PortalBackgroundCinza2014/view/theme/portal-background-cinza-2014/layout/layout.phtml',
            'layout/layout-portal-background-vermelho2013' => __DIR__ . '/../../../theme/PortalBackgroundVermelho2013/view/theme/portal-background-vermelho-2013/layout/layout.phtml',
            'layout/layout-consulta-publica' => __DIR__ . '/../../../theme/ConsultaPublica/view/theme/consulta-publica/layout/layout.phtml',
            'layout/layout_zf' => __DIR__ . '/../../../theme/ZendSkeleton/view/theme/zend-skeleton/layout/layout.phtml',
            'layout/partial/_container' => __DIR__ . '/../../../theme/Administrative/view/theme/administrative/partial/_container.phtml',
            'layout/portal/consulta-publica' => __DIR__ . '/../../../theme/ConsultaPublica/view/theme/consulta-publica/layout/layout.phtml',
            'layout/portal/layout-portal-cinza-2014' => __DIR__ . '/../../../theme/PortalBackgroundCinza2014/view/theme/portal-background-cinza-2014/layout/layout.phtml',
            'layout/portal/layout-portal-vermelho-2013' => __DIR__ . '/../../../theme/PortalBackgroundVermelho2013/view/theme/portal-background-vermelho-2013/layout/layout.phtml',
        )),
        'strategies' => array(
            'ViewJsonStrategy',
            'ViewPhpRendererStrategy',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formRow' => 'InepZend\FormGenerator\View\Helper\FormRow',
            'form' => 'InepZend\FormGenerator\View\Helper\Form',
            'authentication' => 'InepZend\Authentication\View\Helper\Authentication',
            'message' => 'InepZend\Message\View\Helper\MessageHelper',
            'tag' => 'InepZend\Tag\View\Helper\TagHelper',
            'applicationInfo' => 'InepZend\View\Helper\ApplicationInfoHelper',
            'barraBrasil' => 'InepZend\View\Helper\BarraBrasilHelper',
            'button' => 'InepZend\View\Helper\ButtonHelper',
            'globalJs' => 'InepZend\View\Helper\GlobalJsHelper',
            'permission' => 'InepZend\Permission\View\Helper\PermissionHelper',
            'flexigrid' => 'InepZend\Grid\Flexigrid\View\Helper\FlexigridHelper',
            'renderTemplateGoogle' => 'InepZend\View\Helper\RenderTemplateGoogleHelper',
            'fontSize' => 'InepZend\View\Helper\FontSizeHelper',
            'socialNetwork' => 'InepZend\View\Helper\SocialNetworkHelper',
            'html' => 'InepZend\View\Helper\HtmlHelper',
            'htmlHead' => 'InepZend\Theme\Administrative\View\Helper\HtmlHeadHelper',
            'htmlHeadPortalBackgroundVermelho2013' => 'InepZend\Theme\PortalBackgroundVermelho2013\View\Helper\HtmlHeadHelper',
            'htmlHeadPortalBackgroundCinza2014' => 'InepZend\Theme\PortalBackgroundCinza2014\View\Helper\HtmlHeadHelper',
            'htmlHeadConsultaPublica' => 'InepZend\Theme\ConsultaPublica\View\Helper\HtmlHeadHelper',
            'htmlHeadAdministrativeResponsible' => 'InepZend\Theme\AdministrativeResponsible\View\Helper\HtmlHeadHelper',
            'htmlBody' => 'InepZend\Theme\Administrative\View\Helper\HtmlBodyHelper',
            'htmlBodyPortalBackgroundVermelho2013' => 'InepZend\Theme\PortalBackgroundVermelho2013\View\Helper\HtmlBodyHelper',
            'htmlBodyPortalBackgroundCinza2014' => 'InepZend\Theme\PortalBackgroundCinza2014\View\Helper\HtmlBodyHelper',
            'htmlBodyConsultaPublica' => 'InepZend\Theme\ConsultaPublica\View\Helper\HtmlBodyHelper',
            'htmlBodyAdministrativeResponsible' => 'InepZend\Theme\AdministrativeResponsible\View\Helper\HtmlBodyHelper',
            'barcode' => 'InepZend\View\Helper\BarcodeHelper',
            'renderException' => 'InepZend\View\Helper\ExceptionHelper',
            'eventCalendar' => 'InepZend\View\Helper\EventCalendarHelper',
            'tab' => 'InepZend\View\Helper\TabHelper',
            'progressBar' => 'InepZend\View\Helper\ProgressBarHelper',
            'themeColor' => 'InepZend\View\Helper\ThemeColorHelper',
            'tree' => 'InepZend\View\Helper\TreeHelper',
            'userSystem' => 'InepZend\View\Helper\UserSystemHelper',
            'billet' => 'InepZend\BankPayment\Helper\BilletHelper',
            'gru' => 'InepZend\BankPayment\Helper\GruHelper',
            'angular' => 'InepZend\View\Helper\AngularHelper',
        ),
    ),
    'doctrine_factories' => array(
        'cache' => 'InepZend\Doctrine\Service\CacheFactory',
    ),
);
