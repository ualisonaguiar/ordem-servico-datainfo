<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;

class GlobalJsHelper extends AbstractHelper
{

    public function __invoke(array $arrVarGlobalJs = array())
    {
        if (count($arrVarGlobalJs) == 0)
            return;
        $strResult = '<script type="text/javascript">';
        foreach ($arrVarGlobalJs as $mixKeyVarGlobalJs => $mixValueVarGlobalJs) {
            if (is_array($mixValueVarGlobalJs))
                foreach ($mixValueVarGlobalJs as $mixKeyVarGlobalJsIntern => $mixValueVarGlobalJsIntern)
                    $strResult .= 'var ' . $mixKeyVarGlobalJsIntern . ' = "' . $mixValueVarGlobalJsIntern . '";' . "\n";
            else
                $strResult .= 'var ' . $mixKeyVarGlobalJs . ' = "' . $mixValueVarGlobalJs . '";' . "\n";
        }
        $strResult .= '</script>';
        return $strResult;
    }

}
