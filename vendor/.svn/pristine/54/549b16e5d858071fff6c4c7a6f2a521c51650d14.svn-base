<?php

namespace InepZend\SpreedSheet\Vendor\phpexcel;

//use InepZend\Util\Date;
use InepZend\Util\FileSystem;
use InepZend\Util\AttributeStaticTrait;
use PHPExcel_Cell;
use PHPExcel_Cell_AdvancedValueBinder;
use PHPExcel_IOFactory;

class PhpExcelManager extends PhpExcel
{

    use AttributeStaticTrait;

    private static $strTypeFromFile = null;

    public static function getInstance()
    {
        return self::getAttributeStaticInstance(__CLASS__);
    }

    public static function getFirstRow($strFileFullName = null)
    {
        $strTypeFromFile = self::getTypeFromFile($strFileFullName);
        if ($strTypeFromFile == 'csv')
            return self::getFirstRowCsv($strFileFullName);
        elseif ($strTypeFromFile == 'xls')
            return self::getFirstRowXls($strFileFullName);
        return;
    }

    public static function getFirstRowXls($strFileFullName = null)
    {
        $reader = self::setInfoToReadXls($strFileFullName);
        return (!is_object($reader)) ? null : self::captureData($strFileFullName, true, $reader, true);
    }

    public static function getFirstRowCsv($strFileFullName = null)
    {
        $reader = self::setInfoToReadCsv($strFileFullName);
        return (!is_object($reader)) ? null : self::captureData($strFileFullName, true, $reader, true);
    }

    public static function listData($strFileFullName = null, $booRowKey = true)
    {
        $strTypeFromFile = self::getTypeFromFile($strFileFullName);
        if ($strTypeFromFile == 'csv')
            return self::listDataCsv($strFileFullName, $booRowKey);
        elseif ($strTypeFromFile == 'xls')
            return self::listDataXls($strFileFullName, $booRowKey);
        return;
    }

    public static function listDataXls($strFileFullName = null, $booRowKey = true)
    {
        $reader = self::setInfoToReadXls($strFileFullName);
        return (!is_object($reader)) ? null : self::captureData($strFileFullName, $booRowKey, $reader);
    }

    public static function listDataCsv($strFileFullName = null, $booRowKey = true)
    {
        $reader = self::setInfoToReadCsv($strFileFullName);
        return (!is_object($reader)) ? null : self::captureData($strFileFullName, $booRowKey, $reader);
    }

    public static function getCountRow($strFileFullName = null)
    {
        $strTypeFromFile = self::getTypeFromFile($strFileFullName);
        if ($strTypeFromFile == 'csv')
            return self::getCountRowCsv($strFileFullName);
        elseif ($strTypeFromFile == 'xls')
            return self::getCountRowXls($strFileFullName);
        return;
    }

    public static function getCountRowXls($strFileFullName = null)
    {
        $reader = self::setInfoToReadXls($strFileFullName);
        return (!is_object($reader)) ? null : self::getMaxRow($strFileFullName, $reader);
    }

    public static function getCountRowCsv($strFileFullName = null)
    {
        $reader = self::setInfoToReadCsv($strFileFullName);
        return (!is_object($reader)) ? null : self::getMaxRow($strFileFullName, $reader);
    }

    public static function getCountCol($strFileFullName = null, $booCaracter = false)
    {
        $strTypeFromFile = self::getTypeFromFile($strFileFullName);
        if ($strTypeFromFile == 'csv')
            return self::getCountColCsv($strFileFullName, $booCaracter);
        elseif ($strTypeFromFile == 'xls')
            return self::getCountColXls($strFileFullName, $booCaracter);
        return;
    }

    public static function getCountColXls($strFileFullName = null, $booCaracter = false)
    {
        $reader = self::setInfoToReadXls($strFileFullName);
        return (!is_object($reader)) ? null : self::getMaxCol($strFileFullName, $booCaracter, $reader);
    }

