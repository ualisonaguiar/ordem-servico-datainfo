<?php

namespace InepZend\View;

use InepZend\Util\String;

trait RenderTemplateGoogle
{

    private static $arrDivIdCount = array();

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/areachart
     */
    public function renderAreaChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/barchart
     */
    public function renderBarChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see http://code.google.com/apis/ajax/playground/?type=visualization#chart_wrapper
     */
    public function renderChartWrapper($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/columnchart
     */
    public function renderColumnChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/combochart
     */
    public function renderComboChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/gauge
     */
    public function renderGauge($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/geochart
     */
    public function renderGeoChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see http://code.google.com/apis/ajax/playground/?type=visualization#image_pie_chart
     */
    public function renderImagePieChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/linechart
     */
    public function renderLineChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/orgchart
     */
    public function renderOrgChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/piechart
     */
    public function renderPieChart($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/chart/interactive/docs/gallery/table
     */
    public function renderTable($arrVariable = array())
    {
        return $this->renderGoogleVisualizationBasics($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    /**
     * @see https://developers.google.com/maps/documentation/javascript/3.exp/reference
     */
    public function renderMap($arrVariable = array())
    {
        return $this->renderGoogleMaps($this->getTypeFromMethod(__FUNCTION__), (array) $arrVariable);
    }

    private function renderGoogleVisualizationBasics($strType = null, $arrVariable = array())
    {
        return $this->renderGoogleApi('visualization/basics', $strType, $arrVariable);
    }

    private function renderGoogleMaps($strType = null, $arrVariable = array())
    {
        return $this->renderGoogleApi('maps', $strType, $arrVariable);
    }

    private function renderGoogleApi($strApiPath = null, $strType = null, $arrVariable = array())
    {
        if ((empty($strApiPath)) || (empty($strType)) || (!method_exists($this, 'getService')))
            return false;
        $strTemplatePath = __DIR__ . '/../../../module/Application/view/google/' . $strApiPath . '/' . $strType . '.phtml';
        if (!is_file($strTemplatePath))
            return false;
        $arrVariable = (array) $arrVariable;
        $this->getChartOption($arrVariable);
        return $this->render('inep-zend/google/' . $strApiPath . '/' . $strType, $strTemplatePath, array_merge(array('strDivId' => $this->getDivId($strType)), $arrVariable, array('strChartOption' => $this->getChartOption($arrVariable))));
    }

    private function getTypeFromMethod($strMethod = null)
    {
        return String::dasherize(str_replace('render', '', (string) $strMethod));
    }

    private function getDivId($strType = null)
    {
        return (empty($strType)) ? 'divRenderTemplateGoogle' : 'div' . String::camelize($strType) . '[' . self::getDivIdCount($strType) . ']';
    }

    private function getChartOption(&$arrVariable = array())
    {
        $arrOptionEdited = array();
        $strOption = '{';
        if ((is_array($arrVariable)) && (array_key_exists('arrOption', $arrVariable)) && (is_array($arrVariable['arrOption'])) && (!empty($arrVariable['arrOption']))) {
            foreach ($arrVariable['arrOption'] as $intKey => $arrInfo) {
                if ((!array_key_exists(0, $arrInfo)) || (!array_key_exists(1, $arrInfo)))
                    continue;
                if (!is_array($arrInfo[1])) {
                    if ($intKey != 0)
                        $strOption .= ',';
                    $strEscape = (in_array($arrInfo[1]{0}, array('{', '['))) ? '' : "'";
                    $strOption .= $arrInfo[0] . ': ' . $strEscape . @$arrInfo[1] . $strEscape;
                }
                $arrOptionEdited[$arrInfo[0]] = $arrInfo[1];
            }
        }
        $strOption .= '}';
        if (count($arrOptionEdited) > 0)
            $arrVariable['arrOptionEdited'] = $arrOptionEdited;
        return $strOption;
    }

    private static function getDivIdCount($strType = null)
    {
        if (empty($strType))
            return false;
        if (!array_key_exists($strType, self::$arrDivIdCount))
            self::$arrDivIdCount[$strType] = -1;
        ++self::$arrDivIdCount[$strType];
        return self::$arrDivIdCount[$strType];
    }

}
