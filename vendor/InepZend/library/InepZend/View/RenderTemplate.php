<?php

namespace InepZend\View;

use InepZend\View\ViewTrait;
use InepZend\View\Renderer\Renderer;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplateMapResolver;

trait RenderTemplate
{

    use ViewTrait;

    protected function renderTemplate($strTemplate = null, $arrVariable = array())
    {
        return $this->render($strTemplate, null, $arrVariable);
    }

    protected function renderPathTemplate($strPathTemplate = null, $arrVariable = array())
    {
        return $this->render(null, $strPathTemplate, $arrVariable);
    }

    protected function render($strTemplate = null, $strPathTemplate = null, $arrVariable = array())
    {
        if (empty($strTemplate)) {
            if (empty($strPathTemplate))
                return false;
            $strTemplate = 'inep-zend/view/render-template';
        }
        $view = $this->getViewInstance((array) $arrVariable, $strTemplate, false, array(array('has_parent', true)));
        if (!empty($strPathTemplate)) {
            $renderer = new PhpRenderer();
            $resolver = new AggregateResolver();
            $renderer->setResolver($resolver);
            $resolver->attach(new TemplateMapResolver(array($strTemplate => $strPathTemplate)));
            Renderer::setFilterContentIntoRenderer($renderer);
            return $renderer->render($view);
        }
        if (!method_exists($this, 'getService'))
            return $view;
        $viewService = $this->getService('view');
        return (is_object($viewService)) ? $viewService->render($view) : false;
    }

}