    public static function getCountColCsv($strFileFullName = null, $booCaracter = false)
    {
        $reader = self::setInfoToReadCsv($strFileFullName);
        return (!is_object($reader)) ? null : self::getMaxCol($strFileFullName, $booCaracter, $reader);
    }

    public static function writeRegister($strFileFullName = null, $arrRegister = null)
    {
        if ((empty($strFileFullName)) || (empty($arrRegister)))
            return;
        $booExists = true;
        if (!file_exists($strFileFullName)) {
            $booExists = false;
            if ($hanFile = fopen($strFileFullName, 'a+'))
                fclose($hanFile);
        }
        $strWriteType = null;
        $strTypeFromFile = self::getTypeFromFile($strFileFullName);
        if ($strTypeFromFile == 'csv') {
            $strWriteType = 'CSV';
            $strMethodSetInfo = 'setInfoToReadCsv';
        } elseif ($strTypeFromFile == 'xls') {
            $strWriteType = 'Excel5';
            $strMethodSetInfo = 'setInfoToReadXls';
        }
        if (is_null($strWriteType))
            return;
        $reader = self::$strMethodSetInfo($strFileFullName);
        if (!is_object($reader))
            return;
        if (!is_array($arrRegister))
            $arrRegister = array(array($arrRegister));
        if ((is_array($arrRegister)) && (count($arrRegister) == 0))
            return;
        foreach ($arrRegister as $mixData) {
            if (!is_array($mixData)) {
                $arrRegister = array($arrRegister);
                break;
            }
        }
        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        $phpExcel = $reader->load($strFileFullName);
        $writer = PHPExcel_IOFactory::createWriter($phpExcel, $strWriteType);
        if ($strWriteType == 'CSV')
            self::setInfoCsv($writer);
        $writer->save($strFileFullName);
        $worksheet = $phpExcel->getActiveSheet();
        foreach ($arrRegister as $arrRegisterIntern) {
            $intCol = 0;
            foreach ($arrRegisterIntern as $mixKey => $mixValue) {
                if (is_numeric($mixKey)) {
                    $intRow = 1;
                    if ($booExists) {
                        $intRow = self::getCountRow($strFileFullName);
                        ++$intRow;
                    }
                    self::setCellValue($worksheet, PHPExcel_Cell::stringFromColumnIndex($mixKey) . $intRow, $mixValue);
                } else {
                    try {
                        $mixCell = $worksheet->getCell($mixKey);
                        if ($mixCell instanceof PHPExcel_Cell)
                            self::setCellValue($worksheet, $mixKey, $mixValue);
                    } catch (\Exception $exception) {
                        $intRow = 1;
                        if ($booExists) {
                            $intRow = self::getCountRow($strFileFullName);
                            ++$intRow;
                        }
                        self::setCellValue($worksheet, PHPExcel_Cell::stringFromColumnIndex($intCol) . $intRow, $mixValue);
                    }
                }
                ++$intCol;
            }
            $booExists = true;
        }
        $writer = PHPExcel_IOFactory::createWriter($phpExcel, $strWriteType);
        if ($strWriteType == 'CSV')
            self::setInfoCsv($writer);
        $writer->save($strFileFullName);
        return true;
    }

    private static function setCellValue($worksheet = null, $strKey = null, $mixValue = null)
    {
        if ((!is_object($worksheet)) || (empty($strKey)))
            return;
        $worksheet->setCellValue($strKey, $mixValue);
//        if ((Date::isDateTemplate($mixValue)) || (Date::isDateBase($mixValue))) {
//            $strFormatDate = (Date::isDateTemplate($mixValue)) ? 'd/m/Y' : 'Y-m-d';
//            if (strlen($mixValue > 10))
//                $strFormatDate .= ' H:i:s';
//            switch ($strFormatDate) {
//                case 'd/m/Y': {
//                        $strFormatDatePHPExcel = PHPExcel_Style_NumberFormat::FORMAT_DATE_DMYSLASH;
//                        break;
//                    }
//                case 'Y-m-d': {
//                        $strFormatDatePHPExcel = PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2;
//                        break;
//                    }
//                case 'd/m/Y H:i:s': {
//                        $strFormatDatePHPExcel = PHPExcel_Style_NumberFormat::FORMAT_DATE_DMYSLASH . ' ' . PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4;
//                        break;
//                    }
//                case 'Y-m-d H:i:s': {
//                        $strFormatDatePHPExcel = PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2 . ' ' . PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4;
//                        break;
//                    }
//            }
//            $worksheet->getStyle($strKey)->getNumberFormat()->setFormatCode($strFormatDatePHPExcel);
//        }
        return true;
    }

