<?php

namespace InepZend\Module\TrocaArquivo\Common\Service\File;

use InepZend\Module\TrocaArquivo\Common\Service\File\AbstractServiceFile;
use InepZend\Util\Server;
use InepZend\Util\FileSystem;

class EstruturaFile extends AbstractServiceFile
{

    public function __construct($entityManager = null)
    {
        parent::__construct($entityManager, __CLASS__);
        $this->arrPk = array('id_estrutura');
    }

    public function getEstrutura($arrPost)
    {
        if (array_key_exists("id_estrutura", $arrPost))
            $arrEstrutura['id_estrutura'] = (int) $arrPost["id_estrutura"];
        else
            $arrEstrutura = [
                'id_layout' => (int) $arrPost["id_layout"],
                'no_campo' => $arrPost["no_campo"],
                'id_tipo' => (int) $arrPost["id_tipo"],
                'in_obrigatoriedade' => $arrPost["in_obrigatoriedade"],
                'ds_tamanho_min' => $arrPost["ds_tamanho_min"],
                'ds_tamanho_max' => $arrPost["ds_tamanho_max"],
                'ds_validacao' => $arrPost["ds_validacao"],
                'nu_ordem' => $arrPost["nu_ordem"]
            ];
        $estrutura = $this->findBy($arrEstrutura, array('nu_ordem' => 'ASC'));
        if (is_array($estrutura))
            return (reset($estrutura)->toArray());
        else
            return $estrutura;
    }

    public function updateEstrutura(array $arrPost)
    {
        if (array_key_exists('idEstrutura', $arrPost)) {
            $intPosition = 1;
            foreach ($arrPost["idEstrutura"] as $intIdEstrutura) {
                $estrutura = $this->find((int) $intIdEstrutura);
                $estrutura->setNuOrdem($intPosition);
                $this->update($estrutura->toArray());
                $intPosition++;
            }
        }
    }

