<?php

namespace InepZend\Dto;

use InepZend\Dto\ResultDto;
use InepZend\Util\ArrayCollection;

/**
 * Classe responsavel por manipular resultados de operacoes via DTO.
 * 
 * @package InepZend
 * @subpackage Dto
 */
trait ResultTrait
{

    public static function getResult($strStatus = null, $mixMessage = null, $mixResult = null, $intHttpStatus = null, $booRecursive = true)
    {
        if ((is_array($mixResult)) && (array_key_exists('status', $mixResult)) && (array_key_exists('messages', $mixResult)) && (array_key_exists('result', $mixResult)))
            return $mixResult;
        $arrResult = [
            'http-status' => $intHttpStatus,
            'status' => (empty($strStatus)) ? ResultDto::STATUS_OK : $strStatus,
            'messages' => $mixMessage,
            'result' => $mixResult,
        ];
        ArrayCollection::clearEmptyParam($arrResult, false, false, $booRecursive);
        return $arrResult;
    }
    
    public static function isResult($arrResult = null, $strStatus = null)
    {
        if (empty($strStatus))
            $strStatus = ResultDto::STATUS_OK;
        $booResult = (
            (is_array($arrResult)) &&
            (array_key_exists('status', $arrResult)) &&
            ($arrResult['status'] == $strStatus)
        );
        return $booResult;
    }

}
