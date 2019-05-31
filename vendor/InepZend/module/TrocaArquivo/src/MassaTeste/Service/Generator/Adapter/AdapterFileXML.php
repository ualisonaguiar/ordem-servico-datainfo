<?php

namespace InepZend\Module\TrocaArquivo\MassaTeste\Service\Generator\Adapter;

use InepZend\Module\TrocaArquivo\Common\Service\AbstractServiceFileFlow;
use InepZend\Util\Server;
use InepZend\Module\TrocaArquivo\MassaTeste\Service\ArquivoTeste;
use InepZend\Util\FileSystem;

class AdapterFileXML extends AbstractServiceFileFlow implements InterfaceFile
{

    public $strExtension = 'xml';

    public function excluir()
    {
        d("Em desenvolvimento", 1);
    }

    public function getInformation()
    {
        d("Em desenvolvimento", 1);
    }

    public function insertContent($arrLineValue, $strNameFile, $intIdMassaTeste, $booCreateXml = false)
    {
        $this->debugExecFile(func_get_args());
        if (!$booCreateXml)
            $this->insertContentFile($arrLineValue, $strNameFile, $intIdMassaTeste);
        else
            $this->insertContentDOM($arrLineValue, $strNameFile, $intIdMassaTeste);
    }

    /**
     * Metodo responsavel pela criacao do arquivo file.
     * 
     * @param type $arrLineValue
     * @param type $strNameFile
     * @param type $intIdMassaTeste
     */
    protected function insertContentFile($arrLineValue, $strNameFile, $intIdMassaTeste)
    {
        $strPathXml = $this->getMountPath($strNameFile, $intIdMassaTeste);
        $strXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $strXml .= '<registers xmlns="' . Server::getHost() . 'xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="' . Server::getHost() . 'xsd ' . $this->getMountPathXsd($intIdMassaTeste) . '">' . "\n";
        foreach ($arrLineValue as $intLine => $arrValueField) {
            $strRegister = '<register>';
            foreach ($arrValueField as $strNameFiled => $strValueField) {
                $strRegister .= '<' . $strNameFiled . '' . ((is_null($strValueField) ? ' xsi:nil="true"' : '')) . '>' . $strValueField . '</' . $strNameFiled . '>';
            }
            $strRegister .= '</register>' . "\n";
            $strXml .= $strRegister;
            if (($intLine % 1000) == 0) {
                FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
                $strXml = '';
            }
        }
        $strXml .= '</registers>';
        FileSystem::insertContentIntoFile($strPathXml, $strXml, 'a+');
    }

    /**
     * Metodo responsavel pela criacao do arquivo xml.
     * 
     * @param type $arrLineValue
     * @param type $strNameFile
     * @param type $intIdMassaTeste
     */
    protected function insertContentDOM($arrLineValue, $strNameFile, $intIdMassaTeste)
    {
        $strPath = $this->getMountPath($strNameFile, $intIdMassaTeste);
        $domXml = new \DOMDocument('1.0', 'UTF-8');
        $domXml->preserveWhiteSpace = false;
        $domXml->formatOutput = true;
        $xmlRoot = $domXml->createElement('registers');
        $this->mountChildrenNode($domXml, $xmlRoot, $arrLineValue);
        $domXml->appendChild($xmlRoot);
        $xmlRoot->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', 'http://inepskeleton.local/xsd');
        $xmlRoot->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xmlRoot->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:schemaLocation', $this->getMountPathXsd($intIdMassaTeste));
        $domXml->normalize();
        $domXml->save($strPath);
        unset($arrLineValue, $xmlRoot, $domXml);
    }

    /**
     * Metodo responsavel para montar os elementos filhos do xml.
     * 
     * @param type $domXmlAcronym
     * @param type $xmlRoot
     * @param type $arrLineValue
     */
    protected function mountChildrenNode($domXmlAcronym, &$xmlRoot, $arrLineValue)
    {
        foreach ($arrLineValue as $intPosicao => $arrValueField) {
            $xmlInfoProfile = $domXmlAcronym->createElement('register');
            foreach ($arrValueField as $strNameFiled => $strValueField) {
                $xmlInfoProfile->appendChild($domXmlAcronym->createElement(strtoupper($strNameFiled), $strValueField));
            }
            $xmlRoot->appendChild($xmlInfoProfile);
        }
    }

    /**
     * Metodo responsavel para montar a estrutura do diretorio.
     * 
     * @param type $strNameFile
     * @return type
     */
    public function getMountPath($strNameFile, $intIdMassaTest)
    {
        $strPath = Server::getReplacedBasePathApplication(ArquivoTeste::PATH_GENERATOR_TEST);
        if (!is_dir($strPath))
            mkdir($strPath, 0755, true);
        $strPath .= '/file_' . $intIdMassaTest;
        if (!is_dir($strPath))
            mkdir($strPath, 0755, true);
        return $strPath . '/' . $strNameFile . '.xml';
    }

    /**
     * Metodo responsavel para montar o path do XSD.
     * 
     * @param integer $intIdMassaTeste
     */
    protected function getMountPathXsd($intIdMassaTeste)
    {
        $layout = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\MassaTesteFile')->find((int) $intIdMassaTeste);
        $strNoLayout = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')
                        ->findBy(array('id_layout' => (int) $layout->getIdLayout())))->getNoLayout();
        return Server::getHost() . strtolower($strNoLayout) . '.xsd';
    }

}
