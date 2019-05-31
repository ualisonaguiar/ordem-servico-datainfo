<?php

namespace InepZend\BankPayment\Helper;

use InepZend\BankPayment\Helper\AbstractHelper;

/**
 * @package InepZend
 * @subpackage BankPayment
 */
class BilletHelper extends AbstractHelper
{

    private $strBank;

    public function __construct($arrParam = null, $strBank = null)
    {
        parent::__construct($arrParam);
        $this->strBank = $strBank;
    }

    public function getBillet($arrParam = null, $strBank = null)
    {
        if (empty($arrParam))
            $arrParam = $this->arrParam;
        if (empty($strBank))
            $strBank = $this->strBank;
        if (empty($strBank))
            $strBank = 'BancoDoBrasil';
        $strNamespaceBank = '\OpenBoleto\Banco\\' . $strBank;
        return (!class_exists($strNamespaceBank)) ? false : (new $strNamespaceBank((array) $arrParam));
    }

    public function render($arrParam = null, $strBank = null)
    {
        $billet = $this->getBillet($arrParam, $strBank);
        return ((!is_object($billet)) || (!method_exists($billet, 'getOutput'))) ? false : $billet->getOutput();
    }

}
