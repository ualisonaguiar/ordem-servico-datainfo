<?php

namespace InepZend\SpreedSheet;

class SpreedSheetFactory
{

    private $strVendor = 'phpexcel';

    public function __construct($strVendor = 'phpexcel')
    {
        $this->strVendor = $strVendor;
    }

    public function make($strVendor = 'phpexcel')
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
            case 'phpexcel':
            default: {
                    eval('$spreedSheet = new \InepZend\SpreedSheet\Vendor\phpexcel\PhpExcel(' . $strParam . ');');
                    break;
                }
        }
        return $spreedSheet;
    }

}
