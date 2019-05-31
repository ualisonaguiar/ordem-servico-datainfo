<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Util\Format;
use InepZend\Util\String;

abstract class AbstractGeradorMassa extends AbstractServiceFileFlow
{

    use Util\DadoAleatorio;

    abstract protected function gerarMassa($arrCampoLayout, $intQtdLinha, $strNameFile, $intIdMassaTest);

    /**
     * 
     * @param type $strType
     * @param type $intSize
     * @param type $arrDomain
     * @return type
     */
    protected function getValuesMassa($strType, $intSize, $arrDomain)
    {
        $mixValues = '';
        $strType = String::clearWord(strtolower($strType));
        switch ($strType) {
            case 'cpf':
                $mixValues = $this->getGenerateNumber(11, false);
                if (count($arrDomain))
                    $mixValues = Format::formatCpfCnpj($mixValues);
                break;
            case 'cnpf':
                $mixValues = $this->getGenerateNumber(14, false);
                if (count($arrDomain))
                    $mixValues = Format::formatCpfCnpj($mixValues);
                break;
            case 'cep':
                $mixValues = $this->getGenerateNumber(8, false);
                if (count($arrDomain))
                    $mixValues = Format::formatCep($mixValues);
                break;
            case 'data':
                $mixValues = $this->getGenerateDate();
                break;
            case 'hora':
                $mixValues = $this->getGenerateHora();
                break;
            case 'data hora':
                $mixValues = $this->getGenerateDateHora();
                break;
            case 'numero':
                $mixValues = $this->getGenerateNumber($intSize);
                break;
            case 'texto':
                $strDomain = end($arrDomain);
                if (strpos($strDomain, 'a-z') !== false && strpos($strDomain, 'A-Z') !== false && strpos($strDomain, '0-9') !== false)
                    $mixValues = $this->getGenerateStringNumber($intSize);
                elseif (strpos($strDomain, '0-9') !== false)
                    $mixValues = $this->getGenerateNumber($intSize);
                else
                    $mixValues = $this->getGenerateString($intSize);
                break;
            case 'uf':
                $mixValues = $this->getSqUf();
                break;
            case 'lista':
            case 'lista numerica':
            case 'lista texto':
                $mixValues = $this->getDomain($arrDomain);
                break;
            case 'booleano':
                $mixValues = $this->getInAtivo($arrDomain);
                break;
        }
        return $mixValues;
    }

}
