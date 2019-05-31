<?php

namespace InepZend\Pdf\Vendor\fpdf;

use fpdf\FPDF as FPDFNative;
use InepZend\Util\String;

class Fpdf extends FPDFNative
{

    public function Cell($intWidth, $intHeight = 0, $strText = '', $mixBorder = 0, $intLn = 0, $strAlign = '', $booFill = false, $strLink = '')
    {
        return parent::Cell($intWidth, $intHeight, $this->getText($strText), $mixBorder, $intLn, $strAlign, $booFill, $strLink);
    }

    public function MultiCell($intWidth, $intHeight, $strText, $mixBorder = 0, $strAlign = 'J', $booFill = false)
    {
        return parent::MultiCell($intWidth, $intHeight, $this->getText($strText), $mixBorder, $strAlign, $booFill);
    }

    private function getText($strText)
    {
        return ((!is_array($strText)) && (String::isUTF8($strText))) ? iconv('UTF-8', 'ISO-8859-1', $strText) : $strText;
    }

}