    private static function getMaxRow($strFileFullName = null, $reader = null)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)) || (!is_object($reader)))
            return;
        $worksheet = self::getWorksheet($strFileFullName, $reader);
        return $worksheet->getHighestRow();
    }

    private static function getMaxCol($strFileFullName = null, $booCaracter = false, $reader = null)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)) || (!is_object($reader)))
            return;
        $worksheet = self::getWorksheet($strFileFullName, $reader);
        $strCaracterCol = $worksheet->getHighestColumn();
        if ($booCaracter === true)
            return $strCaracterCol;
        return PHPExcel_Cell::columnIndexFromString($strCaracterCol);
    }

    private static function setInfoToReadXls($strFileFullName = null)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)))
            return;
        $reader = PHPExcel_IOFactory::createReaderForFile($strFileFullName);
        if (filesize($strFileFullName) != 0)
            $reader->setReadDataOnly(true);
        return $reader;
    }

    private static function setInfoToReadCsv($strFileFullName = null)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)))
            return;
        $reader = new PHPExcel_Reader_CSV();
        self::setInfoCsv($reader);
        return $reader;
    }

    private static function setInfoCsv($readerWriter = null)
    {
        if (!is_object($readerWriter))
            return;
        if ($readerWriter instanceof PHPExcel_Reader_CSV)
            $readerWriter->setInputEncoding('CP1252');
        $readerWriter->setDelimiter(';');
        $readerWriter->setEnclosure('');
        $readerWriter->setLineEnding('\r\n');
        $readerWriter->setSheetIndex(0);
    }

    private static function getWorksheet($strFileFullName = null, $reader = null)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)) || (!is_object($reader)))
            return;
        $phpExcel = $reader->load($strFileFullName);
        return $phpExcel->getActiveSheet();
    }

    private static function captureData($strFileFullName = null, $booRowKey = true, $reader = null, $booFirstRow = false)
    {
        if ((empty($strFileFullName)) || (!file_exists($strFileFullName)) || (!is_object($reader)))
            return;
        $worksheet = self::getWorksheet($strFileFullName, $reader);
        $arrObjRow = $worksheet->getRowIterator();
        $arrData = array();
        if ($booFirstRow === true)
            $booRowKey = true;
        foreach ($arrObjRow as $intRow => $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $intCell => $cell) {
                if ($booRowKey === true)
                    $arrData[($intRow - 1)][$intCell] = $cell->getValue();
                else
                    $arrData[$intCell][($intRow - 1)] = $cell->getValue();
            }
            if ($booFirstRow === true)
                break;
        }
        return $arrData;
    }

    private static function getTypeFromFile($strFileFullName = null, $strForceCheck = false)
    {
        if (empty($strFileFullName))
            return;
        if ((empty(self::$strTypeFromFile)) || ($strForceCheck === true)) {
            $strTypeFromFile = null;
            $arrExtension = FileSystem::getExtensionFromMimeContent(FileSystem::getMimeContentFromFile($strFileFullName));
            if ((in_array('csv', $arrExtension)) && (!in_array('xls', $arrExtension)))
                $strTypeFromFile = 'csv';
            elseif (in_array('xls', $arrExtension))
                $strTypeFromFile = 'xls';
            self::$strTypeFromFile = $strTypeFromFile;
        }
        return self::$strTypeFromFile;
    }

}
