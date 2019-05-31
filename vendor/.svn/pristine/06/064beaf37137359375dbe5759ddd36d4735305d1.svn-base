<?php
namespace InepZend\Util;

use InepZend\Util\Date;

/**
 * Classe responsavel no tratamento de operacoes em strings SQLs.
 *
 * @package InepZend
 * @subpackage Util
 */
class Sql
{

    public static function createInsert($strTable = null, $arrBindValue = null, $booPerformance = null)
    {
        if ((empty($strTable)) || (empty($arrBindValue)))
            return '';
        $arrBind = array_keys($arrBindValue);
        $strInsert = 'INSERT ' . (($booPerformance) ? '/*+ nologging append */ ' : '') . 'INTO ' . $strTable . ' (' . implode(', ', $arrBind) . ') values (:' . implode(', :', $arrBind) . ')';
        foreach ($arrBindValue as $strBind => $mixValue) {
            if (stripos($strBind, 'dt_') === 0) {
                $arrFormat = Date::getDateFormat($mixValue);
                if (! is_array($arrFormat))
                    continue;
                $strInsert = str_replace(':' . $strBind, 'TO_DATE(:' . $strBind . ', \'' . self::convertDateFormatPhpToDb($arrFormat[0]) . '\')', $strInsert);
            }
        }
        return $strInsert;
    }
    
    public static function editBindValue($arrBindValue = null)
    {
        if (!is_array($arrBindValue))
            return array();
        foreach ($arrBindValue as $strBind => $mixValue) {
            if (stripos($strBind, 'dt_') === 0) {
                $arrFormat = Date::getDateFormat($mixValue);
                if (! is_array($arrFormat))
                    continue;
                $arrBindValue[$strBind] = date_create_from_format($arrFormat[0], $mixValue);
            }
        }
        return $arrBindValue;
    }

    public static function getBindValueType($arrBindValue = null)
    {
        $arrType = array();
        if (is_array($arrBindValue)) {
            foreach ($arrBindValue as $strBind => $mixValue) {
                if (stripos($strBind, 'dt_') === 0) {
                    $arrType[$strBind] = 'datetime';
                } elseif (is_int($mixValue))
                    $arrType[$strBind] = \PDO::PARAM_INT;
                else
                    $arrType[$strBind] = \PDO::PARAM_STR;
            }
        }
        $arrType = array_values($arrType);
        return $arrType;
    }

    public static function getBind($strSql = '')
    {
        $arrBind = array();
        if (($intPos = strpos($strSql, ':')) !== false) {
            $strBind = substr($strSql, $intPos + 1);
            $arrBind = explode(':', $strBind);
            foreach ($arrBind as $intBind => $strBind)
                $arrBind[$intBind] = reset(explode(' ', $strBind));
            $arrBind = array_unique($arrBind);
        }
        return $arrBind;
    }

    public static function convertDateFormatPhpToDb($strFormat = null)
    {
        return str_replace(array(
            'Y',
            'm',
            'd',
            'H',
            'i',
            's'
        ), array(
            'yyyy',
            'mm',
            'dd',
            'hh24',
            'mi',
            'ss'
        ), $strFormat);
    }

    public static function convertDateFormatDbToPhp($strFormat = null)
    {
        return str_ireplace(array(
            'yyyy',
            'mm',
            'dd',
            'hh24',
            'mi',
            'ss'
        ), array(
            'Y',
            'm',
            'd',
            'H',
            'i',
            's'
        ), $strFormat);
    }
}
