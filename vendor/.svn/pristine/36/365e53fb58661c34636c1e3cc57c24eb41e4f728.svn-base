<?php

namespace InepZend\Pdf\Vendor\fpdf;

abstract class FpdfReport extends Fpdf
{

    const CONST_WIDTH_RETRATO = 200;
    const CONST_HEIGHT_RETRATO = 267;
    const CONST_WIDTH_PAISAGEM = 270;
    const CONST_HEIGHT_PAISAGEM = 190;

    protected $intWidthRetrato = self::CONST_WIDTH_RETRATO;
    protected $intHeightRetrato = self::CONST_HEIGHT_RETRATO;
    protected $intWidthPaisagem = self::CONST_WIDTH_PAISAGEM;
    protected $intHeightPaisagem = self::CONST_HEIGHT_PAISAGEM;
    protected $strDirectionPaper = 'P';
    protected $strHeaderTitle = 'Relatório';
    protected $booHeaderImage = true;
    protected $strFooterComplement = null;
    protected $intFontSizeTitle = 10;
    protected $intFontSizeRegister = 8;
    protected $strTitle = null;
    protected $arrColumnsInfo = array();

    public function __construct($strDirectionPaper = null, $strHeaderTitle = null, $booHeaderImage = null, $strFooterComplement = null, $intFontSizeTitle = null, $intFontSizeRegister = null)
    {
        if (!empty($strDirectionPaper))
            $this->strDirectionPaper = $strDirectionPaper;
        if (!empty($strHeaderTitle))
            $this->strHeaderTitle = $strHeaderTitle;
        if (is_bool($booHeaderImage))
            $this->booHeaderImage = $booHeaderImage;
        if (!empty($strFooterComplement))
            $this->strFooterComplement = $strFooterComplement;
        if (!empty($intFontSizeTitle))
            $this->intFontSizeTitle = $intFontSizeTitle;
        if (!empty($intFontSizeRegister))
            $this->intFontSizeRegister = $intFontSizeRegister;
        $this->FPDF($this->strDirectionPaper, 'mm', 'A4');
        $this->Open();
        $this->AliasNbPages();
        return;
    }

    public function Header()
    {
        if ($this->booHeaderImage === true) {
            $this->Image('http://public.inep.gov.br/MECdefault/files/images/bgs/headerInep.jpg', 10, 5, (($this->strDirectionPaper == 'P') ? $this->intWidthRetrato - 10 : $this->intWidthPaisagem + 7), 0, 'jpg');
            $this->SetY(16);
        }
        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(113, 187, 226);
        $this->Cell(0, 6, $this->strHeaderTitle, 0, 2, 'C', 1);
        $this->SetY($this->GetY() - 5);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $strFooter = 'Página ' . $this->PageNo() . '/{nb} | em ' . date('d/m/Y H:i:s');
        if (!empty($this->strFooterComplement))
            $strFooter .= ' - ' . $this->strFooterComplement;
        $this->SetFont('Arial', 'I', 8);
        $this->SetFillColor(235, 235, 235);
        $this->Cell(0, 5, $strFooter, 0, 0, 'C', 1);
    }

