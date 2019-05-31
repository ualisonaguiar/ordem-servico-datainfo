<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator\Adapter;

interface InterfaceFile
{

    /**
     * 
     * @param string $strNameFile
     */
    public function getMountPath($strNameFile, $intIdMassaTest);

    /**
     * 
     * @param string $arrLineValue
     * @param string $strNameFile
     */
    public function insertContent($arrLineValue, $strNameFile, $intIdMassaTeste);

    /**
     * 
     */
    public function getInformation();

    /**
     * 
     */
    public function excluir();
}
