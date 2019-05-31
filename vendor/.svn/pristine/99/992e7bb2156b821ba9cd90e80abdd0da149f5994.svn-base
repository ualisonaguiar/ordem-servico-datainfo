<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator\Util;

use InepZend\Util\String;
use InepZend\Util\ArrayCollection;

trait DadoAleatorio
{

    /**
     * 
     * @return type
     */
    protected function getSqUf()
    {
        $arrUf = array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO');
        return $this->getDomain($arrUf);
    }

    /**
     * 
     * @return type
     */
    protected function getInAtivo()
    {
        return $this->getDomain(array('0', '1'));
    }

    /**
     * 
     * @param type $intSize
     * @return type
     */
    protected function getGenerateStringNumber($intSize)
    {
        return str_replace(array('a', 'e', 'i', 'o', 'u'), ' ', String::generateRandomExpression($intSize));
    }

    /**
     * 
     * @param type $intSize
     * @return type
     */
    protected function getGenerateString($intSize)
    {
        return str_replace(array('a', 'e', 'i', 'o', 'u'), ' ', String::generateRandomExpression($intSize, false));
    }

    /**
     * 
     * @param type $intQtdGenerate
     * @return type
     */
    protected function getGenerateNumber($intQtdGenerate, $booVerifyQtd = true)
    {
        $intValueNumber = null;
        if ($booVerifyQtd && $intQtdGenerate > 9)
            $intQtdGenerate = strlen(2);
        for ($intPosicao = 1; $intPosicao <= $intQtdGenerate; $intPosicao++)
            $intValueNumber .= rand(1, 9);
        return $intValueNumber;
    }

    /**
     * 
     * @param type $arrDomain
     * @return type
     */
    protected function getDomain($arrDomain)
    {
        ArrayCollection::clearEmptyParam($arrDomain);
        return $arrDomain[array_rand($arrDomain, 1)];
    }

    /**
     * 
     * @return type
     */
    protected function getGenerateDate()
    {
        return date("Y-m-d", rand(8, 1262055681));
    }

    /**
     * 
     * @return type
     */
    protected function getGenerateHora()
    {
        return date("H:i:s", rand(6, 1262055681));
    }

    /**
     * 
     * @return type
     */
    protected function getGenerateDateHora()
    {
        return date("Y-m-d H:i:s", rand(14, 1262055681));
    }

}
