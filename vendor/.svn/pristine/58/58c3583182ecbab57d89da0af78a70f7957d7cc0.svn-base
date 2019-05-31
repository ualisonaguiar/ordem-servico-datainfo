<?php

namespace InepZend\Util;

/**
 * Classe responsavel na validacao de CNPJ, CPF, EMAIL e PIS/PASEP.
 *
 * @package InepZend
 * @subpackage Util
 */
class Validate
{

    /**
     * Metodo responsavel em validar email, podendo verificar o dominio do mesmo caso necessario.
     *
     * @example \InepZend\Util\Validate::validateEmail('arquitetura.php@inep.gov.br') <br /> \InepZend\Util\Validate::validateEmail('arquitetura.php@inep.gov.br', true)
     *
     * @param string $strEmail
     * @param boolean $booCheckDomain
     * @return boolean
     *
     * @assert ('arquitetura.php@inep.gov.br') === true
     * @assert ('arquitetura.php@inep.gov.br', true) === true
     *
     * @assert ('arquitetura.php@inep.gov') === true
     * @assert ('arquitetura.php@inep.gov', true) !== true
     *
     * @assert ('arquitetura.php@gov') !== true
     * @assert ('arquitetura.php@gov', true) !== true
     *
     * @assert ('arquitetura.php@inep.gov.') !== true
     * @assert ('arquitetura.php@inep.gov.', true) !== true
     *
     * @TODO assert ('arquitetura-php$$@inep.gov.br') !== true
     * @TODO assert ('arquitetura-php$$@inep.gov.br', true) !== true
     *
     * @assert ('arquitetura-php@i;nep.gov.br') !== true
     * @assert ('arquitetura-php@i;nep.gov.br', true) !== true
     *
     * @assert ('@inep.gov.br') !== true
     * @assert ('@inep.gov.br', true) !== true
     */
    public static function validateEmail($strEmail, $booCheckDomain = false)
    {
        if ((is_null($strEmail)) || (empty($strEmail)))
            return false;
        $strRegex = '/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
        $arrEmail = explode(';', $strEmail);
        foreach ($arrEmail as $strEmail) {
            if (preg_match($strRegex, trim($strEmail))) {
                if (($booCheckDomain) && (function_exists('checkdnsrr'))) {
                    list (, $strDomain) = explode('@', trim($strEmail));
                    if ((!checkdnsrr(trim($strDomain), 'MX')) && (!checkdnsrr(trim($strDomain), 'A')))
                        return false;
                }
            } else
                return false;
        }
        return true;
    }

    /**
     * Metodo responsavel em validar PIS/PASEP.
     *
     * @example \InepZend\Util\Validate::validatePisPasep('125.32227.36-4') <br /> \InepZend\Util\Validate::validatePisPasep('12532227364')
     *
     * @param string $strValue
     * @return boolean
     *
     * @assert ('125.32227.36-4') === true
     * @assert ('12532227364') === true
     *
     * @assert ('125.32227.36-40') !== true
     * @assert ('125.32227.3') !== true
     *
     * @assert ('125322273649') !== true
     * @assert ('125322273') !== true
     *
     * @assert ('abc.defabc.de-fa') !== true
     * @assert ('abcdefabcdefa') !== true
     *
     * @assert ('abcdefabcdefa') !== true
     * @assert ('abcdefabcdefa') !== true
     *
     * @assert ('00000000000') !== true
     * @assert ('11111111111') !== true
     * @assert ('33333333333') !== true
     * @assert ('44444444444') !== true
     * @assert ('55555555555') !== true
     * @assert ('66666666666') !== true
     * @assert ('77777777777') !== true
     * @assert ('88888888888') !== true
     * @assert ('99999999999') !== true
     */
    public static function validatePisPasep($strValue)
    {
        $strValue = str_pad(preg_replace('/[^0-9]/', '', $strValue), 11, '0', STR_PAD_LEFT);
        if ((strlen($strValue) != 11) || (in_array($strValue, array('00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'))))
            return false;
        for ($intDigit = 0, $intControl = 3, $intCount = 0; $intCount < 10; ++$intCount) {
            $intDigit += $strValue{$intCount} * $intControl;
            $intControl = ($intControl < 3) ? 9 : --$intControl;
        }
        $intDigit = (((10 * $intDigit) % 11) % 10);
        return ($strValue{$intCount} == $intDigit);
    }

