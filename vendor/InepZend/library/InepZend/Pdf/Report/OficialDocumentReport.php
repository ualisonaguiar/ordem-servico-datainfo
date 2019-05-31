<?php

namespace InepZend\Pdf\Report;

use InepZend\Pdf\Vendor\fpdf\Fpdf;
use InepZend\Util\Date;

class OficialDocumentReport extends Fpdf
{

    const CONST_WIDTH_PADRAO = 200;
    const CONST_HEIGHT_PADRAO = 250;
    const CONST_PARAGRAFO = "\t\t\t\t";

    protected $arrColumnsInfo = array();
    protected $intNuPag;
    protected $booZerarPaginacao = false;
    protected $booTotalPaginacao = true;
    protected $booNewTitle = false;
    protected $intFontSizeRegister = 8;
    protected $intFontSizeTitle = 8;

    public function __construct($booMemorando = false, $strDestinatario = null, $strAssunto = null, $strConteudo = null, $arrColumnsInfo = array(), $arrColumnsText = array(), $strNomeAssinatura = 'Responsável', $strCargoAssinatura = 'Cargo', $strIdentificacao = null, $booMunicipio = null, $booDataAtual = null, $booZerarPaginacao = null, $booTotalPaginacao = null, $booShowInepMecAssinatura = true, $intFontSizeRegister = null, $intFontSizeTitle = null)
    {
        $this->FPDF('P', 'mm', 'A4');
        $this->Open();
        $this->AliasNbPages();
        if
        (
                (!empty($strDestinatario)) ||
                (!empty($strAssunto)) ||
                (!empty($strConteudo)) ||
                ((is_array($arrColumnsText)) && (count($arrColumnsText) > 0)) ||
                (!empty($strNomeAssinatura)) ||
                (!empty($strCargoAssinatura)) ||
                (!empty($strIdentificacao)) ||
                (is_bool($booMunicipio)) ||
                (is_bool($booDataAtual)) ||
                (is_bool($booZerarPaginacao)) ||
                (is_bool($booTotalPaginacao)) ||
                (is_bool($booShowInepMecAssinatura)) ||
                (!empty($intFontSizeRegister)) ||
                (!empty($intFontSizeTitle))
        )
            self::createDocument($booMemorando, $strDestinatario, $strAssunto, $strConteudo, $arrColumnsInfo, $arrColumnsText, $strNomeAssinatura, $strCargoAssinatura, $strIdentificacao, $booMunicipio, $booDataAtual, $booZerarPaginacao, $booTotalPaginacao, $booShowInepMecAssinatura, $intFontSizeRegister, $intFontSizeTitle);
    }

    public function Footer()
    {
        $this->SetY(-14);
        $this->intNuPag = (empty($this->intNuPag)) ? $this->PageNo() : ($this->intNuPag + 1);
        if ($this->booZerarPaginacao === true) {
            $this->intNuPag = 1;
            $this->booZerarPaginacao = false;
        }
        $strFooter = 'Página ' . $this->intNuPag;
        if (!is_bool($this->booTotalPaginacao))
            $this->booTotalPaginacao = true;
        if ($this->booTotalPaginacao === true)
            $strFooter .= '/{nb}';
        $this->SetFont('Arial', 'I', 7);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(0, 3, $strFooter, 0, 0, 'R', 1);
    }