    public function addTitle($strTitle = '', $arrColumnsInfo = array(), $arrTextComplement = array(), $strFilter = null, $booNewPageFromTitle = true)
    {
        if ($booNewPageFromTitle === true) {
            $this->AddPage();
            $intY = $this->GetY() + 5;
        } else
            $intY = $this->GetY();
        $this->SetXY(9, $intY);
        $intY = $this->insertTextComplement($arrTextComplement, $intY);
        $this->insertFilter($strFilter);
        $this->insertTitle($strTitle);
        if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0))
            $this->arrColumnsInfo = $arrColumnsInfo;
        return $intY;
    }

    protected function insertTitle($strTitle = '')
    {
        if (!empty($strTitle)) {
            $this->SetFont('Arial', 'B', 10);
            $this->MultiCell(0, 5, $strTitle, 0, 'L', 0);
        } else
            $this->Cell(0, 1, '', 0, 1, 'L', 0);
        $this->strTitle = $strTitle;
    }

    protected function insertFilter($strFilter = null)
    {
        if (!empty($strFilter)) {
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(0, 4, 'Filtro(s)', 0, 1, 'L', 0);
            $this->SetFont('Arial', '', 9);
            $this->MultiCell(0, 4, $strFilter, 0, 'L', 0);
            $this->Cell(0, 2, '', 0, 1, 'L', 0);
        }
    }

    protected function insertTextComplement($arrTextComplement = array(), $intY = 0)
    {
        if ((is_array($arrTextComplement)) && (count($arrTextComplement) > 0)) {
            $this->SetY($this->GetY() + 2);
            $intY = $this->GetY();
            $this->SetFillColor(221, 239, 249);
            foreach ($arrTextComplement as $mixTextComplement) {
                $strTextComplement = (!is_array($mixTextComplement)) ? $mixTextComplement : @$mixTextComplement[0];
                $strFontStyle = (!is_array($mixTextComplement)) ? '' : @$mixTextComplement[1];
                $this->SetFont('Arial', $strFontStyle, 9);
                $this->MultiCell(0, 5, $strTextComplement, 0, 'L', 1);
            }
        }
        $this->Cell(0, 2, '', 0, 1, 'L', 0);
        return $intY;
    }

    protected function getInfoFromColumnText(&$strColumnText, &$strTypeContent = 'text', &$strAlign = 'L', &$strPathFileImg = null, &$intWidthImg = null, &$intHeightImg = null, &$strExtensionImg = null)
    {
        if (is_array($strColumnText)) {
            $arrParamColumnText = array(
                array('intHeightImg', 'height', 4),
                array('intWidthImg', 'width', 3),
                array('strAlign', 'align', 2),
                array('strTypeContent', 'type', 1),
            );
            foreach ($arrParamColumnText as $arrParamColumnTextIntern) {
                $strVarName = $arrParamColumnTextIntern[0];
                if ((array_key_exists($arrParamColumnTextIntern[2], $strColumnText)) && (!empty($strColumnText[$arrParamColumnTextIntern[2]])))
                    $$strVarName = trim(strtolower($strColumnText[$arrParamColumnTextIntern[2]]));
                elseif ((array_key_exists($arrParamColumnTextIntern[1], $strColumnText)) && (!empty($strColumnText[$arrParamColumnTextIntern[1]])))
                    $$strVarName = trim(strtolower($strColumnText[$arrParamColumnTextIntern[1]]));
            }
            if (array_key_exists(0, $strColumnText))
                $strColumnText = $strColumnText[0];
            elseif (array_key_exists('text', $strColumnText))
                $strColumnText = $strColumnText['text'];
        }
        if ($strTypeContent == 'img') {
            if ((($mixPos = stripos($strColumnText, '/showfile')) !== false) || (is_file($strColumnText))) {
                $strDelimiter = (stripos($strColumnText, '.php') !== false) ? 'path=' : '/showfile/';
                $strPathFileImg = ($mixPos !== false) ? base64_decode(end($arrExplode = explode($strDelimiter, $strColumnText))) : $strColumnText;
                $arrImageInfo = getimagesize($strPathFileImg);
                if (is_array($arrImageInfo)) {
                    if (empty($intWidthImg))
                        $intWidthImg = $arrImageInfo[0];
                    if (empty($intHeightImg))
                        $intHeightImg = $arrImageInfo[1];
                }
            } elseif (stripos($strColumnText, '://') !== false) {
                $strPathFileImg = $strColumnText;
                if ((empty($intWidthImg)) || (empty($intHeightImg)))
                    $strTypeContent = 'text';
            } else
                $strTypeContent = 'text';
            if ($strTypeContent == 'img') {
                $strExtensionImg = trim(end($arrExplode = explode('.', $strPathFileImg)));
                if (!empty($intHeightImg))
                    $intWidthImg = 0;
                elseif (!empty($intWidthImg))
                    $intHeightImg = 0;
                $intHeightImg = round($intHeightImg / 5);
                $intWidthImg = round($intWidthImg / 5);
            }
        }
    }

    abstract public function addRegister($arrColumnsText);
}
