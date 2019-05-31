<?php

namespace InepZend\View\Helper;

trait MapHtmlHead
{

    private $arrMapComponentVersionFile = array(
        self::COMPONENT_JQUERY_VALIDATE => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.validate.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_UI_TIMEPICKER_ADDON => array(
            'default' => array(
                'prependFile' => array(
                    'js/jquery.ui.timepicker.addon.min.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_UI => array(
            'default' => array(
                'prependStylesheet' => array(
//                    'css/smoothness/jquery.ui.custom.css',
                    'css/smoothness/jquery-ui.min.css',
                ),
//                'prependFile' => array(
//                    'js/jquery.ui.custom.js',
//                    'js/jquery-ui.min.js',
//                ),
            ),
        ),
        self::COMPONENT_JQUERY_MIGRATE => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.migrate.min.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_MASKMONEY => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.maskmoney.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_MASKEDINPUT => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.maskedinput.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_FORM => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.form.min.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_BASE64 => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.base64.min.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_ALPHANUMERIC => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.alphanumeric.pack.js',
                ),
            ),
        ),
        self::COMPONENT_BOOTSTRAP => array(
            '2.3.2' => array(
                'prependStylesheet' => array(
                    'css/bootstrap-responsive.min.css',
                    'css/bootstrap.min.css',
                ),
            ),
            '3.0.3' => array(
                'prependStylesheet' => array(
                    'css/inep-zend.css',
                    'css/bootstrap-theme.min.css',
                    'css/bootstrap.min.css',
                    '../bootstrap-2.3.2/css/bootstrap-responsive.min.css',
                    '../bootstrap-2.3.2/css/bootstrap.min.css',
                ),
            ),
            'default' => array(
                'prependFile' => array(
                    'js/bootstrap.min.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY => array(
            'default' => array(
                'prependFile' => array(
                    'jquery.min.js',
                ),
            ),
        ),
        self::COMPONENT_RESPONSIVE => array(
            'default' => array(
                'prependFile' => array(
                    array('respond.min.js', array('conditional' => 'lt IE 9',)),
                ),
            ),
        ),
        self::COMPONENT_HTML5 => array(
            'default' => array(
                'prependFile' => array(
                    array('html5shiv.min.js', array('conditional' => 'lt IE 9',)),
                ),
            ),
        ),
        self::COMPONENT_CUFON => array(
            'default' => array(
                'prependFile' => array(
                    array('js/inep-zend.js', array('conditional' => 'gte IE 7')),
                    array('font/Arial.js', array('conditional' => 'gte IE 7')),
                    array('js/cufon-yui.js', array('conditional' => 'gte IE 7')),
                ),
            ),
        ),
        self::COMPONENT_PLACEHOLDERS => array(
            '3.0.2' => array(
                'prependFile' => array(
                    'placeholders.jquery.min.js',
                ),
            ),
        ),
        self::COMPONENT_FONT_AWESONE => array(
            '4.4.0' => array(
                'appendStylesheet' => array(
                    'css/font-awesome.min.css',
                ),
            ),
        ),
        self::COMPONENT_EXTENDJS => array(
            '0.2.3' => array(
                'prependFile' => array(
                    'extend.js/src/extend.js',
                ),
            ),
        ),
        self::COMPONENT_JQUERY_GRITTER => array(
            '1.7.4' => array(
                'appendStylesheet' => array(
                    'css/jquery.gritter.min.css',
                ),
                'prependFile' => array(
                    'js/jquery.gritter.min.js',
                ),
            ),
        ),
        self::COMPONENT_ANGULAR => array(
            '1.4.8' => array(
                'prependFile' => array(
                    'angular.min.js',
                ),
            ),
        ),
        self::COMPONENT_ANGULAR_LOADING_BAR => array(
            '0.8.0' => array(
                'appendStylesheet' => array(
                    'src/loading-bar.css',
                ),
                'prependFile' => array(
                    'src/loading-bar.js',
                ),
            ),
        ),
    );

    protected function setMapComponentVersionFile($arrMapComponentVersionFile)
    {
        $this->arrMapComponentVersionFile = $arrMapComponentVersionFile;
        return $this;
    }

    protected function getMapComponentVersionFile()
    {
        return (array) $this->arrMapComponentVersionFile;
    }

}
