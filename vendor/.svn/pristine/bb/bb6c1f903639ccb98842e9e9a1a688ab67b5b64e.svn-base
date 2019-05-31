<?php

namespace InepZend\Dto;

use InepZend\Configurator\Configurator;

/**
 * Classe responsavel por encapsular informacoes em um objeto de transferencia de
 * dados.
 * 
 * @package InepZend
 * @subpackage Dto
 */
abstract class AbstractDto
{

    private $arrData = array();
    private $arrFile = array();

    /**
     * Metodo construtor responsavel em configurar o objeto executando o metodo
     * addData para incluir os atributos parametrizados no array de dados.
     * 
     * @param array $arrData
     * @param boolean $booTryCall
     * @return void;
     */
    public function __construct($arrData = null, $booTryCall = false)
    {
        Configurator::configureDto($this, $arrData, $booTryCall);
    }

    /**
     * Metodo responsavel em inserir as informacoes no objeto.
     * 
     * @param mix $mixName
     * @param mix $mixValue
     * @return object
     */
    public function addData($mixName = null, $mixValue = null)
    {
        if (is_array($mixName))
            foreach ($mixName as $strKey => $mixValue)
                $this->arrData[(string) $strKey] = $mixValue;
        elseif (!empty($mixName))
            $this->arrData[(string) $mixName] = $mixValue;
        return $this;
    }

    /**
     * Metodo responsavel por inserir um arquivo no objeto.
     * 
     * @param mix $mixName
     * @param mix $mixValue
     * @return object
     */
    public function addFile($mixName = null, $mixValue = null)
    {
        if (is_array($mixName))
            foreach ($mixName as $strKey => $mixValue)
                $this->arrFile[(string) $strKey] = $mixValue;
        elseif (!empty($mixName))
            $this->arrFile[(string) $mixName] = $mixValue;
        return $this;
    }

    /**
     * Metodo responsavel por limpar uma ou todas as informacoes contidas no objeto.
     * 
     * @param string $strName
     * @return object
     */
    public function clearData($strName = null)
    {
        if (empty($strName))
            $this->arrData = array();
        elseif (isset($this->arrData[$strName]))
            unset($this->arrData[(string) $strName]);
        return $this;
    }

    /**
     * Metodo responsavel por limpar um ou todos os arquivos contidos no objeto.
     * 
     * @param string $strName
     * @return object
     */
    public function clearFile($strName = null)
    {
        if (empty($strName))
            $this->arrFile = array();
        else
            unset($this->arrFile[(string) $strName]);
        return $this;
    }

    /**
     * Metodo responsavel por capturar uma ou todas as informacoes contidas no objeto.
     * 
     * @param string $strName
     * @return string
     */
    public function getData($strName = null)
    {
        if (!$strName)
            return ((is_array($this->arrData)) && (count($this->arrData) == 1)) ? $this->arrData[0] : $this->arrData;
        if (!array_key_exists($strName, $this->arrData))
            return;
        return $this->arrData[$strName];
    }

    /**
     * Metodo responsavel por capturar um ou todos os arquivos contidos no objeto.
     * 
     * @param string $strName
     * @return string
     */
    public function getFile($strName = null)
    {
        if (!$strName)
            return $this->arrFile;
        if (!array_key_exists($strName, $this->arrFile))
            return;
        return $this->arrFile[$strName];
    }

    /**
     * Metodo magico responsavel em retornar todas as chaves dos atributos (informacoes)
     * do objeto quando o mesmo eh serializado.
     * 
     * @return array
     */
    public function __sleep()
    {
        return array_keys(get_object_vars($this));
    }

}
