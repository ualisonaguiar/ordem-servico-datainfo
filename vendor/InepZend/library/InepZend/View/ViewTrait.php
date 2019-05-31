<?php

namespace InepZend\View;

trait ViewTrait
{

    public function getViewInstance($arrVariable = array(), $strTemplate = null, $booTerminal = true, $arrOption = array(), $booJsonModel = false)
    {
        if (is_bool($booJsonModel))
            $booJsonModel = false;
        $strClass = '\InepZend\View\Model\\' . ((!$booJsonModel) ? 'View' : 'Json');
        $view = new $strClass((array) $arrVariable);
        if (!empty($strTemplate))
            $view->setTemplate($strTemplate);
        if (is_bool($booTerminal))
            $view->setTerminal($booTerminal);
        foreach ($arrOption as $arrItemOption)
            if ((is_array($arrItemOption)) && (count($arrItemOption) == 2))
                $view->setOption($arrItemOption[0], $arrItemOption[1]);
        return $view;
    }
    
    protected function getViewClearContent($strContent = null)
    {
        return $this->getViewInstance(((!empty($strContent)) ? array('content' => $strContent) : array()), 'application/index/clear-content');
    }

}
