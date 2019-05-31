<?php

namespace InepZend\BankPayment\Helper;

use InepZend\View\Helper\AbstractHelper as AbstractHelperInepZend;
use InepZend\Pdf\Vendor\mpdf\Mpdf;

abstract class AbstractHelper extends AbstractHelperInepZend
{

    protected $arrParam;

    public function __construct($arrParam = null)
    {
        $this->arrParam = $arrParam;
    }

    public function generatePdf($arrParam = null)
    {
        $mpdf = new Mpdf('c');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->render($arrParam));
        $mpdf->Output(time() . '.pdf', 'D');
    }

}
