<?php

namespace InepZend\Pdf\Vendor\mpdf;

use mPDF as mPDFNative;
use InepZend\Util\Server;

class Mpdf extends mPDFNative
{

    public function WriteHTML($strHtml = '', $intSub = 0, $booInit = true, $booClose = true)
    {
        return parent::WriteHTML($this->insertHostIntoHtml($strHtml), $intSub, $booInit, $booClose);
    }

    private function insertHostIntoHtml($strHtml = '')
    {
        $arrFinder = array(
            'src ="/', 'src= "/', 'src = "/', "src ='/", "src= '/", "src = '/",
            'href ="/', 'href= "/', 'href = "/', "href ='/", "href= '/", "href = '/",
        );
        $arrReplacer = array(
            'src="/', 'src="/', 'src="/', "src='/", "src='/", "src='/",
            'href="/', 'href="/', 'href="/', "href='/", "href='/", "href='/",
        );
        $strHtml = str_ireplace($arrFinder, $arrReplacer, $strHtml);
        $strHost = Server::getHost(false);
        $arrFinder = array(
            'src="/', "src='/", "src=/",
            'href="/', "href='/", "href=/",
        );
        $arrReplacer = array(
            'src="' . $strHost, "src='" . $strHost, "src=" . $strHost,
            'href="' . $strHost, "href='" . $strHost, "href=" . $strHost,
        );
        $strHtml = str_ireplace($arrFinder, $arrReplacer, $strHtml);
        return $strHtml;
    }

}