    public function gerarXslEstrutura($intIdLayout)
    {
        $arrEstrutura = $this->findBy(array('id_layout' => $intIdLayout), array('nu_ordem' => 'ASC'));
        $strCaminhoLayout = reset($this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\LayoutFile')->findBy(array('id_layout' => $intIdLayout)))->getDsCaminho();
        $strStructure = null;
        foreach ($arrEstrutura as $estrutura)
            $strStructure .= $this->getStructure($estrutura);
        FileSystem::insertContentIntoFile($strCaminhoLayout, $this->structureXsd($strStructure));
    }

    private function getStructure($estrutura)
    {
        $tipo = $this->getService('InepZend\Module\TrocaArquivo\Common\Service\File\Tipo')->findBy(array('id_tipo' => (int) $estrutura->getIdTipo()));
        $nillable = ($estrutura->getInObrigatoriedade() == 0) ? '' : ' nillable="true"';
        $minOccurs = ($estrutura->getInOcorrencia() == 1) ? ' minOccurs="0"' : '';
        $lengthMin = ($estrutura->getDsTamanhoMin() != '') ? '<xs:minLength value="' . trim($estrutura->getDsTamanhoMin()) . '"/>' : null;
        $lengthMax = ($estrutura->getDsTamanhoMax() != '') ? '<xs:maxLength value="' . trim($estrutura->getDsTamanhoMax()) . '"/>' : null;
        $pattern = ($estrutura->getDsValidacao() != null) ? '<xs:pattern value="' . trim($estrutura->getDsValidacao()) . '"/>' : null;
        return $this->getEstruturaXsElement($tipo, $estrutura, $nillable, $minOccurs, $lengthMin, $lengthMax, $pattern);
    }

    private function getInclusiveInteger($strDsTamanhoMin, $strDsTamanhoMax)
    {
        $intMin = ((int) $strDsTamanhoMin);
        $strMinInclusive = '<xs:minInclusive value="' . str_pad("1", $intMin, "0") . '"/>';
        $intMaxInclusive = '9';
        for ($count = 1; $count < (int) $strDsTamanhoMax; $count++) {
            $intMaxInclusive .= '9';
        }
        $strMaxInclusive = '<xs:maxInclusive value="' . $intMaxInclusive . '"/>';
        return array('minInclusive' => $strMinInclusive, 'maxInclusive' => $strMaxInclusive);
    }

    private function getEstruturaXsElement($tipo, $estrutura, $nillable, $minOccurs, $lengthMin, $lengthMax, $pattern)
    {
        $strEstrutura = '';
        switch (trim($tipo[0]->getNoTipo())) {
            case 'Data':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '"' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:date">                                       
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';
                break;
            case 'CPF':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:string">
                                        ' . $lengthMin . $lengthMax . $pattern . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';
                break;
            case 'CEP':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:string">
                                        ' . $lengthMin . $lengthMax . $pattern . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Lista Numérica':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:integer">
                                        ' . $this->explodeDsValidacao($estrutura->getDsValidacao()) . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Lista Texto':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:string">
                                        ' . $this->explodeDsValidacao($estrutura->getDsValidacao()) . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Número':
                $strInclusive = $this->getInclusiveInteger($estrutura->getDsTamanhoMin(), $estrutura->getDsTamanhoMax());
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:integer">
                                        ' . $strInclusive['minInclusive'] . '
                                        ' . $strInclusive['maxInclusive'] . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Hora':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:time">                                       
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Data Hora':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:dateTime">                                       
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'Booleano':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:integer">
                                        <xs:enumeration value="0"/>
                                        <xs:enumeration value="1"/>
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
            case 'UF':
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:string">
                                        <xs:enumeration value="AC"/>
                                        <xs:enumeration value="AL"/>
                                        <xs:enumeration value="AP"/>
                                        <xs:enumeration value="AM"/>
                                        <xs:enumeration value="BA"/>
                                        <xs:enumeration value="CE"/>
                                        <xs:enumeration value="DF"/>
                                        <xs:enumeration value="ES"/>
                                        <xs:enumeration value="GO"/>
                                        <xs:enumeration value="MA"/>
                                        <xs:enumeration value="MT"/>
                                        <xs:enumeration value="MS"/>
                                        <xs:enumeration value="MG"/>
                                        <xs:enumeration value="PA"/>
                                        <xs:enumeration value="PB"/>
                                        <xs:enumeration value="PR"/>
                                        <xs:enumeration value="PE"/>
                                        <xs:enumeration value="PI"/>
                                        <xs:enumeration value="RJ"/>
                                        <xs:enumeration value="RN"/>
                                        <xs:enumeration value="RS"/>
                                        <xs:enumeration value="RO"/>
                                        <xs:enumeration value="RR"/>
                                        <xs:enumeration value="SC"/>
                                        <xs:enumeration value="SP"/>
                                        <xs:enumeration value="SE"/>
                                        <xs:enumeration value="TO"/>
                                    </xs:restriction>   
                                </xs:simpleType>
                            </xs:element>';
                break;
            default:
                $strEstrutura = '<xs:element name="' . strtoupper($estrutura->getNoCampo()) . '" ' . $nillable . $minOccurs . '>
                                <xs:simpleType>
                                    <xs:restriction base="xs:string">
                                    ' . $lengthMin . $lengthMax . $pattern . '
                                    </xs:restriction>
                                </xs:simpleType>
                            </xs:element>';

                break;
        }

        return $strEstrutura;
    }

    private function explodeDsValidacao($strDsValidacao)
    {
        $arrDsValidacao = explode(';', $strDsValidacao);
        $strValidacao = '';
        foreach ($arrDsValidacao as $strValorValidacao) {
            if ($strValorValidacao != '')
                $strValidacao .= '<xs:enumeration value="' . $strValorValidacao . '"/>';
        }
        return $strValidacao;
    }

    private function structureXsd($estrutura)
    {
        $strLayout = '<?xml version="1.0" encoding="UTF-8"?>' .
                '<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema" targetNamespace="' .
                Server::getHost() . 'xsd" '
                . 'xmlns="' . Server::getHost() . 'xsd" '
                . 'elementFormDefault="qualified">' .
                '<xs:element name="registers">' .
                '<xs:complexType>' .
                '<xs:sequence>' .
                '<xs:element name="register" maxOccurs="unbounded">' .
                '<xs:complexType>' .
                '<xs:sequence>';
        $strLayout .= $estrutura;
        $strLayout .='</xs:sequence> ' .
                '</xs:complexType>' .
                '</xs:element>' .
                '</xs:sequence>' .
                '</xs:complexType>' .
                '</xs:element>' .
                '</xs:schema>';

        return $strLayout;
    }

}
