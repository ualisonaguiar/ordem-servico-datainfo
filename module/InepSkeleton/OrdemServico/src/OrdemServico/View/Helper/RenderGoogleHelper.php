<?php

namespace OrdemServico\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\RenderTemplateGoogle;
use InepZend\View\RenderTemplate;

class RenderGoogleHelper extends AbstractHelper
{
    use RenderTemplateGoogle,
        RenderTemplate;

    public function montarGraficoLinha($arrRegistro)
    {
        $arrData = [];
        foreach ($arrRegistro as $arrRegistroQma) {
            $arrData[] = [
                $arrRegistroQma['no_executor'],
                $arrRegistroQma['periodo'],
                $arrRegistroQma['soma'],
            ];
        }
        $strContent = '<div style="border: 1px solid #CCC; overflow: hidden; width: auto; height: auto">';
        $strContent .= $this->renderLineChart(array(
            'strTitleHorizontal' => 'Período',
            'strTitleVertical' => 'MAT',
            'arrData' => $arrData,
            'arrOption' => array(
                array('series', '{0: {pointSize: 5}}'),
                array('height', '500'),
                array('width', '1000'),
                array('is3D', 'true'),
            )
        ));
        return $strContent . '</div>';
    }
}