    public function createDocument($booMemorando = false, $strDestinatario = null, $strAssunto = null, $strConteudo = null, $arrColumnsInfo = array(), $arrColumnsText = array(), $strNomeAssinatura = 'Responsável', $strCargoAssinatura = 'Cargo', $strIdentificacao = null, $booMunicipio = null, $booDataAtual = null, $booZerarPaginacao = null, $booTotalPaginacao = null, $booShowInepMecAssinatura = true, $intFontSizeRegister = null, $intFontSizeTitle = null)
    {
        $this->AddPage();
        $this->SetFont('Arial', '', 8);
        $this->SetFillColor(255, 255, 255);
        $intY = 5;
        $this->booZerarPaginacao = $booZerarPaginacao;
        $this->booTotalPaginacao = $booTotalPaginacao;
        if (!empty($intFontSizeRegister))
            $this->intFontSizeRegister = $intFontSizeRegister;
        if (!empty($intFontSizeTitle))
            $this->intFontSizeTitle = $intFontSizeTitle;
        if (!empty($strIdentificacao)) {
            $this->Cell(0, 5, $strIdentificacao, 0, 1, 'R', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else {
                $this->Cell(0, 5, '', 0, 1, 'L', 0);
                $intY = 15;
            }
        }
        $this->Image('public/vendor/InepZend/images/brasaoNacional.jpg', ((self::CONST_WIDTH_PADRAO - 12) / 2), $intY, 20, 0, 'jpg');
        $this->SetY(22 + $intY);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 5, 'MINISTÉRIO DA EDUCAÇÃO', 0, 1, 'C', 0);
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 4, 'INSTITUTO NACIONAL DE ESTUDOS E PESQUISAS EDUCACIONAIS ANÍSIO TEIXEIRA (INEP)', 0, 1, 'C', 0);
        if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
            $this->AddPage();
        else
            $this->Cell(0, 8, '', 0, 1, 'L', 0);
        $this->SetFont('Arial', '', 9);
        if (is_bool($booMemorando)) {
            $strIdentificacao = ($booMemorando === true) ? 'MEMO' : 'Ofício Circular';
            $strIdentificacao .= '/MEC/INEP Nº';
            $this->Cell(0, 5, $strIdentificacao, 0, 1, 'L', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else
                $this->Cell(0, 5, '', 0, 1, 'L', 0);
        }
        if (!is_bool($booMunicipio))
            $booMunicipio = true;
        if (!is_bool($booDataAtual))
            $booDataAtual = true;
        $arrMunicipioDataAtual = array();
        if ($booMunicipio === true)
            $arrMunicipioDataAtual[] = 'Brasília/DF';
        if ($booDataAtual === true)
            $arrMunicipioDataAtual[] = date('d') . ' de ' . Date::getPortugueseMonth(date('m')) . ' de ' . date('Y');
        if (($booMunicipio === true) && ($booDataAtual === false))
            $arrMunicipioDataAtual[] = '                        ';
        if (count($arrMunicipioDataAtual) > 0) {
            $this->Cell(0, 5, implode(', ', $arrMunicipioDataAtual), 0, 1, 'R', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else
                $this->Cell(0, 5, '', 0, 1, 'L', 0);
        }
        if (!empty($strDestinatario)) {
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 5, $strDestinatario, 0, 1, 'L', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else
                $this->Cell(0, 8, '', 0, 1, 'L', 0);
        }
        if (!empty($strAssunto)) {
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(0, 5, 'Assunto: ' . $strAssunto, 0, 1, 'L', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else
                $this->Cell(0, 8, '', 0, 1, 'L', 0);
        }
        if (!empty($strConteudo)) {
            $this->SetFont('Arial', '', 9);
            $strConteudo = str_ireplace(array('<br/>', '<br />', '<br>', '<br >', "\r", "\t"), array("\n", "\n", "\n", "\n", '', self::CONST_PARAGRAFO), $strConteudo);
            $this->MultiCell(0, 4, $strConteudo, 0, 'J', 0);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
                $this->AddPage();
            else
                $this->Cell(0, 5, '', 0, 1, 'L', 0);
        }
        $arrColumnsInfo = (is_array(reset(reset(array_filter($arrColumnsInfo))))) ? $arrColumnsInfo : array($arrColumnsInfo);
        $arrColumnsText = (is_array(reset(reset(array_filter($arrColumnsText))))) ? $arrColumnsText : array($arrColumnsText);
        foreach ($arrColumnsText as $intKeyTabela => $arrColumnsTextIntern) {
            $booTitleInserted = false;
            $arrColumnsInfoIntern = (@is_array($arrColumnsInfo[$intKeyTabela])) ? @$arrColumnsInfo[$intKeyTabela] : array();
            if ((is_array($arrColumnsInfoIntern)) && (count($arrColumnsInfoIntern) > 0) && (is_array($arrColumnsTextIntern)) && (count($arrColumnsTextIntern) > 0)) {
                foreach ($arrColumnsTextIntern as $arrRegister) {
                    if (count($arrColumnsInfoIntern) == count($arrRegister)) {
                        if ($booTitleInserted == false)
                            self::addTitle($arrColumnsInfoIntern);
                        self::addRegister($arrRegister);
                        $booTitleInserted = true;
                    }
                }
                $this->Cell(0, 5, '', 0, 1, 'L', 0);
            }
        }
        $this->SetFont('Arial', '', 9);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(0, 5, 'Atenciosamente,', 0, 1, 'C', 0);
        if ($this->GetY() >= self::CONST_HEIGHT_PADRAO)
            $this->AddPage();
        else
            $this->Cell(0, 28, '', 0, 1, 'L', 0);
        if (!empty($strNomeAssinatura)) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 5, $strNomeAssinatura, 0, 1, 'C', 0);
        }
        $this->SetFont('Arial', '', 9);
        if (!empty($strCargoAssinatura))
            $this->Cell(0, 4, $strCargoAssinatura, 0, 1, 'C', 0);
        if ($booShowInepMecAssinatura !== false) {
            $this->Cell(0, 4, 'Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira', 0, 1, 'C', 0);
            $this->Cell(0, 4, 'Ministério de Educação', 0, 1, 'C', 0);
        }
    }

