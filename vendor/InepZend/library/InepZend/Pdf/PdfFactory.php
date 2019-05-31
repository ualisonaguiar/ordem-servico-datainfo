<?php

namespace InepZend\Pdf;

class PdfFactory
{

    private $strVendor = 'fpdf';

    public function __construct($strVendor = 'fpdf')
    {
        $this->strVendor = $strVendor;
    }

    public function make($strVendor = 'fpdf')
    {
        if ($strVendor != $this->strVendor)
            $this->strVendor = $strVendor;
        $arrAllParam = func_get_args();
        unset($arrAllParam[0]);
        $strParam = '';
        foreach ($arrAllParam as $intKey => $mixValueParam) {
            if ($intKey != 1)
                $strParam .= ', ';
            $strParam .= '$arrAllParam[' . $intKey . ']';
        }
        switch (strtolower($this->strVendor)) {
            case 'mpdf': {
                    eval('$pdf = new \InepZend\Pdf\Vendor\mpdf\Mpdf(' . $strParam . ');');
                    break;
                }
            case 'fpdf':
            default: {
                    eval('$pdf = new \InepZend\Pdf\Vendor\fpdf\Fpdf(' . $strParam . ');');
                    break;
                }
        }
        return $pdf;
    }

}
