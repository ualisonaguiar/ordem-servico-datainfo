<?php

namespace InepZend\Pdf\Report;

use InepZend\Pdf\Vendor\fpdf\FpdfReport;

class AlternativeReport extends FpdfReport
{

    protected $intYTitleStart = 0;
    protected $intYTitleEnd = 0;
    protected $intMaxLengthColumnsTitle = 0;
    protected static $strLastMethod = null;

    public function addTitle($strTitle = '', $arrColumnsInfo = array(), $arrTextComplement = array(), $strFilter = null, $booNewPageFromTitle = true)
    {
        $intY = parent::addTitle($strTitle, $arrColumnsInfo, $arrTextComplement, $strFilter, $booNewPageFromTitle);
        $this->intYTitleStart = $intY;
        $this->intYTitleEnd = $this->GetY();
        if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
            $intMaxLengthColumnsTitle = 0;
            foreach ($arrColumnsInfo as $strColumnsTitle) {
                if (strlen($strColumnsTitle) > $intMaxLengthColumnsTitle)
                    $intMaxLengthColumnsTitle = strlen($strColumnsTitle);
            }
            $this->intMaxLengthColumnsTitle = $intMaxLengthColumnsTitle;
        }
        $this->strLastMethod = 'addTitle';
    }

    public function addRegister($arrColumnsText)
    {
        if ((is_array($arrColumnsText)) && (count($arrColumnsText) > 0)) {
            $arrColumnsInfo = $this->arrColumnsInfo;
            $intConstHeightPadrao = ($this->strDirectionPaper == 'P') ? $this->intHeightRetrato : $this->intHeightPaisagem;
            if (($this->GetY() + (count($arrColumnsText) * 5)) > $intConstHeightPadrao) {
                if ($this->strLastMethod == 'addTitle') {
                    $this->SetXY(9, $this->intYTitleStart);
                    $this->SetFillColor(255, 255, 255);
                    $this->Cell(0, ($this->intYTitleEnd - $this->intYTitleStart), '', 0, 0, 'L', 1);
                    $this->addTitle($this->strTitle, $this->arrColumnsInfo);
                }
                else
                    $this->AddPage();
            }
            $this->SetFont('Arial', '', 8);
            $this->SetFillColor(245, 245, 245);
            $intY = $this->GetY();
            foreach ($arrColumnsText as $intKey => $strColumnText) {
                $intYTitle = $this->GetY();
                $intXTitle = $this->GetX();
                if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0))
                    $this->Cell(round($this->intMaxLengthColumnsTitle * 2.2), 5, '', 0, 0, 'R', 1);
                $strTypeContent = 'text';
                $strAlign = 'L';
                $strPathFileImg = null;
                $intWidthImg = null;
                $intHeightImg = null;
                $strExtensionImg = null;
                $this->getInfoFromColumnText($strColumnText, $strTypeContent, $strAlign, $strPathFileImg, $intWidthImg, $intHeightImg, $strExtensionImg);
                if ($strTypeContent == 'img') {
                    $intYTitleAtual = $this->GetY();
                    $intXTitleAtual = $this->GetX();
                    $this->MultiCell(0, $intHeightImg, '', 0, 'L', 0);
                    $this->Image($strPathFileImg, $intXTitleAtual, $intYTitleAtual, $intWidthImg, $intHeightImg, $strExtensionImg);
                } else
                    $this->MultiCell(0, 5, $strColumnText, 0, $strAlign, 0);
                $this->Cell(0, 1, '', 0, 1, 'L', 0);
                $intYTitleAtual = $this->GetY();
                $intXTitleAtual = $this->GetX();
                if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
                    $this->SetY($intYTitle);
                    $this->SetX($intXTitle);
                    $strColumnsTitle = @$arrColumnsInfo[$intKey];
                    $this->SetFillColor(220, 220, 220);
                    $this->SetFont('Arial', '', 10);
                    $this->Cell(round($this->intMaxLengthColumnsTitle * 2.2), ($intYTitleAtual - $intYTitle - 1), $strColumnsTitle, 0, 0, 'R', 1);
                    $this->SetFont('Arial', '', 8);
                    $this->SetFillColor(245, 245, 245);
                    $this->SetY($intYTitleAtual);
                    $this->SetX($intXTitleAtual);
                }
            }
            $intYAtual = $this->GetY();
            $this->SetY($intY);
            $this->MultiCell(0, ($intYAtual - $intY - 1), '', 1, 'J', 0);
            if ($this->GetY() >= $intConstHeightPadrao)
                $this->addTitle($this->strTitle, $this->arrColumnsInfo);
            else
                $this->Cell(0, 2, '', 0, 1, 'L', 0);
        }
        $this->strLastMethod = 'addRegister';
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
