<?php

namespace InepZend\Grid\Flexigrid;

use InepZend\Paginator\Paginator;

class Flexigrid
{

    private $strXml;

    public function __construct($paginator = null)
    {
        $this->createXml($paginator);
    }

    public function createXml($paginator = null)
    {
        $arrRegisterToGrid = array();
        $intCurrentPage = 0;
        $intTotalItem = 0;
        if ($paginator instanceof Paginator) {
            $zendPaginator = $paginator->getZendPaginator();
            $arrRegisterToGrid = $paginator->getRegisterToGrid();
            $intCurrentPage = $zendPaginator->getCurrentPageNumber();
            $intTotalItem = $zendPaginator->getTotalItemCount();
        }
        $strXml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $strXml .= "<rows><page>" . $intCurrentPage . "</page><total>" . $intTotalItem . "</total>";
        foreach ($arrRegisterToGrid AS $intRow => $arrInfo) {
            $strId = (is_array($arrInfo['pk'])) ? implode('-', $arrInfo['pk']) : $intRow;
            $strXml .= "<row id='" . $strId . "'>";
            foreach ($arrInfo['col'] as $mixValue)
                $strXml .= "<cell><![CDATA[" . $mixValue . "]]></cell>";
            $strXml .= "<cell><![CDATA[<div name='flexigridColAccordion' class='flexigridColAccordion' onclick='clickColAction(this, true);'></div><div name='flexigridColButtonAction' class='flexigridColButtonAction' onclick='clickColAction(this);'></div>]]></cell>";
            $strXml .= "</row>";
        }
        $strXml .= "</rows>";
        $this->strXml = $strXml;
        return $this->strXml;
    }

    public function getXml()
    {
        return $this->strXml;
    }

}
