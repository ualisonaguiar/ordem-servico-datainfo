<?php
namespace InepZend\FormGenerator\View\Helper;

use Zend\Form\View\Helper\Form as ZendForm;
use Zend\Form\FormInterface;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class Form extends ZendForm
{

    private $arrTemplateViewValidate = array(
        'default' => array(
            'js' => '/vendor/InepZend/js/form-validate.js',
            'css' => '/vendor/InepZend/css/form-validate.css'
        )
    );

    public function render(FormInterface $form)
    {
        if (! is_object($form))
            return false;
        $view = $this->getView();
        if ((method_exists($form, 'getViewValidate')) && ($form->getViewValidate())) {
            $strTemplate = $form->getTemplateViewValidate();
            if (array_key_exists($strTemplate, $this->arrTemplateViewValidate)) {
                $arrTemplateViewValidate = $this->arrTemplateViewValidate[$strTemplate];
                $arrIncludeFile = array();
                if (array_key_exists('css', $arrTemplateViewValidate))
                    if ((AbstractHtmlHeadHelper::hasGulp() === true) && ($arrTemplateViewValidate['css'] == '/vendor/InepZend/css/form-validate.css'))
                        unset($arrTemplateViewValidate['css']);
                    else
                        $arrIncludeFile['css'] = array(
                            $arrTemplateViewValidate['css']
                        );
                if (array_key_exists('js', $arrTemplateViewValidate)) {
                    if ((AbstractHtmlHeadHelper::hasGulp() === true) && ($arrTemplateViewValidate['js'] == '/vendor/InepZend/js/form-validate.js'))
                        unset($arrTemplateViewValidate['js']);
                    else
                        $arrIncludeFile['js'] = array(
                            $arrTemplateViewValidate['js']
                        );
                }
                AbstractHtmlHeadHelper::prependIncludeFile($arrIncludeFile, $view->headScript(), $view->headLink(), $view->basePath());
            }
        }
        return $this->buildFilterMessageRequired($form) . parent::render($form);
    }

    private function buildFilterMessageRequired(FormInterface $form)
    {
        $strResult = '';
        if (is_object($inputFilter = $form->getInputFilter())) {
            $arrResult = array();
            $arrFilter = $inputFilter->getFilter();
            foreach ($arrFilter as $strAttribute => $arrInfo) {
                if (! array_key_exists('validators', $arrInfo))
                    continue;
                foreach ($arrInfo['validators'] as $arrValidator) {
                    if (((@$arrValidator['name']) != 'NotEmpty') || (@empty($arrValidator['options']['messages']['isEmpty'])))
                        continue;
                    $arrResult[$strAttribute] = $arrValidator['options']['messages']['isEmpty'];
                    break;
                }
            }
            $strResult .= '<script type="text/javascript">var jsonGlobalFilterMessageRequired = ' . json_encode($arrResult) . ';</script>';
        }
        return $strResult;
    }
}
