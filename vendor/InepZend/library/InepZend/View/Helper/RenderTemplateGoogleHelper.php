<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\RenderTemplate;
use InepZend\View\RenderTemplateGoogle;

class RenderTemplateGoogleHelper extends AbstractHelper
{

    use RenderTemplate,
        RenderTemplateGoogle;
    
    public function renderExampleChart()
    {
        $strContent = '';
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Bolivia', '2004/05', 165),
            array('Bolivia', '2005/06', 135),
            array('Bolivia', '2006/07', 357),
            array('Ecuador', '2004/05', 938),
            array('Ecuador', '2005/06', 1120),
            array('Ecuador', '2006/07', 1167),
            array('Madagascar', '2004/05', 522),
            array('Madagascar', '2005/06', 599),
            array('Madagascar', '2006/07', 587),
        );
        $strContent .= '<hr />renderAreaChart:' . $this->renderAreaChart(array('strTitleHorizontal' => 'Periodo', 'strTitleVertical' => 'Quantidade', 'arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Bolivia', 165, '2004'),
            array('Bolivia', 135, '2005'),
            array('Bolivia', 357, '2006'),
            array('Ecuador', 938, '2004'),
            array('Ecuador', 1120, '2005'),
            array('Ecuador', 1167, '2006'),
            array('Madagascar', 522, '2004'),
            array('Madagascar', 599, '2005'),
            array('Madagascar', 587, '2006'),
        );
        $strContent .= '<hr />renderBarChart:' . $this->renderBarChart(array('strTitleHorizontal' => 'Quantidade', 'strTitleVertical' => 'Ano', 'arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Germany', 700),
            array('USA', 300),
            array('Brazil', 400),
            array('Canada', 500),
            array('France', 600),
            array('RU', 800),
        );
        $strContent .= '<hr />renderChartWrapper:' . $this->renderChartWrapper(array('arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Austria', '2003', 1336060),
            array('Austria', '2004', 1538156),
            array('Austria', '2005', 1576579),
            array('Belgium', '2003', 3817614),
            array('Belgium', '2004', 3968305),
            array('Belgium', '2005', 4063225),
            array('Czech Republic', '2003', 974066),
            array('Czech Republic', '2004', 928875),
            array('Czech Republic', '2005', 1063414),
        );
        $strContent .= '<hr />renderColumnChart:' . $this->renderColumnChart(array('strTitleHorizontal' => 'Ano', 'strTitleVertical' => 'Quantidade', 'arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Bolivia', '2004/05', 165),
            array('Bolivia', '2005/06', 135),
            array('Bolivia', '2006/07', 357),
            array('Ecuador', '2004/05', 938),
            array('Ecuador', '2005/06', 1120),
            array('Ecuador', '2006/07', 1167),
            array('Madagascar', '2004/05', 522),
            array('Madagascar', '2005/06', 599),
            array('Madagascar', '2006/07', 587),
        );
        $strContent .= '<hr />renderComboChart:' . $this->renderComboChart(array('strTitleHorizontal' => 'Periodo', 'strTitleVertical' => 'Quantidade', 'arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValue
            array('CPU', 80),
            array('Memoria', 70),
        );
        $strContent .= '<hr />renderGauge:' . $this->renderGauge(array('arrData' => $arrData));
        $strContent .= '<hr />renderGauge:' . $this->renderGauge(array('arrData' => $arrData, 'arrOption' => array(array('title', 'Titulo'))));
        
        $strContent .= '<hr />renderGeoChart:' . $this->renderGeoChart(array('clickRegion' => 'alert'));
        
        $arrData = array(
            # mixItem, mixValue
            array('Work', 11),
            array('Eat', 2),
            array('Commute', 2),
            array('Watch TV', 2),
            array('Sleep', 7),
        );
        $strContent .= '<hr />renderImagePieChart:' . $this->renderImagePieChart(array('arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array('Cats' , 'A', 1),
            array('Cats' , 'B', 2),
            array('Cats' , 'C', 4),
            array('Cats' , 'D', 8),
            array('Cats' , 'E', 7),
            array('Cats' , 'F', 7),
            array('Blanket 1' , 'A', 1),
            array('Blanket 1' , 'B', 0.5),
            array('Blanket 1' , 'C', 1),
            array('Blanket 1' , 'D', 0.5),
            array('Blanket 1' , 'E', 1),
            array('Blanket 1' , 'F', 0.5),
            array('Blanket 2' , 'A', 0.5),
            array('Blanket 2' , 'B', 1),
            array('Blanket 2' , 'C', 0.5),
            array('Blanket 2' , 'D', 1),
            array('Blanket 2' , 'E', 0.5),
            array('Blanket 2' , 'F', 1),
        );
        $strContent .= '<hr />renderLineChart:' . $this->renderLineChart(array('strTitleHorizontal' => 'Letra', 'strTitleVertical' => 'Quantidade', 'arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixParentItem
            array('Mike', null),
            array('Alice', 'Mike'),
            array('Bob', 'Mike'),
            array('Carol', 'Bob'),
            array('Julian', 'Bob'),
            array('Steve', 'Carol'),
        );
        $strContent .= '<hr />renderOrgChart:' . $this->renderOrgChart(array('arrData' => $arrData));
        
        $arrData = array(
            # mixItem, mixValue
            array('Work', 11),
            array('Eat', 2),
            array('Commute', 2),
            array('Watch TV', 2),
            array('Sleep', 7),
        );
        $strContent .= '<hr />renderPieChart:' . $this->renderPieChart(array('arrData' => $arrData));
        
        $arrData = array(
            # arrTitle
            array('Name', 'Height', 'Age'),
            # arrRegister
            array('Tong Ning mu', 174, 25),
            array('Huang Ang fa', 523, 31),
            array('Teng nu', 86, 20),
        );
        $strContent .= '<hr />renderTable:' . $this->renderTable(array('arrData' => $arrData));
        return $strContent;
    }

    public function renderExampleMap()
    {
        return $this->renderMap(array('strDivStyle' => 'width: 1355px; height: 500px;', 'strApiKey' => "AIzaSyDOThhVE9bFb6e77waTHqOSXHtgD7HrfJs", 'clickAddMarker' => 'true', 'arrOption' => array('arrMapOption' => array('zoom' => 12, 'center' => array(-15.779722, -47.929722)), 'arrMarker' => array('marker1' => array('position' => array(-15.779722, -47.929722), 'draggable' => 'true'), 'marker2' => array('position' => array(-15, -47), 'draggable' => 'true')))));
    }

    public function renderExampleIdebChart()
    {
        $strContent = '';
        $intWidth = 650;
        $intWidthChart = 500;
        $intFontSize = 12;
        $intAngle = 90;
        $strTitleVertical = 'Porcentagem de escolas (%)';
        $strSufix = '% das escolas estão nesta classe';
        $strStyleSpecial = 'color: #B64935;';

        $mixItem = 'Ideb';
        $strTitle = '';
        $strTitleVertical = 'Nota do Ideb';
        $strTitleHorizontal = 'Ano';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical
            array($mixItem, '2005', 3.8),
            array($mixItem, '2007', 2.9),
            array($mixItem, '2009', null),
            array($mixItem, '2011', 4.1),
            array($mixItem, '2013', 5.2),
        );
        $strContent .= '<h1>Gráfico em Linha</h1>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px;">';
        $strContent .= $this->renderLineChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '", baseline: 0, viewWindow: {min: 0, max: 6}, gridlines: {color: "white", count: 7}, format: "###"}'), array('hAxis', '{title: "' . $strTitleHorizontal . '", baseline: 2004, ticks: [2005,2007,2009,2011,2013], gridlines: {color: "white", count: 5}, format: "####"}'), array('title', $strTitle), array('series', '{0: {color: "blue", pointSize: 5}}'))));
        $strContent .= '</div>';

        $mixItem = 'Ideb';
        $strTitle = 'O universo de comparação é de 300 escolas:\n- 30% das escolas estão com desempenho acima da sua nota;\n- 70% das escolas estão com desempenho abaixo ou igual a sua nota.';
        $strTitleHorizontal = 'Nota do Ideb';
        $strStyleDefault = 'color: #315677;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 1,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '1,0 a 1,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '1,5 a 2,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '2,0 a 2,5', 9.7, $strStyleDefault, '9.7' . $strSufix),
            array($mixItem, '2,5 a 3,0', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 8,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,0 a 8,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,5 a 10', 2.0, $strStyleDefault, '2.0' . $strSufix),
        );
        $strContent .= '<br /><h1>Anos iniciais do ensino fundamental</h1>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px; float: left;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'IndicadorRendimento';
        $strTitle = '';
        $strTitleHorizontal = 'Indicador de Rendimento (P)';
        $strStyleDefault = 'color: #EAB83D;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,00 a 0,25', 6.9, $strStyleDefault, '6.9' . $strSufix),
            array($mixItem, '0,25 a 0,30', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '0,30 a 0,35', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '0,35 a 0,40', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '0,40 a 0,45', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '0,45 a 0,50', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '0,50 a 0,55', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '0,55 a 0,60', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '0,60 a 0,65', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '0,65 a 0,70', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '0,70 a 0,75', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,75 a 0,80', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,80 a 0,85', 2.0, $strStyleDefault, '2.0' . $strSufix),
            array($mixItem, '0,85 a 0,90', 2.0, $strStyleDefault, '2.0' . $strSufix),
            array($mixItem, '0,90 a 0,95', 1.0, $strStyleDefault, '1.0' . $strSufix),
            array($mixItem, '0,95 a 1,00', 1.0, $strStyleDefault, '1.0' . $strSufix),
        );
        $strContent .= '<div style="width: 5px; float: left;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'Matematica';
        $strTitle = '';
        $strTitleHorizontal = 'Nota Padronizada Matemática';
        $strStyleDefault = 'color: #22B573;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 3,0', 6.9, $strStyleDefault, '6.9' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 8,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,0 a 8,5', 1.4, $strStyleDefault, '1.4' . $strSufix),
            array($mixItem, '8,5 a 9,0', 1.0, $strStyleDefault, '1.0' . $strSufix),
            array($mixItem, '9,0 a 9,5', 0.9, $strStyleDefault, '0.9' . $strSufix),
            array($mixItem, '9,5 a 10', 0.2, $strStyleDefault, '0.2' . $strSufix),
        );
        $strContent .= '<div style="height: 5px;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px; float: left;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'LinguaPortuguesa';
        $strTitle = '';
        $strTitleHorizontal = 'Nota Padronizada Língua Portuguesa';
        $strStyleDefault = 'color: #629E93;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 2,5', 6.9, $strStyleDefault, '6.9' . $strSufix),
            array($mixItem, '2,5 a 3,0', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 8,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,0 a 8,5', 1.4, $strStyleDefault, '1.4' . $strSufix),
            array($mixItem, '8,5 a 9,0', 1.0, $strStyleDefault, '1.0' . $strSufix),
            array($mixItem, '9,0 a 10', 0.2, $strStyleDefault, '0.2' . $strSufix),
        );
        $strContent .= '<div style="width: 5px; float: left;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'Ideb';
        $strTitle = 'O universo de comparação é de 300 escolas:\n- 30% das escolas estão com desempenho acima da sua nota;\n- 70% das escolas estão com desempenho abaixo ou igual a sua nota.';
        $strTitleHorizontal = 'Nota do Ideb';
        $strStyleDefault = 'color: #315677;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 0,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,5 a 1,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '1,0 a 1,5', 2.9, $strStyleDefault, '2.9' . $strSufix),
            array($mixItem, '1,5 a 2,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '2,0 a 2,5', 9.7, $strStyleDefault, '9.7' . $strSufix),
            array($mixItem, '2,5 a 3,0', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 8,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,0 a 10', 2.0, $strStyleDefault, '2.0' . $strSufix),
        );
        $strContent .= '<br /><h1>Anos finais do ensino fundamental</h1>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px; float: left;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'IndicadorRendimento';
        $strTitle = '';
        $strTitleHorizontal = 'Indicador de Rendimento (P)';
        $strStyleDefault = 'color: #EAB83D;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,00 a 0,05', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,05 a 0,10', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,10 a 0,15', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '0,15 a 0,20', 9.7, $strStyleDefault, '9.7' . $strSufix),
            array($mixItem, '0,20 a 0,25', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '0,25 a 0,30', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '0,30 a 0,35', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '0,35 a 0,40', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '0,40 a 0,45', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '0,45 a 0,50', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '0,50 a 0,55', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '0,55 a 0,60', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '0,60 a 0,65', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '0,65 a 0,70', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '0,70 a 0,75', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,75 a 0,80', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '0,80 a 0,85', 2.0, $strStyleDefault, '2.0' . $strSufix),
            array($mixItem, '0,85 a 0,90', 2.0, $strStyleDefault, '2.0' . $strSufix),
            array($mixItem, '0,90 a 0,95', 1.0, $strStyleDefault, '1.0' . $strSufix),
            array($mixItem, '0,95 a 1,00', 1.0, $strStyleDefault, '1.0' . $strSufix),
        );
        $strContent .= '<div style="width: 5px; float: left;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'Matematica';
        $strTitle = '';
        $strTitleHorizontal = 'Nota Padronizada Matemática';
        $strStyleDefault = 'color: #22B573;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 1,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '1,5 a 2,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '2,0 a 2,5', 9.7, $strStyleDefault, '9.7' . $strSufix),
            array($mixItem, '2,5 a 3,0', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 8,0', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,0 a 8,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '8,5 a 10', 2.0, $strStyleDefault, '2.0' . $strSufix),
        );
        $strContent .= '<div style="height: 5px;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px; float: left;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';

        $mixItem = 'LinguaPortuguesa';
        $strTitle = '';
        $strTitleHorizontal = 'Nota Padronizada Língua Portuguesa';
        $strStyleDefault = 'color: #629E93;';
        $arrData = array(
            # mixItem, mixValueHorizontal, mixValueVertical, strStyle (opcional), strHint (opcional)
            array($mixItem, '0,0 a 1,5', 1.9, $strStyleDefault, '1.9' . $strSufix),
            array($mixItem, '1,5 a 2,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '2,0 a 2,5', 9.7, $strStyleDefault, '9.7' . $strSufix),
            array($mixItem, '2,5 a 3,0', 10.1, $strStyleDefault, '10.1' . $strSufix),
            array($mixItem, '3,0 a 3,5', 11.8, $strStyleDefault, '11.8' . $strSufix),
            array($mixItem, '3,5 a 4,0', 14.1, $strStyleDefault, '14.1' . $strSufix),
            array($mixItem, '4,0 a 4,5', 19.8, $strStyleDefault, '19.8' . $strSufix),
            array($mixItem, '4,5 a 5,0', 15.9, $strStyleSpecial, '15.9' . $strSufix),
            array($mixItem, '5,0 a 5,5', 9.1, $strStyleDefault, '9.1' . $strSufix),
            array($mixItem, '5,5 a 6,0', 5.9, $strStyleDefault, '5.9' . $strSufix),
            array($mixItem, '6,0 a 6,5', 4.1, $strStyleDefault, '4.1' . $strSufix),
            array($mixItem, '6,5 a 7,0', 3.3, $strStyleDefault, '3.3' . $strSufix),
            array($mixItem, '7,0 a 7,5', 2.1, $strStyleDefault, '2.1' . $strSufix),
            array($mixItem, '7,5 a 10', 1.9, $strStyleDefault, '1.9' . $strSufix),
        );
        $strContent .= '<div style="width: 5px; float: left;">&nbsp;</div>';
        $strContent .= '<div style="border: 1px solid #CCC; overflow: hidden; width: ' . $intWidth . 'px;">';
        $strContent .= $this->renderColumnChart(array('strTitleHorizontal' => $strTitleHorizontal, 'strTitleVertical' => $strTitleVertical, 'arrData' => $arrData, 'arrOption' => array(array('chartArea', '{width: ' . $intWidthChart . '}'), array('legend', '{position: "none"}'), array('width', $intWidth), array('vAxis', '{title: "' . $strTitleVertical . '"}'), array('hAxis', '{textStyle: {fontSize: ' . $intFontSize . '}, slantedText: true, slantedTextAngle: ' . $intAngle . ', title: "' . $strTitleHorizontal . '"}'), array('title', $strTitle))));
        $strContent .= '<div style="width: ' . $intWidth . 'px; text-align: center; padding-top: 20px; font-size: 12px; font-family: Arial; ' . $strStyleSpecial . '">Sua escola est&aacute; no intervalo em destaque</div>';
        $strContent .= '</div>';
        return $strContent;
    }

}