    /**
     * Metodo responsavel em validar o CPF.
     *
     * @example \InepZend\Util\Validate::validateCpf('173.575.278-91') <br /> \InepZend\Util\Validate::validateCpf('17357527891')
     *
     * @param string $strNuCpf
     * @return boolean
     *
     * @assert ('173.575.278-91') === true
     * @assert ('17357527891') === true
     * @assert ('173575278-91') === true
     *
     * @assert ('abc.def.ghi-91') !== true
     * @assert ('173.575.278-19') !== true
     * @assert ('137.575.287-91') !== true
     *
     * @assert ('00000000000') !== true
     * @assert ('11111111111') !== true
     * @assert ('22222222222') !== true
     * @assert ('33333333333') !== true
     * @assert ('44444444444') !== true
     * @assert ('55555555555') !== true
     * @assert ('66666666666') !== true
     * @assert ('77777777777') !== true
     * @assert ('88888888888') !== true
     * @assert ('99999999999') !== true
     */
    public static function validateCpf($strNuCpf)
    {
        $strNuCpf = str_pad(preg_replace('/[^0-9]/', '', $strNuCpf), 11, '0', STR_PAD_LEFT);
        if ((strlen($strNuCpf) != 11) || (in_array($strNuCpf, array('00000000000', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'))))
            return false;
        for ($intTest = 9; $intTest < 11; $intTest++) {
            for ($intDigit = 0, $intCount = 0; $intCount < $intTest; $intCount++)
                $intDigit += $strNuCpf{$intCount} * (($intTest + 1) - $intCount);
            $intDigit = (((10 * $intDigit) % 11) % 10);
            if ($strNuCpf{$intCount} != $intDigit)
                return false;
        }
        return true;
    }

    /**
     * Metodo responsavel em validar o CNPJ.
     *
     * @example \InepZend\Util\Validate::validateCnpj('56.167.101/0001-06') <br /> \InepZend\Util\Validate::validateCnpj('56167101000106')
     *
     * @param string $strNuCnpj
     * @return boolean
     *
     * @assert ('56.167.101/0001-06') === true
     * @assert ('56167101000106') === true
     *
     * @assert ('ab.cde.fgh/ijkl-mb') !== true
     * @assert ('abcdefghijklmb') !== true
     *
     * @assert ('56.167.101/0001-60') !== true
     * @assert ('56167101000160') !== true
     *
     * @assert ('56.267.101/0002-06') !== true
     * @assert ('56169101000206') !== true
     *
     * @assert ('00000000000000') !== true
     * @assert ('11111111111111') !== true
     * @assert ('22222222222222') !== true
     * @assert ('33333333333333') !== true
     * @assert ('44444444444444') !== true
     * @assert ('66666666666666') !== true
     * @assert ('77777777777777') !== true
     * @assert ('88888888888888') !== true
     * @assert ('99999999999999') !== true
     */
    public static function validateCnpj($strNuCnpj)
    {
        $strNuCnpj = str_pad(preg_replace('/[^0-9]/', '', $strNuCnpj), 14, '0', STR_PAD_LEFT);
        if ((strlen($strNuCnpj) != 14) || (in_array($strNuCnpj, array('00000000000000', '11111111111111', '22222222222222', '33333333333333', '44444444444444', '55555555555555', '66666666666666', '77777777777777', '88888888888888', '99999999999999'))))
            return false;
        for ($intTest = 12; $intTest < 14; $intTest++) {
            for ($intDigit = 0, $intControl = ($intTest - 7), $intCount = 0; $intCount < $intTest; $intCount++) {
                $intDigit += $strNuCnpj{$intCount} * $intControl;
                $intControl = ($intControl < 3) ? 9 : --$intControl;
            }
            $intDigit = (((10 * $intDigit) % 11) % 10);
            if ($strNuCnpj{$intCount} != $intDigit)
                return false;
        }
        return true;
    }

    /**
     * Metodo responsavel em validar Host.
     *
     * @example \InepZend\Util\Validate::validateHost('portal.inep.gov.br')
     *
     * @param string $strUri
     * @return boolean
     *
     * @assert ('portal.inep.gov.br') === true
     * @assert ('portal .inep.gov. br') !== true
     * @assert ('http://portal .inep.gov .br') !== true
     * @assert ('http://portal.inep.gov.br') !== true
     * @assert ('download.inep.gov.br/educacao_basica/enem/nota_tecnica/2011/nota_tecnica_tri_enem_18012012.pdf') !== true
     */
    public static function validateHost($strUri)
    {
        return (preg_match('/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/', $strUri)) ? true : false;
    }

}
