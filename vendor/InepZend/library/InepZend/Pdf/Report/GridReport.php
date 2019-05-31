<?php

namespace InepZend\Pdf\Report;

use InepZend\Pdf\Vendor\fpdf\FpdfReport;

class GridReport extends FpdfReport
{

    protected $booBorderTable = true;

    public function __construct($strDirectionPaper = null, $strHeaderTitle = null, $booHeaderImage = null, $strFooterComplement = null, $intFontSizeTitle = null, $intFontSizeRegister = null, $booBorderTable = null)
    {
        if (is_bool($booBorderTable))
            $this->booBorderTable = $booBorderTable;
        return parent::__construct($strDirectionPaper, $strHeaderTitle, $booHeaderImage, $strFooterComplement, $intFontSizeTitle, $intFontSizeRegister);
    }

    public function addTitle($strTitle = '', $arrColumnsInfo = array(), $arrTextComplement = array(), $strFilter = null, $booNewPageFromTitle = true)
    {
        $intY = parent::addTitle($strTitle, $arrColumnsInfo, $arrTextComplement, $strFilter, $booNewPageFromTitle);
        $booBorderTable = $this->booBorderTable;
        $intBorder = ($booBorderTable === true) ? 1 : 0;
        if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
            $intY = $this->GetY();
            $this->SetFillColor(220, 220, 220);
            $this->SetFont('Arial', '', $this->intFontSizeTitle);
            $intConstWidthPadrao = ($this->strDirectionPaper == 'P') ? $this->intWidthRetrato : $this->intWidthPaisagem;
            $intCount = 0;
            foreach ($arrColumnsInfo as $arrColumnsInfoIndividual) {
                $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual['width'] : null;
                if (empty($intWidthIndividual))
                    $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual[0] : null;
                if (empty($intWidthIndividual))
                    $intWidthIndividual = round($intConstWidthPadrao / count($arrColumnsInfo));
                $strTitleIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual['title'] : null;
                if (empty($strTitleIndividual))
                    $strTitleIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual[1] : null;
                if (empty($strTitleIndividual))
                    $strTitleIndividual = (is_string($arrColumnsInfoIndividual)) ? $arrColumnsInfoIndividual : null;
                if (empty($strTitleIndividual))
                    $strTitleIndividual = 'Coluna ' . $intCount;
                $intWrap = 0;
                if ($intCount == (count($arrColumnsInfo) - 1)) {
                    $intWrap = 1;
                    $intWidthIndividual = 0;
                }
                $this->Cell($intWidthIndividual, 5, $strTitleIndividual, $intBorder, $intWrap, 'L', 1);
                ++$intCount;
            }
            $this->SetY($intY);
            $this->MultiCell(0, 5, '', 1, 'J', 0);
        }
    }

    public function addRegister($arrColumnsText)
    {
        if ((is_array($arrColumnsText)) && (count($arrColumnsText) > 0)) {
            $arrColumnsInfo = $this->arrColumnsInfo;
            $booBorderTable = $this->booBorderTable;
            $intBorder = ($booBorderTable === true) ? 1 : 0;
            $this->SetFont('Arial', '', $this->intFontSizeRegister);
            $this->SetFillColor(245, 245, 245);
            $intY = $this->GetY();
            $intYOriginal = $intY;
            $intWidthTotal = 10;
            $intHeightMax = 5;
            $arrWidth = array();
            $intConstWidthPadrao = ($this->strDirectionPaper == 'P') ? $this->intWidthRetrato : $this->intWidthPaisagem;
            $intCount = 0;
            foreach ($arrColumnsText as $intKey => $strColumnText) {
                if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
                    $arrColumnsInfoIndividual = $arrColumnsInfo[$intKey];
                    $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual['width'] : null;
                    if (empty($intWidthIndividual))
                        $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual[0] : null;
                    if (empty($intWidthIndividual))
                        $intWidthIndividual = round($intConstWidthPadrao / count($arrColumnsInfo));
                }
                else
                    $intWidthIndividual = round($intConstWidthPadrao / count($arrColumnsText));
                $intWrap = 0;
                if ($intCount == (count($arrColumnsText) - 1)) {
                    $intWrap = 1;
                    $intWidthIndividual = 0;
                }
                $strTypeContent = 'text';
                $strAlign = 'L';
                $strPathFileImg = null;
                $intWidthImg = null;
                $intHeightImg = null;
                $strExtensionImg = null;
                $this->getInfoFromColumnText($strColumnText, $strTypeContent, $strAlign, $strPathFileImg, $intWidthImg, $intHeightImg, $strExtensionImg);
                $intWidthTotal += $intWidthIndividual;
                if ($strTypeContent == 'img') {
                    $intYTitleAtual = $this->GetY();
                    $intXTitleAtual = $this->GetX();
                    $this->MultiCell($intWidthIndividual, $intHeightImg, '', 0, 'L', 0);
                    $this->Image($strPathFileImg, $intXTitleAtual, $intYTitleAtual, $intWidthImg, $intHeightImg, $strExtensionImg);
                } else
                    $this->MultiCell($intWidthIndividual, 5, $strColumnText, 0, $strAlign, 0);
                if (($this->GetY() - $intY) > $intHeightMax)
                    $intHeightMax = $this->GetY() - $intY;
                $this->SetY($intY);
                $this->SetX($intWidthTotal);
                $arrWidth[$intKey] = $intWidthIndividual;
                ++$intCount;
            }
            if ($intBorder == 0) {
                $this->SetY($intY);
                $this->MultiCell(0, $intHeightMax, '', 1, 'J', 0);
            } else {
                $intWidthTotal = 10;
                $this->SetX($intWidthTotal);
                foreach ($arrWidth as $intKey => $intWidthIndividual) {
                    $intWidthTotal += $intWidthIndividual;
                    $this->MultiCell($intWidthIndividual, $intHeightMax, '', $intBorder, 'J', 0);
                    $this->SetY($intY);
                    $this->SetX($intWidthTotal);
                }
                $this->SetY($intYOriginal + $intHeightMax);
            }
            $intConstHeightPadrao = ($this->strDirectionPaper == 'P') ? $this->intHeightRetrato : $this->intHeightPaisagem;
            if ($this->GetY() >= $intConstHeightPadrao)
                $this->addTitle($this->strTitle, $this->arrColumnsInfo);
        }
    }
    
    /**
     * Metodo responsavel em paremetrizar a altura e largura da quebra do layout
     * do PDF.
     *
     * @param integer $intWidthRetrato
     * @param integer $intHeightRetrato
     * @param integer $intWidthPaisagem
     * @param integer $intHeightPaisagem
     */
    public function setWidthHeightLayoutPdf($intWidthRetrato = null, $intHeightRetrato = null, $intWidthPaisagem = null, $intHeightPaisagem = null)
    {
        if ($intWidthRetrato != null)
            $this->intWidthRetrato = $intWidthRetrato;
        if ($intHeightRetrato != null)
            $this->intHeightRetrato = $intHeightRetrato;
        if ($intWidthPaisagem != null)
            $this->intWidthPaisagem = $intWidthPaisagem;
        if ($intHeightPaisagem != null)
            $this->intHeightPaisagem = $intHeightPaisagem;
    }

}