    public function addTitle($arrColumnsInfo = array())
    {
        if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
            $this->arrColumnsInfo = $arrColumnsInfo;
            $intY = $this->GetY();
            $this->SetFillColor(220, 220, 220);
            $this->SetFont('Arial', 'B', $this->intFontSizeTitle);
            $intCount = 0;
            foreach ($arrColumnsInfo as $arrColumnsInfoIndividual) {
                $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual['width'] : null;
                if (empty($intWidthIndividual))
                    $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual[0] : null;
                if (empty($intWidthIndividual))
                    $intWidthIndividual = round(self::CONST_WIDTH_PADRAO / count($arrColumnsInfo));
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
                $this->Cell($intWidthIndividual, round($this->intFontSizeTitle * 0.625), $strTitleIndividual, 1, $intWrap, 'L', 1);
                ++$intCount;
            }
            $this->SetY($intY);
            $this->MultiCell(0, round($this->intFontSizeTitle * 0.625), '', 1, 'J', 0);
        }
    }

    public function addRegister($arrColumnsText)
    {
        if ((is_array($arrColumnsText)) && (count($arrColumnsText) > 0)) {
            if ($this->booNewTitle === true) {
                $this->addTitle($this->arrColumnsInfo);
                $this->booNewTitle = false;
            }
            $arrColumnsInfo = $this->arrColumnsInfo;
            $this->SetFont('Arial', '', $this->intFontSizeRegister);
            $this->SetFillColor(245, 245, 245);
//          $this->Cell(0, 2, '', 0, 1, 'L', 0);
            $intY = $this->GetY();
            $intYOriginal = $intY;
            $intWidthTotal = 10;
            $intHeightMax = 5;
            $arrWidth = array();
            $intCount = 0;
            foreach ($arrColumnsText as $intKey => $strColumnText) {
                if ((is_array($arrColumnsInfo)) && (count($arrColumnsInfo) > 0)) {
                    $arrColumnsInfoIndividual = @$arrColumnsInfo[$intKey];
                    $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual['width'] : null;
                    if (empty($intWidthIndividual))
                        $intWidthIndividual = (is_array($arrColumnsInfoIndividual)) ? @$arrColumnsInfoIndividual[0] : null;
                    if (empty($intWidthIndividual))
                        $intWidthIndividual = round(self::CONST_WIDTH_PADRAO / count($arrColumnsInfo));
                } else
                    $intWidthIndividual = round(self::CONST_WIDTH_PADRAO / count($arrColumnsText));
                $intWrap = 0;
                if ($intCount == (count($arrColumnsText) - 1)) {
                    $intWrap = 1;
                    $intWidthIndividual = 0;
                }
                $strAlign = 'L';
                if (is_array($strColumnText)) {
                    $strAlign = @$strColumnText[1];
                    $strColumnText = @$strColumnText[0];
                }
                $intWidthTotal += $intWidthIndividual;
                $this->MultiCell($intWidthIndividual, 5, $strColumnText, 0, $strAlign, 0);
                if (($this->GetY() - $intY) > $intHeightMax)
                    $intHeightMax = $this->GetY() - $intY;
                $this->SetY($intY);
                $this->SetX($intWidthTotal);
                $arrWidth[$intKey] = $intWidthIndividual;
                ++$intCount;
            }
            $intWidthTotal = 10;
            $this->SetX($intWidthTotal);
            foreach ($arrWidth as $intWidthIndividual) {
                $intWidthTotal += $intWidthIndividual;
                $this->MultiCell($intWidthIndividual, $intHeightMax, '', 1, 'J', 0);
                $this->SetY($intY);
                $this->SetX($intWidthTotal);
            }
            $this->SetY($intYOriginal + $intHeightMax);
            if ($this->GetY() >= self::CONST_HEIGHT_PADRAO) {
                $this->AddPage();
                $this->booNewTitle = true;
            }
        }
    }

}
